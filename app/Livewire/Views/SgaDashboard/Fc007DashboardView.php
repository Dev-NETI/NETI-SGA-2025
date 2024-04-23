<?php

namespace App\Livewire\Views\SgaDashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

class Fc007DashboardView extends Component
{
    public $title = "F-FC-007 Dashboard";
    public $contentTitle = "Process View";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.sga-dashboard.fc007-dashboard-view');
    }

    public function redirectToMaintenance($id)
    {
        Session::put('processId', $id);
        return $this->redirectRoute('dashboard.fc007-maintenance');
    }

}
