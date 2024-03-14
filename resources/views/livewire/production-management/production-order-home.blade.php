@section('title') Production Orders @endsection
@push('styles')
    {{-- Flatpickr  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
@php
    $configTime = ['enableTime' => true, 'noCalendar' => true, 'time_24hr' => true];
@endphp
<div class="h-fit m-5">
    <div class="p-4 text-center font-bold text-3xl pt-12">
        <h3>Production Order</h3>
    </div>
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="List" icon="o-list-bullet">
            <x-datepicker label="Date" wire:model="listDate" icon="o-calendar" />

            <div class="pt-10">
                Production Order
            </div>
            <br>
            <div class="overflow-x-auto bg-base-200 pt-5 p-8 font-bold">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th class="text-left">Date</th>
                            <th class="text-left">Order</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </x-tab>
        <x-tab name="create-tab" label="Create New" icon="s-archive-box-arrow-down">
            <x-form>
                <div class="space-y-3">
                    <x-datepicker label="Date created" wire:model.live="addDate" icon="o-calendar" />
                    <x-input type="number" label="Target Tons/Hour" wire:model.live="targetTonsHours" />
                    <x-input type="number" label="Prod Target Tons" wire:model.live="prodTarget" />
                    <x-input type="number" label="Total Hours Operated" wire:model.live="total_hours_operated" />
                    <x-input type="number" label="Number of Manpower" wire:model.live="number_of_manpower" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pt-5 border-t-2 p-3 mt-5 border-primary">
                    @foreach ($production as $key => $prod)
                        <div class="col-span-5 flex justify-start space-x-3">
                            <x-select inline label="Feed Type" :options="$feedTypes" option-value="id" option-label="feed_type_farm" placeholder="Select a Feed Type" placeholder-value="" wire:model="production.{{$key}}.feed_type"  />
                            <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem" />
                            <x-button tooltip="Add Item" icon="o-plus" class=" mt-1 btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
                        </div>
                        <x-datepicker inline type="time" label="Runtime start" wire:model.live="production.{{$key}}.runtime_start" icon="o-clock" :config="$configTime" />
                        <x-datepicker inline type="time" label="Runtime end" wire:model.live="production.{{$key}}.runtime_end" icon="o-clock" :config="$configTime" />
                        <x-input inline type="number" label="Tons" wire:model.live="production.{{$key}}.tons_produced" />
                        <x-select inline label="QA Result" :options="$QA" option-value="id" option-label="code" placeholder="Select a QA Result" placeholder-value="" wire:model="production.{{$key}}.qa_result"  />
                        <x-select inline label="DT Category" :options="$downtime" option-value="id" option-label="code" placeholder="Select a DT Category" placeholder-value="" wire:model="production.{{$key}}.dt_category"  />
                        <x-datepicker inline type="time" label="Runtime start" wire:model.live="production.{{$key}}.downtime_start" icon="o-clock" :config="$configTime" />
                        <x-datepicker inline type="time" label="Runtime end" wire:model.live="production.{{$key}}.downtime_end" icon="o-clock" :config="$configTime" />
                        
                    @endforeach
                </div>
                <div class="flex justify-start my-5 p-3">
                    <x-button label="Save" class="btn-primary text-sm" icon="m-plus-small" wire:click="save" />
                </div>
            </x-form>
        </x-tab>
    </x-tabs>
</div>
