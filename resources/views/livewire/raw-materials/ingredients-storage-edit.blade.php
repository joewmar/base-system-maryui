@section('title') Edit Ingredients Storage @endsection
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('raw-materials.ingredients-storage.home')}}"  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Edit Ingredients Storage</h3>
    </div>
    {{-- Calendar-Date --}}
    <div class="w-48">
        <x-datetime label="Date" wire:model.live="Calendar" icon="o-calendar" />
    </div>
    {{--  --}}
    <div class="grid grid-cols-5 gap-4 pt-5" >
        <x-select label="FeedType"
        placeholder="Select FeedType" />
        <x-input label="Standard"
        placeholder="Enter Standard" />
        <x-input label="Batch"
        placeholder="Enter Batch" />
        <x-input label="Adjustment"
        placeholder="Enter Adjustment" />
        {{-- Action for Delete --}}
        <div> 
            <h3>Action</h3>
            <x-button icon="m-archive-box-arrow-down"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" />
        </div>
    </div >
    {{-- Action for Adding --}}
    <div class="flex justify-end mt-5 mr-28  ">
        <x-button label="Add" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" icon="m-plus-small" />
    </div>

</div>
