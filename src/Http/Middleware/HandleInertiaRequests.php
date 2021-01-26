<?php

namespace Encore\Admin\Http\Middleware;

use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'admin::app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'configs' => Config::all(),
            'routes' => $this->getAdminRoutes(),
            'assets' => $this->getAssets(),
            'color' => config('admin.theme.color', 'info'),
            'menus' => Admin::menus(),
            'user' => Admin::check() ? Admin::user() : null,
        ]);
    }

    /**
     * get the routes of admin
     *
     * @return array
     */
    protected function getAdminRoutes()
    {
        $routes = [];

        foreach (Route::getRoutes()->get() as $route) {
            if (file_exists(config_path('admin.php'))) {
                $array_diff = array_diff(config('admin.route.middleware'), $route->action['middleware']);
                // If there is no intersection between the routing middleware and the configured middleware
                if (empty($array_diff)) {
                    array_push($routes, [
                        'uri' => asset($route->uri),
                        'methods' => $route->methods,
                        'name' => $route->action['as'],
                    ]);
                }
            }
        }

        return $routes;
    }

    /**
     * get resource files
     *
     * @return array
     */
    protected function getAssets()
    {
        return [
            'asset_path' => asset('vendor/laravel-vue-admin'),
            'icheck-bootstrap' => [
                'css' => [
                    '/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'
                ]
            ],
            'jquery-icheck' => [
                'js' => [
                    '/jquery-icheck/icheck.min.js'
                ]
            ],
            'sweetalert2' => [
                'css' => [
                    '/admin-lte/plugins/sweetalert2/sweetalert2.min.css'
//                    '/admin-lte/plugins/sweetalert2/bootstrap-4.min.css'
                ],
                'js' => [
                    '/admin-lte/plugins/sweetalert2/sweetalert2.min.js'
                ]
            ],
            'jquery-ui' => [
                'js' => [
                    '/admin-lte/plugins/jquery-ui/jquery-ui.min.js'
                ]
            ],
        ];
    }
}
