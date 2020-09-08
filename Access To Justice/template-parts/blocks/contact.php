<?php
/**
 * Block template file: template-parts/blocks/contact.php
 *
 * Contact Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contact-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-contact';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$classes .= ' helio-block';
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<div class="wrap main-wrap">


		<?php if ( have_rows( 'border_boxes' ) ) : ?>
		<div class="bordered-boxes">


			<?php while ( have_rows( 'border_boxes' ) ) : the_row(); ?>
			<div class="bordered-box">


				<?php the_sub_field( 'box_content' ); ?>
			</div>
			<?php endwhile; ?>

			<?php endif; ?>
		</div>
		<div class="form-area">
			<?php $form_id = get_field( 'form' ); ?>
			<?php echo gravity_form( $form_id, false, false, false, '', false ); ?>
		</div>


	</div>
</div>