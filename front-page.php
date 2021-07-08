<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$top_hero_content = get_field( 'top_hero_content_group' );

get_header(); ?>

	<div id="primary" class="content-area primary-container">
		<?php if ( ! empty( $top_hero_content ) ) : ?>
			<section id="hero-text">
				<div class="row">
					<div class="col-5 top-hero-header">
						<h1>
							<?php echo $top_hero_content['top_hero_content_header']; ?>
						</h1>
					</div>
					<div class="offset-1 col-6 top-hero-text">
						<?php echo $top_hero_content['top_hero_content_text']; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php
		get_template_part( 'template-parts/front-page/front-page', 'casino-list' );

		get_template_part( 'template-parts/front-page/front-page', 'informational-block' );

		get_template_part( 'template-parts/front-page/front-page', 'latest-news' );

		get_template_part( 'template-parts/front-page/front-page', 'call-to-action' );

		get_template_part( 'template-parts/front-page/front-page', 'informational-block-bottom' );

		$faq_block = get_field( 'frequently_asked_question_group' );
		?>

		<section id="faq-block">
			<div class="faq-block-wrapper">
				<div class="faq-block-header-wrapper">
					<h2 class="faq-block-header">
						<?php _e( 'Dúvidas frequentes', 'casadeapostas' ); ?>
					</h2>
				</div>
				<ul class="faq-block-accordion" id="faq-accordion">
					<?php foreach ( $faq_block['frequently_asked_questions'] as $key => $faq_item ) : ?>
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
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
