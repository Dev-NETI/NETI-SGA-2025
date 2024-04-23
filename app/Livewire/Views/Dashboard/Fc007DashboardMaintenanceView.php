<?php

namespace App\Livewire\Views\Dashboard;

use App\EmailManagementTrait;
use App\Models\Fc007ReportEmailRecipient;
use App\Models\User;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Fc007DashboardMaintenanceView extends Component
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
        return view('livewire.views.dashboard.fc007-dashboard-maintenance-view', compact('userData'));
    }

    public function store()
    {
        $this->validate();

        $store = Fc007ReportEmailRecipient::create([
            'process_id' => $this->processId,
            'user_id' => $this->user,

        ]);

        $this->storeTrait($store, "Saving email failed!", "Saving email success!");
        return $this->redirectRoute('dashboard.fc007-maintenance');
    }
}
