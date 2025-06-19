<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Personal;

class DeletePersonal extends Component
{
    /**
     * Create a new component instance.
     */

     public $Personal;

    public function __construct($Personal)
    {
        $this->Personal = $Personal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-Personal');
    }
}
