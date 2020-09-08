<?php
/**
 * Template part for displaying a Stats.
 */

wp_enqueue_script('counter-up', get_template_directory_uri() . '/assets/js/min/jquery.counterup-min.js', array('jquery'), '1', false);
wp_enqueue_script('waypoint', get_template_directory_uri() . '/assets/js/min/waypoints.min.js', '', '1', true);
?>
<section class="block stats bg-<?php the_sub_field('background_color');?> ">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->


			<?php if (have_rows('stats')): ?>

			<div class="stats">
				<?php
while (have_rows('stats')): the_row();

    $pre = get_sub_field('prefix');
    $suffix = get_sub_field('suffix');
    $label = get_sub_field('label');
    $acc_color = get_sub_field('accent_color');
    $number = get_sub_field('number');?>

				<div class="single-stat">
					<div class="number">


						<?php if ($pre) {?>
						<div class="prefix">
							<?php echo $pre; ?>
						</div>
						<?php }?>
						<div class="counter">
							<?php echo $number; ?>
						</div>
						<?php if ($suffix) {?>
						<div class="suffix">
							<?php echo $suffix; ?>
						</div>
						<?php }?>
					</div>
					<div class="label accent-<?php echo $acc_color; ?>">
						<?php echo $label; ?>
					</div>
				</div>
				<?php
endwhile;
?> </div><?php
endif;
?>
		</div>
	</div>

	<script>
	window.onload = function() {
		jQuery('.single-stat .counter').counterUp({
			delay: 10,
			time: 4000
		});
	};
	</script>
</section>