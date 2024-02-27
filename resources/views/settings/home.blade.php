@extends('layouts.app')
@section('title') Farm Informations @endsection
{{-- For Home tabs --}}
@section('content')
    <div class="h-full m-5">
        <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center items-center">
            <h3 class="w-full mx-auto text-center text-4xl font-semibold"> 
                Setting
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center pt-10 "> 
                <a href="{{route('settings.accounts.home')}}" class="p-10 rounded-lg items-center text-center shadow-xl hover:bg-slate-300   hover:text-gray-700">
                    <x-icon name="s-user-group" class="w-20 h-20" />
                    <div class="items-center text-center">
                        <h2 class="p-2 font-medium">Account</h2>
                        <p class="p-2">Manage Student Account</p>
                    </div>
                </a>
                <a href="" class="p-8 items-center rounded-lg text-center shadow-xl hover:bg-slate-300   hover:text-gray-700">
                    <x-icon name="m-clipboard" class="w-20 h-20 " />
                    <div class="items-center text-center">
                        <h2 class="p-2 font-medium">Activity Log</h2>
                        <p class="p-2">Manage your School Activity</p>
                    </div>
                </a>
                <a href="" class="p-10 rounded-lg items-center text-center shadow-xl hover:bg-slate-300   hover:text-gray-700">
                    <x-icon name="s-key" class="w-20 h-20" />
                    <div class=" items-center text-center">
                        <h2 class="p-2 font-medium">Permission</h2>
                        <p class="p-2">Manage Users Control</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

