/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
/*
(function () {
    var container, button, menu, links, i, len;

    container = document.getElementById('site-navigation');
    if (!container) {
        return;
    }

    button = container.getElementsByTagName('button')[0];
    if ('undefined' === typeof button) {
        return;
    }

    menu = container.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');
    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function () {
        if (-1 !== container.className.indexOf('toggled')) {
            container.className = container.className.replace(' toggled', '');
            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-expanded', 'false');
        } else {
            container.className += ' toggled';
            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-expanded', 'true');
        }
    };

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.

    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === self.className.indexOf('nav-menu')) {

            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.

    (function (container) {
        var touchStartFn, i,
            parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

        if ('ontouchstart' in window) {
            touchStartFn = function (e) {
                var menuItem = this.parentNode, i;

                if (!menuItem.classList.contains('focus')) {
                    e.preventDefault();
                    for (i = 0; i < menuItem.parentNode.children.length; ++i) {
                        if (menuItem === menuItem.parentNode.children[i]) {
                            continue;
                        }
                        menuItem.parentNode.children[i].classList.remove('focus');
                    }
                    menuItem.classList.add('focus');
                } else {
                    menuItem.classList.remove('focus');
                }
            };

            for (i = 0; i < parentLink.length; ++i) {
                parentLink[i].addEventListener('touchstart', touchStartFn, false);
            }
        }
    }(container));
})();

*/
//  really need to add a better search stuff
jQuery(".search-toggle").click(function () {
	if (jQuery(".search-box").hasClass("toggled")) {
		jQuery(".search-box").removeClass("toggled");
	} else {
		jQuery(".search-box").addClass("toggled");
	}
});

jQuery(".search-box").click(function (e) {
	e.stopPropagation();
});

jQuery(window).click(function () {
	jQuery(".search-box").removeClass("toggled");
});

jQuery(document).ready(function () {
	jQuery("#site-navigation").click(function () {
		//      navHeight();
	});
	// navHeight();
	jQuery(window).resize(function () {
		//    navHeight();
	});

	jQuery("#primary-menu .menu-item-has-children").on("click", function (e) {
		if (e.target === this) {
			//  console.log('aye');

			jQuery(this).siblings(".open").removeClass("open");
			jQuery(this).toggleClass("open");

		}
	});
	jQuery(".menu-item-has-children .menu-item-has-children").on("click", function (e) {
		if (e.target === this) {
			//  console.log('aye');
			jQuery('#site-navigation').toggleClass("offscreen");
		}
	});
	jQuery("#primary-menu .back-link a").on("click", function (e) {
		// if (e.target === this) {
		jQuery('#site-navigation').removeClass("offscreen");

		jQuery(this).closest(".open").removeClass("open");
		// e.stopPropagation();
		// }

	});

	//add margin to match the header
	jQuery(window).on("scroll resize load", function () {
		jQuery("html body.admin-bar header").css("margin-top", 32);
		var height = jQuery("header").height();
		//jQuery('html').css('margin-top', height, 'important');
		//jQuery('html').attr('style', 'margin-top: '+height+ 'px !important');
		// jQuery('#masthead').css('margin-top',height * -1);
		jQuery(".site-content").css("margin-top", height);
	});
});

jQuery(document).ready(function () {
	jQuery(".menu-toggle").click(function () {
		jQuery("#masthead").toggleClass("open-nav");
		jQuery(".offscreen").removeClass("offscreen");
		jQuery(".open").removeClass("open");


	});
});



(function () {
	var header = document.querySelector("header");

	if (window.location.hash) {
		header.classList.add("headroom--unpinned");
	}

	var headroom = new Headroom(header, {
		tolerance: {
			down: 1,
			up: 50
		},
		offset: 300
	});
	headroom.init();
})();




jQuery(document).ready(function () {
	i = 0;
	jQuery(".fat-menu > .sub-menu").each(function () {
		jQuery(this).addClass('fat-sub-menu');
	})


	jQuery(".mm-preview").prependTo(jQuery(".fat-sub-menu"));


});


/*
jQuery(document).ready(function () {
  jQuery(".mm-preview").each(function () {
    jQuery(this).closest(".sub-menu").prepend(this);
  });
});
*/

jQuery(document).ready(function () {

	jQuery("li.menu-item-has-children").each(function () {})




});


jQuery(document).ready(function (event) {

	//smooth scroll
	jQuery('a[href*="#"]')
		// Remove links that don't actually link to anything
		.not('[href="#"]')
		.not('[href="#0"]')
		.click(function (event) {
			// On-page links
			console.log('scroll');
			if (
				location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
				location.hostname == this.hostname
			) {
				// Figure out element to scroll to
				var target = jQuery(this.hash);
				target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
				// Does a scroll target exist?
				if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					jQuery('html, body').animate({
						scrollTop: target.offset().top - 50

					}, 1000, function () {
						// Callback after animation
						// Must change focus!
						var jQuerytarget = jQuery(target);
						jQuerytarget.focus();
						if (jQuerytarget.is(":focus")) { // Checking if the target was focused
							return false;
						} else {
							jQuerytarget.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
							jQuerytarget.focus(); // Set focus again
						};
					});
				}
			}

		});
});

jQuery(document).ready(function (event) {
	var hash = window.location.hash

	if (hash == '' || hash == '#' || hash == undefined) return false;
	console.log('not false');

	var target = jQuery(hash);

	headerHeight = jQuery('#masthead').height();
	console.log(headerHeight);
	target = target.length ? target : jQuery('[name=' + hash.slice(1) + ']');
	console.log(target);
	if (target.length) {
		jQuery('html,body').stop().animate({
			//scrollTop: target.offset().top - headerHeight
			scrollTop: target
		}, 'linear');

	}



});



jQuery(document).ready(function (event) {

	if (!jQuery('body').hasClass('logged-in')) {
		jQuery('.logged-only').remove();
	}
	jQuery('.logged-only').fadeIn();
	jQuery('.logged-only').css('opacity', '1');
});