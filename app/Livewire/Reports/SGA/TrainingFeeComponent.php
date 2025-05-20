<?php

namespace App\Livewire\Reports\SGA;

use App\FC007Trait;
use Livewire\Component;
use App\Traits\FpdiTrait;
use Illuminate\Support\Facades\Session;

class TrainingFeeComponent extends Component
{
    use FpdiTrait;
    use FC007Trait;

    public function generate()
    {
        $sessionPrincipalId = Session::get('principalId');
        $sessionMonth = Session::get('month');
        $sessionVesselTypeId = Session::get('vesselTypeId');
        $this->generateFC007($sessionPrincipalId, $sessionMonth, $sessionVesselTypeId);
    }
}
