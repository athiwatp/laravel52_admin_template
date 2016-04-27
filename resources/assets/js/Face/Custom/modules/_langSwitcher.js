var jQuery = require('jquery');

(function($) {
    // Language switch
    $.fn.langSwitch = function(opt) {
        var options = $.extend({
            speed: 100
        }, opt);

        function Switch(el) {
            this.$el = $(el);
            this.$currentLang = this.$el.find('.current');
            this.$list = this.$el.find('.lang-list');

            // Set current language
            this.setElement(this.$list.find('.active').html());

            // Hide languages list
            $(document).on('click', function(e) {
                if ($(e.target).closest('.lang-switch').length) return;

                this.$list.slideUp(options.speed);
            }.bind(this));

            // Toggle languages list
            this.$el.on('click', '.current', function(e) {
                e.preventDefault();

                this.$list.slideToggle(options.speed);
            }.bind(this));

            // Change language
            this.$list.on('click', 'a', function(e) {
                var $el = $(e.target).clone();
                this.$list.find('li').removeClass('active');
                $(e.target).closest('li').addClass('active');

                this.setElement($el);
                this.$list.slideUp(options.speed);
            }.bind(this));
        };

        // Set current element
        Switch.prototype.setElement = function(el) {
            this.$currentLang.html(el);
        }

        return this.each(function() {
            new Switch(this);
        });
    };
})(jQuery);