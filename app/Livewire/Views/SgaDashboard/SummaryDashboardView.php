<?php

namespace App\Livewire\Views\SgaDashboard;

use App\DashboardTrait;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SummaryDashboardView extends Component
{
    use DashboardTrait;
    public $title = "Summary Dashboard";
    public $contentTitle = "Process View";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.sga-dashboard.summary-dashboard-view');
    }

    public function redirectToMaintenance($id)
    {
        Session::put('processId', $id);
        return $this->redirectRoute('dashboard.summary-maintenance');
    }

}
