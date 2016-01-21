<?php

/**
 * Function: custom_set_hidden_user - set user name for not logged in
 * Author: JR
 * Modified: JF
 * Date: May 29, 2014
 */

//add_filter('gform_field_value_user_not_logged_in', 'custom_set_hidden_user');

function custom_set_hidden_user($value){
    
	if(!is_user_logged_in()){
		$value="User Not Logged In";
	}
	
	return $value;
}


/**
 * Function: custom_redirect_gf_activate - custom gf user activation page from default activate.php
 * Modified: JF
 * Date: May 29, 2014
 */

add_action( 'parse_request', 'custom_redirect_gf_activate' );

function custom_redirect_gf_activate( &$wp ){
	//global $stylesheet_directory_uri;
    if ( array_key_exists( 'page', $wp->query_vars ) ) {
		if($wp->query_vars['page'] == 'gf_activation'){
			//$template_path = $stylesheet_directory_uri . '/activate.php';
			//require_once( $template_path );
			get_template_part('activate');
			exit();
		}
    }
	
    return;
}


/**
 * Function: custom_update_profile_form_preset_confirm_email_field - used ONLY for preset email confirmation in user profile update
 * Modified: JF
 * Date: May 29, 2014
 */

//add_action('wp_footer', 'custom_update_profile_form_preset_confirm_email_field');

function custom_update_profile_form_preset_confirm_email_field(){
	if(is_page('my-profile')){
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#input_3_4_2').val($('#input_3_4').val());
		});
		</script>
		<?php
	}
}
?>