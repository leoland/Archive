<?php
	/**
	 * The template for displaying the footer
	 *
	 * Contains the closing of the #content div and all content after.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package ch2
	 */

?>
</main><!-- #main -->
</div><!-- #primary -->
</div><!-- #content -->


<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="outer-block-wrapper">
        <div class="inner-block-wrapper">

            <div class="col col-sm-12 col-md-3">
				<?php $footer_logo = get_field( 'footer_logo', 'option' ); ?>
				<?php if ( $footer_logo ) { ?>
                    <div class="footer-branding">
                        <img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>"/>
                    </div>
				<?php } ?>
            </div>

            <div class="col col-sm-6 col-md-3">
                <h4 class="footer-heading">Contact</h4>
				<?php if ( get_field( 'main_address', 'option' ) ): ?>
                    <address>
						<?php the_field( 'main_address', 'option' ); ?>
                    </address>
				<?php endif; ?>
            </div>

            <div class="col col-sm-6 col-md-3">
                <h4 class="footer-heading">Navigation</h4>
                <nav id="footer-navigation" class="footer-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-3', 'menu_id' => 'footer-menu' ) ); ?>
                </nav><!-- #site-navigation -->
            </div>

            <div class="col col-sm-4 col-md-3">
				<?php if ( have_rows( 'social_links', 'option' ) ) : ?>
                    <h4 class="footer-heading">Sign Up for Our Newsletter</h4>
                    <div class="signup-form">
						<?php echo gravity_form( 1, false, false, false, '', false ); ?>
                    </div>
                    <div class="social-links">
						<?php while ( have_rows( 'social_links', 'option' ) ) : the_row(); ?>
                            <a href="<?php the_sub_field( 'link', 'option' ); ?>"
                               target="_blank"><?php the_sub_field( 'icon', 'option' ); ?></a>
						<?php endwhile; ?>
                    </div>
				<?php endif; ?>
            </div>

            <div class="col col-sm-12 site-info">
                &copy;<?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved. <a
                        href="/privacy-policy/">Privacy Policy</a>
            </div><!-- .site-info -->

        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<?php
	$actual_link = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if ( devTime() ) :?>
        <a style="background: grey; position: fixed; bottom: 0; right: 0;"
           target='_blank' href="/wp-content/themes/ch2_sandbox/inc/block-maker.php">Block maker</a>

	<?php
	endif;

?>
<?php if ( is_post_type_archive( 'tribe_events' ) ) { ?>
    <script>
        jQuery("#tribe-events-content").children().each(function () {
            jQuery(this).html(jQuery(this).html().replace(/Find out more »/g, "Find out more"));
            var imgFullURL = jQuery('.tribe-events-event-image img')[0].src;
        });
    </script>
<?php }


	$hero = get_field( 'hero_image' );
	if ( ( is_singular( 'tribe_events' ) ) && ( ! ( $hero ) ) ) { ?>
        <script>
            jQuery(document).ready(function () {
                var imgFullURL = jQuery('.tribe-events-event-image img')[0].src;
                jQuery('.block.hero').css("background-image", "url(" + imgFullURL + ")");
            });
        </script>
	<?php }


	if ( is_singular( 'tribe_events' ) ) {
		if ( have_rows( 'links' ) ) :
			$social = '<dt> Social: </dt>';
			while ( have_rows( 'links' ) ) : the_row();
				$link   = get_sub_field( 'link' );
				$social .= '<dd class="tribe-events-event-url"> <a href="' . $link . '" target="_blank">' . $link . '</a> </dd>';
			endwhile;
		endif;


		?>
        <script>
            jQuery(document).ready(function () {

                jQuery('.tribe-events-event-image').css("display", "none");
                var eventTitle = jQuery('.tribe-events-single-event-title').text();
                jQuery('.hero--content h1').text(eventTitle);
                jQuery('.tribe-events-meta-group-details dl').append('<?php echo $social;?>');
            });
        </script>
	<?php } ?>


</body>
</html>
<!-- testy test?-->