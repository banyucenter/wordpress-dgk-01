<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function xooapp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'xooapp' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'When left sidebar or right sidebar active from theme options.', 'xooapp' ),
		'before_widget' => '<div id="%1$s" class="sidebar-div col-lg-12 m-bottom-50 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="h5-md widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'xooapp' ),
		'id'            => 'footer-one',
		'description'   => esc_html__( 'Add footer widgets here.', 'xooapp' ),
		'before_widget' => '<div id="%1$s" class="col-lg-3 m-bottom-50 %2$s"><div class="xooapp-footer-widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="h5-md widget-title">',
		'after_title'   => '</h5>',
	) );


}
add_action( 'widgets_init', 'xooapp_widgets_init' );