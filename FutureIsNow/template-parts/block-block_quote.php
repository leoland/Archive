<?php
/**
 * Template part for displaying a Block quote.
 */

$link = get_sub_field('link');
?>
<section class="block block_quote bg-<?php the_sub_field('background_color');?>">
	<div class="outer-block-wrapper">
		<div class="inner-block-wrapper">

			<div class="quote-wrapper ">

				<div class="inner-wrapper">
					<div class="block_quote__copy">
						<?php the_sub_field('quote_copy');?>
					</div>
					<div class="block_quote__source">
						<?php the_sub_field('source');?>
					</div>
				</div>
				<?php
if ($link) {?>
				<a class= "quote-link btn-primary" href="<?php echo $link['url']; ?>"
					target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
				<?php }?>
			</div>
		</div>
	</div>



</section>