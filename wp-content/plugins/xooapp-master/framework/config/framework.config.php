<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================

if(class_exists('Xooapp_OneClickDemo')) {
  $settings           = array(
    'menu_title'      => 'XooApp',
    'menu_type'       => 'submenu',
    'menu_slug'       => 'xooapp',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => 'XooApp',
  );

} else {
  $settings           = array(
    'menu_title'      => 'XooApp',
    'menu_type'       => 'menu',
    'menu_slug'       => 'xooapp',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => 'XooApp',
  );
}



$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

$contact_forms = array();
if ( $cf7 ) {
  foreach ( $cf7 as $cform ) {
    $contact_forms[ $cform->ID ] = $cform->post_title;
  }
} else {
  $contact_forms[ __( 'No contact forms found', 'xooapp' ) ] = 0;
}


// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();


// ===================================================================
// Genaral Settings =
// ===================================================================

$options[]      = array(
  'name'        => 'genaral',
  'title'       => 'Genaral Setting',
  'icon'        => 'fa fa-home',
   // begin: fields
  'fields'      => array(


    array(
      'id'           => 'xooapp_preloader_enable',
      'type'         => 'switcher',
      'title'        => 'Preloader On?',
    ),

    array(
      'id'           => 'xooapp_animation_enable',
      'type'         => 'switcher',
      'title'        => 'Theme Animation Enable',
      'desc'         => 'After enable elementor animation effect will works',
      'default'      =>  false,
    ),

    array(
      'type'    => 'subheading',
      'content' => 'Logo Setting',
    ),

    array(
      'id'          => 'xooapp_logo_img',
      'type'        => 'image',
      'title'       => 'Upload Logo',
      'default'     => XOOAPP_PLG_URL. 'framework/assets/images/logo.png',
    ),
    array(
      'id'          => 'xooapp_white_logo_img',
      'type'        => 'image',
      'title'       => 'Upload White Version Logo',
      'default'     => XOOAPP_PLG_URL. 'framework/assets/images/logo-white.png',
    ),

    array(
      'type'    => 'subheading',
      'content' => 'Header Setting',
    ),
    array(
      'id'      => 'header_sign_btn_switch',
      'type'    => 'switcher',
      'title'   => 'Menu Extra Option',
    ),
    

    array(
      'id'              => 'social_settings',
      'type'            => 'group',
      'title'           => 'Menus Social Account',
      'dependency'   => array( 'header_sign_btn_switch', '==', 'true' ),
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

  )
);

// ===================================================================
// Xooappigo Blog Settings =
// ===================================================================

$options[]      = array(
  'name'        => 'blog_setting',
  'title'       => 'Page Setting',
  'icon'        => 'fa fa-pencil-square-o',
   // begin: fields
  'fields'      => array(

    array(
      'type'         => 'heading',
      'content'      => 'Blog Setting',
    ),

    array(
      'id'           => 'blog_layout',
      'type'         => 'image_select',
      'title'        => 'Page Layout Style',
      'options'      => array(
        'left-sidebar'  => XOOAPP_PLG_URL. '/framework/assets/images/sidebar_l.jpg',
        'right-sidebar' => XOOAPP_PLG_URL. '/framework/assets/images/sidebar_r.jpg',
        'full-width'    => XOOAPP_PLG_URL. '/framework/assets/images/fullwidth.jpg',
      ),
    ),

    array(
      'id'           => 'xooapp_social_share',
      'type'         => 'switcher',
      'title'        => 'Social Share',
    ),


  )
);



// ===================================================================
// 404 Page Settings =
// ===================================================================

$options[]      = array(
  'name'        => '404_page',
  'title'       => '404 Page Setting',
  'icon'        => 'fa fa-frown-o',
  // begin: fields
  'fields'      => array(


    array(
      'id'    => '404_page_title',
      'type'  => 'textarea',
      'title' => '404 Page Description',
      'default' => 'Oops! You’ve got lost in space'
    ),
    array(
      'id'    => 'xooapp_404_desc',
      'type'  => 'textarea',
      'title' => 'Description',
    ), 

  )
);


// ===================================================================
// Footer Options =
// ===================================================================

$options[]      = array(
  'name'        => 'footer_setting',
  'title'       => 'Footer Setting',
  'icon'        => 'fa fa-rub',
  // begin: fields
  'fields'      => array(

    
    array(
      'id'           => 'xooapp_inner_subscription',
      'type'         => 'switcher',
      'title'        => 'Subscription',
    ),

    array(
      'id'    => 'xooapp_subs_title',
      'type'  => 'textarea',
      'dependency'=> array('xooapp_inner_subscription', '==', 'true'),
      'title' => 'Description',
    ), 


    array(
      'id'    => 'xooapp_subs_id',
      'type'  => 'number',
      'dependency'=> array('xooapp_inner_subscription', '==', 'true'),
      'title' => 'Mailchimp ID',
      'desc' => 'ID Will Be [mc4wp_form id="<b>this is the ID<b>"]'
    ), 

    array(
      'id'              => 'footer_menu',
      'type'            => 'group',
      'title'           => 'Footer Menu',
      'button_title'    => 'Add New',
      'accordion_title' => 'Add New Field',
      'fields'          => array(

        array(
          'id'          => 'footer_menu_title',
          'type'        => 'text',
          'title'       => 'Title',
        ),
        array(
          'id'          => 'footer_menu_link',
          'type'        => 'text',
          'title'       => 'Link',
        ),

      ),
    ),
    array(
      'id'        => 'copyrights',
      'type'      => 'textarea',
      'title'     => 'Copyright Footer',
      'default'   => 'Copyright &copy; 2019, Xooapp. Theme Developed by <a href="http://jthemes.com/" title="jthemes"> Jthemes</a>',
      'sanitize'  => false,
    ),



    array(
      'id'           => 'quick_form_on',
      'type'         => 'switcher',
      'title'        => 'Quick Form',
      'default'      => false,
    ),

    array(
      'id'           => 'quick_form_title',
      'type'         => 'text',
      'title'        => 'Title Quick Form - Contact Form 7',
      'dependency'   => array('quick_form_on', '==', 'true'),
      'default'      => 'Quick Contact Form',
    ),
    array(
      'id'           => 'quick_form',
      'type'         => 'select',
      'title'        => 'Select Quick Form - Contact Form 7',
      'dependency'   => array('quick_form_on', '==', 'true'),
      'options'      => $contact_forms,
    ),



  ),
  // end: fields
);



// ------------------------------
// a seperator                  -
// ------------------------------
$options[] = array(
  'name'   => 'seperator_1',
  'title'  => 'A Seperator',
  'icon'   => 'fa fa-bookmark'
);

// ------------------------------
// backup                       -
// ------------------------------
$options[]   = array(
  'name'     => 'backup_section',
  'title'    => 'Backup',
  'icon'     => 'fa fa-shield',
  'fields'   => array(

    array(
      'type'    => 'notice',
      'class'   => 'warning',
      'content' => 'You can save your current options. Download a Backup and Import.',
    ),

    array(
      'type'    => 'backup',
    ),

  )
);


XOOAPPFramework::instance( $settings, $options );
