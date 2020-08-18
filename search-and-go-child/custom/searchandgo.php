<?php /* functions for searchandgo theme  */


remove_action('search_and_go_elated_meta_boxes_map', 'search_and_go_elated_map_listing_package_settings');
add_action('search_and_go_elated_meta_boxes_map', 'reach_listing_package_settings');

if(!function_exists('reach_listing_package_settings')) {
    function reach_listing_package_settings() {
      return "<p>Yep. here. </p>";
    }
  }
