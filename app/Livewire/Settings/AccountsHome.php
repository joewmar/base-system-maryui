<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AccountsHome extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    #[Url]
    public $search = '';
    public $headers;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->headers = [
            ['key' => 'name', 'label' => 'Name' , 'class' => 'text-neutral'],
            ['key' => 'email', 'label' => 'Email' , 'class' => 'text-neutral'],
            ['key' => 'role', 'label' => 'Role' , 'class' => 'text-neutral'],
        ];
    }

    public function remove(string $id)
    {
        $user = User::findOrfail(decrypt($id));
        $user->delete();
        session()->flash('success', 'Account of '.$user->name.' Successfully Deleted');
        $this->redirect(route('settings.accounts.home'));
    }
    public function render()
    {
        return view('livewire.settings.accounts-home', ['users' => DB::table("users")->where('name', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
