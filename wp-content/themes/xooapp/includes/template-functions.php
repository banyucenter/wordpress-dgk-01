<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package xooapp
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function xooapp_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (! is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (! is_active_sidebar('right-sidebar')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'xooapp_body_classes');


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function xooapp_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'xooapp_pingback_header');

/**
 * custom logo
 *
 * @return array
 */
add_filter('get_custom_logo', 'xooapp_custom_logo');



/*-----------------------------------------------------------------------------------*/
/*  Display navigation to next/previous set of posts when applicable.
/*-----------------------------------------------------------------------------------*/

if (! function_exists('xooapp_paging_nav')) :

    function xooapp_paging_nav($pages = '', $range = 2)
    {

        $showitems = ($range * 1)+1;

        global $paged;

        if (empty($paged)) {
            $paged = 1;
        }

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        if (1 != $pages) {
            echo '
			<div class="blog-page-pagination m-top-80"><ul class="pagination justify-content-center">';

            if ($paged > 2 && $paged > $range+1 && $showitems < $pages) {
                echo '<li class="page-item"><a class="page-link prev-post" href="'.get_pagenum_link(1).'"><span aria-hidden="true"><i class="ti-angle-left"></i> Previous</span></a></li>';
            }


            for ($i=1; $i <= $pages; $i++) {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                    $pagesed = ($paged == $i)? "<li class=\"page-item active \"><a href='#' class=\"page-link \">".$i."</a></li>":"<li class=\"page-item\"><a href='".get_pagenum_link($i)."' class='page-no pre page-link'>".$i."</a></li>";

                    echo wpautop($pagesed);
                }
            }


            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
                echo '<li class="page-item"><a class="page-link next-post" href="'.get_pagenum_link($pages).'"><span aria-hidden="true">Next <i class="ti-angle-right"></i></span></a></li>';
            }


            echo '</ul></div>';
        }
    }

endif;


// Filter the output of logo to fix Googles Error about itemprop logo
function xooapp_custom_logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $html = sprintf(
        '<a href="%1$s" class="custom-logo-link">%2$s</a>',
        esc_url(home_url('/')),
        wp_get_attachment_image($custom_logo_id, 'full', false, array(
            'class'    => 'custom-logo',
        ))
    );
    return $html;
}


/**  comments from call back function.
--------------------------------------------------------------------------------------------------- */

