<?php
/**
 * Protocol Relative Theme Assets
 *
 * @package Beetroot
 */

if ( ! class_exists( 'Beetroot_Protocol_Relative_Theme_Assets' ) ) :

	/**
	 * Beetroot_Protocol_Relative_Theme_Assets class
	 */
	class Beetroot_Protocol_Relative_Theme_Assets {
		/**
		 * Plugin URI: https://github.com/ryanjbonnell/Protocol-Relative-Theme-Assets
		 * Description: Transforms enqueued CSS and JavaScript theme URLs to use protocol-relative paths.
		 * Version: 1.0
		 * Author: Ryan J. Bonnell
		 * Author URI: https://github.com/ryanjbonnell
		 *
		 * Class Constructor
		 *
		 * @access  public
		 * @since   1.0
		 */
		public function __construct() {
			add_filter( 'style_loader_src', array( $this, 'style_loader_src' ), 10, 2 );
			add_filter( 'script_loader_src', array( $this, 'script_loader_src' ), 10, 2 );

			add_filter( 'template_directory_uri', array( $this, 'template_directory_uri' ), 10, 3 );
			add_filter( 'stylesheet_directory_uri', array( $this, 'stylesheet_directory_uri' ), 10, 3 );
		}

		/**
		 * Convert
		 *
		 * @access  private
		 * @return  string
		 * @since   1.0
		 * @param string $url url
		 */
		private function make_protocol_relative_url( $url ) {
			return preg_replace( '(https?://)', '//', $url );
		}

		/**
		 * Transform Enqueued Stylesheet URLs
		 *
		 * @access  public
		 * @return  string
		 * @since   1.0
		 * @param string $src src
		 * @param string $handle handle
		 */
		public function style_loader_src( $src, $handle ) {
			return $this->make_protocol_relative_url( $src );
		}

		/**
		 * Transform Enqueued JavaScript URLs
		 *
		 * @access  public
		 * @return  string
		 * @since   1.0
		 * @param string $src src
		 * @param string $handle handle
		 */
		public function script_loader_src( $src, $handle ) {
			return $this->make_protocol_relative_url( $src );
		}

		/**
		 * Transform Enqueued Theme Files
		 *
		 * @access  public
		 * @return  string
		 * @since   1.0
		 * @link    http://codex.wordpress.org/Function_Reference/get_template_directory_uri
		 * @param string $template_dir_uri template_dir_uri
		 * @param string $template template
		 * @param string $theme_root_uri theme_root_uri
		 */
		public function template_directory_uri( $template_dir_uri, $template, $theme_root_uri ) {
			return $this->make_protocol_relative_url( $template_dir_uri );
		}

		/**
		 * Transform Enqueued Theme Files
		 *
		 * @access  public
		 * @return  string
		 * @since   1.0
		 * @link    http://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri
		 * @param string $stylesheet_dir_uri stylesheet_dir_uri
		 * @param string $stylesheet stylesheet
		 * @param string $theme_root_uri theme_root_uri
		 */
		public function stylesheet_directory_uri( $stylesheet_dir_uri, $stylesheet, $theme_root_uri ) {
			return $this->make_protocol_relative_url( $stylesheet_dir_uri );
		}
	}

	$beetroot_protocol_relative_theme_assets = new Beetroot_Protocol_Relative_Theme_Assets();
endif;
