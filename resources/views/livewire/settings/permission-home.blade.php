@section('title') Permission @endsection
<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Permission</h3>
        </div>
        <div class="flex justify-between my-5 p-3 ">
            <div><x-input label="Search" inline icon="o-magnifying-glass" type="search" class="input-sm" wire:model.live="search" /></div>
            <div><x-button link="{{route('settings.accounts.create')}}" class="btn-primary">Add Account</x-button></div>
        </div>
        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy" striped with-pagination >
            @scope('cell_role', $user)
                {{Str::upper($user->role)}}
            @endscope
            @scope('actions', $user)
                <div class="flex justify-between space-x-2">
                    <x-button label="View" class="btn-success btn-sm text-white" link="{{route('settings.permission.edit', encrypt($user->id))}}" />
                </div>
            @endscope
        </x-table>
    </div>                
    {{-- <x-process-dialog  /> --}}
</div>