<?php
/**
 * The template for displaying asides.
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!-- checking new themme -->
                
            
		
                
		<header class="entry-header">
			
			<?php migdaloz_posted_on(); ?>
			<?php if ( has_post_thumbnail()) { ?>
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
