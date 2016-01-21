jQuery(document).ready(function($){
	//placeholder fix for all
	//$('input, textarea').placeholder();
	
	//bootstrap menu hover to dropdown
	//$('.dropdown-toggle').dropdownHover();
	/* //bootstrap dropdown parent force to redirect by its url
	$('.dropdown-toggle').click(function (e) {
		var current_url = $(this).attr('href');
		window.location.href = current_url;
	});*/
	
	//--------------------------------------------//
	//#slidebar menu handle
	//--------------------------------------------//
	//submenu toggle to disable link
	// $('.sb-toggle-submenu').click(function(e){
		// e.preventDefault();
	// });
	
	//--------------------------------------------//
	//#Sticky Header
	//--------------------------------------------//
	if($('#site-header').hasClass('site-header-sticky')){
		$(window).scroll(function() {
		var window_width = $(window).width();
		var window_top_scroll = $(window).scrollTop();//console.log(window_top_scroll);
		if(window_width > 768){
			//desktop view
			if(window_top_scroll > 40){
				$('#site-header').addClass('sticky');
				$('#site-header').css('position', 'fixed');
				$('#site-header').css('z-index', '99');
				if($('#site-header').hasClass('site-header-sticky') && $('body').hasClass('admin-bar')){
					$('#site-header').css('top', '32px');
				}
				$('#site-header').css('border-bottom', '1px solid #1382b8');
				$('#site-header').css('width', '100%');
				$('#site-header-placeholder').css('height', $('#site-header').css('height'))
				$('#site-header-placeholder').css('display', 'block');
			}else{
				$('#site-header').removeClass('sticky');
				if($('#site-header').hasClass('site-header-sticky') && $('body').hasClass('admin-bar')){
					$('#site-header').css('top', '0px');
				}
				$('#site-header').css('position', 'relative');
				$('#site-header').css('z-index', '99');
				$('#site-header').css('border-bottom', 'none');
				$('#site-header-placeholder').css('display', 'none');
			}
		}else{
			//tablet / mobile view
			if(window_top_scroll > 40){
				$('#site-header').addClass('sticky');
				if($('#mobile-nav-btn').hasClass('mmenu-toggle')){
					$('#site-header').addClass('mm-fixed-top');
				}
				if($('#site-header').hasClass('site-header-sticky') && $('body').hasClass('admin-bar')){
					$('#site-header').css('top', '46px');
				}
				$('#site-header').css('position', 'fixed');
				$('#site-header').css('z-index', '99');
				$('#site-header').css('width', '100%');
				$('#site-header').css('border-bottom', '1px solid #1382b8');
				$('#site-header-placeholder').css('height', $('#site-header').css('height'))
				$('#site-header-placeholder').css('display', 'block');
			}else{
				$('#site-header').removeClass('sticky');
				$('#site-header').css('position', 'relative');
				if($('#mobile-nav-btn').hasClass('mmenu-toggle')){
					$('#site-header').removeClass('mm-fixed-top');
				}
				if($('#site-header').hasClass('site-header-sticky') && $('body').hasClass('admin-bar')){
					$('#site-header').css('top', '0px');
				}
				$('#site-header').css('z-index', '99');
				$('#site-header').css('border-bottom', 'none');
				
				$('#site-header-placeholder').css('display', 'none');
			}
		}
		});
	}
	
	//mmenu handling update
	if($('#mobile-nav-btn').hasClass('mmenu-toggle')){
		$(function() {
			$('#my-menu').mmenu({
				classes: "mm-light"
			});
		});
		$("#mobile-nav-btn").click(function() {
			$("#my-menu").trigger("open.mm");
			if($('body').hasClass('admin-bar')){//$('#site-header').hasClass('site-header-sticky') && 
				$('#my-menu').css('top', '46px');
			}
		});
	}
	
	if($('body').hasClass('admin-bar')){
		$('#wpadminbar').css('position', 'fixed');
	}
});