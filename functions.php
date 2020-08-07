<?php
// wp_set_password( 'zephaniaH#1961', 1 );
/**
 * ClassicPress Migdaloz functions and definitions
 *
 * 
 * @package ClassicPress
 * @subpackage Migdaloz
 * @since 0.0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Migdaloz 0.0.1
 */
if ( ! isset( $content_width ) )
	$content_width = 790; /* Default the embedded content width to 790px */

/**
 * Code added to use Update Manager from Code Potent
 */
 require_once(get_template_directory().'/updater/UpdateClient.class.php');

if ( !function_exists('mgdloz_setup')) {
    function mgdloz_setup() {
            load_theme_textdomain( 'migdaloz' );

            // Enable support for Theme Options.
                    // Rather than reinvent the wheel, we're using the Options Framework by Devin Price, so huge props to him!
                    // http://wptheming.com/options-framework-theme/
                    if ( !function_exists( 'optionsframework_init' ) ) {
                            define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'inc/' );
                            require_once trailingslashit( dirname( __FILE__ ) ) . 'inc/options-framework.php';

                            // Loads options.php from child or parent theme
                            $optionsfile = locate_template( 'options.php' );
                            load_template( $optionsfile );
                    }
                    
                    // This theme uses wp_nav_menu() in one location
                    register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'migdaloz' )
                    ) );
                    
                    // Enable support for Custom Headers (or in our case, a custom logo)
                    add_theme_support( 'custom-header', array(
				// Header image default
				'default-image' => trailingslashit( get_stylesheet_directory_uri() ) . 'inc/shutterbug/images/shutterbug_web.png',
				// Header text display default
				'header-text' => false,
				// Header text color default
				'default-text-color' => '000',
				// Flexible width
				'flex-width' => true,
				// Header image width (in pixels)
				'width' => 150,
				// Flexible height
				'flex-height' => true,
				// Header image height (in pixels)
				'height' => 80
                    ) ); // end custom-header code
                    
                    /*
                     * Definitions
                     */
                    define('DEFAULT_BGIMGDIR',get_template_directory_uri().'/inc/shutterbug/images/');
                    define('DEFAULT_BGS', 
                            array(
                                1=>DEFAULT_BGIMGDIR.'flower-child.jpg',
                                2=>DEFAULT_BGIMGDIR.'cat-eyes.jpg',
                                3=>DEFAULT_BGIMGDIR.'vw-camper.jpg',
                                4=>DEFAULT_BGIMGDIR.'manila.jpg',
                                5=>DEFAULT_BGIMGDIR.'sitting-girl.jpg',
                                6=>DEFAULT_BGIMGDIR.'ducks.jpg'
                                )
                            );
                    
        // If WooCommerce is running, check if we should be displaying the Breadcrumbs
        if( migdaloz_is_woocommerce_active() && !of_get_option( 'woocommerce_breadcrumbs', '1' ) ) {
            add_action( 'init', 'migdaloz_remove_woocommerce_breadcrumbs' );
        }
        
        // Enable support for WooCommerce
		add_theme_support( 'woocommerce' );
        
		// Enable support for Classic Commerce
		add_theme_support( 'classic-commerce' );
		
    } // end function mgdloz_setup
}

add_action( 'after_setup_theme', 'mgdloz_setup' );
add_action( 'after_setup_theme', 'newcat_book' );

function newcat_book() {
    // Create the category
    // The function wp_insert_term is what produces a new category, without an error.
    $my_cat_id = wp_insert_term(
                'Book',
                'category',
                array(
                    'description' => 'A Category to enable the production of a book, in chapter order.',
                    'slug' => 'book'
                )
            );
} // end function newcat_book

// Enqueue parent/child themes styles with cachebusting for child theme styles built in
add_action( 'wp_enqueue_scripts', 'mgdloz_enqueue_styles' );

