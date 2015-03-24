/**
 * Created by User on 3/11/2015.
 */
(function($){
    $.fn.yiiAjaxFormTabularInputWidget = function (options) {
        options = $.extend({}, $.fn.yiiAjaxFormTabularInputWidget.config, options);
        return this.each(function () {
            alert('widget called: yiiAjaxFormTabularInputWidget ');
        });
    };

    $.fn.yiiAjaxFormTabularInputWidget.config = {
        // set values and custom functions

    };
})(jQuery);