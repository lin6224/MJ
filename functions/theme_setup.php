<?php
/**
 * Function: custom_theme_setup
 * 		- register menu location
 *		- load global text domain and locate PO/MO file
 * 		- add theme support for feature image if not enabled
 * 		- custom image resize
 * Author: JF
 * Date: Sep 10, 2015
 */

add_action( 'after_setup_theme', 'custom_theme_setup' );

function custom_theme_setup(){
	//enable post thumbnails - feature image
	add_theme_support( 'post-thumbnails' );
	//enable automatic feed links
	add_theme_support( 'automatic-feed-links' );
	
	//set up image resize option
	//update_option("medium_size_w", 320);
	//update_option("medium_size_h", 320);
	//add_image_size( 'medium', 0, 320, true ); //(cropped)
	
	//make sure to create folder languages folder in wp-content folder for placing PO/MO files
	load_theme_textdomain( SITE_TEXT_DOMAIN, ABSPATH.'/wp-content/languages' ); //load textdomain to locate po/mo
	
	//register menu location
	register_nav_menus( array(
		'main-menu' => 'Main Menu',
		'footer-menu' => 'Footer Menu',
		'mobile-menu' => 'Mobile Menu',
		'global-menu' => 'Global Menu'
	) );
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	
	//add custom header theme support
	add_theme_support( 'custom-header' );
	
	//add custom background theme support
	add_theme_support( 'custom-background' );
	
	//add title tag theme support
	add_theme_support( "title-tag" );
	
	//add editor style to theme
	add_editor_style();
	
	//content width?
	if ( ! isset( $content_width ) ) $content_width = 992;
}


/**
 * Function: custom_hide_adminbar - hide / show admin bar in front-end
 * Author: JF
 * Date: May 29, 2014
 */
if(is_user_logged_in()){
	add_filter('show_admin_bar', 'custom_hide_adminbar');
	function custom_hide_adminbar(){
		$site_admin_bar_option = get_option('site_admin_bar_option', '0');
		return ($site_admin_bar_option)? true : false;
	}
}


/**
 * Function: baw_hack_wp_title_for_home - customize wp title
 * Author: JF
 * Date: Oct 1, 2014
 */
add_filter( 'wp_title', 'custom_wp_title' );
function custom_wp_title( $title ){
	global $site_title;
	if( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return $site_title;
	}else{
		return $title . $site_title;
	}
	return $title;
}


/**
 * Function: custom_scripts_styles - add js/css to header or footer
 * Author: JF
 * Date: May 29, 2014
 */

add_action( 'wp_enqueue_scripts', 'custom_scripts_styles' );

function custom_scripts_styles() {
	global $stylesheet_directory_uri;
	
	wp_enqueue_script( 'jquery' );
	
	//link style.css
	wp_enqueue_style( 'style-css', $stylesheet_directory_uri. '/style.css' ); // site style css - empty css file with comment to link with wp
	
	$css_minify = get_option('css_minify', '0');
	$js_minify = get_option('js_minify', '0');
	$site_menu_option = get_option('site_menu_option', '0');
	
	//toggle css/js minify option to use minified version of css/js or use original source for debug
	if($css_minify == '1'){
		//link cached css/js
		wp_enqueue_style( 'site-min-css', $stylesheet_directory_uri. '/cache/site.min.css' ); // site style min css
	}else{
	    //link bootstrap css
		wp_enqueue_style( 'reset-css', $stylesheet_directory_uri. '/css/reset.css' ); // reset css
	
		//link bootstrap css
		wp_enqueue_style( 'bootstrap3-css', $stylesheet_directory_uri. '/css/bootstrap.min.css' ); // bootstrap min css
		wp_enqueue_style( 'bootstrap3-theme-css', $stylesheet_directory_uri. '/css/bootstrap-theme.min.css' ); // bootstrap theme min css
		
		//link font awesome
		wp_enqueue_style( 'font-awesome-css', $stylesheet_directory_uri.'/css/font-awesome.min.css' ); // font awesome css from online resource 4.4
		
		if($site_menu_option == 'mmenu'){
			//link mmenu plugin js and css
			wp_register_style('mmenu-menu-style', $stylesheet_directory_uri.'/css/jquery.mmenu.all.css');
			wp_enqueue_style( 'mmenu-menu-style' );
		}else if($site_menu_option == 'bootstrap'){
			//nothing yet
		}
		
		//---royal slider css
		//wp_enqueue_style( 'royalslider-css', $stylesheet_directory_uri. '/css/royalslider.css' );
		
		//link compiled sass css - REMOVED here but added to the bottom of HEADER for overwriting all CSS
		//wp_enqueue_style( 'site-sass-css', $stylesheet_directory_uri. '/css/sass.css' ); // site style min css
	}
	
	if($js_minify == '1'){
		//link cached js
		wp_enqueue_script( 'site-min-js', $stylesheet_directory_uri.'/cache/site.min.js','','',true );
	}else{
		//link bootstrap js
		wp_enqueue_script( 'bootstrap3-js', $stylesheet_directory_uri.'/js/bootstrap.min.js');
		//use hover to dropdown when necessary
		//wp_enqueue_script( 'bootstrap3-hover-dropdown-js', $stylesheet_directory_uri. '/js/bootstrap-hover-dropdown.min.js','','',true ); // bootstrap menu drop down hover js
		
		if($site_menu_option == 'mmenu'){
			//link mmenu plugin js
			wp_enqueue_script('mmenu-menu-script', $stylesheet_directory_uri.'/js/jquery.mmenu.min.all.js','','',true);
		}else if($site_menu_option == 'bootstrap'){
			//nothing yet
		}
		
		//link global common js
		wp_enqueue_script( 'common-js', $stylesheet_directory_uri. '/js/common.js','','',true ); // common js
		
		//link social share js
		//wp_enqueue_script( 'social-share-js', $stylesheet_directory_uri. '/js/social-share.js','','',true ); // social-share js
		
		//---royal slider js
		//wp_enqueue_script( 'royalslider-min-js', $stylesheet_directory_uri. '/js/jquery.royalslider.custom.min.js', array( 'jquery' ) );
		//wp_enqueue_script( 'royalslider-init-js', $stylesheet_directory_uri. '/js/rs-init.js', array( 'royalslider-min-js' ) );
	}
}


/**
 * add widgets sidebar
 * Modified: JF
 * Note: Do not provide back-end translation unless required by client
 * Date: May 29, 2014
 */

add_action( 'widgets_init', 'custom_widgets_init' );

function custom_widgets_init(){
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'id' => 'sidebar-1',
		'description' => 'Appears on posts and pages',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	/*register_sidebar(array(
		'name' => __( 'Footer 1', SITE_TEXT_DOMAIN ),
		'id' => 'footer-1',
		'description' => __( 'Appears on Footer Area 1', SITE_TEXT_DOMAIN ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="footer-section-title">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'name' => __( 'Footer 2', SITE_TEXT_DOMAIN ),
		'id' => 'footer-2',
		'description' => __( 'Appears on Footer Area 2', SITE_TEXT_DOMAIN ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="footer-section-title">',
		'after_title' => '</div>',
	));*/
}

?>