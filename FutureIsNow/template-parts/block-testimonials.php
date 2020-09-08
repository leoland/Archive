<?php
        /**
        * Template part for displaying a Testimonials.
		*/

		wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/sass/slick.css');

    wp_enqueue_style('slick-css-theme', get_template_directory_uri() . '/assets/sass/slick-theme.css');
        ?>
<section class="block testimonials">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->



			<?php if ( have_rows( 'testimonials' ) ) : ?>
			<div class="testimonials-slider">
				<?php while ( have_rows( 'testimonials' ) ) : the_row(); ?>
				<div class="single-testimonial">
					<?php $accompanying_image = get_sub_field( 'accompanying_image' ); ?>
					<?php if ( $accompanying_image ) { ?>
					<img src="<?php echo $accompanying_image['url']; ?>"
						alt="<?php echo $accompanying_image['alt']; ?>" />
					<?php } ?>
					<div class="content">
						<div class="copy">
							<?php the_sub_field( 'copy' ); ?>
						</div>
						<div class="source">
							<?php the_sub_field( 'source' ); ?>
						</div>

					</div>
				</div>

				<?php endwhile; ?>


			</div>

			<?php endif; ?>
		</div>
	</div>
	<script>
	jQuery(document).ready(function() {
		jQuery('.testimonials-slider').each(function() {
			jQuery(this).slick({
				infinite: true,
				speed: 1000,
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: false,
				cssEase: 'linear',
				autoplay: false,
				arrows: true,
				dots: false,

			})
		})
	});
	</script>
</section>