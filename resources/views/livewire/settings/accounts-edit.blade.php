@section('title') Edit Account @endsection

<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.accounts.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Edit Account</h3>
        </div>
        <div class="mt-5">
            <x-tabs selected="info-tab">
                <x-tab name="info-tab" label="Information">
                    <div class="text-xl font-bold my-3">Information</div>
                    <x-form wire:submit="save">
                        <x-input label="Name"  inline wire:model.live="name"  />
                        <x-input label="Email" type="email" inline wire:model.live="email" />
                        <x-select label="Role"  :options="$selectedRoles" option-value="value" option-label="label" placeholder="Select an user" placeholder-value="" wire:model.live="role" inline />
                        <div class="flex items-center space-x-2">
                            <x-toggle label="Active" wire:model.live="activeStatus" />
                            <x-active-status active="{{$activeStatus}}" />
                        </div>
                        <x-slot:actions>
                            <x-button label="Save" class="btn-primary" onclick="createModal('save', 'Do you want to save this account', 'save')" />
                        </x-slot:actions>
                    </x-form>
                </x-tab>
                <x-tab name="password-tab" label="Password">
                    <div class="text-xl font-bold my-3">Change Password</div>
                    <x-form wire:submit="save">
                        <x-input label="Password" type="password" inline wire:model.live="password" />
                        <x-input label="Confirm Password" type="password" inline wire:model.live="password_confirmation" />
                        <x-slot:actions>
                            <x-button label="Save" class="btn-primary" onclick="createModal('savePassword', 'Do you want change this password', 'change')" />
                        </x-slot:actions>
                    </x-form>
                </x-tab>
            </x-tabs>
            {{-- <x-process-dialog /> --}}
            @include('partials.create-modal')
            @section('styles')
                <script>
                    function showPass(cls) {
                        var x = document.querySelector('.'+cls);
                        if (x.type == "password") x.type = "text";
                        else x.type = "password";
                    }
                </script>
            @endsection
        </div>
    </div>
</div>