<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Team extends Widget_Base {

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
		return 'xooapp-team';
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
		return __( 'Team', 'xooapp' );
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
		return [ 'team', 'member', 'user' ];
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
			'section_team',
			[
				'label' => __( 'Team', 'xooapp' ),
			]
		);

		$this->add_control(
			'team_image',
			[
				'label' => __( 'Upload Image', 'xooapp' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
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
					'team_image!' => '',
				],
				'prefix_class' => 'team-shape-',
			]
		);

		$this->add_control(
			'team_name',
			[
				'label' => __( 'Title', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Jonathan Barnes', 'xooapp' ),
				'placeholder' => __( 'Enter your Name', 'xooapp' ),
			]
		);

		$this->add_control(
			'designation',
			[
				'label' => __( 'Designation', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Founder', 'xooapp' ),
				'placeholder' => __( 'Enter Your Designation', 'xooapp' ),
				
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
				'default' => '#',
				'label_block' => true,
			]
		);

		$this->add_control(
			'social_list',
			[
				'label' => __( 'Repeater List', 'xooapp' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_name' => __( 'Facebook', 'xooapp' ),
						'social_icon' => __( 'fa fa-facebook', 'xooapp' ),
					],
					[
						'social_name' => __( 'Twitter', 'xooapp' ),
						'social_icon' => __( 'fa fa-twitter', 'xooapp' ),
					],
					[
						'social_name' => __( 'Dribbble', 'xooapp' ),
						'social_icon' => __( 'fa fa-dribbble', 'xooapp' ),
					],
				],
				'title_field' => '{{{ social_name }}}',
			]
		);


		$this->add_control(
			'position',
			[
				'label' => __( 'Position', 'xooapp' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'xooapp' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'xooapp' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'xooapp' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'team-position-',
				'toggle' => false,
				'condition' => [
					'team_image!' => '',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Image', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'team_image!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'image_colors' );

		$this->start_controls_tab(
			'image_colors_normal',
			[
				'label' => __( 'Normal', 'xooapp' ),
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-photo' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-photo img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'image_colors_hover',
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
				'selectors' => [
					'{{WRAPPER}} .team-member-photo:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .team-member-photo:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-photo:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .team-member-photo:hover' => 'color: {{VALUE}};',
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
			'image_space',
			[
				'label' => __( 'Spacing', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-member-photo img' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .team-member-photo img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .team-member-photo img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .team-member-photo img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .team-member-photo img' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
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
					'{{WRAPPER}} .team-member-photo img' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
					'{{WRAPPER}} .team-member-photo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-image-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .team-img-meta div' => 'color: {{VALUE}};',
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
					
					'font_family' => [
						'default' => 'Montserrat',
					],

				],
				'selector' => '{{WRAPPER}} .team-img-meta',
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
					'{{WRAPPER}} .team-image-box-description' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .xooapp-icon-box-content .team-image-box-description',
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

		if ( empty( $settings['team_image']['url'] ) ) {
			return;
		}

		$this->add_render_attribute( 'team_image', 'class', [ 'team-image', 'elementor-animation-' . $settings['hover_animation'] ] );

		$image_tag = 'div';
		$has_image = ! empty( $settings['team_image'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$image_tag = 'a';

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( $has_image ) {
			$this->add_render_attribute( 'i', 'class', $settings['team_image'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$image_attributes = $this->get_render_attribute_string( 'team_image' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		$this->add_render_attribute( 'designation', 'class', 'team-image-box-description grey-color' );

		$this->add_inline_editing_attributes( 'team_name', 'none' );
		$this->add_inline_editing_attributes( 'designation' );


		?>

		<div class="team-member green-hover">
			<div class="box-line"></div>

			<!-- Team Member Photo -->
			<div class="team-member-photo">
				<span class="image-block" style="background-image: url(<?php echo $settings['team_image']['url']; ?>)"></span>
			</div>

			<!-- Team Member Meta -->		
			<div class="team-img-meta">													
				<<?php echo implode( ' ', [ $image_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'team_name' ); ?>><?php echo $settings['team_name']; ?></<?php echo $image_tag; ?>>
				<span <?php echo $this->get_render_attribute_string( 'designation' ); ?>><?php echo $settings['designation']; ?></span>

				<!-- Social Icons -->
				<div class="tm-social clearfix">
					<ul class="text-center clearfix">			
						<?php foreach ($settings['social_list'] as $item) {
							$icon_class = $item['social_icon'];
							$social_class = str_replace('fa fa-', '', $icon_class);
							?>																
							<li><a href="<?php echo esc_url($item['social_link']) ?>" class="ico-<?php echo esc_attr($social_class) ?>">
								<i class="<?php echo esc_html($item['social_icon']) ?>"></i>
							</a></li>
						<?php } ?>
						
					</ul>									
				</div>	

			</div>	

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
		var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
		imgTag = link ? 'a' : 'div';

		view.addRenderAttribute( 'designation', 'class', 'team-image-box-description' );

		view.addInlineEditingAttributes( 'team_name', 'none' );
		view.addInlineEditingAttributes( 'designation' );


		#>

		<div class="team-member green-hover">
			<div class="box-line"></div>

			<# if ( settings.team_image ) { #>
			<!-- Team Member Photo -->
			<div class="team-member-photo">
				<{{{ imgTag + ' ' + link }}} class="team-image elementor-animation-{{ settings.hover_animation }}">
				<img src="{{ settings.team_image.url }}"/>
				</{{{ imgTag }}}>
			</div>
			<# } #>
			<!-- Team Member Meta -->		
			<div class="team-img-meta">													
				<{{{ imgTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'team_name' ) }}}>{{{ settings.team_name }}}</{{{ imgTag }}}>
				<span {{{ view.getRenderAttributeString( 'designation' ) }}}>{{{ settings.designation }}}</span>

				<!-- Social Icons -->
				<div class="tm-social clearfix">
					<ul class="text-center clearfix">	
					<# _.each( settings.social_list, function( item ) { #>																		
						<li><a href="{{ item.social_link }}" class="{{ item.social_name }}"><i class="{{ item.social_icon }}"></i></a></li>
						<# }); #>
					</ul>									
				</div>	

			</div>	

		</div>	
		<?php
	}
}
