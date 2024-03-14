<?php

namespace App\Livewire\ProductionManagement;

use App\Models\Downtime;
use Livewire\Component;
use App\Models\FeedType;
use App\Models\QualityAssurance;
use Livewire\Attributes\Rule;

class ProductionOrderHome extends Component
{
    public $listDate;
    public $addDate;
    public $targetTonsHours;
    public $prodTarget;
    public $feedTypes;
    public $production;
    public $QA;
    public $downtime;

    protected $rules = [
        'addDate' => 'required|date_format:Y-m-d',
        'targetTonsHours' => 'required|numeric',
        'prodTarget' => 'required|numeric',
    ];
    protected $messages = [
        'required' => 'This field is required',
        'numeric' => 'This field must be numeric',
        'date_format' => 'Invalid date',
    ];
    public function mount()
    {
        $this->listDate = date('Y-m-d');
        $this->addDate = date('Y-m-d');
        $this->feedTypes = FeedType::where('active_status', 1)->get();
        $this->downtime = Downtime::where('active_status', 1)->get();
        $this->QA = QualityAssurance::where('active_status', 1)->get();
        $this->production = collect(['prod1' => []]);
    }
    public function render()
    {
        return view('livewire.production-management.production-order-home');
    }
}
