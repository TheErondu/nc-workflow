<?php
/**
 * Scroll Bar Options
 *
 * @package App_Landing_Page
 */
if ( ! function_exists( 'app_landing_page_customize_register_scrollbar' ) ) :

	function app_landing_page_customize_register_scrollbar( $wp_customize ) {
		/** Scrollbar Settings */
	    $wp_customize->add_section(
	        'app_landing_page_scrollbar_settings',
	        array(
	            'title'      => __( 'Scrollbar Settings', 'app-landing-page' ),
	            'priority'   => 40,
	            'capability' => 'edit_theme_options',
	        )
	    );

	    /** Enable/Disable Scrollbar */
	    $wp_customize->add_setting(
	        'app_landing_page_ed_scrollbar',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'app_landing_page_sanitize_checkbox',
	        )
	    );
	    
	    $wp_customize->add_control(
	        'app_landing_page_ed_scrollbar',
	        array(
	            'label'   => __( 'Enable Nice Scroll', 'app-landing-page' ),
	            'section' => 'app_landing_page_scrollbar_settings',
	            'type'    => 'checkbox',
	        )
	    );
	}
endif;
add_action( 'customize_register', 'app_landing_page_customize_register_scrollbar' );