<?php

// add slider before main content
add_action ('genesis_before_content','genesis_slider', 1 );
 function genesis_slider()  {
 	if ( function_exists( 'soliloquy' ) ) { soliloquy( '81' ); } 
	if ( function_exists( 'soliloquy' ) ) { soliloquy( '81', 'slug' ); 
}
// custom excerpt length
function custom_excerpt_length( $length ) {
 return 26;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
//edit read more text 
function new_excerpt_more( $more ) {
 return '&#133; <div class="read-more">  <a href="'. get_permalink( get_the_ID() ) . '"><br>Read On &rarr;</a></div>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

// create custom loop 
function ycc_custom_loop() {
	global $post;
	setup_postdata( $post );

// create custom widget for school's introduction
genesis_widget_area( 'homemainwidget', array(
	'before' => '<div class="homemainwidget">',
	'after' => '</div>'
));
// loop through posts to get 2 latest posts
global $post;
$args = array( 'posts_per_page' => 1, 'offset'=> 0 );
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : 
  setup_postdata( $post ); ?>
<div class="news">
	<h2>News</h2>
		<div class="one-half first">
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><p><?php the_excerpt(); ?></p></li>
		</div>
<?php endforeach;
wp_reset_postdata(); 
$args = array( 'posts_per_page' => 1, 'offset'=> 1 );
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : 
  setup_postdata( $post ); ?>
		<div class="one-half">
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><p><?php  the_excerpt(); ?></p></li>
		</div>
<?php endforeach;
wp_reset_postdata(); 
?>
</div>
	<div class="one-half first">
		<h2>Gallery</h2>
		<img src="http://www.cominscoch.ceredigion.sch.uk/wp/wp-content/uploads/IMG_1789.jpg" alt="">
	</div>
	<div class="one-half">
	Twitter Feed
	</div>
<?php
	}	
}
//remove main genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'ycc_custom_loop' );
//turn on genesis loop for the rest of the website 
genesis();