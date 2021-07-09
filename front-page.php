<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );


get_header(); ?>

	<div id="primary" class="content-area">
		<?php
		get_template_part( 'template-parts/front-page/front-page', 'hero-text-block' );

		get_template_part( 'template-parts/front-page/front-page', 'casino-list' );

		get_template_part( 'template-parts/front-page/front-page', 'informational-block' );

		get_template_part( 'template-parts/front-page/front-page', 'latest-news' );

		get_template_part( 'template-parts/front-page/front-page', 'call-to-action' );

		get_template_part( 'template-parts/front-page/front-page', 'informational-block-bottom' );

		get_template_part( 'template-parts/front-page/front-page', 'faq-block' );
		?>
	</div>
<?php
get_sidebar();
get_footer();
