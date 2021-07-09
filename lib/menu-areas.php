<?php
/**
 * Register navigation menus
 *
 * @link https://codex.wordpress.org/Function_Reference/register_nav_menus
 * @package Beetroot
 */

add_action( 'after_setup_theme', 'register_theme_menus' );

/**
 * register_theme_menus
 *
 * @return void
 */
function register_theme_menus() {
	register_nav_menus(
		array(
			'primary'               => __( 'Primary Menu', 'casadeapostas' ),
			'atulidade_footer_menu' => __( 'Atulidade Footer Menu', 'casadeapostas' ),
			'apostas_footer_menu'   => __( 'Apostas Footer Menu', 'casadeapostas' ),
			'contato_footer_menu'   => __( 'Contato Footer Menu', 'casadeapostas' ),
			'documents_footer_menu'   => __( 'Documents Footer Menu', 'casadeapostas' ),
		)
	);
}
