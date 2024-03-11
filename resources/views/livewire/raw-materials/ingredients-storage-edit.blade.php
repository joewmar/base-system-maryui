@section('title') Edit Ingredients Storage @endsection
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
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('raw-materials.ingredients-storage.home')}}"  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>{{$material->material_name}} Ingredients</h3>
    </div>
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="List" icon="o-list-bullet">
            <x-datepicker label="Date" wire:model="listDate" icon="o-calendar" :config="$config" inline />
        </x-tab>
        <x-tab name="create-tab" label="Create New" icon="o-sparkles">
            {{-- Calendar-Date --}}
            <div class=" w-48">
                <x-datetime label="Date" wire:model.live="inv_date" icon="o-calendar" inline />
            </div>
            {{-- Ingredients Storage --}}
            <div>
                @foreach ($ingredents as $ingridentkey => $ingredent)
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pt-5 border-t-2 p-3 mt-5 border-primary" >
                        <div class="col-span-5 flex justify-start space-x-3">
                            <x-select wire:model.live="ingredents.{{$ingridentkey}}.farm_id" label="Farm {{$loop->iteration}}" placeholder-value="" placeholder="Select Farm" :options="$farms" option-value="id" option-label="farm_name" inline />
                            <div>
                                {{-- Action Add Item and Delete  --}}
                                @if (count($ingredents) > 1)
                                    <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem('{{encrypt($ingridentkey)}}')" />
                                @else
                                    <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" disabled />
                                @endif
                            @if ($loop->last)
                                    <x-button tooltip="Add Item" icon="o-plus" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
                            @else 
                                <x-button tooltip="Add Item" icon="o-plus" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" disabled />
                            @endif
                            </div>
                        </div>
                        {{-- <hr class="col-span-5"> --}}
                        @foreach ($ingredent['feed_types'] ?? [] as $feedkey => $feed)
                            <x-input inline disabled wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.name" />
                            <x-input label="Standard" inline wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.standard" />
                            <x-input label="Batch" inline wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.batch"  />
                            <x-input label="Adjustment" inline wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.adjusment" />
                            <div class="flex justify-center pt-4">
                                <x-checkbox wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.enabled" />
                            </div>
                        @endforeach

                    </div >
                    {{-- <hr> --}}
                @endforeach
            </div>
            {{-- Action for Adding --}}
            <div class="flex justify-end mt-5 mr-28 ">
                <x-button label="Save" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" icon="m-plus-small" onclick="editModal('{{encrypt($material->id)}}')" />
            </div>
        </x-tab>
    </x-tabs>
 

</div>
