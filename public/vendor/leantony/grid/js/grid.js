var _grid = {};

(function ($) {

    "use strict";

    var grid = function (opts) {
        var defaults = {
            id: '#grid-leantony',
            filterForm: undefined,
            searchForm: undefined,
            sortLinks: 'data-sort',
            dateRangeSelector: '.date-range',
            linkables: {
                element: '.linkable',
                url: 'url',
                timeout: 100
            },
            pjax: {
                afterPjax: function () {},
                pjaxOptions: {
                    container: id
                }
            }
        };
        this.opts = $.extend({}, defaults, opts || {});
    };

    /**
     * Linkable rows
     */
    grid.prototype.tableLinks = function () {
        var options = this.opts.linkables;
        var elements = $(options.element);
        elements.each(function (i, obj) {
            var link = $(obj).data(options.url);
            $(obj).click(function (e) {
                setTimeout(function () {
                    window.location = link;
                }, options.delay || 100);
            });
        });
    };

    /**
     * Enable pjax
     *
     * @param container
     * @param target
     * @param afterPjax
     * @param options
     */
    grid.prototype.setupPjax = function (container, target, afterPjax, options) {
        // global timeout
        $.pjax.defaults.timeout = options.timeout || 3000;
        $(container).pjax(target, options);
        // do sth when the pjax request is done. Like reload plugins
        $(document).on('pjax:complete', function () {
            afterPjax();
        });
    };

    /**
     * Initialize pjax functionality
     */
    grid.prototype.bindPjax = function () {
        var $this = this;
        this.setupPjax($this.opts.id, 'a[data-trigger-pjax=1]', $this.opts.pjax.afterPjax, $this.opts.pjax.pjaxOptions);

        if ($this.opts.dateRangeSelector && typeof moment === 'function') {
            var start = moment().subtract(29, 'days');
            var end = moment();

            $($this.opts.dateRangeSelector).daterangepicker({startDate: start, endDate: end});
        }
    };

    /**
     * Pjax per row filter
     */
    grid.prototype.filter = function () {
        var $this = this;
        var form = $($this.opts.filterForm);

        if (form.length > 0) {
            form.on('submit', function (e) {
                e.preventDefault();
                $.pjax.submit(e, $this.opts.id, {
                    "push": true,
                    "data": form.serialize(),
                    "replace": false,
                    "timeout": 5000,
                    "scrollTo": 0,
                    "maxCacheLength": 30000
                });
            });
        }
    };

    /**
     * Pjax search
     */
    grid.prototype.search = function () {
        var $this = this;
        var form = $($this.opts.searchForm);

        if (form.length > 0) {
            form.on('submit', function (e) {
                "use strict";
                e.preventDefault();
                $.pjax.submit(e, $this.opts.id, {
                    "push": true,
                    "data": form.serialize(),
                    "replace": false,
                    "timeout": 5000,
                    "scrollTo": 0,
                    "maxCacheLength": 30000
                });
            });
        }
    };

    _grid = function (options) {
        var obj = new grid(options);
        obj.bindPjax();
        obj.tableLinks();
        obj.filter();
        obj.search();
    };
})(jQuery);