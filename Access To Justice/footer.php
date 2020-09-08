<?php
/**
 * Site Footer
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/
?>
</div>

<footer class="site-footer" role="contentinfo">
	<div class="wrap">
		<div class="footer-one">
			<?php $footer_logo = get_field( 'footer_logo', 'option' ); ?>
			<?php if ( $footer_logo ) { ?>
			<a class="footer-home-link" href="<?php echo get_home_url(); ?>"> <img
					src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>" />
			</a>

			<?php } ?>
		</div>
		<div class="footer-two">
			<?php $newsletter_id = get_field( 'newsletter', 'option' ); 
if ($newsletter_id): ?>
			<?php echo gravity_form( $newsletter_id, true, true, false, '', false ); ?>
			<?php endif; ?>
		</div>
		<div class="footer-three">
			<h3>Careers</h3>
			<?php the_field( 'carreers_text', 'option' ); ?>
			<?php $careers = get_field( 'careers', 'option' ); ?>
			<?php if ( $careers ) { ?>
			<a class="careers-button" href=" <?php echo $careers['url']; ?>"
				target="<?php echo $careers['target']; ?>"><?php echo $careers['title']; ?></a>
			<?php } ?>
		</div>
		<div class="footer-bottom">
			<div class="wrapper">
				<p>The information and resources on this website are not legal advice. If you need legal advice, you
					must speak with a lawyer. This website is for informational purposes only and you must follow all
					requirements found in the Illinois Supreme Court Rules.</p>
				<div class="small">
					<?php $small_text = get_field( 'footer_small_text', 'option' ); 
				if (!$small_text) echo 'Copyright © ' . date("Y") . ' ATJ. All rights reserved ';
				else echo $small_text . ' ';
				?>
				</div>
				<div class="bottom-links">
					<?php $privacy_policy_url = get_field( 'privacy_policy', 'option' ); 
					if ($privacy_policy_url): ?>
					<a href="<?php echo $privacy_policy_url; ?>">Privacy Policy</a>
					<?php endif?>
				</div>

			</div>
		</div>
	</div>
</footer>


</div>
<?php

wp_footer();


?>
<script>
jQuery(document).ready(function() {
	jQuery(document).on('facetwp-refresh', function() {
		jQuery('.facetwp-template').animate({
			opacity: 0
		}, 1000);
	});
	jQuery(document).on('facetwp-loaded', function() {
		jQuery('.facetwp-template').animate({
			opacity: 1
		}, 1000);
	});
});



jQuery(document).ready(function() {
	jQuery('.large_dropdown > .sub-menu').parent().hover(function() {
		console.log('You Hovered');
		var menu = jQuery(this).find(".menu-depth-1");
		var menupos = jQuery(menu).offset();
		var menuwidth = jQuery(menu).width();
		console.log(menupos);
		if (menupos.left < 0) {
			var margin = menupos.left * -1;
			console.log('too far left');
			console.log(margin);
			margin = margin + 'px';
			menu.css({
				marginLeft: margin
			})
		}

		if (menupos.left + menu.width() > jQuery(window).width()) {
			var wiggle = jQuery(window).width() - menu.width();
			var margin = (menupos.left * -1) + wiggle;
			console.log('too far right');
			console.log(margin);
			margin = margin + 'px';
			menu.css({
				marginLeft: margin
			})
		}


	});

	jQuery('.large_dropdown > .sub-menu').parent().mouseleave(function() {
		console.log('You Hovered');
		var menu = jQuery(this).find(".menu-depth-1");


		menu.css({
			marginLeft: "0px"
		})




	});
});
</script>
</body>

</html>

<?php


/* 

currently unused but useful footer hooks these were not nessesary for the ATJ build however they can be very helpful if the footer is desired as a widgetized area instead. see site-footer.php
tha_footer_before();
tha_footer_top();
tha_footer_bottom();
tha_footer_after();
tha_body_bottom();
*/