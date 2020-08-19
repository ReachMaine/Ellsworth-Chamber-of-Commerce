<?php /* custom coding for dashboard  */
/*
*  19Aug16 zig - take out add new listing from menu & dashboard
*/

/***** fix the menu for the dashboard.  ***/
	remove_action( 'search_and_go_elated_dashboard_menu_items', 'eltd_listing_generate_dashboard_menu_items' );
	remove_action( 'search_and_go_elated_login_dropdown_menu_items', 'eltd_listing_generate_dashboard_menu_items' );
	add_action ('search_and_go_elated_login_dropdown_menu_items','ecc_dashboard_dropdown_menu');
	add_action( 'search_and_go_elated_dashboard_menu_items', 'ecc_dashboard_dropdown_menu' );
	function ecc_dashboard_dropdown_menu() {
		// to decide if we are the active class....
		$dashboard_url = eltd_listing_get_dashboard_page_url();
		$dashboard_events_url = esc_url(get_bloginfo('url').'/dashboard-events');
		$action = '';
		$active_class = 'eltd-listing-active-item';

			if(isset($_GET[ "user-action" ])){
				$action = $_GET[ "user-action" ];
			}
			$html = '';

			if($action == 'profile' || $action == ''){
				$html .= '<li class="'.$active_class.'">';
			}else{
				$html .= '<li>';
			}
			$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-user"></span>';
			$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'profile'), $dashboard_url )) . '">' . esc_html__('My Profile', 'eltd_listing') . '</a>';
			$html .= '</li>';

			if($action == 'edit_profile'){
				$html .= '<li class="'.$active_class.'">';
			}else{
				$html .= '<li>';
			}
			$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-pencil"></span>';
			$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'edit_profile'), $dashboard_url )) . '">' . esc_html__('Edit Profile', 'eltd_listing') . '</a>';
			$html .= '</li>';

			/* if($action == 'add_new_listing'){
				$html .= '<li class="'.$active_class.'">';
			}else{
				$html .= '<li>';
			}
			$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-file-add"></span>';
			$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'add_new_listing'), $dashboard_url )) . '">' . esc_html__('Submit New Listing', 'eltd_listing') . '</a>';
			$html .= '</li>'; */

			if($action == 'listings'){
				$html .= '<li class="'.$active_class.'">';
			}else{
				$html .= '<li>';
			}
			$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-layers"></span>';
			$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'listings'), $dashboard_url )) . '">' . esc_html__('My Listings', 'eltd_listing') . '</a>';
			$html .= '</li>';

			// Events
			if($action == 'events'){
				$html .= '<li class="'.$active_class.'">';
			}else{
				$html .= '<li>';
			}
			$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-calendar-full"></span>';
			$html .= '<a href="'.$dashboard_events_url. '">' . esc_html__('My Events', 'eltd_listing') . '</a>';
			$html .= '</li>';
			echo $html;
	}    // end of function ecc_dashboard_dropdown_menu

	function ecc_dashboard_menu() {
		$html .= '<div class="eltd-listing-dashboard-holder-outer">';
		$html .= eltd_listing_get_dashboard_module_template_part('templates','dashboard-navigation');
		$html .= '<div class="eltd-listing-dashboard-holder-inner '.$action.'">';
		return $html;
	}
/***** fix the menu for the dashboard.  ***/

/**** modify the edit listings ****/
if(!function_exists( 'eltd_listing_edit_listing_form' )) {
	function eltd_listing_edit_listing_form($user_id) {
		$html = "here.";
		return $html;
	}
}

if ( !function_exists( 'reach_listing_get_listing_fields' ) ) {
	/**
	 * Ajax call, no longer
	 * Function that returns specific listing item fields
	 */
	function reach_listing_get_listing_fields($in_listingTypeID){
		if(isset($in_listingTypeID)){

			$params = array();
			$html = '';
			if ( eltd_listing_theme_installed() ) {
				$predefined_fields = search_and_go_elated_check_predefined_fields($in_listingTypeID);
				$params['working_days'] = search_and_go_elated_generate_day_array();
				$params['social'] = search_and_go_elated_generate_listing_social_icons_array();
			} else {
				$predefined_fields = array();
			}

			if(isset($in_listingTypeID)) {
				$params['listing_ID'] = $in_listingTypeID;
			}else {
				$params['listing_ID'] = -1;
			}

			foreach($predefined_fields as $predefined_field=>$value) {
				$param_field =  str_replace('eltd_listing_type_', '', $predefined_field);
				$params[$param_field] = $value;
			}
			$params['media_icon_multiple_images_params'] = array(
				'icon_pack' => 'linea_icons',
				'linea_icon' => 'icon-basic-picture-multiple',
				'custom_size' => '40',
				'icon_color'  => '#a7a7a7'
			);
			$params['listing_type_id'] = $in_listingTypeID;
			$params['category_meta_query'] = search_and_go_elated_get_type_category_meta_params($_POST['listingTypeId']);

			$params['category_defaults'] = array();
			$params['tags_defaults'] = array();
			if($params['listing_ID'] !== '-1'){
				$params['category_defaults'] = search_and_go_elated_get_taxonomy_defaults($params['listing_ID'], 'listing-item-category');
				$params['tags_defaults'] = search_and_go_elated_get_taxonomy_defaults($params['listing_ID'], 'listing-item-tag');
			}

			$html .= eltd_listing_get_dashboard_module_template_part('templates','listing-type-fields', '', $params);
			echo $html;
			eltd_listing_get_custom_listing_fields($in_listingTypeID, $params['listing_ID']);
		} // isset $in_listingTypeID

	}


}
