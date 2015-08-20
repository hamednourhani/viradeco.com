



<?php if(is_category() || is_tag() || is_tax()){ 
		$display = false; 
		// Get only image url
		$params = array(
		  'term_id' => null,
		  'size' => 'banner'
		);
		$archive_banner = category_image_src( $params , $display );

		if($archive_banner){ 
			echo '<img class="page-banner" src="'.$archive_banner.'"/>';
		} else { ?>
			<div class="single-cat-title">
				<section class="layout">
					<h1><?php single_cat_title('',true); ?></h1>
				</section>
			</div>
		<?php } ?>		
<?php } elseif(is_search()) { ?>
		<div class="single-cat-title">
			<section class="layout">
				<h1><?php printf( __( 'Search Results for: %s', 'viradeco' ), get_search_query() ); ?></h1>
			</section>
		</div>
<?php } elseif(is_single()) {
		$banner_mod = get_post_meta(get_the_ID(),'_viradeco_banner_mod');
		
		switch ($banner_mod[0]) {
			case 'slider':
				$slider_shortcode = get_post_meta(get_the_ID(),'_viradeco_slider_shortcode');
				echo do_shortcode($slider_shortcode[0] );
				break;
			case 'image':
				$image = get_post_meta( get_the_ID(), '_viradeco_image' );
				echo '<img class="page-banner" src="'.$image[0].'"/>';
				break;
			default: 
				echo '<div class="banner-space"></div>';
				break;
		} ?>

		
<?php } else{ ?>
		<div class="banner-space">
		</div>
<?php  } ?>