<?php
/**
 * Block template file: template-parts/blocks/two-column.php
 *
 * Two Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'two-column-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-two-column';
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
?>


<style type="text/css">
<?php echo '#'. $id;

?> {
	/* Add styles that use ACF values here */
}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php the_field( 'bbgc' ); ?>
	<?php the_field( 'align' ); ?>
	<?php if ( have_rows( 'columns' ) ): ?>
	<?php while ( have_rows( 'columns' ) ) : the_row(); ?>
	<?php if ( get_row_layout() == 'image' ) : ?>
	<?php $image = get_sub_field( 'image' ); ?>
	<?php if ( $image ) { ?>
	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
	<?php } ?>
	<?php elseif ( get_row_layout() == 'text' ) : ?>
	<?php the_sub_field( 'copy' ); ?>
	<?php $link = get_sub_field( 'link' ); ?>
	<?php if ( $link ) { ?>
	<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
	<?php } ?>
	<?php endif; ?>
	<?php endwhile; ?>
	<?php else: ?>
	<?php // no layouts found ?>
	<?php endif; ?>
</div>