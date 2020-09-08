<?php
	/**
	 * Template part for displaying a callout.
	 */
?>
<section class="block instagram">
    <div class="outer-block-wrapper">
        <div class="inner-block-wrapper">
            <div class="callout--content">
                <div class="title-stuff">
                    <h3 class="instagram--title">Instagram<span class="sep"> | </span></h3><a
                                href="https://www.instagram.com/vmba802" target="_blank"
                                class="instagram-link">@vmba802</a>
                </div>

            </div>
        </div>
    </div>
	<?php
		echo do_shortcode( '[instagram-feed]' );
	 ?>

</section>