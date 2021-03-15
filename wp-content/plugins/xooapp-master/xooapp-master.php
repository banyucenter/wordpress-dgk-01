<?php
/**
 * Plugin Name: XooApp Master
 * Description: XooApp Master is a recommanded plugin for xooapp theme. Theme and plugin Developed By xstheme team.
 * Plugin URI: http://jthemes.org
 * Author: jThemes
 * Author URI: http://jthemes.org
 * Version: 1.0.6
 * License: GPL3
 * Text Domain: xooapp
 * Elementor requires at least: 2.1.0
 * Elementor tested up to: 2.9.14
 */

/*
    Copyright (C) Year  Author  Email

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

    namespace Xooapp\xooapp_master;

    //  Exit if accessed directly.
    defined('ABSPATH') || exit;

    define('XOOAPP_PLG_URL', plugin_dir_url(__FILE__));
    define('XOOAPP_PLG_DIR', dirname(__FILE__));

    ini_set('max_execution_time', 3000);

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  1.0.0
 * @return string
 */
function _get_plugin_directory()
{
    return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  1.0.0
 * @return string
 */
function _get_plugin_url()
{
    static $plugin_url;

    if (empty($plugin_url)) {
        $plugin_url = plugins_url(null, __FILE__);
    }

    return $plugin_url;
}

define('XOOAPP_ACTIVE_SHORTCODE', false); // default false
define('XOOAPP_ACTIVE_LIGHT_THEME', true); // default false


require_once __DIR__  . '/framework/framework.php';

include_once __DIR__ . '/elementor-blocks/elementor.php';

include_once __DIR__ . '/like-love/post-like.php';
include_once __DIR__ . '/minify.php';
include_once __DIR__ . '/custom-widgets.php';
include_once __DIR__ . '/quick-form.php';
include_once __DIR__ . '/demo-importer/one-click-installer.php';
