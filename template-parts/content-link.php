<?php 
/*
		@package rasel_rostocker
		--Link Post Format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'rostocker-format-link');?> >
		<header class="entry-header text-center">	
			<?php 
				$link = rostocker_grab_url();
			the_title( '<h1 class="entry-title"><a href="'. $link .'" target="_blank">', '<div class="link-icon"><span class="rostocker-icon rostocker-link"></span></div></a></h1>' ); 
			?>
			
		</header>
		
</article>