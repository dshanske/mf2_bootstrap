<?php
/**
 * mf2_bootstrap Theme Customizer
 *
 * @package mf2_bootstrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mf2_bootstrap_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	    $wp_customize->add_setting( 'mf2_logo' ); // Add setting for logo uploader
         
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mf2_logo', array(
        'label'    => __( 'Upload Logo (replaces text)', 'mf2_bootstrap' ),
        'section'  => 'title_tagline',
        'settings' => 'mf2_logo',
    ) ) );
}
add_action( 'customize_register', 'mf2_bootstrap_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mf2_bootstrap_customize_preview_js() {
	wp_enqueue_script( 'mf2_bootstrap_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'mf2_bootstrap_customize_preview_js' );
