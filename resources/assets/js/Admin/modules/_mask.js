/**
 * Mask phone number
 */
(function($) {
    'use strict';

        if ($('.phone-mask').length > 0) {
            $('.phone-mask').inputmask({"mask": "+380(99)999-99-99"});
        };

})(jQuery);
