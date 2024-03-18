@section('title') Edit Ingredients Storage @endsection
@include('partials.edit-modal')
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
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('raw-materials.ingredients-storage.home')}}"  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>{{$material->material_name}} Ingredients</h3>
    </div>
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="List Farm" icon="o-list-bullet">
            <div class="flex justify-between items-center">
                <x-datepicker label="Date" wire:model.live="listDate" icon="o-calendar" :config="$config" />
                @if($haveRecord)
                    <x-button inline label="Edit" class="btn-primary" link="{{route('raw-materials.ingredients-storage.edit.inventory', ['id' => encrypt($material->id), 'date' => $listDate])}}" />
                @else
                    <x-button label="Edit" class="btn-primary" disabled />
                @endif
            </div>
            <x-process-dialog target="listDate" />
            <x-table :headers="[['key' => 'farm_name', 'label' => 'Farm' ]]" :rows="$farms" wire:model="expanded" expandable >
                {{-- Special `expansion` slot --}}
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
                                @php $total_usage = 0; @endphp
                                @foreach ($ingredentList as $ingredent)
                                    @if($ingredent->feedType->farm_id == $farm->id)
                                        <tr>
                                            <th>{{$ingredent->feedType->feed_type_name}}</th>
                                            <td>{{$ingredent->standard}}</td>
                                            <td>{{$ingredent->batch}}</td>
                                            <td>{{$ingredent->total_batch}}</td>
                                            <td>{{$ingredent->adjustment}}</td>
                                            <td>{{$ingredent->usage}}</td>
                                        </tr>
                                        @php $total_usage = $ingredent->totalUsage($farm->id); @endphp
                                    @endif
                                @endforeach
                                <tr><td colspan="6"><hr></td></tr>
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <h2 class="font-bold text-sm">Total Usage: {{$total_usage}}</h2>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                @endscope
            </x-table>
        </x-tab>
        {{-- Create New Ingredients Tab --}}
        <x-tab name="create-tab" label="Inventory" icon="s-archive-box-arrow-down">
            {{-- Calendar-Date --}}
            <x-form>
                <div class=" w-48">
                    <x-datepicker label="Date Created" wire:model.live="invDate" icon="o-calendar" :config="$config" />
                </div>
                <div>
                    @foreach ($ingredents as $ingridentkey => $ingredent)
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-5 border-t-2 p-3 mt-5 border-primary" >
                            <div class="col-span-4 flex justify-start space-x-3">
                                <x-select wire:model.live="ingredents.{{$ingridentkey}}.farm_id" label="Farm {{$loop->iteration}}" placeholder-value="" placeholder="Select Farm" :options="$farms" option-value="id" option-label="farm_name" inline />
                                <div>
                                    {{-- Action Add Item and Delete  --}}
                                    @include('partials.action-input', ['items' => $ingredents, 'deleteID' => $ingridentkey])
                                </div>
                            </div>
                            {{-- <hr class="col-span-5"> --}}
                            @foreach ($ingredent['feed_types'] ?? [] as $feedkey => $feed)
                                <x-input inline disabled wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.name" />
                                <x-input type="number" label="Standard" inline wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.standard" />
                                <x-input type="number" label="Batch" inline wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.batch"  />
                                <x-input type="number" label="Adjustment" inline wire:model.live="ingredents.{{$ingridentkey}}.feed_types.{{$feedkey}}.adjusment" />
                            @endforeach

                        </div >
                        {{-- <hr> --}}
                    @endforeach
                </div>
                {{-- Action for Adding --}}
                <div class="flex justify-start mt-5 mr-28 ">
                    <x-button label="Save" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" icon="m-plus-small" onclick="editModal('{{encrypt($material->id)}}')" />
                </div>
                {{-- <x-process-dialog target="invDate" /> --}}

            </x-form>
        </x-tab>
    </x-tabs>
</div>
