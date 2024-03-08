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

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'material_name', 'label' => 'Materials', 'class' => 'text-neutral'],
            ['key' => 'category', 'label' => 'Category', 'class' => 'text-neutral'],
        ];
    }

    public function render()
    {
        return view('livewire.raw-materials.ingredients-storage-home', ['materials' => DB::table('materials')->where('active_status', 1)->where('material_name', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
