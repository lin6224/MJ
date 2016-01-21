<?php

/**
 * Multi-site handling
 *
 */
$multi_sites_array = array(
'subsite_slug' //multi-site site slug array
);
$multi_sites_name_array = array(
'subsite_slug' => 'Subsite Name' //multi-site site name array
);
$current_child_site = '';//current child site global variable

/**
 * function get_current_site_identity
 * function to return current sub site identity based on search from multi-site site slug array
 */
if(!function_exists('get_current_site_identity')){
	function get_current_site_identity($identifier_array){
		global $current_blog;
		foreach($identifier_array as $each_identity){
			if(strpos($current_blog->domain, $each_identity) !== false){
				return $each_identity;
			}
		}
		return false;
	}
	//assign current child site to current
	$current_child_site = get_current_site_identity($multi_sites_array);
}

/**
 * function get_current_site_identity_name
 * function to return current sub site name based on current sub site slug value
 *
 * @return current sub site name or return default sub site name
 */
if(!function_exists('get_current_site_identity_name')){
	function get_current_site_identity_name(){
		global $current_child_site, $multi_sites_array, $multi_sites_name_array;
		if($current_child_site == ''){
			return 'Default child site name';
		}else{
			if(in_array($current_child_site, $multi_sites_array)){
				return $multi_sites_name_array[$current_child_site];
			}else{
				return 'Default child site name';
			}
		}
	}
}

/**
 * WordPress register with email only, make it possible to register with email 
 * as username in a multisite installation
 *
 * @param  Array $result Result array of the wpmu_validate_user_signup-function
 * @return Array         Altered result array
 */
function custom_register_with_email($result) {
	if ( $result['user_name'] != '' && is_email( $result['user_name'] ) ) {
		unset( $result['errors']->errors['user_name'] );
	}
	return $result;
}

//add_filter('wpmu_validate_user_signup','custom_register_with_email');

?>