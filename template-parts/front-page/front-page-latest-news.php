<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 9,
);

$latest_news = new WP_Query( $args );
?>

<?php
if ( $latest_news->have_posts() ) :
	?>
	<section id="latest-news-block">
		<div class="latest-news-section-header-wrapper">
			<h2 class="latest-news-section-header">
				<?php _e( 'Fique informado', 'kasadeapostas' ); ?>
			</h2>
		</div>
		<ul class="latest-news-list">
			<?php
			while ( $latest_news->have_posts() ) :
				$latest_news->the_post();
				?>
				<li class="latest-news">
					<div class="latest-news-img">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="latest-news-info">
						<div class="latest-news-info-date-publish">
							<?php echo get_the_date(); ?>
						</div>
						<div class="latest-news-info-header">
							<?php the_title(); ?>
						</div>
					</div>
					<div class="latest-news-link-wrapper">
						<a class="latest-news-link" href="<?php the_permalink(); ?>" target="_blank">
							<?php _e( 'LER MAIS', 'casadeapostas' ); ?>
						</a>
					</div>
				</li>
			<?php
			endwhile;
			wp_reset_postdata();
			?>
		</ul>
	</section>

<?php
endif;
?>
