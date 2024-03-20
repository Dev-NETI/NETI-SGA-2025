<?php

namespace App\Livewire\Components\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $companyData = Company::where('is_active', true)
        ->where('name', 'LIKE', '%'.$this->search.'%')
        ->orderBy('name','asc')
        ->paginate(5);
        return view('livewire.components.company.company-list-component', compact('companyData'));
    }
}
