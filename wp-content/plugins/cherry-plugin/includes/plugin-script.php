<?php
//include stylesheet files
	if ( !function_exists('cherry_include_stylesheet') ) {
		function cherry_include_stylesheet() {
			wp_deregister_style( 'flexslider' );
			wp_register_style( 'flexslider', CHERRY_PLUGIN_URL . 'lib/js/FlexSlider/flexslider.css', false, '2.0', 'all' );
			wp_register_style( 'owl-carousel', CHERRY_PLUGIN_URL . 'lib/js/owl-carousel/owl.carousel.css', false, '1.24', 'all' );
			wp_register_style( 'owl-theme', CHERRY_PLUGIN_URL . 'lib/js/owl-carousel/owl.theme.css', false, '1.24', 'all' );
			wp_enqueue_style( 'flexslider' );
			wp_enqueue_style( 'owl-carousel', CHERRY_PLUGIN_URL . 'lib/js/owl-carousel/owl.carousel.css', false, '1.24', 'all' );
			wp_enqueue_style( 'owl-theme', CHERRY_PLUGIN_URL . 'lib/js/owl-carousel/owl.theme.css', false, '1.24', 'all' );
			wp_enqueue_style( 'font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', false, '3.2.1', 'all' );
			wp_enqueue_style( 'cherry-plugin', CHERRY_PLUGIN_URL . 'includes/css/cherry-plugin.css', false, CHERRY_PLUGIN_VERSION, 'all' );
		}
		add_action( 'wp_enqueue_scripts', 'cherry_include_stylesheet', 9);
	}

//include script files
	if ( !function_exists('cherry_include_script') ) {
		function cherry_include_script(){
			wp_deregister_script( 'flexslider' );
			wp_register_script( 'flexslider', CHERRY_PLUGIN_URL . 'lib/js/FlexSlider/jquery.flexslider-min.js', array('jquery'), '2.1', true );
			wp_enqueue_script( 'flexslider' );
			wp_enqueue_script( 'cherry-plugin', CHERRY_PLUGIN_URL . 'includes/js/cherry-plugin.js', array('jquery'), CHERRY_PLUGIN_VERSION, true );
		}
		add_action( 'wp_enqueue_scripts', 'cherry_include_script' );
	}