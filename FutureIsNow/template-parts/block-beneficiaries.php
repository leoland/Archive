 <?php
/**
 * Template part for displaying a Logo block.
 */
?>

 <?php $style = get_sub_field('block_style');

$filter_ids = get_sub_field('filter');?>

 <section class="block beneficiaries grid bg-<?php the_sub_field('bg_color');?>">

 	<div class="outer-block-wrapper">
 		<!-- extend with needed container -->
 		<div class="inner-block-wrapper">
 			<!-- probably extend with row or -->


 			<div class="intro-copy">
 				<?php the_sub_field('intro_copy');?>
 			</div>

 			<div class="beneficiary-list">
 				<?php
$args = array(
    'post_type' => 'beneficiaries',
    'tax_query' => array(
        array(
            'taxonomy' => 'beneficiary-category',
            'field' => 'term_id',
            'terms' => $filter_ids,
        ),
    ),
);
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {$i++;
        $the_query->the_post();
        ?>

 				<a class="ben-wrapper" href="<?php the_permalink();?>" target="_blank">
 					<?php the_post_thumbnail();?>
 					<span class="more-details">More Details</span>
 				</a>
 				<?php
}
}
wp_reset_postdata();
?>

 			</div>

 		</div>
 	</div>
 </section>