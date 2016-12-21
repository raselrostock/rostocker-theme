<?php
/*
@package rostocker-theme
==================
ADMIN PAGE

==================
*/
function rostocker_add_admin_page(){
	//Generate Rostocker Admin Page
	add_menu_page('Rostocker Theme Options','Rostocker','manage_options','rasel_rostocker','rostocker_theme_create_page', get_template_directory_uri(). '/img/sunset-icon.png', 110);
	//Generate Rostocker Admin Sub Page
	add_submenu_page('rasel_rostocker','Rostocker Sidebar Options','Sidebar','manage_options', 'rasel_rostocker', 'rostocker_theme_create_page');
	add_submenu_page('rasel_rostocker','Rostocker Theme Options','Theme Options','manage_options', 'rasel_rostocker_theme', 'rostocker_theme_support_page');
	add_submenu_page('rasel_rostocker','Rostocker Contact Form','Contact Form','manage_options', 'rasel_rostocker_theme_contact', 'rostocker_contact_form_page');
	add_submenu_page('rasel_rostocker','Rostocker CSS Options','Custom CSS','manage_options', 'rasel_rostocker_css', 'rostocker_theme_settings_page');
	
	//Activate Custom Settings
	add_action('admin_init','rostocker_custom_settings');

}

add_action('admin_menu', 'rostocker_add_admin_page');


function rostocker_custom_settings()
	{
		//sidebar Options
		register_setting('rostocker-settings-group','profile_picture');
		register_setting('rostocker-settings-group','first_name');
		register_setting('rostocker-settings-group','last_name');
		register_setting('rostocker-settings-group','user_description');
		register_setting('rostocker-settings-group','twitter_handler','rostocker_sanitize_twitter_handler');

		add_settings_section('rostocker-sidebar-options','Sidebar Options','rostocker_sidebar_options','rasel_rostocker');


		add_settings_field('sidebar-profile-picture','Profile Picture','rostocker_sidebar_profile','rasel_rostocker','rostocker-sidebar-options');
		add_settings_field('sidebar-name','Full Name','rostocker_sidebar_name','rasel_rostocker','rostocker-sidebar-options');
		add_settings_field('sidebar-desctiption','Description','rostocker_sidebar_description','rasel_rostocker','rostocker-sidebar-options');
		add_settings_field('sidebar-twitter','Twitter Handler','rostocker_sidebar_twitter','rasel_rostocker','rostocker-sidebar-options');
		add_settings_field( 'sidebar-facebook', 'Facebook handler', 'rostocker_sidebar_facebook', 'rasel_rostocker', 'rostocker-sidebar-options');
	    add_settings_field( 'sidebar-gplus', 'Google+ handler', 'rostocker_sidebar_gplus', 'rasel_rostocker', 'rostocker-sidebar-options');

	    //Theme Support Options
	    register_setting('rostocker-theme-support','post_formats');
	    register_setting('rostocker-theme-support','custom_header');
	    register_setting('rostocker-theme-support','custom_background');

	    add_settings_section('rostocker-theme-options','Theme Options','rostocker_theme_options','rasel_rostocker_theme');

	    add_settings_field('post-formats','Post Formats','rostocker_post_formats','rasel_rostocker_theme','rostocker-theme-options');
	    add_settings_field('custom-header','Custom Header','rostocker_custom_header','rasel_rostocker_theme','rostocker-theme-options');
	    add_settings_field('custom-background','Custom Background','rostocker_custom_background','rasel_rostocker_theme','rostocker-theme-options');
	    // Contact Form Options
	    register_setting('rostocker-contact-options','activate_contact');
	    add_settings_section('rostocker-contact-section', 'Contact Form', 'rostocker_contact_section', 'rasel_rostocker_theme_contact');
	    add_settings_field('activate-form', 'Activate Contact Form', 'rostocker_activate_contact', 'rasel_rostocker_theme_contact', 'rostocker-contact-section');
	    //Custom CSS Options
	    register_setting('rostocker-custom-css-options','rostocker_css', 'rostocker_sanitize_custom_css');
	    add_settings_section('rostocker-custom-css-section', 'Custom CSS', 'rostocker_custom_css_section_callback', 'rasel_rostocker_css');
	    add_settings_field('custom-css', 'Insert Custom CSS', 'rostocker_custom_css_callback', 'rasel_rostocker_css', 'rostocker-custom-css-section');
	}


function rostocker_theme_options()
{
	echo "Activate and Deactivate specific Theme Support Options";
}
// Contact form options
function rostocker_contact_section()
{
	echo "Activate and Deactivate the Built-in Contact form";
}
function rostocker_activate_contact()
{
	$options = get_option('activate_contact');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /></label>';	
}



function rostocker_post_formats()
{
	$options = get_option('post_formats');
	$formats = array('aside','gallery','link','image','quote', 'status', 'video', 'audio', 'chat');
	$output = '';
	foreach ( $formats as $format ) 
	{
		$checked = ( @$options[$format] == 1 ? 'checked' : '');
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />'.$format.' </label><br>';
	
	}
	echo $output;
}
function rostocker_custom_header()
{
	$options = get_option('custom_header');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' />Activate the Custom Header </label>';	
}
function rostocker_custom_background()
{
	$options = get_option('custom_background');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' />Activate the Custom Background </label>';
	
	
}
// Custom CSS options
function rostocker_custom_css_section_callback()
{
	echo "Customize Your own CSS";
}
function rostocker_custom_css_callback()
{
	$css = get_option('rostocker_css');
	$css = ( empty($css) ? '/* Rostocker Theme Custom CSS */' : $css);

	echo '<div id="customCss">'.$css.'</div>';
	echo ',<textarea id="rostocker_css" name="rostocker_css" style="display:none;visibility:hidden" >'.$css.'</textarea>';	
}
//Sidebar option Functions
function rostocker_sidebar_options()
{
	echo "Customize your Sidebar Information";
}
function rostocker_sidebar_profile()
{	
	$picture = esc_attr( get_option( 'profile_picture' ) );
	if( empty($picture) )
	{
		echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
	}
	else
	{
		echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';	
	}
	
}
function rostocker_sidebar_name()
{	
	$fistName = esc_attr(get_option('first_name'));
	$lastName = esc_attr(get_option('last_name'));
	echo '<input type="text" name="first_name" value="'.$fistName.'" placeholder="First Name" />';
	echo '<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}
function rostocker_sidebar_description()
{
	$description = esc_attr(get_option('user_description'));
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="User Description" />';
}
function rostocker_sidebar_twitter()
{
	$twitter = esc_attr(get_option('twitter_handler'));
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" />';
}
// Sanitiation settings
function rostocker_sanitize_twitter_handler($input)
{
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;

}
function rostocker_sanitize_custom_css( $input)
{
	$output = esc_textarea( $input );
	return $output;
}
function rostocker_sidebar_facebook() {
	$facebook = esc_attr( get_option( 'facebook_handler' ) );
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler" />';
}
function rostocker_sidebar_gplus() {
	$gplus = esc_attr( get_option( 'gplus_handler' ) );
	echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ handler" />';
}



// Template
function rostocker_theme_create_page(){
	require_once(get_template_directory().'/inc/templates/rostocker-admin.php');

}
function rostocker_theme_support_page()
{
	require_once(get_template_directory().'/inc/templates/rostocker-theme-support.php');
}
function rostocker_contact_form_page()
{
	require_once(get_template_directory().'/inc/templates/rostocker-contact-form.php');
}

function rostocker_theme_settings_page(){
	require_once(get_template_directory().'/inc/templates/rostocker-contact-css.php');
}