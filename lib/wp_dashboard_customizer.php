<?php
/**
 * Custom styles, scripts, screens for WP dashboard
 *
 * @package Beetroot
 */

if ( ! class_exists( 'WP_Dashboard_Customizer' ) ) :

	/**
	 * WP_Dashboard_Customizer is a class for the better stylization of WP dashboard.
	 */
	class WP_Dashboard_Customizer {

		/**
		 * WP_Dashboard_Customizer constructor.
		 */
		public function __construct() {
			add_action( 'login_enqueue_scripts', [ $this, 'login_assets' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_assets' ] );
			add_action( 'admin_init', [ $this, 'admin_color_scheme' ] );
			add_filter( 'login_headerurl', [ $this, 'login_logo_url' ] );
			add_filter( 'login_headertext', [ $this, 'login_logo_title' ] );
		}

		/**
		 * WP hook 'login_enqueue_scripts'. Enqueue scripts and styles for the login page.
		 * https://developer.wordpress.org/reference/hooks/login_enqueue_scripts/
		 */
		public function login_assets() {
			wp_enqueue_style( 'login-stylesheet', asset_path( 'styles/login.css' ), [], '1.0.0', 'all' );

			// Use site logo for login page
			$this->print_login_logo();
		}

		/**
		 * WP hook 'admin_enqueue_scripts'. Enqueue scripts and styles for the admin page.
		 * https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
		 *
		 * @param string $hook The current admin page.
		 */
		public function admin_assets( $hook ) {
			wp_enqueue_style( 'admin-stylesheet', asset_path( 'styles/admin.css' ), [], '1.0.0', 'all' );
			wp_enqueue_script( 'admin-javascript', asset_path( 'scripts/admin.js' ), [ 'jquery' ], '1.0.0', true );

			// Add custom styles for TinyMCE and Gutenberg editor (not for blocs)
			if ( 'post.php' === $hook ) {
				wp_enqueue_style( 'editor-stylesheet', asset_path( 'styles/editor.css' ), [], '1.0.0', 'all' );
			}
		}

		/**
		 * WP hook 'admin_init'. Fires as an admin screen or script is being initialized.
		 * https://developer.wordpress.org/reference/hooks/admin_init/
		 */
		public function admin_color_scheme() {
			wp_admin_css_color(
				'alternative',
				__( 'Alternative', 'wp_dev' ),
				asset_path( 'styles/colors.css' ),
				[ '#131619', '#23282d', '#0073aa', '#d54e21' ]
			);
		}

		/**
		 * Print stylesheet for setting login logo image
		 */
		private function print_login_logo() {
			$logo_url = get_header_image();
			if ( $logo_url ) {
				$logo_url_stylesheet  = '<style type="text/css">';
				$logo_url_stylesheet .= '#login h1 a, .login h1 a {background-image: url(';
				$logo_url_stylesheet .= $logo_url;
				$logo_url_stylesheet .= ')}';
				$logo_url_stylesheet .= '</style>';
				echo $logo_url_stylesheet;
			}
		}

		/**
		 * WP filter 'login_headerurl'. Filters link URL of the header logo above login form.
		 * https://developer.wordpress.org/reference/hooks/login_headertext/
		 *
		 * @param string $login_header_url Login header logo URL.
		 * @return string
		 */
		public function login_logo_url( $login_header_url ) {
			$login_header_url = home_url();
			return $login_header_url;
		}

		/**
		 * WP filter 'login_headertext'. Filters the link text of the header logo above the login form.
		 * https://developer.wordpress.org/reference/hooks/login_headertext/
		 *
		 * @param string $login_header_text The login header logo link text.
		 * @return string
		 */
		public function login_logo_title( $login_header_text ) {
			$login_header_text = __( 'Welcome to ', 'wp_dev' ) . get_bloginfo( 'name' );
			return $login_header_text;
		}
	}

	new WP_Dashboard_Customizer();

endif;

