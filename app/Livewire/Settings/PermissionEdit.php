<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\PermissionControl;

class PermissionEdit extends Component
{
    use PermissionControl;
    public $permissions;
    public $user;
    public array $userPermission;
    public function mount(string $id)
    {
        $this->user = User::findOrFail(decrypt($id));
        $this->permissions = $this->getModules();
        $this->userPermission = explode(',', $this->user->access_controls);
    }
    #[On('save')]
    public function save()
    {
        $strMod = implode(',', $this->userPermission);
        $this->user->access_controls = $strMod;
        $this->user->save();
        session()->flash('success', 'Permission of '.$this->user->name.' Updated Successfully');
        $this->redirect(route('settings.permissions.home'));
    }
    public function render()
    {
        return view('livewire.settings.permission-edit');
    }
}
