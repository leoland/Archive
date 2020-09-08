<?php
/**
 * Base template
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

get_header();


$post_type = get_post_type(  );


?>
<div class="post-type-<?php echo $post_type; ?>">
	<div class=" block single-post-main alignfull">
		<div class="wrap">

			<div class="sidebar">


				<?php if ($post_type == 'post'): ?>

				<a class="back-button button-alt-solid" href="
		<?php
			echo get_home_url() .'/news/';

				?>
		">← Back to News</a>

				</a>


				<?php  endif;
 if ($post_type == 'event'): ?>

				<a class="back-button button-alt-solid" href="
<?php
echo get_home_url() .'/events/';

	?>
">← Back to Events</a>

				</a>



				<?php $registration_link = get_field( 'registration_link' ); ?>
				<?php if ( $registration_link ) { ?>
				<a class='button-primary-solid' href="<?php echo $registration_link['url']; ?>"
					target="<?php echo $registration_link['target']; ?>"><?php echo $registration_link['title']; ?></a>
				<?php } ?>


				<?php  endif;


		/*
		Loop trough all taxonomies and for each of those loop for terms in this particular post
		*/

		$args=array('public'   => true, '_builtin' => true); 
		$output = 'objects';
		$operator = 'and';
		//pretty much get all taxonomies
		$taxonomies=get_taxonomies($args,$output,$operator); 
		if  ($taxonomies) {
			foreach ($taxonomies  as $taxonomy ) {
				//loop trough all taxonomies and compare them agasint the current post. Acting only on the existing ones
				
				//$tax_label = $taxonomy->label;
				$labels = get_taxonomy_labels( $taxonomy );
				$tax_label = $labels->name;
				$taxonomy = $taxonomy->name;
				if( has_term( '', $taxonomy ) ) {
				//now get all the terms in this taxonomy that match the current post and list those.
					$terms = get_the_terms(get_the_ID(), $taxonomy);
					foreach ( $terms as $term ) { ?>
				<a href=" <?php echo get_category_link( $term->term_id ); ?>"
					class="button-primary-solid"><?php echo $term->name ?></a><?php
					}
					?>

				<?php
				}
			}
		}

if ($post_type == 'event'): ?>

				<span class='contact-info'>Contact Information:</span>
				<?php the_field( 'information' ); ?>
				<?php // the_field( 'event_description' ); ?>

				<div class="location-details">
					<br><br>
					<?php the_field( 'location_d' ); ?>
				</div>



				<?php
				endif
				?>



			</div>

			<div class="content">

				<div class="single-post-item">

					<?php

				if ($post_type == 'event'): 


				$p = get_the_ID(  );
?>



					<div class="event-single">
						<?php $terms = get_the_terms( $p, 'event_categories' );
		$term = $terms[0];
// Define taxonomy prefix
// Replace NULL with the name of the taxonomy eg 'category'
$taxonomy_prefix = 'event_categories';

// Define term ID
// Replace NULL with ID of term to be queried eg '123' 
$term_id = $term->term_id;

// Define prefixed term ID
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>





						<div class="event-category"
							style="background-color: <?php the_field( 'category_color', $term_id_prefixed ); ?> ">
							<?php $category_icon = get_field( 'category_icon', $term_id_prefixed ); ?>
							<?php if ( $category_icon ) { ?>
							<img src="<?php echo $category_icon['url']; ?>"
								alt="<?php echo $category_icon['alt']; ?>" />
							<?php } ?>

						</div>

						<?php endif;?>




						<div class="post-meta">
							<div class="descriptors">
								<?php 
			

		/*
		Loop trough all taxonomies and for each of those loop for terms in this particular post
		*/
	/*
		Loop trough all taxonomies and for each of those loop for terms in this particular post
		*/

		$args=array('public'   => true, '_builtin' => true); 
		$output = 'objects';
		$operator = 'and';
		//pretty much get all taxonomies
		$taxonomies=get_taxonomies($args,$output,$operator); 
		if  ($taxonomies) {
			foreach ($taxonomies  as $taxonomy ) {
				//loop trough all taxonomies and compare them agasint the current post. Acting only on the existing ones
				
				//$tax_label = $taxonomy->label;
				$labels = get_taxonomy_labels( $taxonomy );
				$tax_label = $labels->name;
				$taxonomy = $taxonomy->name;
				if( has_term( '', $taxonomy ) ) {
					?>
								<div class="tax-wrap">
									<span class="taxonomy">
										<?php echo $tax_label.": " ?>
									</span>
									<?php
					
					$term = get_term_by( 'slug', 'name' , $taxonomy ); 
				 
				//now get all the terms in this taxonomy that match the current post and list those.
					$terms = get_the_terms(get_the_ID(), $taxonomy);
					foreach ( $terms as $term ) {
						echo '<span class="single-term">'.$term->name . '</span>';
					}
					?>
								</div>
								<?php
				}
			}
		}
