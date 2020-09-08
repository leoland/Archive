<?php
/**
 * Template part for displaying a Billboard.
 *
 * TODO: use this for archive.php, home.php, content-single.php and archive-team_member.php - each of those has own variations
 */

$hero_image = get_the_post_thumbnail_url();
if ((!$hero_image) && is_singular('post')) {
    $homeid = get_option('page_for_posts');
    $hero_image = get_field('hero_image', $homeid);
}

$post_type = get_post_type($post->ID);
$hero_style = get_field('hero_style');


?>



<section class="block hero <?php echo $post_type; ?>">
	<div class="hero__main" style="
<?php if ($hero_image) {?>
	background-image: url(<?php echo $hero_image; ?>) ;
<?php }?>">
		<div class="outer-block-wrapper">
			<div class="inner-block-wrapper">


				<?php if (get_field('heading')) {?>
				<h1 class="hero--title"> <?php the_field('heading');?></h1>
				<?php } else {?>
				<h1 class="hero--title"> <?php the_title();?></h1>
				<?php }?>
				<?php if (get_field('Position name')) {?>
				<p class="member-position"> <?php the_field('Position name');?></p>
				<?php }
?>
			</div>
		</div>
	</div>

	<?php $image = get_field('image');?>


	<?php if (get_field('copy')) {?>
	<div class="copy ">
		<div class="outer-block-wrapper">
			<div class="inner-block-wrapper <?php if ($image) {?>
	with-icon
<?php }?>" style='<?php if ($image) {?>
	background-image: url(<?php echo $image['url']; ?>);
<?php }?>'>
				<?php the_field('copy');?>

			</div>
		</div>
	</div>
	<?php }?>



</section>