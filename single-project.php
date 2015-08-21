<?php get_header(); ?>
	
	<main class="site-main">
		<?php if(have_posts()){ ?>
			<?php while(have_posts()) { the_post(); ?>

				<div class="banner-wrapper">
					
							<?php get_template_part('library/banner','maker'); ?>
					
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
									<div class="project-features">
										<?php $project_date = get_post_meta(get_the_ID(),'_viradeco_project_date'); ?>
										<?php $project_meta = get_post_meta(get_the_ID(),'_viradeco_group_feature'); ?>
										<table class="project-meta">
											<tbody>
											<tr>
												<td class="meta-name"><?php echo __('Date ','viradeco'); ?></td>
												<td class="meta-value"><?php echo $project_date[0]; ?></td>
											</tr>
											<?php foreach($project_meta[0] as $meta){ ?>
												
												<tr>
													<td class="meta-name"><?php echo $meta['feature_name']; ?></td>
													<td class="meta-value"><?php echo $meta['feature_value']; ?></td>
												</tr>
											<?php } ?>
											
											</tbody>
										</table>
										
										

									<?php the_content(); ?>
									<?php $project_images = get_post_meta(get_the_ID(),'_viradeco_image_list'); ?>
									<ul class="feature-images">
										 <?php $counter = 1; ?>
										 <?php foreach($project_images[0] as $image_src){?>
												<?php $img_thumb_src = viradeco_get_image_src($image_src,'130x130'); ?>													
													
														<a href="<?php echo $image_src; ?>" rel="prettyPhoto" >
															<img src="<?php echo $img_thumb_src; ?>" width="130" height="130" alt="" />
														</a>
													

										 <?php } ?>
										 <?php $counter++; ?>
									</ul>
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

		<?php } ?>
		
	</main>

<?php get_footer(); ?>