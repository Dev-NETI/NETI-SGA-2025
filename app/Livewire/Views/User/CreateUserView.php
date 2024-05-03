<?php

namespace App\Livewire\Views\User;

use Exception;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use App\Models\Position;
use App\Models\Department;
use App\Traits\QueryTrait;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateUserView extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    use QueryTrait;
    #[Validate([
        'firstname' => 'required|min:2',
        'lastname' => 'required|min:2',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'company' => 'required',
        'department' => 'required',
        'position' => 'required',
        'principal' => 'required'
    ])]
    public $firstname;
    public $middlename;
    public $lastname;
    public $email;
    public $password;
    public $userId;
    public $hash = null;
    public $pwId = null; //not null = change password
    public $company;
    public $department;
    public $departmentData;
    public $position;
    public $signature;
    public $signature_path = null;
    public $principal;
    public $principalData;

    public function mount($hash_id = null, $pw_id = null)
    {
        $this->principalData =  [
            (object)['id' => 0, 'name' => 'No'],
            (object)['id' => 1, 'name' => 'Yes']
        ];
        if ($hash_id != NULL) {
            $this->hash = $hash_id;
            $userData = User::where('hash', $this->hash)->first();
            $this->firstname = $userData->f_name;
            $this->middlename = $userData->m_name;
            $this->lastname = $userData->l_name;
            $this->email = $userData->email;
            $this->userId = $userData->id;
            $this->department = $userData->department_id;
            $this->company = $userData->company_id;
            $this->position = $userData->position_id;
            $this->departmentData = Department::where('company_id', $userData->company_id)
                ->where('is_active', true)
                ->orderBy('name', 'asc')
                ->get();
            $this->principal = $userData->is_principal;
        }
        if ($pw_id != NULL) {
            $this->pwId = $pw_id;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $companyData = Company::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
        $positionData = Position::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
        return view('livewire.views.user.create-user-view', compact('companyData', 'positionData'));
    }

    public function updatedCompany($value)
    {
        $this->departmentData = Department::where('company_id', $value)
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function store()
    {
        Gate::authorize('Authorize', 25);
        $this->validate();

        if ($this->signature != null) {
            $signature_path = $this->signature->store('public/signature');
            $this->signature_path = basename($signature_path);
        }

        $query = User::create([
            'f_name' => $this->firstname,
            'm_name' => $this->middlename,
            'l_name'  => $this->lastname,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'department_id' => $this->department,
            'company_id' => $this->company,
            'position_id' => $this->position,
            'signature_path' => $this->signature_path,
            'is_principal' => $this->principal
        ]);
        $errorMsg = "Saving user failed!";
        $successMsg = "Saving user successful!";
        $route = "users.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        $this->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|email',
            'company' => 'required',
            'department' => 'required',
            'position' => 'required',
            'principal' => 'required'
        ]);

        if ($this->signature != null) {
            $signature_path = $this->signature->store('public/signature');
            $this->signature_path = basename($signature_path);
        }

        $data = User::find($this->userId);
        if ($this->pwId == null) {
            Gate::authorize('Authorize', 26);
            $query = $data->update([
                'f_name' => $this->firstname,
                'm_name' => $this->middlename,
                'l_name'  => $this->lastname,
                'email' => $this->email,
                'department_id' => $this->department,
                'company_id' => $this->company,
                'position_id' => $this->position,
                'signature_path' => $this->signature_path,
                'is_principal' => $this->principal
            ]);
        } else {
            Gate::authorize('Authorize', 29);
            $query = $data->update([
                'password' => Hash::make($this->password),
            ]);
        }

        $routeBack = "users.index";
        $errorMsg = "Updating user failed!";
        $successMsg = "Updating user successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }

    public function generatePassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomPassword = '';

        for ($i = 0; $i < 12; $i++) {
            $randomPassword .= $characters[rand(0, $charactersLength - 1)];
        }

        $this->password = $randomPassword;
    }
}
