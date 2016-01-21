<?php
/**
 * Require necessary php files or autoloading
 *
 */

//---grunt settings
//require_once 'grunt/grunt.settings.php';

//---admin
require_once "admin/theme_options.php";

//---global
require_once 'global/minify_html.php';//minify html
require_once 'global/site_helper.php';

//---require rest if needed
//require_once 'global/google_analytics_handle.php';
//require_once 'global/site_html_shortcode.php';
//require_once 'global/bootstrap/pagination_support.php';
//require_once 'global/mu_handle.php';//multi-site handle

/**
 * Function __autoload - lazy loading
 * Based on class name to automatically require class library file
 */
function clean_theme_autoload($class) {
  // looks for 'classes/user.php';
  $file = dirname(__FILE__).'/autoload_class/' .$class. '.php';
  if( file_exists($file) )
    require_once $file;
}
spl_autoload_register( 'clean_theme_autoload' );

//get UsersHelper - to be used globally
$users_helper = new UsersHelper();
//session to be used globally
$session = Session::load();
?>