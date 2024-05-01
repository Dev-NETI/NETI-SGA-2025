<?php

namespace App\Livewire\Views\SgaDashboard;

use Livewire\Component;
use App\Models\Fc007Log;
use App\UtilitiesTrait;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

class Fc007DashboardView extends Component
{
    use UtilitiesTrait;
    public $title = "F-FC-007 Dashboard";
    public $contentTitle = "Process View";

    #[Layout('layouts.app')]
    public function render()
    {
        $verifyBoardCount = count(Fc007Log::where('status_id', 2)->get());
        $approvalBoardCount = count(Fc007Log::where('status_id', 3)->get());
        $principalBoardCount = count(Fc007Log::where('status_id', 4)->get());

        return view('livewire.views.sga-dashboard.fc007-dashboard-view', compact('verifyBoardCount','approvalBoardCount','principalBoardCount'));
    }
    
}
