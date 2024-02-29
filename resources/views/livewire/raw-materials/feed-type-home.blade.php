@section('title') Feed Types @endsection
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="" />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Feed Types</h3>
    </div>
    <div class="flex justify-between my-5 p-3 ">
        <div><x-input label="Search" inline icon="o-magnifying-glass" type="search" class="input-sm" /></div>
        <div><x-button icon="o-plus" label="Add" onclick="createModelInput" /></div>
    </div>
    <x-table :headers="$headers" :rows="$feedTypes" striped  >
    @scope('actions', $feedType)

        <div class="flex justify-around w-full space-x-2">
            <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" link="" />
            <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="modal{{$this->loop->index+1}}.showModal()" />
        </div>
        <div>
            <x-modal id="modal{{$this->loop->index+1}}" title="Are you sure?" persistent >
                <div class="flex justify-start">
                    <div>Do you want to remove this: {{$feedType->feed_type_name}}</div>
                </div>
                <x-slot:actions>
                    <x-button label="Yes" type="submit" class="btn-primary" wire:click="remove('{{encrypt($feedType->id)}}')"/>
                    <x-button label="No" onclick="modal{{$this->loop->index+1}}.close()" />
                </x-slot:actions>
            </x-modal>
        </div>

    @endscope
    </x-table>
</div>