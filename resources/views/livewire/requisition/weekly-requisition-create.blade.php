@section('title') Create Daily Inventory @endsection
@include('partials.create-modal')
@push('styles')
    {{-- Flatpicker  --}}
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
    <div class="p-4 text-center font-bold text-3xl mb-5">
        <h3>Create Daily Inventory</h3>
    </div>
    <x-form>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <x-datepicker label="Date Created" wire:model.live="addDate" icon="o-calendar" :config="$config" />
            <x-input type="number" label="Number of working" wire:model.live='no_of_working' />
        </div>
        <hr>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-2">
            @foreach ($inventories as $key => $inventory)
                <div class="col-span-6 grid  space-x-2">
                    <x-select label="Material" :options="$materials" option-value="id" option-label="material_name" placeholder-value="" placeholder="Select Material" inline wire:model.live="inventories.{{$key}}.material_id" />
                    <div>
                        {{-- Delete Item --}}
                        @if (count($inventories) > 1)
                            <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem('{{encrypt($key)}}')" />
                        @else
                            <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" disabled />
                        @endif
                        {{-- Add Item --}}
                        @if ($loop->last)
                                <x-button tooltip="Add Item" icon="o-plus" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
                        @else 
                            <x-button tooltip="Add Item" icon="o-plus" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" disabled />
                        @endif
                    </div>
                </div>
                @if (isset($inventory['material_id']) && !empty($inventory['material_id']))
                    <x-input type="number" label="Price per Kgs" inline wire:model="inventories.{{$key}}.price_per_kg" />
                    <x-input type="number" label="Inventory Cost" inline wire:model="inventories.{{$key}}.inventory_cost" />
                    <x-input type="number" label="Kgs per bag"  inline wire:model="inventories.{{$key}}.kilograms_per_bag" />
                    <x-input type="number" label="Deliveries Today"  inline wire:model="inventories.{{$key}}.deliveries_today" />
                    <x-input type="number" label="Standard day" inline wire:model="inventories.{{$key}}.standard_days" />
                @endif
                <hr class="my-1 col-span-6">
            @endforeach
        </div>
        <div class="flex justify-start my-5 p-3 "><div><x-button label="Save" onclick="createModal('add', 'Do you want add this inventory', 'add')" class="btn-primary" icon="o-plus" /></div></div>

    </x-form>
    {{-- Create Form --}}

</div>