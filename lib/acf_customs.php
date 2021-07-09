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

add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
function add_default_value_to_image_field($field) {
	acf_render_field_setting( $field, array(
		'label'			=> 'Default Image',
		'instructions'		=> 'Appears when creating a new post',
		'type'			=> 'image',
		'name'			=> 'default_value',
	));
}
