
		<?php
        /**
        * Template part for displaying a Search.
        */
        ?>
<section class="block search">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <h1 class="block-title">Buy & Sell Food Processing & Packaging Equipment</h1>
            <?php
	            $post_object = get_field( 'equipment_list_page', 'option' );
	            if ( $post_object ):
	            $slug = $post_object->post_name;
	            $slug = '/'.$slug.'/';
	            endif;
            ?>
            <form class="search-form" action="<?php echo $slug;?>"  method="get">
                <input type="search" placeholder="Search &hellip;" value="" name="fwp_search">
                <button type="submit"><span id="magnifying-glass"></span>Search</button>
            </form>

            <a href="">Advanced Search</a>
        </div>
    </div>
</section>