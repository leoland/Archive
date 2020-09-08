"use strict";
jQuery(document).ready(function () {
	if (jQuery('body').hasClass('logged-in')) {
		auto_logout.init();
		jQuery('body').append('<div id="timer"><div class="clock"><span id="mins-left">' + max_minutes + '</span>m</div></div>');
		sync();
		goActive();
	}

});
var new_stamp = new Date(),
	max_minutes = 60,
	step = 6000,
	max_time = max_minutes * 60 * 1000,
	time_left = max_time,
	begin,

	sync = function () {
		var compare_dates = function (date1, date2) {
			if (date1 > date2) return (true);
			else {
				return (false)
			}
		}
		console.log('new ' + new_stamp + 'and' + localStorage.stamp);
		console.log('local ' + localStorage.stamp);

		if (localStorage.stamp) {

			if (compare_dates(new_stamp, localStorage.stamp)) {
				console.log('hi');
			};
		};

		/*
				localStorage.stamp = JSON.stringify(time_stamp);
				localStorage.answer = JSON.stringify(time_local);
				var time_local = time_left;
				var time_saved = JSON.parse(localStorage.answer);
				if (document.hasFocus()) {
					localStorage.answer = JSON.stringify(time_local);
				} else {
					time_saved = JSON.parse(localStorage.answer);
					console.log('local ' + time_saved);
				}

				*/

	},

	countdown = function () {
		sync();
		time_left = time_left - step;
		jQuery('#mins-left').text((time_left / 60000).toFixed(0));
		console.log(time_left);
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
			console.log('start');
			begin = setInterval(countdown, step); // Call countdown function every 1000 milliseconds
			auto_logout.timeoutID = window.setTimeout(auto_logout.goInactive, max_time);
		},
		// 3600000
		resetTimer: function () {
			window.clearInterval(begin) // clear the timer and so stop the clock
			time_left = max_time;
			jQuery('#mins-left').text((time_left / 60000).toFixed(0));
			console.log('logout in ' + max_time);
			window.clearTimeout(auto_logout.timeoutID);
			auto_logout.goActive();
		},

		endTimmer: function () {
			document.removeEventListener("mousemove", auto_logout.resetTimer, false);
			document.removeEventListener("mousedown", auto_logout.resetTimer, false);
			document.removeEventListener("keypress", auto_logout.resetTimer, false);
			document.removeEventListener("DOMMouseScroll", auto_logout.resetTimer, false);
			document.removeEventListener("mousewheel", auto_logout.resetTimer, false);
			document.removeEventListener("touchmove", auto_logout.resetTimer, false);
			document.removeEventListener("MSPointerMove", auto_logout.resetTimer, false);
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


sync = function () {
	var focusStatus = focus;
	var stamp = local_stamp;
	console.log(focusStatus);
	jQuery.ajax({
		type: 'POST',
		url: '/wp-admin/admin-ajax.php',
		data: {
			'action': 'update_time_stamp',
			'focus': focusStatus,
			'stamp': stamp
		},
		success: function (data) {
			remote_stamp = data;
		}
	});
	if (!document.hasFocus()) {
		console.log('remote ' + remote_stamp);
		console.log(' local ' + local_stamp);
		focus = false;


		if (remote_stamp > local_stamp) {
			local_stamp = remote_stamp;
			console.log('a remote timestamp is fresher, restarting timer');
			auto_logout.resetTimer();
		}

	};
},