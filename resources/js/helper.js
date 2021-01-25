exports.install = function (Vue, options) {
    /**
     * 获取配置信息
     *
     * @param _key
     * @param _default
     * @returns {*}
     */
    Vue.prototype.config = function (_key = null, _default = null) {
        if (_key) {
            let keys = _key.split('.');
            let return_val = this.configs;
            $.each(keys, function (key, val) {
                return_val = return_val[val];
            });

            return return_val;
        } else {
            return _default;
        }
    };

    /**
     * 继承路径
     *
     * @param path
     * @param prefix
     * @returns {string|string|string}
     */
    Vue.prototype.admin_base_url = function (path = '', prefix = this.config('admin.route.prefix')) {
        prefix = '/' + prefix.replace(/(^\/*)|(\/*$)/g, "");

        prefix = (prefix === '/') ? '' : prefix;

        path = path.replace(/(^\/*)|(\/*$)/g, "");

        if (path === '' || path.length === 0) {
            return prefix ?? '/';
        }

        return prefix + '/' + path;
    };

    /**
     * 继承路由
     *
     * @param name
     * @param parameter
     * @returns {*}
     */
    Vue.prototype.admin_base_route = function (name, parameter = {}) {
        let route_name = this.config('admin.route.as') + '.' + name;
        let uri = null;
        $.each(this.routes, function (key, route) {
            if (route.name === route_name) {
                if (!$.isEmptyObject(parameter)) {
                    // console.dir(parameter);
                    $.each(parameter, function (k, v) {
                        uri = (route.uri).replace('{' + k + '}', v);
                    });
                } else {
                    uri = route.uri;
                }
            }
        });
        // console.dir(this.routes);
        return uri;
    };

    /**
     * 判断当前菜单路径是否在当前地址中
     *
     * @param uri
     * @returns {string}
     */
    Vue.prototype.has_menu_active = function (uri) {
        let href = window.location.pathname;

        if (href === this.admin_base_url('/')) {
            return href === this.admin_base_url(uri) ? 'active' : '';
        } else if (this.admin_base_url(uri) !== this.admin_base_url('/') && href.indexOf(this.admin_base_url(uri)) !== -1) {
            return 'active';
        } else {
            return '';
        }
    };

    /**
     * 向某个注释元素插入新元素
     *
     * @param search_el
     * @param insert_el string
     * @param is_after
     * @returns {*}
     */
    Vue.prototype.require = function (search_el, insert_el = 'AdminLte', is_after = false) {
        let assets = this.assets[search_el];
        // console.dir(assets);
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
                    css += cssVal;
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
                    js += jsVal;
                });
                is_after ? $(bodyParent).after(js) : $(bodyParent).before(js);
            }
        }
    };

    /**
     * 为url字符串添加、修改参数
     *
     * @param paramName
     * @param replaceWith
     * @returns {string}
     */
    Vue.prototype.url_with_param = function (paramName, replaceWith) {
        let url = new URL(location);

        url.searchParams.set(paramName, replaceWith);

        return url.toString();
    };

    /**
     * 表格全选
     *
     * @param checked
     */
    Vue.prototype.tableToggleAll = function (checked) {
        $('input.table-row-checkbox').iCheck(checked ? 'check' : 'uncheck');

        this.tableToggleCheckbox();
    };

    /**
     * 表格单选
     */
    Vue.prototype.tableToggleCheckbox = function () {
        // 批量操作
        let table_select_all_btn = $('.table-select-all-btn');
        let checkbox = $('input.table-row-checkbox');
        let checkbox_checked = $('input.table-row-checkbox:checked');
        // 导出
        let export_selected = $('.export-selected.selected_rows');

        if (checkbox_checked.length > 0) {
            // 批量操作
            table_select_all_btn.removeClass('d-none');
            let selectd = table_select_all_btn.find('.selected');
            selectd.html(selectd.data('tpl').replace('{n}', checkbox_checked.length));
            // 导出
            let rows = [];

            $.each(checkbox_checked, function (key, val) {
                rows.push($(val).data('id'));
            });

            let href = export_selected.attr('data-href').replace('__rows__', rows.join(","));

            export_selected.removeClass('d-none').attr('href', href);
        } else {
            // 批量操作
            table_select_all_btn.addClass('d-none');
            // 导出
            export_selected.addClass('d-none').attr('href', 'javascript:void(0);');
        }

        if (checkbox.length > checkbox_checked.length) {
            $('.table-select-all').iCheck('uncheck');
        }

        if (checkbox.length === checkbox_checked.length) {
            $('.table-select-all').iCheck('check');
        }
    };
};
