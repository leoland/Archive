<?php
/**
 * Block template file: template-parts/blocks/events/events.php
 *
 * Events Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'events-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-events';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$bbgc = get_field( 'bbgc' ); 
if( !empty( $bbgc ) ) {
    $classes .= ' bg-' . $bbgc;
}
$classes .= ' helio-block';
 $blocktype = get_field( 'block_type' ); 
 if( !empty(  $blocktype ) ) {
    $classes .= ' events-' .  $blocktype;
}
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">

	<?php 
	if ($blocktype == 'archive'): ?>

	<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
$date_now = date('Y-m-d H:i:s');
$args = array(
  'post_type' => array('event'), 
  'category__not_in' => array('1'), 
  'post_status' => 'publish', 
  'order' => 'ASC', 
  'orderby' => 'meta_value',
  'meta_key'			=> 'date',
  'meta_type'      => 'DATETIME',
  'meta_query' => array(
	array(
		'key'           => 'date',
		'compare'       => '>=',
		'value'         => $date_now,
		'type'          => 'DATETIME',
	)
),
  'posts_per_page' => 10, 
  'paged' => $paged, 
);

// WP_Query
$eq_query = new WP_Query( $args );
if ($eq_query->have_posts()) : // The Loop
?>
	<div class="wrap">

		<?php 
while ($eq_query->have_posts()): $eq_query->the_post();
$p = get_the_ID(  );
?>



		<div class="event-single">
			<?php $terms = get_the_terms( $p, 'event_categories' );
		$term = $terms[0];
// Define taxonomy prefix
// Replace NULL with the name of the taxonomy eg 'category'
$taxonomy_prefix = 'event_categories';

// Define term ID
// Replace NULL with ID of term to be queried eg '123' 
$term_id = $term->term_id;

// Define prefixed term ID
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>





			<div class="event-category"
				style="background-color: <?php the_field( 'category_color', $term_id_prefixed ); ?> ">
				<?php $category_icon = get_field( 'category_icon', $term_id_prefixed ); ?>
				<?php if ( $category_icon ) { ?>
				<img src="<?php echo $category_icon['url']; ?>" alt="<?php echo $category_icon['alt']; ?>" />
				<?php } ?>
				<div class="term-name">
					<?php echo $term->name; ?>
				</div>
			</div>
			<div class="event-info-wrapper">

				<h2 class="event-name">
					<?php echo get_the_title( $p ); ?>
				</h2>
				<div class="event-info">
					<span class="date"><?php the_field( 'date', $p ); ?></span> | <span
						class="location"><?php the_field( 'location', $p ); ?></span>
				</div>

				<div class="description">
					<?php the_field( 'event_description', $p ); ?>
				</div>
				<a class="read-more button-alt-solid" href="<?php echo get_permalink( $p ); ?>">View More</a>

			</div>
		</div>

		<?php endwhile; wp_reset_query(); ?>

	</div>
	<?php endif; ?>


	<?php else: ?>
	<div class="intro">
		<h2>
			<?php the_field( 'headline' ); ?>
		</h2>
		<div class="copy">
			<?php the_field( 'copy' ); ?>
		</div>

	</div>

	<?php $counter = 3; ?>
	<?php $events = get_field( 'events' ); ?>
	<?php if ( $events ): ?>
	<div class="event-list">
		<?php foreach ( $events as $p ): ?>
		<div class="event-single">
			<?php $terms = get_the_terms( $p, 'event_categories' );
		$term = $terms[0];
// Define taxonomy prefix
// Replace NULL with the name of the taxonomy eg 'category'
$taxonomy_prefix = 'event_categories';

// Define term ID
// Replace NULL with ID of term to be queried eg '123' 
$term_id = $term->term_id;

// Define prefixed term ID
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>





			<div class="event-category"
				style="background-color: <?php the_field( 'category_color', $term_id_prefixed ); ?> ">
				<?php $category_icon = get_field( 'category_icon', $term_id_prefixed ); ?>
				<?php if ( $category_icon ) { ?>
				<img src="<?php echo $category_icon['url']; ?>" alt="<?php echo $category_icon['alt']; ?>" />
				<?php } ?>
				<div class="term-name">
					<?php echo $term->name; ?>
				</div>
			</div>
			<div class="event-info">
				<span class="date"><?php the_field( 'date', $p ); ?></span> | <span
					class="location"><?php the_field( 'location', $p ); ?></span>
			</div>
			<div class="event-name">
				<?php echo get_the_title( $p ); ?>
			</div>

			<a class="read-more arrow-link" href="<?php echo get_permalink( $p ); ?>">Read More</a>


		</div>

		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
		<?php endif; ?>


	</div>
	<?php endif ?>
</div>