if (!function_exists('xooapp_comment')) :

    function xooapp_comment($comment, $args, $depth)
    {
        
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback':
            case 'trackback':
            // Display trackbacks differently than normal comments.
                ?>
            <li <?php comment_class(); ?> id="submited-comment">

                <p><?php esc_html_e('Pingback:', 'xooapp'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('(Edit)', 'xooapp'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
            default:
                global $post;
                ?>

                <li <?php comment_class(); ?>>

                    <div id="comment-<?php comment_ID(); ?>">
                        <div class="media">
                        <?php if (!empty(get_avatar($comment, $args['avatar_size']))) { ?>
                                <?php echo get_avatar($comment, $args['avatar_size']); ?>
                        <?php } ?>

                            <div class="media-body comments-content">
                                <div class="comment-meta">
                                    <h5 class="h5-xs mt-0 user-name"><?php comment_author(); ?></h5>
                                    <span class="comment-date"><?php echo get_comment_date('F j, Y \a\t i:s A'); ?></span>
                                </div>
                                <div class="comments-text">
                                <?php comment_text(); ?>
                                </div>
                                <span class="btn-reply">
                                <?php comment_reply_link(array_merge($args, array( 'reply_text' => '<i class="ti-back-right"></i>' . esc_html__('Reply', 'xooapp'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ))); ?>
                                </span>
                            </div>

                        </div>
                    </div>
                <?php
                break;
        endswitch;
    }

endif;


/**
 * search form filter
 *
 * @since 1.0
 */

add_filter('get_search_form', 'xooapp_search_form');

function xooapp_search_form($form)
{
    /**
     * Search form customization.
     *
     * @link http://codex.wordpress.org/Function_Reference/get_search_form
     * @since 1.0.0
     */
    $form = '
    <div class="search">
    <form role="search" method="get" action="' . esc_url(home_url('/')). '">

    <!-- Search Field --> 
    <div id="search-field" class="sidebar-div m-bottom-60">

    <div class="input-group mb-3">
    <input type="text" name="s" class="form-control" placeholder="'.esc_attr__('Search ..', 'xooapp').'" aria-label="Search" aria-describedby="search-field">
    <div class="input-group-append">
    <button class="btn btn-lightgreen" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
    </div>

    </div>
    </form>
    </div>
    ';
    return $form;
}

/*------------------------------------------------------------------------------------------------------------------*/
/*  filter widget category counter
/*------------------------------------------------------------------------------------------------------------------*/
function xooapp_categories_postcount_filter($variable)
{
    $variable = str_replace('(', '<span class="post_count">(', $variable);
    $variable = str_replace(')', ')</span>', $variable);
    return $variable;
}
add_filter('wp_list_categories', 'xooapp_categories_postcount_filter');



/*------------------------------------------------------------------------------------------------------------------*/
/*  social share
/*------------------------------------------------------------------------------------------------------------------*/

function xooapp_social_share()
{
    ?>
    <ul class="share-social-icons clearfix">
        <li>
            <a class="print-this icon-box share-ico ico-google-plus"><i class="fa fa-print"></i></a>
        </li>
        <li>
            <?php
            $page_title     = get_the_title();
            $page_permalink = home_url('/?p=' . get_the_ID());
            ?>
            <a class="share-ico ico-facebook" title="Facebook" href="javascript: window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($page_permalink); ?>','_blank', 'width=900, height=450');" target="_blank" rel="nofollow">
                <div class="icon-box facebook-bg">
                    <i class="fa fa-facebook"></i>

                </div>
            </a>
        </li>


        <li>
            <a class="share-ico ico-twitter" title="Twitter" href="javascript: window.open('http://twitter.com/share?text=<?php echo esc_html($page_title); ?>&amp;url=<?php echo esc_url($page_permalink); ?>','_blank', 'width=900, height=450');" target="_blank" rel="nofollow">                                    
                <div class="icon-box twitter-bg">
                    <i class="fa fa-twitter"></i>

                </div>
                <!-- icon-box -->
            </a>
        </li>


    </ul>
    <?php
}
/*------------------------------------------------------------------------------------------------------------------*/
/*  move textarea bottom comments
/*------------------------------------------------------------------------------------------------------------------*/


function xooapp_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'xooapp_move_comment_field_to_bottom');

/* -----------------------------------------------------------------------------------------
*   The excerpt
* -----------------------------------------------------------------------------------------*/

function xooapp_custom_excerpt_length($length)
{
    return 40;
}
add_filter('excerpt_length', 'xooapp_custom_excerpt_length', 999);

function xooapp_custom_excerpt_more($more)
{
    return '...';//you can change this to whatever you want
}
add_filter('excerpt_more', 'xooapp_custom_excerpt_more');


/*
*   widget column
* -----------------------------------------------------------------------------------------*/

function xooapp_in_widget_form($t, $return, $instance)
{
    $instance = wp_parse_args((array) $instance, array( 'title' => '', 'text' => '', 'col' => 'none'));
    if (!isset($instance['col'])) {
        $instance['col'] = null;
    }
    ?>

    <p>
        <label for="<?php echo esc_attr($t->get_field_id('col')); ?>"><?php esc_html_e('Select Column', 'xooapp') ?></label>
        <select id="<?php echo esc_attr($t->get_field_id('col')); ?>" name="<?php echo esc_attr($t->get_field_name('col')); ?>">
            <option <?php selected($instance['col'], 'none');?> value="none"><?php esc_html_e('None', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-2');?>value="col-lg-2"><?php esc_html_e('Size 2/12', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-3');?>value="col-lg-3"><?php esc_html_e('Size 3/12', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-4');?>value="col-lg-4"><?php esc_html_e('Size 4/12', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-5');?>value="col-lg-5"><?php esc_html_e('Size 5/12', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-6');?>value="col-lg-6"><?php esc_html_e('Size 6/12', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-7');?>value="col-lg-7"><?php esc_html_e('Size 7/12', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-8');?>value="col-lg-8"><?php esc_html_e('Size 8/12', 'xooapp') ?></option>
            <option <?php selected($instance['col'], 'col-lg-9');?>value="col-lg-9"><?php esc_html_e('Size 9/12', 'xooapp') ?></option>
        </select>
    </p>

    <?php
    $retrun = null;
    return array($t,$return,$instance);
}

function xooapp_in_widget_form_update($instance, $new_instance, $old_instance)
{
    $instance['col'] = ! empty($new_instance['col']) ? $new_instance['col'] : '';
    return $instance;
}

function xooapp_dynamic_sidebar_params($params)
{
    global $wp_registered_widgets;
    $col = '';
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if (isset($widget_opt[$widget_num]['col'])) {
        $col = $widget_opt[$widget_num]['col'];
    }
    // else {
    //  $col = 'col-lg-4';
    // }
    $params[0]['before_widget'] = preg_replace('/class="/', 'class="custom-col '.$col.'  ', $params[0]['before_widget'], 1);
    return $params;
}

//Add input fields(priority 5, 3 parameters)
add_action('in_widget_form', 'xooapp_in_widget_form', 5, 3);
//Callback function for options update (priorität 5, 3 parameters)
add_filter('widget_update_callback', 'xooapp_in_widget_form_update', 5, 3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'xooapp_dynamic_sidebar_params');
