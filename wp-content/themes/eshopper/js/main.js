
/*scroll to top*/

jQuery(document).ready(function($){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});


	});

	/*price range*/

    $('#sl2').slider();
    $("#sl2").on("slide", function(slideEvt) {
        $price_range = slideEvt.value;
    	//console.log($price_range);
    });


    var RGBChange = function() {
        $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
    };

    $('.price_label').contents().filter(function(){
        return this.nodeType == 3
    }).remove();

    $(".price_slider").mouseup(function() {
        $( ".price-filter form" ).submit();
    });


    /*Customize login page*/

    $('.tml-registration-confirmation').hide();
    $('#user_login1').attr('placeholder','Name');
    $('#user_pass1').attr('placeholder','Email Address');
    $('#user_login2').attr('placeholder','Name');
    $('#user_email2').attr('placeholder','Email Address');
    $('.tml-rememberme-wrap label').text('Keep me signed in');
    $('.row .col-sm-1:last').hide();
    $('.tml-rememberme-submit-wrap:before').hide();

});
