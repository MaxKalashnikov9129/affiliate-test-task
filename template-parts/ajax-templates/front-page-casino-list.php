<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );


$casinos_list = new WP_Query( $args['request-arguments'] );

?>

<?php
if ( $casinos_list->have_posts() ) :
	while ( $casinos_list->have_posts() ) :
		$casinos_list->the_post();

		$current_post_id = get_the_ID();

		$casino_status = get_field( 'casino_status' );
		$top_casino    = '';

		if ( ! empty( $casino_status ) && $casino_status['value'] == 'top-casino' ) {
			$top_casino = 'golden-border';
		}
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
			<div class='casino-logo'>
				<?php
				$casino_logo = get_field( 'casino_logo' );

				if ( ! empty( $casino_logo ) ) {
					echo wp_get_attachment_image( $casino_logo, 'full' );
				} ?>
			</div>
			<div class='casino-primary-info'>
				<div class="casino-name-wrapper">
					<div class="casino-name">
						<?php
						$casino_name = get_field( 'casino_listing_name' );

						if ( ! empty( $casino_name ) ) :
							echo trim( $casino_name );
						endif;
						?>
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
									<?php echo $casino_rating . '/' . $max_rating_count; ?>
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
				$info_list_items = get_field( 'casino_info_rows' );

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

			<?php
			$casino_info           = get_field( 'casino_info_chart' );
			$payment_gateways_list = '';

			if ( ! empty( $casino_info ) ) {

				foreach ( $casino_info as $casino_info_item ) {
					if ( 'payment_gateways_layout' == $casino_info_item['acf_fc_layout'] ) {
						$payment_gateways_list = $casino_info_item;
					} else {
						continue;
					}
				}
			}

			if ( ! empty( $payment_gateways_list ) ) :

				$payment_gateways_list_max_visible_items = get_field( 'payment_gateways_listing_max_visible_items',
						'option' );
				?>
				<div class='casino-payment-gateways'>
					<div class="casino-payment-gateways-header">
						<?php esc_html_e( 'Métodos de pagamento', 'casadeapostas' ); ?>
					</div>
					<?php
					if ( empty( $payment_gateways_list_max_visible_items ) ):
						?>
						<div class="warning-message" style="color:red; text-transform: uppercase; font-weight:
							bold;">
							<?php _e( 'Set Max Visible Number of Payment Gateways, to finish configuration', 'casadeapostas' ); ?>
						</div>
					<?php
					endif;
					?>
					<?php
					if ( ! empty( $payment_gateways_list ) && ! empty( $payment_gateways_list_max_visible_items ) ) :
						?>

						<ul class="casino-payment-gateways-list">
							<?php
							foreach ( $payment_gateways_list['layout_content'] as $key => $payment_gateway ):
								if ( $key > $payment_gateways_list_max_visible_items ) {
									break;
								}
								?>
								<li class="payment-gateway">
									<?php echo wp_get_attachment_image(
											$payment_gateway, 'full' ); ?>
								</li>
							<?php
							endforeach;
							?>
							<?php if ( count( $payment_gateways_list['layout_content'] ) > $payment_gateways_list_max_visible_items ) : ?>
								<li class="payment-gateway leftover-gateways">
									<?php $payment_gateways_leftover = array_slice
									( $payment_gateways_list['layout_content'], ( $payment_gateways_list_max_visible_items + 1 ) ); ?>
									<ul class="payment-gateways-leftover">
										<?php
										foreach (
												$payment_gateways_leftover as
												$payment_gateway_leftover
										) :
											?>
											<li class="payment-gateway-leftover">
												<?php echo wp_get_attachment_image( $payment_gateway_leftover, 'full' ); ?>
											</li>
										<?php
										endforeach;
										?>
									</ul>
									+<?php echo( count( $payment_gateways_list['layout_content'] ) -
												 ( $payment_gateways_list_max_visible_items + 1 ) ); ?>
								</li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class='casino-badge'>
				<?php
				$badge_images = get_field( 'badge_images', 'option' );
				$approved     = get_field( 'casino_approval' );

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
					<?php
					$casino_external_link = get_field( 'casino_external_link' );

					if ( ! empty( $casino_external_link ) ) :
						?>
						<a href="<?php echo $casino_external_link; ?>" target="_blank"
						   class="casino-site-button">
								<span>
									<?php _e( 'Open', 'casadeapostas' ); ?>
								</span>
						</a>
					<?php
					endif;
					?>
					<a href="<?php the_permalink(); ?>" target="_blank"
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
<?php
endif;
?>
