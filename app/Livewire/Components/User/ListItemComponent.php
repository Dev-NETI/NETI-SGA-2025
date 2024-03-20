<?php

namespace App\Livewire\Components\User;

use App\Models\UserRole;
use Exception;
use Livewire\Component;

class ListItemComponent extends Component
{
    public $data;
    public $isRole; //1 - role model , 2 - userRole model
    public $buttonLabel;
    public $buttonClass;
    public $user;

    public function render()
    {
        return view('livewire.components.user.list-item-component');
    }

    public function store($id)
    {
        try {
            $store = UserRole::create([
                'role_id' => $id,
                'user_id' => $this->user
            ]);

            if (!$store) {
                session()->flash('error', 'Saving role failed!');
            }

            session()->flash('success', 'Role saved successfully!');
            return $this->redirectRoute('users.index', navigate:true);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
