<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Xooapp_Button_List extends Widget_Base {


	/**
	 * Get widget name.
	 *
	 * Retrieve button list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'xooapp_button_list';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Button List'; // title to show on xooapp
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
	}

	/**
	 * Get widget category.
	 *
	 * Retrieve social list category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget category.
	 */
	public function get_categories() {
		return [ 'xooapp-master-elements' ];    // category of the widget
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
		return [ 'button', 'icon', 'social', 'button list' ];
	}

	/**
	 * Register button list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_social_icon',
			[
				'label' => __( 'Button Icons', 'xooapp' ),
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'Layout', 'xooapp' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'traditional',
				'options' => [
					'traditional' => [
						'title' => __( 'Default', 'xooapp' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => __( 'Inline', 'xooapp' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template',
				'classes' => 'elementor-control-start-end',
				'label_block' => false,
				'style_transfer' => true,
			]
		);

		$repeater = new Repeater();
		$repeater->start_controls_tabs( 'button_repeater' );

		$repeater->start_controls_tab(
			'button_general',
			[
				'label' => __( 'General', 'uael' ),
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default'	=> 'Read More'
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'xooapp' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'is_external' => 'true',
				],
				'placeholder' => __( 'https://your-link.com', 'xooapp' ),
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'button_design',
			[
				'label' => __( 'Design', 'uael' ),
			]
		);

		$repeater->add_control(
			'show_icon',
			[
				'label' => __( 'Show Icon', 'xooapp' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'No',
				'label_block' => false,
			]
		);


		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Name With Icon', 'xooapp' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default'	=> '',
				'condition' => [
					'show_icon' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'icon_align',
			[
				'label' => __( 'Icon Position', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'xooapp' ),
					'right' => __( 'After', 'xooapp' ),
				],
				'condition' => [
					'show_icon' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list .xooapp-align-icon-right' => 'float: right;',
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list .xooapp-align-icon-left' => 'float: left;',
				],
			]
		);

		$repeater->add_control(
			'icon_indent',
			[
				'label' => __( 'Icon Spacing', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'show_icon' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list .xooapp-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list .xooapp-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'show_icon' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$repeater->add_control(
			'rotate',
			[
				'label' => __( 'Icon Rotate', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);


		$repeater->add_control(
			'button_indi_color',
			[
				'label' => __( 'Background Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_font_color',
			[
				'label' => __( 'Font Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list, {{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list i' => 'color: {{VALUE}};',
				],
			]
		);


		$repeater->add_control(
			'button_hover_indi_color',
			[
				'label' => __( 'Hover Background Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_hover_font_color',
			[
				'label' => __( 'Hover Font Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list:hover, {{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => [
					'font_family' => 'Roboto',
				],
				'fields_options' => [
					
					'font_family' => [
						'default' => 'Roboto',
					],

				],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$repeater->add_responsive_control(
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
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'text-align: {{VALUE}}',
				],
			]
		);


		$repeater->add_control(
			'button_margin',
			[
				'label' => __( 'Margin', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'border_type!' => '',
				],
			]
		);

		$repeater->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'border_type!' => '',
				],
			]
		);

		$repeater->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.xooapp-button-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);




		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'button_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'button_text' => 'Read More',
						'icon' => 'fa fa-arrow-right',
					],
					[
						'button_text' => 'Learn More',
						'icon' => 'fa fa-arrow-right',
					],
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ button_text }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_social_style',
			[
				'label' => __( 'Button', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Style', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'xooapp' ),
					'button' => __( 'Button', 'xooapp' ),
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'xooapp' ),
					'custom' => __( 'Custom', 'xooapp' ),
				],
			]
		);

		$this->add_control(
			'button_primary_color',
			[
				'label' => __( 'Primary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_secondary_color',
			[
				'label' => __( 'Font Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list i, {{WRAPPER}} .xooapp-button-list' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_size',
			[
				'label' => __( 'Size', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'xooapp' ),
				'size_units' => [ 'px', '%' ],
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$button_spacing = 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};';

		$this->add_responsive_control(
			'button_spacing',
			[
				'label' => __( 'Spacing', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list' => $button_spacing,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border', // We know this mistake - TODO: 'button_border' (for hover control condition also)
				'selector' => '{{WRAPPER}} .xooapp-button-list',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_hover',
			[
				'label' => __( 'Icon Hover', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'button_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Font Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'button_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list:hover i, {{WRAPPER}} .xooapp-button-list:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_border_color',
			[
				'label' => __( 'Border Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'image_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-button-list:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'xooapp' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render button list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$class_animation = '';

		if ( ! empty( $settings['hover_animation'] ) ) {
			$class_animation = ' xooapp-animation-' . $settings['hover_animation'];
		}


		$this->add_render_attribute( 'button_list', 'class', 'xooapp-icon-list-items' );
		$this->add_render_attribute( 'list_item', 'class', 'xooapp-icon-list-item' );

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'button_list', 'class', 'xooapp-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'xooapp-inline-item' );
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'button_list' ); ?>>
			<?php
			foreach ( $settings['button_list'] as $index => $item ) {
				$icon = str_replace( 'fa fa-', '', $item['icon'] );

				$link_key = 'link_' . $index;

				$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

				if ( $item['link']['is_external'] ) {
					$this->add_render_attribute( $link_key, 'target', '_blank' );
				}

				if ( $item['link']['nofollow'] ) {
					$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}

				?>
				<div class="xooapp-button-sm xooapp-button-<?php echo $item['align'] ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
					<?php if ( ! empty( $item['link']['url'] ) ) { ?>
						<a class="foo-<?php echo esc_attr( $icon ); ?> xooapp-button-list xooapp-button-type-<?php echo $settings['button_style'] ?> xooapp-button-list-<?php echo $icon . $class_animation; ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>" <?php echo $this->get_render_attribute_string( $link_key ); ?>>
						<?php } else { ?>
							<div class="foo-<?php echo esc_attr( $icon ); ?> xooapp-button-list xooapp-button-type-<?php echo $settings['button_style'] ?> xooapp-button-list-<?php echo $icon . $class_animation; ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
							<?php } ?>
							<?php if(!empty($item['show_icon'] ) ) { ?>
								<span class="xooapp-button-icon xooapp-align-icon-<?php echo $item['icon_align']; ?>">
									<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
								</span>
								<span><?php echo ucwords( $item['button_text'] ); ?></span>
							<?php } else { ?>
								<?php echo ucwords( $item['button_text'] ); ?>
							<?php } ?>

							<?php if ( ! empty( $item['link']['url'] ) ) { ?>
							</a>
						<?php } else { ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<?php
	}

	/**
	 * Render button icons with content widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'button_list', 'class', 'xooapp-icon-list-items' );
		view.addRenderAttribute( 'list_item', 'class', 'xooapp-icon-list-item' );

		if ( 'inline' == settings.view ) {
		view.addRenderAttribute( 'button_list', 'class', 'xooapp-inline-items' );
		view.addRenderAttribute( 'list_item', 'class', 'xooapp-inline-item' );
	}
	#>
	<div {{{ view.getRenderAttributeString( 'button_list' ) }}}>
		<# _.each( settings.button_list, function( item ) {
		var link = item.link ? item.link.url : '',
		icon = item.icon.replace( 'fa fa-', '' ); #>

		<div class="xooapp-button-sm xooapp-button-{{item.align}} elementor-repeater-item-{{ item._id }}">
			<# if ( item.link && item.link.url ) { #>
			<a class="foo-{{{ icon }}} xooapp-button-list xooapp-button-list-{{ icon }} xooapp-button-type-{{settings.button_style}} xooapp-animation-{{ settings.hover_animation }} elementor-repeater-item-{{ item._id }}" href="{{ link }}">
				<# } else { #>
				<div class="foo-{{{ icon }}} xooapp-button-list xooapp-button-list-{{ icon }} xooapp-button-type-{{settings.button_style}} xooapp-animation-{{ settings.hover_animation }} elementor-repeater-item-{{ item._id }}">
					<# } #>
					<# if( item.show_icon ) { #>
					<span class="xooapp-button-icon xooapp-align-icon-{{ item.icon_align }}">
						<i class="{{ item.icon }}"></i>
					</span>
					<span>{{{ item.button_text }}}</span>
					<# } else { #>
					{{{ item.button_text }}}
					<# } #>
					<# if ( item.link && item.link.url ) { #>
				</a>
				<# } else { #>
			</div>
			<# } #>
		</div>
		<# } ); #>
	</div>
	<?php
}
}

