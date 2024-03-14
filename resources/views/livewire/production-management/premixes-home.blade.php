@section('title') Premixes @endsection
@include('partials.create-modal')
@include('partials.edit-modal')

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
                    placeholder="Select Farm"
                    placeholder-value="0"
                    {{-- wire:model="selectedUser2"  --}} />
                    <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem" />
                    <x-button tooltip="Add Item" icon="o-plus" class=" mt-1 btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
                </div>
            </div>
            <div class="flex justify-start my-5 p-3">
                <x-button label="Save" class="btn-primary text-sm" icon="m-plus-small" wire:click="save" />
            </div>
        </x-tab>
    </x-tabs>
</div>
