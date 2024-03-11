@section('title') Farm @endsection
@include('partials.create-modal')
@include('partials.edit-modal')

<div class="h-fit m-5">
<div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center">
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Farm</h3>
    </div>

    {{-- Search and Add Button --}}
    <div class="w-full mb-3 flex justify-between items-center">
        <div><x-input label="Search" wire:model.live="search" inline icon="o-magnifying-glass" type="search" class="input-sm" /></div>
        <div>
            <x-button icon="o-plus" label="Add" @click="$wire.addModal = true" class="btn-primary" />
        </div>
    </div>
    {{-- Table --}}
    <div class="h-full p-3">
    <x-table :headers="$headers" :rows="$farms" :sort-by="$sortBy" selectable with-pagination   >
        @scope('actions', $farm)
            <div class="flex justify-around w-full space-x-2">
                <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" @click="$wire.editModal = true; $wire.edit('{{encrypt($farm->id)}}')" />
                <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($farm->id)}}', '{{$farm->farm_name}}')" />
            </div>
        @endscope
    </x-table>
    </div> 
    {{-- Add Modal --}}
    <x-modal wire:model="addModal" title="Add Farm" separator>
        <div class="space-y-3">
            <x-input label="Farm Name" wire:model.live='farm_name' inline />
        </div>
        <x-slot:actions>
            <div>
                <x-button label="Add" class="btn-primary" onclick="createModal('add', 'Do you want to add this material', 'add')" />
                <x-button label="Cancel" @click="$wire.addModal = false" />
            </div>
        </x-slot:actions>
    </x-modal> 
    {{-- Edit Modal --}}
    <x-modal wire:model="editModal" title="{{$edit_farm_ref}}" separator persistent >
        <div class="space-y-3">
            <x-input label="Farm Name" inline wire:model.live="edit_farm_name"  />
        </div>
        <x-process-dialog target="editModal" />

        <x-slot:actions>
            <x-button label="Yes" class="btn-primary" onclick="editModal('{{$edit_farm_id}}')" />
            <x-button label="No" @click="$wire.editModal = false" />
        </x-slot:actions>
    </x-modal>
    {{-- Delete Modal --}}
    @include('partials.delete-modal')
</div>
</div>