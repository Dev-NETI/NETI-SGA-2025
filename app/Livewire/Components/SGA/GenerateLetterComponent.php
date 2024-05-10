<?php

namespace App\Livewire\Components\SGA;

use App\Models\Company;
use App\Models\User;
use App\SummaryTrait;
use Livewire\Component;
use App\Models\Position;
use App\Models\Principal;
use App\Models\Recipient;
use App\Models\SummaryLog;
use App\Traits\QueryTrait;
use App\Traits\UtilitiesTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

class GenerateLetterComponent extends Component
{
    use AuthorizesRequests;
    use UtilitiesTrait;
    use SummaryTrait;
    use QueryTrait;
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
    public $rejectedList = false;
    public $reGenerate = false;


    #[Layout('layouts.app')]
    public function render()
    {
        $sentBackBoardCount = count(SummaryLog::where('status_id', 1)->get());
        $principalData = Company::where('is_principal', 1)->where('is_active', 1)->get();
        $userData = User::where('is_active', true)
            ->where('position_id', 2)
            ->orderBy('f_name', 'asc')
            ->get();
        return view('livewire.components.s-g-a.generate-letter-component', compact('principalData', 'userData','sentBackBoardCount'));
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
        if ($this->reGenerate) {
            //delete old file
            $deleteFile = Storage::disk('public')->delete('Summary/' . $this->referenceNumber . '.pdf');
            if($deleteFile){
                $this->hardDestroyTrait(SummaryLog::class,'reference_number',$this->referenceNumber);
            }
        }

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

    public function showRejected()
    {
        $this->rejectedList = true;
    }

    public function cancelRejectedList()
    {
        $this->rejectedList = false;
    }

    #[On('reGenerate')]
    public function reGenerate($data)
    {
        Gate::authorize('Authorize', 4);
        $recipientData = User::where('company_id', $data['principalId'])->where('is_active', 1)->first();
        
        Session::put('month', $data['month']);
        Session::put('principalId', $data['principalId']);
        Session::put('recipientId', $recipientData->id);
        $this->isGenerated = true;
        $this->referenceNumber = $data['referenceNumber'];
        $this->reGenerate = true;
        $this->cancelRejectedList();
        $this->isGenerated = true;
    }

}
