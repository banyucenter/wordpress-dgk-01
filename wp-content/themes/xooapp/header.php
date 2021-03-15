<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xooapp
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
 <?php wp_body_open(); ?>


    <?php
    if (function_exists('xooapp_framework_init')) {
        $preloader = xooapp_get_option('xooapp_preloader_enable');
        if (!empty($preloader)) {
            ?>

    <!-- PRELOADER
        ============================================= -->       
        <div id="loader-wrapper">
            <div id="loader">
                <ul class="cssload-flex-container">
                    <li><span class="cssload-loading"></span></li>
                </ul>
            </div>
        </div>

        <?php }
    } ?>


    <!-- PAGE CONTENT
        ============================================= -->   

        <div id="page" class="site">

            