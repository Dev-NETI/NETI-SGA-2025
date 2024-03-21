<?php

namespace App\Livewire\Components\User;

use App\Models\User;
use Exception;
use Livewire\Component;

class UserListItemComponent extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.components.user.user-list-item-component');
    }

    public function destroy($id)
    {
        try {
            $userData = User::find($id);
            $update = $userData->update([
                'is_active' => false,
            ]);
            if (!$update) {
                session()->flash('error', 'Deleting user failed!');
            }
            session()->flash('success', 'Deleting user successful!');
            return $this->redirectRoute('users.index');
            
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
