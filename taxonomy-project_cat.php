<?php get_header(); ?>
	
	<main class="site-main">
		<div class="banner-wrapper">
			
				<?php get_template_part('library/banner','maker'); ?>
				
		</div><!-- banner-wrapper -->
		
		<div class="site-content">
			<section class="layout">
				
				<div class="primary">
					<?php if(have_posts()){ ?>
						<ul class="projects-list">
							<li><span><?php echo __('Title','viradeco'); ?></span></li>
							<?php while(have_posts()) { the_post(); 
								$project_date = get_post_meta(get_the_ID(),'_viradeco_project_date'); ?>
								<li class="project-link">
									<a href="<?php the_permalink(); ?>">
										<span><?php echo esc_html($project_date[0]).' - '; ?></span>
										<span><?php the_title(); ?></span>
									</a>
									
								</li>
							<?php } ?>
						</ul>
					<?php } ?>		
					<nav class="pagination">
						<?php viradeco_pagination(); ?>
					</nav>			
				</div><!-- primary -->

				<div class="secondary">
					<?php get_sidebar(); ?>
				</div><!-- secondary -->
			</section>
		</div>
		
	</main>

<?php get_footer(); ?>