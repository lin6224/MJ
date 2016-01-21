<?php

//DISABLE xmlrpc handling
add_filter("xmlrpc_enabled", "__return_false");
//if call this, just die.
if ( ! defined( "WPINC" ) ) {
	die;
}
//DISABLE xmlrpc pingback handling
add_filter( "xmlrpc_methods", "remove_xmlrpc_pingback_ping" );
function remove_xmlrpc_pingback_ping( $methods ) {
   unset( $methods["pingback.ping"] );
   return $methods;
}

//initialize global variables
$is_user_logged_in = is_user_logged_in();
$template_directory_uri = get_template_directory_uri();
$stylesheet_directory_uri = get_stylesheet_directory_uri();
$home_url = home_url();
$site_title = get_bloginfo("name");
$site_stylesheet_url = get_bloginfo("stylesheet_url");
$admin_email = get_bloginfo("admin_email");
//menu option
$site_menu_option = get_option("site_menu_option", "0");
//sticky header option
$site_sticky_header_option = get_option("site_sticky_header_option", "0");

//get blog listing url
$blog_url = ( get_option( "show_on_front" ) == "page" && get_option("page_for_posts") != false ) ? get_permalink( get_option("page_for_posts") ) : $home_url;

//get current user info
$current_user_id = "";//initialize current user id
$current_user_role = "";//initialize current user role
$current_user_login = "";//initialize current user login
$current_user = wp_get_current_user();//get current user
if(isset( $current_user ) && $current_user->ID != 0){
	$current_user_id = $current_user->ID;
	$current_user_role_array = $current_user->roles;
	$current_user_role = $current_user_role_array[0];
	$current_user_login = $current_user->user_login;
}

//mu
$current_blog_id = get_current_blog_id();

//global text domain constant
define("SITE_TEXT_DOMAIN", "radii");

//global custom post type items per page
define("CUSTOM_POST_PER_PAGE", 5);//use this for custom query to get post instead of default settings value 10 in wp admin


//more init functions add_action hooks here
?>