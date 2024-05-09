<?php

namespace App\Livewire\Views\SgaDashboard;

use Livewire\Component;
use App\Models\Fc007Log;
use App\UtilitiesTrait;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

class Fc007DashboardView extends Component
{
    use UtilitiesTrait;
    public $title = "F-FC-007 Dashboard";
    public $contentTitle = "Process View";

    public function mount()
    {
        Gate::authorize('Authorize',37);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $sentBackBoardCount = count(Fc007Log::where('status_id', 1)->get());
        $verifyBoardCount = count(Fc007Log::where('status_id', 2)->get());
        $approvalBoardCount = count(Fc007Log::where('status_id', 3)->get());
        $principalBoardCount = count(Fc007Log::where('status_id', 4)->get());
        $OrBoardCount = count(Fc007Log::where('status_id', 5)->get());
        $CloseBoardCount = count(Fc007Log::where('status_id', 6)->get());

        return view(
            'livewire.views.sga-dashboard.fc007-dashboard-view',
            compact(
                'sentBackBoardCount',
                'verifyBoardCount',
                'approvalBoardCount',
                'principalBoardCount',
                'OrBoardCount',
                'CloseBoardCount'
            )
        );
    }
}
