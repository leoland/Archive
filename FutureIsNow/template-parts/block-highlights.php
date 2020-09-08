<?php
/**
 * Template part for displaying a Highlights.
 */
wp_enqueue_script('match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', 'jquery', '', false);

?>
<section class="block highlights">
	<div class="outer-block-wrapper">
		<div class="inner-block-wrapper">

			<?php if ( have_rows( 'highlights' ) ) : ?>
			<?php while ( have_rows( 'highlights' ) ) : the_row(); ?>
			<?php $background_image = get_sub_field('background_image' ); ?>
			<div class="single-highlight" style="background-image: url(<?php echo $background_image['url']; ?>)">

				<div class="copy bg-<?php the_sub_field( 'bg_color' );?>"><?php the_sub_field( 'highlight_copy' ); ?>
				</div>

			</div>


			<?php endwhile; ?>
			<?php endif?>

		</div>
	</div>
	<script>
	jQuery(function() {
		jQuery('.single-highlight .copy').matchHeight({
			property: 'height',
			byRow: true,
		});
	});
	</script>
</section>