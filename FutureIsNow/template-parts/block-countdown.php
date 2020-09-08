<?php
        /**
        * Template part for displaying a Countdown.
        */



	   wp_enqueue_script('Countdown', get_template_directory_uri() . '/assets/js/min/dscountdown.min.js', array('jquery'), '', true);
        ?>


<?php $intro = get_sub_field( 'intro_text' ); ?>
<?php $countdown = get_sub_field( 'date_to_count_to' ); ?>
<section class="block countdown">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->
			<!-- Stuff goes here -->


			<h2 class="intro-text">
				<?php echo $intro ;?>
			</h2>
			</br>




			<div class="clock">

			</div>

		</div>
	</div>

	<script>
	jQuery(document).ready(function() {
		jQuery('.clock').dsCountDown({
			endDate: new Date("<?php echo $countdown ;?>")
		});
	});
	</script>
</section>