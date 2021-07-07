<?php
/**
 * Functionality for ACF that is not native to start-theme.
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$acf_options_page_settings = array(
	'page_title' => __( 'Theme Options', 'casadeapostas' ),
	'menu_title' => __( 'Theme Options', 'casadeapostas' ),
	'menu_slug'  => 'theme-options',
	'capability' => 'edit_posts'
);
acf_add_options_page( $acf_options_page_settings );
