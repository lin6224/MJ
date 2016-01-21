<?php
//theme init
require_once "functions/theme_init.php";

//theme setup - load js / css; register sidebar
require_once "functions/theme_setup.php";

//theme custom post type
require_once "functions/theme_cpt.php";

//theme ajax handling functions
require_once "functions/theme_ajax_callback.php";

//wp plugin entry file - override wp plugin functionality
require_once "functions/wp_plugins/wp_plugins_entry.php";

//includes
require_once "functions/includes/includes_entry.php";

?>