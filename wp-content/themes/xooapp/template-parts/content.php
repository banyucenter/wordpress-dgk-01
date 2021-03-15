<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xooapp
 */

?>
<?php // Permanent 301 Redirect via PHP
    // header("HTTP/1.1 301 Moved Permanently");
    // header("Location: http://mobicom.test/nemo-ipsam-egestas-volute-turpis-quaerat-sapien/");
    // exit();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/Article" itemscope="itemscope">
    <div class="blog-post">

        <?php if (is_single() && !is_page_template()) { ?>
            <header class="entry-header blog-post-txt">
                <?php if (has_category()) { ?>
                    <span class="single-post-cat"><?php the_category(' ') ?></span>
                <?php } ?>
                <?php

                the_title('<h1 class="m-bottom-10">', '</h1>');
                if ('post' === get_post_type()) : ?>
                    <div class="entry-meta m-bottom-30 grey-color">
                        <?php
                        xooapp_posted_on();
                        xooapp_posted_by();
                        xooapp_post_comments_love();
                        ?>
                    </div>
                    <!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

        <?php } ?>

        <?php
        $feature_img = get_post_meta(get_the_ID(), '_custom_post_control_options', true);
        if (is_single()) {
            if (!empty($feature_img) && ( $feature_img['title_featureimag'] == 0 ) && has_post_thumbnail()) { ?>
                <div class="featured-img text-center m-bottom-30" itemprop="image" itemscope="itemscope" itemtype="https://schema.org/ImageObject">
                    <?php the_post_thumbnail(); ?>
                </div>
                <!-- /.m-top-10 -->
            <?php }
        } else {
            if (has_post_thumbnail()) {
                ?>
                <div class="featured-img text-center" itemprop="image" itemscope="itemscope" itemtype="https://schema.org/ImageObject">
                    <?php the_post_thumbnail(); ?>
                </div>
                <!-- /.m-top-10 -->
                <?php
            }
        } ?>

        <?php if (! is_single()) { ?>
            <header class="entry-header p-left-20 p-right-20 p-top-20">
                <?php
                if ('post' === get_post_type()) : ?>
                    <div class="entry-meta m-bottom-10">
                        <?php
                        xooapp_posted_on();
                        xooapp_posted_one_cat();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif;
                the_title('<h4 class="entry-title m-bottom-10"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>');
                ?>
            </header><!-- .entry-header -->
        <?php } ?>

        <div class="content-area">

            <div class="entry-content blog-post-txt p-left-20 p-right-20 m-bottom-30" itemprop="articleBody">
                <?php
                if (is_single()) {
                    the_content(sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'xooapp'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ));
                } else {
                    the_excerpt();
                }

                wp_link_pages(array(
                    'before' => '<div class="page-links">',
                    'after'  => '</div>',
                    'link_before'      => '<span>',
                    'link_after'       => '</span>',
                    'next_or_number'   => 'number',
                    'pagelink'         => '%',
                    'echo'             => 1
                ));
                ?>

                <?php if (!is_home() && !is_archive()) { ?>
                    <div class="clearfix"></div>
                    <footer class="entry-footer">
                        <?php xooapp_entry_footer(); ?>
                        <?php
                        if (is_single() && function_exists('xooapp_framework_init')) {
                            if (xooapp_get_option('xooapp_social_share')) {
                                xooapp_social_share();
                            }
                        }
                        ?>
                    </footer><!-- .entry-footer -->
                <?php } ?>

            </div><!-- .entry-content -->
        </div>

        <?php if (!is_singular()) { ?>
            <hr>
            <div class="blog-post-meta clearfix p-bottom-20">
                <?php
                if (is_single() && function_exists('xooapp_framework_init')) {
                    if (xooapp_get_option('xooapp_social_share')) {
                        echo '<div class="text-left float-left">';
                        xooapp_social_share();
                        echo '</div>';
                    }
                }
                ?>
                <div class="text-right p-left-20 p-right-20">
                    <?php xooapp_post_comments_love(); ?>
                </div>
            </div>
        <?php } ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
