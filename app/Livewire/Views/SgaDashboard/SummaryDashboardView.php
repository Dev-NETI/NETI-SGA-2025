<?php

namespace App\Livewire\Views\SgaDashboard;

use App\DashboardTrait;
use App\Models\Fc007Log;
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
        $verifyBoardCount = count(Fc007Log::where('status_id',2)->get());
        $approvalBoardCount = count(Fc007Log::where('status_id',3)->get());

        return view('livewire.views.sga-dashboard.summary-dashboard-view', compact('verifyBoardCount','approvalBoardCount'));
    }

    public function redirectToMaintenance($id)
    {
        Session::put('processId', $id);
        return $this->redirectRoute('dashboard.summary-maintenance');
    }

}
