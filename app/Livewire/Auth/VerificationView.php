<?php

namespace App\Livewire\Auth;

use App\Mail\SendVerificationPin;
use Livewire\Component;
use App\Traits\UtilitiesTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

class VerificationView extends Component
{

    use UtilitiesTrait;
    #[Validate([
        'input1' => 'required|min:1|max:1',
        'input2' => 'required|min:1|max:1',
        'input3' => 'required|min:1|max:1',
        'input4' => 'required|min:1|max:1',
        'input5' => 'required|min:1|max:1',
        'input6' => 'required|min:1|max:1',
    ])]
    public $input1;
    public $input2;
    public $input3;
    public $input4;
    public $input5;
    public $input6;
    public $verificationPin;

    #[Layout('layouts.guest')]
    public function render()
    {
        $this->verificationPin = $this->generateVerificationPin(999999);
        // $this->sendVerificationPin();

        return view('livewire.auth.verification-view');
    }

    public function sendVerificationPin()
    {
        Mail::to(Auth::user()->email)
            ->cc('sherwin.roxas@neti.com.ph')
            ->send(new SendVerificationPin($this->verificationPin, Auth::user()));
    }

    public function verify()
    {
        $this->validate();

        if ($this->verificationPin != $this->input1 . $this->input2 . $this->input3 . $this->input4 . $this->input5 . $this->input6) {
            session()->flash('error', 'Invalid one time pin!');
        } else {
            Session::put('verified', true);
            return $this->redirectRoute('vessel.index');
        }
    }
}
