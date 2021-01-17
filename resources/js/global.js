const url = window.location.protocol + '//' + window.location.host;
const configs = {};
const assets = {
    'icheck-bootstrap': '<!--icheck-bootstrap-->\n<link rel="stylesheet" href="' + url + '/vendor/laravel-admin/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">'
};
export default {
    url, // 配置信息
    configs, // 配置信息
    assets, // 前端组件
}
