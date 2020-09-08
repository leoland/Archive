<?php
	/**
	 * Template part for displaying posts
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package ch2
	 */


	$background = get_the_post_thumbnail_url( '229', 'full' );
	if ( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) {
		$background = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	}

	$term_list = wp_get_post_terms( get_the_ID(), 'category', array( "fields" => "all" ) ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-snippet' ); ?>>
    <div class="wrapper" style="
            background-image: url(<?php echo $background; ?>);
            ">
        <!--
	<header class="entry-header">
		<div class="featured-image">
		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
		<?php } ?>
		</div>
	</header> .entry-header -->

        <div class="entry-content">
			<?php $term_color = get_term_meta( $term_list[0]->term_id, 'color', true ); ?>

            <div class="color-filter"
                 style="background-color: white; background-color: <?php echo $term_color; ?> "></div>
            <div class="entry-meta">

				<?php echo $term_list[0]->name; ?> | <?php ch2_posted_on(); ?>
            </div><!-- .entry-meta -->

			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
        </div><!-- .entry-content -->
    </div><!-- .entry-content -->

</article><!-- #post-## -->