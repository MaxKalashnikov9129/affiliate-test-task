<?php
/**
 * Front Page template file
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

?>

<div class="casino-review-block-content">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			the_content();
		}
	}
	?>
</div>
