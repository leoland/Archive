<?php
	/**
	 * The template for displaying archive pages
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package ch2
	 */

	get_header();
	$bg_position = get_field( 'focus_point' );
	if ( have_posts() ) :
		$background = get_the_post_thumbnail_url( get_option( 'page_for_posts', true ), 'full' );
		?>


        <section class="block hero height-<?php the_field( 'height', get_option( 'page_for_posts', true ) ); ?>"
                 style="background-color: gray; background-image: url('<?php echo $background; ?> background-position: <?php echo $bg_position ?>;');">

            <div class="filter"></div>

            <div class="outer-block-wrapper">
                <div class="inner-block-wrapper">

                    <div class="hero--content">

						<?php if ( get_field( 'heading', get_option( 'page_for_posts', true ) ) ) { ?>
                            <h1 class="hero--title"><?php the_field( 'heading', get_option( 'page_for_posts', true ) ); ?></h1>
						<?php } else { ?>
                            <h1 class="hero--title"><?php echo get_the_title( get_option( 'page_for_posts', true ) ); ?></h1>
						<?php } ?>

						<?php if ( get_field( 'copy', get_option( 'page_for_posts', true ) ) ): ?>
                            <div class="copy"> <?php the_field( 'copy', get_option( 'page_for_posts', true ) ); ?></div>
						<?php endif; ?>

						<?php if ( get_field( 'button_link', get_option( 'page_for_posts', true ) ) ): ?>
                            <a class="btn-default"
                               href="<?php the_field( 'button_link', get_option( 'page_for_posts', true ) ); ?>"> <?php the_field( 'button_text', get_option( 'page_for_posts', true ) ); ?></a>
						<?php endif; ?>

                    </div>
                </div>
            </div>

        </section>

        <?php if ( have_rows( 'blocks', '229' ) ) :
	
			while ( have_rows( 'blocks', '229' ) ) : the_row();
		
				$layout = get_row_layout();
				//echo $layout;
				get_template_part( 'template-parts/block', $layout );
		
			endwhile;
			
		endif;
       
	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

<?php
	get_footer();
