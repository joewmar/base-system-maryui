@section('title') Ingredients Storage @endsection
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link=""  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Ingredients Storage</h3>
    </div>
    {{-- Search Button --}}
    <div class="flex justify-start my-5 p-3 ">
        <div><x-input label="Search" inline icon="o-magnifying-glass" wire:model="search" type="search" class="input-sm" /></div>
    </div>
    {{-- Table --}}
    <x-table :headers="$headers" :rows="$materials" striped with-pagination>
        @scope('actions', $material)
            <div class="flex justify-around w-full space-x-2">
                <x-button tooltip="View" label="View" class="bg-green-500 btn-sm" link="{{route('raw-materials.ingredients-storage.edit', encrypt($material->id))}}" />
            </div>
        @endscope
    </x-table>
</div>