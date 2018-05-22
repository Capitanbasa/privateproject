<?php
/*
Plugin Name: Triple i Consulting Contact Form Sidebar
Plugin URI: http://www.foolprooflabs.com
Description: Contact Form to appear in the sidebar of each post
Author: Foolproof Labs
Version: 1.1
Author URI: http://www.foolprooflabs.com/
*/
add_action('wp_head', 'fpl_add_headers', 1);
//add_action('admin_head', 'fpl_add_headers',100);
add_action('wp_footer','fpl_add_footer',0);
add_action('init', 'fpl_add_css');
add_action('init', 'fpl_add_js');
add_action('admin_menu', 'fpl_plugin_settings');


/**
 * 1. Handles saving of options form to database
 * 2. Outputs HTML required for settings page 
 * @return none
 */
function fpl_display_settings(){
	 if($_POST['fpl_hidden'] == 'Y') {  
        //Form data sent  
        $emailTo = $_POST['fpl_emailTo'];  
        update_option('fpl_emailTo', $emailTo);  
      
        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
        <?php  
    } 
    $emailTo = get_option('fpl_emailTo');  
    require_once('optionsform.php');    
	
}

/**
 * Add settings menu link to WP admin menu
 * @return none
 */
function fpl_plugin_settings() {

    add_options_page('Foolproof Labs Contact Form Settings', 'FPL Contact Form Settings', 'administrator', 'fpl_settings', 'fpl_display_settings');

}
/**
* Add contact form HTML to footer
* @return none
*/
function fpl_add_footer(){
	require_once('contactform.php');
	fpl_submitContactForm();
}

/**
 * Enqueue CSS + JS scripts
 * @return 
 */
function fpl_add_headers () {
    wp_enqueue_style('grandchild_style2');
    wp_enqueue_style('bootstrap-datetimepicker-style');

    wp_enqueue_script('jquery', false, array(), false, false);
    wp_enqueue_script('bootstrap-datetimepicker');
    wp_enqueue_script('jquery-validate');
    wp_enqueue_script('fpl-contact-custom', false, array(), false, true);

    add_shortcode( 'fpl-contact-button', 'fpl_contact_button' );
    
	//add different CSS for single + archive page
    
    if(is_single() || is_archive() || is_home()){
    	echo "<style>#contactUsButton a{width:98%}#contactWrapper{width: auto !important;top:0 !important;position:relative !important;height:100px !important;}.#contactUsButton{top: 0 !important;position:absolute !important;}</style>";
    	echo "<script type='text/javascript'>var isArchiveOrSingle = true;</script>";
    }
    else
    	echo "<script type='text/javascript'>var isArchiveOrSingle = false;</script>";

}
 
/**
* Register required CSS styles
* @return none
*/
function fpl_add_css() {
	$dateCSSUrl = plugins_url('triplei-contact-form-sidebar/css/bootstrap-datetimepicker.min.css');
	wp_register_style('bootstrap-datetimepicker-style', $dateCSSUrl);
    $timestamp = @filemtime(plugin_dir_path(__FILE__).'/style.css');
    wp_register_style ('grandchild_style2', plugins_url('style.css', __FILE__).'', array(), $timestamp);
    
}

/**
 * Register required JS scripts 
 * @return none
 */
function fpl_add_js(){
	wp_dequeue_script('jquery');
	wp_deregister_script('jquery');
	$jqueryUrl = plugins_url('triplei-contact-form-sidebar/js/jquery-1.8.3.min.js');
	wp_register_script('jquery', $jqueryUrl);

	$pickerUrl = plugins_url('triplei-contact-form-sidebar/js/bootstrap-datetimepicker.js');
	wp_register_script('bootstrap-datetimepicker', $pickerUrl);

	$validateUrl = plugins_url('triplei-contact-form-sidebar/js/jquery.validate.min.js');
	wp_register_script('jquery-validate',$validateUrl);  

	$customUrl = plugins_url('triplei-contact-form-sidebar/js/custom.js');
	wp_register_script('fpl-contact-custom',$customUrl);
}

