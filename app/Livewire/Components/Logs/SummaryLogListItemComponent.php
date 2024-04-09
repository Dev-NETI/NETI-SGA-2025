<?php

namespace App\Livewire\Components\Logs;

use Livewire\Component;
use App\Models\SummaryLog;
use Illuminate\Support\Facades\Redirect;

class SummaryLogListItemComponent extends Component
{
    public $summary;
    
    public function render()
    {
        return view('livewire.components.logs.summary-log-list-item-component');
    }

    public function show($id)
    {
        $summaryFile = SummaryLog::find($id);
        // dd(storage_path('app/public/Summary/'.$summaryFile->file_path));
        return Redirect::to(asset('storage/Summary/'.$summaryFile->file_path));
    }
}
