@section('title') Electric Cost Home @endsection
@include('partials.create-modal')
@include('partials.edit-modal')
@push('styles')
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js"></script>
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
        <div>
            <x-input label="Search" inline icon="o-magnifying-glass" wire:model.live="search" type="month" class="input-sm" />
        </div>
        <div>
            <x-button label="Add" class="btn-primary text-sm" icon="m-plus-small" @click="$wire.addModal = true" />
        </div>
    </div>

    {{-- Table --}}
    <x-table :headers="$headers" :rows="$ElectricCosts" :sort-by="$sortBy" selectable with-pagination >
        @scope('cell_date', $date)
            {{\Carbon\Carbon::parse($date->date)->format('F Y')}}
        @endscope
        @scope('cell_electric_cost', $cost)
            {{number_format($cost->electric_cost, 2)}}
        @endscope
        @if ($ElectricCosts->isNotEmpty())
            @scope('actions', $ElectricCost)

                <div class="flex justify-around w-full space-x-2">
                    <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" @click="$wire.editModal = true; $wire.edit('{{encrypt($ElectricCost->id)}}')" />
                    <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($ElectricCost->id)}}', '{{$ElectricCost->electric_cost}}')" />
                </div>
            @endscope
        @endif
    </x-table>

    {{-- Add Modal --}}
    <x-modal wire:model="addModal" title="Electric Cost" separator>
        <div class="flex flex-col space-y-3">
        <div><x-input label="Date" type="month" wire:model.live='date' inline /></div>
        <div><x-input label="Electric Cost" prefix="PHP" money wire:model.live='electric_cost' inline /></div>
        </div>
        <x-slot:actions>
            <x-button label="Confirm" class="btn-primary" onclick="createModal('add', 'Do you want to add this material', 'add')" />
            <x-button label="Cancel" @click="$wire.addModal = false" />
        </x-slot:actions>
    </x-modal>

    {{-- Edit Modal --}}
    <x-modal wire:model="editModal" title="Electric Cost" separator>
        <div class="flex flex-col space-y-3">
        <div><x-input label="Date" type="month" wire:model.live='editdate' inline /></div>
        <div><x-input label="Electric Cost" prefix="PHP" money wire:model.live='editelectric_cost' inline /></div>
        </div>
        <x-process-dialog target="editModal" />
        <x-slot:actions>
            <x-button label="Update"  class="bg-green-500 hover:bg-green-600" icon="c-pencil-square" onclick="editModal('{{$electriccost_id}}')" />
            <x-button label="Cancel" @click="$wire.editModal = false" />
        </x-slot:actions>
    </x-modal>

    {{-- DELETE MODAL --}}
    @include('partials.delete-modal')

    {{-- Date Picker --}}
    {{-- @push('scripts')
        <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>
        <script>
            flatpickr.localize(flatpickr.l10ns.fr);
        </script>
    @endpush --}}
</div>