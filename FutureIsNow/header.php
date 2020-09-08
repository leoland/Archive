<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ch2
 */

?>
<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NKSJ6HT');</script>
<!-- End Google Tag Manager -->



	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/duf7ozm.css">

	<!--


	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,500,600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:700,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

-->
	<link href="https://fonts.googleapis.com/css?family=Karma:400,600,700|&display=swap" rel="stylesheet">
	<script src="https://player.vimeo.com/api/player.js"></script>
	<?php wp_head();?>


</head>

<body <?php body_class();?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKSJ6HT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<script>
	document.body.classList.add('js');
	</script>


	<div id="page" class="site">

		<a class="skip-link screen-reader-text"
			href="#content"><?php esc_html_e('Skip to content', 'ch2_sandbox');?></a>

		<header id="masthead" class="site-header headroom" role="banner">
			<div class="outer-block-wrapper">
				<div class="inner-block-wrapper">
					<div class="site-branding">

						<?php $site_logo = get_field('site_logo', 'option');?>


						<?php if ($site_logo) {?>
						<a class='desktop-logo' href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img
								src="<?php echo $site_logo['url']; ?>" alt="<?php echo $site_logo['alt']; ?>" /></a>
						<?php } else {?>
						<?php if (is_front_page()): ?>
						<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
								rel="home"><?php bloginfo('name');?></a></h1>
						<?php else: ?>
						<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
								rel="home"><?php bloginfo('name');?></a></p>
						<?php endif;?>
						<?php }?>
					</div><!-- .site-branding -->




					<nav id="site-navigation" class=" main-navigation" role="navigation">
						<!--<div class="quick-text"><?php the_field( 'quick_text', 'option' ); ?></div>-->


						<?php wp_nav_menu(array(
    'theme_location' => 'menu-2',
    'menu_id' => 'top-menu',
    'fallback_cb' => 'false',
));?>

						<?php wp_nav_menu(array(
    'theme_location' => 'menu-1',
    'menu_id' => 'primary-menu',
    'fallback_cb' => 'false',
));?>



					</nav><!-- #site-navigation -->

					<div class="buttons">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<div class="fancy-burger"><span></span></div>
						</button>
					</div>
				</div>


		</header><!-- #masthead -->



		<div id="content" class="site-content">






			<?php

/* not in use
**search box
		<div class="search-box">
							<form role="search" method="get" class="search-form" action="/">
								<label>
									<span class="screen-reader-text">Search for:</span>
									<input type="search" class="search-field" placeholder="Search …" value="" name="s">
								</label>
								<input type="submit" class="search-submit" value="Go">
							</form>


							<button class="search-toggle magnifying-glass"><i class="fas fa-search"
									aria-hidden="true"></i></button>
						</div>
**end search box

						*/