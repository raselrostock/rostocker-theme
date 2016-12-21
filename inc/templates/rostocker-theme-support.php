<h1>Rostocker Theme Support</h1>
<?php 
	settings_errors(); 
	//$picture = esc_attr( get_option( 'profile_picture' ) );
	

?>

<form method="post" action="options.php" class="rostocker-general-form">
	<?php 
			settings_fields('rostocker-theme-support');
		    do_settings_sections('rasel_rostocker_theme');
		   	submit_button();
	?>
</form>