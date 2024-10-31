<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButtons extends Component
{
    public $editRoute;
    public $deleteRoute;

    public function __construct($editRoute, $deleteRoute)
    {
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
    }

    public function render()
    {
        return view('components.action-buttons');
    }
}   