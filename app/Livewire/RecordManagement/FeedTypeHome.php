<?php

namespace App\Livewire\RecordManagement;

use App\Models\Farm;
use Livewire\Component;
use App\Models\FeedType;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as RL;

class FeedTypeHome extends Component
{
    public $headers;
    public $feedTypes;

    public bool $addModal = false;
    public bool $editModal = false;

    #[Rule('required')]
    public $feedtype;

    #[Rule('required')]
    public $farmID;

    // Edit Input Feed Type and Farm ID
    #[Rule('required')]
    public $editFeedtype;

    #[Rule('required')]
    public $editFarmID;

    //References For Modal
    public $editFTID;
    public $editFTRefName;

    public $farms;

    public function mount()
    {
        $this->farms = Farm::where('active_status', 1)->get()->toArray();
        $this->feedTypes = FeedType::where('active_status', 1)->get();
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'feed_type_name', 'label' => 'Feed Type', 'class' => 'text-neutral'],
            ['key' => 'farm.farm_name', 'label' => 'Farms', 'class' => 'text-neutral'],
        ];
    }
    public function edit(string $id)
    {
        if($this->editModal){
            $material = FeedType::findOrfail(decrypt($id));
            $this->editFeedtype = $material->feed_type_name;
            $this->editFarmID = $material->farm_id;
            $this->editFTRefName = $material->feed_type_name;;
            $this->editFTID = $id;
        }
    }
    #[On('save')]
    public function save(string $id)
    {
        $this->validate([
            'editFeedtype' => 'required',
            'editFarmID' => 'required'
        ]);
        $feedType = FeedType::findOrfail(decrypt($id));
        if($feedType){
            $feedType->feed_type_name = $this->editFeedtype;
            $feedType->farm_id = $this->editFarmID;
            $feedType->save();
            session()->flash('success', 'Feed Type of '.$feedType->feed_type_name.' successfully updated');
            $this->redirect(route('record-management.feed-type-home'));
        }
    }
    #[On('add')]
    public function add()
    {
        // $this->dispatch('success', ['message' => 'Record Added']);
        $this->validate([
            'feedtype' => ['required', RL::when($this->farmID, 'unique:feed_types,feed_type_name,farm_id', 'unique:feed_types,feed_type_name', 'nullable')],
            'farmID' => ['required'],
        ]);
        $feedType = FeedType::create([
            'feed_type_name' => $this->feedtype,
            'farm_id' => $this->farmID,
        ]);
        if($feedType){
            session()->flash('success', 'Feed Type successfully added');
            $this->redirect(route('record-management.feed-type-home'));
        }
    }
    #[On('remove')] 
    public function remove(string $id)
    {
        $feedTypes = FeedType::findOrfail(decrypt($id));
        $feedTypes->active_status = 0;
        $feedTypes->save();
        session()->flash('success', ' Feed Type '.$feedTypes->feed_type_name.' Successfully Deleted');
        $this->redirect(route('record-management.feed-type-home',));
    }
    public function render()
    {
        return view('livewire.record-management.feed-type-home');
    }
}
