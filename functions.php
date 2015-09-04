<?php
/*
Author: Eddie Machado
URL: http://themble.com/viradeco/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD viradeco CORE (if you remove this, the theme will break)
require_once( 'library/viradeco.php' );

//Include and setup custom metaboxes and fields.
if( !class_exists("CMB2") ){
    require_once( dirname(__FILE__)."/library/cmb/init.php" );
}
require_once( 'library/cmb-functions.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
 //require_once( 'library/admin.php' );

/*********************
LAUNCH viradeco
Let's get everything up and running.
*********************/

function viradeco_ahoy() {

  //Allow editor style.
  //add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'viradeco', get_template_directory() . '/languages' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'viradeco_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'viradeco_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'viradeco_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'viradeco_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'viradeco_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'viradeco_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  viradeco_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'viradeco_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'viradeco_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'viradeco_excerpt_more' );

} /* end viradeco ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'viradeco_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

// if ( ! isset( $content_width ) ) {
//  $content_width = 640;
// }

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'banner', 1200, 500, array( 'center', 'center' ) );
add_image_size( 'product-thumb', 30, 30, array( 'center', 'center' ) );
add_image_size( 'detail-thumb', 53, 53, array( 'center', 'center' ) );
add_image_size( 'project-thumb', 130, 130, array( 'center', 'center' ) );

add_filter( 'image_size_names_choose', 'viradeco_custom_sizes' );
 
function viradeco_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'slider' => __( 'Slider Size' ),
        'slider-thumb' => __( 'Slider Thumb' ),
    ) );
}

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'viradeco-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'viradeco-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'viradeco_custom_image_sizes' );

function viradeco_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'banner' => __('1200px by 500px'),
        'product-thumb' => __('30px by 30px'),
        'detail-thumb' => __('53px by 53px'),
        'project-thumb' => __('130px by 130px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function viradeco_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'viradeco_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function viradeco_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar',
    'name' => __( 'Sidebar', 'viradeco' ),
    'description' => __( 'The first (primary) sidebar.', 'viradeco' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'id' => 'footer-first',
    'name' => __( 'Footer First', 'viradeco' ),
    'description' => __( 'The first footer widget area', 'viradeco' ),
    'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'id' => 'footer-second',
    'name' => __( 'Footer Second', 'viradeco' ),
    'description' => __( 'The second footer widget area', 'viradeco' ),
    'before_widget' => '<aside id="%1$s" class="footer-second widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  /*
  to add more sidebars or widgetized areas, just copy
  and edit the above sidebar code. In order to call
  your new sidebar just use the following code:

  Just change the name to whatever your new
  sidebar's id is, for example:

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Sidebar 2', 'viradeco' ),
    'description' => __( 'The second (secondary) sidebar.', 'viradeco' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  To call the sidebar in your template, you can just copy
  the sidebar.php file and rename it to your sidebar's name.
  So using the above example, it would be:
  sidebar-sidebar2.php

  */
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function viradeco_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'viradeco' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'viradeco' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'viradeco' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'viradeco' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


function viradeco_pagination(){
  global $wp_query;

      $big = 999999999; 
      echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_text'    => __('<i class="fa fa-angle-double-right"></i>','viradeco'),
        'next_text'    => __('<i class="fa fa-angle-double-left"></i>','viradeco')
      ) );
}


function viradeco_SearchFilter($query) {
    if ($query->is_search) {
      $query->set('post_type', array('post','news','notify'));
    }
    return $query;
    }

add_filter('pre_get_posts','viradeco_SearchFilter');

function viradeco_add_query_vars_filter( $vars ){
  $vars[] = "sub_id";
  return $vars;
}
add_filter( 'query_vars', 'viradeco_add_query_vars_filter' );

// add_filter( 'the_content', 'viradeco_remove_br_gallery', 11, 2);
// function viradeco_remove_br_gallery($output) {
//     return preg_replace('/<br style=(.*)>/mi','',$output);
// }
/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function viradeco_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

