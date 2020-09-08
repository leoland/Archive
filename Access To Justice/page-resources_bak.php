<?php
/**
 *
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
	<div class="facets-wrapper">
		<div class="top-facets-bar">
			<div class="search-wrap">
				<?php echo facetwp_display( 'facet', 'search' ); ?>
			</div>
			<div class="sort">
				<?php echo facetwp_display( 'sort' ) ?>
			</div>
		</div>
		<div class="post-filters">

			<?php echo facetwp_display( 'facet', 'court_user_type' ); ?>
			<?php echo facetwp_display( 'facet', 'reason_for_visit' ); ?>
			<?php echo facetwp_display( 'facet', 'case_status' ); ?>
			<?php echo facetwp_display( 'facet', 'translated_content' ); ?>
			<?php echo facetwp_display( 'facet', 'misc' ); ?>

			<button onclick="FWP.reset()" class="facet-reset">Reset Filters</button>
		</div>

		<div class="main-list">
			<?php echo do_shortcode( '[facetwp template="court_user_resources"]' ); ?>
		</div>

		<?php echo do_shortcode( '[facetwp pager="true"]' ); ?>
	</div>
	</div>
	<?php

tha_content_after();

get_footer();