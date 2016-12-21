<?php 
/*
		@package rasel_rostocker
		--Aside Post Format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'rostocker-format-aside' );?> >
	<div class="aside-container">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-2 text-center">
				<?php if( rostocker_get_attachment() ):?>
							
				<div class="aside-featured background-image" style="background-image:url(<?php echo rostocker_get_attachment();?>);">
								
				</div> <!-- .aside-featured -->
							
					
				<?php endif; ?>
			</div>	<!--.col-md-2-->
			<div class="col-xs-12 col-sm-9 col-md-10" >
				<header class="entry-header">	
					<div class="entry-meta">
						<?php echo rostocker_posted_meta();?>
					</div>
				</header>
				<div class="entry-content">
					<div class="entry-excerpt">
						<?php the_excerpt();?>
					</div>		<!-- .entry-excerpt -->
				</div> <!-- .entry-content -->
			</div><!--.col-md-10-->
		</div>  <!-- .row -->
			
		<footer class="entry-footer">
			<div class="row">
				 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
					<?php echo rostocker_posted_footer();?>
				</div>	<!--.col-md-10-->
			</div>  <!-- .row -->
		</footer>
	</div>		<!--.aside-container-->	
</article>