<?php
$args = array (
		'post_type'              => array( 'news' ),
		'posts_per_page'         => '15',
		// 'category'         => 'news_cat',
		'news_cat'    => 'featured',
	);
// The Query
	$news_list = get_posts( $args );
	$slider_show = get_post_meta(get_the_ID(),'_viradeco_slider_show');
	
 ?>

<div class="slider-wrap">
	<?php if(!empty($news_list) && $slider_show == true){ ?>
		<div id="news-slider" class="slider-pro">
		
			<div class="sp-slides">
			<?php foreach ( $news_list as $news ) : 
				$slide_url = wp_get_attachment_image_src( get_post_thumbnail_id($news->ID), 'slider');
			?>
				<div class="sp-slide">
					<a href="<?php echo post_permalink( $news->ID ); ?> " >
						<img class="sp-image" src="<?php echo get_template_directory_uri();?>/images/blank.gif"
							data-src="<?php echo $slide_url[0]; ?>"
							data-retina="<?php echo $slide_url[0]; ?>"/>
					</a>

					<div class="sp-caption">
						<a href="<?php echo post_permalink( $news->ID ); ?> " >
							<?php echo $news->post_title; ?>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		        
			</div>
			
			<div class="sp-thumbnails">
				<?php foreach ( $news_list as $news ) :
					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($news->ID), 'slider');
					
				?>
				<div class="sp-thumbnail">
					<div class="sp-thumbnail-image-container">
						<img class="sp-thumbnail-image" src="<?php echo $thumb_url[0]; ?>"/>
					</div>
					<div class="sp-thumbnail-text">
						<div class="sp-thumbnail-title">
							<?php echo $news->post_title; ?>
						</div>
						<div class="sp-thumbnail-description">
							
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
	    </div>
	    <script type="text/javascript" >
	    	jQuery( document ).ready(function( $ ) {
	        $( '#news-slider' ).sliderPro({
	            width: 840,
	            height: 440,
	            orientation: 'vertical',
	            loop: false,
	            arrows: true,
	            buttons: false,
	            thumbnailsPosition: 'left',
	            thumbnailPointer: true,
	            thumbnailWidth: 290,
	            breakpoints: {
	                800: {
	                    thumbnailsPosition: 'bottom',
	                    thumbnailWidth: 270,
	                    thumbnailHeight: 100
	                },
	                500: {
	                    thumbnailsPosition: 'bottom',
	                    thumbnailWidth: 120,
	                    thumbnailHeight: 50
	                }
	            }
	        });
	    });
	    
	    </script>
	 <?php 
	}
	wp_reset_postdata();
?>
 </div>

