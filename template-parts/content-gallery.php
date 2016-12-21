<?php

/*
	
@package sunsettheme
-- Gallery Post Format

*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'rostocker-format-gallery' ); ?>>
	<header class="entry-header text-center">
		
		<?php if( rostocker_get_attachment() ): 
		?>
			
			<div id="post-gallery-<?php the_ID(); ?>" class="carousel slide rostocker-carousel-thumb" data-ride="carousel">
				
				<div class="carousel-inner" role="listbox">
					
					<?php 
						$attachments = rostocker_get_bs_slides(rostocker_get_attachment(7));
						foreach( $attachments as $attachment ):
					?>
						<div class="item<?php echo $attachment['class']; ?> background-image standard-featured" style="background-image: url( <?php echo $attachment['url']; ?> );">
								
							<div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>
							<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>
							<div class="entry-excerpt image-caption">
			 	 				<p><?php echo $attachment['caption'];?></p>
			 				</div>		<!-- .entry-excerpt -->
								
						</div>
					
					<?php endforeach; ?>
					
				</div><!-- .carousel-inner -->
				
				<a class="left carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
					<div class="table">
						<div class="table-cell">
							
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="rostocker-icon rostocker-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</div><!-- .preview-container -->
							
						</div><!-- .table-cell -->
					</div><!-- .table -->
				</a>
				<a class="right carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
					<div class="table">
						<div class="table-cell">
							
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="rostocker-icon rostocker-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</div><!-- .preview-container -->
							
						</div><!-- .table-cell -->
					</div><!-- .table -->
				</a>
				
			</div><!-- .carousel -->
			
		<?php endif; ?>
		
		<?php the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">', '</a></h1>'); ?>
		
		<div class="entry-meta">
			<?php echo rostocker_posted_meta(); ?>
		</div>
		
	</header>
	
	<div class="entry-content">
		
		<div class="entry-excerpt">
			 	 <?php the_excerpt();?>
			 </div>		<!-- .entry-excerpt -->
		
		<div class="button-container text-center">
			<a href="<?php the_permalink(); ?>" class="btn btn-rostocker"><?php _e( 'Read More' ); ?></a>
		</div>
		
	</div><!-- .entry-content -->
	
	<footer class="entry-footer">
		<?php echo rostocker_posted_footer(); ?>
	</footer>
	
</article>