<?php
/**
 * Template part for displaying a General copy.
 */




//wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/assets/js/min/jquery.sticky-kit.min.js', array( 'jquery' ), '', true );

wp_enqueue_script( 'double-scroll', get_template_directory_uri() . '/assets/js/jquery.doubleScroll.js', array( 'jquery' ), '', true );




?>
<section
	class="block general_copy <?php the_sub_field( 'background_color' ); ?> <?php the_sub_field( 'content_width' ); ?>">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->
			<!-- Stuff goes here -->
			<div class="content">
				<?php the_sub_field( 'general_copy' ); ?>
			</div>
		</div>
	</div>






	<script>
	jQuery(document).ready(function() {
		jQuery('.wide table').doubleScroll({
			resetOnWindowResize: true,
			onlyIfScroll: true, // top scrollbar is not shown if the bottom one is not present
			scrollCss: {
				'overflow-x': 'auto',
				'overflow-y': 'auto'
			},
			contentCss: {
				'overflow-x': 'auto',
				'overflow-y': 'auto'
			},
		});
	});
	</script>
</section>