<?php
/*
 * This is the template for the front or home page for
 * Migdaloz theme
 */
$numfeatured = 6;
$featured_posts = migdaloz_get_featured_posts($numfeatured);
get_header('home'); 

?>

<?php
/*
 * Test for the whole home page section
 */
if (test_for_page1()) {
    
?>


<div class="container-grid show-3-2">
    <!-- row A - images 1 & 2 -->
    

    <?php if ( $featured_posts->have_posts() ) :  $mypostid = $featured_posts->the_post(); ?>
    <div <?php echo home_panel_background($mypostid,1); ?>class="background-image container-grid" id="image-1">
        
        
		
			<!-- code for the main featured article, number 1 -->
			<a href="<?php the_permalink(); ?>" class="link-container overlay-container" id="item-1">
                        <h2 class="image-heading"><?php the_title(); ?></h2>
                        <div class="rule thin-row"><hr></div><p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),100); ?></p></a>

<?php endif; ?>
       
    </div><!-- /image-1 -->
    
    <!-- image-2 -->
    <?php $mypostid = $featured_posts->the_post(); ?>
    <div <?php echo home_panel_background($mypostid,2); ?>class="background-image container-grid" id="image-2">
        
		
			<!-- code for the main featured article, number 2 -->
			<a href="<?php the_permalink(); ?>" class="link-container overlay-container" id="item-2">
                        <h2 class="image-heading"><?php the_title(); ?></h2>
                        <div class="rule thin-row"><hr></div><p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),100); ?></p></a>


    </div><!-- /image-2 -->
  </div><!-- end row A -->

<div class="container-grid show-2-3">
<!-- row B - images 3 & 4 -->

  <!-- image-3 -->
    <?php $mypostid = $featured_posts->the_post(); ?>
    <div <?php echo home_panel_background($mypostid,3); ?>class="background-image container-grid" id="image-3">
		
			<!-- code for the main featured article, number 3 -->
			<a href="<?php the_permalink(); ?>" class="link-container overlay-container" id="item-3">
                        <h2 class="image-heading"><?php the_title(); ?></h2>
                        <div class="rule thin-row"><hr></div><p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),100); ?></p></a>


    </div><!-- /image-3 -->
    
    
    <!-- image-4 -->
    <?php $mypostid = $featured_posts->the_post(); ?>
    <div <?php echo home_panel_background($mypostid,4); ?>class="background-image container-grid" id="image-4">
		
			<!-- code for the main featured article, number 4 -->
			<a href="<?php the_permalink(); ?>" class="link-container overlay-container" id="item-4">
                        <h2 class="image-heading"><?php the_title(); ?></h2>
                        <div class="rule thin-row"><hr></div><p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),100); ?></p></a>


    </div><!-- /image-4 -->
    
  </div><!-- end row B -->

  <div class="container-grid show-3-2">
  <!-- row C - images 5 & 6 -->
      
    <!-- image-5 -->
    <?php $mypostid = $featured_posts->the_post(); ?>
    <div <?php echo home_panel_background($mypostid,5); ?>class="background-image container-grid" id="image-5">
		
			<!-- code for the main featured article, number 5 -->
			<a href="<?php the_permalink(); ?>" class="link-container overlay-container" id="item-5">
                        <h2 class="image-heading"><?php the_title(); ?></h2>
                        <div class="rule thin-row"><hr></div><p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),100); ?></p></a>


    </div><!-- /image-5 -->
    
    
    <!-- image-6 -->
    <?php $mypostid = $featured_posts->the_post(); ?>
    <div <?php echo home_panel_background($mypostid,6); ?>class="background-image container-grid" id="image-6">
		
			<!-- code for the main featured article, number 6 -->
			<a href="<?php the_permalink(); ?>" class="link-container overlay-container" id="item-6">
                        <h2 class="image-heading"><?php the_title(); ?></h2>
                        <div class="rule thin-row"><hr></div><p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),100); ?></p></a>


    </div><!-- /image-6 -->
  </div><!-- end row C -->
  
  <?php
  } // end of test for whole front page section
  ?>
  
<?php
  $args = array(
		'offset'=>$numfeatured,
                'posts_per_page'=>5,
                'ignore_sticky_posts'=>true,
                'cat'=>-3,
	);
  if (test_for_page1()) {
    $mynewquery = new WP_Query($args);
  }
          
?>
  
  <div id="home-main" class="info-row container-grid">
    <div class="container-fluid info-container container-grid">
        <?php while ( have_posts() ) : $mypostid = the_post(); 
             echo tst_post_featuredimage($mypostid);
             if(get_post_format()=='aside') {
                 $mycategories_list = get_the_category_list( esc_html__( ' ', 'migdaloz' ) );
                 $myposttitle = '*aside '.$mycategories_list;
                 ?>
        <h2 class="less-top-pad"><a href="<?php the_permalink(); ?>"><?php echo $myposttitle; ?></a></h2>
        <?php
             } else {
                 ?>
        <h2 class="less-top-pad"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
        <?php
             }
        ?>
        
        
        <?php migdaloz_posted_on(); ?>
      
        <p class="paragraph image-paragraph"><?php echo ocws_processstring(get_the_excerpt(),55); ?> <a href="<?php the_permalink(); ?>" style="text-decoration: underline">More</a></p><br />
      <?php      endwhile; ?>
      
    </div>
      <?php migdaloz_numeric_posts_nav(); ?>
      <?php // the_posts_navigation(); ?>
  </div>
<?php
get_footer('home'); 
/*
 * This is the end of the front or home page template
 */
?>