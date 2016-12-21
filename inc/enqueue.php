<?php
/*
@package rostocker-theme
==================
ADMIN ENQUEUE FUNCTIONS

==================
*/
function rostocker_load_admin_scripts( $hook )
{	
	if( 'toplevel_page_rasel_rostocker' == $hook) 
	{
		
	wp_register_style('rostocker_admin',get_template_directory_uri().'/css/rostocker.admin.css',array(),'1.0.0','all');
	wp_enqueue_style('rostocker_admin');

	wp_enqueue_media();

	wp_register_script('rostocker-admin-script', get_template_directory_uri() . '/js/rostocker.admin.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('rostocker-admin-script');
   }
   elseif ( 'rostocker_page_rasel_rostocker_css' == $hook) 
   {
   		wp_enqueue_style( 'ace', get_template_directory_uri(). '/css/rostocker.ace.css', array(), '1.0.0', 'all');
   		wp_enqueue_script( 'ace', get_template_directory_uri(). '/js/ace/ace.js', array('jquery'), '1.2.1', true);
   		wp_enqueue_script( 'rostocke-custom-css-script',  get_template_directory_uri(). '/js/rostocker.custom_css.js', array('jquery'), '1.0.0', true);
   }
   else
    {
   		return ;
	}
}
add_action('admin_enqueue_scripts','rostocker_load_admin_scripts');





/*

==================
FRONT-END ENQUEUE FUNCTIONS

==================
*/

function rostocker_load_scritps()
{
   wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), '3.3.6', 'all');
   wp_enqueue_style( 'rostocker', get_template_directory_uri(). '/css/rostocker.css', array(), '1.0.0', 'all');
   wp_enqueue_style('raleway','https://fonts.googleapis.com/css?family=Raleway:200i,300,400
' );
   wp_deregister_script( 'jquery' );
   wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '1.11.3' ,true );
   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'bootstrap',  get_template_directory_uri(). '/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
   wp_enqueue_script( 'rostocker',  get_template_directory_uri(). '/js/rostocker.js', array('jquery'), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'rostocker_load_scritps');