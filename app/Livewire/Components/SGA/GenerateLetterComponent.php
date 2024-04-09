<?php

namespace App\Livewire\Components\SGA;

use App\Models\User;
use Livewire\Component;
use App\Models\Position;
use App\Models\Principal;
use App\Models\Recipient;
use App\SummaryTrait;
use App\Traits\UtilitiesTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GenerateLetterComponent extends Component
{
    use AuthorizesRequests;
    use UtilitiesTrait;
    use SummaryTrait;
    #[Validate([
        'month' => 'required',
        'principal' => 'required',
        'recipient' => 'required',
        'signature' => 'required',
    ])]
    public $month;
    public $hash;
    public $principal;
    public $recipient;
    public $recipientData;
    public $signature;
    public $generateButton;
    public $isGenerated = false;
    public $referenceNumber;


    #[Layout('layouts.app')]
    public function render()
    {
        $principalData = Principal::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
        $userData = User::where('is_active', true)
            ->orderBy('f_name', 'asc')
            ->get();
        return view('livewire.components.s-g-a.generate-letter-component', compact('principalData', 'userData'));
    }

    public function updatedPrincipal($value)
    {
        $this->recipientData = Recipient::where('principal_id', $value)
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function generate()
    {
        Gate::authorize('Authorize', 4);
        $this->validate();
        Session::put('month', $this->month);
        Session::put('principalId', $this->principal);
        Session::put('recipientId', $this->recipient);
        Session::put('userlId', $this->signature);
        $this->isGenerated = true;
        $this->referenceNumber = $this->generateReferenceNumber();
    }

    public function storeLog()
    {
        $monthSession = Session::get('month');
        $principalIdSession = Session::get('principalId');
        $recipientIdSession = Session::get('recipientId');
        $userIdSession = Session::get('userlId');
        $this->generateSummary($monthSession, $principalIdSession, $recipientIdSession, $userIdSession, false, $this->referenceNumber);
        $this->redirectRoute('sga.letter-index');
    }
}
