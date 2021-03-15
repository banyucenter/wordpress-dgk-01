<?php
namespace Xooapp;  //main namespace

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $void_widgets;
$void_widgets= array_map('basename', glob(dirname( __FILE__ ) . '/widgets/*.php'));



/* - Path define same as class name of the widget
====================================================================================================*/
use Xooapp\Widgets\Xooapp_Header;
use Xooapp\Widgets\Xooapp_Logo;
use Xooapp\Widgets\Xooapp_Nav_Menu;
use Xooapp\Widgets\Hero_One;
use Xooapp\Widgets\Feature_Box;
use Xooapp\Widgets\Xooapp_Heading;
use Xooapp\Widgets\Xooapp_Section_Heading;
use Xooapp\Widgets\App_slider;
use Xooapp\Widgets\Team;
use Xooapp\Widgets\Xooapp_Counter;
use Xooapp\Widgets\Xooapp_Video_Content;
use Xooapp\Widgets\Xooapp_Video_Box;
use Xooapp\Widgets\Xooapp_Testimonials;
use Xooapp\Widgets\Xooapp_Blog;
use Xooapp\Widgets\Xooapp_App_Info;
use Xooapp\Widgets\Xooapp_Pricing_Table;
use Xooapp\Widgets\Xooapp_Social_List;
use Xooapp\Widgets\Xooapp_Button_List;
use Xooapp\Widgets\Xooapp_Tabs;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Base_Control;
use Elementor\Base_Data_Control;
use Elementor\Utils;


/* - End Of path define same as class name of the widget
====================================================================================================*/

function xooapp_insert_elementor($atts){

	$post_id = $atts['id'];
	$response = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
	return $response;
}
add_shortcode('XOOAPP_ELEMENTOR','\Xooapp\xooapp_insert_elementor');


