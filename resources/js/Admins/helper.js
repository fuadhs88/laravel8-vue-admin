exports.install = function (Vue, options) {
    // 继承路径
    Vue.prototype.admin_base_url = function (path = '', prefix) {
        prefix = '/' + prefix.replace(/(^\/*)|(\/*$)/g, "");

        prefix = (prefix === '/') ? '' : prefix;

        path = path.replace(/(^\/*)|(\/*$)/g, "");

        if (path === '' || path.length === 0) {
            return prefix ?? '/';
        }

        return prefix + '/' + path;
    };
    // 继承路由
    Vue.prototype.admin_route = function (name = '', config) {
        let route_name = config.route.as + '.' + name;

        return route(route_name);
    };
};
