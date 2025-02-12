<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalMasInformacion extends Component
{
    public $paciente;

    /**
     * Create a new component instance.
     */
    public function __construct($paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-mas-informacion');
    }
}
