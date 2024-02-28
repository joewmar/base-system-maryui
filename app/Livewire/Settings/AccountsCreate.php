<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;

class AccountsCreate extends Component
{
    #[Rule('required')]
    public $role;
    #[Rule('required|unique:users,name')]
    public $name;
    #[Rule('required|email|unique:users,email')]
    public $email;
    #[Rule('required|min:8')]
    public $password;
    #[Rule('required_with:password|same:password|min:8')]
    public $password_confirmation;
    public $selectedRoles;
    public function mount()
    {
        $this->selectedRoles = [
            ["value" => "admin", "label" => "ADMIN"],
            ["value" => "superuser", "label" => "SUPERUSER"],
            ["value" => "user", "label" => "USER"],
        ];
    }
    public function add()
    {
        $this->validate();
        User::create([
            "name"=> $this->name,
            "email"=> $this->email,
            "password"=> bcrypt($this->password),
            'role' => $this->role
        ]);
        session()->flash('success','New Account successfully added');
        $this->redirect(route('settings.accounts.home'));
    }
    public function render()
    {
        return view('livewire.settings.accounts-create');
    }
}
