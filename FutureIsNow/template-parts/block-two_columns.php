<?php
/**
 * Template part for displaying a Two columns.
 */

$collapse = the_sub_field('collapsible');
$background_color = get_sub_field('block_background_color');
if ($background_image) {
    $background_image_url = $background_image['url'];
}
$background_opacity = get_sub_field('bgco');

$block_title = get_sub_field('block_heading');
?>
<section
	class="block two_columns cva-<?php the_sub_field( 'cva' ); ?><?php the_sub_field('block_style');?> width-<?php the_sub_field( 'width' ); ?> narrow-<?php the_sub_field( 'narrow' );?> bg-<?php echo $background_color; ?> <?php the_sub_field('image_placement');?>"
	<?php if ($background_image_url) {?> style="background-image: url('<?php echo $background_image_url; ?>'); background-size: cover;
												background-position: center;" <?php }?>>
	<div class=" outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- extended with .row -->
			<?php $intro = get_sub_field( 'intro_copy' );
			if($intro){?>
			<div class="intro-copy">

				<?php echo $intro;?>
			</div>
			<?php			} ?>


			<div class="columns-wrapper">
				<?php if (have_rows('columns')):
    while (have_rows('columns')): the_row();
        $column_bg_color = get_sub_field('background_color');
		$background_image = get_sub_field('background_image');

        if ($background_image) {
            $background_image_url = $background_image['url'];
        } else {
            $background_image_url = '';
        }
        ?>
				<div class="col col-bg-<?php echo $column_bg_color; ?>">

					<div class="bg-wrapper " style=" <?php if ($background_image_url) {?>
								background-image: url('<?php echo $background_image_url; ?>'); background-size: cover;
																				background-position: center; <?php }?>">
					</div>
					<div class="copy"><?php the_sub_field('column_copy');?></div>


				</div>

				<?php endwhile;?>
				<?php endif;?>
			</div>
		</div>
	</div>

	<script>
	/*
	jQuery(function() {
		jQuery('.columns-wrapper .inner-wrapper').matchHeight({
			property: 'height',
			byRow: true,
		});
	});
	*/
	</script>
</section>