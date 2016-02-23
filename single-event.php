<?php

function se_custom_loop() {
	global $post;
	setup_postdata( $post );
global $wp_query;
$postid = $wp_query->post->ID;
echo get_post_meta($postid, 'date_listed', true);
echo get_post_meta($postid, 'application_deadline', true);
wp_reset_query();
	}	

//remove main genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'se_custom_loop' );
//turn on genesis loop for the rest of the website 
genesis();