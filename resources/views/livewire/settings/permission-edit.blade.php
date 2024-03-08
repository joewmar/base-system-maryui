@section('title') Edit Permission @endsection
<div class="h-fit m-5 ">
    <div class="h-fit m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-start">
            <x-button icon="o-arrow-left" class="btn-circle btn-ghost" link="{{route('settings.permission.home')}}"  />
        </div>
        <div class="p-4 text-center font-bold text-3xl">
            <h3>Permission of {{$user->name}}</h3>
        </div>
        <div class="overflow-x-auto mt-7">
            @foreach ($permissions as $module => $subMod)
                <table class="table table-zebra table-row-group w-full">
                    <!-- head -->
                    <tbody>
                        <tr class="w-full flex justify-center items-center">
                            <td class="font-bold w-52">{{Str::title(str_replace('_', ' ', $module))}}</td>
                            @foreach ($subMod as $action)
                                <td class="flex justify-center items-center flex-col gap-2 mx-5 w-36">
                                    <h1 class="text-sm text-center">{{Str::title(str_replace('_', ' ', $action))}}</h1>
                                    <x-checkbox wire:model="userPermission" value="{{$module.'('.$action.')'}}" />
                                </td>
                            @endforeach
                        </tr>

                    </tbody>
                </table>
            @endforeach
          </div>
        <div class="flex justify-end my-5 p-3 ">
            <div><x-button label="Save" class="btn-primary" onclick="createModal('save', 'Do you want change this permission', 'change')" /></div>
        </div>
    </div>                
    {{-- <x-process-dialog  /> --}}
    @include('partials.create-modal')
</div>