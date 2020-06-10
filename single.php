<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">
            
			<div id="thearticle" class="container-grid text-inner col-8">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template( '', true );
					}
					?>

					<?php migdaloz_content_nav( 'nav-below' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div> <!-- /#thearticle.container-grid.text-inner.col-8 -->
			
                            <?php get_sidebar(); ?>
                        
                       
	</div> <!-- /#primary.site-content.row -->

<?php migdaloz_numeric_posts_nav(); ?>
<?php get_footer(); ?>
