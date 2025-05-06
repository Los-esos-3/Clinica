<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Trabajadores;

class DeleteTrabajadores extends Component
{
    /**
     * Create a new component instance.
     */

     public $trabajadores;

    public function __construct($trabajadores)
    {
        $this->trabajadores = $trabajadores;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-trabajadores');
    }
}
