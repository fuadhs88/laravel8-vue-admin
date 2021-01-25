<?php

namespace Encore\Admin\Layout;

use Illuminate\Contracts\Support\Renderable;

class Row implements Renderable
{
    /**
     * @var Column[]
     */
    protected $columns = [];

    /**
     * row classes.
     *
     * @var array
     */
    protected $class = [];

    /**
     * Row constructor.
     *
     * @param string $content
     */
    public function __construct($content = '')
    {
        if (!empty($content)) {
            $this->column(12, $content);
        }
    }

    /**
     * Add a column.
     *
     * @param int $width
     * @param $content
     */
    public function column($width, $content)
    {
        $width = $width < 1 ? round(12 * $width) : $width;

        $column = new Column($content, $width);

        $this->addColumn($column);
    }

    /**
     * Add class in row.
     *
     * @param array|string $class
     * @return Row
     */
    public function class($class)
    {
        if (is_string($class)) {
            $class = [$class];
        }

        $this->class = $class;

        return $this;
    }

    /**
     * @param Column $column
     */
    protected function addColumn(Column $column)
    {
        $this->columns[] = $column->render();
    }

    /**
     * Render row.
     *
     * @return array|string
     */
    public function render()
    {
        return [
            'class' => $this->class,
            'columns' => $this->columns,
        ];
    }
}
