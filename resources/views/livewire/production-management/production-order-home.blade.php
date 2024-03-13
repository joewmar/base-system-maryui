@section('title') Production Orders @endsection
<div class="h-fit m-5">
    <div class="p-4 text-center font-bold text-3xl pt-12">
        <h3>Production Order</h3>
    </div>
    <x-tabs selected="table-tab">
        <x-tab name="table-tab" label="List" icon="o-list-bullet">
            <x-datepicker label="Date" wire:model="listDate" icon="o-calendar" />

            <div class="pt-12">
                Production Order
            </div>
            <br>
            <div class="overflow-x-auto bg-base-200 pt-5 p-8 font-bold">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-left">Date</th>
                            <th class="text-left">Order</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </x-tab>
            
        <x-tab name="create-tab" label="Create New" icon="o-sparkles">
            <div class="w-48">
                <x-datepicker label="Date created" wire:model="listDate" icon="o-calendar" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pt-5 border-t-2 p-3 mt-5 border-primary">
                <div class="col-span-5 flex justify-start space-x-3">
                <x-select
                    inline
                    label="Alternative"
                    {{-- :options="$users" --}}
                    option-value="custom_key"
                    option-label="other_name"
                    placeholder="Select an user"
                    placeholder-value="0" {{-- Set a value for placeholder. Default is `null` --}}
                    wire:model="selectedUser2" />
                    <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem" />
                    <x-button tooltip="Add Item" icon="o-plus" class=" mt-1 btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
                </div>
            </div>

        </x-tab>

    </x-tabs>
</div>
