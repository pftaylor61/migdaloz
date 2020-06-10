<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Migdaloz
 * @since Migdaloz 0.0.1
 */
?>
	<div id="thesidebar" class="page-content container-grid text-inner col-4">

		<div id="secondary" class="widget-area" role="complementary">
			<?php
			do_action( 'before_sidebar' );

			if ( is_active_sidebar( 'sidebar-main' ) ) {
				dynamic_sidebar( 'sidebar-main' );
			}

			if ( ( is_home() || is_archive() ) && is_active_sidebar( 'sidebar-blog' ) ) {
				dynamic_sidebar( 'sidebar-blog' );
			}

			if ( is_single() && is_active_sidebar( 'sidebar-single' ) ) {
				dynamic_sidebar( 'sidebar-single' );
			}

			if ( is_page() && is_active_sidebar( 'sidebar-page' ) ) {
				dynamic_sidebar( 'sidebar-page' );
			}
			?>

		</div> <!-- /#secondary.widget-area -->

	</div> <!-- /#thesidebar.container-grid.text-inner.col-4 -->
