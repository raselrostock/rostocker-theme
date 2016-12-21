<?php
/*
@package rostocker-theme

================================
WIDGET CLASS
================================

*/

class Rostocker_Profile_Widget extends WP_Widget {
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'rostocker-profile-widget',
			'description' => 'Custom Rostocker Profile Widget',
		);
		parent::__construct( 'rostocker_profile', 'Rostocker Profile', $widget_ops );
		
	}
	//back-end display of widget
	public function form( $instance ) {
		echo '<p><strong>No options for this Widget!</strong><br/>You can control the fields of this Widget from <a href="./admin.php?page=rasel_rostocker">This Page</a></p>';
	}

	//front-end display of widget
	public function widget( $args, $instance ) {
		
		$picture = esc_attr( get_option( 'profile_picture' ) );
		$firstName = esc_attr( get_option( 'first_name' ) );
		$lastName = esc_attr( get_option( 'last_name' ) );
		$fullName = $firstName . ' ' . $lastName;
		$description = esc_attr( get_option( 'user_description' ) );
		
		$twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
		$facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
		$gplus_icon = esc_attr( get_option( 'gplus_handler' ) );
		
		echo $args['before_widget'];
		?>
		<div class="text-center">
			<div class="image-container">
				<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
			</div>
			<h1 class="rostocker-username"><?php print $fullName; ?></h1>
			<h2 class="rostocker-description"><?php print $description; ?></h2>
			<div class="icons-wrapper">
				<?php if( !empty( $twitter_icon ) ): ?>
					<a href="https://twitter.com/<?php echo $twitter_icon; ?>" target="_blank"><span class="rostocker-icon-sidebar rostocker-icon rostocker-twitter"></span></a>
				<?php endif; 
				if( !empty( $gplus_icon ) ): ?>
					<a href="https://plus.google.com/u/0/+<?php echo $gplus_icon; ?>" target="_blank"><span class="rostocker-icon-sidebar rostocker-icon sunset-googleplus"></span></a>
				<?php endif; 
				if( !empty( $facebook_icon ) ): ?>
					<a href="https://facebook.com/<?php echo $facebook_icon; ?>" target="_blank"><span class="rostoker-icon-sidebar rostoker-icon rostoker-facebook"></span></a>
				<?php endif; ?>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}
	
}
	add_action( 'widgets_init', function() {
	register_widget( 'Rostocker_Profile_Widget' );
} );
	

/* Edit default wordpress widgets*/
function rostocker_tag_cloud_font_change( $args )
{
	$args['smallest']= 8;
	$args['largest']= 8;
	return $args;
}
add_filter('widget_tag_cloud_args','rostocker_tag_cloud_font_change');

function rostocker_list_categories_output_change( $links ) {
	
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	
	return $links;
	
}
add_filter( 'wp_list_categories', 'rostocker_list_categories_output_change' );

/* Save Posts Views*/
function rostocker_save_post_views( $postID)
{
	$metaKey = 'rostocker_post_views';
	$views = get_post_meta( $postID, $metaKey, true );

	$count = ( empty($views) ? 0 :$views );
	var_dump($count);
	$count++;
	update_post_meta( $postID, $metakey, $count);
	echo "Rasel";

}
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );

/* Popular Posts Widgets*/
class Rostocker_Popular_Posts_Widget extends WP_Widget
{
	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'rostocker-popular-posts-widget',
			'description' => 'Popular Posts Widget',
		);
		parent::__construct( 'rostocker_popular_posts', 'Rostocker Popular Posts', $widget_ops );
		
	}
	//back-end display of widget
	public function form( $instance ) {
		$title = ( !empty( $instance['title']) ? $instance['title'] : 'Popular Posts');
		$tot = ( !empty($instance['tot']) ? absint($instance['tot']) : 4);
		$output = '<p>';
		$output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title:</label>';
		$output .= '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $title ) . '"';
		$output .= '</p>';
		
		$output .= '<p>';
		$output .= '<label for="' . esc_attr( $this->get_field_id( 'tot' ) ) . '">Number of Posts:</label>';
		$output .= '<input type="number" class="widefat" id="' . esc_attr( $this->get_field_id( 'tot' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tot' ) ) . '" value="' . esc_attr( $tot ) . '"';
		$output .= '</p>';
		
		echo $output;
	}

	//update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'tot' ] = ( !empty( $new_instance[ 'tot' ] ) ? absint( strip_tags( $new_instance[ 'tot' ] ) ) : 0 );
		
		return $instance;
		
	}
	
	//front-end display of widget
	public function widget( $args, $instance ) {
		
		$tot = absint( $instance[ 'tot' ] );
		
		$posts_args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> $tot,
			'meta_key'			=> 'rostocker_post_views',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC'
		);
		
		$posts_query = new WP_Query( $posts_args );
		
		echo $args[ 'before_widget' ];
		
		if( !empty( $instance[ 'title' ] ) ):
			
			echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];
			
		endif;
		
		if( $posts_query->have_posts() ):
		
			//echo '<ul>';
				
				while( $posts_query->have_posts() ): $posts_query->the_post();
					
					echo '<div class="media">';
					echo '<div class="media-left"><img class="media-object" src="' . get_template_directory_uri() . '/img/post-' . ( get_post_format() ? get_post_format() : 'standard') . '.png" alt="' . get_the_title() . '"/></div>';
					echo '<div class="media-body">' . get_the_title() . '</div>';
					echo '</div>';
					
				endwhile;
				
			//echo '</ul>';
		
		endif;
		
		echo $args[ 'after_widget' ];
		
	}
}
add_action('widgets_init', function(){
	register_widget('Rostocker_Popular_Posts_Widget' );
} );