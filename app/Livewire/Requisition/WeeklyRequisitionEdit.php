<?php

namespace App\Livewire\Requisition;

use App\Models\Ingredient;
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


    public function mount($id)
    {
        $this->material = Material::findOrFail(decrypt($id));
        $this->listDate = date('Y-m-d');
        $this->headers = [
            ['key' => 'price_per_kgs', 'label' => 'Price per kgs', 'class' => 'text-neutral'],
            ['key' => 'inv_cost', 'label' => 'Inv. Cost', 'class' => 'text-neutral'],
            ['key' => 'kgs_per_bag', 'label' => 'Kgs. per bag', 'class' => 'text-neutral'],
            ['key' => 'begin_inv', 'label' => 'BEGIN INV. (Kilos)', 'class' => 'text-neutral'],
            ['key' => 'deliveries_today', 'label' => 'Deliveries Today', 'class' => 'text-neutral'],
            ['key' => 'deliveries_todate', 'label' => 'Deliveries Todate', 'class' => 'text-neutral'],
            ['key' => 'usage_today', 'label' => 'Usage Today', 'class' => 'text-neutral'],
            ['key' => 'usage_todate', 'label' => 'Usage Todate', 'class' => 'text-neutral'],
            ['key' => 'end_inv', 'label' => 'END INV (Kilos)', 'class' => 'text-neutral'],
            ['key' => 'end_inv_bags', 'label' => 'END INV (Bags)', 'class' => 'text-neutral'],
            ['key' => 'no_of_working', 'label' => 'No. of working days', 'class' => 'text-neutral'],
            // ['key' => 'name', 'label' => 'Ave. usage  per day', 'class' => 'text-neutral'],
            ['key' => 'standard_days', 'label' => 'Standard Days', 'class' => 'text-neutral'],
            // ['key' => 'name', 'label' => 'no. of days stock', 'class' => 'text-neutral'],
        ];
    }
    public function render()
    {
        // dd(Ingredient::all()->first()->grandTotal());
        return view('livewire.requisition.weekly-requisition-edit', [
            'orders' => WeeklyOrder::where('material_id', $this->material->id)->where('active_status', 1)->whereDate('date', $this->listDate)->get(),
        ]);
    }
}