//add_action('wp_enqueue_scripts', 'viradeco_fonts');

// Enable support for HTML5 markup.
  add_theme_support( 'html5', array(
    'comment-list',
    'search-form',
    'comment-form'
  ) );



/* DON'T DELETE THIS CLOSING TAG */ 
/*---------------Widgets----------------------*/

// Creating the widget 
class last_products_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'last_products_widget', 

        // Widget name will appear in UI
        __('Last Products Widget', 'viradeco'), 

        // Widget description
        array( 'description' => __( 'Display Last Products', 'viradeco' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $number = $instance['number'];
        $term = get_term($instance['cat'],'product_cat');

        //var_dump($instance);
        $products = get_posts(array(
            'post_type' => 'product',
            'posts_per_page' => $number,
            'product_cat'         => $term->slug,
            )
        );
       
        $content = '<ul class="widget-list">';
        foreach($products as $product) : setup_postdata( $product );
          $url = get_the_permalink($product->ID);
          $thumb = get_the_post_thumbnail($product->ID,'product-thumb');
          $name = $product->post_title;
          $content .='<li><a href="'.$url.'">'.$thumb.'<span>'.$name.'</span></a><li>';
        endforeach;
        $content .= '</ul>';

      
       

        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        
        if ( ! empty( $title ) )
          echo $args['before_title'] . $title . $args['after_title'];
          echo $content;
        // This is where you run the code and display the output
          echo $args['after_widget'];
    }
        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Last Products', 'viradeco' );
        }
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }else {
            $number = 5;
        }
        if ( isset( $instance[ 'cat' ] ) ) {
            $cat = $instance[ 'cat' ];
        }else {
            $cat ="";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'product Numbers :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Product Category :','viradeco' ); ?></label> 
           <?php wp_dropdown_categories(array(
                  'name'               => $this->get_field_name( 'cat' ),
                  'id'                 => $this->get_field_id( 'cat' ),
                  'class'              => 'widefat',
                  'taxonomy'           => 'product_cat',
                  'echo'               => '1',
                  'selected'          =>esc_attr( $cat ),
            )); ?>


        </p>
        
        <?php 
    }
      
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['cat'] = ( ! empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
        //var_dump($instance);
        return $instance;
    }
} // Class wpb_widget ends here

