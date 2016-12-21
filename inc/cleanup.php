<?php 
	/*
		This is the template for the header
		@package rasel_rostocker

		===================================
		REMOVE GENERATOR VERSION NUMBER
		===================================
	*/
/* Remove version string from js and css*/
function rostocker_remove_wp_version_strings( $src )
{
	global $wp_version;
	parse_str( parse_url($src, PHP_URL_QUERY), $query);
	if ( !empty( $query['ver'] ) && $query['ver'] === $wp_version )
	{
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'script_loader_src', 'rostocker_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'rostocker_remove_wp_version_strings' );

/* Remove metatag generator*/
function rostocker_remove_meta_version()
{
	return "";
}
add_filter( 'the_generator', 'rostocker_remove_meta_version' );
?>