<?php
// =============================== My Social Networks Widget ====================================== //
class My_SocialNetworksWidget extends WP_Widget {

	function My_SocialNetworksWidget() {
		$widget_ops = array('classname' => 'social_networks_widget', 'description' => __('Link to your social networks.', CURRENT_THEME));
		$this->WP_Widget('social_networks', __('Cherry - Social Networks', CURRENT_THEME), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$networks['Twitter']['link'] = $instance['twitter'];
		$networks['Facebook']['link'] = $instance['facebook'];
		$networks['Phone']['link'] = $instance['phone'];
		$networks['Feed']['link'] = $instance['feed'];
		$networks['Linkedin']['link'] = $instance['linkedin'];
		$networks['Pinterest']['link'] = $instance['pinterest'];
		$networks['Github']['link'] = $instance['github'];
		$networks['Google+']['link'] = $instance['google'];
		
		$networks['Twitter']['label'] = $instance['twitter_label'];
		$networks['Facebook']['label'] = $instance['facebook_label'];
		$networks['Phone']['label'] = $instance['phone_label'];
		$networks['Feed']['label'] = $instance['feed_label'];
		$networks['Linkedin']['label'] = $instance['linkedin_label'];
		$networks['Pinterest']['label'] = $instance['pinterest_label'];
		$networks['Github']['label'] = $instance['github_label'];
		$networks['Google+']['label'] = $instance['google_label'];

		$display = $instance['display'];
		
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<!-- BEGIN SOCIAL NETWORKS -->
			<?php if ($display == "both" or $display =="labels") {
				$addClass = "social__list";
			} elseif ($display == "icons") { 
				$addClass = "social__row clearfix";
			} ?>
			
			<ul class="social <?php echo $addClass ?> unstyled">
				
			<?php foreach(array("Facebook", "Twitter", "Phone", "Feed", "Linkedin", "Pinterest", "Github", "Google+") as $network) : ?>
				<?php if (!empty($networks[$network]['link'])) : ?>
				<li class="social_li">
					<a class="social_link social_link__<?php echo strtolower($network); ?>" data-original-title="<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>">
						<?php if (($display == "both") or ($display =="icons")) { ?>
							<?php if ($network == "Google+") { ?>
								<span class="social_ico"><i class="icon-google-plus"></i></span>
							<?php } else if ($network == "Feed") { ?>
								<span class="social_ico"><i class="icon-rss"></i></span>
							<?php } else { ?>
								<span class="social_ico"><i class="icon-<?php echo strtolower($network);?>"></i></span>
							<?php }?>
						<?php } if (($display == "labels") or ($display == "both")) { ?> 
							<span class="social_label"><?php if (($networks[$network]['label'])!=="") { echo $networks[$network]['label']; } else { echo $network; } ?></span>
						<?php } ?>
					</a>
				</li>
				<?php endif; ?>
			<?php endforeach; ?>
			  
		</ul>
		<!-- END SOCIAL NETWORKS -->
	  
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['phone'] = $new_instance['phone'];
		$instance['feed'] = $new_instance['feed'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['github'] = $new_instance['github'];
		$instance['google'] = $new_instance['google'];
		
		$instance['twitter_label'] = $new_instance['twitter_label'];
		$instance['facebook_label'] = $new_instance['facebook_label'];
		$instance['phone_label'] = $new_instance['phone_label'];
		$instance['feed_label'] = $new_instance['feed_label'];
		$instance['linkedin_label'] = $new_instance['linkedin_label'];
		$instance['pinterest_label'] = $new_instance['pinterest_label'];
		$instance['github_label'] = $new_instance['github_label'];
		$instance['google_label'] = $new_instance['google_label'];

		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'twitter' => '', 'twitter_label' => '', 'facebook' => '', 'facebook_label' => '', 'phone' => '', 'phone_label' => '', 'feed' => '', 'feed_label' => '', 'linkedin' => '', 'linkedin_label' => '', 'pinterest' => '', 'pinterest_label' => '', 'github' => '', 'github_label' => '', 'google' => '', 'google_label' => '', 'display' => 'icons', 'text' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
			
		$twitter = $instance['twitter'];		
		$facebook = $instance['facebook'];
		$phone = $instance['phone'];		
		$feed = $instance['feed'];
		$linkedin = $instance['linkedin'];	
		$pinterest = $instance['pinterest'];
		$github = $instance['github'];
		$google = $instance['google'];
		
		$twitter_label = $instance['twitter_label'];
		$facebook_label = $instance['facebook_label'];
		$phone_label = $instance['phone_label'];
		$feed_label = $instance['feed_label'];
		$linkedin_label = $instance['linkedin_label'];
		$pinterest_label = $instance['pinterest_label'];
		$github_label = $instance['github_label'];
		$google_label = $instance['google_label'];

		$display = $instance['display'];		
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', CURRENT_THEME); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php _e('Facebook', CURRENT_THEME); ?>:</legend>
		
		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:', CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('facebook_label'); ?>"><?php _e('Facebook label:', CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook_label'); ?>" name="<?php echo $this->get_field_name('facebook_label'); ?>" type="text" value="<?php echo esc_attr($facebook_label); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php _e('Twitter', CURRENT_THEME); ?>:</legend>	
	<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:', CURRENT_THEME); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php _e('Twitter label:', CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo esc_attr($twitter_label); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php _e('Phone', CURRENT_THEME); ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone URL:', CURRENT_THEME); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('phone_label'); ?>"><?php _e('Phone label:', CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone_label'); ?>" name="<?php echo $this->get_field_name('phone_label'); ?>" type="text" value="<?php echo esc_attr($phone_label); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php _e('RSS feed', CURRENT_THEME); ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('feed'); ?>"><?php _e('RSS feed:', CURRENT_THEME); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('feed'); ?>" name="<?php echo $this->get_field_name('feed'); ?>" type="text" value="<?php echo esc_attr($feed); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('feed_label'); ?>"><?php _e('RSS label:', CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feed_label'); ?>" name="<?php echo $this->get_field_name('feed_label'); ?>" type="text" value="<?php echo esc_attr($feed_label); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Linkedin', CURRENT_THEME); ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin URL:', CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('linkedin_label'); ?>"><?php _e('Linkedin label:', CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin_label'); ?>" name="<?php echo $this->get_field_name('linkedin_label'); ?>" type="text" value="<?php echo esc_attr($linkedin_label); ?>" /></p>
		</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Pinterest', CURRENT_THEME); ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:', CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('pinterest_label'); ?>"><?php _e('Pinterest label:', CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest_label'); ?>" name="<?php echo $this->get_field_name('pinterest_label'); ?>" type="text" value="<?php echo esc_attr($pinterest_label); ?>" /></p>
		</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php _e('Github', CURRENT_THEME); ?>:</legend>
		<p>
			<label for="<?php echo $this->get_field_id('github'); ?>"><?php _e('Github URL:', CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('github'); ?>" name="<?php echo $this->get_field_name('github'); ?>" type="text" value="<?php echo esc_attr($github); ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('github_label'); ?>"><?php _e('Github label:', CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('github_label'); ?>" name="<?php echo $this->get_field_name('github_label'); ?>" type="text" value="<?php echo esc_attr($github_label); ?>" />
		</p>
	</fieldset>
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php _e('Google+', CURRENT_THEME); ?>:</legend>
		<p>
			<label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Google+ URL:', CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('google_label'); ?>"><?php _e('Google+ label:', CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google_label'); ?>" name="<?php echo $this->get_field_name('google_label'); ?>" type="text" value="<?php echo esc_attr($google_label); ?>" />
		</p>
	</fieldset>


		<p>Display:</p>
		<label for="<?php echo $this->get_field_id('icons'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="icons" id="<?php echo $this->get_field_id('icons'); ?>" <?php checked($display, "icons"); ?>></input>  Icons</label>
		<label for="<?php echo $this->get_field_id('labels'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="labels" id="<?php echo $this->get_field_id('labels'); ?>" <?php checked($display, "labels"); ?>></input> Labels</label>
		<label for="<?php echo $this->get_field_id('both'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="both" id="<?php echo $this->get_field_id('both'); ?>" <?php checked($display, "both"); ?>></input> Both</label>

	
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("My_SocialNetworksWidget");'));
?>