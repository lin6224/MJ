<?php
//site shortcode functions

/**
 * Function html layout shortcode - check if the theme has html layout shortcode
 * Author: JF
 * Modified: DT (added row-content-block and content-block classes)
 * Date: May 29, 2014
 */

//--- one_full
add_shortcode('one_full', 'shortcode_one_full');
function shortcode_one_full($atts, $content = null) {
	return '<div class="row row-content-block"><div class="grid-12 content-block">' .do_shortcode($content). '</div><div class="clear"></div></div>';
}

//--- one_half
add_shortcode('one_half', 'shortcode_one_half');
function shortcode_one_half($atts, $content = null) {
	$atts = shortcode_atts(
	array(
		'last' => 'no',
		'middle' => 'no'
	), $atts);
			
	if($atts['last'] == 'yes') {
		return '<div class="grid-6 content-block">' .do_shortcode($content). '</div><div class="clear"></div></div>';
	} else if($atts['middle'] == 'yes'){
		return '<div class="grid-6 content-block">' .do_shortcode($content). '</div>';
	} else {
		return '<div class="row row-content-block"><div class="grid-6 content-block">' .do_shortcode($content). '</div>';
	}
}

//--- one_third
add_shortcode('one_third', 'shortcode_one_third');
function shortcode_one_third($atts, $content = null) {
	$atts = shortcode_atts(
	array(
		'last' => 'no',
		'middle' => 'no'
	), $atts);
			
	if($atts['last'] == 'yes') {
		return '<div class="grid-4 content-block">' .do_shortcode($content). '</div><div class="clear"></div></div>';
	} else if($atts['middle'] == 'yes'){
		return '<div class="grid-4 content-block">' .do_shortcode($content). '</div>';
	} else {
		return '<div class="row row-content-block"><div class="grid-4 content-block">' .do_shortcode($content). '</div>';
	}
}

//--- two_third
add_shortcode('two_third', 'shortcode_two_third');
function shortcode_two_third($atts, $content = null) {
	$atts = shortcode_atts(
	array(
		'last' => 'no',
	), $atts);
			
	if($atts['last'] == 'yes') {
		return '<div class="grid-8 content-block">' .do_shortcode($content). '</div><div class="clear"></div></div>';
	} else {
		return '<div class="row row-content-block"><div class="grid-8 content-block">' .do_shortcode($content). '</div>';
	}
}

//--- one_fourth
add_shortcode('one_fourth', 'shortcode_one_fourth');
function shortcode_one_fourth($atts, $content = null) {
	$atts = shortcode_atts(
	array(
		'last' => 'no',
		'middle' => 'no'
	), $atts);
			
	if($atts['last'] == 'yes') {
		return '<div class="grid-3 content-block">' .do_shortcode($content). '</div><div class="clear"></div></div>';
	} else if($atts['middle'] == 'yes'){
		return '<div class="grid-3 content-block">' .do_shortcode($content). '</div>';
	} else {
		return '<div class="row row-content-block"><div class="grid-3 content-block">' .do_shortcode($content). '</div>';
	}
}

//--- three_fourth
add_shortcode('three_fourth', 'shortcode_three_fourth');
function shortcode_three_fourth($atts, $content = null) {
	$atts = shortcode_atts(
	array(
		'last' => 'no',
	), $atts);
			
	if($atts['last'] == 'yes') {
		return '<div class="grid-9 content-block">' .do_shortcode($content). '</div><div class="clear"></div></div>';
	} else {
		return '<div class="row row-content-block"><div class="grid-9 content-block">' .do_shortcode($content). '</div>';
	}
}

/**
 * Function check_html_layout_shortcode - check if the theme has html layout shortcode
 * Author: JF
 * Modified: JF
 * Date: May 29, 2014
 */
function check_html_layout_shortcode($content){
	if(has_shortcode( $content, 'one_full') || has_shortcode( $content, 'one_half') || has_shortcode( $content, 'one_third') || has_shortcode( $content, 'two_third') || has_shortcode( $content, 'one_fourth') || has_shortcode( $content, 'three_fourth')){
		return true;
	}
	return false;
}

/**
 * Function custom_shortcodes_formatter - get rid of extra p / br tag
 * Author: JF
 * Modified: JF
 * Date: May 29, 2014
 */
add_filter('the_content', 'custom_shortcodes_formatter');
add_filter('widget_text', 'custom_shortcodes_formatter');
 
function custom_shortcodes_formatter($content) {
	//get array of cases to be replaced
	$array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
    );

    $content = strtr($content, $array);
	
	return $content;
}
?>