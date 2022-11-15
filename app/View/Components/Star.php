<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Star extends Component
{
    public $class;

    public function __construct(?string $class = null)
    {
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.star');
    }
}
