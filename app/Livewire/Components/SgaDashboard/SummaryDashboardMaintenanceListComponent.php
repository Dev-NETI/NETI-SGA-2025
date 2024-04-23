<?php

namespace App\Livewire\Components\SgaDashboard;

use App\Models\SummaryReportEmailRecipient;
use App\Traits\QueryTrait;
use Livewire\Component;

class SummaryDashboardMaintenanceListComponent extends Component
{
    use QueryTrait;
    public $processId;

    public function render()
    {
        $emailData = SummaryReportEmailRecipient::where('process_id', $this->processId)
            ->where('is_active', 1)
            ->get();

        return view(
            'livewire.components.sga-dashboard.summary-dashboard-maintenance-list-component',
            compact('emailData')
        );
    }

    public function destroy($id)
    {
        $emailData = SummaryReportEmailRecipient::find($id);
        $destroy = $emailData->update([
            'is_active' => 0,
        ]);

        $this->updateTrait($emailData,'dashboard.summary-maintenance',$destroy, 'Deleting email recipient failed!', 'Deleting email recipient successful!');
        return $this->redirectRoute('dashboard.summary-maintenance');
    }
}
