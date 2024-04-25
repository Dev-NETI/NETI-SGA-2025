<?php

namespace App\Livewire\Reports\SGA;

use App\StoredReportTrait;
use Livewire\Component;

class GenerateStoredReportComponent extends Component
{
    use StoredReportTrait;

    public function __invoke()
    {
        $this->generateFC007();
    }
}
