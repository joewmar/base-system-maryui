<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\Material;
use App\Models\WeeklyOrder;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class WeeklyRequisitionEdit extends Component
{
    public $material;

    public $headers;

    public $listDate;

    // Add Requisition
    #[Rule('required|date')]
    public $addDate;
    #[Rule('required|numeric')]
    public $price_per_kg;
    #[Rule('required|numeric')]
    public $inventory_cost;
    #[Rule('required|numeric')]
    public $kilograms_per_bag;
    #[Rule('nullable|numeric')]

    public $standard_days;
    public function mount($id)
    {
        $this->listDate = date('Y-m-d');
        $this->addDate = date('Y-m-d');
        $this->material = Material::findOrfail(decrypt($id));
        $this->headers =
    }
    #[On('save')]
    public function save()
    {
        $this->validate();
        $created = WeeklyOrder::create([
            'material_id' => $this->material->id,
            'date' => $this->addDate,
            'price_per_kgs' => $this->price_per_kg,
            'inv_cost' => $this->inventory_cost,
            'kgs_per_bag' => $this->kilograms_per_bag,
            'standard_days' => $this->standard_days,
        ]);
        if($created) session()->flash('success', 'Material of '.$this->material->material_name.' successfully updated');
        else session()->flash('error', 'Record Error Saved');
        
        $this->redirect(route('requisition.weekly-requisition-order', encrypt($this->material->id)));

    }
    public function render()
    {
        return view('livewire.requisition.weekly-requisition-edit');
    }
}
