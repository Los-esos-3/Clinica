<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PacientessecretariaComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $pacientes;
    
    public function __construct($pacientes)
    {
        $this->pacientes = $pacientes;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pacientes-secretaria-component');
    }
}
