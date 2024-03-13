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
        <h3>{{Str::upper($material->material_name)}} Daily Inventory</h3>
    </div>
    <x-datepicker label="Date" wire:model.live="listDate" icon="o-calendar" :config="$config" />
    <x-process-dialog target="listDate" />
    <div class="mt-5">
        <x-table :headers="$headers" :rows="$orders" >
            @scope('cell_inv_cost', $mat)
                {{number_format($mat->inv_cost, 2)}}
            @endscope
            @scope('actions', $order)
                <div class="flex justify-around w-full space-x-2">
                    <x-button tooltip="Remove" icon="o-trash" class="bg-red-500 btn-sm" link="{{route('requisition.weekly-requisition-order', encrypt($order->id))}}" />
                </div>
            @endscope
        </x-table>
    </div>

</div>