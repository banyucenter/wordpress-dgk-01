<?php

add_action( 'wp_footer', 'xooapp_quick_contact_form7' );

function xooapp_quick_contact_form7() {

	$quick_form_on = xooapp_get_option('quick_form_on');
	$quick_form_title = xooapp_get_option('quick_form_title');
	$quick_form = xooapp_get_option('quick_form');

	if($quick_form_on) {
		?>
			<!-- BOTTOM QUICK FORM
				============================================= -->
				<div id="quick-form">
					<div class="bottom-form">


						<!-- QUICK FORM HEADER -->
						<div class="bottom-form-header">
							<span class="pe-7s-chat"></span>
							<p><?php echo esc_html( $quick_form_title ); ?></p>	            		
						</div>


						<!-- QUICK FORM -->
						<div class="bottom-form-holder">

							<?php echo do_shortcode( '[contact-form-7 id="'.$quick_form.'" title="Contact form 1"]' ) ?>		

						</div>

					</div>
				</div>	  <!-- END BOTTOM QUICK FORM -->

				<?php
			}
		}
