@section('title') Feed Types @endsection
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
    @scope('actions', $feedType)
        <div class="flex justify-around w-full space-x-2">
            <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" link="" />
            <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($feedType->id)}}', '{{$feedType->feed_type_name}}')" />
        </div>
    @endscope
    </x-table>
        {{-- Add Modal --}}
        <x-modal wire:model="addModal" title="Add Feed Type" separator>
            <div class="flex flex-col space-y-3">
            <div><x-input label="FeedType" wire:model.live='feedtype' inline /></div>
            </div>
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.addModal = false" />
                <x-button label="Confirm" class="btn-primary" />
            </x-slot:actions>
        </x-modal>
    {{-- DELETE MODAL --}}
    @include('partials.delete-modal')
</div>