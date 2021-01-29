<?php

namespace Encore\Admin\Widgets\Navbar;

use Encore\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

class RefreshButton implements Renderable
{
    public function render()
    {
        return [
            'view' => 'Actions/Refresh'
        ];
//        return Admin::view('admin::components.refresh-btn');
    }
}
