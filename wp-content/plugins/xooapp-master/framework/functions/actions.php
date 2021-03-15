<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'xooapp_get_icons' ) ) {
  function xooapp_get_icons() {

    do_action( 'XOOAPP_add_icons_before' );

    $jsons = apply_filters( 'xooapp_add_icons_json', glob( XOOAPP_DIR . '/fields/icon/*.json' ) );

    if( ! empty( $jsons ) ) {

      foreach ( $jsons as $path ) {

        $object = XOOAPP_get_icon_fonts( 'fields/icon/'. basename( $path ) );

        if( is_object( $object ) ) {

          echo ( count( $jsons ) >= 2 ) ? '<h4 class="xooapp-icon-title">'. $object->name .'</h4>' : '';

          foreach ( $object->icons as $icon ) {
            echo '<a class="xooapp-icon-tooltip" data-xooapp-icon="'. $icon .'" data-title="'. $icon .'"><span class="xooapp-icon xooapp-selector"><i class="'. $icon .'"></i></span></a>';
          }

        } else {
          echo '<h4 class="xooapp-icon-title">'. esc_html__( 'Error! Can not load json file.', 'xooapp' ) .'</h4>';
        }

      }

    }

    do_action( 'XOOAPP_add_icons' );
    do_action( 'XOOAPP_add_icons_after' );

    die();
  }
  add_action( 'wp_ajax_xooapp-get-icons', 'xooapp_get_icons' );
}

/**
 *
 * Export options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'XOOAPP_export_options' ) ) {
  function XOOAPP_export_options() {

    header('Content-Type: plain/text');
    header('Content-disposition: attachment; filename=backup-options-'. gmdate( 'd-m-Y' ) .'.txt');
    header('Content-Transfer-Encoding: binary');
    header('Pragma: no-cache');
    header('Expires: 0');

    echo XOOAPP_encode_string( get_option( XOOAPP_OPTION ) );

    die();
  }
  add_action( 'wp_ajax_xooapp-export-options', 'XOOAPP_export_options' );
}

/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'XOOAPP_set_icons' ) ) {
  function XOOAPP_set_icons() {

    echo '<div id="xooapp-icon-dialog" class="xooapp-dialog" title="'. esc_html__( 'Add Icon', 'xooapp' ) .'">';
    echo '<div class="xooapp-dialog-header xooapp-text-center"><input type="text" placeholder="'. esc_html__( 'Search a Icon...', 'xooapp' ) .'" class="xooapp-icon-search" /></div>';
    echo '<div class="xooapp-dialog-load"><div class="xooapp-icon-loading">'. esc_html__( 'Loading...', 'xooapp' ) .'</div></div>';
    echo '</div>';

  }
  add_action( 'admin_footer', 'XOOAPP_set_icons' );
  add_action( 'customize_controls_print_footer_scripts', 'XOOAPP_set_icons' );
}
