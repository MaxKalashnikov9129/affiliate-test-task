<?php
/**
 * The template for displaying all casinos single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

get_header(); ?>

	<div id="primary" class="content-area primary-container">
		<div class="single-casino-page-content">
			<?php get_template_part('template-parts/single-casinos/single-casinos', 'info-block')?>

			<?php get_template_part('template-parts/single-casinos/single-casinos', 'review-block')?>
		</div>
	</div>

<?php
get_footer();
