<?php
/**
 * List of ajax actions to perform on request
 *
 * @package Beetroot
 */

defined( 'ABSPATH' ) || die( 'Iwanu ga hana' );

ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );
error_reporting( E_ALL );
/**
 * Action to sort list of casinos on front-page
 */
add_action( 'wp_ajax_sort_casino_list', 'cda_sort_casino_list' );
add_action( 'wp_ajax_nopriv_sort_casino_list', 'cda_sort_casino_list' );

if ( ! function_exists( 'cda_sort_casino_list' ) ) {
	function cda_sort_casino_list() {
		$sort_column = esc_sql( $_GET['sortColumn'] );
		$sort_order  = esc_sql( $_GET['sortOrder'] );

		if ( ! empty( $sort_column ) ) {
			$args = array(
				'post_type'      => 'casinos',
				'posts_per_page' => 9,
			);

			if ( 'modified' == $sort_column ) {
				$args['orderby'] = $sort_column;
				$args['order']   = $sort_order;
			}

			if ( 'casino_rating' == $sort_column ) {
				$args['meta_key'] = $sort_column;
				$args['orderby']  = 'meta_value';
				$args['order']    = $sort_order;
			}

			$request_args = array( 'request-arguments' => $args );
		}


		$result = array(
			'casino_list_items' => '',
			'code'              => '',
			'message'           => '',
		);

		ob_start();
		get_template_part( 'template-parts/ajax-templates/front-page', 'casino-list', $request_args );
		$result['casino_list_items'] = ob_get_clean();

		if ( ! empty( $result ) ) {
			$result['code'] = 200;
			wp_send_json_success( $result );
		} else {
			$result['message'] = __( 'Sorry, there\'s noting to sort., casadeapostas' );
			$result['code']    = 204;

			wp_send_json_success( $result );
		}


	}
}
