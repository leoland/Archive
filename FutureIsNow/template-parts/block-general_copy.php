<?php
/**
 * Template part for displaying a General copy.
 */

$style = get_sub_field('background_style');
$background_color = get_sub_field('block_background_color');
$background_image = get_sub_field('bg_image');
$copy = get_sub_field('copy_color');
if ($background_image) {
    $background_image_url = $background_image['url'];
}

$background_opacity = get_sub_field('bgco');

$block_title = get_sub_field('block_heading');

?>



<section class="block general_copy
<?php the_sub_field('block_background_color');?>
 style-<?php echo $style; ?>
 bg-<?php echo $background_color; ?>
 default-copy-<?php echo $copy;
if ($background_image_url) { ?>
 has-background-image  <?php }?>
" style="<?php

if ($background_image_url) {?>
		background-image: url('<?php echo $background_image_url; ?>'); background-size: cover;
		background-position: center; <?php }?>

">



	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">




			<div class="copy-content">
				<?php the_sub_field('general_copy');?>
			</div>


		</div>
	</div>
</section>