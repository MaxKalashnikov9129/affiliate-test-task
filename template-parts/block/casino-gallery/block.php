<?php
/**
 * Block Name: Casino Gallery
 * Description: Casino Gallery block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: gallery casino-gallery acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Beetroot
 *
 * @var array $block
 */

$slug           = str_replace( 'acf/', '', $block['name'] );
$block_id       = $slug . '-' . $block['id'];
$align_class    = $block['align'] ? 'align' . $block['align'] : '';
$custom_class   = isset( $block['className'] ) ? $block['className'] : '';
$casino_gallery = get_field( 'casino_gallery', get_queried_object() );
?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
>
	<ul class="casino-gallery-list">
		<?php foreach ( $casino_gallery as $casino_gallery_item ): ?>
			<li class="casino-gallery-item">
				<?php echo wp_get_attachment_image( $casino_gallery_item, 'full' ); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