?>

							</div>
							<time datetime="<?php 
						if (is_singular('event')){
							the_field( 'date' ); 
						}
						else {
							echo get_the_date('c'); 
						}
						?>" itemprop="datePublished"><?php
						
						if (is_singular('event')){
							the_field( 'date' ); 
						}
						else {
							the_date();
						}
						?>

							</time>

							<?php 
if (is_singular('event')){ ?>
							<span class="location">
								<?php echo ' | '; the_field( 'location' );?>
							</span>
							<?php
}


?>
						</div>


						<?php
	tha_content_top();
	tha_content_loop();
	tha_content_bottom();

	$post_type = get_post_type(  );

						if ($post_type == 'event'): ?>


						<?php $location_image = get_field( 'location_image' ); ?>
						<?php if ( $location_image ) { ?>
						<h2 class='map-title'>Map to Event</h2>
						<a href="	<?php the_field( 'location_link' ); ?>
							
							">
							<img src="<?php echo $location_image['url']; ?>"
								alt="<?php echo $location_image['alt']; ?>" />

						</a>
						<?php } ?>


						<?php
				endif
				?>

						<?php
					if ($post_type === 'post'): ?>
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<div class="addthis_inline_share_toolbox"></div>


						<?php endif; ?>
					</div>



				</div>


			</div>

			<? 
			if ($post_type === 'post'): ?>


			<?php
			$post_terms = wp_get_object_terms($post->ID, 'category', array('fields'=>'ids'));

$args = array(
	'post_type' => 'post',
	'posts_per_page'=> 3,
	'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'id',
			'terms' => $post_terms
		)
	)
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) { ?>
			<div class="related-posts wrap">

				<h2 class='related-heading'>Related Posts</h2>
				<div class="inner-wrap">

					<?php 
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		?>
					<div class=" single-news-item">
						<?php 

?>

						<div class="resource-meta">
							<div class="descriptors">
								<?php 
	

		/*
		Loop trough all taxonomies and for each of those loop for terms in this particular post
		*/

		
		$args=array('public'   => true, '_builtin' => true); 
		$output = 'objects';
		$operator = 'and';
		//pretty much get all taxonomies
		$taxonomies=get_taxonomies($args,$output,$operator); 
		if  ($taxonomies) {
			foreach ($taxonomies  as $taxonomy ) {
				//loop trough all taxonomies and compare them agasint the current post. Acting only on the existing ones
				
				//$tax_label = $taxonomy->label;
				$labels = get_taxonomy_labels( $taxonomy );
				$tax_label = $labels->name;
				$taxonomy = $taxonomy->name;
				if( has_term( '', $taxonomy ) ) {
					?>
								<div class="tax-wrap">
									<span class="taxonomy">
										<?php echo $tax_label.": " ?>
									</span>
									<?php
					
					$term = get_term_by( 'slug', 'name' , $taxonomy ); 
				
				//now get all the terms in this taxonomy that match the current post and list those.
					$terms = get_the_terms(get_the_ID(), $taxonomy);
					foreach ( $terms as $term ) {
						echo '<span class="single-term">'.$term->name . '</span>';
					}
					?>
								</div>
								<?php
				}
			}
		}


?>

							</div>
							<time datetime="<?php echo get_the_date('c'); ?>"
								itemprop="datePublished"><?php echo get_the_date(); ?></time>
						</div>
						<h3 class="post-title"><?php the_title(); ?></h3>
						<div class="description">
							<?php 

	$short  =	get_the_excerpt(  );
	//$short = substr($short,0,30);
	echo $short;
	?>
						</div>
						<a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
					</div>


					<?php
	}
		
} 
wp_reset_postdata();
?>
				</div>
			</div>
			<?php endif ?>



			<?php	tha_content_wrap_after(); ?>

		</div>


		<?php
		tha_content_after();

		get_footer();