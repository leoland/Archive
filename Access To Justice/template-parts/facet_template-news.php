<?php while ( have_posts() ): the_post(); ?>
<div class="single-resource-item">
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
		<time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
	</div>
	<h2 class="resource-title"><?php the_title(); ?></h2>
	<div class="description">
		<?php 

		the_excerpt(  );
	?>
	</div>
	<a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
</div>



<?php endwhile; ?>