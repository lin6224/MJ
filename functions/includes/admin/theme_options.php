<?php

/** add grunt settings under WP settings menu as submenu */
add_action( 'admin_menu', 'clean_theme_option_menu' );

/** add option menu update and call to init register wp option */
function clean_theme_option_menu() {
	//add_options_page( 'Theme Options', 'Theme Options', 'manage_options', 'clean-theme-option', 'clean_theme_options_call_back' );
	add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'clean-theme-option', 'clean_theme_options_call_back' );
	//call register settings function
	add_action( 'admin_init', 'register_theme_options_settings' );
}

/** function register wp option */
function register_theme_options_settings(){
	register_setting( 'theme-options-settings-group', 'site_menu_option' );
	register_setting( 'theme-options-settings-group', 'site_sticky_header_option' );
	register_setting( 'theme-options-settings-group', 'site_minify_html_option' );
	register_setting( 'theme-options-settings-group', 'site_admin_bar_option' );
}

function clean_theme_options_call_back(){
	//check user permission
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', SITE_TEXT_DOMAIN) );
	}
	//locate site menu option values
	$site_menu_option = get_option('site_menu_option', '0');
	//locate site sticky header
	$site_sticky_header_option = get_option('site_sticky_header_option', '0');
	//toggle to minify html
	$site_minify_html_option = get_option('site_minify_html_option', '0');
	//toggle to show admin bar
	$site_admin_bar_option = get_option('site_admin_bar_option', '0');
	?>
	<div class="wrap">
	<h2>Theme Options</h2>
	<form id="theme-option-menu-form" name="theme-option-menu-form" action="options.php" method="post">
	<?php settings_fields( 'theme-options-settings-group' ); ?>
    <?php do_settings_sections( 'theme-options-settings-group' ); ?>
	<?php
	$site_menu_options_array = array(
		'mmenu'=>'MMenu',
		'bootstrap'=>'Bootstrap Responsive Menu',
	);
	$confirm_options_array = array(
		'0'=>'No',
		'1'=>'Yes'
	);
	?>
	<table class="form-table">
		<tbody>
		<tr>
		<th scope="row">
			<label for="site_menu_option_dropdown">Menu Options</label>
		</th>
		<td>
			<select id="site_menu_option" name="site_menu_option">
				<?php
				foreach($site_menu_options_array as $each_menu_key => $each_menu_value){
					?>
					<option value="<?php echo $each_menu_key; ?>"<?php echo ($each_menu_key == $site_menu_option)?' selected="selected"':'';?>><?php echo $each_menu_value; ?></option>
					<?php
				}
				?>
			</select>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="site_admin_bar_option_dropdown">Show Admin Bar</label>
		</th>
		<td>
			<select id="site_admin_bar_option" name="site_admin_bar_option">
				<?php
				foreach($confirm_options_array as $each_option_key => $each_option_value){
					?>
					<option value="<?php echo $each_option_key; ?>"<?php echo ($each_option_key == $site_admin_bar_option)?' selected="selected"':'';?>><?php echo $each_option_value; ?></option>
					<?php
				}
				?>
			</select>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="site_sticky_header_option_dropdown">Sticky Header</label>
		</th>
		<td>
			<select id="site_sticky_header_option" name="site_sticky_header_option">
				<?php
				foreach($confirm_options_array as $each_option_key => $each_option_value){
					?>
					<option value="<?php echo $each_option_key; ?>"<?php echo ($each_option_key == $site_sticky_header_option)?' selected="selected"':'';?>><?php echo $each_option_value; ?></option>
					<?php
				}
				?>
			</select>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="site_minify_html_option_dropdown">Minify HTML</label>
		</th>
		<td>
			<select id="site_minify_html_option" name="site_minify_html_option">
				<?php
				foreach($confirm_options_array as $each_option_key => $each_option_value){
					?>
					<option value="<?php echo $each_option_key; ?>"<?php echo ($each_option_key == $site_minify_html_option)?' selected="selected"':'';?>><?php echo $each_option_value; ?></option>
					<?php
				}
				?>
			</select>
		</td>
		</tr>
		</tbody>
	</table>
	<p class="submit">
		<input id="theme-options-menu-settings-submit" class="button button-primary" type="submit" value="Save Changes" name="theme-options-menu-settings-submit">
	</p>
	</form>
	</div>
	<?php
}

?>