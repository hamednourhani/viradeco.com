<?php get_header(); ?>
	
	<main class="site-main">
		<div class="banner-wrapper">
			
				<?php get_template_part('library/banner','maker'); ?>
			
		</div><!-- banner-wrapper -->
		
		<div class="site-content without-sidebar">
			<section class="layout">
				
				<div class="primary">
					<?php if(have_posts()){ ?>
						<?php while(have_posts()) { the_post(); ?>
						
							<article class="hentry">
								
								<header class="article-title">
									<a href="<?php the_permalink(); ?>">
										<h3><?php the_title(); ?></h3>
									</a>
								</header>

								<div class="featured-image single-image">
									<?php the_post_thumbnail(); ?>
								</div>
								<main class="article-body">
									<?php the_excerpt(); ?>
									
								</main>
							</article>
						<?php } ?>
					<?php } ?>				
				</div><!-- primary -->

				
			</section>
		</div>
		
	</main>

<?php get_footer(); ?>