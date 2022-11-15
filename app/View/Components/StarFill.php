<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarFill extends Component
{
    public $class;
    public $width;

    public function __construct(?string $class = null, ?string $width = null)
    {
        $this->class = $class;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.star-fill');
    }
}
