<?php

/**
 * Function: custom_hide_adminbar - hide / show admin bar in front-end
 * Author: JF
 * Date: May 29, 2014
 */
function minify_html_callback($buffer) {
	$search = array(
        '/a\>[^\S ]+\<a/s',  // Tag cloud
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );
 
    $replace = array(
        'a> <a',
        '> ',
        ' <',
       	'\\1'
    );
 
    $buffer = preg_replace($search, $replace, $buffer);
  
	return $buffer;
}
//start buffer
function buffer_start() { ob_start("minify_html_callback"); }
//end buffer
function buffer_end() { ob_end_flush(); }
//add actioin

$site_minify_html_option = get_option('site_minify_html_option', '0');
if($site_minify_html_option){
	add_action('wp_head', 'buffer_start');
	add_action('wp_footer', 'buffer_end');
}

?>