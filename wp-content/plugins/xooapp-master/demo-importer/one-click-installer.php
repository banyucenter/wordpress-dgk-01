<?php

/**
 * one click demo
 */
class Xooapp_OneClickDemo 
{
	public $minimum_capability = 'manage_options';

    /**
     * load intially
     */
    public function __construct()
    {
    	add_action( 'admin_menu', array( $this, 'admin_menus' ) );

    	add_action( 'admin_enqueue_scripts', array( $this, 'xooapp_plugin_scripts') );

    	//ajax
    	add_action( 'wp_ajax_nopriv_xooapp_ajax_import_options',  array( $this, 'xooapp_ajax_import_options' ));
    	add_action('wp_ajax_xooapp_ajax_import_options',  array( $this, 'xooapp_ajax_import_options' ) );

    }

    
    /*
    * register style 
    */
    public function xooapp_plugin_scripts() {
    	wp_enqueue_style('importer-styles', XOOAPP_PLG_URL . '/demo-importer/engine/css/style.css', false, false, 'all');
    }

   /**
   * Register the Dashboard Pages which are later hidden but these pages
   * are used to render the Welcome and Credits pages.
   *
   * @access public
   * @since 1.4
   * @return void
   */
   public function admin_menus() {


   	add_menu_page(
   		'xooapp', 
   		'XooApp', 
   		'manage_options', 
   		'xooapp', 
   		array($this, 'xooapp'), 
   		'', 
   		'100'
   	);

   	add_submenu_page(
   		'xooapp',
   		__( 'Welcome', 'xooapp' ),
   		__( 'Welcome', 'xooapp' ),
   		$this->minimum_capability,
   		'xooapp',
   		''
   	);



    // Pro v Lite
   	add_submenu_page(
   		'xooapp',
   		__( 'Quick Install', 'xooapp' ),
   		__( 'Quick Install', 'xooapp' ),
   		$this->minimum_capability,
   		'demo-importer',
   		array( $this, '_load_demo_content_page' )
   	);

   }

   public function xooapp() {
   	echo '';
   }

   public function _load_demo_content_page() {
   	include_once(XOOAPP_PLG_DIR . '/demo-importer/engine/index.php');

   }


	// ajax import option
   public function xooapp_ajax_import_options() {
   	include_once(XOOAPP_PLG_DIR . '/demo-importer/engine/content_importer.php');
   	parse_str($_POST["options"], $options);
   	if (!empty($options['template'])) {
   		$content_importer = new ContentImporter($_POST["options"]);
   		$content_importer->import();
   		$options['template'] = '';
   	}
   }

}

new Xooapp_OneClickDemo();