/**
 * Function to feed shortcode call
 * @param  none
 * @return HTML for contact button fed from contactButton.php
 */
function fpl_contact_button( ){
	require_once('contactButton.php');
	return getContactButton();
}

/**
 * Handle AJAX submission of contact form
 * Checks first if honeypot field is valid.  If invalid, return success but don't send mail so that bots are none the wiser.
 * @return success message
 */
function fpl_submitContactForm(){

	if($_POST && isset($_POST['action']) && $_POST['action'] == 'fpl_submitContactForm'){
	$name = $_POST['inputName'];
	$phone = $_POST['inputPhone'];
	$email = $_POST['inputEmail'];
	$subject = $_POST['inputSubject'];
	$message = $_POST['inputMessage'];
	$meeting = $_POST['inputMeetingType'];
	$time = $_POST['inputDatetime'];
	$honeypot = $_POST['inputAddress'];
	$emailTo = get_option('fpl_emailTo');
	global $post;
	$url = get_permalink($post->ID);

	//Validate Form
	if($name != "" && is_email($email) && $message != ""){		
		
		//if the honey pot is not filled, send the email
		if($honeypot == ""){

			$body = "
					Good day!<br><br>
					$name has just filled in the contact form on $url.  Here are the full details:<br><br>
					Name: $name<br>
					Phone: $phone<br>
					Email: $email<br>
					Subject: $subject<br>
					Message: $message<br>";
			if($meeting != ""){
				if($meeting == "mtg_call")
					$meeting = "Would like to be called";
				elseif($meeting=="mtg_meeting")
					$meeting = "Would like to schedule a meeting";
				elseif($meeting=="mtg_no"){
					$meeting = "Did not request a meeting or a call";
					$time = "N/A";
				}
				$body .= "Meeting/Call: $meeting<br>";
				$body .= "Meeting/Call Time: $time<br>";
			}

			$body .= "<br><br>Have a nice day,<br><br>The Friendly Foolproof Labs Auto-emailer";
			
			add_filter( 'wp_mail_content_type', 'set_html_content_type' );
			$headers = 'From: Triplei Contact Form <info@tripleiconsulting.com>' . "\r\n";

			wp_mail($emailTo, "Message from contact form on ".$_SERVER['HTTP_HOST'], $body, $headers);
								
			remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
		}

		//don't give the bot any possible way of knowing that his request failed (i.e. email wasn't sent)
		if(!is_page('Home')){
			echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#content').prepend(\"<div class='alert alert-success'><strong>".__('Success!')."</strong><br>".__(' Thank you for your inquiry, we will try to get back to you within 24 hours.')."<br></div>\");});</script>";
		}
		else
			{
			echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#content').prepend(\"<div class='alert alert-success'><strong>".__('Success!')."</strong><br>".__(' Thank you for your inquiry, we will try to get back to you within 24 hours.')."<br></div>\");});</script>";
		}		
	}
	else {
		echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#content').prepend(\"<div class='alert alert-error'><strong>".__('Sorry!')."</strong><br>".__(' There was an error submitting your form, please try again')."<br></div>\");});</script>";

	 	//echo "<div class='alert alert-error'><strong>".__('Sorry!')."</strong><br>".__(' There was an error submitting your form, please try again')."<a href='#' onclick='$(\"#modalContactForm\").modal(\"hide\");$(\"#contactUsButton .btn\").blur();'>Click here to close this window</a></div>";	
	}
  }
}
add_action('wp_ajax_fpl_submitContactForm', 'fpl_submitContactForm');
add_action('wp_ajax_nopriv_fpl_submitContactForm', 'fpl_submitContactForm');

function set_html_content_type() {

	return 'text/html';
}
?>