<?php

namespace Encore\Admin\Table\Displayers;

use Encore\Admin\Admin;

class RowSelector extends AbstractDisplayer
{
    public function display()
    {
        $key = $this->getKey();
        return <<<HTML
<div class="icheck-@color d-inline">
    <input type="checkbox" class="table-row-checkbox" data-id="{$key}" id="@id-{$key}">
    <label for="@id-{$key}"></label>
</div>
HTML;
//        return Admin::view('admin::table.display.row-selector', ['key' => $this->getKey()]);
    }
}
