<?php

/*** Child Theme Function  ***/

function search_and_go_elated_child_theme_enqueue_scripts() {
	wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
}
add_action('wp_enqueue_scripts', 'search_and_go_elated_child_theme_enqueue_scripts', 11);

require_once(get_stylesheet_directory().'/custom/ecc.php');
require_once(get_stylesheet_directory().'/custom/language.php');
//require_once(get_stylesheet_directory().'/custom/login-button-widget.php'); // dont thing we will be doing it this way.
require_once(get_stylesheet_directory().'/custom/dashboard.php');
require_once(get_stylesheet_directory().'/custom/woocommerce.php');
require_once(get_stylesheet_directory().'/custom/searchandgo.php');
/*****  change the login screen logo ****/
	function my_login_logo() { ?>
		<style type="text/css">
			body.login div#login h1 a {
				padding-bottom: 30px;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );

	add_action( 'login_footer', 'reach_login_branding' );
	function reach_login_branding() {
		$outstring = "";
		$outstring .= '<p style="text-align:center;">';
		$outstring .= 	'<img src="'.get_stylesheet_directory_uri().'/images/reach-favicon.png'.'">';
		$outstring .= 		'R<i style="color: #f58220">EA</i>CH Maine';
		$outstring .= '</p>';
		echo $outstring;
	}

	//add_action('wp_enqueue_scripts', 'reach_scripts', 100); didnt work.
	function reach_scripts() {
			wp_deregister_script( 'eltd-ui-admin' ); //remove offending js for events conflict -
	}

	remove_filter('pre_term_description', 'wp_filter_kses');

	// listing plugins is disabling admin bar for everyone except admin.
	// Trying to enable it for editors
	remove_action( 'after_setup_theme', 'eltd_listing_remove_admin_toolbar');
	add_action('after_setup_theme', 'ecc_admin_bar');
	function ecc_admin_bar() {
		if ( !current_user_can('administrator') && (!current_user_can('editor')) && !is_admin() ) {
			show_admin_bar(false);
		}
	}

	//remove_action('wp_ajax_eltd_listing_get_listing_fields', 'eltd_listing_get_listing_fields' );
