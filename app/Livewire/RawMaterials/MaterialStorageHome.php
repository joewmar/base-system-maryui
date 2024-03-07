<?php

namespace App\Livewire\RawMaterials;

use Livewire\Component;
use App\Models\Material;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class MaterialStorageHome extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'material_name', 'direction' => 'asc'];

    #[Url]
    public $search ;
    public $headers;
    #[Rule('required')]
    public $category;
    #[Rule('required|unique:materials,material_name')]
    public $materialName;

    public $selectCategory;
    
    public bool $addModal = false;
    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'material_name', 'label' => 'Item', 'class' => 'text-neutral'],
            ['key' => 'category', 'label' => 'Category', 'class' => 'text-neutral'],
        ];
        $this->selectCategory = [
            ['key' => 'marco', 'label' => 'Marco'],
            ['key' => 'micro', 'label' => 'Micro'],
            ['key' => 'medicine', 'label' => 'Medicine'],
        ];
    }

    

    public function add()
    {
        // $this->dispatch('success', ['message' => 'Record Added']);

        session()->flash('error', 'Record Error Saved');
        $this->redirect(route('raw-materials.material-storage-home'));

    }
    #[On('remove')] 
    public function remove(string $id)
    {
        $materialsType = Material::findOrfail(decrypt($id));
        $materialsType->active_status = 0;
        $materialsType->save();
        session()->flash('success', ' Feed Type '.$materialsType->material_name.' Successfully Deleted');
        $this->redirect(route('raw-materials.material-storage-home',));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.raw-materials.material-storage-home', ['materials' => DB::table('materials')->where('active_status', 1)->where('material_name', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
