<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

class Xooapp_Header extends Widget_Base {

	public function get_name() {
		return 'xooapp_header';
	}

	public function get_title() {
		return 'Xooapp Header'; // title to show on xooapp
	}

	public function get_icon() {
		return 'eicon-heading';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
	}

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
		return [ 'header', 'nav', 'onepage nav' ];
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/

	protected function _register_controls() {
		
		//start of a control box
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Settings', 'xooapp' ),   //section name for controler view
			]
		);

		$this->add_control(
			'anchor_description',
			[
				'raw' => __( '<b>Note - This is fixed header but, in elementor editing panel, its static for better customization. To see actual view please check live site.</b>', 'xooapp' ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);


		$this->add_control(
			'banner_bg_img',
			[
				'label' => esc_html__( 'Upload Logo', 'xooapp' ),
				// 'type' => Controls_Manager::TEXT,
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri(). '/assets/images/logo-white.png',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_bg_img2',
			[
				'label' => esc_html__( 'Upload Logo - Slide Down Logo', 'xooapp' ),
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

		
		$this->end_controls_section();
		


		$this->start_controls_section(
			'section_onepage',
			[
				'label' => esc_html__( 'One Page Nav Settings', 'xooapp' ),   //section name for controler view
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'nav',
			[
				'label' => __( 'Name', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Home',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'xooapp' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com or #menuname for smooth scroll', 'xooapp' ),
			]
		);

		$repeater->add_control(
			'priority',
			[
				'label' => __( 'Priority Sign', 'xooapp' ),
				'type' => Controls_Manager::SWITCHER,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'show_dropdown',
			[
				'label' => __( 'Drop Down', 'xooapp' ),
				'type' => Controls_Manager::SWITCHER,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'sub_nav',
			[
				'label' => __( 'Sub Menu - Add One sub menu in one line', 'xooapp' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => '',
				'condition' => [
					'show_dropdown' => 'yes',
				],

			]
		);

		
		$this->add_control(
			'nav_item_lists',
			[
				'label' => __( 'Nav Menu', 'xooapp' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'nav' => 'About',
						'link'	=> '#about',
					],
					[
						'nav' => 'Screens',
						'link'	=> '#screen',
					],
					[
						'nav' => 'Our Team',
						'link'	=> '#our_team',
					],
					[
						'nav' => 'Features',
						'link'	=> '#features',
					],
					[
						'nav' => 'Blog',
						'link'	=> '#blog',
					],
				],
				
			]
		);

		$this->end_controls_section();
		//End  of a control box
		
		$this->start_controls_section(
			'section_social_or_button',
			[
				'label' => esc_html__( 'Social/Button', 'xooapp' ),   //section name for controler view
			]
		);

		$this->add_control(
			'social_button',
			[
				'label' => __( 'Social / Button', 'xooapp' ),
				'type' => Controls_Manager::SWITCHER,
				'label_block' => true,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social',
			[
				'label' => __( 'Name With Icon', 'xooapp' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-wordpress',
				'include' => [
					'fa fa-android',
					'fa fa-apple',
					'fa fa-behance',
					'fa fa-bitbucket',
					'fa fa-codepen',
					'fa fa-delicious',
					'fa fa-digg',
					'fa fa-dribbble',
					'fa fa-envelope',
					'fa fa-facebook',
					'fa fa-flickr',
					'fa fa-foursquare',
					'fa fa-github',
					'fa fa-google-plus',
					'fa fa-houzz',
					'fa fa-instagram',
					'fa fa-jsfiddle',
					'fa fa-linkedin',
					'fa fa-medium',
					'fa fa-meetup',
					'fa fa-mixcloud',
					'fa fa-odnoklassniki',
					'fa fa-pinterest',
					'fa fa-product-hunt',
					'fa fa-reddit',
					'fa fa-rss',
					'fa fa-shopping-cart',
					'fa fa-skype',
					'fa fa-slideshare',
					'fa fa-snapchat',
					'fa fa-soundcloud',
					'fa fa-spotify',
					'fa fa-stack-overflow',
					'fa fa-steam',
					'fa fa-stumbleupon',
					'fa fa-telegram',
					'fa fa-thumb-tack',
					'fa fa-tripadvisor',
					'fa fa-tumblr',
					'fa fa-twitch',
					'fa fa-twitter',
					'fa fa-vimeo',
					'fa fa-vk',
					'fa fa-weibo',
					'fa fa-weixin',
					'fa fa-whatsapp',
					'fa fa-wordpress',
					'fa fa-xing',
					'fa fa-yelp',
					'fa fa-youtube',
					'fa fa-500px',
				],
			]
		);

		$repeater->add_control(
			'social_link',
			[
				'label' => __( 'Link', 'xooapp' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com or #menuname for smooth scroll', 'xooapp' ),
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label' => __( 'Social Icons', 'xooapp' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'condition' => [
					'social_button' => 'yes',
				],
				'default' => [
					[
						'social' => 'fa fa-facebook',
					],
					[
						'social' => 'fa fa-twitter',
					],
					[
						'social' => 'fa fa-dribbble',
					],
				],
				'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
			]
		);


		$this->add_control(
			'action_name',
			[
				'label' => esc_html__( 'Button Name', 'xooapp' ),
				// 'type' => Controls_Manager::TEXT,
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'social_button!' => 'yes',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'app_img',
			[
				'label' => esc_html__( 'Upload Image', 'xooapp' ),
				// 'type' => Controls_Manager::TEXT,
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri(). '/assets/images/appstore-1.png',
				],
				'condition' => [
					'social_button!' => 'yes',
					'action_name' => '',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'xooapp' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'social_button!' => 'yes',
					'action_name' => '',
				],
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com or #menuname for smooth scroll', 'xooapp' ),
			]
		);


		$this->end_controls_section();
		//End  of a control box

		/*===========================================
		=            style comment block            =
		===========================================*/

		$this->start_controls_section(
			'section_nav_style',
			[
				'label' => __( 'Header Settings', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);



		

		$logo_spacing = 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};';

		$this->add_responsive_control(
			'logo_spacing',
			[
				'label' => __( 'Logo Spacing', 'xooapp' ),
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
					'{{WRAPPER}} .xooapp-logo-img, {{WRAPPER}} .xooapp-logo-img img' => $logo_size,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Menu List', 'xooapp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_color',
			[
				'label' => __( 'Text Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #navbarSupportedContent ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_scrolled_color',
			[
				'label' => __( 'After Scroll Text Color', 'xooapp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scroll #navbarSupportedContent ul li a' => 'color: {{VALUE}};',
				],
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
				'selector' => '{{WRAPPER}} #navbarSupportedContent ul li a',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);


		$this->end_controls_section();
	}
//end of control box 

	protected function render() {				//to show on the fontend 
		$settings = $this->get_settings_for_display();
		$banner_bg_img = $settings['banner_bg_img']['url'];
		$banner_bg_img2 = $settings['banner_bg_img2']['url'];
		$app_img = $settings['app_img']['url'];
		$this->add_inline_editing_attributes( 'banner_desc' );
		$this->add_inline_editing_attributes( 'logo_text' );
		?>

			<!-- HEADER
				============================================= -->
				<header class="header">
					<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-tra">
						<div class="container">


							<!-- LOGO IMAGE -->
							<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 260 x 60 pixels) -->
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="xooapp-logo-img navbar-brand logo-white"><img src="<?php echo esc_url( $banner_bg_img ) ?>" width="130" height="30" alt="<?php $settings['logo_text'] ?>"></a>
							
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="xooapp-logo-img navbar-brand logo-black"><img src="<?php echo esc_url( $banner_bg_img2 ) ?>" width="130" height="30" alt="<?php $settings['logo_text'] ?>"></a>


							<!-- Responsive Menu Button -->
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>


							<!-- Navigation Menu -->
							<div id="navbarSupportedContent" class="collapse navbar-collapse">
								<ul class="navbar-nav ml-auto">

									<?php
									foreach ( $settings['nav_item_lists'] as $index => $item ) { 
										if($item['show_dropdown']) {
											$menu_list = $item['sub_nav'];
											?>
											<!-- Dropdown Link -->
											<li class="nav-item nl-simple dropdown">
												<a class="nav-link dropdown-toggle" href="#null" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<?php echo $item['nav'] ?>
													<?php if($item['priority']) { ?>
														<span></span>
													<?php } ?>
												</a>
												<div class="dropdown-menu" aria-labelledby="navbarDropdown">
													<?php 
													$arr = explode("\n", trim($menu_list));
													for ($i = 0; $i < count($arr); $i++) {
														$line = $arr[$i];
														$with_underslas = str_replace(' ', '_', $line);
														$with_underslas = strtolower($with_underslas);
														if($line!=htmlspecialchars($line)) {
															$line = $line;
														} else {
															$line = '<a class="dropdown-item" href="#'. esc_attr( $with_underslas ). '">' . esc_html( $line ). '</a>';
														}
														echo html_entity_decode( $line );
														?>
														<?php 
													} ?>
													
												</div>
											</li>
										<?php } else { ?>
											<li class="nav-item nl-simple"><a class="nav-link" href="<?php echo $item['link'] ?>"><?php echo $item['nav'] ?><?php if($item['priority']) { ?>
												<span></span>
												<?php } ?></a></li>
											<?php } ?>

										<?php } ?>

										<?php if( !empty( $settings['social_button'] )) { ?>
											<!-- Header Social Icons -->															
											<li class="header-socials clearfix">
												<?php foreach ( $settings['social_icon_list'] as $index => $item ) {
													$social = str_replace( 'fa fa-', '', $item['social'] );

													$link_key = 'link_' . $index;

													$this->add_render_attribute( $link_key, 'href', $item['social_link']['url'] );

													if ( $item['social_link']['is_external'] ) {
														$this->add_render_attribute( $link_key, 'target', '_blank' );
													}

													if ( $item['social_link']['nofollow'] ) {
														$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
													}

													$icon_class = $item['social'];
													$social_class = str_replace('fa fa-', '', $icon_class);
													?>
													<span><a <?php echo $this->get_render_attribute_string( $link_key ); ?> class="ico-<?php echo esc_attr( strtolower($social_class) ) ?>"><i class="<?php echo esc_attr( $item['social'] ) ?>"></i></a></span>
												<?php } ?>

											</li>
										<?php } else { 
											$this->add_render_attribute( 'url', 'href', $settings['button_link']['url'] );

											if ( $settings['button_link']['is_external'] ) {
												$this->add_render_attribute( 'url', 'target', '_blank' );
											}

											if ( ! empty( $settings['button_link']['nofollow'] ) ) {
												$this->add_render_attribute( 'url', 'rel', 'nofollow' );
											}

											?>
											<li class="nav-item app_img">
												<?php if(!empty( $settings['action_name'] ) ) { ?>
													<a <?php echo $this->get_render_attribute_string( 'url' ); ?> class="header-store">
														<span><?php echo $settings['action_name']; ?></span>
													</a>
												<?php } else { 
													if(!empty( $app_img )) { ?>
														<a <?php echo $this->get_render_attribute_string( 'url' ); ?> class="header-store">
															<img class="appstore-button" src="<?php echo esc_url( $app_img ); ?>" width="141" height="44" alt="<?php esc_attr_e('appstore-logo', 'xooapp'); ?>">
														</a>
														<?php 
													}
												} ?>

											</li>
										<?php } ?>
									</ul>
								</div>	<!-- End Navigation Menu -->


							</div>	  <!-- End container -->
						</nav>	   <!-- End navbar  -->
					</header>	<!-- END HEADER -->


					<?php 
				}





			}

