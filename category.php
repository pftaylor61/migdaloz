<?php
/**
 * The template for displaying an archive page for Categories.
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">

		<div class="container-grid text-inner archivepage col-8">

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">
					<h1 class="archive-title"><?php printf( esc_html__( 'Category Archives: %s', 'migdaloz' ), '<span class="cat-archive">' . single_cat_title( '', false ) . '</span>' ); ?></h1>

					<?php if ( category_description() ) { // Show an optional category description ?>
						<div class="archive-meta"><?php echo category_description(); ?></div>
					<?php } ?>
				</header>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); 
					echo "<div style=\"padding-left:24px; padding-left:1.5rem;\"".tst_post_featuredimage($mypostid)."</div>";
                                ?>

                    <h2 style="font-size: 1.7rem !important;" class="less-top-pad"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php migdaloz_posted_on(); ?>
                                <p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),55); ?> <a href="<?php the_permalink(); ?>" style="text-decoration: underline">More</a></p><br />
				<?php endwhile; 

				 migdaloz_content_nav( 'nav-below' );
                                 migdaloz_numeric_posts_nav(); 

                                else : 

				get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found 

			endif; // end have_posts() check ?>

		</div> <!-- /.container-fluid.info-container.container-grid -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.info-row.container-grid -->

<?php get_footer(); ?>
