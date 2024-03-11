@section('title') Feed Types @endsection
@include('partials.create-modal')
@include('partials.edit-modal')
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="" />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Feed Types</h3>
    </div>

    {{-- Search and Add Button --}}
    <div class="flex justify-between my-5 p-3 ">
        <div><x-input label="Search" inline icon="o-magnifying-glass" type="search" class="input-sm" /></div>
        <div>
            <x-button label="Add" class="btn-primary text-sm" icon="m-plus-small" @click="$wire.addModal = true" />
        </div>
    </div>

    {{-- Table --}}
    <x-table :headers="$headers" :rows="$feedTypes" striped  >
        @scope('cell_feed_type_name', $feedType) {{Str::upper($feedType->feed_type_name)}} @endscope
        @scope('cell_farm.farm_name', $feedType) {{Str::upper($feedType->farm->farm_name)}} @endscope
        @scope('actions', $feedType)
            <div class="flex justify-around w-full space-x-2">
                <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" @click="$wire.editModal = true; $wire.edit('{{encrypt($feedType->id)}}')" />
                <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($feedType->id)}}', '{{$feedType->feed_type_name}}')" />
            </div>
        @endscope
    </x-table>
        {{-- Add Modal --}}
        <x-modal wire:model="addModal" title="Add Feed Type" separator>
            <div class="flex flex-col space-y-3">
                <div><x-input label="Feed Type" wire:model.live='feedtype' inline /></div>
                <div><x-select label="Farm" :options="$farms" option-value="id" option-label="farm_name" placeholder-value="" placeholder="Select Farm" inline wire:model.live="farmID" /></div>
            </div>
            <x-slot:actions>
                <x-button label="Add" class="btn-primary" onclick="createModal('add', 'Do you want to add this feed type', 'add')" />
                <x-button label="Cancel" @click="$wire.addModal = false" />
            </x-slot:actions>
        </x-modal>
        {{-- Edit Modal --}}
        <x-modal wire:model="editModal" title="Edit {{Str::upper($editFTRefName)}}" separator persistent >
            <div class="flex flex-col space-y-3">
                <div><x-input label="Feed Type" wire:model.live='editFeedtype' inline /></div>
                <div><x-select label="Farm" :options="$farms" option-value="id" option-label="farm_name" placeholder-value="" placeholder="Select Farm" inline wire:model.live="editFarmID" /></div>
            </div>
            <x-slot:actions>
                <x-button label="Save" class="btn-primary" onclick="editModal('{{$editFTID}}')" />
                <x-button label="Cancel" @click="$wire.editModal = false" />
            </x-slot:actions>
            <x-process-dialog target="editModal" />
        </x-modal>
    {{-- DELETE MODAL --}}
    @include('partials.delete-modal')
</div>