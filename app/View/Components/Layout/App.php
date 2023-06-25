<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public $titulo;
    /**
     * Create a new component instance.
     */
    public function __construct($titulo = "pERPetuo")
    {
        $this->titulo = $titulo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.app');
    }
}
