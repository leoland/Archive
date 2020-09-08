<?php
        /**
        * Template part for displaying a Downloads.
        */
        ?>
<section class="block downloads">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->
			<!-- Stuff goes here -->
			<div class="intro">
				<?php the_sub_field( 'intro' ); ?>
			</div>
			<?php if ( have_rows( 'files' ) ) : ?>
			<div class="files">
				<?php while ( have_rows( 'files' ) ) : the_row(); ?>
				<div class="file">
					<div class="description">
						<?php the_sub_field( 'description' ); ?>
					</div>
					<?php $file = get_sub_field( 'file' ); ?>
					<?php if ( $file ) { ?>
					<a download href="<?php echo $file['url']; ?>">
						<?php if (get_sub_field( 'download_label' )){
							the_sub_field( 'download_label' );
						}
						else{
							echo 'Download '.$file['filename'];
						}
						?>
					</a>
					<?php } ?>
				</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</section>