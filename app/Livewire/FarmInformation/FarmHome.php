<?php

namespace App\Livewire\FarmInformation;

use App\Models\Farm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class FarmHome extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'farm_name', 'direction' => 'asc'];
    
    #[Url]
    public $search ;

    public $headers;
    // Adding Farm Information
    #[Rule('required|unique:farms,farm_name')]
    public $farm_name;
    
    public bool $addModal = false;

    // Update Farm Information
    #[Rule('required')]
    public $edit_farm_name;
    #[Rule('required')]
    public $edit_farm_id;
    public $edit_farm_ref;
    public $farm;
    public bool $editModal = false;

    public bool $delModal = false;
    
    public function edit(string $id)
    {
        if($this->editModal){
            $farm = Farm::findOrFail(decrypt($id));
            $this->edit_farm_name = $farm->farm_name;
            $this->edit_farm_ref = $farm->farm_name;
            $this->edit_farm_id = $id;
        }
    }

    #[On('save')]
    public function save(string $id)
    {
        $this->validate([
            'edit_farm_name' => 'required',
        ]);
        $farm = Farm::findOrFail(decrypt($id));

        $farm->update([
            'farm_name' => $this->edit_farm_name,
        ]);
    session()->flash('success', 'Farm Updated Successfully');
        $this->redirect(route('farm.information.farm'));
    }
    public function mount()
    { 
        $this->headers = [
            ['key' => 'id', 'label' => '#' ],
            ['key' => 'farm_name', 'label' => 'Farm' ],
        ];

        
    }

    #[On('add')]
    public function add()
    {
        $validatedData = $this->validate([
            'farm_name' => 'required|unique:farms,farm_name',
        ]);
        Farm::create($validatedData);
        session()->flash('success', 'Farm successfully created.');
        $this->redirect(route('farm.information.farm'));
    }
    #[On('remove')]
    public function remove(string $id)
    {
        $farm = Farm::findOrfail(decrypt($id));
        $farm->update(['active_status' => 0]);
        session()->flash('success', 'Farm of '.$farm->farm_name.' Successfully Deleted');
        $this->redirect(route('farm.information.farm'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.farm-information.farm-home', ['farms' => DB::table('farms')->where('active_status', 1)->where('farm_name', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
