<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ch2
 */

get_header();

wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/sass/slick.css');
wp_enqueue_style('slick-css-theme', get_template_directory_uri() . '/assets/sass/slick-theme.css');

?>

<?php
  // This sets out a variable called $term - we'll use it ALOT for what we're about to do.
$this_term = get_term_by( 'slug', get_query_var( 'event' ), get_query_var( 'taxonomy' ) );

/*
The following is for setting up ACF taxonomy fields
*/
// Define taxonomy prefix
// Replace NULL with the name of the taxonomy eg 'category'
$taxonomy_prefix = $this_term->taxonomy;

// Define term ID
// Replace NULL with ID of term to be queried eg '123'
$term_id = $this_term->term_id;

// Define prefixed term ID
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>



<div id="primary" class="content-area">
<div class="sidebar archive-sidebar">
<span class="sidebar-title">Past Conferences</span>
<?php



$terms = get_terms( array(
    'taxonomy' => 'event',
	'hide_empty' => false,
	'order_by' => 'slug',
	'order' => 'desc'
) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ): ?>
    <ul class='years'>
	<?php $current_year_ids = get_field( 'current_year', 'option' ); ?>
	<?php foreach ( $terms as $term ):
if ($current_year_ids != $term->term_id):
	 if($term->name  == $this_term->name)
{?>
	<li class="single-year "><span class="current-year"><?php echo $term->name; ?></span>
	<ul class="speaker-list">
	<?php $post_object = get_field( 'additional', $term_id_prefixed ); ?>
<?php if ( $post_object ): ?>
	<?php $post = $post_object; ?>
	<?php setup_postdata( $post ); ?>
	<li>
				<a class="speaker-link" href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>


</li>

<?php endif; ?>
	<?php

	while (have_posts()) : the_post(); ?>


<li>


							<a class="speaker-link" href="<?php echo esc_url( add_query_arg( 'Year', $term->name, get_permalink() ) );?>"> <span class="first-name"><?php the_field( 'first_name' ); ?></span> <span
							class="last-name"><?php the_field( 'last_name' ); ?></span></a>


</li>
    <?php endwhile; ?>
	</ul>

</li>
<?php	} else {?>
	<li class="single-year "><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo $term->name; ?></a></li>
<?php }?>
<?php endif; ?>
    <?php endforeach; ?>
    </ul>
<?php endif;
?>
<?php wp_reset_postdata(); ?>

</div>
    <main id="main" class="site-main" role="main">

<!-- See how we used the variable to let Wordpress know we want to display the title of the taxonomy? -->
<h1>The Future Is Now <?php echo $this_term->name; ?></h1>
<div class="intro-area">
<?php the_field( 'intro_text', $term_id_prefixed ); ?>



<?php $report = get_field( 'report', $term_id_prefixed ); ?>
<?php if ( $report ) { ?>
	<a class="btn-primary"href="<?php echo $report['url']; ?>"><?php

		if (get_field( 'report_label', $term_id_prefixed )){ the_field( 'report_label', $term_id_prefixed ); } else{ echo  $report['filename'];} ?></a>
<?php } ?>

</div>

<!-- Speakers -->
<div class="speakers">
<h2 class=speaker-area-title><?php echo $this_term->name; ?> Speakers</h2>

<div class="selected-speakers">


<?php $speaker_num = 0 ;




while (have_posts()) : the_post(); ?>


<div class="single-speaker" id="speaker-<?php echo ++$speaker_num ?>">
					<div class="speaker-photo" style="background-image: url(<? echo get_the_post_thumbnail_url();  ?>)">
					<a class="photo-link" href="<?php echo esc_url( add_query_arg( 'Year', $this_term->name, get_permalink() ) );?>">
						<?php the_post_thumbnail('large');?>
					</a>
					</div>
					<div class="speaker-info">
						<span class="first-name"><?php the_field( 'first_name' ); ?></span> <span
							class="last-name"><?php the_field( 'last_name' ); ?></span>


<?php if (get_field('title')){ ?>
						<div class="title-info">
							<?php the_field( 'title' ); ?>
						</div>
<?php }; ?>



							<a class="archive-link" href="<?php echo esc_url( add_query_arg( 'Year', $this_term->name, get_permalink() ) );?>">Read More</a>

					</div>
</div>
	<?php endwhile;

	remove_action( 'pre_get_posts', 'custom_get_posts' );
	?>


</div>
</div>

<?php if ( have_rows( 'photos', $term_id_prefixed ) ) : ?>
<div class="photo-area">
<h2>Photos</h2>


<div class="images-wrapper">
                <div class="image-slider">
	<?php while ( have_rows( 'photos', $term_id_prefixed ) ) : the_row(); ?>
		<?php $photo = get_sub_field( 'photo' ); ?>
		<?php if ( $photo ) { ?>
			<div class="slide-wrapper">
			<div class="slide-image">
			<img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['alt']; ?>" />
			</div>
			</div>
		<?php } ?>
	<?php endwhile; ?>
		</div>
		</div>
		</div>
<?php endif; ?>


</div>




                </div>



    </main>


	<script>
	jQuery(document).ready(function() {
		console.log('slider');
		jQuery('.image-slider').each(function() {
			jQuery(this).slick({
				infinite: true,
				speed: 700,
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: false,
				cssEase: 'ease-in-out',
				autoplay: false,
				arrows: true,
				dots: false,

			})
		})
	});
	</script>
</div>

<?php get_footer();
