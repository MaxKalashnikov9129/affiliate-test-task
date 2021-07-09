<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$faq_block = get_field( 'frequently_asked_question_group' );

?>

<section id="faq-block">
	<div class="primary-container">
		<div class="faq-block-wrapper">

			<div class="faq-block-header-wrapper">
				<h2 class="faq-block-header">
					<?php _e( 'Dúvidas frequentes', 'casadeapostas' ); ?>
				</h2>
			</div>
			<ul class="faq-block-accordion" id="faq-accordion">
				<?php
				if ( ! empty( $faq_block['frequently_asked_questions'] ) ) :
					foreach ( $faq_block['frequently_asked_questions'] as $key => $faq_item ) :
						?>
						<li class="faq-block-card">
							<div class="faq-block-card-header" id="heading-<?php echo $key ?>">
								<div class="mb-0 d-flex justify-content-between align-items-center">
									<button class="btn btn-link faq-block-card-item-header" type="button"
											data-toggle="collapse"
											data-target="#faq-collapse-<?php echo $key ?>"
											aria-expanded="false" aria-controls="faq-collapse-<?php echo $key ?>">
										<span>
											<?php echo strip_tags( $faq_item['frequently_asked_question_header'] ) ?>
										</span>
										<span class="faq-block-card-item-icon plus-sign"></span>
									</button>
								</div>
							</div>
							<div id="faq-collapse-<?php echo $key ?>" class="collapse"
								 aria-labelledby="heading-<?php echo $key ?>"
								 data-parent="#faq-accordion">
								<div class="card-body">
									<?php echo $faq_item['frequently_asked_question_content'] ?>
								</div>
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
