@section('title') Edit Production Order @endsection
@include('partials.edit-modal')
<div class="h-fit m-5">
    <div class="pt-12 items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('production-management.production-order-home')}}"  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Edit Production Order</h3>
    </div>
    <div class="space-y-3 pt-5 border-y pb-5 px-1 mt-5 border-primary">
        <x-datepicker inline label="Date created" wire:model="addDate" icon="o-calendar" />
        <x-input type="number" inline label="Target Tons/Hour" wire:model="targetTonsHours" />
        <x-input type="number" inline label="Prod Target Tons" wire:model="prodTarget" />
        <x-input type="number" inline label="Total Hours Operated" wire:model="totalHoursOperated" />
        <x-input type="number" inline label="Number of Manpower" wire:model="noOfManpower" />
    </div>
    <div class="pt-5 border-y pb-5 px-1 mt-5 border-primary overflow-x-auto">
        <h1 class="font-bold text-lg">Edit Items</h1>
            <div class="flex justify-start space-x-3 mt-3">
                <x-select inline label="Feed Type"  option-value="id" option-label="feed_type_farm" placeholder="Select a Feed Type" placeholder-value=""   />
                {{-- Buttons --}}
                <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem" />
                <x-button tooltip="Add Item" icon="o-plus" class=" mt-1 btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
            </div>
            <div class="grid grid-flow-col w-auto gap-4 mt-4">
                <div class="w-52"><x-input inline label="Runtime start"  icon="o-clock" /></div>
                <div class="w-52"><x-input inline label="Runtime end"  icon="o-clock" /></div>
                <div class="w-52"><x-input inline type="number" label="Tons Produced"  /></div>
                <div class="w-52"><x-input inline label="Downtime start" /></div>
                <div class="w-52"><x-input inline label="Downtime end"  icon="o-clock" /></div>
                <div class="w-52"><x-select inline label="DT Category"  /></div>
                <div class="w-52"><x-select inline label="QA Result"  /></div>
            </div>
    </div>
    <br>
    <x-textarea wire:model.live="remarks" placeholder="Remarks" rows="3" />
    <div class="flex justify-start my-5 p-3">
        <x-button label="Save" class="btn-primary text-sm" icon="m-plus-small"  />
    </div>
</div>
