<h1>Rostocker Contact Form</h1>
<?php 
	settings_errors(); 
	//$picture = esc_attr( get_option( 'profile_picture' ) );
	

?>
<p>Use this <strong>Shortcode</strong> to activat the Contact Form inside a Page or a Post</p>
<p><code>[contact_form]</code></p>
<form method="post" action="options.php" class="rostocker-general-form">
	<?php 
			settings_fields('rostocker-contact-options');
		    do_settings_sections('rasel_rostocker_theme_contact');
		   	submit_button();
	?>
</form>