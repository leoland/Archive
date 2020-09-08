<?php
/**
 * Template part for displaying a Three column callout.
 */
wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array( 'jquery' ), '', false );
$block_heading = get_sub_field('heading');

?>




<section class="block three_column_callout <?php the_sub_field('background_color');?>">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->
			<?php
if ($block_heading) {
    ?>
			<h2 class="block-heading">
				<?php

    echo $block_heading;

    ?>
			</h2>
			<?php
}
?>

			<?php if (have_rows('callouts')): ?>
			<div class="callouts">
				<?php while (have_rows('callouts')): the_row();?>
				<div class="callout-col">
					<?php $callout_heading = get_sub_field('heading');?>
					<?php
    if ($block_heading) {
        ?>
					<h3 class="callout-heading">
						<?php
    echo $callout_heading;
        ?>
					</h3>
					<?php
    } else {
        ?>
					<h2 class="callout-heading">
						<?php
    echo $callout_heading;
        ?>
					</h2><?php
    }
	?>
					<div class="callout-copy">
						<?php the_sub_field('copy');?>
					</div>


					<?php $button_link = get_sub_field('button_link');?>
					<?php if ($button_link) {?>
					<div class="button-area">
						<a href="<?php echo $button_link['url'];?>" class="btn-primary"
							target="<?php echo $button_link['target']; ?>"><?php echo $button_link['title']; ?></a>

						<?php $button_icon = get_sub_field('button_icon');?>
						<?php if ($button_icon) {?>
						<div class="button-icon">

							<img src="<?php echo $button_icon['url']; ?>" alt="<?php echo $button_icon['alt']; ?>" />
						</div>
						<?php }?>
						<?php }?>
					</div>
				</div>

				<?php endwhile;?>
			</div>
			<?php endif;?>
			<?php if (get_sub_field( 'small_copy' )){ ?>
			<div class="small-copy">
				<?php the_sub_field( 'small_copy' ); ?>
			</div>

			<?php } ?>


		</div>
	</div>
	<script>
	jQuery(function() {
		jQuery('.callout-heading').matchHeight({
			property: 'height',
			byRow: true
		});


	});
	</script>
</section>