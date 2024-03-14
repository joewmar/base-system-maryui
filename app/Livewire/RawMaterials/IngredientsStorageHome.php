<?php

namespace App\Livewire\RawMaterials;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class IngredientsStorageHome extends Component
{

    use WithPagination;
    public array $sortBy = ['column' => 'material_name', 'direction' => 'asc'];

    public $search;
    public $headers;
    public $filterCategory = '';
    
    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#' ],
            ['key' => 'material_name', 'label' => 'Materials' ],
            ['key' => 'category', 'label' => 'Category' ],
        ];
    }


    public function render()
    {
        $data = DB::table('materials')->where('active_status', 1)->where('material_name', 'like', '%' . $this->search . '%')->where('category', 'like', '%' . $this->filterCategory . '%')->orderBy(...array_values($this->sortBy))->paginate(5);
        return view('livewire.raw-materials.ingredients-storage-home', ['materials' => $data]);
    }
}
