
(function($) {

	$(function() {
		if(!seen_cookie_message()) {
			show_cookie_message();
			//set_seen_cookie_message();
		}

		jQuery('.cc_dismiss_button').click(function(){
			hide_cookie_message();
			set_seen_cookie_message();
		});
		jQuery('.cc_delete_button').click(function(){
			remove_cookies();
			window.location.replace("https://google.com/");
		});
	});

	function seen_cookie_message() {
		return jQuery.cookie('cc_cookie_message') == 'yes';
	}
	function set_seen_cookie_message() {
		jQuery.cookie('cc_cookie_message', 'yes', { expires: 365 });
	}

	function remove_cookies() {
		jQuery.each(jQuery.cookie(), function(key, value){ 
			jQuery.removeCookie(key);
		});
	}

	function show_cookie_message() {
		//$('html').css('margin-top', $('#cc_message').height());
		$('#cc_message').show();
	}

	function hide_cookie_message() {
		jQuery('#cc_message').hide();
		jQuery('html').animate({'margin-top': 0});
	}

})(jQuery);
