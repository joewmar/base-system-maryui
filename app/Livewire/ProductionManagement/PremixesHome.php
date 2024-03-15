<?php

namespace App\Livewire\ProductionManagement;

use App\Models\Farm;
use Livewire\Component;
use App\Models\Premixes;
use App\Traits\BfcFunction;
use Livewire\Attributes\On;

class PremixesHome extends Component
{
    use BfcFunction;
    public $premixes;
    public $farms;
    public $addDate;
    public $listDate;
    public $premixesHeaders;

    protected $rules = [
        'premixes.*.farm_id' => 'required',
        'premixes.*.feed_types.*.beginning' => 'numeric',
        'premixes.*.feed_types.*.micro' => 'numeric',
        'premixes.*.feed_types.*.macro' => 'numeric',
        'premixes.*.feed_types.*.ending' => 'numeric',
        'addDate' => 'required|date_format:Y-m-d',
    ];
    protected $messages = [
        'addDate.required' => 'Date is required.',
        'required' => 'The field is required.',
        'numeric' => 'The field must be a number.',
    ];
    public function mount()
    {
        $this->farms = Farm::where('active_status', 1)->get();
        $this->premixes = collect(['pmx1' => []]);
        $this->addDate = date('Y-m-d');
        $this->premixesHeaders = [
            ['key' => 'feedType.feed_type_name', 'label' => 'Feed Type' ],
            ['key' => 'standard', 'label' => 'Standard' ],
            ['key' => 'batch', 'label' => 'Batch' ],
            ['key' => 'adjustment', 'label' => 'Adjustment' ],
        ];
        $this->listDate = date('Y-m-d');
    }
    public function updatedPremixes()
    {
        $this->premixes = $this->feedTypeFarm($this->premixes);
    }   
    public function removeItem(string $id)
    {
        $this->premixes->forget(decrypt($id));
    }
    public function addItem()
    {
        $this->premixes->put($this->addItemKey($this->premixes, 'pmx'), []);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    #[On('add')]
    public function add()
    {
        $this->validate();
        foreach ($this->premixes as $item) {
            foreach ($item['feed_types'] as $feed) {
                Premixes::create([
                    'date' => $this->addDate,
                    'feed_type_id' => decrypt($feed['id']),
                    'beginning' => $feed['beginning'],
                    'ending' => $feed['ending'],
                ]);
            }
        }
        session()->flash('success', 'Premixes Successfully Added');
        $this->redirect(route('production-management.premixes-home'));
    }
    public function render()
    {
        return view('livewire.production-management.premixes-home', [
            'premixesList' => Premixes::whereDate('date', $this->listDate)->where('active_status', 1)->get(),
        ]);
    }
}
