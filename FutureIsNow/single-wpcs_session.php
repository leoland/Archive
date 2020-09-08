<?php
/**
 * The template for displaying the single session posts
 *
 * @package wp_conference_schedule
 * @since 1.0.0
 */

get_header(); ?>
<?php $current_year_ids = get_field( 'current_year', 'option' );
$current_session_id = get_the_ID( );

?>
<section id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="outer-block-wrapper">
				<!-- extend with needed container -->
				<div class="inner-block-wrapper">
					<header class="entry-header">

						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						<div class="entry-meta">
							<?php

							$time_format      = get_option( 'time_format', 'g:i a' );
							$post             = get_post();
							$session_time     = absint( get_post_meta( $post->ID, '_wpcs_session_time', true ) );
							$session_end_time = absint( get_post_meta( $post->ID, '_wpcs_session_end_time', true ) );
							$session_date     = ( $session_time ) ? date( 'F j, Y', $session_time ) : date( 'F j, Y' );
							$session_type     = get_post_meta( $post->ID, '_wpcs_session_type', true );
							$session_speakers = get_post_meta( $post->ID, '_wpcs_session_speakers',  true );

							// Check if end time is available. This is for pre version 1.0.1 as the end time wasn't available.
							/*
							if($session_date && !$session_end_time)
								echo '<h2> '.$session_date.' at '.date($time_format, $session_time).'</h2>';

							if($session_date && $session_end_time)
								echo '<h2> '.$session_date.' from '.date($time_format, $session_time).' to '.date($time_format, $session_end_time).'</h2>';



							echo strip_tags(get_the_term_list( $post->ID, 'wpcs_track', '<strong>Track:</strong> ', ', ', '<br />'),  '<br><strong>');


							echo strip_tags(get_the_term_list( $post->ID, 'wpcs_location', '<strong>Location:</strong> ', ', ', '<br />'),  '<br><strong>');

*/


								echo '<strong>Speaker:</strong> ';
							?>


							<!--start nonsense -->
							<?php

$args = array(

				'orderby' => 'meta_value',
				'post_type' => 'speaker',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'event',
						'field' => 'term_id',
						'terms' => $current_year_ids,
					),

				),
			);
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) {?>
							<span class="speakers">

								<?php
while ($the_query->have_posts()) {$the_query->the_post();


$speaker_link = get_permalink( );
$first_name = get_field( 'first_name' );
$last_name = get_field( 'last_name' );


	$sessions = get_field( 'sessions' );
	 if ( $sessions ):
								 foreach ( $sessions as $post ):
								 setup_postdata ( $post );
if (get_the_ID( ) == $current_session_id){ ?>
								<a href="<?php echo $speaker_link?>" id=""
									class="speaker"><?php echo $first_name ." " . $last_name; ?>
								</a>
								<?php }endforeach; ?>
								<?php wp_reset_postdata(); ?>

								<?php endif; ?>

								<?php
}?>

								<?php
}
wp_reset_postdata();
?>



								<!--end nonsense-->






						</div><!-- .meta-info -->

					</header>

					<div class="entry-content">
						<?php the_content();?>
					</div><!-- .entry-content -->
				</div>
			</div>
		</article><!-- #post-${ID} -->

		<?php

			endwhile; // End of the loop.
			?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer();