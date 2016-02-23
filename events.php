<?php
/**
* Plugin Name: Comins Coch Events Plugin
* Plugin URI: http://www.cominscoch.ceredigion.sch.uk/
* Description: Comins Coch's events 
* Version: 1.0 
* Author: Eliza Kaniewska
* Author URI: elizak.org
* License: GPL12
*/
// prefix functions, because I don't want collisions with default wordpress functions 
// remove backend widgets 
//@param $id, $page, $context
function ek_remove_dashboard_widget() {
	remove_meta_box('dashboard_primary', 'dashboard', 'post_container_1' );
}
add_action('wp_dashboard_setup', 'ek_remove_dashboard_widget');
/*four paramenters add_action( $hook, $function, $priority, $accepted_args);
add_action('a_hook', 'ek_first_function');
add_filter('a_hook', 'ek_first_function');
*/