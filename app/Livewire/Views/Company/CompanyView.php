<?php

namespace App\Livewire\Views\Company;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CompanyView extends Component
{
    public $title = "Company";
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.company.company-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
