<?php
/**
 * Block template file: template-parts/blocks/hero.php
 *
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}


$bbgc = get_field( 'bbgc' ); 
$headline_lightness = 	get_field( 'hhl' );
$hero_style = get_field( 'hero_style' ); 
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-hero';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
if( !empty( $bbgc ) ) {
    $classes .= ' bg-' . $bbgc;
}
if( !empty( $headline_lightness ) ) {
    $classes .= ' hhl-' . $headline_lightness;
}
if( !empty( $hero_style ) ) {
    $classes .= ' style-' . $hero_style;
}
$classes .= ' helio-block';


//alignfull


$hero_headline = get_field( 'headline' );
$image = get_field( 'image' ); 
//Check if this is the first instance of a Hero block
$first = leo_first_hero($block['name'], $block['id']);
$copy = get_field( 'copy' );

/*
<style type="text/css">
	<?php echo '#' . $id; ?> {

}
</style>

*/

?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<div class="hero-background" style="background-image: url(<?php if ( $image ) { echo $image['url']; }?>
	)">
		<div class="inner-block-wrapper">
			<?php

if ($first){
		echo '<h1 class="hero-headline">' . $hero_headline . '</h1>';
 } 
else { 
	echo '<h2 class="hero-headline">' . $hero_headline . '</h2>';
 } 

 if( ( 'simple' === $hero_style ) && ($copy)) {?>
			<div class="hero-copy">
				<?php 
	echo $copy;
	?>
			</div>

			<?php
	}

			 $link = get_field( 'link' ); 
		 if ( $link ) { 
$button_style =  get_field( 'button_style' );
$button_color = get_field( 'button_color' ); ?>
			<a class="button-<?php echo  $button_color . "-" . $button_style ?>" href="<?php echo $link['url']; ?>"
				target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
			<?php } ?>




		</div>
	</div>


	<?php if( ('simple' !== $hero_style ) && ($copy)){ ?>

	<div class="inner-block-wrapper  copy-wrapper">
		<div class="hero-copy">
			<?php 
echo $copy;
?>
		</div>

	</div>
	<?php
	}
	?>
</div>