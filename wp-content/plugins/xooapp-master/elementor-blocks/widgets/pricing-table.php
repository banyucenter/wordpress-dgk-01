<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Elementor icon list widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class Xooapp_Pricing_Table extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'pricing-table';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Pricing Table', 'xooapp' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'table', 'list', 'pricing table' ];
	}

	/**
	 * Get widget Category.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'xooapp-master-elements' ];    // category of the widget
	}

	/**
	 * Register icon list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Pricing Table', 'xooapp' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'xooapp' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => '<div class="pricing-plan m-bottom-10">
				<h4 class="h4-md">XooApp <span>Free</span></h4>									
				<span class="price">Free</span>
				</div>',
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

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'List Item', 'xooapp' ),
				'default' => __( 'List Item', 'xooapp' ),
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'xooapp' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-check',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'xooapp' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'xooapp' ),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __( '20 Users Tasks', 'xooapp' ),
						'icon' => 'fa fa-check',
					],
					[
						'text' => __( '5 GB of Storage', 'xooapp' ),
						'icon' => 'fa fa-check',
					],
					[
						'text' => __( 'Theme Customization', 'xooapp' ),
						'icon' => 'fa fa-dot-circle-o',
					],
					[
						'text' => __( 'Free Email Support', 'xooapp' ),
						'icon' => 'fa fa-dot-circle-o',
					],
					[
						'text' => __( 'Security Suite', 'xooapp' ),
						'icon' => 'fa fa-dot-circle-o',
					],
				],
				'title_field' => '<i class="{{ icon }}" aria-hidden="true"></i> {{{ text }}}',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Button Text', 'xooapp' ),
				'default' => __( 'Get Started', 'xooapp' ),
			]
		);

		$this->add_control(
			'button_text_link',
			[
				'label' => __( 'Text', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Button Link', 'xooapp' ),
				'default' => '',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => __( 'List', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => __( 'Alignment', 'xooapp' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'xooapp' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'xooapp' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'xooapp' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __( 'Divider', 'xooapp' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'xooapp' ),
				'label_on' => __( 'On', 'xooapp' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'Style', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'xooapp' ),
					'double' => __( 'Double', 'xooapp' ),
					'dotted' => __( 'Dotted', 'xooapp' ),
					'dashed' => __( 'Dashed', 'xooapp' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => __( 'Weight', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => __( 'Width', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => __( 'Height', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Hover', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => __( 'Text', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Hover', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_indent',
			[
				'label' => __( 'Text Indent', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-list-item',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_button_style',
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
				'options' => [
					'btn-tra-black' => __( 'Default', 'xooapp' ),
					'btn-lightblue' => __( 'Blue', 'xooapp' ),
					'btn-custom' => __( 'Custom', 'xooapp' ),
				],
				'default'	=> 'btn-tra-black',

			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Background Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .pricing-table .btn-custom' => 'background: {{VALUE}};',
				],
				'condition' => [
					'button_style' => 'btn-custom',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_control(
			'button_color_text',
			[
				'label' => __( 'Text', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_style' => 'btn-custom',
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table .btn-custom' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_style' => 'btn-custom',
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table .btn-custom' => 'border-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);




		$this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Hover Background Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_style' => 'btn-custom',
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table .btn-custom:hover' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_control(
			'button_hover_color_text',
			[
				'label' => __( 'Hover Text', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_style' => 'btn-custom',
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table .btn-custom:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Hover Border Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_style' => 'btn-custom',
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table .btn-custom:hover' => 'border-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);


		$this->end_controls_section();
	}

	/**
	 * Render icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$editor_content = $this->get_settings_for_display( 'title' );
		$editor_content = $this->parse_text_editor( $editor_content );

		$this->add_render_attribute( 'icon_list', 'class', ['features', 'elementor-icon-list-items' ] );
		$this->add_render_attribute( 'list_item', 'class', 'elementor-icon-list-item' );

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'elementor-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
		}
		?>
		<div class="pricing-table m-bottom-40">		

			<!-- Plan Price  -->
			<div class="pricing-plan m-bottom-10">
				
				<?php echo $editor_content; ?>
			</div>	

			<!-- Pricing Plan Features  -->


			<ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?>>
				<?php
				foreach ( $settings['icon_list'] as $index => $item ) :
					$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

					$this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-icon-list-text' );

					$this->add_inline_editing_attributes( $repeater_setting_key );
					?>
					<li class="elementor-icon-list-item" >
						<?php
						if ( ! empty( $item['link']['url'] ) ) {
							$link_key = 'link_' . $index;

							$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

							if ( $item['link']['is_external'] ) {
								$this->add_render_attribute( $link_key, 'target', '_blank' );
							}

							if ( $item['link']['nofollow'] ) {
								$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							}

							echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
						}

						if ( ! empty( $item['icon'] ) ) :
							?>
							<span class="elementor-icon-list-icon">
								<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
							</span>
						<?php endif; ?>
						<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo $item['text']; ?></span>
						<?php if ( ! empty( $item['link']['url'] ) ) : ?>
						</a>
					<?php endif; ?>
				</li>
				<?php
			endforeach;
			?>
		</ul>
		
		<?php 

		$button_style = $settings['button_style'];
		$button_style = ($button_style) ? $button_style : 'btn-tra-black';
		?>
		<!-- Pricing Table Button  -->
		<a href="<?php echo esc_url( $settings['button_text_link'] ) ?>" class="btn <?php echo esc_attr( $button_style ) ?>"><?php echo esc_html( $settings['button_text'] ) ?></a>

	</div>

	<?php
}

	/**
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'icon_list', 'class', ['features', 'elementor-icon-list-items' ] );
		view.addRenderAttribute( 'list_item', 'class', 'elementor-icon-list-item' );

		if ( 'inline' == settings.view ) {
		view.addRenderAttribute( 'icon_list', 'class', 'elementor-inline-items' );
		view.addRenderAttribute( 'list_item', 'class', 'elementor-inline-item' );
	}
	#>
	<div class="pricing-table m-bottom-40">		

		<!-- Plan Price  -->
		<div class="pricing-plan m-bottom-10">
			{{{settings.title}}}
		</div>	
		<# if ( settings.icon_list ) { #>
		<ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
			<# _.each( settings.icon_list, function( item, index ) {

			var iconTextKey = view.getRepeaterSettingKey( 'text', 'icon_list', index );

			view.addRenderAttribute( iconTextKey, 'class', 'elementor-icon-list-text' );

			view.addInlineEditingAttributes( iconTextKey ); #>

			<li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
				<# if ( item.link && item.link.url ) { #>
				<a href="{{ item.link.url }}">
					<# } #>
					<# if ( item.icon ) { #>
					<span class="elementor-icon-list-icon">
						<i class="{{ item.icon }}" aria-hidden="true"></i>
					</span>
					<# } #>
					<span {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</span>
					<# if ( item.link && item.link.url ) { #>
				</a>
				<# } #>
			</li>
			<#
		} ); #>
	</ul>
	<#	} #>

	<!-- Pricing Table Button  -->
	<a href="{{settings.button_text_link}}" class="btn {{settings.button_style}}">{{{settings.button_text}}}</a>

</div>
<?php
}
}
