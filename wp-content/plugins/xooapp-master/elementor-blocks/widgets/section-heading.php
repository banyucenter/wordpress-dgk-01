<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Xooapp_Section_Heading extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'xooapp-section-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Xooapp Section Heading', 'xooapp' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-type-tool';
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
		return [ 'heading', 'title', 'text' ];
	}

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'xooapp' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'xooapp' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'xooapp' ),
				'default' => __( 'Add Your Heading Text Here', 'xooapp' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'xooapp' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'size',
			[
				'label' => __( 'Size', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'xxl',
				'options' => [
					'default' => __( 'Default', 'xooapp' ),
					'small' => __( 'Small', 'xooapp' ),
					'medium' => __( 'Medium', 'xooapp' ),
					'large' => __( 'Large', 'xooapp' ),
					'xl' => __( 'XL', 'xooapp' ),
					'xxl' => __( 'XXL', 'xooapp' ),
				],
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => __( 'HTML Tag', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
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
					'{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'xooapp' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();


		/**
		 * subheading
		 *
		 * @return void 
		 */
		$this->start_controls_section(
			'section_subheading',
			[
				'label' => __( 'Sub Title', 'xooapp' ),
			]
		);

		$this->add_control(
			'subheading_title',
			[
				'label' => __( 'Sub Title', 'xooapp' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Short Description', 'xooapp' ),
				'default' => __( 'Add Your Short Description Text Here', 'xooapp' ),
			]
		);

		$this->add_control(
			'sub_header_size',
			[
				'label' => __( 'HTML Tag', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'p',
			]
		);


		$this->add_control(
			'sub_view',
			[
				'label' => __( 'View', 'xooapp' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title .xooapp-heading-title' => 'color: {{VALUE}};margin: 0;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'fields_options' => [
					
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_weight' => [
						'default' => '700',
					],

				],
				'selector' => '{{WRAPPER}} .section-title .xooapp-heading-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .section-title .xooapp-heading-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title .xooapp-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * subheading control
		 *
		 * @return void 
		 */
		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label' => __( 'Sub Heading', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .elementor-widget-container .section-title p, {{WRAPPER}} .elementor-widget-container .section-title span, {{WRAPPER}} .elementor-widget-container .section-title div' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'fields_options' => [
					'font_family' => [
						'default' => 'Roboto',
					],
					'font_weight' => [
						'default' => '300',
					],
					'font_size'   => [
						'default' => [ 
							'unit' => 'px', 
							'size' => 21 
						]
					],
				],
				'selector' => '{{WRAPPER}} .elementor-widget-container .section-title p, {{WRAPPER}} .elementor-widget-container .section-title span, {{WRAPPER}} .elementor-widget-container .section-title div',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'sub_text_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container .section-title p, {{WRAPPER}} .elementor-widget-container .section-title span, {{WRAPPER}} .elementor-widget-container .section-title > div',
			]
		);

		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-widget-container .section-title p, {{WRAPPER}} .elementor-widget-container .section-title span, {{WRAPPER}} .elementor-widget-container .section-title > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-widget-container .section-title p, {{WRAPPER}} .elementor-widget-container .section-title span, {{WRAPPER}} .elementor-widget-container .section-title > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


		/**
		 * section margin 
		 *
		 * @return void 
		 */
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Section Block Margin', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_margin',
			[
				'label' => esc_html__( 'Margin', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'section_padding',
			[
				'label' => esc_html__( 'Padding', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'title', 'class', 'xooapp-heading-title' );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'xooapp-size-' . $settings['size'] );
		}

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		// subheading
		$this->add_render_attribute( 'subheading_title', 'class', 'xooapp-sub-heading' );

		$this->add_render_attribute( 'subheading_title', 'class', 'xooapp-subsize-' . $settings['sub_header_size'] );

		$this->add_inline_editing_attributes( 'subheading_title' );

		$subheading_title = $settings['subheading_title'];



		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $title );
		$subheading_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['sub_header_size'], $this->get_render_attribute_string( 'subheading_title' ), $subheading_title );

		echo '<div class="section-title">';
		if( !empty($settings['title']) ) {
			echo $title_html;
		}
		if( !empty($settings['subheading_title']) ) {
			echo $subheading_html;
		}
		echo '</div>';

	}

	/**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		var title = settings.title;

		if ( '' !== settings.link.url ) {
			title = '<a href="' + settings.link.url + '">' + title + '</a>';
		}

		view.addRenderAttribute( 'title', 'class', [ 'xooapp-heading-title', 'xooapp-size-' + settings.size ] );

		view.addInlineEditingAttributes( 'title' );

		var subtitle = settings.subheading_title;
		view.addRenderAttribute( 'subheading_title', 'class', [ 'xooapp-sub-heading', 'xooapp-subsize-' + settings.sub_header_size ] );
		view.addInlineEditingAttributes( 'subheading_title' );

		var title_html = '<' + settings.header_size  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.header_size + '>';
		var subheading_html = '<' + settings.sub_header_size  + ' ' + view.getRenderAttributeString( 'subtitle' ) + '>' + subtitle + '</' + settings.sub_header_size + '>';
		#>
		<div class="section-title">
			<#
			print( title_html );
			print( subheading_html );
			#>
		</div>
		<?php
	}
}

