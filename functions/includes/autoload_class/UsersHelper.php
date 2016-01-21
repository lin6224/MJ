<?php

Class UsersHelper{
	
	/**
	 * Constructor
	 */
	public function __construct() {
		//user access update for THDadmin in wp admin
		if(is_user_logged_in()){
			global $current_user, $current_user_role, $current_user_login;
			
			if($current_user_role == "editor"){//if editor or any other users
				//add_action( 'admin_menu', array($this,'remove_editor_menus') );
			}
		}
		
		//custom logout
		add_filter( 'query_vars', array($this, 'site_vars_secure_logout') );
		add_action( 'parse_request', array($this, 'site_parse_request_check_secure_logout') );
	}
	
	/**
	 * Function: remove_editor_menus - remove certian menu items from wp admin
	 * @Author: JF
	 * @Date: 2014 Jan
	 *
	 * @return excerpt value within maximum allowed characters
	 */
	function remove_editor_menus(){
		remove_menu_page( 'index.php' );                  //Dashboard
		remove_menu_page( 'tools.php' );                  //Tools
		remove_menu_page( 'themepunch-google-fonts' );	//hide themepunch google fonts if found any
		remove_menu_page( 'edit-comments.php' );        //comment moderation
		/*
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'themes.php' );                 //Appearance
		remove_menu_page( 'options-general.php' );        //Settings
		remove_menu_page( 'users.php' );                  //Users
		remove_menu_page( 'wpseo_dashboard' );                //Posts
		remove_menu_page( 'edit.php?post_type=themefusion_elastic' );
		remove_menu_page( 'edit.php?post_type=slide' );
		remove_menu_page( 'layerslider' );
		remove_menu_page( 'edit.php?post_type=avada_faq' );
		remove_menu_page( 'gf_edit_forms' );
		*/
	}
	
	//==================================================
	//--- user login redirect handling
	
	/**
	 * Function: site_user_redirect_hook - action hook to call user redirect function callback
	 * @Author: JF
	 * @Date: 2015 Feb
	 *
	 * @return void
	 */
	function site_user_redirect_hook(){
		add_action('wp_login', array($this, 'site_user_redirect'), 10, 2);
	}
	
	/**
	 * Function: site_user_redirect - redirect current login user to certain page based on user role
	 * @Author: JF
	 * @Date: 2015 Feb
	 *
	 * @param $user_login - user login (username / email)
	 * @param $user - user object
	 *
	 * @return excerpt value within maximum allowed characters
	 */
	function site_user_redirect($user_login, $user) {
		$user_roles_array = $user->roles;
		$user_role = $user_roles_array[0];
	
		if($user_role == 'editor'){//if editor or any other users
			wp_redirect('/wp-admin/profile.php');exit; //e.g redirect to wp admin profile page.
		}
	}
	
	//==================================================
	//--- user custom secure logout handling
	
	/**
	 * Function site_vars_secure_logout to update Logout URL query string
	 * @Author: JF
	 * @Date: 2014 May
	 *
	 * @return void
	 */
	function site_vars_secure_logout( $query_vars ){
		$query_vars[] = 'secure_logout';
		return $query_vars;
	}

	/**
	 * Function site_parse_request_check_secure_logout to process logout action from query string
	 * @Author: JF
	 * @Date: 2014 May
	 *
	 * @return void
	 */
	function site_parse_request_check_secure_logout( &$wp ){
		global $home_url;
		if(isset($_GET['secure_logout']) && $_GET['secure_logout'] ==  '1'){
			//clean cache
			wp_clear_auth_cookie();
			//redirect to home page
			if(function_exists('icl_get_languages')){//if WPML is used...
				wp_redirect( $home_url.'/'.ICL_LANGUAGE_CODE.'/' );
			}else{
				wp_redirect( $home_url.'/' );
			}
			
			die();
		}
	}
}
?>