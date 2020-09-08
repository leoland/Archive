<?php
/**
 * The template for displaying all single posts.
 *
 * @package Invest for Kids
 */

get_header();
$year ='';
$current_speaker_id = get_the_ID(  );
if (isset($_GET['Year'])){
$year= $_GET['Year'];
}
 $current_year_ids = get_field( 'current_year', 'option' ); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="post-<?php the_ID();?>" class="block general_copy style-<?php echo $style; ?> bg-grey">
			<div class="outer-block-wrapper">
				<!-- extend with needed container -->
				<div class="inner-block-wrapper">
					<?php while (have_posts()): the_post();?>
					<?php $current_speaker_id = get_the_ID()?>
					<div class="single-main">

					<?php if( has_term( $current_year_ids, 'event' ) ) { ?>
						<div class="single-speaker">
							<div class="speaker-photo"
								style="background-image: url(<? echo get_the_post_thumbnail_url();  ?>)">

							</div>
							<div class="speaker-info">
								<div class="first-name"><?php the_field( 'first_name' ); ?></div>
								<div class="last-name"><?php the_field( 'last_name' ); ?></div>
								<div class="title-info">
									<?php the_field( 'title' ); ?>
								</div>

								<div class="speaker-social social-links">
									<?php if ( have_rows( 'social_media' ) ) : ?>
									<?php while ( have_rows( 'social_media' ) ) : the_row(); ?>
									<a href="	<?php the_sub_field( 'url' ); ?>"
										><?php the_sub_field( 'social_icon' ); ?></a>
									<?php endwhile; ?>
									<?php endif; ?>
									<?php if (get_field('email')){?>
									<a href="mailto:<?php the_field( 'email' ); ?>" target="_blank">
										<i class="fas fa-envelope" aria-hidden="true"></i>
									</a>
									<?php }?>
								</div>
							</div>
						</div>
							<?php }
else{
	?>
<div class="sidebar archive-sidebar">
<span class="sidebar-title">Past Conferences</span>
<?php

$terms = get_terms( array(
    'taxonomy' => 'event',
	'hide_empty' => false,
	'order_by' => 'slug',
	'order' => 'desc',
) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ): ?>

    <ul class='years'>
	<?php foreach ( $terms as $term ):
	if ($current_year_ids != $term->term_id):
		if ($term->name == $year):
?>


	<li class="single-year "><span class="current"><?php echo $term->name; ?></span>
	<ul class="speaker-list">


	<?php


$args = array(

	'nopaging' => true,
				'post_type' => 'speaker',
				'tax_query' => array(
					array(
						'taxonomy' => 'event',
						'field' => 'name',
						'terms' => $year,
					),

				),
				'meta_query' =>  array(
					'relation' => 'AND',
					'featured' => array(
						'key' => 'featured',
									'compare' => 'EXISTS',
					),
					'last_name' => array(
						'key' => 'last_name',
						'compare' => 'EXISTS',
					),

				),
				'orderby' => array(
					'featured' => 'DESC',
					'last_name' => 'ASC',

				),
			);



 $the_query = new WP_Query($args);
			if ($the_query->have_posts()) :

while ($the_query->have_posts()) :$the_query->the_post();
    ?>

<li>

<a class="speaker-link <?php if (  get_the_id() == $current_speaker_id) { echo 'current-speaker'; }?>" href="

<?php if (  get_the_id() != $current_speaker_id) {
	echo esc_url( add_query_arg( 'Year', $year, get_permalink() ) );

 }?>
<?php ?>

"> <span class="first-name"><?php the_field( 'first_name' ); ?></span> <span
							class="last-name"><?php the_field( 'last_name' ); ?></span></a>


</li>
			<?php endwhile;?>
			<?php endif;?>
			<?php wp_reset_postdata(); ?>
	</ul>

</li>
<?php
	else: ?>
		<li class="single-year "><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo $term->name; ?></a></li>

	<?php endif; ?>
	<?php endif;
?>
	<?php endforeach; ?>

    </ul>
<?php endif;
?>

</div>

<?php }
?>

					</div>
					<div class="full-details">


						<?php $sessions = get_field( 'sessions' ); ?>
						<?php if ( $sessions ): ?>
						<div class="session-info">
							<?php foreach ( $sessions as $post ):  ?>
							<?php setup_postdata ( $post ); ?>
							<?php

if (($year && (has_term( $year, 'event' ) )) || (!$year && has_term( $current_year_ids, 'event' ))) {
 ?>
	<div class="session-details">


<h2 class="session-title purple">
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h2>
<div class="session-content">
	<?php the_content( ); ?>
</div>
</div>
<?php
};
?>





							<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
						</div>
						<?php endif; ?>


						<div class="speaker-bio">
							<h2 class="purple">Speaker Bio</h2>

<?php
							if ($year){ ?>





							<div class="photo"
								style="background-image: url(<? echo get_the_post_thumbnail_url();  ?>)">

							</div>

<?php 		}?>

							<?php the_content();?>
						</div>


					</div>

				</div>
				<div class="speakers-cta">
				<?php if( has_term( $current_year_ids, 'event' ) ) { ?>


<a href="/2020-speakers" class="btn-solid all-speakers">All Speakers</a>

							<?php }
else{
	?>
<a href="<?php echo get_home_url( ). '/event/' . $year; ?>" class="btn-solid back-to-event">Back to <?php echo $year; ?></a>

<?php }
?></div>
			</div>


		</section>
		<?php endwhile; // End of the loop. ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();?>