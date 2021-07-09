<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$casino_info_chart                       = get_field( 'casino_info_chart' );
$payment_gateways_list_max_visible_items = get_field( 'payment_gateways_listing_max_visible_items', 'option' );

?>

<?php if ( ! empty( $casino_info_chart ) ): ?>
	<div class="casino-review-info-chart">
		<ul class="casino-review-info-chart-list">
			<?php
			foreach ( $casino_info_chart as $key => $casino_info_chart_item ) :
				?>
				<li class="casino-review-info-chart-list-item">
					<div class="casino-review-info-chart-list-item-name">
										<span class="chart-list-item-name-icon">
											<?php echo wp_get_attachment_image
											( $casino_info_chart_item['layout_icon'], 'full' ); ?>
										</span>
						<span class="chart-list-item-name-text">
											<?php echo $casino_info_chart_item['layout_name']; ?>
										</span>
					</div>
					<div class="casino-review-info-chart-list-item-content">
						<?php
						if ( is_array( $casino_info_chart_item['layout_content'] ) && array_key_exists
								( 'url', $casino_info_chart_item['layout_content'] ) ):
							?>
							<a class="chart-list-item-content-link" href="<?php echo
							$casino_info_chart_item['layout_content']['url'];
							?>"
							   target="<?php echo $casino_info_chart_item['layout_content']['target'];
							   ?>">
								<?php echo $casino_info_chart_item['layout_content']['title']; ?>
								<span class="link-icon">
									<?php echo wp_get_attachment_image(327, 'full'); ?>
								</span>
							</a>
						<?php
						endif;
						?>

						<?php
						if ( is_array( $casino_info_chart_item['layout_content'][0] ) ):
							?>
							<?php
							foreach (
									$casino_info_chart_item['layout_content'] as
									$casino_info_chart_item_content
							) :
								?>
								<a class="chart-list-item-content-link" href="<?php echo
								$casino_info_chart_item_content['link']['url'];
								?>"
								   target="<?php echo $casino_info_chart_item_content['link']['target'];
								   ?>">
									<?php echo wp_get_attachment_image
									( $casino_info_chart_item_content['icon'], 'full' ); ?>
								</a>
							<?php
							endforeach;
							?>
						<?php
						endif;
						?>

						<?php
						if ( 'payment_gateways_layout' == $casino_info_chart_item['acf_fc_layout'] && ! empty(
								$casino_info_chart_item['layout_content'] ) && ! empty(
										$payment_gateways_list_max_visible_items ) ) :
							?>
							<div class='casino-payment-gateways'>
								<ul class="casino-payment-gateways-list">
									<?php
									foreach ( $casino_info_chart_item['layout_content'] as $key => $payment_gateway ):
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
									<?php if ( count( $casino_info_chart_item['layout_content'] ) > $payment_gateways_list_max_visible_items ) : ?>
										<li class="payment-gateway leftover-gateways">
											<?php $payment_gateways_leftover = array_slice
											( $casino_info_chart_item['layout_content'], ( $payment_gateways_list_max_visible_items + 1 ) ); ?>
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
											+<?php echo( count( $casino_info_chart_item['layout_content'] ) -
														 ( $payment_gateways_list_max_visible_items + 1 ) ); ?>
										</li>
									<?php endif; ?>
								</ul>
							</div>
						<?php
						endif;
						?>

						<?php
						if ( is_string( $casino_info_chart_item['layout_content'] ) ):
							?>
							<div class="chart-list-item-content-text">
								<?php echo $casino_info_chart_item['layout_content'] ?>
							</div>
						<?php
						endif;
						?>
					</div>
				</li>
			<?php
			endforeach;
			?>
		</ul>

	</div>
<?php endif ?>
