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
    public $title = "Dashboard";
    public $contentTitle = "SGA";

    public function mount()
    {
        Gate::authorize('Authorize', 37);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $sentBackBoardCount = count(Fc007Log::where('status_id', 1)->get());
        $verifyBoardCount = count(Fc007Log::where('status_id', 2)->get());
        $comptrollerBoardCount = count(Fc007Log::where('status_id', 3)->get());
        $presidentBoardCount = count(Fc007Log::where('status_id', 4)->get());
        // $OrBoardCount = count(Fc007Log::where('status_id', 5)->get());
        $CloseBoardCount = count(Fc007Log::where('status_id', 5)->get());

        return view(
            'livewire.views.sga-dashboard.fc007-dashboard-view',
            compact(
                'sentBackBoardCount',
                'verifyBoardCount',
                'comptrollerBoardCount',
                'presidentBoardCount',
                // 'OrBoardCount',
                'CloseBoardCount'
            )
        );
    }
}
