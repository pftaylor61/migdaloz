<?php
/*
 * This is the template for the footer for
 * Migdaloz theme
 */
$footer_root_url = trailingslashit( get_stylesheet_directory_uri() );
?>
    
    <footer class="site-footer row" role="contentinfo">

			<?php
			// Count how many footer sidebars are active so we can work out how many containers we need
			$footerSidebars = 0;
			for ( $x=1; $x<=4; $x++ ) {
				if ( is_active_sidebar( 'sidebar-homepage' . $x ) ) {
					$footerSidebars++;
				}
			}

			// If there's one or more one active sidebars, create a row and add them
			if ( $footerSidebars > 0 ) { ?>
				<?php
				// Work out the container class name based on the number of active footer sidebars
				$containerClass = "grid_" . 12 / $footerSidebars . "_of_12";

				// Display the active footer sidebars
				for ( $x=1; $x<=4; $x++ ) {
					if ( is_active_sidebar( 'sidebar-homepage'. $x ) ) { ?>
						<div class="col <?php echo $containerClass?>">
							<div class="widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-homepage'. $x ); ?>
							</div>
						</div> <!-- /.col.<?php echo $containerClass?> -->
					<?php }
				} ?>

			<?php } ?>

		</footer> <!-- /.site-footer.row -->

    <div class="container-grid footer">
    <?php
    /*
    <footer class="container-fluid container-grid">
      <a class="link-text footer-nav-link" href="index.html">Home</a>
      <a class="link-text footer-nav-link" href="about.html">About</a>
      <a class="link-text footer-nav-link" href="services.html">Services</a>
    </footer>
     * 
     */
    ?>
      
    <div class="social-media-icons">
            <?php echo migdaloz_get_social_media(); ?>
    </div>
  </div>
<div id="footer_credits" class="container-grid copyright">
    <p class="paragraph footer-fine-print"><br>
    <?php 
        $mgdlz_footer_content = of_get_option('footer_content');
        if (trim($mgdlz_footer_content)=='') {
            $mgdlz_footer_content = migdaloz_get_credits();
        }
        echo $mgdlz_footer_content;
    ?>
    </p>
    
    
    
  </div><!-- /#footer_credits -->
  
<script>
$(function() {
$('a[href*=#]:not([href=#])').click(function() {
if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
var target = $(this.hash);
target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
if (target.length) {
$('html,body').animate({
scrollTop: target.offset().top
}, 1000);
return false;
}
}
});
});
</script>
<?php wp_footer(); ?>
</body>

</html>