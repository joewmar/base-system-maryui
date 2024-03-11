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
        <x-datetime label="Date" wire:model.live="inv_date" icon="o-calendar" inline />
    </div>
    {{--  --}}
    <div>
        @foreach ($ingredents as $ingredent)
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 pt-5 border p-3 mt-5" >
                <x-select label="Feed Type" placeholder-value="" placeholder="Select Feed Type" :options="$farms" option-value="id" option-label="farm_name" inline wire:model.live="ingredents.item{{$loop->iteration}}.feed_type_id" />
                <x-input label="Farm" value="None" inline disabled wire:model.live="ingredents.item{{$loop->iteration}}.farm_name"   />
                <x-input label="Standard" inline wire:model.live="ingredents.item{{$loop->iteration}}.standard" />
                <x-input label="Batch" inline wire:model.live="ingredents.item{{$loop->iteration}}.batch" />
                <x-input label="Adjustment" inline wire:model="ingredents.item{{$loop->iteration}}.adjustment" />
                <div> 
                    {{-- Action Add Item and Delete --}}
                    <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem('{{encrypt('item'.$loop->iteration)}}')" />
                    @if ($loop->last)
                        <x-button tooltip="Add Item" icon="o-plus" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
                    @else 
                        <x-button tooltip="Add Item" icon="o-plus" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem" disabled />
                    @endif
                </div>
            </div >
        @endforeach
    </div>

    {{-- Action for Adding --}}
    <div class="flex justify-end mt-5 mr-28  ">
        <x-button label="Save" class="btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" icon="m-plus-small" wire:click="save" />
    </div>

</div>
