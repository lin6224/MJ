<?php


/**
 * Function: custom_add_url_query_string - function to add additional query string variables to url
 * Author: JF
 * Date: May 29, 2014
 */

//add_filter( 'query_vars', 'custom_add_url_query_string' );

function custom_add_url_query_string( $query_vars ){
    $query_vars[] = 'page';
    return $query_vars;
}

/**
 * Function: custom_get_previous_page_btn - Display back button in special page/post.
 * @Author: JF
 * @Date: May 29, 2014
 *
 * @return void
 */
if ( ! function_exists( 'custom_get_previous_page_btn' ) ) :

function custom_get_previous_page_btn($redirect=''){
	if($redirect==''){
		//check previous page history
		if(isset($_SERVER['HTTP_REFERER'])){
			?>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn" id="btn-back"><?php echo __( '&#8592 Back', SITE_TEXT_DOMAIN ); ?></a>
			<?php
		}
	}else if($redirect!=''){
		?>
			<a href="<?php echo $redirect; ?>" class="btn" id="btn-back"><?php echo __( '&#8592 Back', SITE_TEXT_DOMAIN ); ?></a>
		<?php
	}else{
		if(is_single()){
			global $blog_url;
			?>
			<a href="<?php echo $blog_url; ?>" class="btn" id="btn-back"><?php echo __( '&#8592 Back', SITE_TEXT_DOMAIN ); ?></a>
			<?php
		}
	}
}

endif;


/**
 * Function: custom_add_current_menu_item_css - update menu item for post archive
 * This function is to be further edited before applied
 * @Author: JF
 * @Date: May 29, 2014
 *
 * @return void
 */

//add_action('wp_footer', 'custom_add_current_menu_item_css');

function custom_add_current_menu_item_css(){
	if(is_post_type_archive( 'post' ) || is_singular( 'post' )){
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$( ".nav-menu > li" ).each(function( index ) {
				var menu_item_text = $( this ).text();
				if(menu_item_text == 'Blog' || menu_item_text == 'Blogue'){
					$(this).addClass('current-menu-item');
				}
			});
		});
		</script>
		<?php
	}
}

/**
 * Function: translate_widget_title - translate widget title.
 * @Author: JF
 * @Date: Nov 28, 2014
 *
 * @return void
 */
add_filter('widget_title', 'translate_widget_title'); 

function translate_widget_title($title) {
	return __($title, SITE_TEXT_DOMAIN);
}

?>