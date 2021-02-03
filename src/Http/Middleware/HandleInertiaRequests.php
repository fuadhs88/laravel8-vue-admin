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
            'locale' => $this->getTrans(),
            'routes' => $this->getAdminRoutes(),
            'assets' => $this->getAssets(),
            'color' => config('admin.theme.color', 'info'),
            'menus' => Admin::menus(),
            'user' => Admin::check() ? Admin::user() : null,
        ]);
    }

    protected function getTrans()
    {
        $transPath = resource_path('lang/'.config('app.locale').'/admin.php');

        $trans = [];

        if (file_exists($transPath)) {
            $trans = include($transPath);
        }

        return $trans;
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
                    '/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min'
                ]
            ],
            'jquery-icheck' => [
                'js' => [
                    '/jquery-icheck/icheck.min'
                ]
            ],
            'moment' => [
                'js' => [
                    '/admin-lte/plugins/moment/moment-with-locales.min',
                ]
            ],
            'inputmask' => [
                'js' => [
                    '/admin-lte/plugins/inputmask/min/jquery.inputmask.bundle.min',
                ]
            ],
            'datepicker' => [
                'css' => [
                    '/admin-lte/plugins/datepicker/build/css/bootstrap-datetimepicker.min',
                ],
                'js' => [
                    '/admin-lte/plugins/datepicker/build/js/bootstrap-datetimepicker.min',
                ],
                'depend' => 'moment',
            ],
            'daterangepicker' => [
                'css' => [
                    '/admin-lte/plugins/daterangepicker/daterangepicker',
                ],
                'js' => [
                    '/admin-lte/plugins/daterangepicker/daterangepicker',
                ],
                'depend' => 'moment',
            ],
            'bootstrap-fileinput' => [
                'css' => [
                    '/bootstrap-fileinput/css/fileinput.min'
                ],
                'js' => [
                    '/bootstrap-fileinput/js/fileinput.min',
                    '/bootstrap-fileinput/themes/fas/theme.min',
                    '/bootstrap-fileinput/js/locales/'. str_replace(['en','zh-CN'], ['LANG','zh'], config('app.locale')),
                ]
            ],
            'show-drag' => [
                'js' => [
                    '/bootstrap-fileinput/js/plugins/sortable.min',
                ]
            ],
            'select2' => [
                'css' => [
                    '/admin-lte/plugins/select2/css/select2.min',
                    '/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min',
                ],
                'js'  => [
                    '/admin-lte/plugins/select2/js/select2.full.min',
                ],
            ],
            'duallistbox' => [
                'css' => [
                    '/admin-lte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min',
                ],
                'js'  => [
                    '/admin-lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min',
                ],
            ],
            'colorpicker' => [
                'css' => [
                    '/admin-lte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min',
                ],
                'js'  => [
                    '/admin-lte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min',
                ],
            ],
            'input-spinner' => [
                'js' => [
                    '/bootstrap-input-spinner/bootstrap-input-spinner',
                ],
            ],
            'range-slider'=> [
                'css' => [
                    '/ion-rangeslider/css/ion.rangeSlider.min',
                ],
                'js'  => [
                    '/ion-rangeslider/js/ion.rangeSlider.min',
                ],
            ],
            'jquery-ui' => [
                'js' => [
                    '/admin-lte/plugins/jquery-ui/jquery-ui.min'
                ],
            ],
        ];
    }
}
