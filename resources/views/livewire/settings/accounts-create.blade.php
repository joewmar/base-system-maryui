@section('title') Create Accounts @endsection

<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.accounts.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Accounts</h3>
        </div>
        <div class="mt-5">
            <x-form >
                <x-input label="Name"  icon="o-user"  inline />
                <x-input label="Username"  icon="o-user" inline />
                <x-input label="Email"  icon="o-user" type="email" inline />
                <x-input label="Password"  icon="o-eye" type="password" inline />
                <x-slot:actions>
                    <x-button label="Click me!" class="btn-primary" type="submit" />
                </x-slot:actions>
            </x-form>
        </div>
    </div>
</div>