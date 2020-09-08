<?php
/**
 * Block template file: template-parts/blocks/featured-posts.php
 *
 * Featured Posts Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'featured-posts-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-featured-posts';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php the_field( 'headline' ); ?>
	<?php the_field( 'copy' ); ?>
	<?php $posts = get_field( 'posts' ); ?>
	<?php if ( $posts ): ?>
		<?php foreach ( $posts as $post ):  ?>
			<?php setup_postdata ( $post ); ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<?php endforeach; ?>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>