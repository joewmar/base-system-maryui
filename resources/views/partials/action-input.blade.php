@if (count($items) > 1)
    <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" wire:click="removeItem('{{encrypt($deleteID)}}')" />
@else
    <x-button tooltip="Remove Item" icon="s-trash"  class="mt-1 btn-outline text-red-500 border-red-600 hover:bg-red-500" disabled />
@endif
@if ($loop->last)
    <x-button tooltip="Add Item" icon="o-plus" class=" mt-1 btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" wire:click="addItem"  />
@else
    <x-button tooltip="Add Item" icon="o-plus" class=" mt-1 btn-outline text-blue-600 border-blue-600 hover:bg-blue-700  text-sm" disabled />
@endif