function print_ae_data($sections){
	foreach ( $sections as $section_data ) {
		$section = new Element_Section( $section_data );

		$section->print_element();
	}
}
/**
 *  Enable the use of shortcodes in text widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );


// Add a custom category for panel widgets
add_action( 'elementor/init', function() {
	\Elementor\Plugin::$instance->elements_manager->add_category( 
   	'xooapp-master-elements',                 // the name of the category
   	[
   		'title' => __( 'Xooapp', 'xooapp' ),
   		'icon' => 'fa fa-header', //default icon
   	],
   	5 // position
   );
} );




add_action( 'elementor/element/before_section_start', function( $element, $section_id, $args ) {
	/** @var \Elementor\Element_Base $element */
	if ( 'section' === $element->get_name() && 'section_background' === $section_id ) {

		$element->start_controls_section(
			'custom_section',
			[
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => __( 'Extra Option Background', 'xooapp' ),
			]
		);

		$element->add_responsive_control(
			'xooapp_responsive_background',
			[
				'label' => _x( 'Image', 'Background Control', 'xooapp' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'title' => _x( 'Background Image', 'Background Control', 'xooapp' ),
				'selectors' => [
					'{{WRAPPER}}' => 'background-image: url("{{URL}}");',
				],
				
			]
		);

		$element->add_responsive_control(
			'responsive_background_control',
			[
				'label' => __( 'Background Position', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => _x( 'Default', 'Background Control', 'xooapp' ),
					'top left' => _x( 'Top Left', 'Background Control', 'xooapp' ),
					'top center' => _x( 'Top Center', 'Background Control', 'xooapp' ),
					'top right' => _x( 'Top Right', 'Background Control', 'xooapp' ),
					'center left' => _x( 'Center Left', 'Background Control', 'xooapp' ),
					'center center' => _x( 'Center Center', 'Background Control', 'xooapp' ),
					'center right' => _x( 'Center Right', 'Background Control', 'xooapp' ),
					'bottom left' => _x( 'Bottom Left', 'Background Control', 'xooapp' ),
					'bottom center' => _x( 'Bottom Center', 'Background Control', 'xooapp' ),
					'bottom right' => _x( 'Bottom Right', 'Background Control', 'xooapp' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'background-position: {{VALUE}};',
				],

			]
		);

		$element->add_responsive_control(
			'responsive_background_size',
			[
				'label' => __( 'Background Size', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => _x( 'Default', 'Background Control', 'xooapp' ),
					'auto' => _x( 'Auto', 'Background Control', 'xooapp' ),
					'cover' => _x( 'Cover', 'Background Control', 'xooapp' ),
					'contain' => _x( 'Contain', 'Background Control', 'xooapp' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'background-size: {{VALUE}};',
				],

			]
		);

		$element->add_responsive_control(
			'xooapp_responsive_background_color',
			[
				'label' => _x( 'Color', 'Background Control', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'title' => _x( 'Background Color', 'Background Control', 'xooapp' ),
				'selectors' => [
					'{{WRAPPER}}' => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$element->add_responsive_control(
			'xooapp_hide_mobile',
			[
				'label' => __( 'Background Image Hide On Device', 'xooapp' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'prefix_class' => 'elementor-',
				'selectors' => [
					'{{WRAPPER}}.elementor-hidden-phone' => 'background-image: none;',
				],
				'label_on' => __( 'Hide', 'xooapp' ),
				'label_off' => __( 'Show', 'xooapp' ),
				'return_value' => 'hidden-phone',
			]
		);

		$element->add_responsive_control(
			'overlay_postion',
			[
				'label' => __( 'Overlay Image Position', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'#page {{WRAPPER}} .elementor-background-overlay' => 'background-position: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);
		$element->add_responsive_control(
			'overlay_postion_left',
			[
				'label' => __( 'Overlay Image Position', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-background-overlay' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		

		$element->add_responsive_control(
			'overlay_image_width',
			[
				'label' => __( 'Overlay Image Width', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'size_units' => [ '%', 'px'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$element->add_responsive_control(
			'xooapp_overlay_hide_mobile',
			[
				'label' => __( 'Overlay Hide On Device', 'xooapp' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'overlay-yes',
				// 'prefix_class' => 'elementor-',
				'selectors' => [
					'{{WRAPPER}} .elementor-background-overlay' => 'background-image: none;',
				],
				'label_on' => __( 'Hide', 'xooapp' ),
				'label_off' => __( 'Show', 'xooapp' ),
				'return_value' => 'overlay-no',
			]
		);
		

		$element->end_controls_section();
	}
}, 10, 3 );

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Xooapp_Elementor {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'xooapp_enqueue_custom_admin_style'], 999 );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'xooapp_enqueue_custom_admin_style'] );


		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'custom_icon_include'], 10, 1 );

	}


	public function xooapp_enqueue_custom_admin_style() {
		wp_enqueue_style( 'xooapp_custom_style', plugins_url( '/css/admin-style.min.css', __FILE__ ), false, '1.0.0' );

	}


	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		global $void_widgets;              //include the widgets here
		//require __DIR__ . '/helper/helper.php';
		foreach($void_widgets as $key => $value){
			require __DIR__ . '/widgets/'.$value;
		}
	}


	/* - Register all elements widget
	====================================================================================================*/

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {    
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Header() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Nav_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Hero_One() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Feature_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Section_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new App_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Team() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Video_Content() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Video_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Blog() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_App_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Pricing_Table() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Social_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Button_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Xooapp_Tabs() );

	}

	/**
	 * Xooapp custom icon
	 *
	 * @since 1.0.0 
	 * @access public
	 */
	public function custom_icon_include( $controls_registry ) {
		// Get existing icons
		$icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
		// Append new icons
		$new_icons = array_merge(
			array(
				'pe-7s-album' => 'pe-7s-album',
				'pe-7s-arc' => 'pe-7s-arc',
				'pe-7s-back-2' => 'pe-7s-back-2',
				'pe-7s-bandaid' => 'pe-7s-bandaid',
				'pe-7s-car' => 'pe-7s-car',
				'pe-7s-diamond' => 'pe-7s-diamond',
				'pe-7s-door-lock' => 'pe-7s-door-lock',
				'pe-7s-eyedropper' => 'pe-7s-eyedropper',
				'pe-7s-female' => 'pe-7s-female',
				'pe-7s-gym' => 'pe-7s-gym',
				'pe-7s-hammer' => 'pe-7s-hammer',
				'pe-7s-headphones' => 'pe-7s-headphones',
				'pe-7s-helm' => 'pe-7s-helm',
				'pe-7s-hourglass' => 'pe-7s-hourglass',
				'pe-7s-leaf' => 'pe-7s-leaf',
				'pe-7s-magic-wand' => 'pe-7s-magic-wand',
				'pe-7s-male' => 'pe-7s-male',
				'pe-7s-map-2' => 'pe-7s-map-2',
				'pe-7s-next-2' => 'pe-7s-next-2',
				'pe-7s-paint-bucket' => 'pe-7s-paint-bucket',
				'pe-7s-pendrive' => 'pe-7s-pendrive',
				'pe-7s-photo' => 'pe-7s-photo',
				'pe-7s-piggy' => 'pe-7s-piggy',
				'pe-7s-plugin' => 'pe-7s-plugin',
				'pe-7s-refresh-2' => 'pe-7s-refresh-2',
				'pe-7s-rocket' => 'pe-7s-rocket',
				'pe-7s-settings' => 'pe-7s-settings',
				'pe-7s-shield' => 'pe-7s-shield',
				'pe-7s-smile' => 'pe-7s-smile',
				'pe-7s-usb' => 'pe-7s-usb',
				'pe-7s-vector' => 'pe-7s-vector',
				'pe-7s-wine' => 'pe-7s-wine',
				'pe-7s-cloud-upload' => 'pe-7s-cloud-upload',
				'pe-7s-cash' => 'pe-7s-cash',
				'pe-7s-close' => 'pe-7s-close',
				'pe-7s-bluetooth' => 'pe-7s-bluetooth',
				'pe-7s-cloud-download' => 'pe-7s-cloud-download',
				'pe-7s-way' => 'pe-7s-way',
				'pe-7s-close-circle' => 'pe-7s-close-circle',
				'pe-7s-id' => 'pe-7s-id',
				'pe-7s-angle-up' => 'pe-7s-angle-up',
				'pe-7s-wristwatch' => 'pe-7s-wristwatch',
				'pe-7s-angle-up-circle' => 'pe-7s-angle-up-circle',
				'pe-7s-world' => 'pe-7s-world',
				'pe-7s-angle-right' => 'pe-7s-angle-right',
				'pe-7s-volume' => 'pe-7s-volume',
				'pe-7s-angle-right-circle' => 'pe-7s-angle-right-circle',
				'pe-7s-users' => 'pe-7s-users',
				'pe-7s-angle-left' => 'pe-7s-angle-left',
				'pe-7s-user-female' => 'pe-7s-user-female',
				'pe-7s-angle-left-circle' => 'pe-7s-angle-left-circle',
				'pe-7s-up-arrow' => 'pe-7s-up-arrow',
				'pe-7s-angle-down' => 'pe-7s-angle-down',
				'pe-7s-switch' => 'pe-7s-switch',
				'pe-7s-angle-down-circle' => 'pe-7s-angle-down-circle',
				'pe-7s-scissors' => 'pe-7s-scissors',
				'pe-7s-wallet' => 'pe-7s-wallet',
				'pe-7s-safe' => 'pe-7s-safe',
				'pe-7s-volume2' => 'pe-7s-volume2',
				'pe-7s-volume1' => 'pe-7s-volume1',
				'pe-7s-voicemail' => 'pe-7s-voicemail',
				'pe-7s-video' => 'pe-7s-video',
				'pe-7s-user' => 'pe-7s-user',
				'pe-7s-upload' => 'pe-7s-upload',
				'pe-7s-unlock' => 'pe-7s-unlock',
				'pe-7s-umbrella' => 'pe-7s-umbrella',
				'pe-7s-trash' => 'pe-7s-trash',
				'pe-7s-tools' => 'pe-7s-tools',
				'pe-7s-timer' => 'pe-7s-timer',
				'pe-7s-ticket' => 'pe-7s-ticket',
				'pe-7s-target' => 'pe-7s-target',
				'pe-7s-sun' => 'pe-7s-sun',
				'pe-7s-study' => 'pe-7s-study',
				'pe-7s-stopwatch' => 'pe-7s-stopwatch',
				'pe-7s-star' => 'pe-7s-star',
				'pe-7s-speaker' => 'pe-7s-speaker',
				'pe-7s-signal' => 'pe-7s-signal',
				'pe-7s-shuffle' => 'pe-7s-shuffle',
				'pe-7s-shopbag' => 'pe-7s-shopbag',
				'pe-7s-share' => 'pe-7s-share',
				'pe-7s-server' => 'pe-7s-server',
				'pe-7s-search' => 'pe-7s-search',
				'pe-7s-film' => 'pe-7s-film',
				'pe-7s-science' => 'pe-7s-science',
				'pe-7s-disk' => 'pe-7s-disk',
				'pe-7s-ribbon' => 'pe-7s-ribbon',
				'pe-7s-repeat' => 'pe-7s-repeat',
				'pe-7s-refresh' => 'pe-7s-refresh',
				'pe-7s-add-user' => 'pe-7s-add-user',
				'pe-7s-refresh-cloud' => 'pe-7s-refresh-cloud',
				'pe-7s-paperclip' => 'pe-7s-paperclip',
				'pe-7s-radio' => 'pe-7s-radio',
				'pe-7s-note2' => 'pe-7s-note2',
				'pe-7s-print' => 'pe-7s-print',
				'pe-7s-network' => 'pe-7s-network',
				'pe-7s-prev' => 'pe-7s-prev',
				'pe-7s-mute' => 'pe-7s-mute',
				'pe-7s-power' => 'pe-7s-power',
				'pe-7s-medal' => 'pe-7s-medal',
				'pe-7s-portfolio' => 'pe-7s-portfolio',
				'pe-7s-like2' => 'pe-7s-like2',
				'pe-7s-plus' => 'pe-7s-plus',
				'pe-7s-left-arrow' => 'pe-7s-left-arrow',
				'pe-7s-play' => 'pe-7s-play',
				'pe-7s-key' => 'pe-7s-key',
				'pe-7s-plane' => 'pe-7s-plane',
				'pe-7s-joy' => 'pe-7s-joy',
				'pe-7s-photo-gallery' => 'pe-7s-photo-gallery',
				'pe-7s-pin' => 'pe-7s-pin',
				'pe-7s-phone' => 'pe-7s-phone',
				'pe-7s-plug' => 'pe-7s-plug',
				'pe-7s-pen' => 'pe-7s-pen',
				'pe-7s-right-arrow' => 'pe-7s-right-arrow',
				'pe-7s-paper-plane' => 'pe-7s-paper-plane',
				'pe-7s-delete-user' => 'pe-7s-delete-user',
				'pe-7s-paint' => 'pe-7s-paint',
				'pe-7s-bottom-arrow' => 'pe-7s-bottom-arrow',
				'pe-7s-notebook' => 'pe-7s-notebook',
				'pe-7s-note' => 'pe-7s-note',
				'pe-7s-next' => 'pe-7s-next',
				'pe-7s-news-paper' => 'pe-7s-news-paper',
				'pe-7s-musiclist' => 'pe-7s-musiclist',
				'pe-7s-music' => 'pe-7s-music',
				'pe-7s-mouse' => 'pe-7s-mouse',
				'pe-7s-more' => 'pe-7s-more',
				'pe-7s-moon' => 'pe-7s-moon',
				'pe-7s-monitor' => 'pe-7s-monitor',
				'pe-7s-micro' => 'pe-7s-micro',
				'pe-7s-menu' => 'pe-7s-menu',
				'pe-7s-map' => 'pe-7s-map',
				'pe-7s-map-marker' => 'pe-7s-map-marker',
				'pe-7s-mail' => 'pe-7s-mail',
				'pe-7s-mail-open' => 'pe-7s-mail-open',
				'pe-7s-mail-open-file' => 'pe-7s-mail-open-file',
				'pe-7s-magnet' => 'pe-7s-magnet',
				'pe-7s-loop' => 'pe-7s-loop',
				'pe-7s-look' => 'pe-7s-look',
				'pe-7s-lock' => 'pe-7s-lock',
				'pe-7s-lintern' => 'pe-7s-lintern',
				'pe-7s-link' => 'pe-7s-link',
				'pe-7s-like' => 'pe-7s-like',
				'pe-7s-light' => 'pe-7s-light',
				'pe-7s-less' => 'pe-7s-less',
				'pe-7s-keypad' => 'pe-7s-keypad',
				'pe-7s-junk' => 'pe-7s-junk',
				'pe-7s-info' => 'pe-7s-info',
				'pe-7s-home' => 'pe-7s-home',
				'pe-7s-help2' => 'pe-7s-help2',
				'pe-7s-help1' => 'pe-7s-help1',
				'pe-7s-graph3' => 'pe-7s-graph3',
				'pe-7s-graph2' => 'pe-7s-graph2',
				'pe-7s-graph1' => 'pe-7s-graph1',
				'pe-7s-graph' => 'pe-7s-graph',
				'pe-7s-global' => 'pe-7s-global',
				'pe-7s-gleam' => 'pe-7s-gleam',
				'pe-7s-glasses' => 'pe-7s-glasses',
				'pe-7s-gift' => 'pe-7s-gift',
				'pe-7s-folder' => 'pe-7s-folder',
				'pe-7s-flag' => 'pe-7s-flag',
				'pe-7s-filter' => 'pe-7s-filter',
				'pe-7s-file' => 'pe-7s-file',
				'pe-7s-expand1' => 'pe-7s-expand1',
				'pe-7s-exapnd2' => 'pe-7s-exapnd2',
				'pe-7s-edit' => 'pe-7s-edit',
				'pe-7s-drop' => 'pe-7s-drop',
				'pe-7s-drawer' => 'pe-7s-drawer',
				'pe-7s-download' => 'pe-7s-download',
				'pe-7s-display2' => 'pe-7s-display2',
				'pe-7s-display1' => 'pe-7s-display1',
				'pe-7s-diskette' => 'pe-7s-diskette',
				'pe-7s-date' => 'pe-7s-date',
				'pe-7s-cup' => 'pe-7s-cup',
				'pe-7s-culture' => 'pe-7s-culture',
				'pe-7s-crop' => 'pe-7s-crop',
				'pe-7s-credit' => 'pe-7s-credit',
				'pe-7s-copy-file' => 'pe-7s-copy-file',
				'pe-7s-config' => 'pe-7s-config',
				'pe-7s-compass' => 'pe-7s-compass',
				'pe-7s-comment' => 'pe-7s-comment',
				'pe-7s-coffee' => 'pe-7s-coffee',
				'pe-7s-cloud' => 'pe-7s-cloud',
				'pe-7s-clock' => 'pe-7s-clock',
				'pe-7s-check' => 'pe-7s-check',
				'pe-7s-chat' => 'pe-7s-chat',
				'pe-7s-cart' => 'pe-7s-cart',
				'pe-7s-camera' => 'pe-7s-camera',
				'pe-7s-call' => 'pe-7s-call',
				'pe-7s-calculator' => 'pe-7s-calculator',
				'pe-7s-browser' => 'pe-7s-browser',
				'pe-7s-box2' => 'pe-7s-box2',
				'pe-7s-box1' => 'pe-7s-box1',
				'pe-7s-bookmarks' => 'pe-7s-bookmarks',
				'pe-7s-bicycle' => 'pe-7s-bicycle',
				'pe-7s-bell' => 'pe-7s-bell',
				'pe-7s-battery' => 'pe-7s-battery',
				'pe-7s-ball' => 'pe-7s-ball',
				'pe-7s-back' => 'pe-7s-back',
				'pe-7s-attention' => 'pe-7s-attention',
				'pe-7s-anchor' => 'pe-7s-anchor',
				'pe-7s-albums' => 'pe-7s-albums',
				'pe-7s-alarm' => 'pe-7s-alarm',
				'pe-7s-airplay' => 'pe-7s-airplay',
			),
$icons
);
		// Then we set a new list of icons as the options of the icon control
$controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
}
}

new Xooapp_Elementor();