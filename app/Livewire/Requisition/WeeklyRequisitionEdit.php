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
            ['key' => 'price_per_kgs', 'label' => 'Price per kgs' ],
            ['key' => 'inv_cost', 'label' => 'Inv. Cost' ],
            ['key' => 'kgs_per_bag', 'label' => 'Kgs. per bag' ],
            ['key' => 'begin_inv', 'label' => 'BEGIN INV. (Kilos)' ],
            ['key' => 'deliveries_today', 'label' => 'Deliveries Today' ],
            ['key' => 'deliveries_todate', 'label' => 'Deliveries Todate' ],
            ['key' => 'usage_today', 'label' => 'Usage Today' ],
            ['key' => 'usage_todate', 'label' => 'Usage Todate' ],
            ['key' => 'end_inv', 'label' => 'END INV (Kilos)' ],
            ['key' => 'end_inv_bags', 'label' => 'END INV (Bags)' ],
            ['key' => 'no_of_working', 'label' => 'No. of working days' ],
            ['key' => 'ave_usage_per_day', 'label' => 'Ave. usage  per day' ],
            ['key' => 'standard_days', 'label' => 'Standard Days' ],
            ['key' => 'no_days_stock', 'label' => 'no. of days stock' ],
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
