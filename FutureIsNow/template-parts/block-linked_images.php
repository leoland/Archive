<?php
/**
 * Template part for displaying a Linked images.
 */

$label = get_sub_field('label');
$background_color = get_sub_field('background_color');

?>
<section class="block linked_images bg-<?php echo $background_color; ?>">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->




			<?php if (have_rows('links')): ?>
			<div class="links">
				<?php while (have_rows('links')): the_row();?>
				<?php $link = get_sub_field('link');?>
				<?php if ($link) {?>
				<div class="link">
					<a href="<?php echo $link['url']; ?>"
						target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
					<?php }?>
					<?php $image = get_sub_field('image');?>
					<?php if ($image) {?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php }?>
				</div>
				<?php endwhile;?>
			</div>
			<?php endif;?>





		</div>
	</div>
</section>