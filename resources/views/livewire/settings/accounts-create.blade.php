@section('title') Create Accounts @endsection

<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.accounts.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Create Accounts</h3>
        </div>
        <div class="mt-5">
            <x-form>
                <x-input label="Name"  inline wire:model.live="name"  />
                <x-input label="Email" type="email" inline wire:model.live="email" />
                <x-select label="Role"  :options="$selectedRoles" option-value="value" option-label="label" placeholder="Select an user" placeholder-value="" wire:model.live="role" inline />
                <x-input id="passw" class="showPassword" label="Password" type="password" inline wire:model.live="password" >
                    <x-slot:append>
                        {{-- Add `rounded-l-none` class --}}
                        <x-button type="button" icon="s-eye" class="rounded-l-none btn-ghost" onclick="showPass('showPassword')" />
                    </x-slot:append>
                </x-input>
                <x-input label="Confirm Password" type="password" inline wire:model.live="password_confirmation" />
                <x-slot:actions>
                    <x-button label="Add" class="btn-primary" onclick="createModal('add', 'Do you want to add this account', 'add')" />
                </x-slot:actions>
            </x-form>
            {{-- <x-process-dialog /> --}}
            @include('partials.create-modal')
            @push('styles')
                <script>
                    function showPass(cls) {
                        var x = document.querySelector('.'+cls);
                        if (x.type == "password") x.type = "text";
                        else x.type = "password";
                    }
                </script>
            @endpush
        </div>
    </div>
</div>
