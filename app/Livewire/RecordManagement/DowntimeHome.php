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
    public bool $editModal = false;

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'description', 'label' => 'Description', 'class' => 'text-neutral'],
            ['key' => 'code', 'label' => 'Code', 'class' => 'text-neutral'],
        ];
    }

    

    public function add()
    {
        // $this->dispatch('success', ['message' => 'Record Added']);

        session()->flash('error', 'Record Error Saved');
        $this->redirect(route('record-management.downtime-home'));

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

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.record-management.downtime-home', ['downTimes' => DB::table('downtimes')->where('active_status', 1)->where('description', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
