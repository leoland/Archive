<?php
/**
 * Block template file: template-parts/blocks/link-block/link-blocks.php
 *
 * Link Blocks Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'link-blocks-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-link-blocks';
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


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<h2 class="link-blocks-heading">
		<?php the_field( 'headline' ); ?>
	</h2>
	<div class="link-blocks-copy">
		<?php the_field( 'copy' ); ?>
	</div>

	<?php if ( have_rows( 'links' ) ) : ?>
	<div class="links-wrapper">
		<?php while ( have_rows( 'links' ) ) : the_row(); ?>
		<?php $target = get_sub_field( 'target' ); ?>
		<?php if ( $target ) { ?>
		<a class="link-block button-tert-solid" href="<?php echo $target['url']; ?>"
			target="<?php echo $target['target']; ?>"><?php echo $target['title']; ?></a>
		<?php } ?>
		<?php endwhile; ?>

	</div>

	<?php endif; ?>

	<?php $closing_link = get_field( 'closing_link' ); ?>
	<?php if ( $closing_link ) { ?>
	<div class="link-wrapper">
		<a class="closing-link button-alt-solid" href="<?php echo $closing_link['url']; ?>"
			target="<?php echo $closing_link['target']; ?>"><?php echo $closing_link['title']; ?></a>
		<?php } ?>
	</div>

</div>