<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ElectricCost;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ElectricCostHome extends Component
{

    use WithPagination;
    public array $sortBy = ['column' => 'electric_cost', 'direction' => 'asc'];

    #[Url]
    public $search ;
    public $headers;


    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'date', 'label' => 'Month', 'class' => 'text-neutral'],
            ['key' => 'electric_cost', 'label' => 'Electric Cost', 'class' => 'text-neutral'],
        ];
    }

    public function add()
    {
        // $this->dispatch('success', ['message' => 'Record Added']);

        session()->flash('error', 'Record Error Saved');
        $this->redirect(route('reports.electric-cost-home'));

    }
    #[On('remove')] 
    public function remove(string $id)
    {
        $electric_cost = ElectricCost::findOrfail(decrypt($id));
        $electric_cost->active_status = 0;
        $electric_cost->save();
        session()->flash('success', ' Electric Cost '.$electric_cost->electric_cost.' Successfully Deleted');
        $this->redirect(route('reports.electric-cost-home'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.reports.electric-cost-home', ['ElectricCosts' => DB::table('electric_costs')->where('active_status', 1)->where('electric_cost', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
