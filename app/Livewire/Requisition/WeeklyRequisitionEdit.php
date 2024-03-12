<?php

namespace App\Livewire\Requisition;

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

    public function render()
    {
        return view('livewire.requisition.weekly-requisition-edit');
    }
}
