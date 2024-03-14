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
    public $headers;
    public $filterCategory = '';

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#' ],
            ['key' => 'material_name', 'label' => 'Materials' ],
            ['key' => 'category', 'label' => 'Category' ],
        ];

    }
    public function render()
    {
        return view('livewire.requisition.weekly-requisition-home', ['weeklyOrders' => DB::table('materials')->where('active_status', 1)->where('material_name', 'like', '%' . $this->search . '%')->where('category', 'like', '%' . $this->filterCategory . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
