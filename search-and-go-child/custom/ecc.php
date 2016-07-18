<?php /* custom coding for theme  */
if (!function_exists('ecc_listing_categories_display')) {
	function ecc_listing_categories_display( $atts ) {
		$atts = shortcode_atts( array(
			'show_all' => true,
		), $atts, 'ecc_categories' );

	// List terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)
	 
	$taxonomy     = 'listing-item-category';
	$orderby      = 'name'; 
	$show_count   = false;
	$pad_counts   = false;
	$hierarchical = true;
	$title        = '';
	 
	$args = array(
	  'taxonomy'     => $taxonomy,
	  'orderby'      => $orderby,
	  'show_count'   => $show_count,
	  'pad_counts'   => $pad_counts,
	  'hierarchical' => $hierarchical,
	  'title_li'     => $title,
	  'echo'		 => 0,  // return, dont output
	);

 		$html_out = "";
		$html_out .= '<ul class="ecc_members_cats">';
	    $html_out .= wp_list_categories( $args );
		$html_out .= "</ul>";
		return $html_out;
	}
}
add_shortcode( 'ecc_categories', 'ecc_listing_categories_display' );

// function to query featured listing items in type & category, etc

if ( ! function_exists( 'ecc_query_feat_listing_items' ) ) {
	/**
	 * Function for getting listing items
	 *
	 * @param array $params
	 *
	 * @return array
	 */
	function ecc_query_feat_listing_items( $params = array() ) {
		global $search_params;
		$search_params = $params;

		$args = array(
			'post_type' => 'listing-item',
			'post_status' => 'publish'
		);

		if ( $params ) {
			extract($params);

			if ( isset( $keywords ) ) {
				$args['s'] = $keywords;
			}
			
			if ( isset($number) ) {
				$args['posts_per_page'] = $number;
			}
			if ( isset($type) ) {
				if($type !== '' && $type !=='all' ){
					$args['meta_key'] = 'eltd_listing_item_type';
					$args['meta_value'] = $type;
				}
			}

			$args['tax_query'] = array(
				'relation' => 'AND'
			);

			if ( isset( $category ) ) {
				if($category !== '' && $category !=='all' ){
					$args['tax_query'][] = array(
						'taxonomy' => 'listing-item-category',
						'field' => 'term_id',
						'terms' => (int)$category
					);
				}
			}

			if ( isset($location) ) {
				if($location !== '' && $location !=='all' ){
					$args['tax_query'][] = array(
						'taxonomy' => 'listing-item-location',
						'field' => 'term_id',
						'terms' => (int)$location
					);
				}
			}

			if ( isset($tag) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'listing-item-tag',
					'field' => 'term_id',
					'terms' => (int)$tag
				);
			}

		}
		echo "ecc args: <pre>"; var_dump($args); echo "</pre>";
		$fquery = new WP_Query($args);
		echo "SQL for  featured listings:  {$fquery->request}";
		//add_filter('search_and_go_elated_multiple_map_variables', 'search_and_go_elated_return_search_map_data');
		return ($fquery);
		//return $fquery;

	}

}

function  ecc_listing_feat_list( $atts) {
		$args = array(
			'listing_feat_list_item_number'	=> '-1',
			'listing_feat_list_tax_number'	=> ''
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		
		//set post args
		//Get listing items which are set as featured for listing featured list shortcode 
		$post_args = array(
			'posts_per_page'   => $listing_feat_list_item_number,
			'meta_key'         => 'eltd_listing_feature_item',
			'meta_value'       => 'yes',
			'post_type'        => 'listing-item',
			'post_status'      => 'publish'
		);
		//set taxonomy args
		$tax_args = array(
			'number' => (int)$listing_feat_list_tax_number,
			'meta_query' => array(
				array(
					'key' => 'featured_taxonomy',
					'value' => 'yes'
				)
			)
		);
		
		
		$featured_tax_array = $featured_post_array = array();		
		
		//get all featured listing items
		$posts_array = get_posts( $post_args );
		$html_out = "";
		$html_out .= '<div class = "eltd-listing-feat-list-holder">';
		$html_out .= "ecc_feat_list here.";
		$html_out .= '</div>';
		return ($html_out);
		
}
add_shortcode( 'ecc_feat_list', 'ecc_listing_feat_list' );