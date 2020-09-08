<?php
	/**
	 * Template part for displaying posts
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package ch2
	 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$background        = get_the_post_thumbnail_url( '229', 'full' );
		$background_credit = get_post_meta( get_post_thumbnail_id( '229' ), 'ch2_the_photo_credit', true );
		if ( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) {
			$background        = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			$background_credit = get_post_meta( get_post_thumbnail_id(), 'ch2_the_photo_credit', true );
		}
		$pre_heading = get_field( 'pre_heading' );
		$heading     = get_field( 'heading' );
	?>
    <header class="entry-header block hero height-<?php the_field( 'height' ); ?>"
            style="background-color: gray; background-image: url('<?php echo $background; ?>');">
        <div class="filter"></div>
        <div class="outer-block-wrapper"> <!-- extend with needed container -->
            <div class="inner-block-wrapper"> <!-- probably extend with row or -->
                <div class="hero--content">
					<?php if ( $pre_heading ): ?>
                        <h5 class="pre-heading"><?php echo $pre_heading; ?></h5>
					<?php endif; ?>
                    <h1 class="heading hero--title entry-title">
						<?php if ( $heading ): ?>
							<?php echo $heading;
						else:
							the_title();
						endif; ?>
                    </h1>
					<?php if ( 'post' === get_post_type() ) : ?>
                        <!--	<div class="copy entry-meta">
							<p><?php ch2_posted_on(); ?></p>
						</div>-->
					<?php
					endif; ?>
                </div>
            </div>

			<?php if ( $background_credit ): ?>
                <span class="photo-credit">
            <?php echo $background_credit; ?>
        </span>
			<?php endif; ?>
        </div>
    </header><!-- .entry-header -->

    <div class="block entry-content">
        <div class="outer-block-wrapper"> <!-- extend with needed container -->
            <div class="inner-block-wrapper"> <!-- probably extend with row or -->
                <div class="post-meta-stuff">
					<?php
						$term_list = wp_get_post_terms( get_the_ID(), 'category', array( "fields" => "all" ) );

						if ( $term_list ) {
							$count = count( $term_list );
							?>

                            <div class="categories">
                                <h4 class="cat-heading">
									<?php
										if ( $count > 1 ) {
											echo 'Categories';
										} else {
											echo 'Category';
										}
									?>

                                </h4>
                                <p class="cat-list">
									<?php
										if ( $count > 1 ) {
											$i = 0;
											foreach ( $term_list as $term ) {
												$i ++;
												if ( $i != $count ) {
													echo $term->name . ', ';
												} else {

												}
											};
										} else {
											echo $term_list[0]->name;
										}
									?></p>
                            </div>

							<?php
						};
					?>
					<?php if ( have_rows( 'extra' ) ) : ?>
                        <div class="extra-details">
							<?php while ( have_rows( 'extra' ) ) : the_row(); ?>
                                <div class="extra-detail">
                                    <h4 class="detail-heading"><?php the_sub_field( 'heading' ); ?></h4>
                                    <p class="detail-content"><?php the_sub_field( 'details' ); ?></p>
                                </div>
							<?php endwhile; ?>
                        </div>
					<?php endif; ?>

                    <div class="share">
                        <h4 class="widget-title share-title">Share</h4>
                        <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                            <a class="addthis_button_facebook"></a>
                            <a class="addthis_button_twitter"></a>
                            <a class="addthis_button_compact"></a>
                        </div>
                    </div>
                </div>
                <div class="content">
					<?php
						the_content( sprintf(
						/* translators: %s: Name of current post. */
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ch2_sandbox' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );
						//the_post_navigation();
					?>

                </div>
            </div>
        </div>
    </div><!-- .entry-content -->


</article><!-- #post-## -->
