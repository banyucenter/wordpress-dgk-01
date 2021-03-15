<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class XOOAPPFramework_Option_icon extends XOOAPPFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo $this->element_before();

    $value  = $this->element_value();
    $hidden = ( empty( $value ) ) ? ' hidden' : '';

    echo '<div class="xooapp-icon-select">';
    echo '<span class="xooapp-icon-preview'. $hidden .'"><i class="'. $value .'"></i></span>';
    echo '<a href="#" class="button button-primary xooapp-icon-add">'. esc_html__( 'Add Icon', 'xooapp' ) .'</a>';
    echo '<a href="#" class="button xooapp-warning-primary xooapp-icon-remove'. $hidden .'">'. esc_html__( 'Remove Icon', 'xooapp' ) .'</a>';
    echo '<input type="text" name="'. $this->element_name() .'" value="'. $value .'"'. $this->element_class( 'xooapp-icon-value' ) . $this->element_attributes() .' />';
    echo '</div>';

    echo $this->element_after();

  }

}
