@section('title') Production Orders @endsection
@include('partials.create-modal')
@push('styles')
    {{-- Flatpickr  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
@php
    $configDate = ['dateFormat' => 'Y-m-d', 'altFormat' => 'F j, Y', 'altInput' => true];
@endphp
<div class="h-fit m-5">
    <div class="p-4 text-center font-bold text-3xl pt-12">
        <h3>Production Order</h3>
    </div>
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="List" icon="o-list-bullet">
            <x-datepicker inline label="Date" wire:model="listDate" icon="o-calendar" />
            <x-table :headers="$headers" :rows="$listProd" >
                @if ($listProd->count() > 0)
                    @scope('actions', $order)
                        <div class="flex justify-around w-full space-x-2">
                            <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" />
                            <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($order->id)}}', '{{$order->date}}')" />
                        </div>
                    @endscope
                @endif
            </x-table>
        </x-tab>
        {{-- Create Tab --}}
        <x-tab name="create-tab" label="Create New" icon="s-archive-box-arrow-down">
            <x-form>
                <div class="space-y-3">
                    <x-datepicker inline label="Date created" wire:model.live="addDate" icon="o-calendar" :config="$configDate" />
                    <x-input type="number" inline label="Target Tons/Hour" wire:model.live="targetTonsHours" />
                    <x-input type="number" inline label="Prod Target Tons" wire:model.live="prodTarget" />
                    <x-input type="number" inline label="Total Hours Operated" wire:model.live="totalHoursOperated" />
                    <x-input type="number" inline label="Number of Manpower" wire:model.live="noOfManpower" />
                </div>
                <div class="pt-5 border-y pb-5 px-1 mt-5 border-primary overflow-x-auto">
                    <h1 class="font-bold text-lg">Create Items</h1>
                    @foreach ($production as $key => $prod)
                        <div class="flex justify-start space-x-3 mt-3">
                            <x-select inline label="Feed Type" :options="$feedTypes" option-value="id" option-label="feed_type_farm" placeholder="Select a Feed Type" placeholder-value="" wire:model.live="production.{{$key}}.feed_type"  />
                            @include('partials.action-input', ['items' => $production, 'deleteID' => $key])
                        </div>
                        @if (isset($prod['feed_type']))
                            <div class="grid grid-flow-col w-auto gap-4 mt-4">
                                <div class="w-52"><x-input inline label="Runtime start" wire:model.live="production.{{$key}}.runtime_start" icon="o-clock" /></div>
                                <div class="w-52"><x-input inline label="Runtime end" wire:model.live="production.{{$key}}.runtime_end" icon="o-clock" /></div>
                                <div class="w-52"><x-input inline type="number" label="Tons Produced" wire:model.live="production.{{$key}}.tons_produced" /></div>
                                <div class="w-52"><x-input inline label="Downtime start" wire:model.live="production.{{$key}}.downtime_start" icon="o-clock" /></div>
                                <div class="w-52"><x-input inline label="Downtime end" wire:model.live="production.{{$key}}.downtime_end" icon="o-clock" /></div>
                                <div class="w-52"><x-select inline label="DT Category" :options="$downtime" option-value="id" option-label="code" placeholder="Select a DT Category" placeholder-value="" wire:model.live="production.{{$key}}.dt_category" /></div>
                                <div class="w-52"><x-select inline label="QA Result" :options="$QA" option-value="id" option-label="code" placeholder="Select a QA Result" placeholder-value="" wire:model.live="production.{{$key}}.qa_result" /></div>
                            </div> 
                        @endif

                    @endforeach
                </div>
                <x-textarea wire:model.live="remarks" placeholder="Remarks" rows="3" />

                <div class="flex justify-start my-5 p-3">
                    <x-button label="Save" class="btn-primary text-sm" icon="m-plus-small" onclick="createModal('add', 'Do you want add this production order', 'add')" />
                </div>
            </x-form>
        </x-tab>
    </x-tabs>
</div>
