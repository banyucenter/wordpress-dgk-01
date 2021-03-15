<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();


// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
$options[]      = array(
  'id'            => '_custom_page_options',
  'title'         => 'Page Settings',
  'post_type'     => 'page', // or post or CPT or array( 'page', 'post' )
  'context'       => 'normal',
  'priority'      => 'default',
  'sections'      => array(

    // begin section
    array(
      'name'      => 'onepage_option',
      'title'     => 'Header',
      'icon'      => 'fa fa-tasks',
      'fields'    => array(

        array(
          'id'    => 'menu_trans',
          'type'  => 'switcher',
          'title' => 'Header Menu Dark Bg with Transparent?',
        ),

        array(
          'id'    => 'logo_change',
          'type'  => 'switcher',
          'title' => 'Logo',
          'default' => false,
        ),

        array(
          'id'          => 'xooapp_logo_img',
          'type'        => 'image',
          'title'       => 'Upload Logo',
          'dependency'  => array('logo_change', '==', 'true'),
        ),

        array(
          'id'          => 'xooapp_white_logo_img',
          'type'        => 'image',
          'title'       => 'Upload Logo - After Scroll Down',
          'dependency'  => array('logo_change|menu_trans', '==|==', 'true|true'),
        ),

        array(
          'id'    => 'menu_color',
          'type'  => 'color_picker',
          'title' => 'Menu Color',
        ),

        array(
          'id'      => 'xooapp_onepage_nav',
          'type'    => 'switcher',
          'title'   => 'OnePage Nav On?',
          'default' => false
        ), 


        // a field
        array(
          'id'              => 'onepage_nav',
          'type'            => 'group',
          'title'           => 'Menu Name',
          'button_title'    => 'Add New',
          'accordion_title' => 'Add New Menu',
          'fields'          => array(
            array(
              'id'    => 'menu_name',
              'type'  => 'text',
              'title' => 'Menu Name',
            ),

            array(
              'id'    => 'menu_name_active',
              'type'  => 'checkbox',
              'title' => 'Highlight',
            ),

            array(
              'id'    => 'has_dropdown',
              'type'  => 'switcher',
              'title' => 'Has DropDown',
            ),

            array(
              'id'    => 'drop_menu_list',
              'type'  => 'textarea',
              'attributes' => array(
                'style'    => 'width: 100%; height: 40px; border-color: #93C054;'
              ),
              'dependency' => array('has_dropdown', '==', 'true'),
              'after'         => '<p class="class-name">Please write menu line by line. And for menu devider use <br /> &lt;div class="dropdown-divider"&gt;&lt;/div&gt;<br /> </p>',
              'title' => 'Please Write HTML',
            ),

          ),
          'dependency' => array( 'xooapp_onepage_nav', '==', 'true' ) // dependency rule
        ),


        array(
          'id'    => 'show_social',
          'type'  => 'switcher',
          'title' => 'Social or Button Display?',
        ),

        array(
          'id'    => 'show_social_display',
          'type'  => 'switcher',
          'dependency' => array( 'show_social', '==', 'true' ),
          'title' => 'Social Display?',
        ),

        array(
          'id'              => 'social_settings',
          'type'            => 'group',
          'title'           => 'Menus Social Account',
          'dependency' => array( 'show_social|show_social_display', '==|==', 'true|true' ),
          'button_title'    => 'Add New',
          'accordion_title' => 'Add New',
          'fields'          => array(
            array(
              'id'    => 'social_name',
              'type'  => 'text',
              'title' => 'Menu Name',
            ),

            array(
              'id'    => 'social_icon',
              'type'  => 'icon',
              'title' => 'Choose Icon',
            ),

            array(
              'id'    => 'social_link',
              'type'  => 'text',
              'title' => 'Link',
            ),

          ),
        ),


        array(
          'id'    => 'social_img',
          'type'  => 'image',
          'dependency' => array( 'show_social|show_social_display', '==|==', 'true|false' ),
          'title' => 'Button Image',
        ),

        array(
          'id'    => 'social_img_link',
          'type'  => 'text',
          'dependency' => array( 'show_social|show_social_display', '==|==', 'true|false' ),
          'title' => 'Button Image link',
        ),



      ),

),


array(
  'name'      => 'footer_settings',
  'title'     => 'Footer',
  'icon'      => 'fa fa-tasks',
  'fields'    => array(

    array(
      'id'    => 'footer_color',
      'type'  => 'color_picker',
      'title' => 'Footer Background Color',
    ),

    array(
      'id'    => 'show_footer_subs',
      'type'  => 'switcher',
      'title' => 'Footer Subscription?',
    ),

    array(
      'id'    => 'show_footer_widgets',
      'type'  => 'switcher',
      'title' => 'Footer Widgets?',
    ),

    array(
      'id'    => 'show_footer_link',
      'type'  => 'switcher',
      'title' => 'Footer Link Display?',
    ),



  ),
)


),
);


$post_id = isset($_GET['post']) ? $_GET['post'] : '';

$options[]      = array(
  'id'            => '_custom_page_elementor_options',
  'title'         => 'Elementor Shortcode',
  'post_type'     => 'elementor_library', // or post or CPT or array( 'page', 'post' )
  'context'       => 'side',
  'priority'      => 'high',
  'sections'      => array(

    // begin section

    array(
      'name'      => 'elementor_settings',
      'title'     => 'Shortcode',
      'icon'      => 'fa fa-tasks',
      'fields'    => array(

        array(
          'type'    => 'notice',
          'class'   => 'info',
          'content' => '[XOOAPP_ELEMENTOR id="'. $post_id.  '"]',
        ),
      ),
    )


  ),
);


$options[]      = array(
  'id'            => '_custom_post_control_options',
  'title'         => 'Post Settings',
  'post_type'     => 'post', // or post or CPT or array( 'page', 'post' )
  'context'       => 'side',
  'priority'      => 'high',
  'sections'      => array(

    // begin section

    array(
      'name'      => 'post_settings',
      // 'title'     => 'Post Settings',
      'icon'      => 'fa fa-tasks',
      'fields'    => array(

        
        array(
          'id'    => 'title_featureimag',
          'type'   => 'checkbox',
          'title'   => 'Post Detail - Hide Feature Image',
        ),


      ),
    )


  ),
);


XOOAPPFramework_Metabox::instance( $options );
