<?php
namespace Xooapp\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Testimonial
 *
 * Elementor widget for testimoinal
 *
 * @since 1.0.0
 */
class Xooapp_Testimonials extends Widget_Base {

	public function get_name() {
		return 'xooapp-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'xooapp' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'xooapp-master-elements' ];
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'slick' ];
	}

	protected function _register_controls() {

		
	// Content options Start
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Testimonial Items', 'xooapp' ),
			]
		);


		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'xooapp' ),
				'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'Jonathan Morgan', 'xooapp' ),
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label' => esc_html__( 'Designation', 'xooapp' ),
				'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'Jonathan Morgan', 'xooapp' ),
			]
		);


		$repeater->add_control(
			'testimoni_image',
			[
				'label' => esc_html__( 'Testimonial Image', 'xooapp' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => XOOAPP_PLG_URL . 'assets/images/testimonial-demo.jpg',
				],
			]
		);

		$repeater->add_control(
			'testimoni_content_title',
			[
				'label' => esc_html__( 'Content Title', 'xooapp' ),
				'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'Super Support', 'xooapp' ),
			]
		);

		$repeater->add_control(
			'testimoni_content',
			[
				'label' => esc_html__( 'Description', 'xooapp' ),
				'type'  => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Corem ipsum dolor si amet consectetur adipisic ingelit sed do adipisicido executiv
					sunse pit lore kome.', 'xooapp' ),
			]
		);

		$repeater->add_control(
			'testimonial_rating',
			[
				'label'     => esc_html__( 'Display Rating', 'xooapp' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',
				'options'   => [
					'<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>'   => esc_html__( 'Rating 1', 'xooapp' ),
					'<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>'   => esc_html__( 'Rating 2', 'xooapp' ),
					'<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>'   => esc_html__( 'Rating 3', 'xooapp' ),
					'<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>'   => esc_html__( 'Rating 4', 'xooapp' ),
					'<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>'   => esc_html__( 'Rating 5', 'xooapp' ),
				],
			]
		);

		$this->add_control(
			'testimonial_option',
			[
				'label'       => esc_html__( 'Testimonials Options', 'xooapp' ),
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'default'     => [
					[
						'title'       => esc_html__( 'Jonathan Morgan', 'xooapp' ),
						'designation' => esc_html__( 'Marketting', 'xooapp' ),
						'testimoni_content_title' => 'Super Support',
						'testimoni_content' => 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo conse quat. Duis aute irure dolor in reprehenderit in voluptate.',
						'testimoni_image' => [
							'url' => XOOAPP_PLG_URL . 'assets/images/review-author-1.jpg',
						],
						'testimonial_rating' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',

					],
					[
						'title'       => esc_html__( 'Harsul Hisham', 'xooapp' ),
						'designation' => esc_html__( 'Engineer', 'xooapp' ),
						'testimoni_content_title' => 'What a theme!',
						'testimoni_content' => 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo conse quat. Duis aute irure dolor in reprehenderit in voluptate.',
						'testimoni_image' => [
							'url' => XOOAPP_PLG_URL . 'assets/images/review-author-2.jpg',
						],
						'testimonial_rating' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',

					],
					[
						'title'       => esc_html__( 'Teem Southy', 'xooapp' ),
						'designation' => esc_html__( 'Developer', 'xooapp' ),
						'testimoni_content_title' => 'Outstanding Support',
						'testimoni_content' => 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo conse quat. Duis aute irure dolor in reprehenderit in voluptate.',
						'testimoni_image' => [
							'url' => XOOAPP_PLG_URL . 'assets/images/review-author-3.jpg',
						],
						'testimonial_rating' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',

					],
					[
						'title'       => esc_html__( 'Harsul Hisham', 'xooapp' ),
						'designation' => esc_html__( 'Engineer', 'xooapp' ),
						'testimoni_content_title' => 'Happy!!',
						'testimoni_content' => 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo conse quat. Duis aute irure dolor in reprehenderit in voluptate.',
						'testimoni_image' => [
							'url' => XOOAPP_PLG_URL . 'assets/images/review-author-4.jpg',
						],
						'testimonial_rating' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>',

					],
					[
						'title'       => esc_html__( 'Jake Margin', 'xooapp' ),
						'designation' => esc_html__( 'Marketing', 'xooapp' ),
						'testimoni_content_title' => 'Nice Person',
						'testimoni_content' => 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo conse quat. Duis aute irure dolor in reprehenderit in voluptate.',
						'testimoni_image' => [
							'url' => XOOAPP_PLG_URL . 'assets/images/review-author-5.jpg',
						],
						'testimonial_rating' => '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>',

					],
				],
				'fields'      => array_values( $repeater->get_controls() ),
				'title_field' => '{{{title}}}',
			]
		);

		$this->end_controls_section();


	// Content options End
		$this->start_controls_section(
			'layout_style',
			[
				'label' => esc_html__( 'Layout', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'testimonial_style',
			[
				'label'     => esc_html__( 'Display Style', 'xooapp' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => [
					'1'   => esc_html__( 'Style 1', 'xooapp' ),
					'2'   => esc_html__( 'Style 2', 'xooapp' ),
				],
			]
		);

		$this->add_control(
			'testimonial_items',
			[
				'label'     => esc_html__( 'Items Shows', 'xooapp' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => [
					'1'   => esc_html__( 'Item 1', 'xooapp' ),
					'2'   => esc_html__( 'Item 2', 'xooapp' ),
					'3'   => esc_html__( 'Item 3', 'xooapp' ),
				],
			]
		);


		$this->add_control(
			'bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .reviews-section' => 'background-color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'item_center_bg_color',
			[
				'label'     => esc_html__( 'Center Bg/Hover Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .reviews-section:hover' => 'background-color: {{VALUE}};',

				],
			]
		);



		$this->add_control(
			'autoplay_enable',
			[
				'label'     => esc_html__( 'Auto Play Enable/Disable', 'xooapp' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'yes'    => esc_html__( 'True', 'xooapp' ),
				'no'     => esc_html__( 'False', 'xooapp' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'    => 'item_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .review-2 .review-txt',
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => esc_html__( 'Border/Quite Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .review-txt' => 'color: {{VALUE}};',
					'{{WRAPPER}} .review-txt' => 'border-color: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Image Border Radius', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .review-txt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Content', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .review-txt' => 'background-color: {{VALUE}};',

				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Content Typography', 'xooapp' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .review-txt',
			]
		);

		$this->add_control(
			'testimoni_color',
			[
				'label'     => esc_html__( 'Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#676767',
				'selectors' => [
					'{{WRAPPER}} .review-txt' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();





		$this->start_controls_section(
			'section_name',
			[
				'label' => esc_html__( 'Name/Designation', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);



		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Name Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#182432',
				'selectors' => [
					'{{WRAPPER}} .testimonial-autor' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => esc_html__( 'Name Typography', 'xooapp' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .testimonial-autor',
			]
		);



		$this->add_control(
			'designation_color',
			[
				'label'     => esc_html__( 'Designation Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#989898',
				'selectors' => [
					'{{WRAPPER}}  .testimonial-avatar span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typography',
				'label'    => esc_html__( 'Designation Typography', 'xooapp' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .testimonial-avatar span',
			]
		);

		

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();
		$id = $this->get_id();
		$id = ($id) ? $id : '';
		?>
	<!-- TESTIMONIALS-2
		============================================= -->
		<div id="reviews-2<?php echo $id; ?>" class="reviews-section division">
			<div class="container">

				<!-- TESTIMONIALS CAROUSEL -->
				<div class="reviews-carousel">
					<div class="center slider">
						<?php foreach ( $settings['testimonial_option'] as $testimonial ) : ?>
							
							<?php 
							$testimonial_style = 2;
							$testimonial_style = $settings['testimonial_style'];
							$testimonial_style = ($testimonial_style == 1) ? '1' : '2';
							?>
							<!-- TESTIMONIAL #1 -->
							<div class="review-<?php echo esc_attr( $testimonial_style ) ?>">
								
								<!-- Testimonial Text -->
								<div class="review-txt">

									<!-- Title -->
									<h5 class="h5-lg"><?php echo $testimonial['testimoni_content_title'];?></h5>
									
									<!-- Testimonial Text -->
									<p><?php echo $testimonial['testimoni_content'];?></p>

								</div>

								<!-- Testimonial Author Avatar -->
								<div class="testimonial-avatar text-center">
									<?php if ($testimonial['testimoni_image']['url']):?>
										<img src="<?php echo $testimonial['testimoni_image']['url']; ?>" alt="review-author-avatar">
									<?php endif;?>
									

									<p class="testimonial-autor"><?php echo $testimonial['title'];  ?></p>
									<span><?php echo $testimonial['designation'];  ?></span>
								</div>

								<!-- App Rating -->
								<div class="app-rating">
									<?php echo $testimonial['testimonial_rating']; ?>
								</div>

							</div>	<!-- END TESTIMONIAL #1 -->
						<?php endforeach; ?>            	


					</div>
				</div>	<!-- TESTIMONIALS CAROUSEL -->


			</div>	   <!-- End container -->
		</div>	<!-- END TESTIMONIALS-2 -->

		
		<script>

			jQuery(document).ready(function($) {
				var slk = jQuery('#reviews-1<?php echo $id; ?> .center, #reviews-2<?php echo $id; ?> .center');
				slk.slick({
					centerMode: true,
					<?php if ($settings['autoplay_enable'] == 'yes'): ?>
						autoplay:true,
						<?php else: ?>
							autoplay:false,
						<?php endif; ?>
						centerPadding: '0px',
						speed: 2000,
						slidesToShow: <?php echo $settings['testimonial_items']; ?>,
						dots: true,
						responsive: [
						{
							breakpoint: 1199,
							settings: {
								arrows: false,
								centerMode: true,
								centerPadding: '0px',
								slidesToShow: <?php echo $settings['testimonial_items']; ?>
							}
						},
						{
							breakpoint: 991,
							settings: {
								arrows: false,
								centerMode: true,
								centerPadding: '0px',
								slidesToShow: <?php echo $settings['testimonial_items']; ?>
							}
						},
						{
							breakpoint: 800,
							settings: {
								arrows: false,
								centerMode: true,
								centerPadding: '0px',
								slidesToShow: 1
							}
						},
						{
							breakpoint: 767,
							settings: {
								arrows: false,
								centerMode: true,
								centerPadding: '0px',
								slidesToShow: 1
							}
						},
						{
							breakpoint: 648,
							settings: {
								arrows: false,
								centerMode: true,
								centerPadding: '0px',
								slidesToShow: 1
							}
						}
						]
					});
			});
		</script>

		<?php
	}


}