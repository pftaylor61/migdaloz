<?php
/**
 * The Woocommerce and Classic Commerce template file.
 *
 * This file should provide full compatibility with either Woocommerce or Classic Commerce plugins.
 * The file will remain unused, if neither of these plugins is installed, so no problems should be caused.
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */

get_header('shop'); ?>
<div id="primary" class="site-content row" role="main">
            
			<div id="thearticle" class="container-grid text-inner col-8">

				<?php woocommerce_content(); ?>

			</div> <!-- /#thearticle.container-grid.text-inner.col-8 -->
                        
                        
                        <?php migdaloz_content_nav( 'nav-below' ); ?>
			
                            <?php get_sidebar(); ?>
                        
                       
	</div> <!-- /#primary.site-content.row -->
  

<?php
get_footer(); 
/*
 * This is the end of the main page template
 */
?>