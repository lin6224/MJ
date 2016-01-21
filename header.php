<?php
global $is_user_logged_in,
	$template_directory_uri,
	$stylesheet_directory_uri,
	$current_user,
	$site_title, 
	$home_url,
	$site_stylesheet_url,
	$site_menu_option,
	$site_sticky_header_option;
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php wp_title('|', true, 'right');?></title>
<link rel="icon" href="<?php echo $stylesheet_directory_uri; ?>/favicon.ico" type="image/x-icon">
<?php wp_head(); ?>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo $stylesheet_directory_uri; ?>/plugins/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?php echo $stylesheet_directory_uri; ?>/plugins/html5shiv.js"></script>
<script type="text/javascript" src="<?php echo $stylesheet_directory_uri; ?>/plugins/respond.min.js"></script>
<![endif]-->
<link media="all" type="text/css" href="<?php echo $stylesheet_directory_uri; ?>/css/style.css?ver=<?php bloginfo("version");?>" id="site-style-css" rel="stylesheet">
</head>

<body <?php body_class(); ?>>

<div id="site-body" class="mmenu-page">
<?php $site_header_sticky_class = ($site_sticky_header_option)?'site-header-sticky':'';?>
<header id="site-header" class="<?php echo $site_header_sticky_class; ?>">

	<div id="main-header" class="container">
		
		<div class="row">
			<?php
			$nav_toggle_class = '';
			$button_attribute = '';
            if($site_menu_option == 'bootstrap'){
				$nav_toggle_class = 'navbar-toggle collapsed';
				$button_attribute = ' data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"';
			}else if($site_menu_option == 'mmenu'){
				$nav_toggle_class = 'navbar-toggle mmenu-toggle';
			}
			?>
			<div id="header-primary" class="col-md-12">
				<div class="navbar-header">
				<button id="mobile-nav-btn" class="<?php echo $nav_toggle_class; ?>"<?php echo $button_attribute; ?>><i class="fa fa-bars"></i></button>
				</div>
				<div class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $site_title; ?></a></div>
				<?php
				if(has_nav_menu( 'main-menu' )){
					wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_id' => 'navbar', 'container' => 'div', 'container_class' => 'navbar-collapse collapse', 'menu_class'=>'nav navbar-nav','walker' => new BootstrapWalker()) );
				}
				?>
			</div>
		</div><!-- .row -->
		
	</div><!-- #main-header -->
	
</header><!-- #site-header -->
<div id="site-header-placeholder"></div>

<div class="conatiner-full">
