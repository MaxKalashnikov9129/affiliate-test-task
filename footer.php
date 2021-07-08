<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Beetroot
 */

?>

</main><!-- #content -->

<footer id="footer-container" class="site-footer footer" role="contentinfo">
	<div class="footer__container">
		<div class="footer__row footer-row">
			<div class="col-6 footer-left">
				<a class="footer__brand brand" href="<?php echo esc_url( home_url() ); ?>">
					<?php if ( get_header_image() ) : ?>
						<img class="brand__img" src="<?php echo( get_header_image() ); ?>"
							 alt="<?php bloginfo( 'name' ); ?>"/>
					<?php
					else :
						bloginfo( 'name' );
					endif;
					?>
				</a><!-- /.brand -->
				<div class="bottom-text">
					<?php the_field( 'footer_left_text', 'option' ); ?>
				</div>
			</div>
			<div class="col-6 footer-right">
				<nav class="nav-footer">
					<?php
					if ( has_nav_menu( 'footer_menu' ) ) :
						wp_nav_menu(
								[
										'theme_location' => 'footer_menu',
										'menu_id'        => 'footer-menu',
										'walker'         => new cda_Navwalker(),
								]
						);
					endif;
					?>
				</nav><!-- .nav-primary -->
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
