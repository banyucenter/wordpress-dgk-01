<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Xooapp_Video_Content extends Widget_Base {

	public function get_name() {
		return 'xooapp_video_content';
	}

	public function get_title() {
		return 'Video Content'; // title to show on xooapp
	}

	public function get_icon() {
		return 'eicon-play';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
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
				'default' => 'Modern, Powerful and Creative',
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_desc',
			[
				'label' => esc_html__( 'Description', 'xooapp' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '
				<p>Gravida donec integer ipsum porta justo at velna vitae auctor integer magna at risus auctor purus rutrum primis ultrice ligula luctus impedit magna dolor vitae risus auctor purus pretium</p>

				<p>Donec enim ipsum porta justo integer at velna vitae auctor integer congue magna at risus auctor purus unt pretium ligula rutrum sapien ultrice eros dolor luctus odio placerat massa magna cursus</p>
				',
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_button_text',
			[
				'label' => esc_html__( 'Button Text', 'xooapp' ),
				// 'type' => Controls_Manager::TEXT,
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Discover More',
				'label_block' => true,
			]
		);


		$this->add_control(
			'banner_button_link',
			[
				'label' => esc_html__( 'Link', 'xooapp' ),
				// 'type' => Controls_Manager::TEXT,
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '#',
				'label_block' => true,
			]
		);
		

		$this->add_responsive_control(
			'video_link',
			[
				'label' => __( 'Select Video OR Paste Youtube Link', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'xooapp' ) . ' (YouTube)',
				'default' => 'https://www.youtube.com/watch?v=kuceVNBTJio',
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
					'url' => get_template_directory_uri(). '/assets/images/video-3-img.png',
				],
			]
		);


		$this->add_control(
			'section_padding',
			[
				'label' => __( 'Section Padding', 'xooapp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .video-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
		//End  of a control box

	}
//end of control box 

	protected function render() {				//to show on the fontend 
		$settings = $this->get_settings_for_display();
		$banner_bg_img = $settings['banner_bg_img']['url'];
		$video_link = $settings['video_link'];
		$this->add_inline_editing_attributes( 'banner_title' );
		$this->add_render_attribute( 'banner_title', 'class', 'h4-xl' );

		$editor_content = $this->get_settings_for_display( 'banner_desc' );
		$editor_content = $this->parse_text_editor( $editor_content );
		$this->add_inline_editing_attributes( 'banner_desc' );

		?>
		<div class="xooapp-block">
			<div class="video-inner-bg">
				<div class="col-xl-10 offset-xl-1">		 				
					<div class="video-content">
						<div class="row d-flex align-items-center">

							<?php if(!empty( $settings['banner_desc'] ) && !empty($settings['banner_title'])) { ?>
								<!-- VIDEO TEXT -->
								<div class="col-md-7">
									<div class="video-txt p-right-30">
										<!-- Title -->	
										<h4 <?php echo $this->get_render_attribute_string( 'banner_title' )  ?>><?php echo esc_html( $settings['banner_title'] ) ?></h4>

										<?php echo wpautop( $editor_content ); ?>
										<!-- Button -->
										<a href="<?php echo esc_url( $settings['banner_button_link'] ) ?>" class="btn btn-lightgreen"><?php echo esc_html( $settings['banner_button_text'] ) ?></a>

									</div>
								</div>	<!-- END VIDEO TEXT -->
							<?php } ?>
							


							<?php if(!empty( $settings['banner_desc'] ) && !empty($settings['banner_title'])) { ?>
								<!-- VIDEO PREVIEW -->
								<div class="col-md-5">

								<?php } ?>



								<div class="video-preview text-center">

									<a class="video-popup" href="<?php echo esc_url($video_link) ?>">

										<!-- Play Icon -->
										<div class="video-block-wrapper"><div class="play-icon-green"></div></div>

										<!-- Preview Image -->
										<img class="img-fluid" src="<?php echo esc_url($banner_bg_img) ?>" alt="video-preview">

									</a>


								</div>

								<?php if(!empty( $settings['banner_desc'] ) && !empty($settings['banner_title'])) { ?>

								</div>	<!-- END VIDEO PREVIEW -->

							<?php } ?>


						</div>	<!-- End row -->
					</div>	<!-- End video-content -->
				</div>	 <!-- END CONTENT TEXT -->
			</div>	  <!-- End Inner Background -->
		</div>	   <!-- End row -->	

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
				var banner_title = settings.banner_title;
				var banner_desc = settings.banner_desc;
				var banner_button_link = settings.banner_button_link;
				var banner_button_text = settings.banner_button_text;

				var banner_bg_img = settings.banner_bg_img.url;
				var video_link = settings.video_link;
				#>
				<div class="xooapp-block">
					<div class="video-inner-bg">
						<div class="col-xl-10 offset-xl-1">		 				
							<div class="video-content">
								<div class="row d-flex align-items-center">

									<# if( banner_title && banner_desc ) { #>
									<!-- VIDEO TEXT -->
									<div class="col-md-7">
										<div class="video-txt p-right-30">


											<!-- Title -->	
											<h4 class="h4-xl">{{{ banner_title }}}</h4>

											{{{ banner_desc }}}

											<!-- Button -->
											<a href="{{ banner_button_link }}" class="btn btn-lightgreen">{{{ banner_button_text }}}</a>


										</div>
									</div>	<!-- END VIDEO TEXT -->

									<# } #>

									<# if( banner_title && banner_desc ) { #>
									<!-- VIDEO PREVIEW -->
									<div class="col-md-5">
										<# } #>

										<div class="video-preview text-center">

											<!-- Change the link HERE!!! -->
											<a class="video-popup" href="{{ video_link }}">

												<!-- Play Icon -->
												<div class="video-block-wrapper"><div class="play-icon-green"></div></div>

												<!-- Preview Image -->
												<img class="img-fluid" src="{{ banner_bg_img }}" alt="video-preview">

											</a>

										</div>

										<# if( banner_title && banner_desc ) { #>
									</div>	<!-- END VIDEO PREVIEW -->
									<# } #>

								</div>	<!-- End row -->
							</div>	<!-- End video-content -->
						</div>	 <!-- END CONTENT TEXT -->
					</div>	  <!-- End Inner Background -->
				</div>	   <!-- End row -->	
				<?php
			}


		}

