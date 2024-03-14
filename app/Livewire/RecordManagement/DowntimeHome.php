<?php

namespace App\Livewire\RecordManagement;

use Livewire\Component;
use App\Models\Downtime;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class DowntimeHome extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'description', 'direction' => 'asc'];

    #[Url]
    public $search;

    // table
    public $headers;


    // for add modal
    #[Rule('required|unique:downtimes,description')]
    public $description;
    #[Rule('required|unique:downtimes,code')]
    public $code;
    public bool $addModal = false;

    // for edit modal
    #[Rule('required|unique:downtimes,description')]
    public $editdescription;
    #[Rule('required|unique:downtimes,code')]
    public $editcode;
    public $downtime_id;
    public bool $editModal = false;

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#' ],
            ['key' => 'description', 'label' => 'Description' ],
            ['key' => 'code', 'label' => 'Code' ],
        ];
    }

    
    #[On('add')]
    public function add()
    {
        $validatedData = $this->validate([
            'description' => 'required',
            'code' => 'required',
        ]);
        Downtime::create([
            'description' => $this->description,
            'code' => $this->code,
        ]);

        session()->flash('success', 'DownTime successfully added');
        $this->redirect(route('record-management.downtime-home'));

    }

    public function edit(string $id)
    {
        if($this->editModal){
            $downtime = Downtime::findOrFail(decrypt($id));
            $this->editdescription = $downtime->description;
            $this->editcode = $downtime->code;
            $this->downtime_id = $id;
        }
    }

    #[On('remove')] 
    public function remove(string $id)
    {
        $downTime = Downtime::findOrfail(decrypt($id));
        $downTime->active_status = 0;
        $downTime->save();
        session()->flash('success', ' downTime'.$downTime->description.' Successfully Deleted');
        $this->redirect(route('record-management.downtime-home',));
    }

    #[On('save')]
    public function save(string $id)
    {
        $this->validate([
            'editdescription' => 'required',
        ]);
        $description = Downtime::findOrFail(decrypt($id));

        $description->update([
            'description' => $this->editdescription,
        ]);
        session()->flash('success', 'DownTime Updated Successfully');
        $this->redirect(route('record-management.downtime-home'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.record-management.downtime-home', ['downTimes' => DB::table('downtimes')->where('active_status', 1)->where('description', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
