<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$informational_block = get_field( 'informational_block_group' );
?>

<?php
if ( ! empty( $informational_block ) ):
	?>
	<section id="informational-block">
		<div class="informational-block-image"></div>
		<div class="informational-block-wrapper">
			<h2 class="informational-block-header">
				<?php echo $informational_block['informational_block_header']; ?>
			</h2>
			<ul class="informational-sub-blocks">
				<?php
				foreach ( $informational_block['informational_sub_blocks'] as $informational_sub_block ) :
					?>
					<li class="informational-sub-block">
						<div class="informational-sub-block-header">
							<?php echo $informational_sub_block['informational_sub_block_header']; ?>
						</div>
						<div class="informational-sub-block-content">
							<?php echo $informational_sub_block['informational_sub_block_content']; ?>
						</div>
					</li>
				<?php
				endforeach;
				?>
			</ul>
		</div>
	</section>
<?php
endif;
?>