class last_projects_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'last_projects_widget', 

        // Widget name will appear in UI
        __('Last Projects Widget', 'viradeco'), 

        // Widget description
        array( 'description' => __( 'Display Last Projects', 'viradeco' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $number = $instance['number'];
        $term = get_term($instance['cat'],'project_cat');

        $projects = get_posts(array(
            'post_type' => 'project',
            'posts_per_page' => $number,
            'project_cat' => $term->slug,
            )
        );
        //var_dump($notifies);
        $content = '<ul class="widget-list">';
        foreach($projects as $project) : setup_postdata( $project );
          $url = get_the_permalink($project->ID);
          $thumb = get_the_post_thumbnail($project->ID,'product-thumb');
          $name = $project->post_title;
          $content .='<li><a href="'.$url.'">'.$thumb.'<span>'.$name.'</span></a><li>';
        endforeach;
        $content .= '</ul>';

      
       

        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        
        if ( ! empty( $title ) )
          echo $args['before_title'] . $title . $args['after_title'];
          echo $content;
        // This is where you run the code and display the output
          echo $args['after_widget'];
    }
        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Last Projects', 'viradeco' );
        }
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }else {
            $number = 5;
        }
        if ( isset( $instance[ 'cat' ] ) ) {
            $cat = $instance[ 'cat' ];
        }else {
            $cat = "";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Project Numbers :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Project Category :','viradeco' ); ?></label> 
           <?php wp_dropdown_categories(array(
                  'name'               => $this->get_field_name( 'cat' ),
                  'id'                 => $this->get_field_id( 'cat' ),
                  'class'              => 'widefat',
                  'taxonomy'           => 'project_cat',
                  'echo'               => '1',
                  'selected'          =>esc_attr( $cat ),
            )); ?>
        </p>
        <?php 
    }
      
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['cat'] = ( ! empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here


class last_posts_by_cat_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'last_posts_by_cat_widget', 

        // Widget name will appear in UI
        __('Last Posts By Category Widget', 'viradeco'), 

        // Widget description
        array( 'description' => __( 'Display Last Posts in Category', 'viradeco' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $number = $instance['number'];
        $cat = get_category($instance['cat']);

      
        $posts = get_posts(array(
            'post_type' => 'post',
            'posts_per_page' => $number,
            'category'         => $cat->term_id,
            )
        );
        
       
        $content = '<ul class="widget-list">';
        foreach($posts as $post) : setup_postdata( $post );
          $url = get_the_permalink($post->ID);
          $thumb = get_the_post_thumbnail($post->ID,'product-thumb');
          $name = $post->post_title;
          $content .='<li><a href="'.$url.'">'.$thumb.'<span>'.$name.'</span></a><li>';
        endforeach;
        $content .= '</ul>';

      
       

        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        
        if ( ! empty( $title ) )
          echo $args['before_title'] . $title . $args['after_title'];
          echo $content;
        // This is where you run the code and display the output
          echo $args['after_widget'];
    }
        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Last Posts', 'viradeco' );
        }
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }else {
            $number = 5;
        }
        if ( isset( $instance[ 'cat' ] ) ) {
            $cat = $instance[ 'cat' ];
        }else {
            $cat = "";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Post Numbers :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Post Category :','viradeco' ); ?></label> 
        <?php wp_dropdown_categories(array(
                  'name'               => $this->get_field_name( 'cat' ),
                  'id'                 => $this->get_field_id( 'cat' ),
                  'class'              => 'widefat',
                  'taxonomy'           => 'category',
                  'echo'               => '1',
                  'selected'           => esc_attr($cat ),
            )); ?>
        </p>
        <?php 
    }
      
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['cat'] = ( ! empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here

class contact_info_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'contact_info_widget', 

        // Widget name will appear in UI
        __('Contact Informaion Widget', 'viradeco'), 

        // Widget description
        array( 'description' => __( 'Display Contact Information', 'viradeco' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $phone = $instance['phone'];
        $fax = $instance['fax'];
        $email = $instance['email'];
        
                
        $content = '<main class="widgetbody">';
        $content .='<p><i class="fa fa-phone"></i>'.__('Phone : ','viradeco').$phone.'</p>';
        $content .='<p><i class="fa fa-fax"></i>'.__('Fax : ','viradeco').$fax.'</p>';
        $content .='<p><i class="fa fa-envelope"></i>'.__('Email : ','viradeco').$email.'</p>';
        $content .= '</main>';
      
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        
        if ( ! empty( $title ) )
          echo $args['before_title'] . $title . $args['after_title'];
          echo $content;
        // This is where you run the code and display the output
          echo $args['after_widget'];
    }
        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Last Posts', 'viradeco' );
        }

        if ( isset( $instance[ 'phone' ] ) ) {
            $phone = $instance[ 'phone' ];
        }else {
            $phone = "+98 ----";
        }

        if ( isset( $instance[ 'fax' ] ) ) {
            $fax = $instance[ 'fax' ];
        }else {
            $fax = "+98 ----";
        }

        if ( isset( $instance[ 'email' ] ) ) {
            $email = $instance[ 'email' ];
        }else {
            $email = "info@email.com";
        }
        
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone Number :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e( 'Fax Number :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" type="text" value="<?php echo esc_attr( $fax ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email Address :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
        </p>
        
        <?php 
    }
      
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
        $instance['fax'] = ( ! empty( $new_instance['fax'] ) ) ? strip_tags( $new_instance['fax'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here

class social_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'social_widget', 

        // Widget name will appear in UI
        __('Social Networks Widget', 'viradeco'), 

        // Widget description
        array( 'description' => __( 'Social Networks and Important links', 'viradeco' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $google = $instance['google'];
        $facebook = $instance['facebook'];
        $linkedin = $instance['linkedin'];
        $instagram = $instance['instagram'];
        $catalog = $instance['catalog'];
        $email = $instance['email'];
        $login = $instance['login'];
        
        
                
        $content = '<ul class="social-links">';
        $content .='<li><a class="sicon google-plus" href="'.esc_url($google).'">Google Plus</a></li>';
        $content .='<li><a class="sicon facebook" href="'.esc_url($facebook).'">Facebook</a></li>';
        $content .='<li><a class="sicon linkedin" href="'.esc_url($linkedin).'">Linkedin</a></li>';
        $content .='<li><a class="sicon instagram" href="'.esc_url($instagram).'">Instagram</a></li>';
        $content .='<li><a class="sicon catalog" href="'.esc_url($catalog).'">'.__('Download Cataloge','viradeco').'</a></li>';
        $content .='<li><a class="sicon envelope" href="'.esc_url($email).'">'.__('Send Email','viradeco').'</a></li>';
        $content .='<li><a class="sicon unlock" href="'.esc_url($login).'">'.__('Login','viradeco').'</li>';
        $content .= '</ul>';
      
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        
        if ( ! empty( $title ) )
          echo $args['before_title'] . $title . $args['after_title'];
          echo $content;
        // This is where you run the code and display the output
          echo $args['after_widget'];
    }
        
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Social Links', 'viradeco' );
        }

        

        if ( isset( $instance[ 'google' ] ) ) {
            $google = $instance[ 'google' ];
        }else {
            $google = "";
        }
        if ( isset( $instance[ 'facebook' ] ) ) {
            $facebook = $instance[ 'facebook' ];
        }else {
            $facebook = "";
        }
        if ( isset( $instance[ 'linkedin' ] ) ) {
            $linkedin = $instance[ 'linkedin' ];
        }else {
            $linkedin = "";
        }
        if ( isset( $instance[ 'instagram' ] ) ) {
            $instagram = $instance[ 'instagram' ];
        }else {
            $instagram = "";
        }
        if ( isset( $instance[ 'catalog' ] ) ) {
            $catalog = $instance[ 'catalog' ];
        }else {
            $catalog = "";
        }
        if ( isset( $instance[ 'email' ] ) ) {
            $email = $instance[ 'email' ];
        }else {
            $email = "";
        }
        if ( isset( $instance[ 'login' ] ) ) {
            $login = $instance[ 'login' ];
        }else {
            $login = wp_login_url();
        }
        
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e( 'Google Plus Url :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" type="text" value="<?php echo esc_attr( $google ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Url :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linkedin Url :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram Url :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'catalog' ); ?>"><?php _e( 'Catalog Download url :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'catalog' ); ?>" name="<?php echo $this->get_field_name( 'catalog' ); ?>" type="text" value="<?php echo esc_attr( $catalog ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Send Email Url :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'login' ); ?>"><?php _e( 'Login Url :','viradeco' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'login' ); ?>" name="<?php echo $this->get_field_name( 'login' ); ?>" type="text" value="<?php echo esc_attr( $login ); ?>" />
        </p>

        
        
        <?php 
    }
      
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['google'] = ( ! empty( $new_instance['google'] ) ) ? strip_tags( $new_instance['google'] ) : '';
        $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
        $instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        $instance['catalog'] = ( ! empty( $new_instance['catalog'] ) ) ? strip_tags( $new_instance['catalog'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
        $instance['login'] = ( ! empty( $new_instance['login'] ) ) ? strip_tags( $new_instance['login'] ) : '';
        
        return $instance;
    }
} // Class wpb_widget ends here



// Register and load the widget
function viradeco_widget() {
  register_widget( 'last_products_widget' );
  register_widget( 'last_projects_widget' );
  register_widget( 'last_posts_by_cat_widget' );
  register_widget( 'contact_info_widget' );
  register_widget( 'social_widget' );
}
add_action( 'widgets_init', 'viradeco_widget' );

function viradeco_get_image_src($src="" , $size=""){
    $path_info = pathinfo($src);
    return $path_info['dirname'].'/'.$path_info['filename'].'-'.$size.'.'.$path_info['extension'];
}

//-----------Menu Walker------------------------
class Menu_With_Image extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth = '0', $args = array(), $id = '0') {
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    
    $menu_thumb = "";
    if($item->object == 'project' || $item->object == 'product'){
       $menu_thumb = get_the_post_thumbnail($item->object_id , 'product-thumb');
       //var_dump($menu_thumb);
    }

    $class_names = $value = '';
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';
    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
    $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
    $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
    $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .$menu_thumb. apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    //$item_output .= '<br /><span class="sub">' . $item->description . '</span>';
    $item_output .= '</a>';
    $item_output .= $args->after;
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

function viradeco_filter_search($query) {
    if ($query->is_search) {
  $query->set('post_type', array('post', 'product','project'));
    };
    return $query;
};
add_filter('pre_get_posts', 'viradeco_filter_search');

// vira club id


function viradeco_create_account(){
    //You may need some data validation here
    
      global $wpdb;
      global $user_errors;
      $user_errors = new WP_Error();
      
        
        $fname = esc_attr(( isset($_POST['fname']) ? $_POST['fname'] : '' ));
        $lname = esc_attr(( isset($_POST['lname']) ? $_POST['lname'] : '' ));
        $user = esc_attr(( isset($_POST['uname']) ? $_POST['uname'] : '' ));
        $birthday = esc_attr(( isset($_POST['birthday']) ? $_POST['birthday'] : '' ));
        $birthmonth = esc_attr(( isset($_POST['birthmonth']) ? $_POST['birthmonth'] : '' ));
        $birthyear = esc_attr(( isset($_POST['birthyear']) ? $_POST['birthyear'] : '' ));
        $job = esc_attr(( isset($_POST['job']) ? $_POST['job'] : '' ));
        $phone = esc_attr(( isset($_POST['phone']) ? $_POST['phone'] : '' ));
        $pass = esc_attr(( isset($_POST['upass']) ? $_POST['upass'] : '' ));
        $email = esc_attr(( isset($_POST['uemail']) ? $_POST['uemail'] : '' ));

        


        if($email && $pass && $user){

          // if( $birthday && (!is_int($birthday) || $birthday < 1 || $birthday > 31)){
          //   $user_errors->add( 'birthday',__('Birth Day must be a number between 1 & 31','viradeco'),$birthday );         
          //   var_dump(is_int($birthday));
             
          // }
          // if($birthmonth && (!is_int($birthmonth) || $birthmonth < 1 || $birthmonth > 12)){
          //   $user_errors->add( 'birthmonth',__('Birth Month must be a number between 1 & 31','viradeco'),$birthmonth );         
          //   var_dump(is_int($birthmonth));
             
          // }
          // if($birthyear && !is_int($birthyear)){
          //   $user_errors->add( 'birthyear',__('Birth Year must be Number','viradeco'),$birthyear );         
          //  var_dump(is_int($birthyear));
             
          // }
          // if($phone && !is_int($phone)){
          //   $user_errors->add( 'phone',__('Phone must be a Number','viradeco'),$phone );         
          //    var_dump(is_int($phone));
          // }
         
          
              if ( !username_exists( $user )  && !email_exists( $email ) && 1 > count($user_errors->get_error_messages()) ) {

                 $user_id = wp_create_user( $user, $pass, $email );
                     
                     if( !is_wp_error($user_id) ) {
                         //user has been created
                         $user = new WP_User( $user_id );
                         $user->set_role( 'subscriber' );
                         
                        update_user_meta( $user_id, 'first_name', $fname );
                        update_user_meta( $user_id, 'last_name', $lname );
                        update_user_meta( $user_id, 'birthday', $birthday );
                        update_user_meta( $user_id, 'birthmonth', $birthmonth );
                        update_user_meta( $user_id, 'birthyear', $birthyear );
                        update_user_meta( $user_id, 'phone', $phone );
                        update_user_meta( $user_id, 'job', $job );

                        if(current_user_can('edit_posts')){
                          $firstid = 1999;
                        }else{
                          $firstid = 2999;
                        }
                        $latestid=$wpdb->get_var("SELECT meta_value from $wpdb->usermeta where meta_key='viraclub' order by meta_value DESC limit 1;");
                        $latestid = ($latestid)?($latestid):($firstid);
                        update_user_meta( $user_id, 'viraclub', $latestid+1 );
                         //Redirect
                         //wp_redirect( 'URL_where_you_want_redirect' );
                         //exit;
                     } else {
                        
                         var_dump($user_id->get_error_message());
                     }
              } else {
                 $user_errors->add( 'userexists',__('Another user have been registered by this User Name or Email','viradeco') );

              }
        } else {
            $user_errors->add( 'requiredfields',__('Please fill the required fields : User Name - Email - Password','viradeco') );         
        }
    

}
add_action('init','viradeco_create_account');


// registration and login form shortcode
function viradeco_user_register( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'attr_1' => 'attribute 1 default',
        'attr_2' => 'attribute 2 default',
        // ...etc
    ), $atts );

    global $user_errors;
      
      
      
      $required = $user_errors->get_error_messages('requiredfields');
          $required = (!empty($required))?$required:array('');
      $userexists = $user_errors->get_error_messages('userexists');
          $userexists = (!empty($userexists))?$userexists:array('');
      // $birthday = $user_errors->get_error_messages('birthday');
      //     $birthday = (!empty($birthday))?$birthday:array('');
      // $birthmonth = $user_errors->get_error_messages('birthmonth');
      //     $birthmonth = (!empty($birthmonth))?$birthmonth:array('');
      // $birthyear = $user_errors->get_error_messages('birthyear');
      //     $birthyear = (!empty($birthyear))?$birthyear:array('');
      $phone = $user_errors->get_error_messages('birthyearphone');
          $phone = (!empty($phone))?$phone:array('');

    
    $register_form = '';
    $register_form .= '<div class="forms_buttons"><a href="#" id="register-show" class="register-show">'.__('Vira Club Registeration','viradeco').'</a>';
    $register_form .= '<a href="#" id="login-show" class="login-show">'.__('Login to Site','viradeco').'</a></div>';
    $register_form .= '<div class="register-container">';
        $register_form .= '<label class="form_error">'.$required[0].'</label>';
        $register_form .= '<label class="form_error">'.$userexists[0].'</label>';
        $register_form .= '<form method="post" name="registerForm">';
           $register_form .='<table>';
               $register_form .= '<tr><th>'.__('First Name','viradeco').'</th><td>'.'<input id="fname" type="text"  name="fname" />'.'</td></tr>';
                $register_form .='<tr><th>'. __('Last Name','viradeco').'</th><td>'. '<input id="lname" type="text" name="lname" />'.'</td></tr>';
                $register_form .= '<tr><th>'.__('UserName','viradeco').'</th><td>'. '<input id="uname" type="text" name="uname" />'.'</td></tr>';
                $register_form .= '<tr><th>'.__('Birthday','viradeco').'</th><td>'. '<input id="birthday" type="number" name="birthday" min="1" max="31"/>'.'</td></tr>';
                    
                $register_form .= '<tr><th>'.__('Birth Month','viradeco').'</th><td>'. '<input id="birthmonth" type="number" name="birthmonth" min="1" max="12"/>'.'</td></tr>';
                   
                $register_form .='<tr><th>'. __('Birth Year','viradeco').'</th><td>'. '<input id="birthyear" type="number" name="birthyear" min="1300"/>'.'</td></tr>';
                    
                $register_form .= '<tr><th>'.__('Job','viradeco').'</th><td>'. '<input id="job" type="text" name="job" />'.'</td></tr>';
                $register_form .= '<tr><th>'.__('Phone','viradeco').'</th><td>'. '<input id="phone" type="number" min="1111"  name="phone" />'.'</td></tr>';
                    
                $register_form .= '<tr><th>'.__('Email','viradeco').'</th><td>'. '<input id="email" type="text" name="uemail" />'.'</td></tr>';
                $register_form .= '<tr><th>'.__('Password','viradeco').'</th><td>'.'<input type="password" pattern=".{6,}"  name="upass" />'.'</td></tr>';
                $register_form .= '<tr><th></th><td><small>'.__('At least 6 character.','viradeco').'</small></td></tr>';
                $register_form .= '<tr><td>'.'<input type="submit" value="Submit" />'.'</td></tr>';
            $register_form .= '</table>';
        $register_form .= '</form>';
    $register_form .= '</div>';
    if ( !is_user_logged_in() ) {
        return $register_form;
    }
}
add_shortcode( 'vira_register', 'viradeco_user_register' );

