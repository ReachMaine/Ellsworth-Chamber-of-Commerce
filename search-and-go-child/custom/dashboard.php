<?php /* custom coding for dashboard  */

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

		if($action == 'add_new_listing'){
			$html .= '<li class="'.$active_class.'">';
		}else{
			$html .= '<li>';
		}
		$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-file-add"></span>';
		$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'add_new_listing'), $dashboard_url )) . '">' . esc_html__('Submit New Listing', 'eltd_listing') . '</a>';
		$html .= '</li>';

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
}
/* **** end of function ecc_dashboard_dropdown_menu ****  */



// build the list of events for displaying on dashboard.
function ecc_events_list($userid) {
	$html = "";
	$html .= "made it here. with userid as: ".$userid;
	$html .= '<div class="eltd-user-events-holder">';
	$html .= eltd_listing_dashboard_page_top_area(esc_html__('My Events', 'eltd_listing'), esc_html__($params['subtitle_text'], 'eltd_listing'));

	if (function_exists('add_eventon')) {
		if (!empty($userid)){
			$html .= do_shortcode('[evo_event_manager]');
		}
	}
	
	$html .= '</div>';
	
	return $html;
}

function ecc_dashboard_menu() {
	$html .= '<div class="eltd-listing-dashboard-holder-outer">';
	$html .= eltd_listing_get_dashboard_module_template_part('templates','dashboard-navigation');
	$html .= '<div class="eltd-listing-dashboard-holder-inner '.$action.'">';
	return $html;
}