<?php
/**
 * Template part for displaying a hero.
 *
 * TODO: use this for archive.php, home.php, content-single.php and archive-team_member.php - each of those has own variations
 */


$hero_style = get_field('hero_style');
//get background only if we need it
if ($hero_style == 'big-hero' ) {

	$hero_image = get_field('hero_image');
	$hero_image_url = $hero_image['url'];
	$hero_image_alt = $hero_image['alt'];

	$content_image = get_field( 'image' );
	$has_content_image = 0;
	if ( $content_image ) {
		$has_content_image = 1;
		$content_image_url = $content_image['url'];
		$content_image_alt = $content_image['alt'];
}
}

$post_type = get_post_type($post->ID);

?>



<section
	class="block hero <?php echo $hero_style; ?>  <?php echo $post_type; ?> <?php echo 'content-image-' . $has_content_image; ?>"
	style="
	<?php if (($hero_style == 'big-hero' ) || $hero_image) {?>
background-image: url('<?php echo $hero_image_url; ?>');
<?php }?>
">


	<div class="hero__main">

		<div class="outer-block-wrapper">
			<div class="inner-block-wrapper">

				<?php if ($content_image_url ) { ?>
				<div class="img-wrapper">
					<img src="<?php echo $content_image_url; ?>" alt="<?php echo $content_image_alt; ?>" />
					<?php if ($content_image_alt){?>
					<span class="img-alt"><?php echo $content_image_alt ; ?></span>

					<?php } ?>
				</div>

				<?php }?>


				<?php if (get_field('heading')) {?>
				<h1 class="hero--title"> <?php the_field('heading');?></h1>
				<?php } else {?>
				<h1 class="hero--title"> <?php the_title();?></h1>
				<?php }?>
				<?php if (get_field('copy')) {?>
				<div class="copy ">

					<?php the_field('copy');?>

				</div>
				<?php }?>
			</div>
		</div>
	</div>








</section>