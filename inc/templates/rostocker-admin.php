<h1>Rostocker Sidebar Options</h1>
<?php 
	settings_errors(); 
	$picture = esc_attr( get_option( 'profile_picture' ) );
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	$fullName = $firstName . ' ' . $lastName;
	$description = esc_attr(get_option('user_description'));
	$twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
	$facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
	$gplus_icon = esc_attr( get_option( 'gplus_handler' ) );
?>
<div class="rostocker-sidebar-preview">
	<div class="rostocker-sidebar">

		<div class="image-container">
			<div id="profile-picture-preview"class="profile-picture" style="background-image: url(<?php print $picture; ?>);">
				
			</div>
		</div>
		<h1 class="rostocker-username"><?php print $fullName;?></h1>
		<h2 class="rostocker-description"><?php print $description;?></h2>
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
</div>
<form method="post" action="options.php" class="rostocker-general-form">
	<?php settings_fields('rostocker-settings-group');
		   do_settings_sections('rasel_rostocker');
		   submit_button('Save Changes', 'primary', 'btnSubmit');
	?>
</form>