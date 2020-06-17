<?php
/**
 * The archive template file.
 *
 * This is the template file for making archive pages in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">
            
			<div id="thearticle" class="container-grid text-inner col-8">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'postarchives' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template( '', true );
					}
					?>

					<?php // migdaloz_content_nav( 'nav-below' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div> <!-- /#thearticle.container-grid.text-inner.col-8 -->
			
                            <?php get_sidebar(); ?>
                        
                       
	</div> <!-- /#primary.site-content.row -->

<?php migdaloz_numeric_posts_nav(); ?>
<?php get_footer(); 
/*
 * This is the end of the main page template
 */
?>