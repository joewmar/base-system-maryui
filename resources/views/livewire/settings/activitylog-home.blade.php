@section('title') Activity Log @endsection
<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Activity Log</h3>
        </div>
        <div class="flex justify-between my-5 p-3 ">
            <div><x-input label="Search" inline icon="o-magnifying-glass" type="search" class="input-sm" /></div>
        </div>
        <x-table :headers="$headers" :rows="$users" striped @row-click="alert($event.detail.name)" >
            {{-- @scope('actions', $user)
            @endscope --}}
        </x-table>
    </div>
</div>