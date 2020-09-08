<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ch2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ch2_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php else: ?>
        <div class="entry-meta">
			<?php
				$pt = get_post_type_object(get_post_type() );
				echo $pt->labels->singular_name;
            ?>
        </div><!-- .entry-meta -->

		<?php endif; ?>
	</header><!-- .entry-header -->
</article><!-- #post-## -->
