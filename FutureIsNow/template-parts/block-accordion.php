<?php
	/**
	 * Template part for displaying a Accordion.
	 */

	wp_enqueue_script( 'a11yaccordion', get_template_directory_uri() . '/assets/js/aria.accordion.min.js', array(), '20170303', true );
?>
<section class="block accordion">
	<div class="outer-block-wrapper">
		<div class="inner-block-wrapper">
			<h2 class="accordion-heading teal-ul purple"><?php the_sub_field( 'accordion_h' ); ?></h2>
			<?php if ( have_rows( 'Sections' ) ) : ?>
			<div class="accordion-wrapper" data-aria-accordion>
				<?php while ( have_rows( 'Sections' ) ) : the_row();
						$acc__heading = get_sub_field( 'heading' );
						$acc__copy    = get_sub_field( 'copy' );
						?>
				<h3 class="accordion__header" data-aria-accordion-heading> <?php echo $acc__heading; ?> </h3>
				<div class="accordion__panel" data-aria-accordion-panel>
					<?php echo $acc__copy; ?>
				</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>