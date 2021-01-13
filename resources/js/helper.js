exports.install = function (Vue, options) {
    /**
     * 获取配置信息
     *
     * @param _key
     * @param _default
     * @returns {*}
     */
    Vue.prototype.config = function (_key = null, _default = null) {
        let keys = _key.split('.');
        let return_val = this.GLOBAL.configs;
        $.each(keys, function (k, v) {
            return_val = return_val[v];
        });

        return _key ? return_val : _default;
    };

    /**
     * 继承路径
     *
     * @param path
     * @param prefix
     * @returns {string|string|string}
     */
    Vue.prototype.admin_base_url = function (path = '', prefix = this.configs('admin.route.prefix')) {
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
     * @returns {*}
     */
    Vue.prototype.admin_base_route = function (name = '') {
        let route_name = this.config('admin.route.as') + '.' + name;

        return this.route(route_name);
    };

    /**
     * 向某个注释元素插入新元素
     *
     * @param search_el string
     * @param insert_el string
     * @param head_label bool=true
     * @param parent_el string
     * @param is_after bool=true
     * @returns {*}
     */
    Vue.prototype.el_insert = function (search_el, insert_el, head_label = true, parent_el = 'LaravelVueAdmin', is_after = false) {
        let parent = null;
        let insert = true;
        let childNodes = head_label ? document.head.childNodes : document.body.childNodes ;
        $.each(childNodes, function (childNodesKey, childNodesVal) {
            if (childNodesVal.nodeName === '#comment') {
                if (childNodesVal.nodeValue === parent_el) {
                    parent = childNodesVal;
                }

                if (childNodesVal.nodeValue === search_el) {
                    insert = false;
                }
            }
        });

        if (insert) {
            is_after ? $(parent).after(insert_el) : $(parent).before(insert_el);
        }
    };
};
