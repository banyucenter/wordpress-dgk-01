<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
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

class Xooapp_Contact_Form7 extends Widget_Base {

	public function get_name() {
		return 'xooapp_contact_form7';
	}

	public function get_title() {
		return 'Xooapp Contact Form 7'; // title to show on xooapp
	}

	public function get_icon() {
		return 'eicon-site-email-field';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
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
			'banner_bg_img',
			[
				'label' => esc_html__( 'Upload Logo', 'xooapp' ),
				// 'type' => Controls_Manager::TEXT,
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri(). '/assets/images/logo.png',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'logo_text',
			[
				'label' => esc_html__( 'Logo Text', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_desc',
			[
				'label' => esc_html__( 'Description', 'xooapp' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '',
				'label_block' => true,
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);
		

		$this->end_controls_section();
		//End  of a control box

		$this->start_controls_section(
			'section_social_style',
			[
				'label' => __( 'Logo Style', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

		$logo_spacing = 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};';

		$this->add_responsive_control(
			'logo_spacing',
			[
				'label' => __( 'Spacing', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-logo-img' => $logo_spacing,
				],
			]
		);

		$logo_size = 'width: {{SIZE}}{{UNIT}}; height: auto;';

		$this->add_responsive_control(
			'logo_size',
			[
				'label' => __( 'Logo Size', 'xooapp' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xooapp-logo-img' => $logo_size,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'fields_options' => [
					
					'font_family' => [
						'default' => 'Roboto',
					],

				],
				'selector' => '{{WRAPPER}} .xooapp-logo-desc',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);


		$this->end_controls_section();
	}
//end of control box 

	protected function render() {				//to show on the fontend 
		$settings = $this->get_settings_for_display();
		$banner_bg_img = $settings['banner_bg_img']['url'];
		$this->add_inline_editing_attributes( 'banner_desc' );
		$this->add_inline_editing_attributes( 'logo_text' );

		$editor_content = $this->get_settings_for_display( 'banner_desc' );
		$editor_content = $this->parse_text_editor( $editor_content );
		$this->add_inline_editing_attributes( 'banner_desc' );
		$this->add_render_attribute( 'banner_desc', 'class', 'p-lg' );


		?>
		<div class="xooapp-logo-info p-right-30">

			<div class="hero-app-logo">
				<div class="d-flex align-items-center">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="xooapp-logo-img" src="<?php echo esc_url( $banner_bg_img ) ?>" alt="footer-logo"></a>
					<?php if(!empty($settings['logo_text'])) { ?>
						<span><?php echo esc_html($settings['logo_text']); ?></span>
					<?php } ?>
				</div>
			</div>
			<?php if(!empty($settings['banner_desc'])) { ?>
			<!-- Text -->
			<div class="xooapp-logo-desc">
				<?php echo wpautop( $editor_content ) ?>
			</div>
			<?php } ?>
		</div>

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
				var desc = settings.banner_desc;
				var side_img = settings.banner_bg_img.url;

				view.addInlineEditingAttributes( 'desc' );
				view.addInlineEditingAttributes( 'settings.logo_text' );

				#>
				<div class="xooapp-logo-info p-right-30 m-bottom-40">

					<div class="hero-app-logo">
						<div class="d-flex align-items-center">
							<img class="xooapp-logo-img" src="{{{ side_img }}}" alt="footer-logo">
							<# if(settings.logo_text != '') { #>
							<span>{{{settings.logo_text}}}</span>
							<# } #>
						</div>
					</div>
					<!-- Text -->
					<div class="xooapp-logo-desc">
						{{{ desc }}}
					</div>
				</div>
				
				<?php
			}


		}

