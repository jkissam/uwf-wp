<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" xmlns:og="http://opengraphprotocol.org/schema/"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" xmlns:og="http://opengraphprotocol.org/schema/"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" xmlns:og="http://opengraphprotocol.org/schema/"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> xmlns:og="http://opengraphprotocol.org/schema/"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 10]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<div id="site-wrapper">
	
	<div id="header-wrapper" class="section-wrapper">
		<header id="header" class="section clearfix container" role="banner">
			<div id="header-inner" class="section-inner">
				
				<?php $logo = uwf_get_logo(); if ($logo) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="logo"><?php echo $logo; ?></a>
				<?php endif; ?>
				
				<hgroup class="site-name-slogan">
					<h1 class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-slogan"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>

<?php
// search toggle for screen readers, add here if the search box is anywhere below the navigation
/*
			<div class="search-toggle">
				<a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'uwf' ); ?></a>
			</div>
*/
?>
				
			</div>
		</header><!-- #header -->
	</div>

	<div id="navigation-wrapper" class="section-wrapper">
		<nav id="navigation" class="site-navigation primary-navigation section clearfix container" role="navigation">
			<div id="navigation-inner" class="section-inner">
				<h2 class="navigation-header">
					<svg class="icon navigation-icon" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
						<rect x="0" y="5" width="100" height="20"/>
						<rect x="0" y="40" width="100" height="20"/>
						<rect x="0" y="75" width="100" height="20"/>
					</svg>
					<span><?php uwf_navigation_title(); ?></span>
				</h2>
				<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'uwf' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'main-menu', 'container_class' => 'main-menu' ) ); ?>
			</div>
		</nav>
	</div>

	<?php if ( uwf_display_highlighted() && is_active_sidebar( 'highlighted' ) ) : ?>
	<div id="highlighted-wrapper" class="section-wrapper">
		<div id="highlighted" class="highlighted widget-area clearfix container section" role="complementary">
			<div id="highlighted-inner" class="section-inner">
				<?php dynamic_sidebar( 'highlighted' ); ?>
			</div>
		</div><!-- #highlighted -->
	</div>
	<?php endif; ?>

	<div id="main-wrapper" class="section-wrapper">
		<div id="main" class="section clearfix container">