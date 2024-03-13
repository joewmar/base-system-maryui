<?php

namespace App\Livewire\Requisition;

use App\Models\Material;
use Livewire\Component;
use App\Models\WeeklyOrder;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class WeeklyRequisitionCreate extends Component
{
      // Add Requisition
      #[Rule('required|date')]
      public $addDate;
      #[Rule('required|numeric')]
      public $no_of_working;

      public $materials;

      public array $inventories;

      protected $rules = [
          'addDate' => 'required|date',
          'no_of_working' => 'required|numeric|same',
          'inventories.*.material_id' => 'required',
          'inventories.*.price_per_kilograms' => 'required|numeric',
          'inventories.*.inventory_cost' => 'required|numeric',
          'inventories.*.kilograms_per_bag' => 'required|numeric',
          'inventories.*.standard_days' => 'nullable|numeric',
          'inventories.*.deliveries_today' => 'nullable|numeric',
          
      ];
      protected $messages = [
          'required' => 'Required',
          'numeric' => 'This field must be numeric',
      ];

      public function mount()
      {
          $this->addDate = date('Y-m-d');
          $this->inventories = ['mat1' => []];
          $this->materials = Material::all();
      }
      public function updated($propertyName)
      {
        $this->validateOnly($propertyName);
      }
      public function removeItem(string $id)
      {
        unset($this->inventories[decrypt($id)]);
      }
      public function updatedMaterials()
      {
        
      }
      public function addItem()
      {
          $lastIndex = 1;
          while(true){
              if(!in_array('mat'.$lastIndex, array_keys($this->inventories))) {
                  $this->inventories['mat'.$lastIndex] = [];
                  break;
              }  
              else $lastIndex ++;
          }
      }
      #[On('add')]
      public function add()
      {
          $this->validate();
          foreach($this->inventories as $inventory){
                WeeklyOrder::create([
                    'material_id' => $inventory['material_id'],
                    'price_per_kgs' => $inventory['price_per_kilograms'],
                    'inv_cost' => $inventory['inventory_cost'],
                    'kgs_per_bag' => $inventory['kilograms_per_bag'],
                    'deliveries_today' => $inventory['deliveries_today'] ?? 0,
                    'standard_days' => $inventory['standard_days'],
                    'no_of_working'=>$this->no_of_working,
                    'date' => $this->addDate
                ]);
          }
          session()->flash('success', 'New Inventory successfully added');          
          $this->redirect(route('requisition.weekly-requisition-home'));

      }
    public function render()
    {
        return view('livewire.requisition.weekly-requisition-create');
    }
}
