<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
 * @package Beetroot
 */

if ( ! function_exists( 'beetroot_theme_support' ) ) :
	/**
	 * Add theme supports
	 */
	function beetroot_theme_support() {
		// Add language support: @link {https://codex.wordpress.org/Multilingual_WordPress}
		load_theme_textdomain( 'wp_dev', get_template_directory() . '/languages' );

		// Add menu support
		add_theme_support( 'menus' );

		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );

		// Add post thumbnail support: @link {http://codex.wordpress.org/Post_Thumbnails}
		add_theme_support( 'post-thumbnails' );

		// RSS thingy
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add post formarts support: @link {http://codex.wordpress.org/Post_Formats}
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		// Declare WooCommerce support per @link {http://docs.woothemes.com/document/third-party-custom-theme-compatibility/}
		add_theme_support( 'woocommerce' );
		// Add widget support shortcodes
		add_filter( 'widget_text', 'do_shortcode' );

		// Custom Background
		add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );

		// Custom Header
		add_theme_support(
			'custom-header',
			array(
				'default-image' => get_template_directory_uri() . '/assets/dist/images/custom-logo.png',
				'height'        => '200',
				'flex-height'   => true,
				'uploads'       => true,
				'header-text'   => false,
			)
		);
	}

	add_action( 'after_setup_theme', 'beetroot_theme_support' );
endif;
