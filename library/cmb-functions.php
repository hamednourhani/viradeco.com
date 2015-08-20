<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the viradeco directory)
 *
 * Be sure to replace all instances of 'viradeco_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_viradeco
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/viradeco
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}


function ed_metabox_include_front_page( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'] ) ) {
        return $display;
    }

    if ( 'front-page' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return !$display;
    }

    // Get ID of page set as front page, 0 if there isn't one
    $front_page = get_option( 'page_on_front' );

    // there is a front page set and we're on it!
    return $post_id == $front_page;
}
//add_filter( 'cmb2_show_on', 'ed_metabox_include_front_page', 10, 2 );
/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' viradeco_box parameter
 *
 * @param  viradeco object $cmb viradeco object
 *
 * @return bool             True if metabox should show
 */
function viradeco_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  viradeco_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function viradeco_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  viradeco_Field object $field      Field object
 */
function viradeco_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}


/******************************************************************/
/*--------------------Link Page-----------------------------------*/
/******************************************************************/

add_action('cmb2_init','viradeco_register_link_metabox');
// add_action('cmb2_init','viradeco_register_tour_information_metabox');
function viradeco_register_link_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_viradeco_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'link_metabox',
		'title'         => __( 'Link Information', 'viradeco' ),
		'object_types'  => array( 'link' ), // Post type
		// 'show_on_cb' => 'viradeco_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'link address', 'viradeco' ),
		'desc'       => __( 'the web address of link', 'viradeco' ),
		'id'         => $prefix . 'link_url',
		'type'       => 'text_url',
		//'show_on_cb' => 'viradeco_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	
}



/******************************************************************/
/*--------------------Gallery Page-----------------------------------*/
/******************************************************************/


 add_action( 'cmb2_init', 'viradeco_register_gallery_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function viradeco_register_gallery_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_viradeco_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'gallery_metabox',
		'title'         => __( 'Gallery Images', 'viradeco' ),
		'object_types'  => array( 'gallery' ), // Post type
		// 'show_on_cb' => 'viradeco_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );


	
	$cmb_demo->add_field( array(
		'name'         => __( 'Images', 'viradeco' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'viradeco' ),
		'id'           => $prefix . 'image_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

	

}

/******************************************************************/
/*--------------------Tab Maker Page-------------------------------*/
/******************************************************************/
 add_action( 'cmb2_init', 'viradeco_register_tab_maker_metabox' );
function viradeco_register_tab_maker_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_viradeco_group_';
	
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'tab_metabox',
		'title'        => __( 'Tabs', 'viradeco' ),
		'object_types' => array( 'tab', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix.'tab',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'viradeco' ),
		'options'     => array(
			'group_title'   => __( 'Sub Tab {#}', 'viradeco' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Sub Tab', 'viradeco' ),
			'remove_button' => __( 'Remove Sub Tab', 'viradeco' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	// WP_Query arguments
	
	
	$sub_tabs = get_posts(array(
			'post_type' => 'sub_tab',
			// 'posts_per_page' => -1,
			)
	);
	

	
	$sub_array = array();
	foreach ( $sub_tabs as $sub_tab ) : setup_postdata( $sub_tab );
			$sub_array[$sub_tab->ID] = $sub_tab->post_title;
 	endforeach; 
 	//wp_reset_postdata();
	
	// $cmb_group->add_group_field( $group_field_id, array(
	// 	'name'        => __( 'Tab Title', 'viradeco' ),
	// 	'description' => __( 'Enter Tab Title', 'viradeco' ),
	// 	'id'          => 'tab_title',
	// 	'type'        => 'text',
	// ) );

	
 	
 	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Sub Tab Name', 'viradeco' ),
		'desc'    => __( 'write the sub tab name ', 'viradeco' ),
		'id'      => 'tab_name',
		'type'    => 'text',
		
			
	) );
	
	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Choose a sub Tab ', 'viradeco' ),
		'desc'    => __( 'Choose a  the sub tab from list ', 'viradeco' ),
		'id'      => 'tab_id',
		'type'    => 'select',
		'options' => $sub_array,
			
	) );
	
	
}
/******************************************************************/
/*--------------------Section Maker-------------------------------*/
/******************************************************************/

