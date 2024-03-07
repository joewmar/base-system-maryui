<?php

namespace App\Livewire\RecordManagement;

use Livewire\Component;
use App\Models\FeedType;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class FeedTypeHome extends Component
{
    public $headers;
    public $feedTypes;

    public bool $addModal = false;
    #[Rule('required|unique:feed_types,feed_type_name')]
    public $feedtype;

    public function mount()
    {
        $this->feedTypes = DB::table('feed_types')->where('active_status', 1)->get();
        $this->headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'text-neutral'],
            ['key' => 'feed_type_name', 'label' => 'Feed Type', 'class' => 'text-neutral'],
        ];
    }

    public function add()
    {
        // $this->dispatch('success', ['message' => 'Record Added']);

        session()->flash('error', 'Record Error Saved');
        $this->redirect(route('raw-materials.feed-type-home'));

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
