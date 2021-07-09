<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );


?>

<div class="casino-review-block">
	<?php
	get_template_part( 'template-parts/single-casinos/casino-review-template-parts/review-intro' );

	get_template_part( 'template-parts/single-casinos/casino-review-template-parts/review-chart' );

	get_template_part( 'template-parts/single-casinos/casino-review-template-parts/review-content' );
	?>
</div>
