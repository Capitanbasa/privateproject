<?php
/*
Plugin Name: Triple i Header Styles
Plugin URI: http://www.foolprooflabs.com
Description: Adds styles for new design to header and registers a sidebar area called Top Header
Author: Foolproof Labs
Version: 1.0
Author URI: http://www.foolprooflabs.com/
*/

add_action('wp_head', 'fpl_theme_add_headers', 0);
add_action('wp_footer', 'fpl_add_top_header',0);
add_action('init', 'fpl_theme_add_css');
add_action('init', 'fpl_theme_add_js');

// This filter replaces a complete file from the parent theme or child theme with your file (in this case the archive page).
// Whenever the archive is requested, it will use YOUR archive.php instead of that of the parent or child theme.
//add_filter ('archive_template', create_function ('', 'return plugin_dir_path(__FILE__)."archive.php";'));
 
function fpl_add_top_header(){
	echo '<header class="top-header" id="fpl-top-header">
 			<div class="top-links-container container">
				<div class="top-links-wrapper">';
					dynamic_sidebar('top-header');
	echo '</div>
			</div>
	</header>';
}

function fpl_theme_add_headers () {
    wp_enqueue_style('grandchild_style');
    wp_enqueue_script('fpl-header-custom');
}
 
function fpl_theme_add_css() {
    $timestamp = @filemtime(plugin_dir_path(__FILE__).'/style.css');
    wp_register_style ('grandchild_style', plugins_url('style.css', __FILE__).'', array(), $timestamp);
}

function fpl_theme_add_js() {
	$customUrl = plugins_url('js/custom.js', __FILE__);
	wp_register_script('fpl-header-custom',$customUrl);
}

//Location at the very top of the page
register_sidebar(array(
	'name'					=> 'Top Header',
	'id' 						=> 'top-header',
	'description'   => 'Located above the header',
	'before_widget' => '<div id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));
?>