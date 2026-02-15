<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
       public $route;
    public $icon;
    public $label;

    public function __construct($route, $icon = null, $label = null)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->label = $label;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
