<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */

get_header(); ?>
<div id="primary" class="container-grid text-container" role="main">
    <div id="thearticle" class="container-grid text-inner col-9">
        <?php         get_template_part('content', get_post_format()); ?>
    </div>
    
    <div id="thesidebar" class="container-grid text-inner col-3">
        <?php get_sidebar(); ?>
    </div>
    
</div><!-- /#primary -->
  

<?php
get_footer(); 
/*
 * This is the end of the main page template
 */
?>