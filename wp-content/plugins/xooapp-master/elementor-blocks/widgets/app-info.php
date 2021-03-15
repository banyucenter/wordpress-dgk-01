<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Xooapp_App_Info extends Widget_Base {

	public function get_name() {
		return 'xooapp_app_info';
	}

	public function get_title() {
		return 'Xooapp App Info'; // title to show on xooapp
	}

	public function get_icon() {
		return 'fa fa-android';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
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


		$this->add_control(
			'app_image_one',
			[
				'label' => esc_html__( 'App Image Upload', 'xooapp' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'app_one_link',
			[
				'label' => esc_html__( 'Link One', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		


		$this->add_control(
			'app_image_two',
			[
				'label' => esc_html__( 'App Image Upload', 'xooapp' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'app_two_link',
			[
				'label' => esc_html__( 'Link One', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		

		$this->add_responsive_control(
			'section_padding',
			[
				'label' => __( 'Section Padding', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.store' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'section_margin',
			[
				'label' => __( 'Section Margin', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.store' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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



		$this->end_controls_section();
		//End  of a control box

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$app_image_one = $settings['app_image_one']['url'];
		$app_image_two = $settings['app_image_two']['url'];
		$app_one_link = $settings['app_one_link'];
		$app_two_link = $settings['app_two_link'];
		$this->add_inline_editing_attributes( 'app_one_link' );
		$this->add_inline_editing_attributes( 'app_two_link' );
		?>

		<div class="stores-badge">

			<?php if( !empty($app_image_one) ) { ?>
				<a href="<?php echo esc_url( $app_one_link ) ?>" class="store store-button1">
					<img class="appstore-white" src="<?php echo esc_url( $app_image_one ) ?>" width="155" height="50" alt="<?php echo esc_attr_e( 'appstore-logo', 'xooapp' ) ?>">
				</a>
			<?php } ?>

			<?php if( !empty($app_image_two) ) { ?>

				<a href="<?php echo esc_url( $app_two_link ) ?>" class="store store-button2">
					<img class="googleplay-white" src="<?php echo esc_url( $app_image_two ) ?>" width="164" height="50" alt="<?php echo esc_attr_e( 'googleplay-logo', 'xooapp' ) ?>">
				</a>
			<?php } ?>

		</div>
		<?php 
	}


}

