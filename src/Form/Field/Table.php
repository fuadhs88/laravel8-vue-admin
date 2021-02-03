<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\NestedForm;

class Table extends HasMany
{
    /**
     * @var string
     */
    protected $viewMode = 'table';

    protected $forms = [];

    /**
     * Table constructor.
     *
     * @param string $column
     * @param array  $arguments
     */
    public function __construct($column, $arguments = [])
    {
        $this->column = $column;

        if (count($arguments) == 1) {
            $this->label = $this->formatLabel();
            $this->builder = $arguments[0];
        }

        if (count($arguments) == 2) {
            list($this->label, $this->builder) = $arguments;
        }

//        admin_assets_require('initialize');
    }

    /**
     * @return array
     */
    protected function buildRelatedForms()
    {
        $forms = [];

        foreach ($this->value ?? [] as $key => $data) {
            if (isset($data['pivot'])) {
                $data = array_merge($data, $data['pivot']);
            }

            $form = $this->buildNestedForm($this->column, $this->builder, $key)->fill($data);

            $forms[$key] = [
                'fields' => $form->getFields(),
            ];
        }

        return $forms;
    }

    public function prepare($input)
    {
        $form = $this->buildNestedForm($this->column, $this->builder);

        $prepare = $form->prepare($input);

        return collect($prepare)->reject(function ($item) {
            return $item[NestedForm::REMOVE_FLAG_NAME] == 1;
        })->map(function ($item) {
            unset($item[NestedForm::REMOVE_FLAG_NAME]);

            return $item;
        })->toArray();
    }

    protected function getKeyName()
    {
        if (is_null($this->form)) {
            return;
        }

        return 'id';
    }

    protected function buildNestedForm($column, \Closure $builder, $key = null)
    {
        $form = new NestedForm($column);

        $form->setForm($this->form)->setKey($key);

        call_user_func($builder, $form);

        $form->hidden(NestedForm::REMOVE_FLAG_NAME)->default(0)->addElementClass(NestedForm::REMOVE_FLAG_CLASS);

        return $form;
    }

//    protected function getForms(){
//        $this->buildRelatedForms();
//
//        $forms = [];
//
//        foreach ($this->forms as $form) {
//            array_push($forms, [
//                'fields' => $form->fields()
//            ]);
//        }
//
//        return $forms;
//    }

    public function render()
    {
        return $this->renderTable();
    }
}