add_action('cmb2_init','viradeco_register_section_maker_metabox');
// add_action('cmb2_init','viradeco_register_tour_information_metabox');
function viradeco_register_section_maker_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_viradeco_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'section_maker_metabox',
		'title'         => __( 'Section Selection', 'viradeco' ),
		'object_types'  => array( 'post','page','news' ), // Post type
		// 'show_on_cb' => 'viradeco_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	

	$cmb_demo->add_field( array(
		'name'       => __( 'news slider', 'viradeco' ),
		'desc'       => __( 'show news slider', 'viradeco' ),
		'id'         => $prefix . 'slider_show',
		'type'       => 'radio_inline',
		'show_option_none' => true,
		'options'          => array(
			'true' => __( 'Yes', 'viradeco' ),
			
		),	
		
		//'show_on_cb' => 'viradeco_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	
	$cmb_demo->add_field( array(
		'name'       => __( 'hide content', 'viradeco' ),
		'desc'       => __( 'hide page content', 'viradeco' ),
		'id'         => $prefix . 'content',
		'type'       => 'radio_inline',
		'show_option_none' => true,
		'options'          => array(
			'true' => __( 'Yes', 'viradeco' ),
			
			
			
			
		),
		//'show_on_cb' => 'viradeco_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'show comments', 'viradeco' ),
		'desc'       => __( 'show  page coments', 'viradeco' ),
		'id'         => $prefix . 'comments',
		'type'       => 'radio_inline',
		'show_option_none' => true,
		'options'          => array(
			'true' => __( 'Yes', 'viradeco' ),
			
			
			
			
		),
		//'show_on_cb' => 'viradeco_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );
	$cmb_demo->add_field( array(
		'name'       => __( 'hide sidebar', 'viradeco' ),
		'desc'       => __( 'hide page sidebar', 'viradeco' ),
		'id'         => $prefix . 'sidebar',
		'type'       => 'radio_inline',
		'show_option_none' => true,
		'options'          => array(
			'true' => __( 'Yes', 'viradeco' ),
			
			
			
			
		),
		//'show_on_cb' => 'viradeco_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'show tabs', 'viradeco' ),
		'desc'       => __( 'show tabs or not', 'viradeco' ),
		'id'         => $prefix . 'show_tabs',
		'type'       => 'radio_inline',
		'show_option_none' => true,
		'options'          => array(
			'true' => __( 'Yes', 'viradeco' ),
		),
	) );

	
	$tabs_list = get_posts(array(
			'post_type' => 'tab',
			'posts_per_page' => '100',
			)
	);
	

	
	$tab_array = array();
	foreach ( $tabs_list as $tab ) : setup_postdata( $tab );
			$tab_array[$tab->ID] = $tab->post_title;
 	endforeach; 


	$cmb_demo->add_field( array(
		'name'       => __( 'show tabs', 'viradeco' ),
		'desc'       => __( 'show tabs or not', 'viradeco' ),
		'id'         => $prefix . 'tab_id',
		'type'       => 'select',
		'options'          => $tab_array,

		
	));
	

	$cmb_demo->add_field( array(
		'name'       => __( 'show related links', 'viradeco' ),
		'desc'       => __( 'show related links or not', 'viradeco' ),
		'id'         => $prefix . 'related_links',
		'type'       => 'radio_inline',
		'show_option_none' => true,
		'options'          => array(
			'true' => __( 'Yes', 'viradeco' ),
			
			
			
		),
		
	) );

	
}

/******************************************************************/
/*--------------------Tab Maker Page-------------------------------*/
/******************************************************************/
 add_action( 'cmb2_init', 'viradeco_register_management_maker_metabox' );
function viradeco_register_management_maker_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_viradeco_group_';
	
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'management_metabox',
		'title'        => __( 'Pages', 'viradeco' ),
		'object_types' => array( 'management', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'sub_page',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'viradeco' ),
		'options'     => array(
			'group_title'   => __( 'Page {#}', 'viradeco' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Page', 'viradeco' ),
			'remove_button' => __( 'Remove Page', 'viradeco' ),
			'sortable'      => true, // beta
		),
	) );

	
	
	$pages = get_posts(array(
			'post_type' => 'sub_management',
			'posts_per_page' => '100',
			)
	);
	

	
	$sub_array = array();
	foreach ( $pages as $page ) : setup_postdata( $page );
			$sub_array[$page->ID] = $page->post_title;
 	endforeach; 
 	

	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Page Name', 'viradeco' ),
		'desc'    => __( 'The name of Sub Page ', 'viradeco' ),
		'id'      => 'sub_name',
		'type'    => 'text',
		
			
	) );

	
	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Page', 'viradeco' ),
		'desc'    => __( 'choose a sub page ', 'viradeco' ),
		'id'      => 'sub_id',
		'type'    => 'select',
		'options' => $sub_array,
			
	) );
	
	
}




 add_action( 'cmb2_init', 'viradeco_register_education_maker_metabox' );
function viradeco_register_education_maker_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_viradeco_group_';
	
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'education_metabox',
		'title'        => __( 'Pages', 'viradeco' ),
		'object_types' => array( 'education', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'sub_page',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'viradeco' ),
		'options'     => array(
			'group_title'   => __( 'Page {#}', 'viradeco' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Page', 'viradeco' ),
			'remove_button' => __( 'Remove Page', 'viradeco' ),
			'sortable'      => true, // beta
		),
	) );

		
	
	$pages = get_posts(array(
			'post_type' => 'sub_education',
			'posts_per_page' => '100',
			)
	);
	

	
	$sub_array = array();
	foreach ( $pages as $page ) : setup_postdata( $page );
			$sub_array[$page->ID] = $page->post_title;
 	endforeach; 
 	//wp_reset_postdata();
	
	

	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Page Name', 'viradeco' ),
		'desc'    => __( 'The name of Sub Page ', 'viradeco' ),
		'id'      => 'sub_name',
		'type'    => 'text',
		
			
	) );

	
	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Page', 'viradeco' ),
		'desc'    => __( 'choose a sub page ', 'viradeco' ),
		'id'      => 'sub_id',
		'type'    => 'select',
		'options' => $sub_array,
			
	) );
	
	
}

add_action( 'cmb2_init', 'viradeco_register_related_widget_metabox' );
function viradeco_register_related_widget_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_viradeco_group_';
	
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'related_widget',
		'title'        => __( 'Related Links', 'viradeco' ),
		'object_types' => array( 'management','education' ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'related_links',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'viradeco' ),
		'options'     => array(
			'group_title'   => __( 'Link {#}', 'viradeco' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Link', 'viradeco' ),
			'remove_button' => __( 'Remove Link', 'viradeco' ),
			'sortable'      => true, // beta
		),
	) );

	
	
	
 	

	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Link Name', 'viradeco' ),
		'desc'    => __( 'The name of related link ', 'viradeco' ),
		'id'      => 'link_name',
		'type'    => 'text',
		
			
	) );

	$cmb_group->add_group_field($group_field_id , array(
		'name'    => __( 'Link Url', 'viradeco' ),
		'desc'    => __( 'The Url of Link ', 'viradeco' ),
		'id'      => 'link_url',
		'type'    => 'text_url',
		
			
	) );



	
	
	
	
}