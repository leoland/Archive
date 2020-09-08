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
</div><!-- #content -->
<footer id="colophon" class="site-footer" role="contentinfo">







	<div class="top-footer">
		<div class="outer-block-wrapper">
			<div class="inner-block-wrapper">
				<div class="useful-info">
					<h2 class='footer-heading'>Useful Info</h2>
					<div class="useful-copy">
						<?php the_field( 'intro_text', 'option' ); ?>
					</div>
				</div>
				<div class="highlights-nav">
					<h2 class="footer-heading">Highlights</h2>
					<?php wp_nav_menu(array(
    'theme_location' => 'menu-3',
    'menu_id' => 'footer-highlights',
    'fallback_cb' => 'false',
));?>
				</div>
				<?php $user_guide = get_field( 'user_guide', 'option' ); ?>

				<a class="logo" href="<?php echo $user_guide['url']; ?>">
					<?php $footer_logo = get_field( 'footer_logo', 'option' ); ?>
					<?php if ( $footer_logo ) { ?>
					<img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>" />
					<?php } ?>
				</a>
			</div>
		</div>
	</div>


	<div class="mid-footer">
		<div class="outer-block-wrapper">
			<div class="inner-block-wrapper">
				<div class="key-topics-nav">
					<h2 class="footer-heading key-topics-heading">Key Topics</h2>
					<?php wp_nav_menu(array(
    'theme_location' => 'menu-4',
    'menu_id' => 'footer-Key-topics',
    'fallback_cb' => 'false',
));?>
				</div>
				<div class="company-numbers">
					<h2 class="footer-heading company-numbers">
						Company Numbers
					</h2>



					<?php if ( have_rows( 'company_numbers', 'option' ) ) : ?>
					<div class="numbers">
						<?php while ( have_rows( 'company_numbers', 'option' ) ) : the_row(); ?>
						<div class="set">
							<div class="number">
								<?php the_sub_field( 'number' ); ?>
							</div>
							<div class="label">
								<?php the_sub_field( 'label' ); ?>
							</div>
						</div>


						<?php endwhile; ?>
					</div>

					<?php endif; ?>


				</div>
				<div class="kedrion-map">
					<h2 class="footer-heading">
						Kedrion in The World
					</h2>
					<div class="map">
						<?php $map_image = get_field( 'map_image', 'option' ); ?>
						<?php if ( $map_image ) { ?>
						<img src="<?php echo $map_image['url']; ?>" alt="<?php echo $map_image['alt']; ?>" />
						<?php } ?>
					</div>
				</div>

			</div>




		</div>
	</div>

	<div class="bottom-footer">
		<div class="outer-block-wrapper">
			<div class="inner-block-wrapper">


				<div class="small">
					<?php the_field( 'bottom_copy', 'option' ); ?>

				</div>

			</div>

		</div>
	</div>
	</div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer();?>


<?php /* ?>

<a href="<?php echo home_url().'/wp-content/themes/kedrion_portal_2019/inc/block-maker.php'; ?>" target='_blank'
	class="">block-maker</a>

<?php
*/
?>



</body>

</html>