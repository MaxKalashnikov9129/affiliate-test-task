<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$args         = array(
		'post_type'      => 'casinos',
		'posts_per_page' => 9,
);
$casinos_list = new WP_Query( $args );

$betting_type_icons = get_field( 'casino_bet_type_icons', 'option' );
$age_disclaimer     = get_field( 'age_disclaimer', 'option' );
?>

<?php
if ( $casinos_list->have_posts() ) :
	?>
	<section id="casinos-block">
		<div class="pre-list-block">
			<div class="age-disclaimer">
				<div class="age-disclaimer-icon">
					<?php echo remove_thumbnail_dimensions( wp_get_attachment_image( $age_disclaimer['age_disclaimer_icon'], 'full' ) ); ?>
				</div>
				<div class="age-disclaimer-text">
					<?php echo $age_disclaimer['age_disclaimer_text'] ?>
				</div>
			</div>
			<div class="sort-controls">
				<div class="sort-controls-label">
					<div class="sort-controls-label-icon">
						<?php echo wp_get_attachment_image( 127, 'full' ); ?>
					</div>
					<div class="sort-controls-label-text">
						<?php _e( 'Sort By', 'casadeapostas' ); ?>:
					</div>
				</div>
				<div class="sort-controls-date">
					<div class="sort-controls-date-icon">
						<?php echo wp_get_attachment_image( 126, 'full' ); ?>
					</div>
					<div class="sort-controls-date-text">
						<?php _e( 'Date', 'casadeapostas' ); ?>
					</div>
				</div>
				<div class="sort-controls-rating">
					<div class="sort-controls-rating-icon">
						<?php echo wp_get_attachment_image( 83, 'full' ); ?>
					</div>
					<div class="sort-controls-date-text">
						<?php _e( 'Rating', 'casadeapostas' ); ?>
					</div>
				</div>
			</div>
		</div>
		<ul class="casino-list">
			<?php
			while ( $casinos_list->have_posts() ) :
				$casinos_list->the_post();
				$current_post_id = get_the_ID();
				$casino_status   = get_field( 'casino_status', $current_post_id );
				$top_casino      = ( $casino_status['value'] == 'top-casino' ) ? 'gold-border' : '';
				?>
				<li class="casino-row <?php echo $top_casino ?>">
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
					<div class='casino-img'>
						<?php the_post_thumbnail(); ?>
					</div>
					<div class='casino-primary-info'>
						<div class="casino-name-wrapper">
							<div class="casino-name">
								<?php the_title(); ?>
							</div>
							<div class="betting-types-wrapper">
								<?php
								$betting_types = get_the_terms( $current_post_id, 'betting_types' );

								if ( ! empty( $betting_types ) ) :
									foreach ( $betting_types as $betting_type ) :
										$icon_id = get_field( 'betting_icon', $betting_type->taxonomy . '_' . $betting_type->term_id );
										?>
										<div class="betting-icon">
											<?php echo wp_get_attachment_image( $icon_id, 'full' ); ?>
										</div>
									<?php
									endforeach;
								endif;
								?>
							</div>
						</div>
						<div class="casino-rating-wrapper">
							<?php
							$casino_rating = get_field( 'casino_rating', get_the_ID() );
							$max_rating    = get_field_object( 'casino_rating', $current_post_id );

							if ( ! empty( $casino_rating ) ) :
								for ( $i = 0; $i < count( $max_rating['choices'] ); $i ++ ) :
									$badge_type = ( $i < $casino_rating ) ? '' : 'grey';
									?>
									<span class="badge <?php echo $badge_type; ?>"></span>
								<?php
								endfor;
								?>
								<span class="casino-rating">
									<?php echo $casino_rating . '/' . count( $max_rating['choices'] ); ?>
								</span>
							<?php endif; ?>
						</div>
						<div class="casino-compare-wrapper">
							<label class="compare-checker">
								<input type="checkbox" class="compare-checker-input">
								<span class="compare-checker-text"><?php esc_html_e( 'Comparar', 'casadeapostas' );
									?></span>
							</label>
						</div>
					</div>
					<div class='casino-secondary-info'>
						<?php
						$info_list_items = get_field( 'casino_info_rows', $current_post_id );

						if ( ! empty( $info_list_items ) ) :
							?>
							<ul class="info-list">
								<?php
								foreach ( $info_list_items as $info_list_item ) :
									?>
									<li class="info-list-item">
										<?php echo esc_html( $info_list_item['casino_info'] ); ?>
									</li>
								<?php
								endforeach;
								?>
							</ul>
						<?php
						endif;
						?>
					</div>
					<div class='casino-payment-gateways'>
						<div class="casino-payment-gateways-header">
							<?php esc_html_e( 'Métodos de pagamento', 'casadeapostas' ); ?>
						</div>
						<?php
						$payment_gateways_list = get_field( 'casino_payment_gateways', $current_post_id );

						if ( ! empty( $payment_gateways_list ) ):
							?>
							<ul class="casino-payment-gateways-list">
								<?php
								foreach ( $payment_gateways_list as $key => $payment_gateway ):
									if ( $key > 5 ) {
										break;
									}
									?>
									<li class="payment-gateway">
										<?php echo remove_thumbnail_dimensions( wp_get_attachment_image(
												$payment_gateway['casino_payment_gateway'], 'full' ) ); ?>
									</li>
								<?php
								endforeach;
								?>
								<?php if ( count( $payment_gateways_list ) > 5 ): ?>
									<li class="payment-gateway leftover-gateways">
										<?php $payment_gateways_leftover = array_slice
										( $payment_gateways_list, 6 ); ?>
										<ul class="payment-gateways-leftover">
											<?php
											foreach (
													$payment_gateways_leftover as
													$payment_gateway_leftover
											) :
												?>
												<li class="payment-gateway-leftover">
													<?php echo remove_thumbnail_dimensions
													( wp_get_attachment_image( $payment_gateway_leftover['casino_payment_gateway'], 'full' ) ); ?>
												</li>
											<?php
											endforeach;
											?>
										</ul>
										+<?php echo( count( $payment_gateways_list ) - 6 ); ?>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class='casino-badge'>
						<?php
						$badge_images = get_field( 'badge_images', 'option' );
						$approved     = get_field( 'casino_approval', $current_post_id );

						if ( ! empty( $badge_images ) ) {
							if ( $approved ) {
								echo remove_thumbnail_dimensions( wp_get_attachment_image( $badge_images['approve_badge_image'], 'full' ) );
							} else {
								echo remove_thumbnail_dimensions( wp_get_attachment_image( $badge_images['deny_badge_image'], 'full' ) );
							}
						}
						?>
					</div>
					<div class='casino-links'>
						<div class="casino-buttons-wrapper">
							<a href="#" target="_blank" class="casino-site-button">
								<span>
									<?php _e( 'Open', 'casadeapostas' ); ?>
								</span>
							</a>
							<a href="<?php the_permalink( $current_post_id ); ?>" target="_blank"
							   class="casino-review-button">
								<span>
									<?php _e( 'Read Review', 'casadeapostas' ); ?>
								</span>
							</a>
						</div>
					</div>
				</li>
			<?php
			endwhile; // End of the loop.
			wp_reset_postdata();
			?>
		</ul>
		<a href="<?php echo get_post_type_archive_link( 'casinos' ); ?>" class="all-casinos-button">
			<span class="all-casinos-button-text">
				<?php _e( 'View all', 'casadeapostas' ); ?>
			</span>
		</a>
	</section>
<?php
endif;
?>
