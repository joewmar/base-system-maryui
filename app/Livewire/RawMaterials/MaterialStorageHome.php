<?php

namespace App\Livewire\RawMaterials;

use App\Models\Farm;
use Livewire\Component;
use App\Models\Material;
use Illuminate\Support\Str;
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

    public array $selected = [];
    public $headers;
    public $filterCategory = '';

    #[Rule('required')]
    public $category;
    #[Rule('required|unique:materials,material_name')]
    public $materialName;


    #[Rule('required')]
    public $editCategory;
    #[Rule('required')]
    public $editMaterialName;

    public $editMaterialID;
    public $editMatRefName;

    
    public bool $addModal = false;
    public bool $editModal = false;

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'material_name', 'label' => 'Item', 'class' => 'text-neutral'],
            ['key' => 'category', 'label' => 'Category', 'class' => 'text-neutral'],
        ];
    }

    public function edit(string $id)
    {
        if($this->editModal){
            $material = Material::findOrfail(decrypt($id));
            $this->editCategory = $material->category;
            $this->editMaterialName = $material->material_name;
            $this->editMatRefName = $material->material_name;
            $this->editMaterialID = $id;
        }
    }
    #[On('save')]
    public function save(string $id)
    {
        $this->validate([
            'editCategory' => 'required',
            'editMaterialName' => 'required'
        ]);
        $material = Material::findOrfail(decrypt($id));
        if($material){
            $material->category = $this->editCategory;
            $material->material_name = $this->editMaterialName;
            $material->save();
            session()->flash('success', 'Material of '.$material->material_name.' successfully updated');
            $this->redirect(route('raw-materials.material-storage-home'));
        }
    }
    #[On('add')]
    public function add()
    {
        $validated = $this->validate([
            'category' => 'required',
            'materialName' => 'required|unique:materials,material_name',
        ]);
        $material = Material::create([
            'material_name' => $validated['materialName'],
            'category' => $validated['category'],
        ]);
        if($material){
            session()->flash('success', 'Material successfully added');
            $this->redirect(route('raw-materials.material-storage-home'));
        }
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
    public function updatedFilterCategory(){
        $this->resetPage();
    }
    public function render()
    {
        $data =  DB::table('materials')->where('active_status', 1)->where('category', 'like', '%' . $this->filterCategory . '%')->where('material_name', 'like', '%' . Str::upper($this->search) . '%')->orderBy(...array_values($this->sortBy))->paginate(5);
        return view('livewire.raw-materials.material-storage-home', ['materials' => $data]);
    }
}
