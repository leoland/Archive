<?php
/**
 * Block template file: template-parts/blocks/tabbed-content.php
 *
 * Tabbed Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tabbed-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tabbed-content';
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
	<?php if ( have_rows( 'tabs' ) ) : ?>
		<?php while ( have_rows( 'tabs' ) ) : the_row(); ?>
			<?php the_sub_field( 'label' ); ?>
			<?php the_sub_field( 'content' ); ?>
			<?php if ( have_rows( 'sidebar' ) ): ?>
				<?php while ( have_rows( 'sidebar' ) ) : the_row(); ?>
					<?php if ( get_row_layout() == 'link' ) : ?>
						<?php $link = get_sub_field( 'link' ); ?>
						<?php if ( $link ) { ?>
							<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
						<?php } ?>
					<?php elseif ( get_row_layout() == 'text_area' ) : ?>
						<?php the_sub_field( '' ); ?>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php else: ?>
				<?php // no layouts found ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // no rows found ?>
	<?php endif; ?>
</div>