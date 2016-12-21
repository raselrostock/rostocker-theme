<?php 
/*
		@package rasel_rostocker
*/
get_header();?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="archive-header text-center">
						<?php the_archive_title('<h1 class="page-title">','</h1>');?>
							
			</header>
			<?php if( is_paged()):;?>
			<div class="container text-center container-load-previous">
				<a class="btn-rostocker-load rostocker-load-more" data-prev="1" data-page="<?php echo rostocker_check_paged(1);?>" data-archive="<?php echo rostocker_grab_current_url();?>" data-url="<?php echo admin_url('admin-ajax.php' );?>">
					 <span class="rostocker-icon rostocker-loading"></span>
					 <span class="text">Load Previous </span>
				 </a>
			</div> 	<!-- .container -->
			<?php endif;?>
			<div class="container rostocker-posts-container">
				<?php 
						if ( have_posts() ): ?>
						

						<?php
							echo '<div class="page-limit" data-page="'. $_SERVER["REQUEST_URI"].'" >';
							while( have_posts() ): the_post();
								/*
								$class = 'reveal';
								set_query_var( 'post-class', $class );
								*/
								get_template_part( 'template-parts/content', get_post_format() );
							endwhile;
							echo '</div>';
						endif;
				?>
			</div>	<!-- .container -->
			
			<div class="container text-center">
				<a class="btn-rostocker-load rostocker-load-more" data-page="<?php echo rostocker_check_paged(1);?>" data-archive="<?php echo rostocker_grab_current_url();?>" data-url="<?php echo admin_url('admin-ajax.php' );?>">
					 <span class="rostocker-icon rostocker-loading"></span>
					 <span class="text">Load More </span>
				 </a>
			</div> 	<!-- .container -->
			
		</main>  <!-- #main -->
		
	</div> <!-- #primary -->

<?php get_footer();?>