<?php
/**
 * Setting up WooCommerce
 * Author: JF
 * Date: May 29, 2014
 */

$activated_wp_plugin_array = get_option( 'active_plugins' );

//check if woocommerce is activated
if(in_array('woocommerce/woocommerce.php', $activated_wp_plugin_array)){
	//unhook the WooCommerce wrappers
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	//hook in your own functions to display the wrappers your theme requires
	add_action('woocommerce_before_main_content', 'wc_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'wc_theme_wrapper_end', 10);
	
	//set up woocommerce wrapper
	function wc_theme_wrapper_start() {
		echo '<div id="wc-main-content" class="container">';
	}

	function wc_theme_wrapper_end() {
		echo '</div>';
	}
	
	//Declare WooCommerce support 
	add_theme_support( 'woocommerce' );
	
	//remove woocommerce sidebar
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar',10);
	
	//include necessary woocommerce supported files
	require_once 'wp_woocommerce_theme_functions.php';
}
?>