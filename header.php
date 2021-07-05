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
<header class="banner">
	<div class="container">
		<a class="brand" href="<?php esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<nav class="nav-primary">
			<?php
			if ( has_nav_menu( 'primary' ) ) :
				wp_nav_menu(
					[
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'walker'         => new beetroot_navwalker(),
					]
				);
			endif;
			?>
		</nav><!-- .nav-primary -->
	</div><!-- .container -->
</header><!-- .banner -->
<div id="content" class="site-content">
