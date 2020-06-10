<?php
/**
 * The Header for the Migdaloz theme.
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
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cagliostro%7CQuicksand:300,400">
</head>

<body class="body-1">
  <header class="container-grid header" id="home">
    <div class="container-grid nav">
      <nav class="container-fluid btn-group nav-container container-grid"><a class="glyph btn btn-secondary dropdown-toggle" href="#" id="dropdownmenulink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="coffeecup-icons-menu7"></i></a>
        <nav class="container-fluid dropdown-menu dropdown-menu-right nav-top-space container-grid" aria-labelledby="dropdownmenulink">
          <a class="link-text dropdown-item" href="index.html">Home</a>
          <a class="link-text dropdown-item" href="about.html">About</a>
          <a class="link-text dropdown-item" href="services.html">Services</a>
        </nav>
      </nav>
    </div>
    <div class="container-grid sitename">
      <header class="container-fluid header-container container-grid">
        <h1>Shutterbug</h1>
        <div class="rule">
          <hr>
        </div>
        <p class="paragraph introduction-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nibh risus, sagittis nec suscipit nec, mollis laoreet eros.</p><a class="link-button btn btn-outline-primary btn-lg" href="about.html">The Artist<br></a>
      </header>
    </div>
  </header>