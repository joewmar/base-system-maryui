<?php

namespace App\Livewire\FarmInformation;

use App\Models\Farm;
use Livewire\Component;
use Livewire\Attributes\Rule;

class FarmCreate extends Component
{
    public bool $addFarmMdl = false;
    #[Rule('required|unique:farms,farm_name')]
    public $farm_name;

    public function add()
    {
        $validatedData = $this->validate([
            'farm_name' => 'required|unique:farms,farm_name',
        ]);
        Farm::create($validatedData);
        session()->flash('success', 'Farm successfully created.');
        $this->redirect(route('farm.information.farm'));
    }
    public function render()
    {
        return view('livewire.farm-information.farm-create');
    }
}
