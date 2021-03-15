<?php

/* Enqueue Custom Fonts Script */
function xooapp_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

  /*
   * Translators: If there are characters in your language that are not supported
   * by Montserrat, translate this to 'off'. Do not translate into your own language.
   */
  if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'xooapp' ) ) {
  	$fonts[] = 'Montserrat:300,400,500,600,700|Roboto:300,400,500,700,900';
  }

  if ( $fonts ) {
  	$fonts_url = add_query_arg( array(
  		'family' => urlencode( implode( '|', $fonts ) ),
  		'subset' => urlencode( $subsets ),
  	), 'https://fonts.googleapis.com/css' );
  }


  return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function xooapp_scripts() {

	// css include
	if ( SCRIPT_DEBUG == true || WP_DEBUG == true ) {	
		$min = '';
	} else {
		$min = '.min';
	}

	if ( SCRIPT_DEBUG == true || WP_DEBUG == true ) {	
		wp_enqueue_style( 'bootstrap', XOOAPP_CSS . 'bootstrap' . $min. '.css', '', XOOAPP_VERSION, 'all' );
		wp_enqueue_style( 'font-awesome', XOOAPP_CSS . 'font-awesome' . $min. '.css', '', XOOAPP_VERSION, 'all' );
		wp_enqueue_style( 'pe-icon-7-stroke', XOOAPP_CSS . 'pe-icon-7-stroke' . $min. '.css', '', XOOAPP_VERSION, 'all' );
		wp_enqueue_style( 'magnific-popup', XOOAPP_CSS . 'magnific-popup' . $min. '.css', '', XOOAPP_VERSION, 'all' );
		wp_enqueue_style( 'slick', XOOAPP_CSS . 'slick' . $min. '.css', '', XOOAPP_VERSION, 'all' );
		wp_enqueue_style( 'slick-theme', XOOAPP_CSS . 'slick-theme' . $min. '.css', '', XOOAPP_VERSION, 'all' );
		wp_enqueue_style( 'animate', XOOAPP_CSS . 'animate' . $min. '.css', '', XOOAPP_VERSION, 'all' );
		wp_enqueue_style( 'xooapp-main-style', XOOAPP_CSS . 'style' . $min. '.css', '', XOOAPP_VERSION, 'all' );
	} else {
		wp_enqueue_style('xooapp-styles', XOOAPP_CSS . 'plugins.min.css', '', XOOAPP_VERSION, 'all' );
	}
	wp_enqueue_style( 'xooapp-style', get_stylesheet_uri() );
	wp_enqueue_style( 'xooapp-fonts', xooapp_fonts_url(), array(), null );
	add_editor_style( array( 'assets/css/editor-style.min.css', xooapp_fonts_url() ) );



	$menu_color = get_post_meta( get_the_ID(), '_custom_page_options', true);
	$menu_color = (!empty( $menu_color ) && isset($menu_color['menu_color']) && !empty($menu_color['menu_color'])) ? $menu_color['menu_color'] : '#fff';

	$animation = (function_exists('xooapp_get_option')) ? xooapp_get_option('xooapp_animation_enable') : '';
	$theme_color = (function_exists('xooapp_get_option')) ? xooapp_get_customize_option('theme_color') : '';
	$custom_css ='';
	$custom_css .="
	.navbar-dark .navbar-nav .nav-link {
		color: {$menu_color};
	}
	";
	if(!empty($theme_color)) {
		$custom_css .="
		li.nav-item:hover > a, .entry-meta span i, .single-post .entry-meta span i, footer.entry-footer span.tags-links i, .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
			color: {$theme_color} !important;
		}
		span.single-post-cat a, footer.entry-footer span.tags-links a, .btn-green, .navbar-expand-lg .navbar-nav .nav-link span, .dropdown-item:focus:before, .dropdown-item:hover:before, .btn.btn-lightgreen, .elementor-widget-button a.elementor-button, .elementor-widget-button .elementor-button, .play-icon-green, #page-breadcrum, .wpcf7 .wpcf7-submit {
			background-color: {$theme_color};
			border-color: {$theme_color};
		}
		.elementor-widget-container blockquote, blockquote {
			border-color: {$theme_color};
		}
		.dropdown-menu a:focus:before, .dropdown-menu a:hover:before, .nl-simple .dropdown-item:focus:before, .nl-simple .dropdown-item:hover:before, #page-breadcrum:before {
			background-color: {$theme_color};
		}
		.play-icon-green:before {
			background-image: -moz-linear-gradient(-164deg, {$theme_color} 0%, {$theme_color} 48%, {$theme_color} 100%);
			background-image: -webkit-linear-gradient(-164deg, {$theme_color} 0%, {$theme_color} 48%, {$theme_color} 100%);
			background-image: -ms-linear-gradient(-164deg, {$theme_color} 0%, {$theme_color} 48%, {$theme_color} 100%);
			background-image: -o-linear-gradient(-164deg, {$theme_color} 0%, {$theme_color} 48%, {$theme_color} 100%);
		}
		";
	}
	if($animation == '' ) {
		$custom_css .="
		.animated {
			/*CSS transitions*/
			-o-transition-property: none !important;
			-moz-transition-property: none !important;
			-ms-transition-property: none !important;
			-webkit-transition-property: none !important;
			transition-property: none !important;
			/*CSS transforms*/
			-o-transform: none !important;
			-moz-transform: none !important;
			-ms-transform: none !important;
			-webkit-transform: none !important;
			transform: none !important;
			/*CSS animations*/
			-webkit-animation: none !important;
			-moz-animation: none !important;
			-o-animation: none !important;
			-ms-animation: none !important;
			animation: none !important;
		}

		";
	}
	wp_add_inline_style( 'xooapp-style', $custom_css );

	// js include
	if ( SCRIPT_DEBUG == true || WP_DEBUG == true ) {	
		wp_enqueue_script('bootstrap', XOOAPP_JS . 'bootstrap.js', array('jquery'), XOOAPP_VERSION, true);
		wp_enqueue_script('jquery.easing', XOOAPP_JS . 'jquery.easing.js', array('jquery'), XOOAPP_VERSION, true);
		wp_enqueue_script('jquery.stellar', XOOAPP_JS . 'jquery.stellar.js', array('jquery'), XOOAPP_VERSION, true);
		wp_enqueue_script('jquery.scrollto', XOOAPP_JS . 'jquery.scrollto.js', array('jquery'), XOOAPP_VERSION, true);
		wp_enqueue_script('jquery.appear', XOOAPP_JS . 'jquery.appear.js', array('jquery'), XOOAPP_VERSION, true);
		wp_enqueue_script('slick', XOOAPP_JS . 'slick.js', array('jquery'), XOOAPP_VERSION, true);
		wp_enqueue_script('jquery.magnific-popup', XOOAPP_JS . 'jquery.magnific-popup.js', array('jquery'), XOOAPP_VERSION, true);
		wp_enqueue_script('xooapp-custom', XOOAPP_JS . 'custom.js', array('jquery'), XOOAPP_VERSION, true);
	} else {
		wp_enqueue_script('xooapp-scripts', XOOAPP_JS . 'scripts.min.js', array('jquery'), XOOAPP_VERSION, true);
	}

	if (function_exists('xooapp_get_option')) { 
		$animation = xooapp_get_option('xooapp_animation_enable');
		if($animation == 0) {
			wp_add_inline_script( 'xooapp-custom', 'jQuery( \'.elementor-element\' ).removeClass( \'animated animated-slow elementor-invisible\' ); jQuery( \'.elementor-element\' ).removeAttr( \'data-settings\' );' );
		}
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'xooapp_scripts', 20 );


add_action( 'enqueue_block_editor_assets', 'xooapp_gutenberg_editor_scripts' );


// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'xooapp_gutenberg_editor_scripts' ) ) {
	//Handler of the add_action( 'enqueue_block_editor_assets', 'xooapp_gutenberg_editor_scripts');
	function xooapp_gutenberg_editor_scripts() {
		// css include
		if ( SCRIPT_DEBUG == true || WP_DEBUG == true ) {	
			$min = '';
		} else {
			$min = '.min';
		}
		wp_enqueue_style( 'xooapp-fonts', xooapp_fonts_url(), array(), null );
		
		// Editor styles
		wp_enqueue_style( 'xooapp-gutenberg-style', XOOAPP_CSS . 'gutenberg-editor-style' . $min. '.css', '', XOOAPP_VERSION, 'all' );

	}
}


