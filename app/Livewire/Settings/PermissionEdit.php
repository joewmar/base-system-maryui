<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use App\Traits\PermissionControl;

class PermissionEdit extends Component
{
    use PermissionControl;
    public $permissions;
    public $user;
    public function mount(string $id)
    {
        $this->user = User::findOrFail(decrypt($id));
        $this->permissions = $this->getModules();
    }
    public function render()
    {
        return view('livewire.settings.permission-edit');
    }
}
