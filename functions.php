<?php
/** Start the engine */ 
require_once( TEMPLATEPATH . '/lib/init.php' );

// Add HTML5 markup structure
add_theme_support( 'html5' );

// remove edit links from posts/pages
add_filter( 'edit_post_link', '__return_false' );



genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

	add_action ('genesis_before_content','custom_image');
function custom_image() {
if ( !is_front_page() ) {	
		echo '<img class="top-bar" src="http://localhost/eliza/wp-content/themes/genesis-child-theme/images/cominscoch.png">';
    }
}


/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'matm_add_viewport_meta_tag' );
function matm_add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

function matm_load_fonts() {
	wp_register_style('matm-google-fonts', '//fonts.googleapis.com/css?family=Khand:400,600,700');
	wp_enqueue_style( 'matm-google-fonts');
	
	#wp_enqueue_script( 'matm-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0' );
}
add_action('wp_enqueue_scripts', 'matm_load_fonts');
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
// genesis hooks to change position of the menu - applicable to all pages
remove_action( 'genesis_after_header','genesis_do_nav' ) ;
add_action( 'genesis_header_right','genesis_do_nav' );

/* home page widgets */
genesis_register_sidebar( array(
	'id' => 'homemainwidget',
	'name' => __( 'Home Main Widget', 'ycc' ),
	'description' => __( 'Home Page introduction', 'ycc' ),
) );

/* create a widget */
class latest_events extends WP_Widget{
function __construct() {
	parent::__construct(
		'latest_events', // Base ID
		'Latest Events', // Name
		array('description' => __( 'Displays your latest listings. Outputs the post thumbnail, title and date per listing'))
	   );
}
//add option in the backend
function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
}
// output form 
function form($instance) {
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'latest_events'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('numberOfListings'); ?>"><?php _e('Number of Listings:', 'latest_events'); ?></label>
		<select id="<?php echo $this->get_field_id('numberOfListings'); ?>"  name="<?php echo $this->get_field_name('numberOfListings'); ?>">
			<?php for($i=1; $i<=5; $i++): ?>
			<option <?php echo $i == $numberOfListings ? 'selected="selected"' : '';?> value="<?php echo $i;?>">
			<?php echo $i; ?></option>
			<?php endfor;?>
		</select>
		</p>
	<?php
	}

function widget($args, $instance) {
	extract( $args );
	$title = apply_filters('widget_title', $instance['title']);
	$numberOfListings = $instance['numberOfListings'];
	echo $before_widget;
	if ( $title ) {
		echo $before_title . $title . $after_title;
	}
	$this->getRealtyListings($numberOfListings);
	echo $after_widget;
}
// output custom posts
function getRealtyListings($numberOfListings) { //html
$args = array( 'post_type' => 'event', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  <?php
  echo '<div class="entry-content">';
  echo get_the_excerpt();
  echo '</div>';
endwhile;
}
} //end class Realty_Widget
register_widget('latest_events');







?>