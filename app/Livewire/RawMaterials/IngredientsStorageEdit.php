<?php

namespace App\Livewire\RawMaterials;

use App\Models\Farm;
use App\Models\FeedType;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IngredientsStorageEdit extends Component
{

    public $inv_date;

    public $ingredents;

    public $farms;

    protected $rules = [
        'ingredents.*.farm_id' => 'required',
        'inv_date' => 'required',
    ];
    protected $messages = [
        'ingredents.*.farm_id' => 'Farm is required',
        'inv_date' => 'Date is required',
    ];

    
    public function save()
    {
        dd($this->ingredents);
    }
    public function mount()
    {
        $this->farms = Farm::where('active_status', 1)->get();
        $this->ingredents =  collect(['item1' => []]);
    }

    public function updated($propertyName)
    {
        $this->ingredents = $this->ingredents->map(function (array $item, string $key) {
            $item['farm_name'] = FeedType::find($item['feed_type_id'])->farm->farm_name ?? '';
            return $item;
        });
        $this->validateOnly($propertyName);
    }
    public function removeItem(string $key)
    {
        $this->ingredents->forget(decrypt($key));
    }
    public function addItem()
    {
        $lastIndex = count($this->ingredents)+1;
        $this->ingredents->put('item'.$lastIndex, []);
    }
    public function render()
    {
        return view('livewire.raw-materials.ingredients-storage-edit');
    }
}
