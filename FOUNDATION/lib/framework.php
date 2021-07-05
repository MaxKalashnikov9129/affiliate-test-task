<?php
/**
 * Various functions required for beetroot-foundation to work properly
 *
 * @package Beetroot
 */

/*
 * Table of contests:
 * 1 - WP Content Width
 * 2 - Menu navigation walker
 * 3 - Pagination
 * 4 - Comments tree
 */

// 1 - WP Content Width: {@link https://codex.wordpress.org/Content_Width}
if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}

/**
 * 2 - Menu navigation walker
 * Learn more about walkers: @link {https://codex.wordpress.org/Class_Reference/Walker}
 *
 *                           @link {https://code.tutsplus.com/tutorials/understanding-the-walker-class--wp-25401}
 */
if ( ! class_exists( 'Beetroot_Navwalker' ) ) :
	/**
	 * Beetroot_Navwalker
	 */
	class Beetroot_Navwalker extends Walker_Nav_Menu {
		/**
		 * start_lvl
		 *
		 * @param string  $output output
		 * @param integer $depth depth
		 * @param array   $args args
		 * @return void
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul class=\"dropdown menu vertical\" data-toggle>\n";
		}
	}
	if ( ! class_exists( 'Beetroot_Mobile_Navwalker' ) ) :
		/**
		 * Beetroot_Mobile_Navwalker
		 */
		class Beetroot_Mobile_Navwalker extends Walker_Nav_Menu {
			/**
			 * start_lvl
			 *
			 * @param string  $output output
			 * @param integer $depth depth
			 * @param array   $args args
			 * @return void
			 */
			public function start_lvl( &$output, $depth = 0, $args = array() ) {
				$indent  = str_repeat( "\t", $depth );
				$output .= "\n$indent<ul class=\"vertical nested menu\">\n";
			}
		}
	endif;
endif;
/**
 * A fallback when no navigation is selected by default.
 */
if ( ! function_exists( 'beetroot_menu_fallback' ) ) :
	/**
	 * beetroot_menu_fallback
	 *
	 * @return void
	 */
	function beetroot_menu_fallback() {
		echo '<div class="alert-box secondary">';
		printf(
			/* translators:  %1$s: Link to Menus, %2$s: Link to Customize  */
			__( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'wp_dev' ),
			sprintf(
				/* translators:  %s: Menus  */
				__( '<a href="%s">Menus</a>', 'wp_dev' ),
				get_admin_url( get_current_blog_id(), 'nav-menus.php' )
			),
			sprintf(
				/* translators:  %s: Customize  */
				__( '<a href="%s">Customize</a>', 'wp_dev' ),
				get_admin_url( get_current_blog_id(), 'customize.php' )
			)
		);
		echo '</div>';
	}
endif;
// Add Foundation 'active' class for the current menu item.
if ( ! function_exists( 'beetroot_active_nav_class' ) ) :
	/**
	 * beetroot_active_nav_class
	 *
	 * @param array $classes classes
	 * @param mixed $item item
	 * @return array $classes classes
	 */
	function beetroot_active_nav_class( $classes, $item ) {
		if ( 1 === $item->current || true === $item->current_item_ancestor ) {
			$classes[] = 'active';
		}
		return $classes;
	}
	add_filter( 'nav_menu_css_class', 'beetroot_active_nav_class', 10, 2 );
endif;

// 3 - Pagination: {@link https://codex.wordpress.org/Pagination}
if ( ! function_exists( 'beetroot_pagination' ) ) :
	/**
	 * beetroot_pagination
	 *
	 * @return void
	 */
	function beetroot_pagination() {
		global $wp_query;
		$big = 999999999; // This needs to be an unlikely integer
		// For more options and info view the docs for paginate_links()
		// @link http://codex.wordpress.org/Function_Reference/paginate_links
		$paginate_links = paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $wp_query->max_num_pages,
				'mid_size'  => 5,
				'prev_next' => true,
				'prev_text' => __( '&laquo;', 'wp_dev' ),
				'next_text' => __( '&raquo;', 'wp_dev' ),
				'type'      => 'list',
			)
		);
		$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination'>", $paginate_links );
		$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
		$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'><a href='#'>", $paginate_links );
		$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
		$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
		$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
		// Display the pagination if more than one page is found.
		if ( $paginate_links ) {
			echo '<div class="pagination-centered">';
			echo $paginate_links;
			echo '</div><!--// end .pagination -->';
		}
	}
