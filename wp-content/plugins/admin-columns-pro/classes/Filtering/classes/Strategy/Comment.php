<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class ACP_Filtering_Strategy_Comment extends ACP_Filtering_Strategy {

	/**
	 * Handle filter request for single values
	 *
	 * @since 3.5
	 *
	 * @param WP_Comment_Query $comment_query
	 */
	public function handle_filter_requests( $comment_query ) {
		$comment_query->query_vars = $this->model->get_filtering_vars( $comment_query->query_vars );
	}

	/**
	 * @since 3.5
	 */
	public function get_values_by_db_field( $field ) {
		global $wpdb;

		$results = $wpdb->get_col( "
			SELECT " . sanitize_key( $field ) . "
			FROM {$wpdb->comments} AS c
			INNER JOIN {$wpdb->posts} ps ON ps.ID = c.comment_post_ID
			WHERE c." . sanitize_key( $field ) . " <> '';
		" );

		if ( ! $results ) {
			return array();
		}

		return $results;
	}

}
