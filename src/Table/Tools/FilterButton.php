<?php

namespace Encore\Admin\Table\Tools;

use Encore\Admin\Admin;

class FilterButton extends AbstractTool
{
    /**
     * @return array|string
     */
    public function render()
    {
        $label = '';
        $filter = $this->table->getFilter();

        if ($scope = $filter->getCurrentScope()) {
            $label = "&nbsp;{$scope->getLabel()}&nbsp;";
        }

        return [
            'scopes'    => $filter->getScopes(),
            'label'     => $label,
            'cancel'    => $filter->urlWithoutScopes(),
            'btn_class' => uniqid('filter-btn-'),
            'expand'    => $filter->expand,
            'filter_id' => $filter->getFilterID(),
        ];
    }
}
