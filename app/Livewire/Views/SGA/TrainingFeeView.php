<?php

namespace App\Livewire\Views\SGA;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TrainingFeeView extends Component
{
    public $title="SGA";
    public $contentTitle="Training Fee";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.s-g-a.training-fee-view');
    }
}
