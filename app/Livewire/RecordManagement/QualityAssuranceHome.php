<?php

namespace App\Livewire\RecordManagement;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use App\Models\QualityAssurance;
use Illuminate\Support\Facades\DB;

class QualityAssuranceHome extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'description', 'direction' => 'asc'];

    #[Url]
    public $search ;

    // Table
    public $headers;
    #[Rule('required')]

    // for add modal
    #[Rule('required|unique:quality_assurances,description')]
    public $description;
    #[Rule('required|unique:quality_assurances,code')]
    public $code;
    public bool $addModal = false;

    // for edit modal
    #[Rule('required|unique:quality_assurances,description')]
    public $editdescription;
    #[Rule('required|unique:quality_assurances,code')]
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
        $this->redirect(route('record-management.quality-assurance-home'));

    }
    #[On('remove')] 
    public function remove(string $id)
    {
        $qualityAssurance = QualityAssurance::findOrfail(decrypt($id));
        $qualityAssurance->active_status = 0;
        $qualityAssurance->save();
        session()->flash('success', ' qualityAssurance'.$qualityAssurance->description.' Successfully Deleted');
        $this->redirect(route('raw-materials.material-storage-home',));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.record-management.quality-assurance-home', ['qualityAssurances' => DB::table('quality_assurances')->where('active_status', 1)->where('description', 'like', '%' . $this->search . '%')->orderBy(...array_values($this->sortBy))->paginate(5)]);
    }
}
