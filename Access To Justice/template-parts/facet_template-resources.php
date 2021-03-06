<?php while ( have_posts() ): the_post(); ?>
<div class="single-resource-item">
	<?php 
$descriptors =  get_field( 'optional_descriptors' );
$description = get_field( 'description' ); 
?>

	<div class="resource-meta">
		<div class="descriptors">
			<?php 
		if ($descriptors){ 
	
			echo '	<span class="optional-descriptors">' . $descriptors . '</span>';
		}

		/*
		Loop trough all taxonomies and for each of those loop for terms in this particular post
		*/

		
$args=array('public'   => true, '_builtin' => false); 
$output = 'objects';
$operator = 'and';
//pretty much get all taxonomies
$taxonomies=get_taxonomies($args,$output,$operator); 
if  ($taxonomies) {
    foreach ($taxonomies  as $taxonomy ) {
		//loop trough all taxonomies and compare them agasint the current post. Acting only on the existing ones
		$tax_label = $taxonomy->label;
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

	</div>
	<h2 class="resource-title"><?php the_title(); ?></h2>
	<div class="description">
		<?php 
		echo $description;
	?>
	</div>
	<a href="<?php the_permalink(  ); ?>" class="button-alt-solid">View More</a>
</div>



<?php endwhile; ?>