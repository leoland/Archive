<?php 
$meta_query =
	$order_by =  array(
		'featured' => 'DESC',
		'last_name' => 'ASC',

	);
	$query->set( 'meta_query', $meta_query );
	$query->set( 'orderby', $order_by );
	$query->set( 'posts_per_page', '-1' );