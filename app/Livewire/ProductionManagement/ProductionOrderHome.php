<?php

namespace App\Livewire\ProductionManagement;

use Livewire\Component;
use App\Models\Downtime;
use App\Models\FeedType;
use App\Models\Production;
use App\Traits\BfcFunction;
use Livewire\Attributes\On;
use App\Models\QualityAssurance;

class ProductionOrderHome extends Component
{
    use BfcFunction;
    // General Inputs
    public $listDate;
    public $addDate;
    public $totalHoursOperated;
    public $targetTonsHours;
    public $noOfManpower;
    public $prodTarget;
    public $remarks;

    public $feedTypes;
    public $production;
    public $QA;
    public $downtime;

    public $headers = [];

    protected $rules = [
        'addDate' => 'required|date_format:Y-m-d',
        'targetTonsHours' => 'required|numeric',
        'totalHoursOperated' => 'required|numeric',
        'noOfManpower' => 'required|numeric',
        'prodTarget' => 'required|numeric',
        'production.*.feed_type' => 'required',
        'production.*.tons_produced' => 'required|numeric',
        'production.*.runtime_start' => 'required|regex:/(\d+\:\d+)/',
        'production.*.runtime_end' => 'required|regex:/(\d+\:\d+)/',
        'production.*.downtime_start' => 'required|regex:/(\d+\:\d+)/',
        'production.*.downtime_end' => 'required|regex:/(\d+\:\d+)/',
        'production.*.qa_result' => 'nullable',
        'production.*.dt_category' => 'nullable',
        'remarks' => 'nullable',
    ];
    protected $messages = [
        'required' => 'This field is required',
        'numeric' => 'This field must be numeric',
        'date_format' => 'Invalid date',
        'regex' => 'Invalid time',
    ];
    public function mount()
    {
        $this->listDate = date('Y-m-d');
        $this->addDate = date('Y-m-d');
        $this->feedTypes = FeedType::where('active_status', 1)->get();
        $this->downtime = Downtime::where('active_status', 1)->get();
        $this->QA = QualityAssurance::where('active_status', 1)->get();
        $this->headers = [
            ['label' => 'Feed Type', 'key' => 'feedType.feed_type_name'],
            ['label' => 'Total Hours Operated', 'key' => 'total_hours_operated'],
            ['label' => 'Number of Manpower', 'key' => 'no_of_manpower'],
        ];
        $this->production = collect(['prod1' => []]);
    }
    public function removeItem(string $id)
    {
        $this->production->forget(decrypt($id));
    }
    public function addItem()
    {
        $this->production->put($this->addItemKey($this->production, 'prod'), []);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    #[On('add')]
    public function add()
    {
        $this->validate();
        foreach ($this->production as $key => $value) {
            Production::create([
                'date' => $this->addDate,
                'feed_type_id' => $value['feed_type'],
                'runtime_start' => $value['runtime_start'],
                'runtime_end' => $value['runtime_end'],
                'tons_produced' => $value['tons_produced'],
                'target_tons_hour' => $this->targetTonsHours,
                'prod_target_tons' => $this->prodTarget,
                'quality_assurance_id' => $value['qa_result'] ?? null,
                'downtime_id' => $value['dt_category'] ?? null,
                'downtime_start' => $value['downtime_start'],
                'downtime_end' => $value['downtime_end'],
                'total_hours_operated' => $this->totalHoursOperated,
                'no_of_manpower' => $this->noOfManpower,
                'remarks' => $this->remarks ?? null,
            ]);
        }
        session()->flash('success', 'Production Successfully Added');
        $this->redirect(route('production-management.production-order-home'));
    }
    public function render()
    {
        return view('livewire.production-management.production-order-home', [
            'listProd' => Production::whereDate('date', $this->listDate)->distinct('feed_type_id')->get(),
        ]);
    }
}
