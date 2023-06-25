<?php

namespace App\View\Components\Layout\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Aside extends Component
{


    public $open = false;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.partials.aside', [
            'open' => $this->open,
        ]);
    }
}
