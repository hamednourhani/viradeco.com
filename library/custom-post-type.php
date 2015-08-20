<?php
/* viradeco Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/viradeco/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'viradeco_flush_rewrite_rules' );

// Flush your rewrite rules
function viradeco_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function news_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'news', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'News', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'News', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All News', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New News', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit News', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New News', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View News', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search News', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a News', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/news-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'news', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'notify', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', /*'excerpt', 'trackbacks', 'custom-fields',*/ 'comments',/* 'revisions',*/ 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}


function notify_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'notify', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Notify', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'Notify', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All Notifies', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Notify', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Notify', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New Notify', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View Notify', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search Notifies', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a notify', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/notify-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'notify', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'notify', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', /*'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky'*/)
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}
function link_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'link', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Link', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'Link', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All Links', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Link', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Link', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New Link', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View Link', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search Links', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a link', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/link-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'link', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'link', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', /*'editor', 'author',*/ 'thumbnail', /*'excerpt', 'trackbacks',*/ 'custom-fields', /*'comments', 'revisions',*/ 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}
function gallery_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'gallery', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Gallery', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'Gallery', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All Galleries', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Gallery', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Gallery', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New Gallery', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View Gallery', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search Galleries', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a Gallery', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/gallery-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'gallery', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'gallery', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', /*'editor','author',*/ /*'thumbnail' ,'excerpt',*/ /*'trackbacks',*/ /*'custom-fields',*/ /*'comments'*/ /*'revisions'*/ /*'sticky'*/)
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}
function tab_post_type() { 
// creating (registering) the custom type 
	register_post_type( 'tab', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Tab', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'Tab', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All Tabs', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Tab', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Tab', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New Tab', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View Tab', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search Tabs', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a tab', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/tab-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'tab', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'tab', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', /*'editor',*/ /*'author', 'thumbnail', 'excerpt', /*'trackbacks'*/ /*'custom-fields',*/ /*'comments'*/ /*'revisions'*/ /*'sticky'*/)
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}

function sub_tab_post_type() { 
// creating (registering) the custom type 
	register_post_type( 'sub_tab', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'sub tab', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'sub tab', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All sub tabs', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New sub tab', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit sub tab', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New sub tab', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View sub tab', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search sub tabs', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a sub tab', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,

			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/sub-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'sub-tab', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'sub_tab', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', /*'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments','revisions' ,'sticky'*/),
			'show_in_menu'  => 'edit.php?post_type=tab',

			
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}



function management_post_type() { 
// creating (registering) the custom type 
	register_post_type( 'management', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'management', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'management', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All managements', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New management', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit management', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New management', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View management', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search managements', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a management', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,

			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/management-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'management', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'management', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', /*'editor', 'author',*/ /*'thumbnail', 'excerpt'*//*, 'trackbacks', 'custom-fields', 'comments','revisions' ,'sticky'*/),


		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}
function sub_management_post_type() { 
// creating (registering) the custom type 
	register_post_type( 'sub_management', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'sub management', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'sub management', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All sub managements', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New sub management', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit sub management', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New sub management', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View sub management', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search sub managements', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a sub management', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,

			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/sub-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'sub-management', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'sub_management', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', /*'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments','revisions' ,'sticky'*/),
			'show_in_menu'  => 'edit.php?post_type=management',

			
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}

function education_post_type() { 
// creating (registering) the custom type 
	register_post_type( 'education', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'education', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'education', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All educations', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New education', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit education', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New education', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View education', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search educations', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a education', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/education-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'education', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'education', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', /*'editor', 'author',*/ /*'thumbnail', 'excerpt',*/ /*'trackbacks','custom-fields','comments','revisions', 'sticky'*/),
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}
function sub_education_post_type() { 
// creating (registering) the custom type 
	register_post_type( 'sub_education', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'sub education', 'viradeco' ), /* This is the Title of the Group */
			'singular_name' => __( 'sub education', 'viradeco' ), /* This is the individual type */
			'all_items' => __( 'All sub educations', 'viradeco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'viradeco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New sub education', 'viradeco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'viradeco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit sub education', 'viradeco' ), /* Edit Display Title */
			'new_item' => __( 'New sub education', 'viradeco' ), /* New Display Title */
			'view_item' => __( 'View sub education', 'viradeco' ), /* View Display Title */
			'search_items' => __( 'Search sub educations', 'viradeco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'viradeco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'viradeco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a sub education', 'viradeco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,

			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/sub-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'sub-education', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'sub_education', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', /*'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments','revisions' ,'sticky'*/),
			'show_in_menu'  => 'edit.php?post_type=education',

			
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}



	// adding the function to the Wordpress init
	add_action( 'init', 'notify_post_type');
	add_action( 'init', 'news_post_type');
	add_action( 'init', 'link_post_type');
	add_action( 'init', 'gallery_post_type');
	add_action( 'init', 'tab_post_type');
	add_action( 'init', 'sub_tab_post_type');
	add_action( 'init', 'management_post_type');
	add_action( 'init', 'sub_management_post_type');
	add_action( 'init', 'education_post_type');
	add_action( 'init', 'sub_education_post_type');
	
	

	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'news_cat', 
		array('news'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'News Categories', 'viradeco' ), /* name of the custom taxonomy */
				'singular_name' => __( 'News Category', 'viradeco' ), /* single taxonomy name */
				'search_items' =>  __( 'Search News Categories', 'viradeco' ), /* search title for taxomony */
				'all_items' => __( 'All News Categories', 'viradeco' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent News Category', 'viradeco' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent News Category:', 'viradeco' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit News Category', 'viradeco' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update News Category', 'viradeco' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New News Category', 'viradeco' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New News Category Name', 'viradeco' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'news-cat' ),
			'show_in_nav_menus' => true,
		)
	);
	register_taxonomy( 'notify_cat', 
			array('notify'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
			array('hierarchical' => true,     /* if this is true, it acts like categories */
				'labels' => array(
					'name' => __( 'Notify Categories', 'viradeco' ), /* name of the custom taxonomy */
					'singular_name' => __( 'Notify Category', 'viradeco' ), /* single taxonomy name */
					'search_items' =>  __( 'Search Notify Categories', 'viradeco' ), /* search title for taxomony */
					'all_items' => __( 'All Notify Categories', 'viradeco' ), /* all title for taxonomies */
					'parent_item' => __( 'Parent Notify Category', 'viradeco' ), /* parent title for taxonomy */
					'parent_item_colon' => __( 'Parent Notify Category:', 'viradeco' ), /* parent taxonomy title */
					'edit_item' => __( 'Edit Notify Category', 'viradeco' ), /* edit custom taxonomy title */
					'update_item' => __( 'Update Notify Category', 'viradeco' ), /* update title for taxonomy */
					'add_new_item' => __( 'Add New Notify Category', 'viradeco' ), /* add new title for taxonomy */
					'new_item_name' => __( 'New Notify Category Name', 'viradeco' ) /* name title for taxonomy */
				),
				'show_admin_column' => true, 
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'notify-cat' ),
				'show_in_nav_menus' => true,
			)
		);
	
		
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'news_tag', 
		array('news'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'News Tags', 'viradeco' ), /* name of the custom taxonomy */
				'singular_name' => __( 'News Tag', 'viradeco' ), /* single taxonomy name */
				'search_items' =>  __( 'Search News Tags', 'viradeco' ), /* search title for taxomony */
				'all_items' => __( 'All News Tags', 'viradeco' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent News Tag', 'viradeco' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent News Tag:', 'viradeco' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit News Tag', 'viradeco' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update News Tag', 'viradeco' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New News Tag', 'viradeco' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New News Tag Name', 'viradeco' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
		)
	);

		/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	// register_taxonomy( 'tab_cat', 
	// 	array('tab'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	// 	array('hierarchical' => true,     /* if this is true, it acts like categories */
	// 		'labels' => array(
	// 			'name' => __( 'Tab Categories', 'viradeco' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Tab Category', 'viradeco' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Tab Categories', 'viradeco' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Tabs Categories', 'viradeco' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Tab Category', 'viradeco' ),  parent title for taxonomy 
	// 			'parent_item_colon' => __( 'Parent Tab Category:', 'viradeco' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Tab Category', 'viradeco' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Tab Category', 'viradeco' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Tab Category', 'viradeco' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Tab category Name', 'viradeco' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true, 
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array( 'slug' => 'tab-cat' ),
	// 		'show_in_nav_menus' => true,
	// 	)
	// );
	
	// now let's add custom tags (these act like categories)
	

	register_taxonomy( 'link_cat', 
		array('link'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Link Categories', 'viradeco' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Link Category', 'viradeco' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Link Categories', 'viradeco' ), /* search title for taxomony */
				'all_items' => __( 'All Links Categories', 'viradeco' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Link Category', 'viradeco' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Link Category:', 'viradeco' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Link Category', 'viradeco' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Link Category', 'viradeco' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Link Category', 'viradeco' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Link Category Name', 'viradeco' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'link-cat' ),
			'show_in_nav_menus' => false,
		)
	);
	
	// now let's add custom tags (these act like categories)
	
	



	

	
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
	

?>
