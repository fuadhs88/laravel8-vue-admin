<?php

namespace Encore\Admin\Layout;

use Closure;
use Encore\Admin\Facades\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;

class Content implements Renderable
{
    /**
     * Content title.
     *
     * @var string
     */
    public $title = ' ';

    /**
     * Content description.
     *
     * @var string
     */
    public $description = ' ';

    /**
     * Page breadcrumb.
     *
     * @var array
     */
    public $breadcrumb = [];

    /**
     * @var Row[]
     */
    public $rows = [];

    /**
     * @var array
     */
    public $view;

    /**
     * Content constructor.
     *
     * @param Closure|null $callback
     */
    public function __construct(\Closure $callback = null)
    {
        if ($callback instanceof Closure) {
            $callback($this);
        }
    }

    /**
     * Alias of method `title`.
     *
     * @param string $header
     *
     * @return $this
     */
    public function header($header = '')
    {
        return $this->title($header);
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set description of content.
     *
     * @param string $description
     *
     * @return $this
     */
    public function description($description = '')
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set breadcrumb of content.
     *
     * @param array ...$breadcrumb
     *
     * @return $this
     */
    public function breadcrumb(...$breadcrumb)
    {
        $this->validateBreadcrumb($breadcrumb);

        $this->breadcrumb = (array) $breadcrumb;

        return $this;
    }

    /**
     * Validate content breadcrumb.
     *
     * @param array $breadcrumb
     *
     * @throws \Exception
     *
     * @return bool
     */
    protected function validateBreadcrumb(array $breadcrumb)
    {
        foreach ($breadcrumb as $item) {
            if (!is_array($item) || !Arr::has($item, 'text')) {
                throw new  \Exception('Breadcrumb format error!');
            }
        }

        return true;
    }

    /**
     * Alias of method row.
     *
     * @param mixed $content
     *
     * @return $this
     */
    public function body($content)
    {
        return $this->row($content);
    }

    /**
     * Add one row for content body.
     *
     * @param $content
     *
     * @return $this
     */
    public function row($content)
    {
        if ($content instanceof Closure) {
            $row = new Row();
            call_user_func($content, $row);
            $this->addRow($row);
        } else {
            $this->addRow(new Row($content));
        }

        return $this;
    }

    /**
     * Render giving view as content body.
     *
     * @param string $view
     * @param array  $data
     *
     * @return $this
     */
    public function view($view, $data = [])
    {
        return $this->body(Admin::view($view, $data));
    }

    /**
     * @param $var
     *
     * @return $this
     */
    public function dump($var)
    {
        return $this->row(admin_dump(...func_get_args()));
    }

    /**
     * Add Row.
     *
     * @param Row $row
     */
    protected function addRow(Row $row)
    {
        $this->rows[] = $row;
    }

    /**
     * Set success message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withSuccess($title = '', $message = '')
    {
        admin_success($title, $message);

        return $this;
    }

    /**
     * Set error message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withError($title = '', $message = '')
    {
        admin_error($title, $message);

        return $this;
    }

    /**
     * Set warning message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withWarning($title = '', $message = '')
    {
        admin_warning($title, $message);

        return $this;
    }

    /**
     * Set info message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withInfo($title = '', $message = '')
    {
        admin_info($title, $message);

        return $this;
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function render()
    {
//        dd($this);
        return admin_view('Layouts/Content', ['contents' => $this]);
    }
}
