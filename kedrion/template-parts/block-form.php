<?php
/**
 * Template part for displaying a Form.
 */


//wp_enqueue_script( 'zebra-sticky', get_template_directory_uri() . '/assets/js/min/zebra_pin.src.min.js', array( 'jquery' ), '', true );



wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/assets/js/min/jquery.sticky-kit.min.js', array( 'jquery' ), '', true );


wp_enqueue_script( 'is-visible', get_template_directory_uri() . '/assets/js/min/jquery.visible.min.js', array( 'jquery' ), '', true );

?>


<section class="block form <?php the_sub_field('background_color');?> <?php the_sub_field('form_type');?>">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->
			<!-- Stuff goes here -->
			<div class="form--content">
				<!--follow this pattern for fields, that way their space is not allocated if the field is empty and we do not have weird empty markup everywhere-->
				<?php
		echo FrmFormsController::get_form_shortcode( array( 'id' => get_sub_field( 'select_form' ), 'title' => false, 'description' => false ) );
				?>


				<?php $help_link = get_sub_field( 'help_link' ); ?>
				<?php if ( $help_link ) { ?>
				<a class='hidden button user-guide' href="<?php echo $help_link['url']; ?>"
					target="<?php echo $help_link['target']; ?>"><?php echo $help_link['title']; ?></a>
				<?php } ?>
			</div>

		</div>
	</div>

	<script>
	jQuery(document).ready(function() {


		// watch footers visibility


		/*clean up in case of no ajax*/

		//jQuery('.big-bar').remove();



		var steps = jQuery('.frm_page_bar').children();
		steps = steps.length;
		steps = steps - 1;


		/* append item to hold the % */
		jQuery('.frm_fields_container .frm_page_bar').append("<li class=\'progress\'>0%</li>");

		/*move bar out of form area and into the containing block
		jQuery(".frm_fields_container .frm_rootline_group").detach().addClass('big-bar').prependTo(
			'.form .inner-block-wrapper');
 */


		/*sticky it*/
		jQuery(".frm_rootline_group").stick_in_parent();



		//nav bottom
		jQuery('.frm_submit *').wrapAll("<div class='inner' />");
		jQuery(".hidden.user-guide").clone().appendTo(
			'.frm_submit .inner');

		jQuery(".frm_submit .inner .hidden.user-guide").removeClass('hidden');

		//jQuery('.frm_submit .inner').append("<a class=\'button user-guide\'>User Guide</a>");


		jQuery(document).on('frmPageChanged', function(event, form, response) {
			console.log('page change')

			/*clean up first

			jQuery('.big-bar').remove();
*/

			/* append item to hold the % */
			jQuery('.frm_fields_container .frm_page_bar').append("<li class=\'progress\'>0%</li>");


			/* % calculations */
			var steps = jQuery('.frm_page_bar').children();
			steps = steps.length;
			steps = steps -
				1;
			completedStep = 0;
			i = 0;
			jQuery('.frm_page_bar').children('li').each(function() {
				if (jQuery(this).hasClass('frm_current_page')) {
					; // "this" is the current element in the loop
					completedStep = i;
				}
				i++;
			});
			progress = ((completedStep / steps) * 100).toFixed(0);
			jQuery('.frm_page_bar .progress').text(
				progress + '%')


			/*move bar out of form area and into the containing block
			jQuery(".frm_fields_container .frm_rootline_group").detach().addClass('big-bar').prependTo(
				'.form .inner-block-wrapper');
*/

			/*sticky it*/
			jQuery(".frm_rootline_group").stick_in_parent();




			//nav bottom
			jQuery('.frm_submit *').wrapAll("<div class='inner' />");
			jQuery(".hidden.user-guide").clone().appendTo(
				'.frm_submit .inner');

			jQuery(".frm_submit .inner .hidden.user-guide").removeClass('hidden');
		});



		jQuery(document).on('frmFormComplete', function(event, form, response) {

			jQuery('.frm_submit *').wrapAll("<div class='inner' />");
			jQuery(".hidden.user-guide").clone().appendTo(
				'.frm_submit .inner');
			jQuery(".frm_submit .inner .hidden.user-guide").removeClass('hidden');
		});

		var visible = jQuery('#colophon').visible(true, false, 'vertical');
		if (visible) {
			jQuery('.frm_submit').removeClass('pin-down');
		} else {
			jQuery('.frm_submit').addClass('pin-down');
		}
		jQuery(window).scroll(function() {
			visible = jQuery('#colophon').visible(true, false, 'vertical');
			if (visible) {
				jQuery('.frm_submit').removeClass('pin-down');
			} else {
				jQuery('.frm_submit').addClass('pin-down');
			}
		});
	});
	</script>
</section>