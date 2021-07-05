<?php
/**
 * Loader for ACF Blocks
 *
 * @package Beetroot
 */

if ( ! class_exists( 'ACF_Blocks_Loader' ) && function_exists( 'acf_register_block' ) ) :

	/**
	 * ACF_Blocks_Loader is a class for adding business logic for auto loading of ACF Blocks from specific template.
	 * It is useful for developers to create ACF Blocks for Gutenberg editor in one standard way.
	 */
	class ACF_Blocks_Loader {

		/**
		 * Directory Name.
		 *
		 * @var string
		 */
		private $dir = 'template-parts/block/';

		/**
		 * Default file extension .php (.blade.php, etc.).
		 *
		 * @var string
		 */
		private $ext = '.php';

		/**
		 * ACF_Blocks_Loader constructor.
		 */
		public function __construct() {
			add_action( 'acf/init', [ $this, 'register_blocks' ] );
		}

		/**
		 * WP hook 'acf/init'. Fires after ACF is fully initialized.
		 * https://www.advancedcustomfields.com/resources/acf-init/
		 */
		public function register_blocks() {
			if ( ! file_exists( locate_template( $this->dir ) ) ) {
				return;
			}

			// Get blocks from directory by absolute path
			$dir = new DirectoryIterator( locate_template( $this->dir ) );

			// Loop through found blocks
			foreach ( $dir as $file_info ) {
				if ( ! $file_info->isDot() && '.DS_Store' !== $file_info->getFilename() ) {
					$slug = str_replace( $this->ext, '', $file_info->getFilename() );

					// Get file info
					$file_path    = locate_template( $this->get_block_template_path( $slug ) );
					$file_headers = get_file_data(
						$file_path,
						[
							'title'       => 'Block Name',
							'description' => 'Description',
							'category'    => 'Category',
							'icon'        => 'Icon',
							'keywords'    => 'Keywords',
							'supports'    => 'Supports',
						]
					);

					// Register new block
					acf_register_block(
						[
							'name'            => $slug,
							'title'           => $file_headers['title'] ?: __( 'Unnamed Block:', 'wp_dev' ) . ' ' . $slug,
							'description'     => $file_headers['description'],
							'category'        => $file_headers['category'] ?: 'formatting',
							'icon'            => $file_headers['icon'],
							'keywords'        => explode( ' ', $file_headers['keywords'] ),
							'supports'        => json_decode( $file_headers['supports'], true ),
							'render_callback' => [ $this, 'block_render_callback' ],
							'enqueue_style'   => get_template_directory_uri() . '/' . $this->get_block_dir_path( $slug ) . 'style.css',
							'enqueue_script'  => get_template_directory_uri() . '/' . $this->get_block_dir_path( $slug ) . 'script.js',
						]
					);
				}
			}
		}

		/**
		 * Testimonial Block Callback Function.
		 *
		 * @param array        $block The block settings and attributes.
		 * @param string       $content The block inner HTML (empty).
		 * @param bool         $is_preview True during AJAX preview.
		 * @param (int|string) $post_id The post ID this block is saved to.
		 */
		public function block_render_callback( $block, $content, $is_preview, $post_id ) {
			$slug          = str_replace( 'acf/', '', $block['name'] );
			$template_path = $this->get_block_template_path( $slug );

			if ( file_exists( get_theme_file_path( $template_path ) ) ) {
				include get_theme_file_path( $template_path );
			}
		}

		/**
		 * Helper function for getting relative path of particular block dir
		 *
		 * @param string $slug Block name.
		 * @return string
		 */
		private function get_block_dir_path( $slug ) {
			return $this->dir . $slug . '/';
		}

		/**
		 * Helper function for getting relative path of particular block template
		 *
		 * @param string $slug Block name.
		 * @return string
		 */
		private function get_block_template_path( $slug ) {
			return $this->get_block_dir_path( $slug ) . 'block' . $this->ext;
		}
	}

	new ACF_Blocks_Loader();

endif;
