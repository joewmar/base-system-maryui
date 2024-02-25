<?php

namespace App\Livewire\FarmInformation;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class FarmHome extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'farm_name', 'direction' => 'asc'];
    
    #[Url]
    public $search ;

    public $headers;
    public function mount()
    { 
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'farm_name', 'label' => 'Farm', 'class' => 'text-neutral'],
        ];
    }
    public function updated()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.farm-information.farm-home', ['farms' => DB::table('farms')->where('active_status', 1)->where('farm_name', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
