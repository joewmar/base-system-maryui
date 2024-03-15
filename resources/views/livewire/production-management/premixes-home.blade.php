@section('title') Premixes @endsection
@include('partials.create-modal')
@include('partials.edit-modal')
@push('styles')
    {{-- Flatpickr  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
@php
    $configDate = ['dateFormat' => 'Y-m-d', 'altFormat' => 'F j, Y', 'altInput' => true];
@endphp
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('production-management.premixes-home')}}"  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Premixes</h3>
    </div>
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="List" icon="o-list-bullet">
            <x-datepicker label="Date" wire:model="listDate" icon="o-calendar" />

            <div class="pt-10">
                Premixes
            </div>
            <br>
            <div class="overflow-x-auto bg-base-200 pt-5 p-8 font-bold">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th class="text-left">Feed Type</th>
                            <th class="text-left">Beginning</th>
                            <th class="text-left">Micro</th>
                            <th class="text-left">Macro</th>
                            <th class="text-left">Ending</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </x-tab>
        <x-tab name="create-tab" label="Create New" icon="o-sparkles">
            <div class="w-48">
                <x-datepicker label="Date created" wire:model.live="addDate" icon="o-calendar" :config="$configDate" />
            </div>
            <div>
                @foreach ($premixes as $pmxKey => $premix)
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pt-5 border-t-2 p-3 mt-5 border-primary" >
                        <div class="col-span-5 flex justify-start space-x-3">
                            <x-select wire:model.live="premixes.{{$pmxKey}}.farm_id" label="Farm {{$loop->iteration}}" placeholder-value="" placeholder="Select Farm" :options="$farms" option-value="id" option-label="farm_name" inline />
                            <div>
                                {{-- Action Add Item and Delete  --}}
                                @include('partials.action-input', ['items' => $premixes, 'deleteID' => $pmxKey])
                            </div>
                        </div>
                        @isset($premix['feed_types'])
                            @foreach ($premix['feed_types'] ?? [] as $feedkey => $feed)
                                <x-input inline disabled wire:model.live="premixes.{{$pmxKey}}.feed_types.{{$feedkey}}.name" />
                                <x-input type="number" label="Beginning" inline wire:model.live="premixes.{{$pmxKey}}.feed_types.{{$feedkey}}.beginning" />
                                <x-input type="number" label="Macro" inline wire:model.live="premixes.{{$pmxKey}}.feed_types.{{$feedkey}}.micro" />
                                <x-input type="number" label="Micro" inline wire:model.live="premixes.{{$pmxKey}}.feed_types.{{$feedkey}}.macro" />
                                <x-input type="number" label="Ending" inline wire:model.live="premixes.{{$pmxKey}}.feed_types.{{$feedkey}}.ending" />
                            @endforeach
                        @endisset
                        {{-- <hr class="col-span-5"> --}}


                    </div >
                    {{-- <hr> --}}
                @endforeach
            </div>
            <div class="flex justify-start my-5 p-3">
                <x-button label="Add" class="btn-primary text-sm" icon="m-plus-small" onclick="createModal('add', 'Do you want add this premix data', 'add')" />
            </div>
        </x-tab>
    </x-tabs>
</div>
