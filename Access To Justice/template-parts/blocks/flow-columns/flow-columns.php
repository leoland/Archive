<?php
/**
 * Block template file: template-parts/blocks/flow-columns/flow-columns.php
 *
 * Flow Columns Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'flow-columns-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-flow-columns';
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
	 {
		/* Add styles that use ACF values here */
	}

	<?php echo '#' . $id; ?> .flow-inner-wrapper {
		text-align: <?php the_field( 'column_align' ); ?>;
		column-width: calc(1000px / <?php the_field( 'max_columns' ); ?>);
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
<div class="inner-block-wrapper">
	<div class="intro">
	<h2>
	<?php the_field( 'headline' ); ?>
	</h2>
	<div class="copy">
	<?php the_field( 'copy' ); ?>
	</div>
	<hr>
	</div>
	<?php if ( have_rows( 'content_areas' ) ) : ?>
		
		<div class="flow-inner-wrapper ">
		<?php while ( have_rows( 'content_areas' ) ) : the_row(); ?>
		<div class="flow-content-area">
		<?php the_sub_field( 'content_area' ); ?>
		</div>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>
	</div>
</div>