//user login shortcode
function viradeco_user_login(){
  $args = array('echo'=>false);
  if ( !is_user_logged_in() ) {
      return '<div class="login-container">'.wp_login_form( $args ).'</div>';
  }
}
add_shortcode( 'vira_login', 'viradeco_user_login' );


// user profile shortcode
function viradeco_user_profile( $atts, $content = null ) {
    // $a = shortcode_atts( array(
    //     'attr_1' => 'attribute 1 default',
    //     'attr_2' => 'attribute 2 default',
    //     // ...etc
    // ), $atts );
    $user_profile = "";
    if ( is_user_logged_in() ) {
      $current_user = wp_get_current_user();
    /**
     * @example Safe usage: $current_user = wp_get_current_user();
     * if ( !($current_user instanceof WP_User) )
     *     return;
     */
      $user_profile .= '<h3 class="article-title">'.__('User Profile','viradeco').'</h3>';
       $user_profile .=  '<div class="avatar-container">'.get_avatar($current_user->ID).'</div>';
       
      $user_profile .= __('first name: ','viradeco') . $current_user->user_firstname . '<br />';
       $user_profile .= __('last name: ','viradeco') . $current_user->user_lastname . '<br />';
       $user_profile .= __('Username: ','viradeco') . $current_user->user_login . '<br />';
      
        $user_profile .= __('Birthday: ','viradeco') .get_user_meta($current_user->ID , 'birthday',true).' - '.get_user_meta($current_user->ID , 'birthmonth',true) .' - '.get_user_meta($current_user->ID , 'birthyear',true). '<br />';
        $user_profile .= __('Phone: ','viradeco') .get_user_meta($current_user->ID , 'phone',true) . '<br />';
         $user_profile .= __('Email: ','viradeco') . $current_user->user_email . '<br />';
        $user_profile .= __('Job: ','viradeco') .get_user_meta($current_user->ID , 'job',true) . '<br />';
       if(!current_user_can('edit_posts')){
           $user_profile .= __('Vira Club ID: ','viradeco') .'<span class="viraid">V'.get_user_meta($current_user->ID , 'viraclub',true) . '</span><br />';
          
      }
       $user_profile .= '<br />'.'<a class="vira_logout" href="'.wp_logout_url( get_permalink() ).'">'.__('Logout','viradeco').'</a>';

       
      
    } 

    return $user_profile;
}
add_shortcode( 'vira_profile', 'viradeco_user_profile' );



