<?php

/**
 * Function: custom_upload_mimes - Customize allowed file type for upload
 * @Author: JF
 * @Date: May 29, 2014
 *
 * @return void
 */

//add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes ( $existing_mimes=array() ) {
	//$existing_mimes['xlsx'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; //allow xlsx
	//$existing_mimes['xls'] = 'application/vnd.ms-excel'; //allow xls
	return $existing_mimes;
}

?>