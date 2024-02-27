@section('title') Edit Farm @endsection

<div>
    <section class="h-full m-5 ">
        <div class="h-fit m-5">
            <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center">
                <x-button icon="s-arrow-left" class="btn-circle btn-ghost" link="{{route('farm.information.farm')}}" tooltip="Back" />
                <div class="p-4 text-center font-bold text-3xl">
                    <h3>Edit {{$farm->farm_name}}</h3>
                </div>

                <div>
                    <form wire:submit="save" >
                        <div class="mt-3 space-y-5">
                            <x-input label="Farm Name" inline wire:model.live="farm_name"  />
                            <x-button label="Save" wire:click="$toggle('modalEdit')" class="btn-primary" />
                        </div>
                        <x-modal wire:model="modalEdit" title="Are you sure?" persistent >
                            Do you want to save this: {{$farm_name}}
                            <x-slot:actions>
                                <x-button type="submit" label="Yes" class="btn-primary" wire:click="save()" p />
                                <x-button label="No" @click="$wire.modalEdit = false" />
                            </x-slot:actions>
                        </x-modal>
                    </form>
                </div>


            {{-- <x-modal title="Post Wala" message="Hello Success"/> --}}
            </div>
        </div>
    </section>
</div>