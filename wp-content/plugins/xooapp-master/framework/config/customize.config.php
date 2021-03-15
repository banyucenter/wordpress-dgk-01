<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// CUSTOMIZE SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================

$options              = array();

// -----------------------------------------
// Customize Core Fields                   -
// -----------------------------------------
$options[]            = array(
	'name'              => 'xooapp_theme_color',
	'title'             => 'Theme Color',
	'settings'          => array(

    // color
		array(
			'name'          => 'theme_color',
			'default'       => '#d80039',
			'transport' => 'postMessage',
			'control'       => array(
				'label'       => 'Theme Color',
				'type'        => 'color',
			),
		),
	),

);


XOOAPPFramework_Customize::instance( $options );
