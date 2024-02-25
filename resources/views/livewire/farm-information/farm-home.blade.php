@section('title') Farm @endsection


<div wire:init class="pt-12 w-full h-full flex flex-col space-y-10 justify-center">
    <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('farm.information.home')}}"  />
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Farm</h3>
    </div>
    <div class="flex justify-between items-center">
        <div>
            {{-- <x-button icon="plus" dark label="Add Farm" href="{{route('farm.information.farm.create')}}" /> --}}
        </div>
    </div>
    <div class="h-full p-3">
        <div class="w-full mb-3 flex justify-between">
            <div><x-input label="Search" wire:model.live="search" inline icon="o-magnifying-glass" type="search" class="input-sm" /></div>
            <div><x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500" /></div>
        </div>
        <x-table :headers="$headers" :rows="$farms" :sort-by="$sortBy" selectable with-pagination   >
            @scope('actions', $farm)
                <div class="flex justify-around w-full space-x-2">
                    <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500" />
                    <x-button icon="o-trash" tooltip="Remove" class="bg-red-500" />
                </div>
            @endscope
        </x-table>
    </div>  

    {{-- <button onclick="Livewire.emit('openModal', 'remove-modal')">Open Modal</button> --}}
    {{-- @section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

        <script>
            Livewire.on('showDeleteModal', (fID) => {
                // Use fID to fetch details and show the modal
                $('#deleteModal').modal('show');
            });
        </script> 
    @endsection --}}
</div>

