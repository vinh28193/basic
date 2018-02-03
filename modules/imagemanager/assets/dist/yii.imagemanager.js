/**
 *
 *
 *
 */
(function ($) {

    $.fn.yiiImageManager = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.yiiImageManager');
            return false;
        }
    };

    var defaults = {
    	baseUrl: ''
       	
    };

    var methods = {
        init: function (options) {
            return this.each(function () {
                var $e = $(this);
                var settings = $.extend({}, defaults, options || {});
                $e.data('yiiImageManager', {
                    settings: settings
                });
                console.log(settings);
				
            });
        },

       
        test: function () {
        	console.log('test() called');
           
        },  
        data: function () {
            return this.data('yiiImageManager');
        },

    };

})(window.jQuery);