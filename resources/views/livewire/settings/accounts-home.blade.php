@section('title') Accounts @endsection
<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Accounts</h3>
        </div>
        <div class="flex justify-between my-5 p-3 ">
            <div><x-input label="Search" inline icon="o-magnifying-glass" type="search" class="input-sm" wire:model.live="search" /></div>
            <div><x-button link="{{route('settings.accounts.create')}}" class="btn-primary">Add Account</x-button></div>
        </div>
        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy" striped with-pagination >
            @scope('cell_role', $user)
                {{Str::upper($user->role)}}
            @endscope
            @scope('cell_active_status', $user)
                <x-active-status active="{{$user->active_status}}" />
            @endscope
            @scope('actions', $user)
                <div class="flex justify-between space-x-2">
                    <x-button  icon="o-pencil-square" tooltip="Edit" class="btn-success btn-sm text-white" link="{{route('settings.accounts.edit', encrypt($user->id))}}"/>
                    <x-button icon="o-trash" tooltip="Remove" class="btn-error btn-sm text-white" onclick="deleteModal('{{encrypt($user->id)}}', '{{$user->name}}')" />
                </div>
            @endscope
        </x-table>
        @include('partials.delete-modal')

    </div>                
    {{-- <x-process-dialog  /> --}}
    @push('scripts')
        <script type="module" src="{{asset('js/app.js')}}"></script>
    @endpush
</div>