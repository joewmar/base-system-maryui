<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class WeeklyRequisitionHome extends Component
{

    use WithPagination;
    public array $sortBy = ['column' => 'material_name', 'direction' => 'asc'];

    public $search;
    #[Rule('required')]
    public $headers;
    #[Rule('required')]
    public $name;
    #[Rule('required')]
    public $price_per_kg;
    #[Rule('required')]
    public $inventory_cost;
    #[Rule('required')]
    public $kilograms_per_bag;
    #[Rule('required')]
    public $standard_days;


    // public $requisitions;
    public $weekheaders;


    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'material_name', 'label' => 'Materials', 'class' => 'text-neutral'],
            ['key' => 'category', 'label' => 'Category', 'class' => 'text-neutral'],
        ];
        $this->weekheaders = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'material_name', 'label' => 'Requisition Materials', 'class' => 'text-neutral'],
            ['key' => 'category', 'label' => 'Price', 'class' => 'text-neutral'],
        ];
    }
    public function render()
    {
        return view('livewire.requisition.weekly-requisition-home', ['weeklyOrders' => DB::table('materials')->where('active_status', 1)->where('material_name', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
