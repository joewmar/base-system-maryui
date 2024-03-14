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

    // for add modal
    #[Rule('required|unique:quality_assurances,description')]
    public $description;
    #[Rule('required|unique:quality_assurances,code')]
    public $code;
    public bool $addModal = false;

    // for edit modal
    #[Rule('required')]
    public $editdescription;
    #[Rule('required')]
    public $editcode;
    public $qa_id;
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
        $this->validate([
            'description' => 'required|unique:quality_assurances,description',
            'code' => 'required|unique:quality_assurances,code',
        ]);
        QualityAssurance::create([
            'description' => $this->description,
            'code' => $this->code,
        ]);

        session()->flash('success', 'QualityAssurance successfully added');
        $this->redirect(route('record-management.quality-assurance-home'));
    }

    public function edit(string $id)
    {
        if($this->editModal){
            $qualityassurance = QualityAssurance::findOrFail(decrypt($id));
            $this->editdescription = $qualityassurance->description;
            $this->editcode = $qualityassurance->code;
            $this->qa_id = $id;
        }
    }
    #[On('remove')] 
    public function remove(string $id)
    {
        $qualityAssurance = QualityAssurance::findOrfail(decrypt($id));
        $qualityAssurance->active_status = 0;
        $qualityAssurance->save();
        session()->flash('success', ' qualityAssurance'.$qualityAssurance->description.' Successfully Deleted');
        $this->redirect(route('record-management.quality-assurance-home',));
    }

    #[On('save')]
    public function save(string $id)
    {
        $this->validate([
            'editdescription' => 'required',
        ]);
        $description = QualityAssurance::findOrFail(decrypt($id));

        $description->update([
            'description' => $this->editdescription,
        ]);
        session()->flash('success', 'QualityAssurance Updated Successfully');
        $this->redirect(route('record-management.quality-assurance-home'));
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
