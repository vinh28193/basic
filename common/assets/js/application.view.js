application.module('view', function (module, require, $) {
    var title;
    var state = {};

    var isSmall = function () {
        return module.getWidth() <= 767;
    };

    var isMedium = function () {
        return module.getWidth() > 767 && module.getWidth() <= 991;
    };

    var isNormal = function () {
        return module.getWidth() >= 991;
    };


    var getHeight = function() {
        return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    };

    var getWidth = function() {
        return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    };

    module.initOnPjaxLoad = true;
    var init = function () {

    };

    module.export({
        init: init,
        isSmall: isSmall,
        isMedium: isMedium,
        isNormal: isNormal,
        getHeight: getHeight,
        getWidth: getWidth,
        // This function is called by controller itself
    });
});