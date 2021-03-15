<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Hero_One extends Widget_Base {

	public function get_name() {
		return 'hero_1';
	}

	public function get_title() {
		return 'Hero Banner One'; // title to show on xooapp
	}

	public function get_icon() {
		return 'eicon-slider-3d';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
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
			'banner_title',
			[
				'label' => esc_html__( 'Title', 'xooapp' ),
				// 'type' => Controls_Manager::TEXT,
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Your Secure Bitcoin Storage',
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_desc',
			[
				'label' => esc_html__( 'Description', 'xooapp' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '
				Semper lacus cursus porta, feugiat primis luctus ultrice tellus potenti neque dolor primis magna congue nullam in tempor sapien, eget orci gravida justo									
				<div class="hero-stores-badge">
				<a href="#" class="store">
				<img class="appstore-white" src="'.get_template_directory_uri().'/assets/images/store_badges/appstore-tra-white.png" width="155" height="50" alt="appstore-logo">
				</a>
				<a href="#" class="store">
				<img class="googleplay-white" src="'.get_template_directory_uri().'/assets/images/store_badges/googleplay-tra-white.png" width="164" height="50" alt="googleplay-logo">
				</a>
				<span class="os-version">* Requires iOS 7.0 or higher</span>
				</div>
				',
				'label_block' => true,
			]
		);
		

	

		$this->add_responsive_control(
			'banner_bg_img',
			[
				'label' => __( 'Select Image', 'xooapp' ),
				'type' => Controls_Manager::MEDIA,
				'description' => 'Select Image',
				'default' => [
					'url' => get_template_directory_uri(). '/assets/images/hero-1-img.png',
				],
			]
		);


		$this->end_controls_section();
		//End  of a control box
		

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'xooapp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_styling',
			[
				'label' => __( 'Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '#1d07f4',
				'selectors' => [
					'{{WRAPPER}} .hero-txt h2' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .hero-txt h2',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);


		$this->end_controls_section();

	}
//end of control box 

	protected function render() {				//to show on the fontend 
		$settings = $this->get_settings_for_display();
		$banner_bg_img = $settings['banner_bg_img']['url'];
		$this->add_inline_editing_attributes( 'banner_title' );
		$this->add_render_attribute( 'banner_title', 'class', 'h2-lg' );

		$editor_content = $this->get_settings_for_display( 'banner_desc' );
		$editor_content = $this->parse_text_editor( $editor_content );
		$this->add_inline_editing_attributes( 'banner_desc' );
		$this->add_render_attribute( 'banner_desc', 'class', 'p-lg' );


		?>
			<!-- HERO-1
				============================================= -->	
				<div id="hero-1" class="bg-fixed hero-section division">
					<div class="container">	
						<div class="row">

							<!-- HERO TEXT -->
							<div class="col-md-7 col-lg-6">
								<div class="hero-txt white-color">	

									<!-- Title -->
									<h2 <?php echo $this->get_render_attribute_string( 'banner_title' )  ?>>
										<?php echo $settings['banner_title'] ?>
									</h2>

									<!-- Text -->
									<div <?php echo $this->get_render_attribute_string( 'banner_desc' )  ?>>
										<?php echo $editor_content; ?>
									</div>

								</div>	 <!-- End row -->   
							</div>	 <!-- End container --> 

							<!-- HERO IMAGE -->
							<div class="col-md-5 col-lg-5 offset-lg-1">	
								<div class="hero-img">				
									<img class="img-fluid" src="<?php echo esc_url($banner_bg_img) ?>" alt="hero-image">
								</div>
							</div>


						</div>	   <!-- End row --> 
					</div>      <!-- End container --> 
				</div>	<!-- END HERO-1 -->	

				<?php 
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
				var title = settings.banner_title;
				var desc = settings.banner_desc;
				var side_img = settings.banner_bg_img.url;
				#>
	
			<div id="hero-1" class="bg-fixed hero-section division">
				<div class="container">	
					<div class="row">

						<div class="col-md-7 col-lg-6">
							<div class="hero-txt white-color">	

								<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>
									{{{ title }}}
								</h2>

							
								<div {{{ view.getRenderAttributeString( 'desc' ) }}}>
									{{{ desc }}}
								</div>

							</div>	
						</div>	

					
						<div class="col-md-5 col-lg-5 offset-lg-1">	
							<div class="hero-img">				
								<img class="img-fluid" src="{{{ side_img }}}" alt="hero-image">
							</div>
						</div>


					</div>	  
				</div>     
			</div>
			<?php
		}


	}

