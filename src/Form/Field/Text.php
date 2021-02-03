<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\Field;
use Illuminate\Contracts\View\Factory;

class Text extends Field
{
    use PlainInput;
    use HasValuePicker;
    use CanCascadeFields;

    /**
     * @var string
     */
    protected $icon = 'fa-pencil-alt';

    /**
     * @var bool
     */
    protected $withoutIcon = false;

    /**
     * @var array
     */
    protected $inputmask;

    /**
     * Set custom fa-icon.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Render this filed.
     *
     * @return array|string
     * @throws \ReflectionException
     * @throws \Throwable
     */
    public function render()
    {
        $this->initPlainInput();

        if ($this->prepend instanceof Field) {
            $this->prepend = $this->prepend->renderPrepend();
        }

        if (!$this->withoutIcon) {
            $this->prependText('<i class="fas '.$this->icon.' fa-fw"></i>');
        }

        $this
            ->defaultAttribute('type', 'text')
            ->defaultAttribute('id', $this->id)
//            ->defaultAttribute('name', $this->elementName ?: $this->formatName($this->column))
            ->defaultAttribute('value', $this->value())
            ->defaultAttribute('class', 'form-control '.$this->getElementClassString())
            ->defaultAttribute('placeholder', $this->getPlaceholder())
            ->mountPicker()
            ->addVariables([
                'prepend'   => $this->prepend,
                'append'    => $this->append,
                'picker'    => $this->picker,
                'inputmask' => $this->inputmask,
                'inputMaskOptions' => json_encode_options($this->inputmask ?: []),
            ]);

        $this->addCascadeScript();

        return parent::render();
    }

    /**
     * Add inputmask to an elements.
     *
     * @param array $options
     *
     * @return $this
     */
    public function inputmask($options)
    {
        $this->inputmask = $options;

        return $this;
    }

    /**
     * Add datalist element to Text input.
     *
     * @param array $entries
     *
     * @return $this
     */
    public function datalist($entries = [])
    {
        $this->defaultAttribute('list', "list-{$this->id}");

        $datalist = "<datalist id=\"list-{$this->id}\">";
        foreach ($entries as $k => $v) {
            $datalist .= "<option value=\"{$k}\">{$v}</option>";
        }
        $datalist .= '</datalist>';

        return $this->append($datalist);
    }

    /**
     * show no icon in font of input.
     *
     * @return $this
     */
    public function withoutIcon()
    {
        $this->withoutIcon = true;

        return $this;
    }
}
