<?php
/**
 * elementors blocks
 *
 * @since 1.0.0
 * @return void 
 */
function xooapp_load_elements() {


    load_plugin_textdomain( 'xooapp' );

    // Notice if the Elementor is not active
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'xooapp_elementor_fail_load' );
        return;
    }

    // Check version required
    $elementor_version_required = '1.0.0';
    if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
        add_action( 'admin_notices', 'xooapp_elementor_is_active' );
        return;
    }

    // Require the main plugin file
    require( __DIR__ . '/elementor-blocks.php' );   //loading the main plugin

    
}
add_action( 'plugins_loaded', 'xooapp_load_elements');   //notiung but checking and notice

function xooapp_elementor_fail_load() {
    $message = '<p>' . __( 'Please Install and Active Elementor Plugin First. Xooapp Theme require Elementor Plugin to work perfectly.', 'xooapp' ) . '</p>';

    echo '<div class="error">' . $message . '</div>';
}

function xooapp_elementor_is_active() {
    if ( ! current_user_can( 'update_plugins' ) ) {
        return;
    }

    $file_path = 'elementor/elementor.php';

    $upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
    $message = '<p>' . __( 'Xooapp Master may not work or is not compatible because you are using an old version of Elementor.', 'xooapp' ) . '</p>';
    $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'xooapp' ) ) . '</p>';

    echo '<div class="error">' . $message . '</div>';
}