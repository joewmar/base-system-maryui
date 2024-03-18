@section('title') Edit Ingredients Inventory @endsection
@include('partials.create-modal')
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
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('raw-materials.ingredients-storage.edit', encrypt($material->id))}}"  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Edit {{$material->material_name}} on {{Carbon\Carbon::parse($editDate)->format('F j, Y')}}</h3>
    </div>
    {{-- Calendar-Date --}}
    <x-form>
        <div class=" w-48">
            <x-datepicker label="Date Created" wire:model.live="updateDate" icon="o-calendar" :config="$config" />
        </div>
        <div>
            @foreach ($ingredients as $ingridentkey => $ingredent)
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-5 border-t-2 p-3 mt-5 border-primary" >
                    <div class="col-span-4 flex justify-start space-x-3">
                        <x-select wire:model.live="ingredients.{{$ingridentkey}}.farm_id" label="Farm {{$loop->iteration}}" placeholder-value="" placeholder="Select Farm" :options="$farms" option-value="id" option-label="farm_name" inline />
                        <div>
                            {{-- Action Add Item and Delete  --}}
                            @include('partials.action-input', ['items' => $ingredients, 'deleteID' => $ingridentkey])
                        </div>
                    </div>
                    {{-- <hr class="col-span-5"> --}}
                    @foreach ($ingredent['feed_types'] ?? [] as $feedkey => $feed)
                        <x-input inline disabled wire:model.live="ingredients.{{$ingridentkey}}.feed_types.{{$feedkey}}.name" />
                        <x-input type="number" label="Standard" inline wire:model.live="ingredients.{{$ingridentkey}}.feed_types.{{$feedkey}}.standard" />
                        <x-input type="number" label="Batch" inline wire:model.live="ingredients.{{$ingridentkey}}.feed_types.{{$feedkey}}.batch"  />
                        <x-input type="number" label="Adjustment" inline wire:model.live="ingredients.{{$ingridentkey}}.feed_types.{{$feedkey}}.adjusment" />
                    @endforeach

                </div >
                {{-- <hr> --}}
            @endforeach
        </div>
        {{-- Action for Adding --}}
        <div class="flex justify-start mt-5 mr-28 ">
            <x-button label="Save" class="btn-outline btn-primary  text-sm" icon="m-plus-small" onclick="createModal('save', 'Do you want change this inventory', 'change')" />
        </div>
        {{-- <x-process-dialog target="invDate" /> --}}

    </x-form>
</div>
