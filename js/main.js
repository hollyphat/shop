		
/*scroll to top*/

$(document).ready(function(){
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

	$("a.cat_a").click(function(){
		var old = $(this).attr("data-name");
		var id = $(this).attr("data-id");
		$("#old_cat").val(old);
		$("#cat_id").val(id);
	});

	$("a.cat_b").click(function(){
		var name = $(this).attr("data-name");
		var id = $(this).attr("data-id");
		var price = $(this).attr("data-price");
		var desc = $(this).attr("data-desc");
		$("#old_name").val(name);
		$("#prod_id").val(id);
		$("#old_price").val(price);
		$("#desc").val(desc);
	});


});

//*FIXED NAVIGATION**/
  $(window).on('scroll',function() {
    var scrolltop = $(this).scrollTop();
 
    if(scrolltop >= 100) {
      $('#fixedbar').fadeIn(250);
    }
     
    else if(scrolltop <= 95) {
      $('#fixedbar').fadeOut(250);
    }
  });

