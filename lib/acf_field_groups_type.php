<?php
/**
 * Custom taxonomy for ACF Field Group for better organization in WP dashboard
 *
 * @package Beetroot
 */

if ( ! class_exists( 'ACF_Field_Groups_Type' ) ) :

	/**
	 * ACF_Field_Groups_Type is a class for adding Field Group Type taxonomy for ACF Field Group post type.
	 * It is useful for visual organization of Field Groups in WP dashboard without huge names, prefixes etc.
	 */
	class ACF_Field_Groups_Type {

		/**
		 * Taxonomy slug.
		 *
		 * @var string
		 */
		private $taxonomy = 'acf-fg-type';
		/**
		 * ACF Field Group post type slug.
		 *
		 * @var string
		 */
		private $post_type = 'acf-field-group';
		/**
		 * Default terms which based on ACF Location Rules.
		 *
		 * @var array
		 */
		private $default_terms = [ 'Template', 'Option', 'Post Type', 'Flexible Content', 'Block', 'Taxonomy', 'User', 'Menu Item' ];

		/**
		 * ACF_Field_Groups_Type constructor.
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'field_group_taxonomy' ] );
			add_filter( 'manage_edit-acf-field-group_columns', [ $this, 'field_group_columns' ], 20, 1 );
			add_action( 'manage_acf-field-group_posts_custom_column', [ $this, 'field_group_columns_html' ], 20, 2 );
			add_action( 'restrict_manage_posts', [ $this, 'field_group_filter' ], 10, 2 );
			add_action( 'acf/input/admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		}

		/**
		 * WP hook 'init'. Registers taxonomy and inserts default terms.
		 * https://developer.wordpress.org/reference/hooks/init/
		 */
		public function field_group_taxonomy() {
			register_taxonomy(
				$this->taxonomy,
				$this->post_type,
				[
					'label'             => __( 'Field Group Type' ),
					'labels'            => [
						'separate_items_with_commas' => __( 'Start typing: ' ) . implode( ', ', $this->default_terms ),
					],
					'rewrite'           => false,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
				]
			);

			/**
			 * Insert default terms.
			 */
			foreach ( $this->default_terms as $default_term ) {
				wp_insert_term( $default_term, $this->taxonomy );
			}
		}

		/**
		 * WP filter 'manage_{$screen->id}_columns'.
		 * https://developer.wordpress.org/reference/hooks/manage_screen-id_columns/
		 *
		 * @param array $columns An array of column headers. Default empty.
		 * @return array
		 */
		public function field_group_columns( $columns ) {
			unset( $columns['taxonomy-acf-fg-type'] );
			$new = [];
			foreach ( $columns as $key => $title ) {
				if ( $key === 'acf-fg-status' ) {
					$new[ $this->taxonomy ] = __( 'Type' );
				}
				$new[ $key ] = $title;
			}
			return $new;
		}

		/**
		 * WP hook 'manage_{$post->post_type}_posts_custom_column'.
		 * https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
		 *
		 * @param string $column The name of the column to display.
		 * @param int    $post_id The current post ID.
		 */
		public function field_group_columns_html( $column, $post_id ) {
			switch ( $column ) {
				case $this->taxonomy:
					$terms = get_the_terms( $post_id, $this->taxonomy );
					if ( $terms ) {
						$term_names = wp_list_pluck( $terms, 'name' );
						$terms_str  = implode( ', ', $term_names );
						echo $terms_str;
					}
					break;
			}
		}

		/**
		 * WP hook 'restrict_manage_posts'.
		 * https://developer.wordpress.org/reference/hooks/restrict_manage_posts/
		 *
		 * @param string $post_type The post type slug.
		 * @param string $which The location of the extra table nav markup.
		 */
		public function field_group_filter( $post_type, $which ) {
			if ( $this->post_type !== $post_type ) {
				return;
			}

			$taxonomies = [ $this->taxonomy ];
			foreach ( $taxonomies as $taxonomy_slug ) {
				$taxonomy_obj  = get_taxonomy( $taxonomy_slug );
				$taxonomy_name = $taxonomy_obj->labels->name;
				$terms         = get_terms( $taxonomy_slug );

				echo '<style>#acf-field-group-wrap .tablenav { display: block; } #acf-field-group-wrap .tablenav #filter-by-date, #acf-field-group-wrap .tablenav .bulkactions { display: none; }</style>';
				echo '<select name="' . $taxonomy_slug . '" id="' . $taxonomy_slug . '" class="postform">';
				echo '<option value="">' . $taxonomy_name . '</option>';
				foreach ( $terms as $term ) {
					printf(
						'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
						$term->slug,
						isset( $_GET[ $taxonomy_slug ] ) && ( $_GET[ $taxonomy_slug ] === $term->slug ) ? ' selected="selected"' : '', // phpcs:ignore
						$term->name,
						$term->count
					);
				}
				echo '</select>';
			}
		}

		/**
		 * WP hook 'acf/input/admin_enqueue_scripts'.
		 * Used to enqueue scripts and styles on pages where ACF fields appear.
		 */
		public function admin_enqueue_scripts() {
			$dir_path = 'assets/flexible-content-thumbs/';
			$dir_uri  = get_stylesheet_directory_uri() . '/' . $dir_path;
			$dir      = new DirectoryIterator( locate_template( $dir_path ) );
			$files    = [];
			foreach ( $dir as $file_info ) {
				if ( ! $file_info->isDot() && ! $file_info->isDir() ) {
					$module_name           = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $file_info->getFilename() );
					$files[ $module_name ] = $dir_uri . $file_info->getFilename();
				}
			}
			wp_register_script( 'flexible-content-thumbs-js', get_stylesheet_directory_uri() . '/assets/flexible-content-thumbs/inc/script.js', false, '1.0.0', false );
			wp_localize_script(
				'flexible-content-thumbs-js',
				'flexibleContentThumbs',
				[
					'dirUri' => $dir_uri,
					'files'  => $files,
				]
			);
			wp_enqueue_script( 'flexible-content-thumbs-js' );
			wp_enqueue_style( 'flexible-content-thumbs-css', get_stylesheet_directory_uri() . '/assets/flexible-content-thumbs/inc/style.css', false, '1.0.0' );
		}
	}

	new ACF_Field_Groups_Type();

endif;
