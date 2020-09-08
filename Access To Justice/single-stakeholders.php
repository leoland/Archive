<?php
/**
 * 
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/


//find the resource template and add the content in

function leo_resource_single_data() {

	get_template_part( 'template-parts/template-single', 'resource' ); 

}
add_action( 'tha_content_bottom', 'leo_resource_single_data', 8 );


// Build the page
require get_template_directory() . '/index.php';