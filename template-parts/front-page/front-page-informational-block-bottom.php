<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$informational_block_bottom = get_field( 'informational_block_bottom_group' );
?>

<section id="informational-block-bottom">
	<div class="primary-container">
		<div class="informational-block-bottom-wrapper">

			<div class="row">
				<div class="offset-6 col-6">
					<?php
					if ( ! empty( $informational_block_bottom['informational_block_bottom_header'] ) ):
						?>
						<div class="informational-block-bottom-header-wrapper">
							<h2 class="informational-block-bottom-header">
								<?php echo $informational_block_bottom['informational_block_bottom_header'] ?>
							</h2>
						</div>
					<?php
					endif;
					?>
					<?php
					if ( ! empty( $informational_block_bottom['informational_block_bottom_sub_header'] ) ):
						?>
						<div class="informational-block-bottom-sub-header">
							<?php echo $informational_block_bottom['informational_block_bottom_sub_header'] ?>
						</div>
					<?php endif; ?>
				</div>
				<?php
				if ( ! empty( $informational_block_bottom['informational_block_bottom_content'] ) ):
					foreach (
							$informational_block_bottom['informational_block_bottom_content'] as
							$informational_sub_block
					) :
						?>
						<div class="col-6 informational-block-bottom-sub-block">
							<div class="informational-block-bottom-sub-block-text">
								<?php echo $informational_sub_block['informational_block_bottom_text']; ?>
							</div>
							<div class="informational-block-bottom-sub-block-link-wrapper">
								<span class="plus-sign"></span>
								<a class="informational-sub-block-link"
								   href="<?php echo $informational_sub_block['informational_block_bottom_link'];
								   ?>">
									<?php _e( 'Ler Mais', 'casadeapostas' ); ?>
								</a>
							</div>
						</div>
					<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</section>
