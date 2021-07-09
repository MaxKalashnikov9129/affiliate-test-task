<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$age_disclaimer                          = get_field( 'age_disclaimer', 'option' );
$casino_external_link                    = get_field( 'casino_external_link' );
$casino_name          = get_field( 'casino_listing_name' );
$casino_logo          = get_field( 'casino_logo' );

$intro_background_id = ( ! empty( get_the_post_thumbnail() ) ) ? get_the_post_thumbnail() : get_field( 'single_casino_page_review_block_default_background', 'option' );
?>

<div class="casino-review-block-intro"
	 style="background-image: url(<?php echo wp_get_attachment_image_url(
			 $intro_background_id, 'full' ); ?>)">
	<div class="casino-review-block-intro-left">
		<div class="casino-review-block-intro-left-review-date">
			<?php _e( 'Atualizado', 'casadeapostas' ) ?>: <?php echo get_the_modified_date(); ?>
		</div>
		<div class="casino-review-block-intro-left-review-header">
			<?php the_title( '<h1 class="review-header">', '</h1>' ); ?>
		</div>
		<div class='casino-links'>
			<div class="casino-buttons-wrapper">
				<?php if ( ! empty( $casino_external_link ) ) : ?>
					<a href="<?php echo $casino_external_link; ?>" target="_blank"
					   class="casino-site-button">
										<span class="casino-title">
											<?php echo __( 'Abrir', 'casadeapostas' ) . ' ' . trim( $casino_name ) ?>
										</span>
						<span class="arrow-icon">
											<?php echo wp_get_attachment_image( 264, 'full' ); ?>
										</span>
					</a>
				<?php endif; ?>
			</div>
			<?php
			if ( ! empty( $age_disclaimer['age_disclaimer_icon'] ) ):
				?>
				<div class="age-disclaimer">
					<div class="age-disclaimer-icon">
						<?php echo remove_thumbnail_dimensions( wp_get_attachment_image( $age_disclaimer['age_disclaimer_icon'], 'full' ) ); ?>
					</div>
					<div class="age-disclaimer-text">
						<?php echo $age_disclaimer['age_disclaimer_text'] ?>
					</div>
				</div>
			<?php
			endif;
			?>
		</div>
	</div>
	<div class="casino-review-block-intro-right">
		<?php
		if ( ! empty( $casino_status ) ) :
			?>
			<ul class="casino-statuses">
				<li class="casino-status <?php echo $casino_status['value'] ?>">
					<?php _e( $casino_status['label'], 'casadeapostas' ); ?>
				</li>
			</ul>
		<?php
		endif;
		?>
		<div class='casino-logo'>
			<?php
			if ( ! empty( $casino_logo ) ) {
				echo wp_get_attachment_image( $casino_logo, 'full' );
			} ?>
		</div>
		<div class="casino-rating-wrapper">
			<?php
			$casino_rating = get_field( 'casino_rating' );
			$max_rating    = get_field_object( 'casino_rating' );

			if ( ! empty( $casino_rating ) ) :
				$max_rating_count = count( $max_rating['choices'] );

				for ( $i = 0; $i < $max_rating_count; $i ++ ) :
					$badge_type = ( $i < $casino_rating ) ? '' : 'grey';
					?>
					<span class="badge <?php echo $badge_type; ?>"></span>
				<?php
				endfor;
				?>
				<span class="casino-rating">
									<span class="current-rating">
										<?php echo number_format( (int) $casino_rating, 1, ',', '.' );
										?></span>/<?php echo $max_rating_count; ?>
								</span>
			<?php endif; ?>
			<span class="info-icon"></span>
		</div>
		<div class="casino-compare-wrapper">
			<label class="compare-checker">
				<input type="checkbox" class="compare-checker-input">
				<span class="compare-checker-text"><?php esc_html_e( 'Comparar', 'casadeapostas' );
					?></span>
			</label>
		</div>
	</div>
</div>
