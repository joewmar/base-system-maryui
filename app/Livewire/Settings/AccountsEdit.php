<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
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
    #[Rule('nullable|min:8')]
    public $password;
    #[Rule('nullable|same:password|min:8')]
    public $password_confirmation;
    #[Rule('required')]
    public bool $activeStatus;

    public $selectedRoles;

    public function mount(string $id)
    {
        $this->account = User::findOrFail(decrypt($id));
        $this->role = $this->account->role;
        $this->name = $this->account->name;
        $this->email = $this->account->email;
        $this->activeStatus = $this->account->active_status;
        $this->selectedRoles = [
            ["value" => "admin", "label" => "ADMIN"],
            ["value" => "superuser", "label" => "SUPERUSER"],
            ["value" => "user", "label" => "USER"],
        ];
    }
    #[On('save')]
    public function save(){
        $this->validate();
        $this->account->name = $this->name;
        $this->account->email = $this->email;
        $this->account->role = $this->role;
        $this->account->active_status = $this->activeStatus;
        $this->account->save();
        session()->flash("success","Account of ".$this->account->name." successfully updated");
        $this->redirect(route("settings.accounts.home"));
    }
    #[On('savePassword')]
    public function savePassword(){
        $this->validate();
        $this->account->password = bcrypt($this->password);
        $this->account->save();
        session()->flash("success","Change Password successfully updated");
        
        $this->redirect(route("settings.accounts.home"));
    }
    public function render()
    {
        return view('livewire.settings.accounts-edit');
    }
}
