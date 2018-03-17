
(function ($) {
    $.fn.yiiMediaManage = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist in jQuery.yiiMediaManage');
            return false;
        }
    };

    var defaults = {
        filterUrl: undefined,
        filterSelector: undefined,
        mediaSelector: undefined
    };

    var mediaData = {};

    var gridEvents = {
        /**
         * beforeFilter event is triggered before filtering the grid.
         * The signature of the event handler should be:
         *     function (event)
         * where
         *  - event: an Event object.
         *
         * If the handler returns a boolean false, it will stop filter form submission after this event. As
         * a result, afterFilter event will not be triggered.
         */
        beforeFilter: 'beforeFilter',
        /**
         * afterFilter event is triggered after filtering the grid and filtered results are fetched.
         * The signature of the event handler should be:
         *     function (event)
         * where
         *  - event: an Event object.
         */
        afterFilter: 'afterFilter',
    };

    /**
     * Used for storing active event handlers and removing them later.
     * The structure of single event handler is:
     *
     * {
     *     gridViewId: {
     *         type: {
     *             event: '...',
     *             selector: '...'
     *         }
     *     }
     * }
     *
     * Used types eg:
     *
     * - filter, used for filtering grid with elements found by filterSelector
     * - click, used for click single media
     *
     * event is the name of event, for example: 'change.yiiGridView'
     * selector is a jQuery selector for finding elements
     *
     * @type {{}}
     */
    var gridEventHandlers = {};

    var methods = {
        init: function (options) {
            return this.each(function () {
                var $e = $(this);
                var settings = $.extend({}, defaults, options || {});
                var id = $e.attr('id');
                if (mediaData[id] === undefined) {
                    mediaData[id] = {};
                }
                mediaData[id] = $.extend(mediaData[id], {settings: settings});

                var filterEvents = 'change.yiiMediaManage keydown.yiiMediaManage';
                var enterPressed = false;
                initEventHandler($e, 'filter', filterEvents, settings.filterSelector, function (event) {
                    if (event.type === 'keydown') {
                        if (event.keyCode !== 13) {
                            return; // only react to enter key
                        } else {
                            enterPressed = true;
                        }
                    } else {
                        // prevent processing for both keydown and change events
                        if (enterPressed) {
                            enterPressed = false;
                            return;
                        }
                    }

                    methods.applyFilter.apply($e);

                    return false;
                });

                var mediaEvents = 'click.yiiMediaManage';
                initEventHandler($e, 'clickMedia', mediaEvents, settings.mediaSelector, function (event) {
                	var selected = undefined;
                	var that = $(this);
                	selected = that.data('key');
                	methods.setSelection(selected);
                	
                    return false;
                });
            });
        },

        applyFilter: function () {
            var $media = $(this);
            var settings = mediaData[$media.attr('id')].settings;
            var data = {};
            $.each($(settings.filterSelector).serializeArray(), function () {
                if (!(this.name in data)) {
                    data[this.name] = [];
                }
                data[this.name].push(this.value);
            });

            var namesInFilter = Object.keys(data);

            $.each(yii.getQueryParams(settings.filterUrl), function (name, value) {
                if (namesInFilter.indexOf(name) === -1 && namesInFilter.indexOf(name.replace(/\[\d*\]$/, '')) === -1) {
                    if (!$.isArray(value)) {
                        value = [value];
                    }
                    if (!(name in data)) {
                        data[name] = value;
                    } else {
                        $.each(value, function (i, val) {
                            if ($.inArray(val, data[name])) {
                                data[name].push(val);
                            }
                        });
                    }
                }
            });

            var pos = settings.filterUrl.indexOf('?');
            var url = pos < 0 ? settings.filterUrl : settings.filterUrl.substring(0, pos);
            var hashPos = settings.filterUrl.indexOf('#');
            if (pos >= 0 && hashPos >= 0) {
                url += settings.filterUrl.substring(hashPos);
            }

            $media.find('form.media-filter-form').remove();
            var $form = $('<form/>', {
                action: url,
                method: 'get',
                'class': 'media-filter-form',
                style: 'display:none',
                'data-pjax': ''
            }).appendTo($media);
            $.each(data, function (name, values) {
                $.each(values, function (index, value) {
                    $form.append($('<input/>').attr({type: 'hidden', name: name, value: value}));
                });
            });

            var event = $.Event(gridEvents.beforeFilter);
            $media.trigger(event);
            if (event.result === false) {
                return;
            }

            $form.submit();

            $media.trigger(gridEvents.afterFilter);
        },

        setSelection: function (options) {
            var $media = $(this);
            var id = $(this).attr('id');
            if (mediaData[id] === undefined) {
                mediaData[id] = {};
            }
            /**
		     *
		     * {
		     *     selected: {
		     *         data-key: {
		   	 *			   id:'...',
		     *             src: '...',
		     *             name: '...',
		     *         }
		     *     }
		     * }
		     */
            mediaData[id].selected = options;
            // if (!options.multiple || !options.selectAll) {
            //     return;
            // }
        },

        getSelection: function () {
            var $media = $(this);
            var data = mediaData[$media.attr('id')];
            var keys = [];
            if (data.selected) {
                $media.find("a[data-key='" + data.selected + "']").each(function ($element) {
                	keys.push($(this));
                    //keys.push($($element).find('img').attr('src'));

                });
            }

            return keys;
        },

        destroy: function () {
            var events = ['.yiiMediaManage', gridEvents.beforeFilter, gridEvents.afterFilter].join(' ');
            this.off(events);

            var id = $(this).attr('id');
            $.each(gridEventHandlers[id], function (type, data) {
                $(document).off(data.event, data.selector);
            });

            delete mediaData[id];

            return this;
        },

        data: function () {
            var id = $(this).attr('id');
            return mediaData[id];
        }
    };

    /**
     * Used for attaching event handler and prevent of duplicating them. With each call previously attached handler of
     * the same type is removed even selector was changed.
     * @param {jQuery} $mediaManage According jQuery grid view element
     * @param {string} type Type of the event which acts like a key
     * @param {string} event Event name, for example 'change.yiiGridView'
     * @param {string} selector jQuery selector
     * @param {function} callback The actual function to be executed with this event
     */
    function initEventHandler($mediaManage, type, event, selector, callback) {
        var id = $mediaManage.attr('id');
        var prevHandler = gridEventHandlers[id];
        if (prevHandler !== undefined && prevHandler[type] !== undefined) {
            var data = prevHandler[type];
            $(document).off(data.event, data.selector);
        }
        if (prevHandler === undefined) {
            gridEventHandlers[id] = {};
        }
        $(document).on(event, selector, callback);
        gridEventHandlers[id][type] = {event: event, selector: selector};
    }
})(window.jQuery);