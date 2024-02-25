@extends('layouts.app')
@section('title')
	Farm Informations
@endsection
{{-- For Home tabs --}}
@section('content')
    <div class="h-full m-5 ">
        <div class="h-fit m-5">
            <div class="pt-12 w-full h-full flex flex-col space-y-10 justify-center">
                <div class="p-4 text-center font-bold text-3xl">
                    <h3>Farm Informations</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center pt-10 "> 
                    <a href="{{route('farm.information.farm')}}" class="flex flex-col p-10 rounded-lg items-center  shadow-xl hover:bg-slate-300   hover:text-gray-700">
                        <div class="w-40 h-40"><x-heroicon-m-home-modern /></div>
                        <div class="p-2 items-center text-center">
                            <h2 class="p-2 font-bold">Farm</h2>
                            <p>Manage your Farm</p>
                        </div>
                    </a>
                    {{-- <a href="{{route('farm.information.location')}}" class="p-10 items-center rounded-lg text-center shadow-xl hover:bg-slate-300   hover:text-gray-700">
                        <i class="text-6xl fa-solid fa-location-dot"></i>
                        <div class="items-center text-center">
                            <h2 class="p-2 font-bold">Location</h2>
                            <p>Manage your Location of Farm</p>
                        </div>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection