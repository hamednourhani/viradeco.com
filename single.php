<?php get_header(); ?>
	
	<main "site-main">
		<?php if(have_posts()){ ?>
			<?php while(have_posts()) { the_post(); ?>

				<div class="banner-wrapper">
					<div id="header-slider" class="slider-pro">	
							<?php get_template_part('library/banner','maker'); ?>
					</div>	
				</div><!-- banner-wrapper -->
				
				<div class="site-content">
					<section class="layout">
						
						<div class="primary">
							
								
							<article class="hentry">
								<header class="article-title">
									<a href="<?php the_permalink(); ?>">
										<h3><?php the_title(); ?></h3>
									</a>
								</header>
								<main class="article-body">
									<?php the_content(); ?>
									<?php get_template_part('library/post','meta'); ?>
								</main>
							</article>
											
						</div><!-- primary -->

						<div class="secondary">
							<?php get_sidebar(); ?>
						</div><!-- secondary -->
					</section>
				</div>
			<?php } ?>

		<?php } else { ?>	
			
			<div class="site-content">
				<section class="layout">
					<div class="secondary">
						<?php get_sidebar(); ?>
					</div><!-- secondary -->
				</section>
			</div>

		<?php endif; ?>
		
	</main>

<?php get_footer(); ?>