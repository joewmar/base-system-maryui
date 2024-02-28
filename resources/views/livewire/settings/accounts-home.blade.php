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
            @scope('actions', $user)
                <div class="flex justify-between space-x-2">
                    <x-button icon="o-pencil-square" tooltip="Edit" class="btn-success btn-sm text-white" onclick="editModal{{$this->loop->index+1}}.showModal()" />
                     {{--EDIT MODAL --}}
                    <x-modal id="editModal{{$this->loop->index+1}}" title="Choose want to edit" persistent >
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 w-full">
                            <a href="{{route('settings.accounts.edit', encrypt($user->id))}}">
                                <div class="w-52 h-20 shadow-md rounded-md bg-gray-100 hover:bg-gray-300 flex justify-center items-center">
                                    <div class="font-bold">Account Information</div>
                                </div>
                            </a>
                            <a href="">
                                <div class="w-52 h-20 shadow-md rounded-md bg-gray-100 hover:bg-gray-300 flex justify-center items-center">
                                    <div class="font-bold">Change Password</div>
                                </div>
                            </a>
                        </div>
                    </x-modal>

                    <x-button icon="o-trash" tooltip="Remove" class="btn-error btn-sm text-white" onclick="deleteModal()" />
                    {{-- DELETE MODAL --}}
                    {{-- <x-modal id="modal{{$this->loop->index+1}}" title="Are you sure?" persistent >
                        <div class="flex justify-start">
                            <div>Do you want to remove this: {{$user->name}} ?</div>
                        </div>
                        <x-slot:actions>
                            {{-- Notice `onclick` is HTML 
                            <x-button label="Yes" type="submit" class="btn-primary" wire:click="remove('{{encrypt($user->id)}}')" />
                            <x-button label="No" type="submit" onclick="modal{{$this->loop->index+1}}.close()" />
                        </x-slot:actions>
                    </x-modal> --}}

                </div>
            @endscope
        </x-table>
    </div>                
    <x-process-dialog target="sortBy" />
    @section('scripts')
        <script type="module" src="{{asset('js/app.js')}}"></script>
    @endsection
</div>