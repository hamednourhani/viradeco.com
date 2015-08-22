<?php get_header(); ?>
	
	<main class="site-main">
		<div class="banner-wrapper">
			
				<?php get_template_part('library/banner','maker'); ?>
				
		</div><!-- banner-wrapper -->
		
		<div class="site-content">
			<section class="layout">
				
				<div class="primary">

				<?php get_search_form( true ); ?>
					<?php if(have_posts()){ ?>
						<?php while(have_posts()) { the_post(); ?>
						
							<article class="hentry">
								<div class="featured-image single-image">
									<?php the_post_thumbnail(); ?>
								</div>
								<header class="article-title">
									<a href="<?php the_permalink(); ?>">
										<h3><?php the_title(); ?></h3>
									</a>
								</header>
								<main class="article-body">
									<?php the_excerpt(); ?>
									<?php get_template_part('library/post','meta'); ?>
								</main>
							</article>
						<?php } ?>
					<?php } ?>				
				</div><!-- primary -->

				<div class="secondary">
					<?php get_sidebar(); ?>
				</div><!-- secondary -->
			</section>
		</div>
		
	</main>

<?php get_footer(); ?>