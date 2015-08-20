<?php
/*
 * CUSTOM POST TYPE TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<main class="site-main">

			
					 <div class="main-area">
						
							<div class="content-area">
							
								<div class="single-page-title">
									<section class="layout">
										<h1><?php echo __('404 page','viradeco'); ?></h1>
									</section>
								</div>
								
									<div class="page-main">
										<section class="layout">
											 <div class="page-content">	
													<article class="hentry page404">
														<p><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'viradeco' ); ?></p>
														<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'viradeco' ); ?></p>
														<div><?php get_search_form( true ); ?></div>
													</article>
											</div>
										</section>
								</div>
							</div>
					</div>
				
				

				
				<?php get_template_part('library/footer','links'); ?>
				<?php get_template_part('library/related','links'); ?>

			
		</main>

				
<?php get_footer(); ?>