endif;

/**
 * Use the active class of ZURB Foundation on wp_list_pages output.
 * From required+ Foundation http://themes.required.ch.
 */
if ( ! function_exists( 'beetroot_active_list_pages_class' ) ) :
	/**
	 * beetroot_active_list_pages_class
	 *
	 * @param mixed $input input
	 */
	function beetroot_active_list_pages_class( $input ) {
		$pattern = '/current_page_item/';
		$replace = 'current_page_item active';
		$output  = preg_replace( $pattern, $replace, $input );
		return $output;
	}
	add_filter( 'wp_list_pages', 'beetroot_active_list_pages_class', 10, 2 );
endif;

// 4 - Comments tree: @link {https://codex.wordpress.org/Function_Reference/Walker_Comment}
if ( ! class_exists( 'Beetroot_Comments' ) ) :
	/**
	 * Beetroot_Comments
	 */
	class Beetroot_Comments extends Walker_Comment {
		/**
		 * Tree type.
		 *
		 * @var string
		 */
		public $tree_type = 'comment';
		/**
		 * DB field.
		 *
		 * @var array
		 */
		public $db_fields = [
			'parent' => 'comment_parent',
			'id'     => 'comment_ID',
		];
		/**
		 * You'll have to use this if you plan to get to the top of the comments list, as
		 * start_lvl() only goes as high as 1 deep nested comments
		 */
		public function __construct() { ?>
			<h3><?php comments_number( __( 'No Responses to', 'wp_dev' ), __( 'One Response to', 'wp_dev' ), __( '% Responses to', 'wp_dev' ) ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
			<ol class="comment-list">
			<?php
		}

		/**
		 * Starts the list before the CHILD elements are added.
		 *
		 * @param string  $output output
		 * @param integer $depth depth
		 * @param array   $args args
		 * @return void
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1;
			?>

		<ul class="children">
			<?php
		}

		/**
		 * Ends the children list of after the elements are added.
		 *
		 * @param string  $output output
		 * @param integer $depth depth
		 * @param array   $args args
		 * @return void
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1;
			?>

		</ul><!-- /.children -->

			<?php
		}

		/**
		 * START_EL
		 *
		 * @param string  $output output
		 * @param mixed   $comment comment
		 * @param integer $depth depth
		 * @param array   $args args
		 * @param integer $id id
		 * @return void
		 */
		public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment']       = $comment;
			$parent_class             = ( empty( $args['has_children'] ) ? '' : 'parent' );
			?>

		<li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID(); ?>">
		<article id="comment-body-<?php comment_ID(); ?>" class="comment-body">

			<header class="comment-author">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<div class="author-meta vcard author">
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
					<time datetime="<?php echo comment_date( 'c' ); ?>">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php printf( '%1$s', get_comment_date(), get_comment_time() ); ?>
						</a>
					</time>
				</div><!-- /.comment-author -->
			</header>

			<section id="comment-content-<?php comment_ID(); ?>" class="comment">
				<?php if ( ! $comment->comment_approved ) : ?>
				<div class="notice">
					<p class="bottom"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
				</div>
				<?php else : comment_text(); ?>
				<?php endif; ?>
			</section><!-- /.comment-content -->

			<div class="comment-meta comment-meta-data hide">
				<a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ); ?>"><?php comment_date(); ?> at <?php comment_time(); ?></a> <?php edit_comment_link( '(Edit)' ); ?>
			</div><!-- /.comment-meta -->

			<div class="reply">
					<?php
					$reply_args = array(
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					);
					comment_reply_link( array_merge( $args, $reply_args ) );
					?>
			</div><!-- /.reply -->
		</article><!-- /.comment-body -->

			<?php
		}

		/**
		 * end_el
		 *
		 * @param string  $output output
		 * @param mixed   $comment comment
		 * @param integer $depth depth
		 * @param array   $args args
		 * @return void
		 */
		public function end_el( & $output, $comment, $depth = 0, $args = array() ) {
			?>

		</li><!-- /#comment-' . get_comment_ID() . ' -->

			<?php
		}
		/** DESTRUCTOR */
		public function __destruct() {
			?>

			</ol><!-- /#comment-list -->

			<?php
		}
	}
endif;
