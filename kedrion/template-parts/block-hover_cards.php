<?php
        /**
        * Template part for displaying a Hover cards.
        */

	   wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/min/jquery.matchHeight-min.js', array( 'jquery' ), '', false );
        ?>
<section class="block hover_cards numbered-<?php the_sub_field( 'numbered_cards' ); ?>">
	<div class="outer-block-wrapper">

		<div class="inner-block-wrapper">
			<h2>
				<?php the_sub_field( 'heading' ); ?>
			</h2>
			<?php if ( have_rows( 'cards' ) ) : ?>
			<div class="cards">
				<?php while ( have_rows( 'cards' ) ) : the_row(); ?>
				<div class="card">
					<div class="front">
						<?php $image = get_sub_field( 'image' );

						$image_url = $image['url']; ?>

						<div class="image" style="background-image: url(<?php echo $image_url; ?>)">

						</div>

						<?php $icon = get_sub_field( 'icon' ); ?>
						<?php if ( $icon ) { ?>
						<img class='icon' src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
						<?php } ?>
						<div class="label"><?php the_sub_field( 'label' ); ?></div>
					</div>
					<div class="hover">
						<?php $link = get_sub_field( 'link' ); ?>
						<?php if ( $link ) { ?>
						<a class='link' href="<?php echo $link['url']; ?>"
							target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
						<?php } ?>
						<div class="copy">
							<?php the_sub_field( 'card_copy' ); ?>
						</div>
					</div>
				</div>


				<?php endwhile; ?>
			</div>

			<?php endif; ?>
		</div>
	</div>
	<script>
	jQuery(function() {
		jQuery('.front, .hover').matchHeight({
			property: 'height',
			byRow: true
		});


	});
	</script>
</section>