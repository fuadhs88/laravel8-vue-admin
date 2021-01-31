<?php

namespace Encore\Admin\Form\Actions;

use Encore\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

class View implements Renderable
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render()
    {
        return $this->path;
//        $color = config('admin.theme.color');
//        $text = admin_trans('admin.view');

//        return <<<HTML
//<div class="btn-group float-right mr-2">
//    <a href="{$this->path}" class="btn btn-sm btn-{$color}" title="{$text}">
//        <i class="fas fa-eye"></i><span class="pl-2">{$text}</span>
//    </a>
//</div>
//HTML;

//        return Admin::view('admin::form.actions.view', ['path' => $this->path]);
    }
}
