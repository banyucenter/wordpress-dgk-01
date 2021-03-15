<?php
/**
 * xooapp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xooapp
 */

if (! function_exists('xooapp_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function xooapp_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on xooapp, use a find and replace
         * to change 'xooapp' to the name of your theme in all the template files.
         */
        load_theme_textdomain('xooapp', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
        
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /*
         * Enable post format.
         *
         * @link https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array( 'video' ));


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'xooapp'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('xooapp_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 30,
            'width'       => 130,
            'flex-width'  => true,
            'flex-height' => true,
        ));


        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('assets/css/editor-style.min.css');

        // Adding support for core block visual styles.
        add_theme_support('wp-block-styles');
        
        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add custom editor font sizes.
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => esc_html__('Small', 'xooapp'),
                    'shortName' => esc_html__('S', 'xooapp'),
                    'size'      => 14,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => esc_html__('Normal', 'xooapp'),
                    'shortName' => esc_html__('M', 'xooapp'),
                    'size'      => 22,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => esc_html__('Large', 'xooapp'),
                    'shortName' => esc_html__('L', 'xooapp'),
                    'size'      => 36,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => esc_html__('Huge', 'xooapp'),
                    'shortName' => esc_html__('XL', 'xooapp'),
                    'size'      => 50,
                    'slug'      => 'huge',
                ),
            )
        );

        // Add support for custom color scheme.
        add_theme_support('editor-color-palette', array(
            array(
                'name'  => esc_html__('White', 'xooapp'),
                'slug'  => 'white',
                'color' => '#FFF',
            ),
            array(
                'name'  => esc_html__('Strong Blue', 'xooapp'),
                'slug'  => 'strong-blue',
                'color' => '#0073aa',
            ),
            array(
                'name'  => esc_html__('Lighter Blue', 'xooapp'),
                'slug'  => 'lighter-blue',
                'color' => '#74b9ff',
            ),
            array(
                'name'  => esc_html__('Very Light Gray', 'xooapp'),
                'slug'  => 'very-light-gray',
                'color' => '#eee',
            ),
            array(
                'name'  => esc_html__('Very Dark Gray', 'xooapp'),
                'slug'  => 'very-dark-gray',
                'color' => '#444',
            ),


            array(
                'name'  => esc_html__('Carrot', 'xooapp'),
                'slug'  => 'carrot',
                'color' => '#e67e22',
            ),
            array(
                'name'  => esc_html__('Sun Flower', 'xooapp'),
                'slug'  => 'sun-flower',
                'color' => '#f1c40f',
            ),
            array(
                'name'  => esc_html__('Green Sea', 'xooapp'),
                'slug'  => 'green-sea',
                'color' => '#16a085',
            ),
            array(
                'name'  => esc_html__('Orange', 'xooapp'),
                'slug'  => 'orange',
                'color' => '#f39c12',
            ),
            array(
                'name'  => esc_html__('Wisteria', 'xooapp'),
                'slug'  => 'wisteria',
                'color' => '#8e44ad',
            ),

            array(
                'name'  => esc_html__('Pumpkin', 'xooapp'),
                'slug'  => 'pumpkin',
                'color' => '#d35400',
            ),
            
        ));

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');
    }
endif;
add_action('after_setup_theme', 'xooapp_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function xooapp_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('xooapp_content_width', 640);
}
add_action('after_setup_theme', 'xooapp_content_width', 0);
