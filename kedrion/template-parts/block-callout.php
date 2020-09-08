<?php
	/**
	 * Template part for displaying a Callout.
	 */

	$block_style = get_sub_field( 'block_style' );
	$heading     = get_sub_field( 'heading' );
	$subheading  = get_sub_field( 'subheading' );
	$copy        = get_sub_field( 'copy' );
	$link        = get_sub_field( 'link' );
?>


<?php if ( $block_style == 'two-col' ): ?>
<section class="block callout <?php echo $block_style; ?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
    <div class="inner-block-wrapper"> <!-- probably extend with row or -->
	<?php if ( $heading ) { ?>
        <h2 class="callout__heading">
          <?php  echo $heading;?>
        </h2>
    <?php } ?>

	<?php if ( $copy ) { ?>
        <div class="callout__copy">
          <?php  echo $copy;?>
        </div>
    <?php } ?>



<?php elseif($block_style == 'two-tone'):?>
<section class="block callout <?php echo $block_style;?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
        
	<?php if ( $heading ) { ?>
        <h2 class="callout__heading">
          <?php  echo $heading;?>
        </h2>
    <?php } ?>

        	<?php if ( $copy ) { ?>
        <div class="callout__copy">
          <?php  echo $copy;?>
        </div>
    <?php } ?>

   <?php elseif($block_style == 'dark-background'):?>
<section class="block callout <?php echo $block_style;?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->

	<?php if ( $heading ) { ?>
        <h2 class="callout__heading">
          <?php  echo $heading;?>
        </h2>
    <?php } ?>

        	<?php if ( $copy ) { ?>
        <div class="callout__copy">
          <?php  echo $copy;?>
        </div>
    <?php } ?>


<?php elseif($block_style == 'large-copy'):?>
<section class="block callout <?php echo $block_style;?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
        
     	<?php if ( $copy ) { ?>
        <div class="callout__copy">
          <?php  echo $copy;?>
        </div>
    <?php } ?>



<?php else: ?>
<section class="block callout <?php echo $block_style;?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->

	        <?php if ( $subheading ) { ?>
                <h3 class="callout__subheading">
			        <?php  echo $subheading;?>
                </h3>
	        <?php } ?>
	<?php if ( $heading ) { ?>
        <h2 class="callout__heading">
          <?php  echo $heading;?>
        </h2>
    <?php } ?>

	<?php if ( $copy ) { ?>
        <div class="callout__copy">
          <?php  echo $copy;?>
        </div>
    <?php } ?>

	        <?php if ( $link ) { ?>
                <a class="btn btn-solid" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>

	        <?php } ?>
        
<?php endif; ?>

        </div>
    </div>
</section>

