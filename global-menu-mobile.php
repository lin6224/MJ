<?php
$site_menu_option = get_option('site_menu_option', '0');

if($site_menu_option == 'mmenu'){
	wp_nav_menu( array( 'menu' => 'Mobile Menu', 'container' => 'nav', 'container_id' => 'my-menu', 'menu_class' => 'mm-menu', 'walker' => new MmenuMenuWalker() ) );
}else if($site_menu_option == 'bootstrap'){
	//do nothing
}
?>
