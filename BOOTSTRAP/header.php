<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Beetroot
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
	<div class="header__container">
		<div class="header__row">
			<a class="header__brand brand" href="<?php echo esc_url( home_url() ); ?>">
				<?php if ( get_header_image() ) : ?>
					<img class="brand__img" src="<?php echo( get_header_image() ); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
					<?php
				else :
					bloginfo( 'name' );
				endif;
				?>
			</a><!-- /.brand -->

			<nav class="nav-primary header__nav navbar navbar-expand-lg navbar-light bg-light">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primaryNavBar"
						aria-controls="primaryNavBar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<?php
				if ( has_nav_menu( 'primary' ) ) :
					wp_nav_menu(
						[
							'theme_location'  => 'primary',
							'menu_id'         => 'primary-menu',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'primaryNavBar',
							'menu_class'      => 'navbar-nav',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'walker'          => new Beetroot_Navwalker(),
						]
					);
				endif;
				?>
			</nav><!-- .nav-primary -->

		</div>
		<!-- /.header__row -->
	</div>
	<!-- /.header__container -->
</header><!-- .banner -->
<main id="content" class="site-content">
