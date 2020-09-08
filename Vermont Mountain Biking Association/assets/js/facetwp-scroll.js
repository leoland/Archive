!function ($) {
    $(".facetwp-pager").click(function (a) {
        $(a.target).hasClass("facetwp-page") && $("html, body").animate({}, 500)
    })
}(jQuery);


