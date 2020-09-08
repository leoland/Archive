<?php
	/**
	 * Template part for displaying a Billboard.
	 *
	 * TODO: use this for archive.php, home.php, content-single.php and archive-team_member.php - each of those has own variations
	 */
	$background        = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$background_credit = get_post_meta( get_post_thumbnail_id(), 'ch2_the_photo_credit', true );
	$pre_heading       = get_field( 'pre_heading' );
	$heading           = get_field( 'heading' );
	$copy              = get_field( 'copy' );
	$button            = get_field( 'button' );
	$bg_position       = get_field( 'focus_point' );

	if ( ( is_post_type_archive( 'tribe_events' ) ) || ( is_singular( 'tribe_events' ) ) ) {
		$background = get_field( 'events_background_image', 'option' );

		$background_credit = get_post_meta( $background['ID'], 'ch2_the_photo_credit', true );
		$background        = $background['url'];
		$pre_heading       = get_field( 'events_pre_heading', 'option' );
		$heading           = get_field( 'events_heading', 'option' );
		$copy              = get_field( 'events_copy', 'option' );
	};

	if ( is_singular( 'tribe_events' ) ) {
		$background_credit = get_post_meta( get_post_thumbnail_id(), 'ch2_the_photo_credit', true );
		$copy              = null;
		$hero_image        = get_field( 'hero_image' );
		if ( $hero_image ) {
			$background        = $hero_image['url'];
			$background_credit = get_post_meta( $hero_image['id'], 'ch2_the_photo_credit', true );
		}
	};

?>
    <section class="block hero "
             style="background-color: gray; background-image: url('<?php echo $background; ?>'); background-position: <?php echo $bg_position ?>;">
        <div class="filter"></div>
        <div class="outer-block-wrapper">
            <div class="inner-block-wrapper">
                <div class="hero--content">
					<?php if ( $pre_heading ): ?>
                        <h5 class="pre-heading"><?php echo $pre_heading; ?></h5>
					<?php endif; ?>
                    <h1 class="heading">
						<?php if ( $heading ): ?>
							<?php echo $heading;
						else:
							the_title();
						endif; ?>
                    </h1>
					<?php
						if ( ! is_post_type_archive( 'tribe_events' ) ) {
							if ( $copy ): ?>
                                <div class="copy"><?php echo $copy; ?></div>
							<?php endif;
						};
					?>
					<?php if ( $button ) { ?>
                        <a class='btn-default button' href="<?php echo $button['url']; ?>"
                           target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
					<?php } ?>

                </div>
            </div>

			<?php if ( $background_credit ): ?>
                <span class="photo-credit">
            <?php echo $background_credit; ?>
        </span>
			<?php endif; ?>
        </div>

    </section>

<?php
	if ( is_post_type_archive( 'tribe_events' ) ) {
		if ( $copy ): ?>
            <section class="general_copy block">
                <div class="outer-block-wrapper">
                    <div class="inner-block-wrapper">
                        <div class="content"><?php echo $copy; ?></div>
                    </div>
                </div>
            </section>

		<?php endif;
	};

?>