//--------------------- user extra fields ----------------------
add_action( 'show_user_profile', 'viradeco_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'viradeco_extra_user_profile_fields' );
function viradeco_extra_user_profile_fields( $user ) {
?>
  <h3><?php _e("Extra profile information", "viradeco"); ?></h3>
  <table class="form-table">
    <tr>
      <th><label for="birthday"><?php __("birthday",'viradeco'); ?></label></th>
      <td>
        <input type="text" name="birthday" id="Birth Day" class="regular-text" 
            value="<?php echo esc_attr( get_user_meta( $user->ID,'birthday' ,true) ); ?>" /><br />
        <span class="description"><?php __("Please enter your Birthday.","viradeco"); ?></span>
    </td>
    </tr>
    <tr>
      <th><label for="birthmonth"><?php __("Birth Month",'viradeco'); ?></label></th>
      <td>
        <input type="text" name="birthmonth" id="birthmonth" class="regular-text" 
            value="<?php echo esc_attr( get_user_meta( $user->ID,'birthmonth' ,true) ); ?>" /><br />
        <span class="description"><?php __("Please enter your Birth Month.","viradeco"); ?></span>
    </td>
    </tr>
    <tr>
      <th><label for="birthyear"><?php __("Birth Year",'viradeco'); ?></label></th>
      <td>
        <input type="text" name="birthyear" id="birthyear" class="regular-text" 
            value="<?php echo esc_attr( get_user_meta( $user->ID,'birthyear' ,true) ); ?>" /><br />
        <span class="description"><?php __("Please enter your Birth Year.","viradeco"); ?></span>
    </td>
    </tr>
    <tr>
      <th><label for="phone"><?php __("Phone",'viradeco'); ?></label></th>
      <td>
        <input type="text" name="phone" id="phone" class="regular-text" 
            value="<?php echo esc_attr( get_user_meta(  $user->ID ,'phone',true) ); ?>" /><br />
        <span class="description"><?php __("Please enter your phone.","viradeco"); ?></span>
    </td>
    </tr>
    <tr>
      <th><label for="job"><?php __("Job",'viradeco'); ?></label></th>
      <td>
        <input type="text" name="job" id="job" class="regular-text" 
            value="<?php echo esc_attr( get_user_meta( $user->ID ,'job',true) ); ?>" /><br />
        <span class="description"><?php __("Please enter your Job.","viradeco"); ?></span>
    </td>
    </tr>
    <tr>
      <th><label for="viraclub"><?php __("Vira club ID",'viradeco'); ?></label></th>
      <td>
        <input type="text" disabled name="viraclub" id="viraclub" class="regular-text" 
            value="<?php echo 'V'.esc_attr( get_user_meta( $user->ID,'viraclub' ,true) ); ?>" /><br />
        
    </td>
    </tr>
  </table>
<?php
}

add_action( 'personal_options_update', 'viradeco_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'viradeco_save_extra_user_profile_fields' );
function viradeco_save_extra_user_profile_fields( $user_id ) {
  $saved = false;
  if ( current_user_can( 'edit_user', $user_id ) ) {
    update_user_meta( $user_id, 'birthday', $_POST['birthday'] );
    update_user_meta( $user_id, 'birthmonth', $_POST['birthmonth'] );
    update_user_meta( $user_id, 'birthyear', $_POST['birthyear'] );
    update_user_meta( $user_id, 'phone', $_POST['phone'] );
    update_user_meta( $user_id, 'job', $_POST['job'] );
    $saved = true;
  }
  return true;
}


//auto login user after registration
function log_me_the_f_in( $user_id ) {
    $user = get_user_by('id',$user_id);
    $username = $user->user_nicename;
    $user_id = $user->ID;
    wp_set_current_user($user_id, $username);
    wp_set_auth_cookie($user_id);
    do_action('wp_login', $username, $user);
}
add_action( 'user_register', 'log_me_the_f_in' );

//add columns to User panel list page
function Viradeco_add_user_columns($column) {
    $column['viraclub'] = __('ViraClub ID','viradeco');
    $column['phone'] = __('Phone','viradeco');
    $column['email'] = __('Email','viradeco');
    
    return $column;
}
add_filter( 'manage_users_columns', 'viradeco_add_user_columns' );

//add the data
function viradeco_add_user_column_data( $val, $column_name, $user_id ) {
    

    switch ($column_name) {
        case 'viraclub' :
            return 'V'.get_user_meta($user_id,'viraclub',true);
            break;
        case 'phone' :
            return get_user_meta($user_id,'phone',true);
            break;
        case 'email' :
            return get_user_meta($user_id,'uemail',true);
            break;
        default:
    }
    return;
}
add_filter( 'manage_users_custom_column', 'viradeco_add_user_column_data', 10, 3 );