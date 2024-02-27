<?php

namespace App\Livewire\FarmInformation;

use App\Models\Farm;
use Livewire\Component;
use Livewire\Attributes\Rule;

class FarmEdit extends Component
{
    #[Rule('required')]
    public $farm_name;
    public $farm;
    public bool $modalEdit = false;
    public function mount($id)
    {
        $this->farm = Farm::findOrFail(decrypt($id));
        $this->farm_name = $this->farm->farm_name;
    }
    public function save()
    {
        $this->validate();
        $this->farm->update([
            'farm_name' => $this->farm_name,
        ]);
        session()->flash('sucesss', 'Farm Updated Successfully');
        $this->redirect(route('farm.information.farm'));
    }
    public function render()
    {
        return view('livewire.farm-information.farm-edit');
    }
}
