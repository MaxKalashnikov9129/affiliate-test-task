<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$call_to_action_block = get_field( 'call_to_action_block_group' );

?>

<section id="call-to-action-block">
	<div class="primary-container">
		<div class="call-to-action-wrapper">
			<?php
			if ( ! empty( $call_to_action_block['call_to_action_block_header'] ) ) :
				?>
				<div class="call-to-action-header-wrapper">
					<h2 class="call-to-action-header">
						<?php echo $call_to_action_block['call_to_action_block_header'] ?>
					</h2>
				</div>
			<?php
			endif;
			?>
			<?php
			if ( ! empty( $call_to_action_block['call_to_action_block_sub_header'] ) ) :
				?>
				<div class="call-to-action-sub-header">
					<?php echo $call_to_action_block['call_to_action_block_sub_header'] ?>
				</div>
			<?php
			endif;
			?>
			<ul class="call-to-action-list">
				<?php
				if ( ! empty( $call_to_action_block['call_to_action_block_content'] ) ) :
					foreach (
							$call_to_action_block['call_to_action_block_content'] as
							$call_to_action_sub_block
					) :
						?>
						<li class="call-to-action-list-item">
							<div class="call-to-action-list-item-img">
								<?php echo wp_get_attachment_image(
										$call_to_action_sub_block['call_to_action_block_image'], 'full' ); ?>
							</div>
							<div class="call-to-action-list-item-text">
								<?php echo $call_to_action_sub_block['call_to_action_block_text'] ?>
							</div>
							<div class="call-to-action-list-item-link">
								<a href="<?php echo $call_to_action_sub_block['call_to_action_block_link']['url'] ?>"
								   class="call-to-action-list-link"
								   target="$call_to_action_sub_block['call_to_action_block_link']['target']">
									<?php echo $call_to_action_sub_block['call_to_action_block_link']['title'] ?>
								</a>
							</div>
						</li>
					<?php
					endforeach;
				endif;
				?>
			</ul>
		</div>
	</div>
</section>
