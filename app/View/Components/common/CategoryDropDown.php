<?php

namespace App\View\Components\common;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryDropDown extends Component
{
    public $columnClass;
    public $name;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($columnClass, $name, $selected = null)
    {
        $this->columnClass = $columnClass;
        $this->name = $name;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['categories'] = Category::all()->pluck('name', 'id');
        return view('components.common.category-drop-down')->with($data);
    }
}
