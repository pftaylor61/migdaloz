<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Migdaloz
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<div id="home-main" class="info-row container-grid">
                            <div class="container-fluid info-container container-grid">
                                <?php while ( $mynewquery->have_posts() ) : $mypostid = $mynewquery->the_post(); 
                                        echo tst_post_featuredimage($mypostid);
                                ?>
        
                                <h2 class="less-top-pad"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      
                                <p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),55); ?> <a href="<?php the_permalink(); ?>" style="text-decoration: underline">More</a></p><br />
                            <?php      endwhile; ?>
      
                            </div>
                                <?php migdaloz_numeric_posts_nav(); ?>
                        </div>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
