<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Xooapp_Blog extends Widget_Base {

	public function get_name() {
		return 'xooapp_blog';
	}

	public function get_title() {
		return 'Blog'; // title to show on xooapp
	}

	public function get_icon() {
		return 'eicon-post-content';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
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
		
		$terms = get_terms( array(
			'taxonomy' => 'category',
			'hide_empty' => false,
		) );
		$cat_names = array();
		foreach( $terms as $t ):
			$cat_names[$t->term_id] = $t->name;
		endforeach;

		
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Layout', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cat_name',
			[
				'label'       => __( 'From Category', 'xooapp' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'uncategorized',
				'options' => $cat_names,
			]
		);


		$this->add_control(
			'show_post',
			[
				'label'       => __( 'Number Of Post Show', 'xooapp' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
			]
		);


		$this->add_control(
			'word_show_post',
			[
				'label'       => __( 'Word Show', 'xooapp' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 145,
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#404040',
				'selectors' => [
					'{{WRAPPER}} .entry-title, .entry-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .entry-title, .entry-title a',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Title Spacing', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .entry-title, .entry-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__( 'Title & Meta Hover Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666',
				'selectors' => [
					'{{WRAPPER}} .entry-meta, .entry-meta span, .entry-meta a'  => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .blog-post-txt',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label' => esc_html__( 'Content Spacing', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-post-txt p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Content Color', 'xooapp' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#444',
				'selectors' => [
					'{{WRAPPER}} .blog-post-txt p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'meta_style',
			[
				'label' => esc_html__( 'More Details', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'read_more_text',
			[
				'label' => esc_html__( 'Button Text', 'xooapp' ),
				'type'  => Controls_Manager::TEXT,
				'default'   => esc_html__( 'More Details', 'xooapp' ),
			]
		);

		$this->start_controls_tabs( 'read_more_button_style' );

		$this->start_controls_tab(
			'read_more_button_normal',
			[
				'label'     => esc_html__( 'Normal', 'xooapp' ),
				'condition' => [
					'choose_meta_option' => 'button',
				],
			]
		);

		$this->add_control(
			'read_more_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'xooapp' ),
				'type'  => Controls_Manager::COLOR,
				'default'   => '#444',
				'selectors' => [
					'{{WRAPPER}} .more-detail' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'read_more_background_color',
			[
				'label' => esc_html__( 'Background Color', 'xooapp' ),
				'type'  => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .more-detail' => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'  => 'read_more_border',
				'label' => esc_html__( 'Border', 'xooapp' ),
				'placeholder' => '1px',
				'default'   => '1px',
				'selector'  => '{{WRAPPER}} .more-detail',
				'separator' => 'before',

			]
		);


		$this->add_control(
			'read_more_text_padding',
			[
				'label' => esc_html__( 'Text Padding', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .more-detail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);


		$this->add_control(
			'read_more_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'xooapp' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .more-detail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'choose_meta_option' => 'button',
				],
			]
		);


		$this->end_controls_tab();




		$this->start_controls_tab(
			'read_more_button_hover',
			[
				'label'     => esc_html__( 'Hover', 'xooapp' ),
				'condition' => [
					'choose_meta_option' => 'button',
				],
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'xooapp' ),
				'type'  => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .more-detail:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'choose_meta_option' => 'button',
				],
			]
		);

		$this->add_control(
			'read_more_button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'xooapp' ),
				'type'  => Controls_Manager::COLOR,
				'default'   => '#ed485f',
				'selectors' => [
					'{{WRAPPER}} .more-detail:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'choose_meta_option' => 'button',
				],

			]
		);

		$this->add_control(
			'read_more_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'xooapp' ),
				'type'  => Controls_Manager::COLOR,
				'default'   => '#ed485f',
				'selectors' => [
					'{{WRAPPER}} .more-detail:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'choose_meta_option' => 'button',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		

		$this->end_controls_section();


		$this->end_controls_section();



	}


	protected function render() {				

		//to show on the fontend 
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'banner_title' );
		$this->add_render_attribute( 'banner_title', 'class', 'h2-lg' );
		$settings = $this->get_settings();
		$id = $this->get_id();
		?>
		<!-- BLOG POSTS HOLDER -->
		<div id="<?php echo $id;?>" class="row blog-blocks">
			<?php
			$post_formats = array('audio', 'image', 'video', 'link', 'gallery');
			$blog = array(
				'cat' => $settings['cat_name'],
				'post_type'         => 'post',
				'post_status'       => 'publish',
				'posts_per_page'    => $settings['show_post'],
				'ignore_sticky_posts' => 1,
				'tax_query' => array( array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
					'operator' => 'NOT IN'
				) 
			),
			);

			$blog_query = new \WP_Query( $blog );
			if($blog_query->have_posts()):
				while($blog_query->have_posts()): 
					$blog_query->the_post(); ?>
					<!-- ========== blog - start ========== -->
					<div class="col-md-6 col-lg-4">
						<div class="blog-block">
							<?php if( has_post_thumbnail() ) { ?>
								<div class="blog-post-img post-thumbnail">
									<a class="img-thumb dis-block" href="<?php the_permalink() ?>">

										<span class="image-block" style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?>)"></span>
										<?php //the_post_thumbnail('large'); ?>
									</a>
								</div><!-- .post-thumbnail -->
							<?php } ?>
							<div class="p-top-20"></div>
							<div class="blog-post-txt m-bottom-10">
								
								<!-- Post Title -->
								<?php the_title( '<h5 class="h5-sm entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
								<!-- Post Text -->
								<!-- Post Data -->
								<?php
								if ( 'post' === get_post_type() ) :
									?>
									<div class="entry-meta m-bottom-10">
										<?php
										if( function_exists('xooapp_posted_on') && function_exists('xooapp_posted_one_cat') && function_exists('xooapp_posted_by') ) {
											xooapp_posted_by();
											echo '<span class="m-right-10"></span>';
											xooapp_posted_on();
										}
										?>
									</div><!-- .entry-meta -->
								<?php endif; ?>
								<div class="text-except m-bottom-10"><?php $this->the_excerpt_max_charlength($settings['word_show_post']); ?></div>
								<?php
								if ( 'post' === get_post_type() ) :
									?>
									<div class="entry-meta m-bottom-10">
										<?php
										xooapp_posted_one_cat();
										?>
									</div><!-- .entry-meta -->
								<?php endif; ?>
							</div>
							<hr />
							<!-- BLOG POST META -->
							<div class="blog-post-meta text-right grey-color">
								<?php xooapp_post_comments_love_homepage(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); endif; ?>
			</div>

			<?php 
		}


		public function the_excerpt_max_charlength($charlength) {
			$excerpt = get_the_excerpt();
			$charlength++;

			if ( mb_strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					echo mb_substr( $subex, 0, $excut );
				} else {
					echo $subex;
				}
				echo '';
			} else {
				echo $excerpt;
			}
		}

	}
