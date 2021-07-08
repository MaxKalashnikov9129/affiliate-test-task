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
	<div class="call-to-action-wrapper">
		<div class="call-to-action-header">
			<?php echo $call_to_action_block['call_to_action_block_header'] ?>
		</div>
		<div class="call-to-action-sub-header">
			<?php echo $call_to_action_block['call_to_action_block_sub_header'] ?>
		</div>
		<ul class="call-to-action-list">
			<?php foreach (
					$call_to_action_block['call_to_action_block_content'] as
					$call_to_action_sub_block
			) : ?>
				<li class="call-to-action-list-item">
					<div class="call-to-action-list-item-img">
						<?php echo wp_get_attachment_image(
								$call_to_action_sub_block['call_to_action_block_image'], 'full' ); ?>
					</div>
					<div class="call-to-action-list-item-text">
						<?php echo $call_to_action_sub_block['call_to_action_block_text'] ?>
					</div>
					<div class="call-to-action-list-item-link">
						<a href="<?php echo $call_to_action_sub_block['call_to_action_block_link'] ?>"
						   class="call-to-action-list-link">
							<?php echo $call_to_action_sub_block['call_to_action_block_link_text'] ?>
						</a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
