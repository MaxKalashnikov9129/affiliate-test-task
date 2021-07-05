<?php
/**
 * Clean up WordPress defaults
 *
 * @package Beetroot
 */

if ( ! function_exists( 'beetroot_start_cleanup' ) ) :
	/**
	 * Start cleenup
	 */
	function beetroot_start_cleanup() {
		add_action( 'init', 'beetroot_cleanup_head' );
		// Remove WP version from RSS.
		add_filter( 'the_generator', 'beetroot_remove_rss_version' );
		// Clean up comment styles in the head.
		add_action( 'wp_head', 'beetroot_remove_recent_comments_style', 1 );
	}

	add_action( 'after_setup_theme', 'beetroot_start_cleanup' );
endif;

// Clean up head.
if ( ! function_exists( 'beetroot_cleanup_head' ) ) :
	/**
	 * Head cleenup
	 */
	function beetroot_cleanup_head() {
		// EditURI link.
		remove_action( 'wp_head', 'rsd_link' );
		// Category feed links.
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		// Post and comment feed links.
		remove_action( 'wp_head', 'feed_links', 2 );
		// Windows Live Writer.
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// Index link.
		remove_action( 'wp_head', 'index_rel_link' );
		// Previous link.
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		// Start link.
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		// Canonical.
		remove_action( 'wp_head', 'rel_canonical', 10, 0 );
		// Shortlink.
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		// Links for adjacent posts.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		// WP version.
		remove_action( 'wp_head', 'wp_generator' );
		// Emoji styles.
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}
endif;

// Remove WP Emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove WP version from RSS.
if ( ! function_exists( 'beetroot_remove_rss_version' ) ) :
	/**
	 * Remove rss
	 */
	function beetroot_remove_rss_version() {
		return '';
	}
endif;

// Remove injected CSS from recent comments widget.
if ( ! function_exists( 'beetroot_remove_recent_comments_style' ) ) :
	/**
	 * Remove recent comments style
	 */
	function beetroot_remove_recent_comments_style() {
		global $wp_widget_factory;
		if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
	}
endif;

// Remove inline width and height attributes for post thumbnails
/**
 * Remove inline width and height attributes for post thumbnails
 *
 * @param string $html - markup
 * @return string|string[]|null $html - markup
 */
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	return $html;
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
