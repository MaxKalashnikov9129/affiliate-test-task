<?php
/**
 * Block Name: Hero
 * Description: Hero banner block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: hero acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Beetroot
 *
 * @var array $block
 */

$slug         = str_replace( 'acf/', '', $block['name'] );
$block_id     = $slug . '-' . $block['id'];
$align_class  = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';
$bg_image     = get_field( 'bg_image' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
	style="background-image: <?php echo $bg_image; ?>"
>
	<h2 class="caption"><?php the_field( 'hero_caption' ); ?></h2>
</section>
