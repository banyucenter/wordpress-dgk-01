<?php
namespace Xooapp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * App Slider 
 *
 * Elementor app slider
 *
 * @since 1.0.0
 */
class App_slider extends Widget_Base
{

    public function get_name()
    {
        return 'app-screenshot-carousel';
    }

    public function get_title()
    {
        return __('App Image Slider', 'xooapp');
    }

    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    public function get_categories()
    {
        return ['xooapp-master-elements'];
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
        return [ 'image', 'photo', 'visual', 'carousel', 'slider' ];
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'slick' ];
    }

    /**
     * Register image carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_app_carousel',
            [
                'label' => __( 'Image Carousel', 'xooapp' ),
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label' => __( 'Add Images', 'xooapp' ),
                'type' => Controls_Manager::GALLERY,
                
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'separator' => 'none',
            ]
        );

        $slides_to_show = range( 1, 10 );
        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' => __( 'Slides to Show', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default', 'xooapp' ),
                ] + $slides_to_show,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => __( 'Slides to Scroll', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'description' => __( 'Set how many slides are scrolled per swipe.', 'xooapp' ),
                'default' => '2',
                'options' => $slides_to_show,
                'condition' => [
                    'slides_to_show!' => '1',
                ],
                'frontend_available' => true,
            ]
        );


        $this->add_control(
            'frame_select',
            [
                'label' => __( 'Frame Select', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ltr',
                'options' => [
                    '' => __( 'Default', 'xooapp' ),
                    'yes' => __( 'Yes', 'xooapp' ),
                ],
            ]
        );


        $this->add_control(
            'frame_image',
            [
                'label' => __( 'Frame Image', 'xooapp' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url'   => get_template_directory_uri() . '/assets/images/iphone.png',
                ],
                'condition' => [
                    'frame_select' => 'yes',
                ],
            ]
        );




        $this->add_control(
            'image_stretch',
            [
                'label' => __( 'Image Stretch', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'no' => __( 'No', 'xooapp' ),
                    'yes' => __( 'Yes', 'xooapp' ),
                ],
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'both' => __( 'Arrows and Dots', 'xooapp' ),
                    'arrows' => __( 'Arrows', 'xooapp' ),
                    'dots' => __( 'Dots', 'xooapp' ),
                    'none' => __( 'None', 'xooapp' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'link_to',
            [
                'label' => __( 'Link to', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'xooapp' ),
                    'file' => __( 'Media File', 'xooapp' ),
                    'custom' => __( 'Custom URL', 'xooapp' ),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link to', 'xooapp' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'xooapp' ),
                'condition' => [
                    'link_to' => 'custom',
                ],
                'show_label' => false,
            ]
        );

        $this->add_control(
            'open_lightbox',
            [
                'label' => __( 'Lightbox', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'xooapp' ),
                    'yes' => __( 'Yes', 'xooapp' ),
                    'no' => __( 'No', 'xooapp' ),
                ],
                'condition' => [
                    'link_to' => 'file',
                ],
            ]
        );

        $this->add_control(
            'caption_type',
            [
                'label' => __( 'Caption', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'None', 'xooapp' ),
                    'title' => __( 'Title', 'xooapp' ),
                    'caption' => __( 'Caption', 'xooapp' ),
                    'description' => __( 'Description', 'xooapp' ),
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

        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => __( 'Additional Options', 'xooapp' ),
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __( 'Pause on Hover', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'xooapp' ),
                    'no' => __( 'No', 'xooapp' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'xooapp' ),
                    'no' => __( 'No', 'xooapp' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'xooapp' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __( 'Infinite Loop', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'xooapp' ),
                    'no' => __( 'No', 'xooapp' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'effect',
            [
                'label' => __( 'Effect', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __( 'Slide', 'xooapp' ),
                    'fade' => __( 'Fade', 'xooapp' ),
                ],
                'condition' => [
                    'slides_to_show' => '1',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Animation Speed', 'xooapp' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __( 'Direction', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ltr',
                'options' => [
                    'ltr' => __( 'Left', 'xooapp' ),
                    'rtl' => __( 'Right', 'xooapp' ),
                ],
                'frontend_available' => true,
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => __( 'Navigation', 'xooapp' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => [ 'arrows', 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'heading_style_arrows',
            [
                'label' => __( 'Arrows', 'xooapp' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => __( 'Position', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inside',
                'options' => [
                    'inside' => __( 'Inside', 'xooapp' ),
                    'outside' => __( 'Outside', 'xooapp' ),
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'arrows_size',
            [
                'label' => __( 'Size', 'xooapp' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '.elementor-widget-app-image-carousel .slick-slider .slick-prev:before, .elementor-widget-app-image-carousel .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => __( 'Color', 'xooapp' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.elementor-widget-app-image-carousel .slick-slider .slick-prev:before, .elementor-widget-app-image-carousel .slick-slider .slick-next:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'heading_style_dots',
            [
                'label' => __( 'Dots', 'xooapp' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label' => __( 'Position', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'outside',
                'options' => [
                    'outside' => __( 'Outside', 'xooapp' ),
                    'inside' => __( 'Inside', 'xooapp' ),
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => __( 'Size', 'xooapp' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '.elementor-widget-app-image-carousel .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __( 'Color', 'xooapp' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.elementor-widget-app-image-carousel .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => __( 'Image', 'xooapp' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_spacing',
            [
                'label' => __( 'Spacing', 'xooapp' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default', 'xooapp' ),
                    'custom' => __( 'Custom', 'xooapp' ),
                ],
                'default' => '',
                'condition' => [
                    'slides_to_show!' => '1',
                ],
            ]
        );

        $this->add_control(
            'image_spacing_custom',
            [
                'label' => __( 'Image Spacing', 'xooapp' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'show_label' => false,
                'selectors' => [
                    '.slick-list' => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '.slick-slide .slick-slide-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'image_spacing' => 'custom',
                    'slides_to_show!' => '1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '.elementor-app-image-carousel .slick-slide-image',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'xooapp' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '.elementor-app-image-carousel .slick-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_caption',
            [
                'label' => __( 'Caption', 'xooapp' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'caption_type!' => '',
                ],
            ]
        );

        $this->add_control(
            'caption_align',
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
                'default' => 'center',
                'selectors' => [
                    '.elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'caption_text_color',
            [
                'label' => __( 'Text Color', 'xooapp' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.elementor-image-carousel-caption' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'caption_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '.elementor-image-carousel-caption',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render image carousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();


        if ( empty( $settings['carousel'] ) ) {
            return;
        }

        $slides = [];

        foreach ( $settings['carousel'] as $index => $attachment ) {


            $image_url = Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'thumbnail', $settings );
            

            $image_html = '<img class="slick-slide-image" src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $attachment ) ) . '" />';

            $link = $this->get_link_url( $attachment, $settings );

            if ( $link ) {
                $link_key = 'link_' . $index;

                $this->add_render_attribute( $link_key, [
                    'href' => $link['url'],
                    'data-elementor-open-lightbox' => $settings['open_lightbox'],
                    'data-elementor-lightbox-slideshow' => $this->get_id(),
                    'data-elementor-lightbox-index' => $index,
                ] );

                if ( Plugin::$instance->editor->is_edit_mode() ) {
                    $this->add_render_attribute( $link_key, [
                        'class' => 'elementor-clickable',
                    ] );
                }

                if ( ! empty( $link['is_external'] ) ) {
                    $this->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( ! empty( $link['nofollow'] ) ) {
                    $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }

                $image_html = '<a ' . $this->get_render_attribute_string( $link_key ) . '>' . $image_html . '</a>';
            }

            $image_caption = $this->get_image_caption( $attachment );

            $slide_html = '<div class="carousel-item"><figure class="slick-slide-inner">' . $image_html;

            if ( ! empty( $image_caption ) ) {
                $slide_html .= '<figcaption class="elementor-image-carousel-caption">' . $image_caption . '</figcaption>';
            }

            $slide_html .= '</figure></div>';

            $slides[] = $slide_html;

        }

        if ( empty( $slides ) ) {
            return;
        }

        $this->add_render_attribute( 'carousel', 'class', [ 'screens-carousel' ] );

        if ( 'none' !== $settings['navigation'] ) {
            if ( 'dots' !== $settings['navigation'] ) {
                $this->add_render_attribute( 'carousel', 'class', 'slick-arrows-' . $settings['arrows_position'] );
            }

            if ( 'arrows' !== $settings['navigation'] ) {
                $this->add_render_attribute( 'carousel', 'class', 'slick-dots-' . $settings['dots_position'] );
            }
        }

        if ( 'yes' === $settings['image_stretch'] ) {
            $this->add_render_attribute( 'carousel', 'class', 'slick-image-stretch' );
        }
        $frame = $settings['frame_select'];
        ?>
        <div class="screenshots-wrap">
            <div class="app-slide <?php echo ($frame == 'yes' ) ? '' : 'screens-2'; ?> screens-section" dir="<?php echo $settings['direction']; ?>">
                <div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
                    <?php echo implode( '', $slides ); ?>
                </div>

                <?php 
                if($frame == 'yes') { ?>
                    <div class="iphone-frame">
                        <img src="<?php echo esc_url( $settings['frame_image']['url'] ) ?>" alt="iphone-image">            
                    </div>
                <?php } ?>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                var slk = jQuery('.screens-carousel');
                slk.slick({
                    infinite: true,
                    autoplay: true,
                    centerMode: true,
                    dots: true,
                    autoplaySpeed: 3500,
                    speed: 1000,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    variableWidth: true,
                    responsive: [
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            dots: false,
                            slidesToShow: 1,
                            variableWidth: false,
                            fade: true,
                            cssEase: 'linear'
                        }
                    }
                    ]
                });  
            });  
        </script>

        <?php
    }

    /**
     * Retrieve image carousel link URL.
     *
     * @since 1.0.0
     * @access private
     *
     * @param array $attachment
     * @param object $instance
     *
     * @return array|string|false An array/string containing the attachment URL, or false if no link.
     */
    private function get_link_url( $attachment, $instance ) {
        if ( 'none' === $instance['link_to'] ) {
            return false;
        }

        if ( 'custom' === $instance['link_to'] ) {
            if ( empty( $instance['link']['url'] ) ) {
                return false;
            }

            return $instance['link'];
        }

        return [
            'url' => wp_get_attachment_url( $attachment['id'] ),
        ];
    }

    /**
     * Retrieve image carousel caption.
     *
     * @since 1.2.0
     * @access private
     *
     * @param array $attachment
     *
     * @return string The caption of the image.
     */
    private function get_image_caption( $attachment ) {
        $caption_type = $this->get_settings_for_display( 'caption_type' );

        if ( empty( $caption_type ) ) {
            return '';
        }

        $attachment_post = get_post( $attachment['id'] );

        if ( 'caption' === $caption_type ) {
            return $attachment_post->post_excerpt;
        }

        if ( 'title' === $caption_type ) {
            return $attachment_post->post_title;
        }

        return $attachment_post->post_content;
    }


}