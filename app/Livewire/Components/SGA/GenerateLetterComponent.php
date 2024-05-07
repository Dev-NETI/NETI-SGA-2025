<?php

namespace App\Livewire\Components\SGA;

use App\Models\Company;
use App\Models\User;
use App\SummaryTrait;
use Livewire\Component;
use App\Models\Position;
use App\Models\Principal;
use App\Models\Recipient;
use App\Traits\UtilitiesTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GenerateLetterComponent extends Component
{
    use AuthorizesRequests;
    use UtilitiesTrait;
    use SummaryTrait;
    #[Validate([
        'month' => 'required',
        'principal' => 'required',
    ])]
    public $month;
    public $hash;
    public $principal;
    public $recipientData;
    public $generateButton;
    public $isGenerated;
    public $referenceNumber;


    #[Layout('layouts.app')]
    public function render()
    {
        $principalData = Company::where('is_principal',1)->where('is_active',1)->get();
        $userData = User::where('is_active', true)
            ->where('position_id', 2)
            ->orderBy('f_name', 'asc')
            ->get();
        return view('livewire.components.s-g-a.generate-letter-component', compact('principalData', 'userData'));
    }

    public function updatedPrincipal($value)
    {
        $this->recipientData = User::where('company_id', $value)->where('is_active', 1)->first();
    }

    public function generate()
    {
        Gate::authorize('Authorize', 4);
        $this->validate();
        Session::put('month', $this->month);
        Session::put('principalId', $this->principal);
        Session::put('recipientId', $this->recipientData->id);
        $this->isGenerated = true;
        $this->referenceNumber = $this->generateReferenceNumber();
    }

    public function storeLog()
    {
        $monthSession = Session::get('month');
        $principalIdSession = Session::get('principalId');
        $recipientIdSession = Session::get('recipientId');
        $this->generateSummary($monthSession, $principalIdSession, $recipientIdSession, false, $this->referenceNumber);
        $this->redirectRoute('dashboard.summary');
    }

    public function cancel()
    {
        $this->isGenerated = false;
    }

}
