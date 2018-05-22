<?php
		if (of_get_option('g_breadcrumbs_id') == 'yes') { ?>
			<!-- BEGIN BREADCRUMBS-->
<section class="title-section">
			<?php
/* Begin shop */	
				if (function_exists( 'is_shop' ) && is_shop() || function_exists( 'is_product' ) && is_product()){
					if(class_exists( 'Woocommerce' )){
						woocommerce_breadcrumb(array('delimiter' => ' / ', 'wrap_before' => '<ul class="breadcrumb breadcrumb__t">', 'wrap_after' => '</ul>'));
					} elseif(function_exists( 'jigoshop_init' )){
						jigoshop_breadcrumb('/ ', '<ul class="breadcrumb breadcrumb__t">', '</ul>');
					}
/* End shop */
				} elseif (function_exists('breadcrumbs')) {
					breadcrumbs();
				};
			?>
			<!-- END BREADCRUMBS -->
</section><!-- .title-section -->
	<?php }
	?>