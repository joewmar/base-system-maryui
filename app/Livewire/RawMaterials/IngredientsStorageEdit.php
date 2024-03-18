<?php

namespace App\Livewire\RawMaterials;

use App\Models\Farm;
use Livewire\Component;
use App\Models\FeedType;
use App\Models\Material;
use App\Models\Ingredient;
use App\Traits\BfcFunction;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class IngredientsStorageEdit extends Component
{

    use BfcFunction;
    public array $expanded = [];

    public $ingredientHeaders;

    public bool $haveRecord = false;
    public $material;
    public $invDate;

    public $ingredents;
    public $farmHeaders;

    // For Table
    public $listDate;

    public $farms;

    protected $rules = [
        'ingredents.*.farm_id' => 'required',
        'ingredents.*.feed_types.*.id' => 'required',
        'ingredents.*.feed_types.*.standard' => 'numeric',
        'ingredents.*.feed_types.*.batch' => 'numeric',
        'ingredents.*.feed_types.*.adjusment' => 'numeric',
        'invDate' => 'required',
    ];
    protected $messages = [
        'ingredents.*.farm_id.required' => 'The Farm is required',
        'numeric' => 'This value must be a number',
        'invDate' => 'Date is required',
    ];

    #[On('save')]
    public function save()
    {
        $this->validate();
        dd($this->ingredents);
        foreach ($this->ingredents as $key => $item) {
            foreach ($item['feed_types'] as $feed) {
                Ingredient::create(
                    [
                        'material_id' => $this->material->id,
                        'feed_type_id' => decrypt($feed['id']),
                        'standard' => $feed['standard'] ?? 0,
                        'batch' => $feed['batch'] ?? 0,
                        'adjustment' => $feed['adjustment'] ?? 0,
                        'date' => $this->invDate,
                    ]
                );       
            }
        }
        session()->flash('success', 'Ingredients Stored Successfully');
        $this->redirect(route('raw-materials.ingredients-storage.edit', encrypt($this->material->id)));
    }
    public function updatedListDate()
    {
        $materials = Ingredient::where('material_id', $this->material->id)->whereDate('date', $this->listDate)->where('active_status', 1)->get();
        if(!$materials->isEmpty()) $this->haveRecord = true;
        else $this->haveRecord = false;    
    }
    public function mount(string $id)
    {
        $this->material = Material::findOrfail(decrypt($id));
        $this->farms = Farm::where('active_status', 1)->get();
        $this->ingredents = collect(['item1' => []]);
        $this->invDate = date('Y-m-d');
        $this->ingredientHeaders = [
            ['key' => 'feedType.feed_type_name', 'label' => 'Feed Type' ],
            ['key' => 'standard', 'label' => 'Standard' ],
            ['key' => 'batch', 'label' => 'Batch' ],
            ['key' => 'adjustment', 'label' => 'Adjustment' ],
        ];
        $this->listDate = date('Y-m-d');
        $this->updatedListDate();

    }
    public function updatedIngredents()
    {
        $this->ingredents = $this->ingredents->map(function (array $item, string $key) {
            if(isset($item['farm_id']) && !empty($item['farm_id'])) {
                $farm = Farm::find($item['farm_id']);
                foreach($farm->feedTypes ?? [] as $key => $feedType){
                    $item['feed_types']['ft'.$key+1]['id'] = encrypt($feedType->id);
                    $item['feed_types']['ft'.$key+1]['name'] = $feedType->feed_type_name;
                }
            }
            return $item;
        });
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function removeItem(string $id)
    {
        $this->ingredents->forget(decrypt($id));
    }
    public function addItem()
    {
        $this->ingredents->put($this->addItemKey($this->ingredents, 'item'), []);
    }
    public function render()
    {
        return view('livewire.raw-materials.ingredients-storage-edit', [
            'ingredentList' => Ingredient::where('material_id', $this->material->id)->where('date', $this->listDate)->get(),
        ]);
    }
}
