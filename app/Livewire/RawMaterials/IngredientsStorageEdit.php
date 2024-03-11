<?php

namespace App\Livewire\RawMaterials;

use App\Models\Farm;
use Livewire\Component;
use App\Models\FeedType;
use App\Models\Ingredient;
use App\Models\Material;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class IngredientsStorageEdit extends Component
{


    public $ingridientsheaders;

    public $material;
    public $inv_date;

    public $ingredents;

    public $farms;

    protected $rules = [
        'ingredents.*.farm_id' => 'required',
        'ingredents.*.feed_types.*.id' => 'required',
        'ingredents.*.feed_types.*.standard' => 'numeric',
        'ingredents.*.feed_types.*.batch' => 'numeric',
        'ingredents.*.feed_types.*.adjusment' => 'numeric',
        'inv_date' => 'required',
    ];
    protected $messages = [
        'ingredents.*.farm_id.required' => 'The Farm is required',
        'numeric' => 'This value must be a number',
        'inv_date' => 'Date is required',
    ];

    #[On('save')]
    public function save()
    {
        $this->validate();
        dd($this->ingredents);
        foreach ($this->ingredents as $key => $item) {
            foreach ($item['feed_types'] as $feedkey => $feed) {
                $created = Ingredient::create([
                    'material_id' => $this->material->id,
                    'feed_type_id' => decrypt($feed['id']),
                    'standard' => $feed['standard'] ?? 0,
                    'batch' => $feed['batch'] ?? 0,
                    'adjustment' => $feed['adjustment'] ?? 0,
                    'date' => $this->inv_date,

                ]);
                    
            }
        }
        session()->flash('success', 'Ingredients Stored Successfully');
        $this->redirect(route('raw-materials.ingredients-storage-home', $this->material->id));
        dd($this->ingredents);
    }

    public function mount(string $id)
    {
        $this->material = Material::findOrfail(decrypt($id));
        $this->farms = Farm::where('active_status', 1)->get();
        $this->ingredents = collect(['item1' => []]);
        $this->inv_date = date('Y-m-d');
        $this->ingridientsheaders = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'material_name', 'label' => 'Ingridients', 'class' => 'text-neutral'],
            ['key' => 'category', 'label' => 'Price', 'class' => 'text-neutral'],
        ];
    }

    public function updated($propertyName)
    {
        $this->ingredents = $this->ingredents->map(function (array $item, string $key) {
            if(isset($item['farm_id']) && !empty($item['farm_id'])) {
                $farm = Farm::find($item['farm_id']);
                foreach($farm->feedTypes ?? [] as $key => $feedType){
                    $item['feed_types']['ft'.$key+1]['id'] = encrypt($feedType->feed_type_name);
                    $item['feed_types']['ft'.$key+1]['name'] = $feedType->feed_type_name;
                }
            }
            return $item;
        });
        $this->validateOnly($propertyName);
    }
    public function removeItem(string $id)
    {
        $this->ingredents->forget(decrypt($id));
    }
    public function addItem()
    {
        $lastIndex = 1;
        while(true){
            if(!in_array('item'.$lastIndex, $this->ingredents->keys()->toArray())){
                $this->ingredents->put('item'.$lastIndex, []);
                break;
            }  
            else $lastIndex ++;
        }
    }
    public function render()
    {
        return view('livewire.raw-materials.ingredients-storage-edit');
    }
}
