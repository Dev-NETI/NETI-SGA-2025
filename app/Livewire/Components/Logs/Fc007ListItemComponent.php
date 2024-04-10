<?php

namespace App\Livewire\Components\Logs;

use Livewire\Component;
use App\Models\Fc007Log;
use Illuminate\Support\Facades\Redirect;

class Fc007ListItemComponent extends Component
{
    public $data;

    public function render()
    {
        return view('livewire.components.logs.fc007-list-item-component');
    }

    public function show($id)
    {
        $fc007File = Fc007Log::find($id);
        return Redirect::to(asset('storage/F-FC-007/'.$fc007File->file_path));
    }
}
