<?php

namespace App\Livewire\Components\SgaDashboard;

use App\Models\Fc007ReportEmailRecipient;
use App\Traits\QueryTrait;
use Livewire\Component;

class Fc007DashboardMaintenanceListComponent extends Component
{
    use QueryTrait;
    public $processId;

    public function render()
    {
        $emailData = Fc007ReportEmailRecipient::where('process_id', $this->processId)
            ->where('is_active', 1)
            ->get();
        return view('livewire.components.sga-dashboard.fc007-dashboard-maintenance-list-component', compact('emailData'));
    }

    public function destroy($id)
    {
        $emailData = Fc007ReportEmailRecipient::find($id);
        $destroy = $emailData->update([
            'is_active' => 0,
        ]);

        $this->updateTrait($emailData,'dashboard.fc007-maintenance',$destroy, 'Deleting email recipient failed!', 'Deleting email recipient successful!');
        return $this->redirectRoute('dashboard.fc007-maintenance');
    }
}
