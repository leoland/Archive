<?php
/**
 * Template part for displaying a Speakers.
 */

$background = get_sub_field('background_color');
$filter_ids = get_sub_field('filter');
?>


<section class="block speakers type-grid bg-<?php echo $background; ?>">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper">
			<!-- probably extend with row or -->
			<!-- Stuff goes here -->
			<?php
/*
			$args = array(
			    'orderby' => 'meta_value',
			    'meta_key' => 'ifk_speaker_last_name',
			    'post_type' => 'speakers',
			    'order' => 'ASC',
			    'tax_query' => array(
			        array(
			            'taxonomy' => 'speaker-category',
			            'field' => 'term_id',
			            'terms' => $filter_ids,
			        ),

			    ),
			);
*/?>
			<div class="selected-speakers">

				<?php //start here


			$args = array(
				'post__not_in' => array($current_speaker_id),
				'orderby' => 'meta_value',
				'meta_key' => 'last_name',
				'post_type' => 'speaker',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'event',
						'field' => 'term_id',
						'terms' => $filter_ids,
					),

				),
				'meta_query' => array(
					array(
						'key'     => 'featured',
						'value'   => 1,
						'compare' => '=',
					)
				)
			);




			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) {?>


				<?php
while ($the_query->have_posts()) {$the_query->the_post();
    ?>
				<a href="<?php the_permalink();?>" id="" class="single-speaker">
					<div class="speaker-photo" style="background-image: url(<? echo get_the_post_thumbnail_url();  ?>)">
						<?php the_post_thumbnail('large');?>
					</div>
					<div class="speaker-info">
						<span class="first-name"><?php the_field( 'first_name' ); ?></span> <span
							class="last-name"><?php the_field( 'last_name' ); ?></span>

						<div class="title-info">
							<?php the_field( 'title' ); ?>
						</div>
					</div>
				</a>
				<?php
}?>

				<?php
}
wp_reset_postdata();
   //end here?>


				<?php //start here
			$args = array(
				'post__not_in' => array($current_speaker_id),
				'orderby' => 'meta_value',
				'meta_key' => 'last_name',
				'post_type' => 'speaker',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'event',
						'field' => 'term_id',
						'terms' => $filter_ids,
					),

				),
				'meta_query' => array(
					array(
						'key'     => 'featured',
						'value'   => 1,
						'compare' => '!=',
					)
				)
			);
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) {?>


				<?php
while ($the_query->have_posts()) {$the_query->the_post();
    ?>
				<a href="<?php the_permalink();?>" id="" class="single-speaker">
					<div class="speaker-photo" style="background-image: url(<? echo get_the_post_thumbnail_url();  ?>)">
						<?php the_post_thumbnail('large');?>
					</div>
					<div class="speaker-info">
						<span class="first-name"><?php the_field( 'first_name' ); ?></span> <span
							class="last-name"><?php the_field( 'last_name' ); ?></span>

						<div class="title-info">
							<?php the_field( 'title' ); ?>
						</div>
					</div>
				</a>
				<?php
}?>

				<?php
}
wp_reset_postdata();
   //end here?>





			</div>
		</div>
	</div>




	<?php if ($type == 'paged'): ?>
	<script>
	jQuery(document).ready(function() {
		jQuery('.type-paged .selected-speakers').each(function() {
			jQuery(this).slick({
				autoplay: false,
				dots: true,
				infinite: true,
				speed: 1000,
				slidesToShow: 3,
				slidesToScroll: 2,
				fade: false,
				cssEase: 'linear',
				responsive: [{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
					}
				}]
			})
		})

	})
	</script>
	<?php endif;?>
</section>