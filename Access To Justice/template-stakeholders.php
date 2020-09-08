<?php
/**
 * Template Name: Stakeholders
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

get_header();

tha_content_before();

	echo '<div class="' . ea_class( 'content-area', 'wrap', apply_filters( 'ea_content_area_wrap', true ) ) . '">';
	tha_content_wrap_before();
	?>
<main class="site-main" role="main">
	<div class="hentry type-page template-resources">

		<div class="entry-content">

			<div class="block-hero alignfull">
				<?php the_post_thumbnail() ; ?>


				<?php
				$copy = get_field( 'introductory_copy' );
 
				
				if ($copy): 
					$icon = get_field( 'icon' ); 
					?>
				<div class="inner-block-wrapper  copy-wrapper">




					<div class="hero-copy">
						<?php if ( $icon ) { ?>
						<div class="icon">
							<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
						</div>
						<?php } ?>
						<!-- <h1 class="resource-title"><?php the_title(  );?></h1> -->
						<?php echo $copy;?>
					</div>

				</div>
				<?php endif; ?>
			</div>
			<div class="facets-wrapper alignfull block">
				<div class="wrap">


					<div class="top-facets-bar">
						<div class="search-wrap">

							<?php echo facetwp_display( 'facet', 'search' ); ?>

						</div>
						<div class="sort">
							<?php echo facetwp_display( 'facet', 'counter' ); ?>
							<?php echo facetwp_display( 'sort' ) ?>
						</div>
					</div>

					<div class="lower-wrapper">


						<div class="post-filters">



							<?php echo facetwp_display( 'facet', 'stakeholder_types' ); ?>
							<?php echo facetwp_display( 'facet', 'topics' ); ?>

							<button onclick="FWP.reset()" class="facet-reset">Reset Filters</button>
						</div>

						<div class="main-list">
							<?php
							
echo facetwp_display( 'template', 'stakeholders' ); 

						echo facetwp_display( 'facet', 'pagination' ); ?>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	</div>
	<?php

tha_content_after();

get_footer();