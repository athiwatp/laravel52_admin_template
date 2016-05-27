var jQuery = require('jquery');

(function($) {
    $(function() {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('[data-role="page-scroller"]').fadeIn();
            } else {
                $('[data-role="page-scroller"]').fadeOut();
            }
        });

        $('[data-role="page-scroller"]').click(function() {
            $('body, html').animate({
                scrollTop: 0
            }, 500);
        });
    });
})(jQuery);