<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PermissionHome extends Component
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
            ['key' => 'name', 'label' => 'Name'  ],
            ['key' => 'email', 'label' => 'Email'  ],
            ['key' => 'role', 'label' => 'Role'  ],
        ];
    }
    public function render()
    {
        return view('livewire.settings.permission-home', ['users' => DB::table("users")->where('name', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
