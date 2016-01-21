jQuery(document).ready(function($){
    $(".royalSlider").royalSlider({
        autoScaleSliderHeight: 478,
        arrowsNavAutoHide: false,
        arrowsNavHideOnTouch: true,
        controlNavigation: 'none',
        keyboardNavEnabled: true,
        imageScalePadding: 0,
        loop: true,
        slidesSpacing: 0,
        sliderDrag: true,
        sliderTouch: true,
        usePreloader: true,
        transitionType: 'fade',
        transitionSpeed: 300,
    	autoPlay: {
    		// autoplay options go here
    		enabled: true,
            stopAtAction: false,
    		pauseOnHover: true,
    		delay: 4000
    	}
    });
	
	$(".reSlide_div").delay(300).css("visibility", "visible");

});