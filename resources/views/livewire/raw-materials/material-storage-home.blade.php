@section('title') Materials Storage @endsection
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="" />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Materials Storage</h3>
    </div>

    {{-- Search and Add Button --}}
    <div class="flex justify-between items-center my-5 p-3 ">
        <div><x-input label="Search" inline icon="o-magnifying-glass" type="search" /></div>
        <div>
            <x-button label="Add" @click="$wire.addModal = true" />
        </div>
    </div>

    <div class="pt-5">
        <x-radio :options="[['key' => '', 'label' => 'All'], ['key' => 'macro', 'label' => 'Macro'], ['key' => 'micro', 'label' => 'Micro'], ['key' => 'medicine', 'label' => 'Medicine']]" option-value="key" option-label="label" wire:model.live="filterCategory" />

            {{-- Table --}}
            <x-table :headers="$headers" :rows="$materials" striped with-pagination >
                @scope('cell_material_name', $material_name)
                    {{ Str::upper($material_name->material_name) }}
                @endscope
                @scope('cell_category', $category)
                    {{ Str::upper($category->category) }}
                @endscope
                @scope('actions', $material)
                    <div class="flex justify-around w-full space-x-2">
                        <x-button icon="o-pencil-square" tooltip="Edit" class="bg-green-500 btn-sm" link="" />
                        <x-button icon="o-trash" tooltip="Remove" class="bg-red-500 btn-sm" onclick="deleteModal('{{encrypt($material->id)}}', '{{$material->material_name}}')" />
                    </div>
                @endscope
            </x-table>
            
    </div>
    {{-- Add Modal --}}
    <x-modal wire:model="addModal" title="Add Material" separator>
        <div class="space-y-3">
            <x-input label="Material" wire:model.live='materialName' inline />
            <x-select label="Category" icon="o-user" option-value="key" option-label="label" placeholder="Select Category" placeholder-value="" inline :options="$selectCategory" wire:model.live="category" />
        </div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.addModal = false" />
            <x-button label="Confirm" class="btn-primary" />
        </x-slot:actions>
    </x-modal>
    @include('partials.delete-modal')
</div>