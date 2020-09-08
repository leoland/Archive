<?php
        /**
        * Template part for displaying a Card callout.
        */

	   wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array( 'jquery' ), '', false );
        ?>
<section class="block card_callout <?php the_sub_field( 'background_color' ); ?>">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->


			<?php if ( have_rows( 'callouts' ) ) : ?>

			<div class="callouts">
				<?php while ( have_rows( 'callouts' ) ) : the_row(); ?>
				<div class="callout">
					<div class="card">

						<a href="	<?php the_sub_field( 'callout_link_target' ); ?>

"><?php the_sub_field( 'main_text' ); ?></a>



					</div>
					<div class="side-text">
						<?php the_sub_field( 'side_text' ); ?>
					</div>
				</div>



				<?php endwhile; ?>

			</div>

			<?php endif;?>
		</div>
	</div>





	<script>
	jQuery(function() {
		jQuery('.callout .card').matchHeight({
			property: 'height',

		});


	});
	</script>
</section>