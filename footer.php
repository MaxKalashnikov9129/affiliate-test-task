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
			<div class="col-12 footer-left">
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
			</div>
			<div class="col-6 footer-left">
				<div class="bottom-text">
					<?php the_field( 'footer_left_text', 'option' ); ?>
				</div>
			</div>
			<div class="col-6 footer-right">
				<nav class="nav-footer">
					<div class="footer-menu-wrapper atulidade-footer-menu-wrapper">
						<?php
						if ( has_nav_menu( 'atulidade_footer_menu' ) ) : ?>
							<div class="footer-menu-header">
								<?php _e( 'Atulidade', 'casadeapostas' ); ?>
							</div>
							<?php
							wp_nav_menu(
									[
											'theme_location' => 'atulidade_footer_menu',
											'menu_id'        => 'atulidade-footer-menu',
											'walker'         => new cda_Navwalker(),
									]
							);
						endif;
						?>
					</div>
					<div class="footer-menu-wrapper apostas-footer-menu-wrapper">
						<div class="footer-menu-header">
							<?php _e( 'Apostas', 'casadeapostas' ); ?>
						</div>
						<?php
						if ( has_nav_menu( 'apostas_footer_menu' ) ) :
							wp_nav_menu(
									[
											'theme_location' => 'apostas_footer_menu',
											'menu_id'        => 'apostas-footer-menu',
											'walker'         => new cda_Navwalker(),
									]
							);
						endif;
						?>
					</div>
					<div class="footer-menu-wrapper contato-footer-menu-wrapper">
						<div class="footer-menu-header">
							<?php _e( 'Contato', 'casadeapostas' ); ?>
						</div>
						<?php
						if ( has_nav_menu( 'contato_footer_menu' ) ) :
							wp_nav_menu(
									[
											'theme_location' => 'contato_footer_menu',
											'menu_id'        => 'contato-footer-menu',
											'walker'         => new cda_Navwalker(),
									]
							);
						endif;
						?>
					</div>
				</nav><!-- .nav-primary -->
			</div>
			<div class="offset-6 col-6 footer-bottom">
				<nav>
					<div class="documents-footer-menu">
						<?php
						if ( has_nav_menu( 'atulidade_footer_menu' ) ) : ?>
							<?php
							wp_nav_menu(
									[
											'theme_location' => 'documents_footer_menu',
											'menu_id'        => 'documents-footer-menu',
									]
							);
						endif;
						?>
					</div>
				</nav>
				<div class="copyright">
					&copy; <?php echo date( 'Y' ) . ' ' . __( 'Apostalegal. Todos os direitos reservados.',
									'casadeapostas' ); ?>
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
