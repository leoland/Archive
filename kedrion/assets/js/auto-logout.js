"use strict";
jQuery(document).ready(function () {
	if (jQuery('body').hasClass('logged-in')) {
		auto_logout.init();
		jQuery('body').append('<div id="timer"><div class="clock"><span id="mins-left">' + max_minutes + '</span>m</div></div>');

	}
});
var local_stamp = new Date(),
	local_stamp = local_stamp.getTime(),
	stamp,
	remote_stamp,
	max_minutes = 60,
	step = 10000, //milliseconds
	max_time = (max_minutes * 60 * 1000) - 1,
	time_left = max_time,
	begin,
	focus,

	push_time = function () {
		local_stamp = new Date();
		stamp = local_stamp.getTime();
		jQuery.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			data: {
				'action': 'push_time_stamp',
				'push_stamp': stamp
			},
			success: function (data) {
				console.log('pushed a fresh stamp:' + data);
			}
		});
	},
	pull_time = function () {
		jQuery.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			data: {
				'action': 'pull_time_stamp',
			},
			success: function (data) {
				remote_stamp = data;
			}
		});
		if (!document.hasFocus()) {
			if (remote_stamp > stamp) {
				console.log('remote ' + remote_stamp);
				console.log('local ' + stamp);
				var diff = remote_stamp - stamp;
				console.log('diff ' + diff);
				auto_logout.resetTimer();
				stamp = remote_stamp;
			}
		};
	},
	countdown = function () {
		time_left = time_left - step;
		var minutes = (time_left / 60000).toFixed(0);
		jQuery('#mins-left').text(minutes);
		console.log(minutes + ' minutes left');

		if (focus == true) {
			if (!document.hasFocus()) {
				push_time();
				focus = false;
				console.log('count down push');
			}
		}
		if (!document.hasFocus() && (focus = false)) {
			pull_time();
		}

	},
	auto_logout = {
		timeoutID: 0,
		init: function () {
			document.addEventListener("mousemove", auto_logout.resetTimer, false);
			document.addEventListener("mousedown", auto_logout.resetTimer, false);
			document.addEventListener("keypress", auto_logout.resetTimer, false);
			document.addEventListener("DOMMouseScroll", auto_logout.resetTimer, false);
			document.addEventListener("mousewheel", auto_logout.resetTimer, false);
			document.addEventListener("touchmove", auto_logout.resetTimer, false);
			document.addEventListener("MSPointerMove", auto_logout.resetTimer, false);
		},
		startTimer: function () {

			begin = setInterval(countdown, step); // Call countdown function every so many
			auto_logout.timeoutID = window.setTimeout(auto_logout.goInactive, max_time);
		},
		// 3600000
		resetTimer: function () {
			if (document.hasFocus()) {
				if (focus !== true) {
					focus = true;
					console.log('into focus');
					push_time();
				}
			};
			window.clearInterval(begin); // clear the timer and so stop the clock
			time_left = max_time;
			jQuery('#mins-left').text((max_minutes).toFixed(0));
			window.clearTimeout(auto_logout.timeoutID);
			auto_logout.goActive();
		},
		endTimmer: function () {
			if (document.hasFocus()) {
				document.removeEventListener("mousemove", auto_logout.resetTimer, false);
				document.removeEventListener("mousedown", auto_logout.resetTimer, false);
				document.removeEventListener("keypress", auto_logout.resetTimer, false);
				document.removeEventListener("DOMMouseScroll", auto_logout.resetTimer, false);
				document.removeEventListener("mousewheel", auto_logout.resetTimer, false);
				document.removeEventListener("touchmove", auto_logout.resetTimer, false);
				document.removeEventListener("MSPointerMove", auto_logout.resetTimer, false)
			};
		},
		goInactive: function () {
			var data = {
				'action': 'auto_logout',
				'time': true,
				'ajaxsecurity': ajax_object.logout_nonce,
			};
			jQuery.post(ajax_object.ajax_url, data, function (response) {
				auto_logout.endTimmer();
				alert('You have been logged out due to inactivity.');
				window.location.href = "/login/";
			});
		},
		goActive: function () {
			auto_logout.startTimer();
		}
	}