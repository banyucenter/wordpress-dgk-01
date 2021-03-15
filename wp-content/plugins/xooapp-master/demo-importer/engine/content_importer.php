<?php


/*-----------------------------------------------------------
    define.
    -----------------------------------------------------------*/
    if (!defined('WP_LOAD_IMPORTERS'))
        define('WP_LOAD_IMPORTERS', true);
    define('BASE_PATH', XOOAPP_PLG_DIR . "/demo-importer/data/");
    define('BASE_URL', XOOAPP_PLG_URL. "demo-importer/data/");
    define('DUMY_CONTENT', 'theme_content.xml');
    define('WIDGETS_FILE', 'widget_data.wie');
    define('OPTIONS_FILE_NAME', 'options.txt');


    /** WordPress Import Administration API */
    require_once ABSPATH . 'wp-admin/includes/import.php';

    if ( ! class_exists( 'WP_Importer' ) ) {
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if ( file_exists( $class_wp_importer ) )
            require $class_wp_importer;
    }

/*-----------------------------------------------------------
    make a class .
    -----------------------------------------------------------*/

    if(!class_exists('ContentImporter')) {

        class ContentImporter {

            private $template = null;
            private $theme_content_path = "";
            private $widget_content_path = "";

            function __construct($atts) {

                parse_str($atts, $options);
                $this->jim_include_appropriate_importer();
                $this->template                  = $options['template'];
                $this->is_options                = $options['options'];
                $this->is_widgets                = $options['widgets'];
                $this->is_content                = $options['contents'];
                $this->theme_content_path        = BASE_PATH . $options['template'] . '/' . DUMY_CONTENT;
                $this->theme_options_path        = BASE_PATH . $options['template'] . '/' . OPTIONS_FILE_NAME;
                $this->widget_content_path       = BASE_PATH . $options['template'] . '/' . WIDGETS_FILE;
            }

            private function jim_import_menus_locations()  {



                if ($this->is_content == 'true') {
                    $locations = get_theme_mod('nav_menu_locations');
                    $menus     = wp_get_nav_menus();
                    if(!empty($menus)){
                        foreach($menus as $menu) {
                            if(is_object($menu) && $menu->slug == 'main-menu')  {
                                $locations['menu-1'] = $menu->term_id;
                                echo '<li>Main Navigation default location is configured.</li>';
                            }
                        }
                    }
                    set_theme_mod('nav_menu_locations', $locations);

                }
            }


            private function set_up_pages()   {

                if ($this->is_content == 'true') {
                    $homepage = get_page_by_title('Home');
                    if (empty($homepage->ID)) {
                        $homepage = get_page_by_title('Home');
                        if (empty($homepage->ID)) {
                            $homepage = get_page_by_title('Home');
                        }
                    }

                    if (!empty($homepage->ID)) {
                        update_option('page_on_front', $homepage->ID);
                        update_option('show_on_front', 'page');
                        echo '<li>Default homepage configured.</li>';
                    }

                    $blog_page = get_page_by_title('Blog');
                    if(!empty($blog_page->ID)) {
                     update_option('page_for_posts', $blog_page->ID);
                     echo '<li>Blog Page configured.</li>';
                 }

             }

         }

    // include importer
         private function jim_include_appropriate_importer()  {

            global $wpdb;

            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);


            if (!class_exists('WP_Importer')) {
                $wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                include $wp_importer;
            }
            if (!class_exists('WP_Import')) {
                $wp_import = XOOAPP_PLG_DIR . '/demo-importer/engine/wordpress-importer.php';
                include $wp_import;
            }
        }

        // import theme content
        private function jim_import_theme_content()    {

            if ($this->is_content == 'true') {
                $menus     = wp_get_nav_menus();
                if(!empty($menus)){
                    foreach($menus as $menu) {
                        wp_delete_nav_menu($menu);
                    }
                }
                set_time_limit(3000);
                $importer = new WP_Import();
                $importer->fetch_attachments = true;
                wp_defer_term_counting( true );
                ob_start();
                    $importer->import($this->theme_content_path);
                ob_end_clean();
                wp_defer_term_counting( false );
                echo '<h2>Congratulation. Demo import complete successfully</h2>';
                echo '<h3>Now you can edit and change Images & content.</h3>';
                echo '<li>Contents imported.</li>';
                return true;
            }

        }


        private function jim_theme_data_import()  {

            if ($this->is_options == 'true') {
                $import_data             = file_get_contents($this->theme_options_path);
                //$import_data_unserilized = base64_decode($import_data);
                // codestare framework
                $import_data_unserilized = unserialize( gzuncompress( stripslashes( call_user_func( 'base64_decode', rtrim( strtr( $import_data, '-_', '+/' ), '=' ) ) ) ) );
                // print_r($import_data_unserilized);
                // if (!empty($import_data_unserilized)) {
                update_option('_vidco_options', $import_data_unserilized);

                echo '<li>Theme options imported.</li>';
                return true;
                // }
            }

        }

        private function jim_process_widget_import() {
            if ($this->is_widgets == 'true') {
                global $data_import_result;
                $widgets_json      = $this->widget_content_path;
                $data              = file_get_contents($widgets_json);
                $data              = json_decode($data);
                $data_import_result = $this-> focuz_import_data($data);
            }
        }


        function import_focuz_widget_data()   {

            global $wp_registered_widget_controls;
            $widget_controls   = $wp_registered_widget_controls;
            $available_widgets = array();
            foreach ($widget_controls as $widget) {
                if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) {
                    $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                    $available_widgets[$widget['id_base']]['name']    = $widget['name'];
                }
            }
            return apply_filters('import_focuz_widget_data', $available_widgets);
        }


        private function focuz_import_data($data)  {

            global $wp_registered_sidebars;
            $available_widgets = $this->import_focuz_widget_data();
            $widget_instances  = array();
            foreach ($available_widgets as $widget_data) {
                $widget_instances[$widget_data['id_base']] = get_option('widget_' . $widget_data['id_base']);
            }

            if (empty($data) || !is_object($data)) {
                wp_die(__('Import data could not be read. Please try a different file.', 'xooapp'), '', array(
                    'back_link' => true
                ));
            }

            $results = array();
            foreach ($data as $sidebar_id => $widgets) {
                if ('wp_inactive_widgets' == $sidebar_id) {
                    continue;
                }

                if (isset($wp_registered_sidebars[$sidebar_id])) {
                    $sidebar_available    = true;
                    $use_sidebar_id       = $sidebar_id;
                    $sidebar_message_type = 'success';
                    $sidebar_message      = '';
                } else {
                    $sidebar_available    = false;
                    $use_sidebar_id       = 'wp_inactive_widgets';
                    $sidebar_message_type = 'error';
                    $sidebar_message      = __('Sidebar does not exist in theme (using Inactive)', 'xooapp');
                }

                $results[$sidebar_id]['name']         = !empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id;
                $results[$sidebar_id]['message_type'] = $sidebar_message_type;
                $results[$sidebar_id]['message']      = $sidebar_message;
                $results[$sidebar_id]['widgets']      = array();

                foreach ($widgets as $widget_instance_id => $widget) {
                    $fail               = false;
                    $id_base            = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
                    $instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);
                    if (!$fail && !isset($available_widgets[$id_base])) {
                        $fail                = true;
                        $widget_msg_type = 'error';
                        $widget_msg      = __('Site does not support widget', 'xooapp');
                    }

                    $widget = apply_filters('widget_focuz_settings', $widget);
                    if (!$fail && isset($widget_instances[$id_base])) {
                        $sidebars_widgets        = get_option('sidebars_widgets');
                        $sidebar_widgets         = isset($sidebars_widgets[$use_sidebar_id]) ? $sidebars_widgets[$use_sidebar_id] : array();
                        $single_widget_instances = !empty($widget_instances[$id_base]) ? $widget_instances[$id_base] : array();
                        foreach ($single_widget_instances as $check_id => $check_widget) {
                            if (in_array("$id_base-$check_id", $sidebar_widgets) && (array) $widget == $check_widget) {
                                $fail                = true;
                                $widget_msg_type = 'warning';
                                $widget_msg      = __('Widget already exists', 'xooapp');
                                break;
                            }
                        }
                    }

                    if (!$fail) {
                        $single_widget_instances   = get_option('widget_' . $id_base);
                        $single_widget_instances   = !empty($single_widget_instances) ? $single_widget_instances : array(
                            '_multiwidget' => 1
                        );

                        $single_widget_instances[] = (array) $widget;
                        end($single_widget_instances);
                        $new_instance_id_number = key($single_widget_instances);
                        if ('0' === strval($new_instance_id_number)) {
                            $new_instance_id_number                           = 1;
                            $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                            unset($single_widget_instances[0]);
                        }

                        if (isset($single_widget_instances['_multiwidget'])) {
                            $multiwidget = $single_widget_instances['_multiwidget'];
                            unset($single_widget_instances['_multiwidget']);
                            $single_widget_instances['_multiwidget'] = $multiwidget;
                        }

                        update_option('widget_' . $id_base, $single_widget_instances);
                        $sidebars_widgets                    = get_option('sidebars_widgets');
                        $new_instance_id                     = $id_base . '-' . $new_instance_id_number;
                        $sidebars_widgets[$use_sidebar_id][] = $new_instance_id;
                        update_option('sidebars_widgets', $sidebars_widgets);
                        if ($sidebar_available) {
                            $widget_msg_type = 'success';
                            $widget_msg      = __('Imported', 'xooapp');
                        } else {
                            $widget_msg_type = 'warning';
                            $widget_msg      = __('Imported to Inactive', 'xooapp');
                        }
                    }

                    $results[$sidebar_id]['widgets'][$widget_instance_id]['name']         = isset($available_widgets[$id_base]['name']) ? $available_widgets[$id_base]['name'] : $id_base;
                    $results[$sidebar_id]['widgets'][$widget_instance_id]['title']        = $widget->title ? $widget->title : __('No Title', 'xooapp');
                    $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_msg_type;
                    $results[$sidebar_id]['widgets'][$widget_instance_id]['message']      = $widget_msg;

                }

            }
            echo '<li>Widgets are imported.</li>';
        }

        public function import() {
            if (class_exists('WP_Importer') && class_exists('WP_Import')) {
                $imported_message = '<ul>';


                if ($this->jim_import_theme_content()) {
                    $this->jim_import_menus_locations();
                    $this->set_up_pages();
                }
                $this->jim_process_widget_import();
                $this->jim_theme_data_import();
                $imported_message .= '</ul>';
                echo $imported_message;
                //update site ur
                // echo home_url('/' );
                // echo site_url();

                update_option( 'siteurl', site_url() );
                update_option( 'home', site_url() );


                die();
            }
        }
    }

}
