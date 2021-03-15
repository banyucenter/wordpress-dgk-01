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
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Feature_Box extends Widget_Base {

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
		return 'feature-box';
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
		return __( 'Feature Box', 'xooapp' );
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
		return [ 'icon box', 'icon', 'feature box', 'feature' ];
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
			'section_icon',
			[
				'label' => __( 'Feature Box', 'xooapp' ),
			]
		);

		$this->start_controls_tabs( 'icon_select' );
		$this->start_controls_tab(
			'icon_select_normal',
			[
				'label' => __( 'Icon', 'xooapp' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'xooapp' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-globe',
			]
		);
		$this->end_controls_tab();

		
		$this->start_controls_tab(
			'image_select_normal',
			[
				'label' => __( 'Image', 'xooapp' ),
			]
		);

		$this->add_control(
			'feature_image',
			[
				'label' => __( 'Image', 'xooapp' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_control(
			'feature_style',
			[
				'label' => __( 'Feature Box Style', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fbox-1 blue-icon' => __( 'Default (You Can Customize)', 'xooapp' ),
					'fbox-3 purple-hover' => __( 'Purple Hover With Border', 'xooapp' ),
					'fbox-3 rose-hover' => __( 'Rose Hover With Border', 'xooapp' ),
					'fbox-3 red-hover' => __( 'Red Hover With Border', 'xooapp' ),
					'fbox-3 orange-hover' => __( 'Orange Hover With Border', 'xooapp' ),
					'fbox-3 blue-hover' => __( 'Blue Hover With Border', 'xooapp' ),
					'fbox-3 green-hover' => __( 'Green Hover With Border', 'xooapp' ),
					'fbox-3 skyblue-hover' => __( 'Skyblue Hover With Border', 'xooapp' ),
				],
				'default' => 'fbox-1 blue-icon',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'xooapp' ),
					'stacked' => __( 'Stacked', 'xooapp' ),
					'framed' => __( 'Framed', 'xooapp' ),
				],
				'default' => 'default',
				'prefix_class' => 'featured-view-',
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'xooapp' ),
					'square' => __( 'Square', 'xooapp' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
					'icon!' => '',
				],
				'prefix_class' => 'featured-shape-',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'xooapp' ),
				'placeholder' => __( 'Enter your title', 'xooapp' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'sub_title_text',
			[
				'label' => __( 'Sub Title', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Aliquam a augue luctus neque purus ipsum neque dolor primis suscipit', 'xooapp' ),
				'placeholder' => __( 'Enter your description', 'xooapp' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);



		$this->add_control(
			'link',
			[
				'label' => __( 'Link to', 'xooapp' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'xooapp' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Title HTML Tag', 'xooapp' ),
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
				'default' => 'h3',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_app_icon',
			[
				'label' => __( 'App Icon Box', 'xooapp' ),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'social_name', [
				'label' => __( 'Social', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Social Name' , 'xooapp' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'social_icon', [
				'label' => __( 'Icon', 'xooapp' ),
				'type' => Controls_Manager::ICON,
				'default' => __( 'Social Icon' , 'xooapp' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'social_link', [
				'label' => __( 'Social Link', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'social_list',
			[
				'label' => __( 'Repeater List', 'xooapp' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ social_name }}}',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'xooapp' ),
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
				'condition' => [
					'feature_style' => 'fbox-1 blue-icon',
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
				'condition' => [
					'feature_style' => 'fbox-1 blue-icon',
				],
				'selectors' => [
					'{{WRAPPER}} .blue-icon i' => 'background: -webkit-gradient(linear, left top, left bottom, from({{font_gradient_primary_color.VALUE}}), to({{VALUE}})); -webkit-background-clip: text; -webkit-text-fill-color: transparent;',
				],
				'of_type' => 'gradient',
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'condition' => [
					'view!' => 'default',
				],
				'default' => '#1d07f4',
				'selectors' => [
					'{{WRAPPER}}.featured-view-stacked .featured-box-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.featured-view-framed .featured-box-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
					'feature_style!' => 'fbox-1 blue-icon',
				],
				'selectors' => [
					'{{WRAPPER}}.featured-view-framed .featured-box-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.featured-view-stacked .featured-box-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'xooapp' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.featured-view-stacked .featured-box-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.featured-view-framed .featured-box-icon:hover, {{WRAPPER}}.featured-view-default .featured-box-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.featured-view-framed .featured-box-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.featured-view-stacked .featured-box-icon:hover' => 'color: {{VALUE}};',
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

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
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
					'{{WRAPPER}} .featured-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .featured-box-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .featured-box-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .featured-box-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .featured-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
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
				'selectors' => [
					'{{WRAPPER}} .featured-box-icon-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'xooapp' ),
					'middle' => __( 'Middle', 'xooapp' ),
					'bottom' => __( 'Bottom', 'xooapp' ),
				],
				'default' => 'top',
				'prefix_class' => 'featured-vertical-align-',
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'xooapp' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .featured-box-icon-box-title' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .xooapp-icon-box-content .featured-box-icon-box-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => [
					'font_family' => 'Montserrat',
				],
				'fields_options' => [
					'font_weight' => [
						'default' => 700,
					],
					'font_family' => [
						'default' => 'Montserrat',
					],

				],
				'selector' => '{{WRAPPER}} .xooapp-icon-box-content .featured-box-icon-box-title, {{WRAPPER}} .xooapp-icon-box-content .featured-box-icon-box-title span ',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xooapp-icon-box-content .featured-box-icon-box-description' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .xooapp-icon-box-content .featured-box-icon-box-description',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon', 'class', [ 'featured-box-icon', 'featured-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';
		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		$this->add_render_attribute( 'description_text', 'class', 'featured-box-icon-box-description grey-color' );

		$this->add_inline_editing_attributes( 'title_text', 'none' );
		$this->add_inline_editing_attributes( 'description_text' );


		$feature_style = $settings['feature_style'];
		$this->add_render_attribute( 'feature_style', 'class', $feature_style );
		?>

		<div class="featured-box-icon-wrapper">
			<div <?php echo $this->get_render_attribute_string( 'feature_style' ); ?>>
				
				<?php if( isset( $settings['feature_image']['url'] ) && !empty($settings['feature_image']['url']) ) { ?>
					<div class="m-img">
						<img class="img-fluid" src="<?php echo $settings['feature_image']['url'] ?>" width="150" height="150" alt="app-logo">
					</div>
				<?php } else { ?>
					<div class="box-line"></div>
					<?php if ( $has_icon ) : ?>
						<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
						<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
						</<?php echo $icon_tag; ?>>
					<?php endif; ?>
				<?php } ?>

				<div class="xooapp-icon-box-content">
					<<?php echo $settings['title_size']; ?> class="featured-box-icon-box-title">
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
					</<?php echo $settings['title_size']; ?>>

					<?php if(!empty($settings['sub_title_text'])) { ?>
						<div class="more-app-box">
							<span class="app-cat"><?php echo esc_html( $settings['sub_title_text'] ) ?></span>
						</div>
					<?php } ?>

					<?php if(!empty($settings['description_text'])) { ?>
						<p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $settings['description_text']; ?></p>
					<?php } ?>

					<?php if(isset($settings['social_list'])) { ?>
						<!-- Links -->
						<div class="more-app-box">
							<?php foreach ($settings['social_list'] as $item) {
								?>																
								<a href="<?php echo esc_html($item['social_link']) ?>" class="<?php echo esc_html($item['social_name']) ?>">
									<i class="<?php echo esc_html($item['social_icon']) ?>"></i>
									<span><?php echo esc_html($item['social_name']) ?></span>
								</a>
							<?php } ?>
						</div>
					<?php } ?>

				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render icon box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
		iconTag = link ? 'a' : 'span';

		view.addRenderAttribute( 'description_text', 'class', 'featured-box-icon-box-description' );

		view.addInlineEditingAttributes( 'title_text', 'none' );
		view.addInlineEditingAttributes( 'description_text' );

		view.addRenderAttribute( 'feature_style', 'class', settings.feature_style );

		#>
		<div class="featured-box-icon-wrapper liveview">
			<div {{{ view.getRenderAttributeString( 'feature_style' ) }}}>

				<# if( ( settings.feature_image.url ) && ( settings.feature_image.url ) ) { #>
				<div class="m-img">
					<img class="img-fluid" src="{{ settings.feature_image.url }}" width="150" height="150" alt="app-logo">
				</div>
				<# } else { #>

				<div class="box-line"></div>
				<# if ( settings.icon ) { #>
				<{{{ iconTag + ' ' + link }}} class="featured-box-icon featured-animation-{{ settings.hover_animation }}">
				<i class="{{ settings.icon }}"></i>
				</{{{ iconTag }}}>
				<# } #>

				<# } #>

				<div class="xooapp-icon-box-content">
					<{{{ settings.title_size }}} class="featured-box-icon-box-title">
					<{{{ iconTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
					</{{{ settings.title_size }}}>
					<# if ( settings.sub_title_text ) { #>
					<div class="more-app-box">
						<span class="app-cat">{{ settings.sub_title_text }}</span>
					</div>
					<# } #>
					<# if ( settings.description_text ) { #>
					<p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
					<# } #>
				</div>
				<div class="more-app-box">
					<# _.each( settings.social_list, function( item ) { #>																		
					<a href="{{ item.social_link }}" class="{{ item.social_name }}"><i class="{{ item.social_icon }}"></i><span>{{{item.social_name}}}</span></a>
					<# }); #>
				</div>
			</div>
		</div>
		<?php
	}
}
