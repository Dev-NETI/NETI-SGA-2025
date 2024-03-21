<?php

namespace App\Livewire\Views\User;

use App\Models\Company;
use App\Models\Department;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class CreateUserView extends Component
{
    #[Validate([
        'firstname' => 'required|min:2',
        'lastname' => 'required|min:2',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'company' => 'required',
        'department' => 'required',
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

    public function mount($hash_id = null, $pw_id = null)
    {
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
            $this->departmentData = Department::where('company_id', $userData->company_id)
                ->where('is_active', true)
                ->orderBy('name', 'asc')
                ->get();
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
        return view('livewire.views.user.create-user-view', compact('companyData'));
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
        $this->validate();
        try {
            $store = User::create([
                'f_name' => $this->firstname,
                'm_name' => $this->middlename,
                'l_name'  => $this->lastname,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'department_id' => $this->department,
                'company_id' => $this->company,
            ]);
            if (!$store) {
                session()->flash('error', 'Saving user failed!');
            }

            session()->flash('success', 'User saved successfully!');
            return $this->redirectRoute('users.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|email',
            'company' => 'required',
            'department' => 'required',
        ]);

        try {
            $userData = User::find($this->userId);

            if ($this->pwId == null) {
                $update = $userData->update([
                    'f_name' => $this->firstname,
                    'm_name' => $this->middlename,
                    'l_name'  => $this->lastname,
                    'email' => $this->email,
                    'department_id' => $this->department,
                    'company_id' => $this->company,
                ]);
            } else {
                $update = $userData->update([
                    'password' => Hash::make($this->password),
                ]);
            }

            if (!$update) {
                session()->flash('error', 'Updating user failed!');
            }

            session()->flash('success', 'User updated successfully!');
            return $this->redirectRoute('users.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
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
