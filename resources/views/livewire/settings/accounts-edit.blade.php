@section('title') Create Accounts @endsection

<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.accounts.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Edit Account</h3>
        </div>
        <div class="mt-5">
            <x-form wire:submit="save">
                <x-input label="Name"  inline wire:model.live="name"  />
                <x-input label="Email" type="email" inline wire:model.live="email" />
                <x-select label="Role"  :options="$selectedRoles" option-value="value" option-label="label" placeholder="Select an user" placeholder-value="" wire:model.live="role" inline />
                {{-- <x-input label="Password" type="password" inline wire:model.live="password" />
                <x-input label="Confirm Password" type="password" inline wire:model.live="password_confirmation" /> --}}
                <x-slot:actions>
                    <x-button label="Save" class="btn-primary" type="submit" wire:click="save" />
                </x-slot:actions>
            </x-form>
            <x-process-dialog target="save" />
        </div>
    </div>
</div>