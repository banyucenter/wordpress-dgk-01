<?php

$page_settings = get_post_meta( get_the_ID(), '_custom_page_options', true );

if( !empty( $page_settings ) && isset($page_settings['footer_color']) && !empty($page_settings['footer_color']) ) {
	$footer_clr = '#fff';
	$footer_clr = (isset($page_settings['footer_color']) ) ? $page_settings['footer_color'] : '#fff';
	$footer_bg = 'style="background-color: '. esc_attr( $footer_clr ) .' "';
} else {
	$footer_bg = '';
}
?>
<footer id="footer-1" class="p-bottom-60 footer" <?php echo wp_kses_stripslashes( $footer_bg ) ?> itemscope="itemscope" itemtype="http://schema.org/WPFooter">

	
	<?php 
	if ( function_exists( 'xooapp_framework_init' ) && !empty($page_settings) ) { 

		if( array_key_exists('show_footer_subs', $page_settings) && $page_settings['show_footer_subs'] ) {
			get_template_part('footers/footer', 'subscription');
		}
		if( array_key_exists('show_footer_widgets', $page_settings) && $page_settings['show_footer_widgets']  )  {
			get_template_part('footers/footer', 'widgets');
		}
	} 
	?>
	
	<div class="container">
		<!-- FOOTER CONTENT -->

		<!-- FOOTER COPYRIGHT -->
		<div class="bottom-footer">
			<div class="row">
				<div class="col-md-5">	
					<div class="footer-copyright">
						<?php if ( function_exists( 'xooapp_framework_init' )) { ?>
							<?php echo wp_kses_stripslashes( xooapp_get_option( 'copyrights' ) ); ?>
						<?php } ?>
					</div>	

				</div>
				<div class="col-md-7">
					<div class="footer-links text-right">
						<?php
						if( function_exists( 'xooapp_framework_init' ) ) {
							$show_footer_link = get_post_meta( get_the_ID(), '_custom_page_options', true );
							$footer_menu = '';
							$footer_menu = xooapp_get_option('footer_menu');
							if(!empty($footer_menu) && isset($show_footer_link['show_footer_link']) ) {
								?>
								<ul class="foo-links clearfix">
									<?php foreach ($footer_menu as $value) {
										?>
										<li><a href="<?php echo esc_url( $value['footer_menu_link'] ) ?>" class="<?php echo esc_attr( $value['footer_menu_title'] ) ?>"><?php echo esc_html( $value['footer_menu_title'] ) ?></a></li>
									<?php } ?>
								</ul>
							<?php }
						} ?>
					</div>	
				</div>
			</div>	<!-- END BOTTOM FOOTER -->
		</div>
	</div>
</footer>

</div> 
<!-- end page  -->

<?php wp_footer();?>

</body>
</html>