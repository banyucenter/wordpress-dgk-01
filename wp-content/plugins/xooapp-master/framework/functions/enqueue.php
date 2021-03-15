<?php if (! defined('ABSPATH')) {
    die;
} // Cannot access pages directly.
/**
 *
 * Framework admin enqueue style and scripts
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (! function_exists('xooapp_admin_enqueue_scripts')) {
    function xooapp_admin_enqueue_scripts()
    {

      // admin utilities
        wp_enqueue_media();

      // wp core styles
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('wp-jquery-ui-dialog');

      // framework core styles
        wp_enqueue_style('xooapp', XOOAPP_URI .'/assets/css/framework.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('font-awesome', XOOAPP_URI .'/assets/css/font-awesome.min.css', array(), '4.7.0', 'all');

        if (XOOAPP_ACTIVE_LIGHT_THEME) {
            wp_enqueue_style('xooapp-framework-theme', XOOAPP_URI .'/assets/css/framework-light.min.css', array(), "1.0.0", 'all');
        }

        if (is_rtl()) {
            wp_enqueue_style('xooapp-framework-rtl', XOOAPP_URI .'/assets/css/framework-rtl.min.css', array(), '1.0.0', 'all');
        }

      // wp core scripts
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-accordion');

      // framework core scripts
        wp_enqueue_script('xooapp-plugins', XOOAPP_URI .'/assets/js/plugins.min.js', array(), '1.0.0', true);
        wp_enqueue_script('xooapp', XOOAPP_URI .'/assets/js/framework.min.js', array( 'xooapp-plugins' ), '1.0.0', true);
    }
    add_action('admin_enqueue_scripts', 'xooapp_admin_enqueue_scripts');
}
