@section('title') Materials Storage @endsection
@include('partials.edit-modal')
@include('partials.create-modal')
@include('partials.delete-modal')
<div class="h-fit m-5">

    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="" />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Materials Storage</h3>
    </div>

    {{-- Search and Add Button --}}
    <div class="flex justify-between items-center my-5 p-3 ">
        <div><x-input label="Search" inline icon="o-magnifying-glass" type="search" wire:model.live="search" /></div>
        <div>
            <x-button icon="o-plus" label="Add" @click="$wire.addModal = true" class="btn-primary" />
        </div>
    </div>

    <div class="pt-5">
        <x-radio :options="[['key' => '', 'label' => 'All'], ['key' => 'macro', 'label' => 'Macro'], ['key' => 'micro', 'label' => 'Micro'], ['key' => 'medicine', 'label' => 'Medicine']]" option-value="key" option-label="label" wire:model.live="filterCategory" />

            {{-- Table --}}
            <x-table :headers="$headers" :rows="$materials" striped with-pagination >
                @scope('cell_material_name', $material_name)
                    {{ Str::upper($material_name->material_name) }}
                @endscope
                @scope('cell_category', $category)
                    {{ Str::upper($category->category) }}
                @endscope
                @scope('actions', $material)
                    <div class="flex justify-around w-full space-x-2">
                        <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" @click="$wire.editModal = true; $wire.edit('{{encrypt($material->id)}}')" />
                        <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($material->id)}}', '{{$material->material_name}}')" />
                    </div>
                @endscope
            </x-table>

    </div>
    {{-- Add Modal --}}
    <x-modal wire:model="addModal" title="Add Material" separator>
        <div class="space-y-3">
            <x-input label="Material" wire:model.live='materialName' inline />
            <x-select label="Category" icon="o-user" option-value="key" option-label="label" placeholder="Select Category" placeholder-value="" inline :options="[['key' => 'macro', 'label' => 'Macro'], ['key' => 'micro', 'label' => 'Micro'], ['key' => 'medicine', 'label' => 'Medicine']]" wire:model.live="category" />
        </div>
        <x-slot:actions>
            <div>
                <x-button label="Add" class="btn-primary" onclick="createModal('add', 'Do you want to add this material', 'add')" />
                <x-button label="Cancel" @click="$wire.addModal = false" />
            </div>
        </x-slot:actions>
    </x-modal>
    {{-- Edit Modal --}}
    <x-modal wire:model="editModal" title="{{$editMatRefName}}" separator persistent >
        <div class="space-y-3">
            <x-process-dialog target="editModal" />

            <x-input label="Material" wire:model.live='editMaterialName' inline />
            <x-select label="Category" icon="o-user" option-value="key" option-label="label" placeholder="Select Category" placeholder-value="" inline :options="[['key' => 'macro', 'label' => 'Macro'], ['key' => 'micro', 'label' => 'Micro'], ['key' => 'medicine', 'label' => 'Medicine']]" wire:model.live="editCategory" />
        </div>
        <x-slot:actions>
            <x-button label="Save" class="btn-primary" onclick="editModal('{{$editMaterialID}}')" />
            <x-button label="Cancel" @click="$wire.editModal = false" />
        </x-slot:actions>
    </x-modal>

    {{-- Delete Modal --}}
    {{-- @include('partials.cancel-modal') --}}
</div>