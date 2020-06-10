<?php
/**
 * A Header for the Migdaloz theme.
 * This is a specialized header, for use only with the front page.
 * It should be called by get_header('home');
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */
?><!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
    <meta name="viewport" content="width=device-width,initial-scale=1">
  
    <meta name="generator" content="Old Castle Web Services">
  
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
    
  
  <script>document.createElement( "picture" );</script>
  
</head>

<body class="body-1">
  <header style="<?php echo home_header_background('home'); ?>" class="container-grid header" id="home">
    <div class="container-grid nav">
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <h3 class="menu-toggle assistive-text"><?php esc_html_e( 'Menu', 'migdaloz' ); ?></h3>
            <div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'qohelet' ); ?>"><?php esc_html_e( 'Skip to content', 'migdaloz' ); ?></a></div>
            
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </nav> <!-- /.site-navigation.main-navigation -->
      
    </div>
    <div class="container-grid sitename">
      <header class="container-fluid header-container container-grid">
          <?php 
		$headerImg = get_header_image();
		if( !empty( $headerImg ) ) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img class="mgdl_header_image" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                    </a>
                <?php } ?>
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
            
            <?php echo get_bloginfo( 'name' ); ?></a></h1>
        <div class="rule">
          <hr>
        </div>
        <p class="paragraph introduction-p"><?php echo get_bloginfo( 'description' ); ?></p>
        <!-- <a class="link-button btn btn-outline-primary btn-lg" href="about.html">The Artist<br></a> -->
      </header>
    </div>
  </header>