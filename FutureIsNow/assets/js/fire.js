//Fire stuff off when jquery is reafy
///headroom
// grab an element


jQuery(document).ready(function () {


	jQuery('.logo-slider').each(function () {
		jQuery(this).slick({
			autoplay: false,
			dots: false,
			infinite: false,
			speed: 2000,
			slidesToShow: 5,
			slidesToScroll: 2,
			fade: false,
			cssEase: 'linear',
			responsive: [{
				breakpoint: 800,
				settings: {
					slidesToShow: 4,
				}
			}, {
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
				}
			}]
		})
	})




	jQuery('.highlights-slider').each(function () {
		jQuery(this).slick({
			dots: false,
			infinite: true,
			speed: 1000,
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: false,
			cssEase: 'linear',
			autoplay: false,
			arrows: true,

		})
	})





	//responsive iframe wrappers


	jQuery('iframe').each(function () {
		var height = jQuery(this).attr('height');
		var width = jQuery(this).attr('width');
		var ratio = height / width * 100;
		if (ratio) {
			console.log('responsivizing video')
			ratio = ratio.toString();
			jQuery(this).wrap("<div class='responsive-iframe'/>");
			jQuery(this).closest(".responsive-iframe").css('padding-bottom', ratio + '%');

		}


	});


});