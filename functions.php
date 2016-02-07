<?php
// Start the engine 
require_once( TEMPLATEPATH . '/lib/init.php' );

// Add HTML5 markup structure
add_theme_support( 'html5' );

// remove edit links from posts/pages
add_filter( 'edit_post_link', '__return_false' );


// unregister not used genesis layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
//genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Add viewport meta tag for mobile browsers 
add_action( 'genesis_meta', 'matm_add_viewport_meta_tag' );
function matm_add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}
// load custom font
function matm_load_fonts() {
	wp_register_style('matm-google-fonts', '//fonts.googleapis.com/css?family=Khand:400,600,700');
	wp_enqueue_style( 'matm-google-fonts');
	
	#wp_enqueue_script( 'matm-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0' );
}
add_action('wp_enqueue_scripts', 'matm_load_fonts');


// genesis hooks to change position of the menu - applicable to all pages
remove_action( 'genesis_after_header','genesis_do_nav' ) ;
add_action( 'genesis_header_right','genesis_do_nav' );

/* home page widgets */
genesis_register_sidebar( array(
	'id' => 'homemainwidget',
	'name' => __( 'Home Main Widget', 'ycc' ),
	'description' => __( 'Home Page introduction', 'ycc' ),
) );

/* end home page widgets */