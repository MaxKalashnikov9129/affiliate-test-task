<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$top_hero_content = get_field( 'top_hero_content_group' );
?>

<?php if ( ! empty( $top_hero_content ) ) : ?>
	<section id="hero-text-block">
		<div class="primary-container">
			<div class="row">
				<div class="col-5 top-hero-header">
					<h1>
						<?php echo $top_hero_content['top_hero_content_header']; ?>
					</h1>
				</div>
				<div class="offset-1 col-6 top-hero-text">
					<?php echo $top_hero_content['top_hero_content_text']; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

