<?php

namespace Encore\Admin\Table\Displayers;

use Encore\Admin\Admin;

class RowSelector extends AbstractDisplayer
{
    public function display()
    {
        $key = $this->getKey();

        $color = config('admin.theme.color');
        return <<<HTML
<div class="icheck-{$color} d-inline">
    <input type="checkbox" class="table-row-checkbox" data-id="{$key}" id="table-row-checkbox-{$key}">
    <label for="table-row-checkbox-{$key}"></label>
</div>
HTML;
//        return Admin::view('admin::table.display.row-selector', ['key' => $this->getKey()]);
    }
}
