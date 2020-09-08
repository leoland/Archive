<?php
/**
 * Block template file: template-parts/blocks/call-to-action.php
 *
 * Call To Action Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


$image = get_field( 'image' ); 


// Create id attribute allowing for custom "anchor" value.
$id = 'call-to-action-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-call-to-action';
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

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="background-image: url(<?php if ( $image ) { echo $image['url']; }?>
	)">
	<div class="inner-block-wrapper">
	<h2 class="callout-heading"><?php the_field( 'headline' ); ?></h2>
	<div class="callout-copy">
	<?php the_field( 'copy' ); ?>
	</div>
	
	<?php $link = get_field( 'link' ); ?>
	<?php if ( $link ) { ?>
	<a class="button-<?php the_field( 'button_style' ); ?>-solid" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
	<?php } ?>
	</div>

</div>