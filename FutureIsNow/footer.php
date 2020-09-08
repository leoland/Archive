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
				<div class="two-civ-logo"> <?php $twociv_logo = get_field( '2civ_logo', 'option' ); ?>
					<?php if ( $twociv_logo ) { ?>
					<a href="https://2civility.org"> <img src="<?php echo $twociv_logo['url']; ?>"
							alt="<?php echo $twociv_logo['alt']; ?>" /></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="bottom-footer">
		<div class="outer-block-wrapper">
			<div class="inner-block-wrapper">

				<div class="first">
					<span class='small'>Follow along on social media using #TheFutureIsNow.</span>
					<?php if (have_rows('social_links', 'option')): ?>
					<div class="social-links">
						<?php while (have_rows('social_links', 'option')): the_row();?>
						<a href="<?php the_sub_field('link', 'option');?>"><?php the_sub_field('icon', 'option');?></a>
						<?php endwhile;?>
					</div>
					<?php endif;?>

					<div class="address"><?php the_field('address', 'option');?></div>
				</div>









				<div class="last">

					<div class="footer-logo">

						<?php $footer_logo = get_field('footer_logo', 'option');?>
						<?php if ($footer_logo) {?>
						<div class="site-branding">
							<img src="<?php echo $footer_logo['url']; ?>" />
						</div>
						<?php }?>
					</div>



				</div>

				<div class="second">
					<div class="store-area hidden">
						<span>Download the App</span>
						<div class="store-buttons">
							<a class="store" href="#"><img
									src="<?php echo get_template_directory_uri();?>/assets/images/appstore.png"
									alt=""></a>
							<a class="store" href="#"><img
									src="<?php echo get_template_directory_uri();?>/assets/images/playstore.png"
									alt=""></a>
						</div>
					</div>




					<div class="small">

						<a href="<?php echo get_home_url(); ?>/wp-content/uploads/2019/12/Social-Media-Usage-Policy.pdf"
							class="policy">Social Media Policy</a>
						<div class="span">
							<p>Illinois Supreme Court Commission on Professionalism</p>

							<p>©<?php echo date("Y"); ?>. All Rights Reserved.</p>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>
	</div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer();?>








</body>

</html>


<?php /*

not in use


<a href="<?php echo get_template_directory_uri(). '/inc/block-maker.php'; ?>" target='_blank' class="">Block maker</a>





<div class="back-to-top">
	<a href="#" class="back-to-top">Back to Top</a>

</div>-->*/?>