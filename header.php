<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="utf-8">

	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title(' : '); ?></title>

	<?php // mobile meta (hooray!) ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
	<meta name="msapplication-TileColor" content="#f01d4f">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
        <meta name="theme-color" content="#121212">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head ?>

	<?php // drop Google Analytics Here ?>
	<?php // end analytics ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	
	<!-- <noscript>
		<style>
			.body-wrapper{
				display : block;
			}
		</style>
	</noscript> -->
	<div class="body-wrapper">
	<!-- ********************************************************************* -->
	<!--****************** Site header ***************************************-->
	<!-- ********************************************************************* -->

		<header class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
			<div class="top-bar">
				<section class="layout">
					<!-- <img src="<?php echo get_template_directory_uri();?>/images/ir.png" alt="Persian" class="lang-icon"/>
					<img src="<?php echo get_template_directory_uri();?>/images/en.png" alt="English" class="lang-icon"/>
					<img src="<?php echo get_template_directory_uri();?>/images/it.png" alt="Italian" class="lang-icon"/> -->
					<?php do_action('wpml_add_language_selector'); ?>
				</section>
			</div>
			<div class="hero">
				<section class="layout">
					<div class="logo-wrapper">
						<a href="<?php echo get_bloginfo('url'); ?>">
							<img src="<?php echo get_template_directory_uri();?>/images/viradeco-white-logo-130.png" alt="<?php echo get_bloginfo('name'); ?>"/>
						</a>
					</div>
					<span class="site-desc"><?php echo get_bloginfo('description'); ?></span>
				</section>
			

				<nav role="navigation" class="main-menu" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
					<section class="layout">
						<?php $walker = new Menu_With_Image; ?>
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'Main Menu', 'viradeco' ),  // nav name
    					         'menu_class' => 'nav main-nav cf', 
    					         'walker' => $walker,             // adding custom nav class
    					         'theme_location' => 'main-menu',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 3,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
						
						<div class="search-area">
							<?php get_search_form( true ); ?>
						</div>
					</section>
					
				</nav>
			</div>
		</header>	

<!-- ********************************************************************* -->
<!--****************** Site Main ******************************************-->
<!-- ********************************************************************* -->

