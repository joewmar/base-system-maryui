<?php

namespace App\Livewire\RawMaterials;

use Livewire\Component;
use Livewire\Attributes\Rule;

class IngredientsStorageEdit extends Component
{

    #[Rule('Required')]
    public $Calendar;

    public function render()
    {
        return view('livewire.raw-materials.ingredients-storage-edit');
    }
}
