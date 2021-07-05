<?php
/**
 * Block Name: Sample
 * Description: It is sample ACF Block. Just copy and rename `sample/` into `block/`. Also dont forget to change file data.
 * Category: common
 * Icon: list-view
 * Keywords: sample acf block example
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
?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<pre><?php print_r( $block ); ?></pre>
</section>
