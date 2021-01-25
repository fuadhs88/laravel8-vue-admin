<?php

namespace Encore\Admin\Table;

use Encore\Admin\Actions\TableAction;
use Encore\Admin\Table;
use Encore\Admin\Table\Tools\AbstractTool;
use Encore\Admin\Table\Tools\BatchActions;
use Encore\Admin\Table\Tools\FilterButton;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;

class Tools implements Renderable
{
    /**
     * Parent table.
     *
     * @var Table
     */
    protected $table;

    /**
     * Collection of tools.
     *
     * @var Collection
     */
    protected $tools;

    /**
     * Create a new Tools instance.
     *
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->table = $table;

        $this->tools = new Collection();

        $this->appendDefaultTools();
    }

    /**
     * Append default tools.
     */
    protected function appendDefaultTools()
    {
        $this->append(new BatchActions())->append(new FilterButton());
    }

    /**
     * Append tools.
     *
     * @param AbstractTool|string $tool
     *
     * @return $this
     */
    public function append($tool)
    {
        if ($tool instanceof TableAction) {
            $tool->setTable($this->table);
        }

        $this->tools->push($tool);

        return $this;
    }

    /**
     * Prepend a tool.
     *
     * @param AbstractTool|string $tool
     *
     * @return $this
     */
    public function prepend($tool)
    {
        $this->tools->prepend($tool);

        return $this;
    }

    /**
     * Disable filter button.
     *
     * @param bool $disable
     * @return void
     */
    public function disableFilterButton($disable = true)
    {
        $this->tools = $this->tools->map(function ($tool) use ($disable) {
            if ($tool instanceof FilterButton) {
                return $tool->disable($disable);
            }

            return $tool;
        });
    }

    /**
     * Disable batch actions.
     *
     * @param bool $disable
     * @return void
     */
    public function disableBatchActions($disable = true)
    {
        $this->tools = $this->tools->map(function ($tool) use ($disable) {
            if ($tool instanceof BatchActions) {
                return $tool->disable($disable);
            }

            return $tool;
        });
    }

    /**
     * @param \Closure $closure
     */
    public function batch(\Closure $closure)
    {
        call_user_func($closure, $this->tools->first(function ($tool) {
            return $tool instanceof BatchActions;
        }));
    }

    /**
     * Render header tools bar.
     *
     * @return array|string
     */
    public function render()
    {
        return $this->tools->map(function ($tool) {
            if ($tool instanceof AbstractTool) {
                if (!$tool->allowed()) {
                    return '';
                }

                return $tool->setTable($this->table)->render();
            }

            if ($tool instanceof Renderable) {
                return $tool->render();
            }

            if ($tool instanceof Htmlable) {
                return $tool->toHtml();
            }

            return (string) $tool;
        })->toArray();
//        })->implode(' ');
    }
}
