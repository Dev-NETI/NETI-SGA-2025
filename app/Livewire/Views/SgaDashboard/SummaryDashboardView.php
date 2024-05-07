<?php

namespace App\Livewire\Views\SgaDashboard;

use App\DashboardTrait;
use App\Models\SummaryLog;
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
        $summaryLogData = SummaryLog::orderBy('id','DESC')->get();
        $generateBoard = $summaryLogData->where('status_id', 1);
        $verificationBoard = $summaryLogData->where('status_id', 2);
        $approvalBoard = $summaryLogData->where('status_id', 3);
        $principalBoard = $summaryLogData->where('status_id', 4);
        $closeBoard = $summaryLogData->where('status_id', 5);

        return view('livewire.views.sga-dashboard.summary-dashboard-view', compact(
            'generateBoard','verificationBoard','approvalBoard','principalBoard','closeBoard'
        ));
    }

    public function redirectToMaintenance($id)
    {
        Session::put('processId', $id);
        return $this->redirectRoute('dashboard.summary-maintenance');
    }

}
