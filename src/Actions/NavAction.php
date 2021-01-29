<?php

namespace Encore\Admin\Actions;

abstract class NavAction extends Action
{
    /**
     * @var string
     */
    public $selectorPrefix = '.navbar-action-';

    /**
     * @var string
     */
    protected $icon = 'fa-bars';

    /**
     * @return string
     */
    protected function icon()
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return '';
    }

    /**
     *
     */
    public function href()
    {
    }


    public function render()
    {
        if ($href = $this->href()) {
            return [
                'href' => $href,
                'title' => $this->name(),
                'icon' => $this->icon(),
            ];
//            return '<li class="nav-item"><a class="nav-link" href="'. $href.'" title="' . $this->name().'"><i class="fas ' . $this->icon() .'"></i></a></li>';
        }

//        $this->addScript();

//        $attributes = $this->formatAttributes();

        return [
            'class' => $this->getElementClass(),
            'title' => $this->name(),
            'icon' => $this->icon(),
            'attributes' => $this->attributes,
            'script' => $this->addScript(),
        ];
//        return '<li class="nav-item"><a href="javascript:void(0);" class="nav-link ' . $this->getElementClass() . '" title="' . $this->name() . '" ' . $attributes . '><i class="fa ' . $this->icon() . '"></i></a></li>';
    }
}
