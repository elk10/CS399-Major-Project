<?php

// add slider before main content
add_action ('genesis_before_content','genesis_slider', 1 );
 function genesis_slider()  {
 	if ( function_exists( 'soliloquy' ) ) { soliloquy( '81' ); } 
	if ( function_exists( 'soliloquy' ) ) { soliloquy( '81', 'slug' ); 
}


// create custom loop 
function ycc_custom_loop() {
	global $post;
	setup_postdata( $post );
}

// create custom widget for school's introduction
genesis_widget_area( 'homemainwidget', array(
	'before' => '<div class="homemainwidget">',
	'after' => '</div>'
));
		
}
//remove main genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'ycc_custom_loop' );

//turn on genesis loop for the rest of the website 
genesis();