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

	<div id="primary" class="site-content row" role="main">
            
			<div id="thearticle" class="container-grid text-inner col-8">
                            
                            <?php if ( have_posts() ) : ?>
                                <?php if (is_search()) { ?>
                
                                    <header class="archive-header">
					<h1 class="archive-title"><span class="cat-archive">Search results:</span></h1>

					
                                    </header>
                            <?php } // end if_search ?>
                            
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template( '', true );
					}
					?>

					

				<?php endwhile; // end of the loop. ?>
                            
                                <?php else : 

				get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found 

			endif; // end have_posts() check ?>

			</div> <!-- /#thearticle.container-grid.text-inner.col-8 -->
			
                            <?php get_sidebar(); ?>
                        
                       
	</div> <!-- /#primary.site-content.row -->

<?php migdaloz_numeric_posts_nav(); ?>
<?php get_footer(); 
/*
 * This is the end of the main page template
 */
?>