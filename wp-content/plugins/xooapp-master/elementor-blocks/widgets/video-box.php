<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Xooapp_Video_Box extends Widget_Base {

	public function get_name() {
		return 'xooapp_video_box';
	}

	public function get_title() {
		return 'Video Box'; // title to show on xooapp
	}

	public function get_icon() {
		return 'eicon-play';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
	}

	public function get_categories() {
		return [ 'xooapp-master-elements' ];    // category of the widget
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	// public function get_script_depends() {		//load the dependent scripts defined in the xooapp-elements.php
	// 	return [ 'section-header' ];
	// }

	protected function _register_controls() {
		
		//start of a control box
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Section Settings', 'xooapp' ),   //section name for controler view
			]
		);



		$this->add_responsive_control(
			'video_link',
			[
				'label' => __( 'Select Video OR Paste Youtube Link', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'xooapp' ) . ' (YouTube)',
				'default' => 'https://www.youtube.com/watch?v=kuceVNBTJio',
				'label_block' => true,
			]
		);

		$this->add_control(
			'video_style',
			[
				'label' => __( 'Video Style', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Select One', 'xooapp' ),
					'thumb' => __( 'Thumbnail', 'xooapp' ),
					'text' => __( 'Text', 'xooapp' ),
				],
				'default' => 'thumb',
			]
		);

		$this->add_control(
			'video_text',
			[
				'label' => esc_html__( 'Text', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'default' => ' Watch the Overview',
				'label_block' => true,
				'condition' => [
					'video_style' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .modal-video .video-popup, {{WRAPPER}} a.video-popup span i' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'xooapp' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'xooapp' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'xooapp' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'xooapp' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'xooapp' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'video_icon',
			[
				'label' => esc_html__( 'Icon', 'xooapp' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-play-circle',
				'label_block' => true,
				'condition' => [
					'video_style' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'banner_bg_img',
			[
				'label' => __( 'Select Thumbnail', 'xooapp' ),
				'type' => Controls_Manager::MEDIA,
				'description' => 'Select Image',
				'condition' => [
					'video_style' => 'thumb',
				],
				'default' => [
					'url' => get_template_directory_uri(). '/assets/images/video-2-img.png',
				],
			]
		);

		$this->end_controls_section();
		//End  of a control box

	}

	protected function render() {				//to show on the fontend 
		$settings = $this->get_settings_for_display();
		$banner_bg_img = $settings['banner_bg_img']['url'];
		$video_link = $settings['video_link'];
		$video_text = $settings['video_text'];
		?>
		<?php if( $settings['video_style'] == 'text' ) { ?>
			<div class="modal-video grey-color">
				<a class="video-popup" href="<?php echo esc_url($video_link) ?>"> <!-- Change the video link HERE!!! --> 
					<span><i class="<?php echo esc_attr( $settings['video_icon'] ); ?>"></i></span>
					<?php echo esc_html($video_text); ?>
				</a>
			</div>
		<?php } else { ?>
			<div class="video-preview m-bottom-40">
				<!-- Change the link HERE!!! -->
				<a class="video-popup" href="<?php echo esc_url($video_link) ?>">
					<!-- Play Icon -->
					<div class="video-block-wrapper"><div class="play-icon-green"></div></div>
					<!-- Preview Image -->
					<img class="img-fluid" src="<?php echo esc_url( $banner_bg_img ) ?>" alt="video-preview">
				</a>
			</div>
		<?php } ?>
		<?php 
	}




}

