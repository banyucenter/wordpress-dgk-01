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

            
            <!-- HEADER
                ============================================= -->
                <header id="header" class="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
                    
                    <?php
                    $trans = 'navbar-light bg-light';
                    $trans = get_post_meta(get_the_ID(), '_custom_page_options', true);
                    $trans = (!empty($trans) && $trans['menu_trans']) ? 'navbar-dark bg-tra' : 'navbar-light bg-light';
                    ?>
                    <nav class="navbar fixed-top navbar-expand-lg <?php echo esc_attr($trans) ?>">

                        <div class="container">

                            <!-- LOGO IMAGE -->
                            <!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 260 x 60 pixels) -->
                            <?php
                            $paged_logo = get_post_meta(get_the_ID(), '_custom_page_options', true);
                            $paged_logo = (is_array($paged_logo)) ? $paged_logo['xooapp_logo_img'] : '';
                            $paged_logo = wp_get_attachment_url($paged_logo);
                            $paged_logo_white = get_post_meta(get_the_ID(), '_custom_page_options', true);
                            $paged_logo_white = (is_array($paged_logo_white)) ? $paged_logo_white['xooapp_white_logo_img'] : '';
                            $paged_logo_white = wp_get_attachment_url($paged_logo_white);

                            $default_logo = (function_exists('xooapp_framework_init')) ? xooapp_get_option('xooapp_logo_img') : '';
                            $default_logo = wp_get_attachment_url($default_logo);
                            $default_logo = (!empty($paged_logo)) ? $paged_logo : $default_logo;
                            $white_logo = (function_exists('xooapp_framework_init')) ? xooapp_get_option('xooapp_white_logo_img') : '';
                            $white_logo = wp_get_attachment_url($white_logo);
                            $white_logo = (!empty($paged_logo_white)) ? $paged_logo_white : $white_logo;
                            
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } elseif (!empty($white_logo)) { ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand logo-white">
                                    <img src="<?php echo esc_url($white_logo) ?>" width="130" height="30" alt="<?php bloginfo('name'); ?>">
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand logo-white">
                                    <img src="<?php echo esc_url(XOOAPP_URL . '/assets/images/logo-white.png') ?>" width="130" height="30" alt="<?php bloginfo('name'); ?>">
                                </a>
                            <?php } ?>

                            <?php
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } elseif (!empty($default_logo)) { ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand logo-black">
                                    <img src="<?php echo esc_url($default_logo) ?>" width="130" height="30" alt="<?php bloginfo('name'); ?>">
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand logo-black">
                                    <img src="<?php echo esc_url(XOOAPP_URL . '/assets/images/logo.png') ?>" width="130" height="30" alt="<?php bloginfo('name'); ?>">
                                </a>
                            <?php } ?>


                            <!-- Responsive Menu Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>


                            <!-- Navigation Menu -->
                            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                                <?php
                                $one_page_menu = get_post_meta(get_the_ID(), '_custom_page_options', true);
                                if (!empty($one_page_menu) && $one_page_menu['xooapp_onepage_nav'] && array_key_exists('xooapp_onepage_nav', $one_page_menu)) {
                                    $menus = $one_page_menu['onepage_nav'];
                                    $i = 0;
                                    if (is_array($menus)) { ?>
                                        <ul class="navbar-nav ml-auto">
                                            <?php
                                            foreach ($menus as $value) {
                                                $i++;
                                                $menuname = $value['menu_name'];
                                                $id = str_replace(' ', '_', $menuname);

                                                $d_class = $toggle = $attr = $menu_list = '';
                                                if (isset($value['has_dropdown']) == 1) {
                                                    $d_class = 'dropdown';
                                                    $toggle = 'dropdown-toggle';
                                                    $attr = 'id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                                                    $menu_list = $value['drop_menu_list'];
                                                }

                                                if (isset($value['menu_name_active']) == 1) {
                                                    $toggle = 'pre-link';
                                                }
                                                ?>
                                                <li  class="nav-item <?php echo esc_attr($d_class) ?>">

                                                    <a href="#<?php echo esc_attr(strtolower($id)); ?>" class="nav-link <?php echo esc_attr($toggle) ?> <?php if ($i == 1) {
                                                        echo 'active';
                                                              } ?>" <?php echo wp_kses_stripslashes($attr); ?>><?php echo esc_html($menuname); ?>
                                                    <?php if (isset($value['menu_name_active']) == 1) { ?>
                                                        <span></span>
                                                    <?php } ?>
                                                </a>


                                                <?php if (isset($value['has_dropdown']) == 1) {  ?>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <?php
                                                        $arr = explode("\n", trim($menu_list));
                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $line = $arr[$i];
                                                            $with_underslas = str_replace(' ', '_', $line);
                                                            $with_underslas = strtolower($with_underslas);
                                                            if ($line!=htmlspecialchars($line)) {
                                                                $line = $line;
                                                            } else {
                                                                $line = '<a class="dropdown-item" href="#'. esc_attr($with_underslas). '">' . esc_html($line). '</a>';
                                                            }
                                                            echo html_entity_decode($line);
                                                            ?>
                                                            <?php
                                                        } ?>
                                                    </div>
                                                <?php } ?>
                                            </li>
                                            <?php } ?>
                                    </ul>
                                        <?php
                                    }
                                } else {
                                    wp_nav_menu(array(
                                    'theme_location' => 'menu-1',
                                    'depth'           => 4,
                                    'container_class' => 'navbar-collapse',
                                    'menu_class'      => 'xooapp-navmenu navbar-nav ml-auto',
                                    'fallback_cb'     => 'Xooapp_WP_Bootstrap_Navwalker::fallback',
                                    'walker'          => new Xooapp_WP_Bootstrap_Navwalker()
                                    ));
                                } ?>
                            <?php
                            $social_settings = get_post_meta(get_the_ID(), '_custom_page_options', true);
                            if (isset($social_settings['show_social']) && $social_settings['show_social'] == true) {
                                if (!empty($social_settings) && $social_settings['show_social_display'] == true && array_key_exists('social_settings', $social_settings)) {
                                    ?>
                                    <ul class="header-social-area">
                                        <li class="header-socials clearfix">
                                            <?php
                                            if (is_array($social_settings)) {
                                                foreach ($social_settings['social_settings'] as $value) {
                                                    $icon_class = $value['social_icon'];
                                                    $social_class = str_replace('fa fa-', '', $icon_class);
                                                    ?>
                                                    <span><a href="<?php echo esc_url($value['social_link']) ?>" class="ico-<?php echo esc_attr(strtolower($social_class)) ?>"><i class="<?php echo esc_attr($value['social_icon']) ?>"></i></a></span>
                                                <?php }
                                            } ?>
                                        </li>
                                    </ul>
                                <?php } else {
                                    $social_img = $social_settings['social_img'];
                                    ?>
                                    <a href="<?php echo esc_url($social_settings['social_img_link']); ?>" class="header-store">
                                        <img class="appstore-button" src="<?php echo esc_url(wp_get_attachment_image_url($social_img, 'full')); ?>" width="141" height="44" alt="<?php esc_attr_e('appstore-logo', 'xooapp'); ?>">
                                    </a>
                                    <?php
                                }
                            } else {
                                if (function_exists('xooapp_framework_init')) {
                                    $social_settings = xooapp_get_option('social_settings');
                                    if (!empty($social_settings)) {
                                        ?>
                                        <ul class="header-social-area">
                                            <li class="header-socials clearfix">
                                                <?php foreach ($social_settings as $value) {
                                                    $icon_class = $value['social_icon'];
                                                    $social_class = str_replace('fa fa-', '', $icon_class);

                                                    ?>
                                                    <span><a href="<?php echo esc_url($value['social_link']) ?>" class="ico-<?php echo esc_attr($social_class) ?>"><i class="<?php echo esc_attr($value['social_icon']) ?>"></i></a></span>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    <?php }
                                }
                            } ?>
                        </div>  <!-- End Navigation Menu -->
                    </div>    <!-- End container -->
                </nav>     <!-- End navbar  -->
            </header>   <!-- END HEADER -->

