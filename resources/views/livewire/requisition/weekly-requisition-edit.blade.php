@section('title') Inventory Requisition @endsection
@include('partials.edit-modal')
@push('styles')
    {{-- Flatpickr  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
@php
    $config = ['altFormat' => 'F j, Y', 'dateFormat' => 'Y-m-d'];
@endphp
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('requisition.weekly-requisition-home')}}"  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>{{$material->material_name}} Daily Inventory</h3>
    </div>
    {{-- Tabs --}}
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="List" icon="o-list-bullet">
            <x-datepicker label="Date" wire:model.live="listDate" icon="o-calendar" :config="$config" />
            <x-process-dialog target="listDate" />
            {{-- <x-table :headers="[['key' => 'farm_name', 'label' => 'Farm', 'class' => 'text-neutral']]" :rows="$farms" wire:model="expanded" expandable >
                @scope('expansion', $farm, $ingredentList)
                    <div class="overflow-x-auto bg-base-200 p-8 font-bold">
                        <table class="table table-zebra">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Feed Type</th>
                                    <th>Standard</th>
                                    <th>Batch</th>
                                    <th>T.BATCH</th>
                                    <th>Adjusment</th>
                                    <th>Usage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ingredentList as $ingredent)
                                    @if($ingredent->feedType->farm_id == $farm->id)
                                        <tr>
                                            <th>{{$ingredent->feedType->feed_type_name}}</th>
                                            <td>{{$ingredent->standard}}</td>
                                            <td>{{$ingredent->batch}}</td>
                                            <td>{{$ingredent->totalBatch()}}</td>
                                            <td>{{$ingredent->adjustment}}</td>
                                            <td>{{$ingredent->usage()}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endscope
                
            </x-table> --}}
        </x-tab>
        <x-tab name="add-tab" label="Create New" icon="c-archive-box">
            <div class="space-y-3">
                <x-datepicker label="Date Created" wire:model.live="addDate" icon="o-calendar" :config="$config" />
                <x-input type="number" label="Price per Kilograms" wire:model.live='price_per_kg' inline />
                <x-input type="number" label="Inventory Cost" wire:model.live='inventory_cost' inline />
                <x-input type="number" label="Kilograms per bag" wire:model.live='kilograms_per_bag' inline />
                <x-input type="number" label="STD days" wire:model.live='standard_days' inline />
                <div class="flex justify-end"><div><x-button label="Save" onclick="editModal('{{encrypt($material->id)}}')" class="btn-primary" icon="o-plus" /></div></div>
            </div>
        </x-tab>
    </x-tabs>
</div>