<?php

BoldThemes_Customize_Default::$data['body_font'] = 'Lato';
BoldThemes_Customize_Default::$data['heading_supertitle_font'] = 'Lato';
BoldThemes_Customize_Default::$data['heading_font'] = 'Libre Baskerville';
BoldThemes_Customize_Default::$data['heading_subtitle_font'] = 'Libre Baskerville';
BoldThemes_Customize_Default::$data['menu_font'] = 'Lato';

BoldThemes_Customize_Default::$data['accent_color'] = '#CCA876';
BoldThemes_Customize_Default::$data['alternate_color'] = '#FF7F00';
BoldThemes_Customize_Default::$data['logo_height'] = '80';

BoldThemes_Customize_Default::$data['template_skin'] = false;
BoldThemes_Customize_Default::$data['heading_style'] = 'default';

// OVERLAY LINES

BoldThemes_Customize_Default::$data['heading_style'] = 'default';

if ( ! function_exists( 'boldthemes_customize_heading_style' ) ) {
	function boldthemes_customize_heading_style( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['heading_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'heading_style', array(
			'label'     => esc_html__( 'Heading Style', 'law-firm' ),
			'section'   => BoldThemesFramework::$pfx . '_typography_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_style]',
			'priority'  => 95,
			'type'      => 'select',
			'choices'   => array(
				'default' => esc_html__( 'Default', 'law-firm' ),
				'compact' => esc_html__( 'Compact (small line height + bold)', 'law-firm' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_style' );