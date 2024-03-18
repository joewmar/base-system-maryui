<?php

namespace App\Livewire\RawMaterials;

use App\Models\Farm;
use Livewire\Component;
use App\Models\Material;
use App\Models\Ingredient;
use App\Traits\BfcFunction;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

class IngredientsStorageEditInv extends Component
{
    use BfcFunction;
    public $material;
    public Collection $ingredients;
    public $prevItems;
    public $farms;
    public $matID;
    public $editDate;
    public $updateDate;
    
    protected $rules = [
        'ingredients.*.farm_id' => 'required',
        'ingredients.*.feed_types.*.id' => 'required',
        'ingredients.*.feed_types.*.standard' => 'numeric',
        'ingredients.*.feed_types.*.batch' => 'numeric',
        'ingredients.*.feed_types.*.adjusment' => 'numeric',
        'updateDate' => 'required|date',
    ];
    protected $messages = [
        'ingredients.*.farm_id.required' => 'The Farm is required',
        'numeric' => 'This value must be a number',
        'invDate' => 'Date is required',
    ];

    public function mount($id, $date)
    {
        $this->editDate = $date;           
        $this->updateDate = $date;           
        $this->material  = Material::findOrfail(decrypt($id));
        $this->prevItems = $this->material->ingredients()->whereDate('date', $date)->where('active_status', 1)->get();
        $this->farms  = Farm::where('active_status', 1)->get();
        if($this->prevItems->isEmpty()) abort(404);
        $prev_farm_id = null;
        $count = 1;
        $saveIng = collect([]); 
        foreach($this->prevItems as $key => $ingredient){
            $item['farm_id'] = $ingredient->feedType->farm->id;                
            $item['feed_types']['ft'.$key+1]['id'] = encrypt($ingredient->feedType->id);
            $item['feed_types']['ft'.$key+1]['name'] = $ingredient->feedType->feed_type_name;
            $item['feed_types']['ft'.$key+1]['standard'] = $ingredient->standard;
            $item['feed_types']['ft'.$key+1]['adjusment'] = $ingredient->adjustment;
            $item['feed_types']['ft'.$key+1]['batch'] = $ingredient->batch;
            if($ingredient->feedType->farm->id != $prev_farm_id){
                $saveIng->put('item'.($count), $item);
                $prev_farm_id = $item['farm_id'];
                $count++;
            }
        }
        $this->ingredients = $saveIng;
        unset($saveIng, $prev_farm_id, $count);
        // dd($this->ingredients);
    }
    public function updatedingredients()
    {
        $this->ingredients = $this->ingredients->map(function (array $item, string $key) {
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
        $this->ingredients->forget(decrypt($id));
    }
    public function addItem()
    {
        $this->ingredients->put($this->addItemKey($this->ingredients, 'item'), []);
    }
    #[On('save')]
    public function save()
    {
        $this->validate();
        // dd($this->ingredients);
        foreach ($this->ingredients as $key => $item) {
            foreach ($item['feed_types'] as $feed) {
                $update = Ingredient::where('material_id', $this->material->id)->where('feed_type_id', decrypt($feed['id']))->where('date', $this->updateDate)->first();
                if($update){
                    $update->standard = $feed['standard'] ?? 0;
                    $update->batch = $feed['batch'] ?? 0;
                    $update->adjustment = $feed['adjustment'] ?? 0;
                    $update->date = $this->updateDate;
                    $update->save();
                
                }
                else{
                    Ingredient::create([
                        'material_id' => $this->material->id,
                        'feed_type_id' => decrypt($feed['id']),
                        'standard' => $feed['standard'] ?? 0,
                        'batch' => $feed['batch'] ?? 0,
                        'adjustment' => $feed['adjustment'] ?? 0,
                        'date' => $this->updateDate,
                    ]);
                }
            }
        }
        session()->flash('success', 'Ingredients Updated Successfully');
        $this->redirect(route('raw-materials.ingredients-storage.edit', encrypt($this->material->id)));
    }

    public function render()
    {
        return view('livewire.raw-materials.ingredients-storage-edit-inv');
    }
}
