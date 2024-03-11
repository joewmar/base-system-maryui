@section('title') Weeekly Requisition @endsection
<div class="h-fit m-5">
    <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
        <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link=""  />
    </div>
    <div class="p-4 text-center font-bold text-3xl">
        <h3>Weekly Requisition</h3>
    </div>
    {{-- Tabs --}}
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="Show List" icon="o-list-bullet">
            <div class="font-semibold ">Table for Requisition</div>
            {{-- Date and Search Button --}}
            <div class="w-fit pt-2">
                <x-input label="Search" inline icon="o-magnifying-glass" wire:model="search" type="search" >
                    <x-slot:prepend>
                        <x-datepicker class="rounded-r-none w-12 " wire:model="myDate1" inline />
                    </x-slot:prepend>
                </x-input>
            </div>
            {{-- Table for Requisition --}}
            {{-- need database!!! --}}
            <x-table :headers="$weekheaders" :rows="$weeklyOrders" striped />
        </x-tab>
        <x-tab name="add-tab" label="Create New" icon="c-archive-box">
             {{-- Search Button --}}
            <div class="flex justify-start my-5 p-3 ">
                <div><x-input label="Search" inline icon="o-magnifying-glass" wire:model="search" type="search" class="input-sm" /></div>
            </div>
            {{-- Table --}}
            <x-table :headers="$headers" :rows="$weeklyOrders" striped with-pagination>
                @scope('actions', $weeklyOrder)
                    <div class="flex justify-around w-full space-x-2">
                        <x-button tooltip="View" label="View" class="bg-green-500 btn-sm" @click="$wire.editModal = true" />
                    </div>
                @endscope
            </x-table>
            {{-- Edit Modal --}}
            <x-modal wire:model="editModal" title="Weekly Orders" separator >
                <div class="flex flex-col space-y-3">
                <div><x-input label="Price per Kilograms" wire:model.live='price_per_kg' inline /></div>
                <div><x-input label="Inventory Cost" wire:model.live='inventory_cost' inline /></div>
                <div><x-input label="Kilograms per bag" wire:model.live='kilograms_per_bag' inline /></div>
                <div><x-input label="STD days" wire:model.live='standard_days' inline /></div>
                </div>
                <x-slot:actions>
                    <x-button label="Cancel" @click="$wire.editModal = false" />
                    <x-button label="Update" class="bg-green-500 hover:bg-green-600" icon="c-pencil-square"/>
                </x-slot:actions>
            </x-modal>
        </x-tab>
    </x-tabs>
</div>