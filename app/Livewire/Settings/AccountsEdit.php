<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;

class AccountsEdit extends Component
{
    public $account;
    #[Rule('required')]
    public $role;
    #[Rule('required')]
    public $name;
    #[Rule('required|email')]
    public $email;
    public $password;
    public $selectedRoles;

    public function mount(string $id)
    {
        $this->account = User::findOrFail(decrypt($id));
        $this->role = $this->account->role;
        $this->name = $this->account->name;
        $this->email = $this->account->email;
        $this->selectedRoles = [
            ["value" => "admin", "label" => "ADMIN"],
            ["value" => "superuser", "label" => "SUPERUSER"],
            ["value" => "user", "label" => "USER"],
        ];
    }
    public function save(){
        $this->validate();
        $this->account->name = $this->name;
        $this->account->email = $this->email;
        $this->account->role = $this->role;
        if(isset($this->password)) $this->account->password = bcrypt($this->password);
        $this->account->save();
        session()->flash("success","Account successfully updated");
        $this->redirect(route("settings.accounts.home"));
    }
    public function render()
    {
        return view('livewire.settings.accounts-edit');
    }
}
