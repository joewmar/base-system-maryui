@section('title') Farm @endsection


<div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center">
    <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('farm.information.home')}}"  />
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Farm</h3>
    </div>
    <div class="w-full mb-3 flex justify-between items-center">
        <div><x-input label="Search" wire:model.live="search" inline icon="o-magnifying-glass" type="search" class="input-sm" /></div>
        <div><x-button icon="o-plus" label="Add" link="{{route('farm.information.farm.create')}}" /></div>
    </div>
    <div class="h-full p-3">

        <x-table :headers="$headers" :rows="$farms" :sort-by="$sortBy" selectable with-pagination   >
            @scope('actions', $farm)
                <div class="flex justify-around w-full space-x-2">
                    <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" link="{{route('farm.information.farm.edit', encrypt($farm->id))}}" />
                    <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="modal{{$this->loop->index+1}}.showModal()" />
                </div>
                <div>
                    <x-modal id="modal{{$this->loop->index+1}}" title="Are you sure?" persistent >
                        <div class="flex justify-start">
                            <div>Do you want to remove this: {{$farm->farm_name}}</div>
                        </div>
                        <x-slot:actions>
                            <x-button label="Yes" type="submit" class="btn-primary" wire:click="remove('{{encrypt($farm->id)}}')"/>
                            <x-button label="No" onclick="modal{{$this->loop->index+1}}.close()" />
                        </x-slot:actions>
                    </x-modal>
                </div>
            @endscope
        </x-table>
    </div>  
</div>
{{-- <x-process-dialog /> --}}
