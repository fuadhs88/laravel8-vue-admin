<?php

namespace Encore\Admin\Layout;

use Encore\Admin\Table;
use Illuminate\Contracts\Support\Renderable;

class Column implements Renderable
{
    /**
     * table system prefix width.
     *
     * @var array
     */
    protected $width = [];

    /**
     * @var array
     */
    protected $contents = [];

    /**
     * Column constructor.
     *
     * @param $content
     * @param int $width
     */
    public function __construct($content, $width = 12)
    {
        if ($content instanceof \Closure) {
            call_user_func($content, $this);
        } else {
            $this->append($content);
        }

        ///// set width.
        // if null, or $this->width is empty array, set as "md" => "12"
        if (is_null($width) || (is_array($width) && count($width) === 0)) {
            $this->width['md'] = 12;
        }
        // $this->width is number(old version), set as "md" => $width
        elseif (is_numeric($width)) {
            $this->width['md'] = $width;
        } else {
            $this->width = $width;
        }
    }

    /**
     * Append content to column.
     *
     * @param $content
     *
     * @return $this
     */
    public function append($content)
    {
        $this->contents[] = ($content instanceof Renderable) ? $content->render() : $content;

        return $this;
    }

    /**
     * Add a row for column.
     *
     * @param $content
     *
     * @return Column
     */
    public function row($content)
    {
        if (!$content instanceof \Closure) {
            $row = new Row($content);
        } else {
            $row = new Row();

            call_user_func($content, $row);
        }

        return $this->append($row);
    }

    /**
     * Render row.
     *
     * @return array|string
     */
    public function render()
    {
        return [
            'width' => $this->width,
            'contents' => $this->contents,
        ];
    }
}
