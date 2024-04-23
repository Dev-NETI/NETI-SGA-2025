<?php

namespace App\Livewire\Views\SgaDashboard;

use App\EmailManagementTrait;
use App\Models\SummaryReportEmailRecipient;
use App\Models\User;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SummaryDashboardMaintenanceView extends Component
{
    use QueryTrait;
    use EmailManagementTrait;
    #[Validate([
        'user' => 'required'
    ])]
    public $user;
    public $title;
    public $processId;

    public function mount()
    {
        $this->processId = Session::get('processId');
        $this->title = $this->pageTitle($this->processId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $userData = User::where('is_active', 1)->orderBy('f_name', 'asc')->get();

        return view(
            'livewire.views.sga-dashboard.summary-dashboard-maintenance-view',
            compact('userData')
        );
    }

    public function store()
    {

        $this->validate();

        $store = SummaryReportEmailRecipient::create([
            'process_id' => $this->processId,
            'user_id' => $this->user,

        ]);

        $this->storeTrait($store, "Saving email failed!", "Saving email success!");
        return $this->redirectRoute('dashboard.summary-maintenance');
    }

}
