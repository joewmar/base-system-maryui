@section('title') Electric Cost Home @endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="" />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Electric Cost</h3>
    </div>

    {{-- Search and Add Button --}}
    <div class="flex justify-between my-5 p-3 ">
        <div><x-input label="Search" inline icon="o-magnifying-glass" wire:model="search" type="search" class="input-sm" /></div>
        <div><x-button icon="o-plus" label="Add" wire:click="add()" /></div>
    </div>

    {{-- Table --}}
    <x-table :headers="$headers" :rows="$ElectricCosts" :sort-by="$sortBy" selectable with-pagination >
        @scope('cell_date', $date)
            {{\Carbon\Carbon::parse($date->date)->format('F')}}
        @endscope
        @scope('cell_electric_cost', $cost)
            {{number_format($cost->electric_cost, 2)}}
        @endscope
        @if ($ElectricCosts->isNotEmpty())
            @scope('actions', $ElectricCost)

                <div class="flex justify-around w-full space-x-2">
                    <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" link="" />
                    <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($ElectricCost->id)}}', '{{$ElectricCost->electric_cost}}')" />
                </div>
            @endscope
        @endif
    </x-table>

    {{-- DELETE MODAL --}}
    @include('partials.delete-modal')

    {{-- Date Picker --}}
    @push('scripts')
        <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>
        <script>
            flatpickr.localize(flatpickr.l10ns.fr);
        </script>
    @endpush
</div>