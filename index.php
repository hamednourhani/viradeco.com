<?php get_header(); ?>
	
	<main "site-main">
		<div class="banner-wrapper">
			<div id="header-slider" class="slider-pro">	
					
			</div>	
		</div><!-- banner-wrapper -->
		
		<div class="site-content">
			<section class="layout">
				
				<div class="primary">
					<?php the_content(); ?>					
				</div><!-- primary -->

				<div class="secondary">
					<?php get_sidebar(); ?>
				</div><!-- secondary -->

		</div>
		
	</main>

<?php get_footer(); ?>