<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ElectricCost;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class ElectricCostHome extends Component
{

    use WithPagination;
    public array $sortBy = ['column' => 'electric_cost', 'direction' => 'asc'];

    #[Url]
    public $search ;
    public $headers;

    // for add modal
    #[Rule('required')]
    public $date;
    #[Rule('required')]
    public $electric_cost;
    public bool $addModal = false;

    // for edit modal
    #[Rule('required')]
    public $editdate;
    #[Rule('required')]
    public $editelectric_cost;
    public $electriccost_id;
    public bool $editModal = false;

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#' ],
            ['key' => 'date', 'label' => 'Month' ],
            ['key' => 'electric_cost', 'label' => 'Electric Cost' ],
        ];
    }


    #[On('add')]
    public function add()
    {
        $validatedData = $this->validate([
            'date' => 'required',
            'electric_cost' => 'required',
        ]);
        ElectricCost::create([
            'date' => $this->date . '-' . date('d'),
            'electric_cost' => $this->electric_cost,
        ]);

        session()->flash('success', 'Electric Cost Successfully Added');
        $this->redirect(route('reports.electric-cost.home'));

    }

    public function edit(string $id)
    {
        if($this->editModal){
            $electric_cost = ElectricCost::findOrFail(decrypt($id));
            $splitDate = explode('-', $electric_cost->date);
            $this->editdate = $splitDate[0] . '-' . $splitDate[1];
            $this->editelectric_cost = $electric_cost->electric_cost;
            $this->electriccost_id = $id;
        }
    }
    #[On('remove')] 
    public function remove(string $id)
    {
        $electric_cost = ElectricCost::findOrfail(decrypt($id));
        $electric_cost->active_status = 0;
        $electric_cost->save();
        session()->flash('success', ' Electric Cost '.$electric_cost->electric_cost.' Successfully Deleted');
        $this->redirect(route('reports.electric-cost.home'));
    }

    #[On('save')]
    public function save(string $id)
    {
        $this->validate([
            'editdate' => 'required',
        ]);
        $electric_cost = ElectricCost::findOrFail(decrypt($id));

        $electric_cost->update([
            'date' => $this->editdate . '-' . date('d'),
            'electric_cost' => $this->editelectric_cost, 
        ]);
        session()->flash('success', 'ElectricCost Updated Successfully');
        $this->redirect(route('reports.electric-cost.home'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $split = explode('-', $this->search);
        if (!empty($this->search)) $ElectricCosts = DB::table('electric_costs')->where('active_status', 1)->whereMonth('date', $split[1])->orderBy(...array_values($this->sortBy))->paginate(5);
        else $ElectricCosts = DB::table('electric_costs')->where('active_status', 1)->orderBy(...array_values($this->sortBy))->paginate(5);
        
        return view('livewire.reports.electric-cost-home', ['ElectricCosts' => $ElectricCosts]);
    }
}