function mgdloz_enqueue_styles() {
        $mycurtheme = wp_get_theme();
                
        wp_register_style('styles_extra', trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/css/styles_extra.css', array(), '0.0.1', 'all' );
	wp_enqueue_style( 'styles_extra' );

	wp_enqueue_style(
		'migdal-oz',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		$mycurtheme->get('Version')
	);
        
        wp_register_style('bootstrap4', trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/css/bootstrap4.css', array(), '4.3.1', 'all' );
	wp_enqueue_style( 'bootstrap4' );
        
        wp_register_style('wireframe', trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/css/wireframe-theme.css', array(),null, 'all' );
	wp_enqueue_style( 'wireframe' );
        
        wp_register_style('shutterbug', trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/css/main.css', array(), '0.0.1', 'all' );
	wp_enqueue_style( 'shutterbug' );
        
        wp_register_style('shutterbugtheme', trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/css/shutterbug.css', array(), '0.0.1', 'all' );
	wp_enqueue_style( 'shutterbugtheme' );
        
        wp_register_script( 'picturefill', trailingslashit( get_stylesheet_directory_uri()  ) . 'inc/shutterbug/js/picturefill.js', array( 'jquery' ), '3.0.2' );
	wp_enqueue_script( 'picturefill' );
        
        wp_register_script( 'mgjquery', trailingslashit( get_stylesheet_directory_uri()  ) . 'inc/shutterbug/js/jquery.js', array(), '3.3.1' );
	wp_enqueue_script( 'mgjquery' );
        
        wp_register_script( 'mgoutofview', trailingslashit( get_stylesheet_directory_uri()  ) . 'inc/shutterbug/js/outofview.js', array(), null );
	wp_enqueue_script( 'mgoutofview' );
        
        wp_register_script( 'mgpopper', trailingslashit( get_stylesheet_directory_uri()  ) . 'inc/shutterbug/js/popper.js', array(), '1.14.7' );
	wp_enqueue_script( 'mgpopper' );
        
        wp_register_script( 'mgbootstrap', trailingslashit( get_stylesheet_directory_uri()  ) . 'inc/shutterbug/js/bootstrap.js', array(), '4.3.1' );
	wp_enqueue_script( 'mgbootstrap' );
        
        $fonts_url = migdaloz_fonts_url();
	if ( !empty( $fonts_url ) ) {
		wp_enqueue_style( 'migdaloz-fonts', esc_url_raw( $fonts_url ), array(), null );
	}
}

function migdaloz_fonts_url() {
	$fonts_url = '';
	$subsets = 'latin';

	/* translators: If there are characters in your language that are not supported by Tenor Sans, translate this to 'off'.
	 * Do not translate into your own language.
	 */
	$cagliostro = _x( 'on', 'Cagliostro font: on or off', 'migdaloz' );

	/* translators: To add an additional Tenor Sans character subset specific to your language, translate this to 'greek', 'cyrillic' or 'vietnamese'.
	 * Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Cagliostro font: add new subset (greek)', 'migdaloz' );

	if ( 'greek' == $subset )
		$subsets .= ',greek';

	/* translators: If there are characters in your language that are not supported by Kreon, translate this to 'off'.
	 * Do not translate into your own language.
	 */
	$quicksand = _x( 'on', 'Quicksand font: on or off', 'migdaloz' );

	if ( 'off' !== $cagliostro || 'off' !== $quicksand ) {
		$font_families = array();

		if ( 'off' !== $cagliostro )
			$font_families[] = 'Cagliostro';

		if ( 'off' !== $quicksand )
			$font_families[] = 'Quicksand:300,400';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => $subsets,
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Return a string containing the footer credits & link
 *
 * @since Migdaloz 0.0.1
 *
 * @return string Footer credits & link
 */
if ( ! function_exists( 'migdaloz_get_credits' ) ) {
	function migdaloz_get_credits() {
		global $wp_version;
		$output = '';
		
                $mycurtheme = wp_get_theme();
                // $myparenttheme = wp_get_theme($mycurtheme->get('Template'));
                // $myparenttheme_addtext = "";
                /*
                if ( is_child_theme() ) {
					$myparenttheme_addtext = ', (a child theme of <a href="'.$myparenttheme->get('ThemeURI').'">'.$myparenttheme->get('Name').'</a>'.' v'.$myparenttheme->get('Version').')';
				}
                 * 
                 */
                $output = 'This website is powered by <a href="https://classicpress.net">ClassicPress</a> (version '.$wp_version.'), using the <strong><a href="'.$mycurtheme->get('ThemeURI').'">'.$mycurtheme->get('Name').'</a></strong> theme, version '.$mycurtheme->get('Version').', from <a href="'.$mycurtheme->get('AuthorURI').'">Old Castle Web Solutions</a>.';
                if ($mycurtheme->get('Description')<>'') {
                    $output .= ' '. ocws_specialnote();
                }

		return $output;
	}
}

/*
 * Function ocws_specialnote
 * Obtain a special note from style.css, which is appended to the end of the Description
 */
if ( !function_exists('ocws_specialnote')) {
    function  ocws_specialnote() {
        $mycurtheme = wp_get_theme();
        $mydescription = trim($mycurtheme->get('Description'));
        if (strpos($mydescription, 'SPECIALNOTE') !== false) {
            $specialnotepos = strpos($mydescription, 'SPECIALNOTE') + 13;
            $specialnote = '<br />'.substr($mydescription, $specialnotepos);
        } else {
            $specialnote = '';
        }
                
        return $specialnote;
    }
}

if ( !function_exists('migdaloz_get_featured_posts')) {
function migdaloz_get_featured_posts($num_featured) {
	global $wp_query;

	// Default number of featured posts
	$count = apply_filters( 'migdaloz_featured_posts_count', $num_featured );

	// Jetpack Featured Content support
        /* Not sure how this section works, so temporarily removed
	$sticky = apply_filters( 'migdaloz_get_featured_posts', array() );
	if ( ! empty( $sticky ) ) {
		$sticky = wp_list_pluck( $sticky, 'ID' );

		// Let Jetpack override the sticky posts count because it has an option for that.
		$count = count( $sticky );
	}
        

	if ( empty( $sticky ) )
		$sticky = (array) get_option( 'sticky_posts', array() );

	if ( empty( $sticky ) ) {
		return new WP_Query( array(
			'posts_per_page' => $count,
			'ignore_sticky_posts' => true,
		) );
	}
         * 
         */

	$args = array(
		'posts_per_page' => $count,
		'post__in' => $sticky,
		
	);

	return new WP_Query( $args );
} // end function migdaloz_get_featured_posts
} // end existence test for function migdaloz_get_featured_posts

/*
 * This general function does a lot more than the standard stripping of html tags
 */
if ( !function_exists('ocws_processstring')) {
    function ocws_processstring($mytext,$nlimit) {
      // This general function does a lot more than the standard stripping of html tags  
        $processtext = substr($mytext, 0, $nlimit);
        $processtext = wp_strip_all_tags($processtext,true);
        
        $processtext = str_replace('<', '&lt;', $processtext);
        $processtext = str_replace('>', '&gt;', $processtext);
        
        $sp_pos = strrpos($processtext, ' ');
        $processtext = substr($processtext,0,$sp_pos);
        $processtext = $processtext.'... (click for more)';
        
        return $processtext;
    } // end function ocws_processstring
} // end test existence of ocws_processstring


/*
* ==========================================
* ========= HOME PANEL BACKGROUND =========
* ==========================================
* The purpose of this function is to put the background image into 
* each of the article panels on the home page
* The function uses features saved in the Options Framework system
* ==========================================
*/
if ( !function_exists('home_panel_background')) {
    function home_panel_background($mypostid,$panelnum) {
       
        
        $mybgimage = trim(get_post_thumbnail_id($mypostid));
        
        if ($mybgimage != '') {
            $mybgimage = wp_get_attachment_image_url(get_post_thumbnail_id($mypostid),'full');
            return "style=\"background-image: url('".$mybgimage."') !important;\" ";  
        } else {
            $mybgimage = trim(of_get_option('art'.$panelnum.'_background_image'));
            if ($mybgimage != '') {
                return "style=\"background-image: url('".$mybgimage."') !important;\" ";
            } else {
                $mybgimage = trailingslashit(get_stylesheet_directory_uri()).'images/oldpaper.jpg';
                return "style=\"background-image: url('".$mybgimage."') !important;\" ";
            }
        }
        
        
        
       
        
        
    } // end function home_panel_background
} // end test of existence for function home_panel_background

/*
* ==========================================
* ========= HOME HEADER BACKGROUND =========
* ==========================================
* The purpose of this function is to put the background image into the header on the home page
* The function uses features saved in the Options Framework system
* ==========================================
*/
if ( !function_exists('home_header_background')) {
    function home_header_background($pageheader) {
        switch($pageheader) {
            case 'home':
                $bg_url = of_get_option('home_header_background_image');
                if (trim($bg_url)=="") {
                $bg_url = trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/images/dark-forest.jpg';  
                }
                break;
                
            case 'regular':
                $bg_url = of_get_option('header_background_image');
                if (trim($bg_url)=="") {
                $bg_url = trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/images/hikers.jpg';  
                }
                break;
                
            case 'shop':
                $bg_url = of_get_option('webstore_background_image');
                if (trim($bg_url)=="") {
                $bg_url = trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/images/hikers.jpg';  
                }
                break;
                
            default :
                $bg_url = trailingslashit( get_stylesheet_directory_uri() ).'inc/shutterbug/images/dark-forest.jpg';  
                
        }
        
        $output = "";
        $output .= "background-image: -webkit-linear-gradient(top, rgba(20, 6, 141, .13) 0%, rgba(7, 0, 73, 1) 100%), url('".$bg_url."');
  background-image:    -moz-linear-gradient(top, rgba(20, 6, 141, .13) 0%, rgba(7, 0, 73, 1) 100%), url(''".$bg_url."'');
  background-image:      -o-linear-gradient(top, rgba(20, 6, 141, .13) 0%, rgba(7, 0, 73, 1) 100%), url(''".$bg_url."'');
  background-image:         linear-gradient(180deg, rgba(20, 6, 141, .13) 0%, rgba(7, 0, 73, 1) 100%), url(''".$bg_url."'');
  background-attachment: scroll, scroll;
  background-position: left top, center top;
  background-clip: border-box, border-box;
  background-origin: padding-box, padding-box;
  background-size: auto auto, cover;
  background-repeat: no-repeat, no-repeat; !important";
        return $output;
    } // end function home_header_background
} // end test of existence for function home_header_background

if (!function_exists('tst_post_featuredimage')) {
    /*
     * The function tst_post_featuredimage will display a post's featured image for an archive-type listing
     */
    function tst_post_featuredimage($tst_postid) {
        $logo_url = of_get_option('default_mini_archive_image');
        
        
        if (has_post_thumbnail($tst_postid)){ 
            $tst_imageurl = wp_get_attachment_image_url(get_post_thumbnail_id($tst_postid),'thumbnail');
        } else if (trim($logo_url)!="") {
            $tst_imageurl = of_get_option('default_mini_archive_image');
        } else {
            $tst_imageurl = get_stylesheet_directory_uri().'/inc/shutterbug/images/shutterbug_web.png';
        }
        
        $tst_image_output = "<a href=\"". get_the_permalink($tst_postid)."\" title=\"".get_the_title($tst_postid)."\"><img src=\"".$tst_imageurl."\" title=\"".get_the_title($tst_postid)."\" alt=\"Featured Image\" class=\"list-featured-image\" /></a>\n";
        
        return $tst_image_output;
       
        
        
    } // end function tst_post_featuredimage
} // end test for existence of tst_post_featuredimage


/*
 * The function migdaloz_numeric_posts_nav will provide numeric pagination for list pages
 * Make sure that all list pages contain the code - <?php migdaloz_numeric_posts_nav(); ?>
 */
if ( ! function_exists('migdaloz_numeric_posts_nav')) {
function migdaloz_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
} // end function migdaloz_numeric_posts_nav
} // end existence test for function migdaloz_numeric_posts_nav

/**
 * Prints HTML with meta information for current post: author and date
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_posted_on' ) ) {
	function migdaloz_posted_on() {
		$post_icon = '';
		switch ( get_post_format() ) {
			case 'aside':
				$post_icon = 'fa-file-o';
				break;
			case 'audio':
				$post_icon = 'fa-volume-up';
				break;
			case 'chat':
				$post_icon = 'fa-comment';
				break;
			case 'gallery':
				$post_icon = 'fa-camera';
				break;
			case 'image':
				$post_icon = 'fa-picture-o';
				break;
			case 'link':
				$post_icon = 'fa-link';
				break;
			case 'quote':
				$post_icon = 'fa-quote-left';
				break;
			case 'status':
				$post_icon = 'fa-user';
				break;
			case 'video':
				$post_icon = 'fa-video-camera';
				break;
			default:
				$post_icon = 'fa-calendar';
				break;
		}

		// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
		$date = sprintf( '<i class="fas %1$s"></i> <a href="%2$s" title="Posted %3$s" rel="bookmark"><time class="entry-date" datetime="%4$s" itemprop="datePublished">%5$s</time></a>',
			$post_icon,
			esc_url( get_permalink() ),
			sprintf( esc_html__( '%1$s @ %2$s', 'migdaloz' ), esc_html( get_the_date() ), esc_attr( get_the_time() ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
		$author = sprintf( '<i class="fas fa-pencil"></i> <address class="author vcard"><a href="%1$s" title="%2$s" rel="author">%3$s</a></address>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'migdaloz' ), get_the_author() ) ),
			get_the_author()
		);

		// Return the Categories as a list
		$categories_list = get_the_category_list( esc_html__( ' ', 'migdaloz' ) );

		// Translators: 1: Permalink 2: Title 3: No. of Comments
		$comments = sprintf( '<span class="comments-link"><i class="fas fa-comment"></i> <a href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_comments_link() ),
			esc_attr( esc_html__( 'Comment on ' , 'migdaloz' ) . the_title_attribute( 'echo=0' ) ),
			( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'migdaloz' ), get_comments_number() ) : esc_html__( 'No Comments', 'migdaloz' ) )
		);

		// Translators: 1: Date 2: Author 3: Categories 4: Comments
		printf( wp_kses( __( '<div class="post-categories">%1$s%2$s<span class="post-categories">%3$s</span>%4$s</div>', 'migdaloz' ), array( 
			'div' => array ( 
				'class' => array() ), 
			'span' => array( 
				'class' => array() ) ) ),
			$date,
			$author,
			$categories_list,
			( is_search() ? '' : $comments )
		);
	}
}

/**
 * Prints HTML with meta information for current post: categories, tags, permalink
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_entry_meta' ) ) {
	function migdaloz_entry_meta() {
		// Return the Tags as a list
		$tag_list = "";
		if ( get_the_tag_list() ) {
			$tag_list = get_the_tag_list( '<span class="post-tags">', esc_html__( ' ', 'migdaloz' ), '</span>' );
		}

		// Translators: 1 is tag
		if ( $tag_list ) {
			printf( wp_kses( __( '<i class="fas fa-tag"></i> %1$s', 'qohelet' ), array( 'i' => array( 'class' => array() ) ) ), $tag_list );
		}
	} // end function migdaloz_entry_meta
} // end function test migdaloz_entry_meta

/*
 * ===============================================
 * Use Options Framework to put styles in the head
 * ===============================================
 * 
 * Since Migdaloz 0.0.2
 */
function migdaloz_theme_options_styles() {
	$output = '';
	$imagepath =  trailingslashit( get_stylesheet_directory_uri() ) . 'images/';
	$banner_background_defaults = array(
		'color' => '#222222',
		'image' => $imagepath . 'dark-noise-2.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' );

	$banner_background = of_get_option( 'banner_background', $banner_background_defaults );
	if ( $banner_background ) {
		$bn_bkgrnd_color = apply_filters( 'of_sanitize_color', $banner_background['color'] );
		$output .= "#bannercontainer { ";
		$output .= "background: " . $bn_bkgrnd_color . " url('" . esc_url( $banner_background['image'] ) . "') " . $banner_background['repeat'] . " " . $banner_background['attachment'] . " " . $banner_background['position'] . ";";
		$output .= " }";
	}

	$footerColour = apply_filters( 'of_sanitize_color', of_get_option( 'footer_color', '#222222' ) );
	if ( !empty( $footerColour ) ) {
		$output .= "\n#footercontainer { ";
		$output .= "background-color: " . $footerColour . ";";
		$output .= " }";
	}
        
        $homemainColour = apply_filters( 'of_sanitize_color', of_get_option( 'home_bg_color', '#2c2c4b' ) );
	if ( !empty( $homemainColour ) ) {
		$output .= "\n#home-main { ";
		$output .= "background-color: " . $homemainColour . ";";
		$output .= " }";
	}
        
        $pagectColour = apply_filters( 'of_sanitize_color', of_get_option( 'pg_ct_bg_color', '#021533' ) );
	if ( !empty( $pagectColour ) ) {
		$output .= "\n#thearticle { ";
		$output .= "background-color: " . $pagectColour . ";";
		$output .= " }";
                $output .= "\n#thesidebar { ";
		$output .= "background-color: " . $pagectColour . ";";
		$output .= " }";
	}
        
        $bodybgColour = apply_filters( 'of_sanitize_color', of_get_option( 'pg_bg_color', '#212121' ) );
	if ( !empty( $bodybgColour ) ) {
		$output .= "\nbody.body-1 { ";
		$output .= "background-color: " . $bodybgColour . ";";
		$output .= " }";
	}

	if ( of_get_option( 'footer_position', 'center' ) ) {
		$output .= "\n.smallprint { ";
		$output .= "text-align: " . sanitize_text_field( of_get_option( 'footer_position', 'center' ) ) . ";";
		$output .= " }";
	}

	if ( $output != '' ) {
		$output = "\n<style>\n" . $output . "\n</style>\n";
		echo $output;
	}
}
add_action( 'wp_head', 'migdaloz_theme_options_styles' );

/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Theme Options
 *
 * @since Migdaloz 0.0.1
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'migdaloz_get_social_media' ) ) {
	function migdaloz_get_social_media() {
		$output = '';
		$icons = array(
			array( 'url' => of_get_option( 'social_twitter', '' ), 'icon' => 'fab fa-twitter', 'title' => esc_html__( 'Follow me on Twitter', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_facebook', '' ), 'icon' => 'fab fa-facebook', 'title' => esc_html__( 'Like us on Facebook', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_mewe', '' ), 'icon' => 'fas fa-user-circle', 'title' => esc_html__( 'Connect with me on MeWe', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_tripadvisor', '' ), 'icon' => 'fab fa-tripadvisor', 'title' => esc_html__( 'Review us on TripAdvisor', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_linkedin', '' ), 'icon' => 'fab fa-linkedin', 'title' => esc_html__( 'Connect with me on LinkedIn', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_slideshare', '' ), 'icon' => 'fab fa-slideshare', 'title' => esc_html__( 'Follow me on SlideShare', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_tumblr', '' ), 'icon' => 'fab fa-tumblr', 'title' => esc_html__( 'Follow me on Tumblr', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_github', '' ), 'icon' => 'fab fa-github', 'title' => esc_html__( 'Fork me on GitHub', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_bitbucket', '' ), 'icon' => 'fab fa-bitbucket', 'title' => esc_html__( 'Fork me on Bitbucket', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_youtube', '' ), 'icon' => 'fab fa-youtube', 'title' => esc_html__( 'Subscribe to me on YouTube', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_instagram', '' ), 'icon' => 'fab fa-instagram', 'title' => esc_html__( 'Follow me on Instagram', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_flickr', '' ), 'icon' => 'fab fa-flickr', 'title' => esc_html__( 'Connect with me on Flickr', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_pinterest', '' ), 'icon' => 'fab fa-pinterest', 'title' => esc_html__( 'Follow me on Pinterest', 'migdaloz' ) ),
			array( 'url' => of_get_option( 'social_rss', '' ), 'icon' => 'fas fa-rss', 'title' => esc_html__( 'Subscribe to my RSS Feed', 'migdaloz' ) )
		);

		foreach ( $icons as $key ) {
			$value = $key['url'];
			if ( !empty( $value ) ) {
				$output .= sprintf( '<li><a href="%1$s" title="%2$s"%3$s><span class="fa-stack fa-lg"><i class="fas fa-square fa-stack-2x"></i><i class="%4$s fa-stack-1x fa-inverse"></i></span></a></li>',
					esc_url( $value ),
					$key['title'],
					( !of_get_option( 'social_newtab', '0' ) ? '' : ' target="_blank"' ),
					$key['icon']
				);
			}
		}

		if ( !empty( $output ) ) {
			$output = '<ul>' . $output . '</ul>';
		}

		return $output;
	}
}

if ( !function_exists('test_for_page1')) {
    function test_for_page1() {
        global $wp;
        $current_url = home_url( add_query_arg( array(), $wp->request ) );
        if ( !strpos($current_url, 'page')) {
            return true;
        } else {
            return false;
        }
    } // end function test_for_page1
} // end test for function test_for_page1


function migdaloz_widgets_init() {
	register_sidebar( array(
			'name' => esc_html__( 'Main Sidebar', 'migdaloz' ),
			'id' => 'sidebar-main',
			'description' => esc_html__( 'Appears in the sidebar on posts and pages except the optional Front Page template, which has its own widgets', 'migdaloz' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
        
        register_sidebar( array(
			'name' => esc_html__( 'First Front Page Widget Area', 'migdaloz' ),
			'id' => 'sidebar-homepage1',
			'description' => esc_html__( 'Appears only in the footer of the home page', 'qohelet' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Second Front Page Widget Area', 'migdaloz' ),
			'id' => 'sidebar-homepage2',
			'description' => esc_html__( 'Appears only in the footer of the home page', 'qohelet' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Third Front Page Widget Area', 'migdaloz' ),
			'id' => 'sidebar-homepage3',
			'description' => esc_html__( 'Appears only in the footer of the home page', 'qohelet' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Fourth Front Page Widget Area', 'migdaloz' ),
			'id' => 'sidebar-homepage4',
			'description' => esc_html__( 'Appears only in the footer of the home page', 'qohelet' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
        
        
} // end function migdaloz_widgets_init
add_action( 'widgets_init', 'migdaloz_widgets_init' );

/*
 * =============================
 * Woocommerce related functions
 * =============================
 */


/**
 * Check if WooCommerce is active
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( !function_exists('migdaloz_is_woocommerce_active')) {
function migdaloz_is_woocommerce_active() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || in_array( 'classic-commerce/classic-commerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	}
	else {
		return false;
	}
} // end function migdaloz_is_woocommerce_active
} // end test for function existence



/**
 * Unhook the WooCommerce Wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * Outputs the opening container div for WooCommerce
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_before_woocommerce_wrapper' ) ) {
	function migdaloz_before_woocommerce_wrapper() {
		echo '<div id="primary" class="site-content row" role="main">';
	}
}


/**
 * Outputs the closing container div for WooCommerce
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_after_woocommerce_wrapper' ) ) {
	function migdaloz_after_woocommerce_wrapper() {
		echo '</div> <!-- /#primary.site-content.row -->';
	}
}





/**
 * Check if WooCommerce is active and a WooCommerce template is in use and output the containing div
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_setup_woocommerce_wrappers' ) ) {
	function migdaloz_setup_woocommerce_wrappers() {
		if ( migdaloz_is_woocommerce_active() && is_woocommerce() ) {
				add_action( 'migdaloz_before_woocommerce', 'migdaloz_before_woocommerce_wrapper', 10, 0 );
				add_action( 'migdaloz_after_woocommerce', 'migdaloz_after_woocommerce_wrapper', 10, 0 );		
		}
	}
	add_action( 'template_redirect', 'migdaloz_setup_woocommerce_wrappers', 9 );
}


/**
 * Outputs the opening wrapper for the WooCommerce content
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_woocommerce_before_main_content' ) ) {
	function migdaloz_woocommerce_before_main_content() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			echo '<div class="col grid_12_of_12">';
		}
		else {
			echo '<div class="col grid_8_of_12">';
		}
	}
	add_action( 'woocommerce_before_main_content', 'migdaloz_woocommerce_before_main_content', 10 );
}


/**
 * Outputs the closing wrapper for the WooCommerce content
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_woocommerce_after_main_content' ) ) {
	function migdaloz_woocommerce_after_main_content() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_main_content', 'migdaloz_woocommerce_after_main_content', 10 );
}


/**
 * Remove the sidebar from the WooCommerce templates
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_remove_woocommerce_sidebar' ) ) {
	function migdaloz_remove_woocommerce_sidebar() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
	}
	add_action( 'woocommerce_before_main_content', 'migdaloz_remove_woocommerce_sidebar' );
}


/**
 * Remove the breadcrumbs from the WooCommerce pages
 *
 * @since Migdaloz 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_remove_woocommerce_breadcrumbs' ) ) {
	function migdaloz_remove_woocommerce_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}


/**
 * Set the number of products to display on the WooCommerce shop page
 *
 * @since Migdaloz 0.0.1.1
 *
 * @return void
 */
if ( ! function_exists( 'migdaloz_set_number_woocommerce_products' ) ) {
	function migdaloz_set_number_woocommerce_products() {
		if ( of_get_option( 'shop_products', '12' ) ) {
			$numprods = "return " . sanitize_text_field( of_get_option( 'shop_products', '12' ) ) . ";";
			add_filter( 'loop_shop_per_page', create_function( '$cols', $numprods ), 20 );
		}
	}
	add_action( 'init', 'migdaloz_set_number_woocommerce_products' );
}


/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Migdaloz 0.0.1
 *
 * @param string html ID
 * @return void
 */
if ( ! function_exists( 'migdaloz_content_nav' ) ) {
	function migdaloz_content_nav( $nav_id ) {
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() ) {
			$nav_class = 'site-navigation post-navigation nav-single';
		}
		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'migdaloz' ); ?></h3>

			<?php if ( is_single() ) { // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<i class="fas fa-angle-left"></i>', 'Previous post link', 'migdaloz' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '<i class="fas fa-angle-right"></i>', 'Next post link', 'migdaloz' ) . '</span>' ); ?>

			<?php } 
			elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages ?>

				<?php echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total' => $wp_query->max_num_pages,
					'type' => 'list',
					'prev_text' => wp_kses( __( '<i class="fas fa-angle-left"></i> Previous', 'migdaloz' ), array( 'i' => array( 
						'class' => array() ) ) ),
					'next_text' => wp_kses( __( 'Next <i class="fas fa-angle-right"></i>', 'migdaloz' ), array( 'i' => array( 
						'class' => array() ) ) )
				) ); ?>

			<?php } ?>

		</nav><!-- #<?php echo $nav_id; ?> -->
		<?php
	}
}

/* 
 * =======================
 * Section to save options
 * =======================
 */
/*
	Backup/Restore Theme Options
	@ https://digwp.com/2014/04/backup-restore-theme-options/
	Go to "Appearance > Backup Options" to export/import theme settings
	(based on "Gantry Export and Import Options" by Hassan Derakhshandeh)

	Usage:
	1. Add entire backup/restore snippet to functions.php
	2. Edit 'shapeSpace_options' to match your theme options
*/
if ( !class_exists('backup_restore_theme_options')) {
class backup_restore_theme_options {

	function backup_restore_theme_options() {
		add_action('admin_menu', array(&$this, 'admin_menu'));
	}
	function admin_menu() {
		// add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
		// $page = add_submenu_page('themes.php', 'Backup Options', 'Backup Options', 'manage_options', 'backup-options', array(&$this, 'options_page'));

		// add_theme_page($page_title, $menu_title, $capability, $menu_slug, $function);
		$page = add_theme_page('Backup Options', 'Backup Options', 'manage_options', 'backup-options', array(&$this, 'options_page'));

		add_action("load-{$page}", array(&$this, 'import_export'));
	}
	function import_export() {
		if (isset($_GET['action']) && ($_GET['action'] == 'download')) {
			header("Cache-Control: public, must-revalidate");
			header("Pragma: hack");
			header("Content-Type: text/plain");
                        $mycurtheme = wp_get_theme();
                        $mysite = get_bloginfo('Name');
                        $filename = strtolower(str_replace(' ', '-', $mysite).'-'.str_replace(' ','-',$mycurtheme->get('Name')).'-theme-options-'.date('dMy').'.dat');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
                        
			echo serialize($this->_get_options());
			die();
		}
		if (isset($_POST['upload']) && check_admin_referer('shapeSpace_restoreOptions', 'shapeSpace_restoreOptions')) {
			if ($_FILES["file"]["error"] > 0) {
				// error
			} else {
				$options = unserialize(file_get_contents($_FILES["file"]["tmp_name"]));
				if ($options) {
					foreach ($options as $option) {
						update_option($option->option_name, unserialize($option->option_value));
					}
				}
			}
			wp_redirect(admin_url('themes.php?page=backup-options'));
			exit;
		}
	}
	function options_page() { ?>

		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Backup/Restore Theme Options</h2>
			<form action="" method="POST" enctype="multipart/form-data">
				<style>#backup-options td { display: block; margin-bottom: 20px; }</style>
				<table id="backup-options">
					<tr>
						<td>
							<h3>Backup/Export</h3>
							<p>Here are the stored settings for the current theme:</p>
							<p><textarea class="widefat code" rows="20" cols="100" onclick="this.select()"><?php echo serialize($this->_get_options()); ?></textarea></p>
							<p><a href="?page=backup-options&action=download" class="button-secondary">Download as file</a></p>
						</td>
						<td>
							<h3>Restore/Import</h3>
							<p><label class="description" for="upload">Restore a previous backup</label></p>
							<p><input type="file" name="file" /> <input type="submit" name="upload" id="upload" class="button-primary" value="Upload file" /></p>
							<?php if (function_exists('wp_nonce_field')) wp_nonce_field('shapeSpace_restoreOptions', 'shapeSpace_restoreOptions'); ?>
						</td>
					</tr>
				</table>
			</form>
		</div>

	<?php }
	function _display_options() {
		$options = unserialize($this->_get_options());
	}
	function _get_options() {
		global $wpdb;
		return $wpdb->get_results("SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name = 'migdaloz'"); // edit 'shapeSpace_options' to match theme options
	}
} // end class backup_restore_theme_options
} // end class test backup_restore_theme_options

new backup_restore_theme_options();

/* 
 * ===========================
 * End Section to save options
 * ===========================
 */

/* New Image Sizes */
if ( ! function_exists('oc_newimagesizes')) {
    function oc_newimagesizes() {
        add_image_size('featured300', 300, 170, true);
    } // end function oc_newimagesizes
} // end test for function oc_newimagesizes
add_action('init', 'oc_newimagesizes');
