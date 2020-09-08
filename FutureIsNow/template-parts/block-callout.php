<?php
/**
 * Template part for displaying a Callout.
 */

$block_style = get_sub_field('block_style');
$background_image = get_sub_field('background_image');
$copy = get_sub_field( 'copy' );
if ($background_image) {
$background_image_url = $background_image['url'];
}
$b_link = get_sub_field( 'b_link' );

// Load value.
$iframe = get_sub_field('embed');

 if ($iframe){
	wp_enqueue_script( 'featherlight', get_template_directory_uri() . '/assets/js/featherlight-min.js', array(), '', true );

	 wp_enqueue_style( 'featherlight-css', get_template_directory_uri() . '/assets/css/featherlight.css' );
}
?>




<section class="block callout <?php echo $block_style . " hero-" . $hero . " bg-" . $background_color . " copy-" . $copy_color; ?>
	border-<?php echo $border_color; ?>" style="


	<?php if ($background_image_url && ($block_style == 'image-background')) {?>
	background-image: url('<?php echo $background_image_url; ?>'); background-size: cover;background-position:
	center; <?php }?>

	">
	<div class="outer-block-wrapper">
		<!-- extend with needed container -->
		<div class="inner-block-wrapper" <?php if ($block_style == 'boxed'){ ?> style="background-image: url('<?php echo $background_image_url; ?>'); background-size: contain;background-position:
	5% bottom; background-repeat: no-repeat;" <?php
		}
		?>>
			<!-- probably extend with row or -->



			<?php if ($copy) {?>
			<div class=" callout__copy">
				<?php echo $copy; ?>
			</div>
			<?php }?>

			<?php if ( $b_link || $iframe ) { ?>
			<div class="ctas">
				<?php if ( $b_link ) { ?>
				<a class="btn btn-solid" href="<?php echo $b_link['url']; ?>"
					target="<?php echo $b_link['target']; ?>"><?php echo $b_link['title']; ?></a><?php } ?>
				<?php if ($iframe){ ?>
				<button href="#"  class="btn btn-solid btn-tert play-video">Play Video</button>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if ($iframe){ ?>
			<div id="embed-lightbox" class="callout-lightbox">
				<div class="embed-content">
					<button class="close">Close </button>
					<?php echo $iframe; ?>
				</div>
			</div>
			<?php } ?>


		</div>
	</div>


	<?php if ($iframe){ ?>
	<script>
	jQuery(document).ready(function() {

		jQuery(".play-video").click(function () {
	if (jQuery("#embed-lightbox").hasClass("active")) {
		jQuery("#embed-lightbox").removeClass("active");
		jQuery("body").removeClass("lightboxed");
	} else {
		jQuery("#embed-lightbox").addClass("active");
		jQuery("body").addClass("lightboxed");



	}
});

jQuery(".close").click(function () {
	if (jQuery("#embed-lightbox").hasClass("active")) {
		jQuery("#embed-lightbox").removeClass("active");
		jQuery("body").removeClass("lightboxed");

		player.unload()
	}
});






var iframe = document.querySelector('#embed-lightbox iframe');
    var player = new Vimeo.Player(iframe);



    player.getVideoTitle().then(function(title) {
        console.log('title:', title);
    });


    player.on('play', function() {
        console.log('played the video!');
	});





	});
	</script>
	<?php } ?>
</section>