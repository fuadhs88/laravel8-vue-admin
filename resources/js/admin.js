;(function($, window, Swal) {

    function Toast() {
        this.toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            showClass: {
                popup: 'swal2-noanimation',
                backdrop: 'swal2-noanimation'
            },
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    }

    Toast.prototype.fire = function (icon, title, options) {
        let settings = {
            icon: icon,
            title: title,
        };

        if (typeof options !== 'object') {
            Object.assign(settings, options);
        }

        this.toast.fire(settings);
    };

    ['success', 'error', 'info', 'warning', 'question'].forEach((icon) => {
        Toast.prototype[icon] = function (title, options) {
            this.fire(icon, title, options);
        }
    });

    Toast.prototype.show = function (data) {
        if (data.status) {
            this.success(data.message);
        } else {
            this.warning(data.message);
        }
    };

    function Admin () {
        this.inertia = null;
        this.token = $('meta[name=csrf-token]').attr('content');
        this.user = null;
        this.swal = Swal;
        this.toastr = new Toast();
        this.__trans = window.__trans;
    }

    Admin.prototype.confirm = function (options) {
        options = Object.assign(options, {
            icon: 'question',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: this.trans('confirm'),
            cancelButtonText: this.trans('cancel'),
        });

        return this.swal.fire(options);
    };

    Admin.prototype.enableTotop = function () {
        let $totop = $('<button/>', {
            id: 'totop',
            class: 'border p-3',
            title: 'Go to top',
            style: 'display: none;',
            html: '<i class="fas fa-chevron-up"></i>'
        }).appendTo('body').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({scrollTop: 0}, 500);
        });

        $(window).scroll(function () {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                $totop.fadeIn(500);
            } else {
                $totop.fadeOut(500);
            }
        });

        this.totop = $totop;
    };

    Admin.prototype.reload = function (message) {
        if (typeof message !== "undefined") {
            this.toastr.success(message);
        }

        this.inertia.reload();
    };

    Admin.prototype.redirect = function (url) {
        $.pjax({container:'#pjax-container', url: url });
    };

    Admin.prototype.getToken = function () {
        return $('meta[name="csrf-token"]').attr('content');
    };

    Admin.prototype.action = {
        then: function (data) {
            let response = data[0];
            let $target = data[1];

            if (typeof response !== 'object') {
                return $.admin.swal.fire({type: 'error', title: 'Oops!'});
            }

            if (typeof response.html === 'string') {
                $target.html(response.html);
            }

            if (typeof response.swal === 'object') {
                $.admin.swal.fire(response.swal);
            }

            if (typeof response.toastr === 'object' && response.toastr.type) {
                $.admin.toastr[response.toastr.type](response.toastr.content, response.toastr.options);
            }

            let then = function (then) {
                if (then.action === 'refresh') {
                    $.admin.reload();
                } else if (then.action === 'download') {
                    window.open(then.value, '_blank');
                } else if (then.action === 'redirect') {
                    $.admin.redirect(then.value);
                } else if (then.action === 'location') {
                    window.location = then.value;
                } else if (then.action === 'open') {
                    window.open(this.value, '_blank');
                }
            };

            if (response.then) {
                then(response.then);
            }
        },
        catch: function (request) {
            if (request && typeof request.responseJSON === 'object') {
                $.admin.toastr.error(request.responseJSON.message, {
                    position:"bottom",
                    timer: 10000
                }).css('width', '500px');
            }
        }
    };

    Admin.prototype.initialize = function (selector, callback) {
        if (typeof $.initialize !== 'undefined') {
            $.initialize(selector+':not(.initialized)', callback);
        } else {
            callback.call($(selector).get(0));
        }
    };

    Admin.prototype.trans = function (desc) {
        let obj = this.__trans;
        let arr = desc.split('.');
        while(arr.length && (obj = obj[arr.shift()])) {}
        return (typeof(obj) !== 'undefined') ? obj : desc;
    };

    /**
     * 排序
     *
     * @param object
     * @param handle
     */
    Admin.prototype.sortable = function (object, handle) {
        $('.' + object).sortable({
            placeholder         : 'sort-highlight',
            connectWith         : '.connectedSortable',
            handle              : '.' + handle,
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
        $('.' + object + ' .' + handle).css('cursor', 'move');
    };

    $.fn.admin = $.admin = new Admin();

    return $;
})($, window, Swal);
