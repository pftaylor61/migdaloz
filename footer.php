<?php
/*
 * This is the template for the footer for
 * Migdaloz theme
 */
$footer_root_url = trailingslashit( get_stylesheet_directory_uri() );
?>
    
    

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