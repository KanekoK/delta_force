jQuery(document).ready(function() {
		
	jQuery('.carousel').carousel({
	   interval: slider_speed.vars
	  });

	jQuery(".toogle-navigation .fa-bars").click(function(){
		jQuery(".slide-bar").removeClass("hide-bar");
	});
	
	jQuery(".close-bar").click(function(){
		jQuery(".slide-bar").addClass("hide-bar");
	});

	jQuery('a#jump_next').on('click',function (e) {
		 e.preventDefault();

		 var target = this.hash,
		 jQuerytarget = jQuery(target);

		 jQuery('html, body').stop().animate({
			 'scrollTop': jQuerytarget.offset().top
		 }, 900, 'swing', function () {
			window.location.href.split('#content')[0] = target;
		 });
	 });
	if (!jQuery('body.home').length) return;
	if (jQuery('#home-slider').length === 0) {
		jQuery('.site-header').css('position', 'initial');
		jQuery('#branding-wrapper').css('padding-top', '15px');
		jQuery('#branding-wrapper').css('padding-bottom', '15px');
	}
	
	 
	 jQuery('a[href*=".png"]:has(img), a[href*=".gif"]:has(img), a[href*=".jpg"]:has(img)').prettyPhoto({ social_tools: false});

});