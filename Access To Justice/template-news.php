<?php
/**
 * Template Name: News
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

get_header();

tha_content_before();

	echo '<div class="' . ea_class( 'news-template', 'content-area', 'wrap', apply_filters( 'ea_content_area_wrap', true ) ) . '">';
	tha_content_wrap_before();
	?>
<main class="site-main" role="main">
	<div class="hentry type-page template-resources">

		<div class="entry-content">

			<div class="block-hero alignfull">


				<div class="wrap">

					<h1 class="title"><?php the_title(  );?></h1>

				</div>

			</div>


			<div class="facets-wrapper alignfull block">
				<div class="wrap">


					<div class="top-facets-bar">
						<div class="search-wrap">

							<?php echo facetwp_display( 'facet', 'search_news' ); ?>

						</div>
						<div class="sort">
							<?php echo facetwp_display( 'facet', 'counter' ); ?>
							<?php echo facetwp_display( 'sort' ) ?>
						</div>
					</div>

					<div class="lower-wrapper">


						<div class="post-filters">



							<?php echo facetwp_display( 'facet', 'category' ); ?>

							<button onclick="FWP.reset()" class="facet-reset">Reset Filters</button>
						</div>

						<div class="main-list">
							<?php
							
echo facetwp_display( 'template', 'news' ); 

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