<?php
/**
 * Block template file: template-parts/blocks/action-cards/action-cards.php
 *
 * Action Cards Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'action-cards-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}


// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-action-cards';
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


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes );?>">
	<div class="inner-block-wrapper">
		<div class="intro">
			<h2>
				<?php the_field( 'headline' ); ?>
			</h2>
			<div class="copy">
				<?php the_field( 'copy' ); ?>
			</div>

		</div>
		<ul class="cards">
			<?php if ( have_rows( 'cards' ) ) : ?>
			<?php while ( have_rows( 'cards' ) ) : the_row(); ?>
			<?php $target = get_sub_field( 'target' ); ?>


			<li class="card 
	<?php if ( $target ) { ?>
	linked
	<?php } ?>
">

				<?php if ( $target ) { ?>
				<a class="inner" href="<?php echo $target['url']; ?>" target="<?php echo $target['target']; ?>">
					<?php } ?>


					<?php $icon = get_sub_field( 'icon' ); ?>
					<?php if ( $icon ) { ?>
					<div class="icon-wrapper">
						<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
					</div>
					<?php } ?>

					<span class="label">
						<?php the_sub_field( 'label' ); ?>
					</span>

					<div class="copy">
						<?php the_sub_field( 'copy' ); ?>
					</div>



					<?php if ( $target ) { ?>
					<span class="link arrow-link">

						<?php 
	if ($target['title']) echo $target['title'];
	else {
		echo 'LEARN MORE';
	} ?>
					</span>
				</a>
				<?php } ?>
			</li>
			<?php endwhile; ?>
			<?php endif; ?>
			<?php if ( have_rows( 'closing_card' ) ) : ?>
			<?php while ( have_rows( 'closing_card' ) ) : the_row(); ?>
			<li class="card closing-card">
				<span class="label">
					<?php the_sub_field( 'headline' ); ?>
				</span>

				<?php $target = get_sub_field( 'target' ); ?>
				<?php if ( $target ) { ?>
				<a class="button-alt-solid" href="<?php echo $target['url']; ?>"
					target="<?php echo $target['target']; ?>"><?php echo $target['title']; ?></a>
				<?php } ?>
			</li>
			<?php endwhile; ?>
			<?php endif; ?>
		</ul>

	</div>

</div>