<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$info_list_items      = get_field( 'casino_info_rows' );
$casino_status        = get_field( 'casino_status' );
$casino_external_link = get_field( 'casino_external_link' );
$casino_logo          = get_field( 'casino_logo' );
$casino_name          = get_field( 'casino_listing_name' );

?>

<div class="casino-info-block">
	<div class="casino-info">
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
		<div class='casino-secondary-info'>
			<?php
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
		</div>
	</div>
	<div class="casino-anchors">
	</div>
</div>
