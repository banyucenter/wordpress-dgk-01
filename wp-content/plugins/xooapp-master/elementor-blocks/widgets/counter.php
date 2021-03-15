<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Xooapp_Counter extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'xooapp-counter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Counter', 'xooapp' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'counter', 'happy', 'follower', 'client' ];
	}

	/**
	 * Get widget cateogory.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories() {
		return [ 'xooapp-master-elements' ];    // category of the widget
	}

	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_counter',
			[
				'label' => __( 'Counter', 'xooapp' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'counter_name', [
				'label' => __( 'Title', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Name' , 'xooapp' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'counter_icon', [
				'label' => __( 'Icon', 'xooapp' ),
				'type' => Controls_Manager::ICON,
				'default' => __( 'Icon' , 'xooapp' ),
				'show_label' => false,
			]
		);

		
		$repeater->add_control(
			'counter_number', [
				'label' => __( 'Number', 'xooapp' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '1178',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'border_type', [
				'label' => __( 'Border', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'' => __( 'None', 'xooapp' ),
					'solid' => _x( 'Solid', 'Border Control', 'xooapp' ),
					'double' => _x( 'Double', 'Border Control', 'xooapp' ),
					'dotted' => _x( 'Dotted', 'Border Control', 'xooapp' ),
					'dashed' => _x( 'Dashed', 'Border Control', 'xooapp' ),
					'groove' => _x( 'Groove', 'Border Control', 'xooapp' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-style: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ '%', 'px' ],
				'condition' => [
					'border_type!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'border_color',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'border_type!' => '',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'counter_list',
			[
				'label' => __( 'Repeater List', 'xooapp' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'counter_name' => __( 'Happy Clients', 'xooapp' ),
						'counter_icon' => __( 'pe-7s-smile', 'xooapp' ),
						'counter_number' => '1154',
					],
					[
						'counter_name' => __( 'Tickets Closed', 'xooapp' ),
						'counter_icon' => __( 'pe-7s-help2', 'xooapp' ),
						'counter_number' => '409',
					],
					[
						'counter_name' => __( 'Followers', 'xooapp' ),
						'counter_icon' => __( 'pe-7s-users', 'xooapp' ),
						'counter_number' => '869',
					],
					[
						'counter_name' => __( 'Cups of Coffee', 'xooapp' ),
						'counter_icon' => __( 'pe-7s-coffee', 'xooapp' ),
						'counter_number' => '901',
					],
				],
				'title_field' => '{{{ counter_name }}}',
			]
		);


		$this->end_controls_section();

		

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Styling', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'column_no', [
				'label' => __( 'Column Number', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'col-sm-6' => __( 'Default', 'xooapp' ),
					'col-sm-6' => _x( '2 Column', 'xooapp' ),
					'col-md-4' => _x( '3 Column', 'xooapp' ),
					'col-md-3' => _x( '4 Column', 'xooapp' ),
					'col-md-2' => _x( '6 Column', 'xooapp' ),
				],
				'default' => 'col-sm-6',
			]
		);

		$this->add_control(
			'font_gradient_primary_color',
			[
				'label' => __( 'Gradient Primary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '#1d07f4',
				'selectors' => [
					'{{WRAPPER}} .blue-icon i' => 'background: -webkit-gradient(linear, left top, left bottom, from({{VALUE}}), to(#37a7fc)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;',
				],
			]
		);

		$this->add_control(
			'font_gradient_secondary_color',
			[
				'label' => __( 'Gradient Secondary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .blue-icon i' => 'background: -webkit-gradient(linear, left top, left bottom, from({{font_gradient_primary_color.VALUE}}), to({{VALUE}})); -webkit-background-clip: text; -webkit-text-fill-color: transparent;',
				],
				'of_type' => 'gradient',
			]
		);

		$this->add_responsive_control(
			'icon_font_size',
			[
				'label' => __( 'Font Size', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'xooapp' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .statistic-number' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);


		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'xooapp' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .statistic-block .p-md' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .statistic-block .p-md',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render team image with detail widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->add_inline_editing_attributes( 'team_name' );

		$this->add_render_attribute( 'counter_list', 'class', 'xooapp-counter' );

		$column_no = (isset($settings['column_no'])) ? $settings['column_no'] : 'col-sm-6';
		?>
		<div <?php echo $this->get_render_attribute_string( 'counter_list' ); ?>>
			<?php foreach ($settings['counter_list'] as $index => $item) { 

				$repeater_setting_key = $this->get_repeater_setting_key( 'counter_name', 'counter_list', $index );

				$this->add_render_attribute( $repeater_setting_key, 'class', [ 'p-md'] );

				$this->add_inline_editing_attributes( $repeater_setting_key );
				?>
				<!-- STATISTIC BLOCK #1 -->
				<div class="<?php echo esc_attr( $column_no ) ?> float-left counter-block-style elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">							
					<div class="statistic-block text-center box-icon blue-icon">	
						<i class="<?php echo esc_html($item['counter_icon']) ?>"></i>						
						<div class="statistic-number"><?php echo esc_html($item['counter_number']) ?></div>
						<p <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo esc_html($item['counter_name']) ?></p>
					</div>								
				</div>
			<?php } ?>
		</div>
		<?php
	}

	/**
	 * Render team_image box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'counter_list', 'class', 'xooapp-counter' );
		#>
		<# if ( settings.counter_list ) { #>
		<div {{{ view.getRenderAttributeString( 'counter_list' ) }}}>
			<# _.each( settings.counter_list, function( item, index ) { 
			var iconTextKey = view.getRepeaterSettingKey( 'counter_name', 'counter_list', index );
			view.addRenderAttribute( iconTextKey, 'class', [ 'p-md' ] );
			view.addInlineEditingAttributes( iconTextKey ); 

			#>	
			<div class="{{settings.column_no}} counter-block-style elementor-repeater-item-{{ item._id }}">							
				<div class="statistic-block text-center box-icon blue-icon">
					<i class="{{ item.counter_icon }}"></i>						
					<div class="statistic-number">{{ item.counter_number }}</div>
					<p {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{ item.counter_name }}</p>
				</div>								
			</div>
			<# }); #>
		</div>
		<#	} #>
		<?php
	}
}
