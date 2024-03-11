<?php

namespace App\Livewire\FarmInformation;

use App\Models\Farm;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FarmLocation;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class FarmLocationHome extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'farm_location', 'direction' => 'asc'];
    
    #[Url]
    public $search ;

    public $farms;

    #[Rule('required')]
    public $add_farm_id;

    public $headers;
    // Adding Farm Location
    #[Rule('required|unique:farm_locations,farm_location')]
    public $farm_location;     
    public bool $addModal = false;

    // Update Farm Location
    #[Rule('required')]
    public $edit_farm_location;
    #[Rule('required')]
    public $edit_farm_id;
    public $edit_farm_ref;
    public $edit_farm_loc_id;
    public $edit_farm_loc_ref;
    public $farm;
    public bool $editModal = false;

    // Delete Farm Location
    public bool $delModal = false;
    
    public function mount()
    { 
        $this->farms = Farm::where('active_status', 1)->get()->toArray();
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'farm.farm_name', 'label' => 'Farm', 'class' => 'text-neutral'],
            ['key' => 'farm_location', 'label' => 'Farm Location', 'class' => 'text-neutral'],
        ];    
    }

    // Add Location/Farm
    #[On('add')]
    public function add()
    {
        $validatedData = $this->validate([
            'farm_location' => 'required|unique:farm_locations,farm_location',
            'add_farm_id' => 'required',
        ]);
        FarmLocation::create([
            'farm_id' => $this->add_farm_id,
            'farm_location' => $this->farm_location,
        ]);
        session()->flash('success', 'Farm successfully created.');
        $this->redirect(route('farm.information.location'));
    }

    // Edit Location/Farm
    public function edit(string $id)
    {
        if($this->editModal){
            $farm_loc = FarmLocation::findOrFail(decrypt($id));
            $this->edit_farm_location = $farm_loc->farm_location;
            $this->edit_farm_ref = $farm_loc->farm->farm_name;
            $this->edit_farm_loc_ref = $farm_loc->farm_location;
            $this->edit_farm_id = $farm_loc->farm->id;
            $this->edit_farm_loc_id = $id;
        }
    }

    // Delete Location/Farm
    #[On('remove')]
    public function remove(string $id)
    {
        $farm = FarmLocation::findOrfail(decrypt($id));
        $farm->update(['active_status' => 0]);
        session()->flash('success', 'Farm of '.$farm->farm_location.' Successfully Deleted');
        $this->redirect(route('farm.information.location'));
    }

    // Save Action
    #[On('save')]
    public function save(string $id)
    {
        $this->validate([
            'edit_farm_location' => 'required',
        ]);
        $farm_location = FarmLocation::findOrFail(decrypt($id));

        $farm_location->update([
            'farm_location' => $this->edit_farm_location,
        ]);
    session()->flash('success', 'Farm Updated Successfully');
        $this->redirect(route('farm.information.location'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.farm-information.farm-location-home', ['locations' => FarmLocation::where('active_status', 1)->where('farm_location', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
