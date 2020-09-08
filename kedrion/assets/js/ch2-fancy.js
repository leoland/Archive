jQuery(document).ready(function () {
	jQuery(window).bind('scroll load', (function () {
		jQuery('.js .block').each(function (i) {
			var top_of_object = jQuery(this).position().top;
			var bottom_of_window = jQuery(window).scrollTop() + jQuery(window).height();
			if ((bottom_of_window - 50) > top_of_object) {
				jQuery(this).animate({
					'opacity': '1'
				}, 1250);
			}
		});
	}));


});