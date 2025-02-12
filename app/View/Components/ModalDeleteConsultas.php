<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDeleteConsultas extends Component
{
    public $consulta;
    public $paciente;
    /**
     * Create a new component instance.
     */
    public function __construct($consulta, $paciente)
    {
        $this->consulta = $consulta;
        $this->paciente = $paciente;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-delete-consultas');
    }
}
