<?php
/*==================================================================================================================================*/
/* - Recent Widget
/*==================================================================================================================================*/ 
class xooapp_recent_post_widget extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'xooapp_recent_post_widget', // Base ID
            'M:: Recent Posts', // Name
            array( 'description' => esc_html__( 'Xooapp Recent Posts Widget', 'xooapp' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        $title = ($instance['title']) ? $instance['title'] : 'Recent Posts';
        ?>

        <div class="footer-recent-post">
            <h5 class="h5-md widget-title"><?php echo esc_html( $title ); ?></h5>
            <?php 
            $count = $instance['count'];
            $query = "";  
            $pc = new WP_Query('post_type=post&posts_per_page=' . $count, $query);
            while ($pc->have_posts()) : $pc->the_post(); 
                ?>
                <div class="single-frp">
                        <?php if(has_post_thumbnail()) { ?>
                            <div class="frp-img">
                                <span class="image-block" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?>)"></span>
                                <?php //the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php } ?>
                        <div class="frp-content">
                            <h5><a href="<?php the_permalink() ?>"><?php echo esc_html( the_title() ); ?></a></h5>
                        </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>                
        </div>

        <?php 

        // echo __( 'Hello, World!', 'text_domain' );
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        //for data query form database for display in input value

        // $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $count = ! empty( $instance['count'] ) ? $instance['count'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'xooapp' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php esc_html_e( 'Post Count:', 'xooapp' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
        </p>

        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

        return $instance;
    }

} // class xooapp_recent_post_widget

// register xooapp_recent_post_widget widget
function xooapp_register_recent_post_widget() {
    register_widget( 'xooapp_recent_post_widget' );
}
add_action( 'widgets_init', 'xooapp_register_recent_post_widget' );

/*==================================================================================================================================*/
/* - End Of Recent Posts Widget
/*==================================================================================================================================*/ 





/*============================================================================================================================*/
/* - Brand logo Widget
/*============================================================================================================================*/ 
if( ! class_exists( 'XOOAPP_Widget' ) ) {
  class XOOAPP_Widget extends WP_Widget {

    function __construct() {

      $widget_ops     = array(
        'classname'   => 'xooapp_brandlogo_widget',
        'description' => 'Logo Widget.'
    );

      parent::__construct( 'about_widget', 'M:: Xooapp Logo Widget', $widget_ops );

  }

  function widget( $args, $instance ) {

      extract( $args );

      echo $before_widget;

      ?>
      <div class="footer-info p-right-45 m-bottom-40">
        <img src="<?php echo $instance['footer_logo'] ?>" alt="">

        <div class="footer-social m-top-20">
            <?php echo $instance['social_btn'] ?>
        </div>
    </div>

    <?php echo $after_widget;

}

function update( $new_instance, $old_instance ) {

  $instance            = $old_instance;
  $instance['title']   = $new_instance['title'];
  $instance['footer_logo']    = $new_instance['footer_logo'];
  $instance['social_btn'] = $new_instance['social_btn'];

  return $instance;

}

function form( $instance ) {

      //
      // Title Field Defaults
      // -------------------------------------------------
  $instance   = wp_parse_args( $instance, array(
    'title'   => 'Brand Logo',
    'footer_logo'    => '',
    'social_btn' => '',
));

      //
      // Title Field
      // -------------------------------------------------
  $text_value = esc_attr( $instance['title'] );
  $text_field = array(
    'id'    => $this->get_field_name('title'),
    'name'  => $this->get_field_name('title'),
    'type'  => 'text',
    'title' => 'Title',
);

  echo xooapp_add_element( $text_field, $text_value );

      //
      // Footer Logo Upload
      // -------------------------------------------------
  $footer_logo_value = esc_attr( $instance['footer_logo'] );
  $footer_logo_field = array(
    'id'    => $this->get_field_name('footer_logo'),
    'name'  => $this->get_field_name('footer_logo'),
    'type'  => 'upload',
    'title' => 'Logo Image',
    'info'  => 'Footer Logo Upload Here',
);

  echo xooapp_add_element( $footer_logo_field, $footer_logo_value );

      //
      // Social Media List
      // -------------------------------------------------
  $social_btn_value = esc_attr( $instance['social_btn'] );
  $social_btn_field = array(
    'id'    => $this->get_field_name('social_btn'),
    'name'  => $this->get_field_name('social_btn'),
    'type'  => 'textarea',
    'title' => 'Content',
    'info'  => 'Short Content Here',
);

  echo xooapp_add_element( $social_btn_field, $social_btn_value );

}
}
}

