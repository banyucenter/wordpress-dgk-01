<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package xooapp
 */

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
?>

<!-- Sidebar area -->
<aside id="sidebar-right" class="col-md-12 col-lg-3" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
</aside>
<!--/ Sidebar area -->