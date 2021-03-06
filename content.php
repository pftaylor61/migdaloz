<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!-- checking new themme -->
                
            
		<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
			<div class="featured-post">
				<?php esc_html_e( 'Featured post', 'migdaloz' ); ?>
			</div>
		<?php } 
                    ?>
                
		<header class="entry-header">
			<?php if ( is_single() || is_page() ) { ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php }
			else { 
                            echo "<div style=\"padding-left:24px; padding-left:1.5rem;\"".tst_post_featuredimage($mypostid)."</div>";
                            ?>
				<h2 style="font-size: 1.7rem !important;" class="less-top-pad"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php } // is_single() || is_page() ?>
			<?php migdaloz_posted_on(); ?>
			<?php if ( has_post_thumbnail() && !is_search() ) { ?>
                                <div id="oc_featured_image_container" class="featured_image_right">
                                    <a href="<?php the_post_thumbnail_url('full'); ?>">
					<?php the_post_thumbnail( 'featured300', array('alt' => 'Featured Image', 'title' => 'Featured Image') ); ?>
                                    </a>
                                </div><!-- /#oc_featured_image_container.featured_image_left -->
			<?php } ?>
		</header> <!-- /.entry-header -->

		<?php if ( is_search() ) { // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div> <!-- /.entry-summary -->
		<?php }
		else { ?>
			<div class="entry-content">
                                <?php 
                                if ( is_home () || is_category() || is_archive() ) {
                                    the_excerpt('');
                                    } else {
                                    the_content( wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'migdaloz' ), array( 'span' => array( 
					'class' => array() ) ) )
					); ?>

				<?php wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'migdaloz' ),
					'after' => '</div>',
					'link_before' => '<span class="page-numbers">',
					'link_after' => '</span>'
				) ); 
                                } // end of if statements
                                ?>
			</div> <!-- /.entry-content -->
		<?php } ?>

		<footer class="entry-meta">
			<?php if ( is_singular() ) {
				// Only show the tags on the Single Post page
				migdaloz_entry_meta();
			} ?>
			<?php edit_post_link( esc_html__( 'Edit', 'migdaloz' ) . ' <i class="fa fa-angle-right"></i>', '<div class="edit-link">', '</div>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) {
				// If a user has filled out their description and this is a multi-author blog, show their bio
				get_template_part( 'author-bio' );
			} ?>
		</footer> <!-- /.entry-meta -->
	</article> <!-- /#post -->
