@section('title') Downtime @endsection
@include('partials.create-modal')
@include('partials.edit-modal')

<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="" />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Downtime</h3>
    </div>
    {{-- Search and Add Button --}}
    <div class="flex justify-between my-5 p-3 ">
        <div><x-input label="Search" wire:model.live="search" inline icon="o-magnifying-glass" type="search" class="input-sm" /></div>
        <div>
            <x-button icon="o-plus" label="Add" @click="$wire.addModal = true" class="btn-primary" />
        </div>
    </div>

    {{-- Table --}}
    <x-table :headers="$headers" :rows="$downTimes" striped with-pagination  >
        @scope('actions', $downTime)
            <div class="flex justify-around w-full space-x-2">
                    <x-button tooltip="Edit" icon="o-pencil-square" class="bg-green-500 btn-sm" @click="$wire.editModal = true; $wire.edit('{{encrypt($downTime->id)}}')" />
                <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($downTime->id)}}', '{{$downTime->description}}')" />
            </div>
        @endscope
    </x-table>
    {{-- Add Modal --}}
    <x-modal wire:model="addModal" title="Add Downtime" separator>
        <div class="flex flex-col space-y-3">
        <div><x-input label="Description" wire:model.live='description' inline /></div>
        <div><x-input label="Code" wire:model.live='code' inline /></div>
        </div>
        <x-slot:actions>
            <x-button label="Confirm" class="btn-primary" onclick="createModal('add', 'Do you want to add this material', 'add')" />
            <x-button label="Cancel" @click="$wire.addModal = false"  />
        </x-slot:actions>
    </x-modal>

    {{-- Edit Modal --}}
    <x-modal wire:model="editModal" title="Downtime" separator>
        <div class="flex flex-col space-y-3">
        <div><x-input label="Description" wire:model.live='editdescription' inline /></div>
        <div><x-input label="Code" wire:model.live='editcode' inline /></div>
        </div>
        <x-process-dialog target="editModal" />
        <x-slot:actions>
            <x-button label="Update" class="bg-green-500 hover:bg-green-600" icon="c-pencil-square"  onclick="editModal('{{$downtime_id}}')"/>
            <x-button label="Cancel" @click="$wire.editModal = false" />
        </x-slot:actions>
    </x-modal>
    {{-- DELETE MODAL --}}
    @include('partials.delete-modal')
</div>
