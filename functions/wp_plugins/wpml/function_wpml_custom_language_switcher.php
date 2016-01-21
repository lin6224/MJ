<?php
//initialize language array
$get_languages = array();

//check wpml function exists or not to determine wpml exists
if(function_exists('icl_get_languages')){

	//get language array
	$get_languages = icl_get_languages();
	
	
	/**
	 * Function: custom_get_inactive_language - get inactive language
	 * Author: JF
	 * Note: Works for only two languages
	 * Date: May 29, 2014
	 */
	function custom_get_inactive_language(){
		global $get_languages;
		foreach($get_languages as $each_language_code => $each_language_attr){
			if($each_language_attr['active'] == 0){
				return $each_language_attr;
			}
		}
		return false;
	}
	
	
	/**
	 * Function: custom_get_wpml_language_link - custom code for getting wpml language toggle link
	 * Author: JF
	 * Date: May 29, 2014
	 */
	function custom_get_wpml_language_link(){
		global $post, $current_child_site, $wp_query, $home_url;
		$wpml_post_name = '';
		
		//get current inactive language code
		$get_inactive_language = custom_get_inactive_language();
		// get the post ID in en
		$wpml_post_id = icl_object_id($post->ID, $post->post_type, true, $get_inactive_language['language_code']);
		// get the post object
		$wpml_post_obj = get_post($wpml_post_id);
		// get the name
		$wpml_post_name = $wpml_post_obj->post_name;
		if(is_archive()){
			$wpml_post_name = $wp_query->query['post_type'];
		}
		if(is_singular('cpt')){
			$wpml_post_name = 'cpt/'.$wpml_post_name;
		}
		if(is_front_page()){
			$wpml_post_name = '';
		}
		if(is_home()){//check home blog listing
			//$wpml_post_name = 'blog';
		}
		
		if(is_page()){
			$translated_url = get_permalink($wpml_post_id);
			return '<a href="'.$translated_url.'">'.$get_inactive_language['native_name'].'</a>';
		}else{
			//output language switch link
			return '<a href="'.$home_url.'/'.$get_inactive_language['language_code'].'/'.$wpml_post_name.'/">'.$get_inactive_language['native_name'].'</a>';
		}
	}
	
}


?>