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

    var imageSelected;
    var methods = {
        init: function (options) {
            return this.each(function () {
                var $e = $(this);
                var settings = $.extend({}, defaults, options || {});
                $e.data('yiiImageManager', {
                    settings: settings
                });
                var imageCopper = $(this).find('img#image-cropper');
                console.log(imageCopper);
                console.log(settings);
				
            });
        },
        select: function(id) {

        },
        test: function () {
        	console.log('test() called');
           
        },  
        data: function () {
            return this.data('yiiImageManager');
        },

    };
    var findImage = function(id){
        var actionView = 'view';
        $.ajax({
            url: actionView,
            type: "POST",
            data: {
                id: id,
                _csrf: $('meta[name=csrf-token]').prop('content')
            },
            dataType: "json",
            success: function (responseData, textStatus, jqXHR) {
               return responseData;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Can't view image. Error: "+jqXHR.responseText);
            }
        });
    }
})(window.jQuery);