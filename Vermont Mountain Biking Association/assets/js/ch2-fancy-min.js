jQuery(document).ready(function () {
    document.body.classList.add("js"), jQuery(window).bind("scroll load", function () {
        jQuery(".js .block, .js header, .js footer").each(function (e) {
            var o = jQuery(this).position().top;
            jQuery(window).scrollTop() + jQuery(window).height() - 50 > o && jQuery(this).animate({opacity: "1"}, 1e3)
        })
    }), jQuery('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function (e) {
        if (console.log("scroll"), location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var o = jQuery(this.hash);
            o = o.length ? o : jQuery("[name=" + this.hash.slice(1) + "]"), o.length && (e.preventDefault(), jQuery("html, body").animate({scrollTop: o.offset().top}, 1e3, function () {
                var e = jQuery(o);
                if (e.focus(), e.is(":focus")) return !1;
                e.attr("tabindex", "-1"), e.focus()
            }))
        }
    })
}), jQuery(window).scroll(function () {
    jQuery(window).scrollTop() >= 200 ? jQuery("body").addClass("scrolled") : jQuery("body").removeClass("scrolled")
});