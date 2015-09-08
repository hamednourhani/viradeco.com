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
									<?php the_content(); 
										$product_features = get_post_meta(get_the_ID(),'_viradeco_group_feature' );?>
										<div class="product-features">
											<?php if(!empty($product_features)){ ?>
												<?php foreach($product_features[0] as $product_feature){?>
												
													<?php $feature_desc = ($product_feature['feature_desc'])?($product_feature['feature_desc']):""; ?>
													
													<h4 class="feature-header"><?php echo $product_feature['feature_name']; ?></h4>
													<p class="feature-desc"><?php echo $feature_desc; ?></p>
													 <ul class="feature-images">
														<?php $counter = 1; ?>
														<?php if(!empty($product_feature['_viradeco_group_image_list'])){ ?>
															 <?php foreach($product_feature['_viradeco_group_image_list'] as $image_src){?>
																	<?php $img_thumb_src = viradeco_get_image_src($image_src,'53x53'); ?>													
																		
																			<a href="<?php echo $image_src; ?>" rel="prettyPhoto" title="<?php echo $product_feature['feature_name']; ?>">
																				<img src="<?php echo $img_thumb_src; ?>" width="53" height="53" alt="<?php echo $product_feature['feature_name']; ?>" />
																			</a>
																		

															 <?php } ?>
														<?php } ?>
														 <?php $counter++; ?>
													 </ul>
												<?php } ?>
											<?php } ?>
										</div>
									<?php get_template_part('library/post','meta'); ?>
									<!-- comments template -->
									
										<div class="comment-area">
											<?php comments_template(); ?>	
										</div>
									
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