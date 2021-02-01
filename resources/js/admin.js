;(function($, window, Swal) {
    $.ajaxSetup({
        statusCode: {
            500: function(xhr) {
                $.admin.toastr.error(xhr.responseJSON.message, {position:"bottom"});
            },
            403: function (xhr) {
                $.admin.toastr.error(xhr.responseJSON.message, {position:"bottom"});
            },
        }
    });

    $.delete = function (options) {
        options.type = 'POST';
        options.data = {_method: 'DELETE'};

        return $.ajax(options);
    };

    $.put = function (options) {
        options.type = 'POST';
        Object.assign(options.data, {_method: 'PUT'});

        return $.ajax(options);
    };

    function Form ($el) {
        this.$el = $el;
        this.fieldTypes = {};
        this.init();
    }

    Form.prototype.init = function () {
        this.$el.on('submit', function (e) {
            e.preventDefault();

            let $form = $(this);

            $form.find('.cascade-group.d-none :input').attr('disabled', true);

            let data = new FormData(this);

            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                statusCode: {
                    422: $.admin.form.validateError
                },
                success: $.admin.form.success
            });

            return false;
        });

        let form = this;
        this.$el.find('.fields-group .form-group').each(function (index, field) {
            if (!$(field).data('field')) {
                return;
            }
            $(field).data('field').split(',').forEach(function (name) {
                form.fieldTypes[name] = $(field).data('type');
            });
        });
    };

    Form.prototype.field = function (name, $group) {
        let selector = '[data-field="'+name+'"],[data-field$=",'+name+'"],[data-field^="'+name+',"]';

        if (typeof $group !== 'undefined') {
            return $group.find(selector);
        }

        return this.fields().filter(selector);
    };

    Form.prototype.fields = function (name) {
        return this.$el.find('.fields-group .form-group');
    };

    Form.prototype.submit = function (e) {
        this.$el.submit();
    };

    Form.prototype.validateError = function (xhr) {
        let response = xhr.responseJSON;
        let $form = $.admin.form.$el;
        $form.find('.validation-error').addClass('d-none');
        $form.find('.form-control').removeClass('is-invalid');

        let showError = function ($el, errors) {
            errors.forEach(function (error) {
                $el.find('.validation-error')
                    .removeClass('d-none')
                    .find('>label>i')
                    .after(error);

                $el.find('.validation-error')
                    .parent()
                    .find('.form-control')
                    .addClass('is-invalid');
            });
        };

        let showRangeError = function ($el, errors, field) {
            errors.forEach(function (error) {
                $el.find('.validation-error.'+field+'-error')
                    .removeClass('d-none')
                    .find('>label>i')
                    .html(error);

                $el.find('.validation-error.'+field+'-error')
                    .closest('.field-control')
                    .find('.form-control')
                    .addClass('is-invalid');
            });
        };

        let error = function (field, errors) {
            let $el;
            if (field.indexOf('.') !== -1) {
                let segment = field.split('.');
                $el = $.admin.form.field(segment[0]);
                if ($el.length === 0) {
                    return;
                }

                let type = $.admin.form.fieldTypes[segment[0]];

                if (type === 'keyvalue') {  // kv.values.1
                    showError($el.find('tbody>tr').eq(segment[2]), errors);
                } else if (type === 'listfield') {  // list.1
                    showError($el.find('tbody>tr').eq(segment[1]), errors)
                } else if (type === 'table') {    // table.1.field
                    let row = $.admin.form.field(segment[2], $el.find('tbody>tr').eq(segment[1]));
                    showError(row, errors)
                } else if (type ===  'hasmany') {    // table.1.field
                    let form = $('.has-many-'+segment[0]+'-form').filter('[data-key='+segment[1]+']');
                    let subField = $.admin.form.field(segment[2], form);
                    let subType = $.admin.form.fieldTypes[segment[2]];

                    if (['daterange', 'timerange', 'datetimerange'].includes(subType)) {
                        showRangeError(subField, errors, segment[2]);
                        return;
                    }

                    showError(subField, errors);
                } else if (type === 'embeds') {  // embeds.field
                    error(segment[1], errors);
                }

                return;
            }

            $el = $.admin.form.field(field);

            if ($el.length === 0) {
                return;
            }

            if (['daterange', 'timerange', 'datetimerange'].includes(type)) {
                showRangeError($el, errors, field);
                return;
            }

            showError($el, errors);
        };

        for (let key in response.validation) {
            error(key, response.validation[key]);
        }

        $.admin.toastr.error(response.message);
    };

    Form.prototype.success = function (data) {

        $('.modal').modal('hide');
        $('.modal-backdrop').remove();

        if (typeof data != 'object') {
            $.admin.toastr.error('Oops something went wrong!');
            return;
        }

        if (!data.status) {
            $.admin.toastr.error(data.message);
            return;
        }

        if (data.message) {
            $.admin.toastr.success(data.message);
        }

        if (data.refresh === true) {
            $.admin.reload();
        }

        if (data.result) {
            $('.card.form-result').removeClass('d-none').find('.card-body').html(data.result);
        }

        if (data.redirect) {
            $.admin.redirect(data.redirect);
        }

        if (data.download) {
            let $download = $('<a>', {
                href: data.download,
                target:'_blank',
                download: '',
            });
            $download.hide().appendTo('body');
            $download[0].click();
            $download.remove();
        }
    };

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
        this.configs = null;
        this.locale = null;
        this.routes = null;
        this.assets = null;
        this.color = null;
        this.inertia = null;
        this.token = $('meta[name=csrf-token]').attr('content');
        // this.user = null;
        this.swal = Swal;
        this.toastr = new Toast();
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
        this.inertia.get(url);
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

    Admin.prototype.initForm = function ($form) {
        this.form = new Form($form);
    };

    Admin.prototype.config = function (_key = null, _default = null) {
        if (_key) {
            let keys = _key.split('.');
            let return_val = this.configs;
            $.each(keys, function (key, val) {
                return_val = return_val[val];
            });

            return (typeof(return_val) !== 'undefined') ? return_val : (_default ?? _key);
        }

        return null;
    };

    Admin.prototype.trans = function (_key) {
        let trans = this.locale;

        let key = _key.split('.');

        while(key.length && (trans = trans[key.shift()])) {}

        return (typeof(trans) !== 'undefined') ? trans : _key;
    };

    Admin.prototype.admin_base_url = function (path = '') {
        let prefix = this.config('admin.route.prefix');

        prefix = '/' + prefix.replace(/(^\/*)|(\/*$)/g, "");

        prefix = (prefix === '/') ? '' : prefix;

        path = path.replace(/(^\/*)|(\/*$)/g, "");

        if (path === '' || path.length === 0) {
            return prefix ?? '/';
        }

        return prefix + '/' + path;
    };

    Admin.prototype.admin_base_route = function (name, parameter = {}) {
        let route_name = this.config('admin.route.as') + '.' + name;
        let uri = null;
        $.each(this.routes, function (key, route) {
            if (route.name === route_name) {
                if (!$.isEmptyObject(parameter)) {
                    $.each(parameter, function (k, v) {
                        uri = (route.uri).replace('{' + k + '}', v);
                    });
                } else {
                    uri = route.uri;
                }
            }
        });

        return uri;
    };

    Admin.prototype.require = function (search_el, insert_el = 'AdminLte', is_after = false) {
        let assets = this.assets[search_el];
        let asset_path = this.assets.asset_path;
        // console.dir(this.assets);
        if ("depend" in assets) {
            this.require(assets['depend']);
        }

        if ("css" in assets) {
            let headParent = null;
            let headInsert = true;
            $.each(document.head.childNodes, function (childNodesKey, childNodesVal) {
                if (childNodesVal.nodeName === '#comment') {
                    if (childNodesVal.nodeValue === insert_el) {
                        headParent = childNodesVal;
                    }

                    if (childNodesVal.nodeValue === search_el) {
                        headInsert = false;
                    }
                }
            });
            if (headInsert) {
                let css = '<!--' + search_el + '-->';

                $.each(assets.css, function (cssKey, cssVal) {
                    css += '<link rel="stylesheet" href="' + asset_path + cssVal + '.css">';
                });

                is_after ? $(headParent).after(css) : $(headParent).before(css);
            }
        }

        if ("js" in assets) {
            let bodyParent = null;
            let bodyInsert = true;
            $.each(document.body.childNodes, function (childNodesKey, childNodesVal) {
                if (childNodesVal.nodeName === '#comment') {
                    if (childNodesVal.nodeValue === insert_el) {
                        bodyParent = childNodesVal;
                    }

                    if (childNodesVal.nodeValue === search_el) {
                        bodyInsert = false;
                    }
                }
            });
            if (bodyInsert) {
                let js = '<!--' + search_el + '-->';

                $.each(assets.js, function (jsKey, jsVal) {
                    js += '<script src="' + asset_path + jsVal + '.js"></script>';
                });
                is_after ? $(bodyParent).after(js) : $(bodyParent).before(js);
            }
        }
    };

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