if ( ! function_exists( 'xooapp_widget_init' ) ) {
  function xooapp_widget_init() {
    register_widget( 'XOOAPP_Widget' );
}
add_action( 'widgets_init', 'xooapp_widget_init', 2 );
}



/*============================================================================================================================*/
/* - Brand logo Widget
/*============================================================================================================================*/ 
if( ! class_exists( 'Xooapp_Apps_Info_Widget' ) ) {
  class Xooapp_Apps_Info_Widget extends WP_Widget {

    function __construct() {

      $widget_ops     = array(
        'classname'   => 'xooapp_apps_info_widget',
        'description' => 'Logo Widget.'
    );

      parent::__construct( 'xooapp_apps_info_widget', 'M:: Xooapp Apps Info', $widget_ops );

  }

  function widget( $args, $instance ) {

      extract( $args );

      echo $before_widget;

      ?>
      <div class="xooapp-inner-appsinfo">
          <a href="<?php echo esc_url($instance['apps_one_link']) ?>" class="store">
            <img class="appstore-original" src="<?php echo $instance['apps_one_logo'] ?>" width="160" height="50" alt="">
        </a>
        <a href="<?php echo esc_url($instance['apps_two_link']) ?>" class="store">
            <img class="appstore-original" src="<?php echo $instance['apps_two_logo'] ?>" width="160" height="50" alt="">
        </a>
    </div>
    <?php echo $after_widget;

}

function update( $new_instance, $old_instance ) {

  $instance            = $old_instance;
  $instance['title']   = $new_instance['title'];
  $instance['apps_one_logo']    = $new_instance['apps_one_logo'];
  $instance['apps_one_link'] = $new_instance['apps_one_link'];

  $instance['apps_two_logo']    = $new_instance['apps_two_logo'];
  $instance['apps_two_link'] = $new_instance['apps_two_link'];

  return $instance;

}

function form( $instance ) {

      //
      // Title Field Defaults
      // -------------------------------------------------
  $instance   = wp_parse_args( $instance, array(
    'title'   => 'Apps Info',
    'apps_one_logo'    => '',
    'apps_one_link' => '',
    'apps_two_logo'    => '',
    'apps_two_link' => '',
));

      //
      // Title Field
      // -------------------------------------------------
  $text_value = esc_attr( $instance['title'] );
  $text_field = array(
    'id'    => $this->get_field_name('title'),
    'name'  => $this->get_field_name('title'),
    'type'  => 'text',
    'title' => 'Title',
);

  echo xooapp_add_element( $text_field, $text_value );

      //
      // apps one Logo Upload
      // -------------------------------------------------
  $apps_one_logo_value = esc_attr( $instance['apps_one_logo'] );
  $apps_one_logo_field = array(
    'id'    => $this->get_field_name('apps_one_logo'),
    'name'  => $this->get_field_name('apps_one_logo'),
    'type'  => 'upload',
    'title' => 'Logo Image',
);

  echo xooapp_add_element( $apps_one_logo_field, $apps_one_logo_value );

      //
      // apps one link
      // -------------------------------------------------
  $apps_one_link_value = esc_attr( $instance['apps_one_link'] );
  $apps_one_link_field = array(
    'id'    => $this->get_field_name('apps_one_link'),
    'name'  => $this->get_field_name('apps_one_link'),
    'type'  => 'text',
    'title' => 'Link',
);

  echo xooapp_add_element( $apps_one_link_field, $apps_one_link_value );


      //
      // apps two Logo Upload
      // -------------------------------------------------
  $apps_two_logo_value = esc_attr( $instance['apps_two_logo'] );
  $apps_two_logo_field = array(
    'id'    => $this->get_field_name('apps_two_logo'),
    'name'  => $this->get_field_name('apps_two_logo'),
    'type'  => 'upload',
    'title' => 'Logo Image',
);

  echo xooapp_add_element( $apps_two_logo_field, $apps_two_logo_value );

      //
      // apps two link
      // -------------------------------------------------
  $apps_two_link_value = esc_attr( $instance['apps_two_link'] );
  $apps_two_link_field = array(
    'id'    => $this->get_field_name('apps_two_link'),
    'name'  => $this->get_field_name('apps_two_link'),
    'type'  => 'text',
    'title' => 'Link',
);

  echo xooapp_add_element( $apps_two_link_field, $apps_two_link_value );

}
}
}

if ( ! function_exists( 'xooapp_apps_info_widget_init' ) ) {
  function xooapp_apps_info_widget_init() {
    register_widget( 'Xooapp_Apps_Info_Widget' );
}
add_action( 'widgets_init', 'xooapp_apps_info_widget_init', 2 );
}



