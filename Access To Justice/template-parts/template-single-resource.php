<div class="entry-content">

	<div class="single-resource-header alignfull">
		<div class="wrap">


			<?php 
	$post = get_queried_object();
	$postType = get_post_type_object(get_post_type($post));
	if ($postType) { 
	if ($postType->name == 'court_user_resources') { 
$icon = get_field( 'icon', '105' );  if ( $icon ) { ?>
			<div class="icon">
				<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
			</div>
			<?php } 
			 } 

			if ($postType->name == 'stakeholders') { 
$icon = get_field( 'icon', '384' );  if ( $icon ) { ?>
			<div class="icon">
				<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
			</div>
			<?php } 
			 } echo '<h1>'. esc_html($postType->labels->name) . '</h1>';
	}

	$slug = $postType->rewrite['slug'];
	
	?>
		</div>
	</div>


	<div class="single-resource-main alignfull">
		<div class="wrap">



			<div class="sidebar">
				<?php $location = get_field( 'resource_location' ); 
		if ('external' == $location): ?>
				<a class="external-resource button-primary-solid"
					href="<?php the_field( 'external_resource_url' );?>">View
					Content</a>
				<?php
	elseif ('internal' == $location): 
	$file = get_field( 'file' );
	?>
				<a download class="external-resource button-primary-solid" href="<?php echo $file['url']; ?>"
					alt="<?php echo $file['filename']; ?>">Download Content</a>
				<?php
		
		
endif;
	
		if ( get_field( 'suggest_a_change' ) == 1 ) {?>
				<a class="suggest-a-change button-primary-solid" href="#">Suggest a
					Change</a>
				<?php } ?>
				<a class="back-button button-alt-solid" href="
		<?php
		if ( 'court_user_resources' == $slug){
			echo get_home_url() .'/resources/';
		}
		elseif ( 'stakeholders' == $slug){
			echo get_home_url() .'/stakeholders/';}
				?>
		">← Back to Filters</a>
				</a>
			</div>
			<div class="content">
				<div class="single-resource-item">
					<?php 
					$descriptors =  get_field( 'optional_descriptors' );
					$description = get_field( 'description' ); 
						?>
					<div class=" resource-meta">
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
				</div>



			</div>





		</div>
	</div>
</div>