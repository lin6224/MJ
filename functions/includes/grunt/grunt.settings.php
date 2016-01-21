<?php

/** add grunt settings under WP settings menu as submenu */
add_action( 'admin_menu', 'clean_theme_settings_grunt_menu' );

/** add option menu update and call to init register wp option */
function clean_theme_settings_grunt_menu() {
	//add_options_page( 'Grunt Settings', 'Grunt Settings', 'manage_options', 'clean-theme-grunt-settings', 'clean_theme_settings_grunt_options_call_back' );
	add_theme_page( 'Grunt Settings', 'Grunt Settings', 'manage_options', 'clean-theme-grunt-settings', 'clean_theme_settings_grunt_options_call_back' );
	//call register settings function
	add_action( 'admin_init', 'register_grunt_settings' );
}

/** function register wp option */
function register_grunt_settings(){
	register_setting( 'grunt-settings-group', 'css_minify' );
	register_setting( 'grunt-settings-group', 'js_minify' );
}

/** render options form */
function clean_theme_settings_grunt_options_call_back() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', SITE_TEXT_DOMAIN ) );
	}
	//try to locate grunt settings option values
	$css_minify = get_option('css_minify', '0');
	$js_minify = get_option('js_minify', '0');
	?>
	<div class="wrap">
	<h2>Grunt Settings</h2>
	<form id="grunt-settings-form" name="grunt-settings-form" action="options.php" method="post">
	<?php settings_fields( 'grunt-settings-group' ); ?>
    <?php do_settings_sections( 'grunt-settings-group' ); ?>
	<table class="form-table">
		<tbody>
		<tr>
		<th scope="row">
			<label for="css_minify_checkbox">Minify CSS</label>
		</th>
		<td>
			<input id="css_minify" type="checkbox" value="1" name="css_minify"<?php echo ($css_minify=='1')?'checked="checked"':''; ?>> Check to enable
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="jjs_minify_checkbox">Minify JS</label>
		</th>
		<td>
			<input id="js_minify" type="checkbox" value="1" name="js_minify"<?php echo ($js_minify=='1')?'checked="checked"':''; ?>> Check to enable
		</td>
		</tr>
		</tbody>
	</table>
	<p class="submit">
		<input id="grunt-settings-submit" class="button button-primary" type="submit" value="Save Changes" name="grunt-settings-submit">
	</p>
	</form>
	</div>
	<?php
}

//handle option save by wp ajax
//add_action('wp_ajax_grunt_settings_update', 'grunt_settings_update_call_back');

function grunt_settings_update_call_back(){
	$css_minify = (isset($_POST['cssmin-check']))? $_POST['cssmin-check'] : '0';
	$js_minify = (isset($_POST['jsmin-check']))? $_POST['jsmin-check'] : '0';
	
	//update option
	update_option( 'css_minify', $css_minify );
	update_option( 'js_minify', $js_minify );
	
	wp_redirect('/wp-admin/options-general.php?page=clean-theme-grunt-settings');
}
?>