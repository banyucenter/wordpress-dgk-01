	<?php 

	if(function_exists('xooapp_framework_init') ) {

		$xooapp_inner_subscription = xooapp_get_option('xooapp_inner_subscription');
		if($xooapp_inner_subscription) {
			?>


			<section id="newsletter-2" class="bg-scroll bg-green newsletter-section division">
				<div class="container white-color">
					<div class="row d-flex align-items-center">


						<!-- NEWSLETTER TEXT -->
						<div class="col-lg-6">
							<div class="newsletter-txt">

								<!-- Title -->
								<h3 class="h3-xs">
									<?php if(function_exists('xooapp_framework_init')) { ?>
										<?php echo xooapp_get_option('xooapp_subs_title'); ?>
									<?php } ?>
								</h3>

							</div>
						</div>
						<?php 
						$subs_id = xooapp_get_option('xooapp_subs_id');
						?>

						<!-- NEWSLETTER FORM -->
						<div class="col-lg-6">
							<?php echo do_shortcode( '[mc4wp_form id="'.$subs_id.'"]' ) ?>
						</div>


					</div>	  <!-- End row -->
				</div>	   <!-- End container -->	
			</section>	<!-- END NEWSLETTER-2 -->
			<?php 
		}
	}
	?>