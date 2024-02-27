@section('title') Create Farm @endsection

<div>
    <section class="h-full m-5 ">
        <div class="h-fit m-5">
            <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center">
                <x-button icon="s-arrow-left" class="btn-circle btn-ghost" link="{{route('farm.information.farm')}}" tooltip="Back" />
                <div class="p-4 text-center font-bold text-3xl">
                    <h3>Farm</h3>
                </div>
                <div class="flex justify-end">
                    <div>
                        <x-button icon="o-list-bullet" label="Show List" link="{{route('farm.information.farm')}}" class="btn-primary" />
                    </div>
                </div>

                <div>
                    <h1 class="text-2xl font-bold">Add Farm</h1>
                    <form wire:submit="add" >
                        <div class="mt-3 space-y-5">
                            <x-input label="Farm Name" inline wire:model.live="farm_name"  />
                            <x-button icon="o-plus" label="Add" wire:click="$toggle('addFarmMdl')" class="btn-primary" />
                        </div>
                        <x-modal wire:model="addFarmMdl" title="Are you sure?" persistent >
                            Do you want to add this: {{$farm_name}}
                            <x-slot:actions>
                                <x-button type="submit" label="Yes" class="btn-primary" wire:click="add()" />
                                <x-button label="No" @click="$wire.addFarmMdl = false" />
                            </x-slot:actions>
                        </x-modal>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>