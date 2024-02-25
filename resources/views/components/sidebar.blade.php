
<div class="px-4 py-6">
    <ul class="mt-6 space-y-1">
        @foreach ($list as $module)
            @if (isset($module['sub']) && is_array($module['sub']))
                <li>
                    <details class="group [&_summary::-webkit-details-marker]:hidden">
                        {{-- <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-white hover:bg-gray-100 hover:text-gray-700 @if(isset($module['sub']) && in_array($active, $module['sub'])) bg-gray-100 text-gray-700 @endif " > --}}
                        <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-white hover:bg-gray-100 hover:text-gray-700 " >
                        <span class="text-sm font-medium"> {{$module['name']}} </span>
            
                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" >
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        </summary>
            
                        <ul class="mt-2 space-y-1 px-4">
                            @foreach ($module['sub'] as $subMod)
                                <li>
                                    <a href="{{$subMod['link']}}" class="block rounded-lg px-4 py-2 text-sm font-medium text-white hover:bg-gray-100 hover:text-gray-700" >
                                        {{$subMod['name']}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </details>
                </li>
            @else 
                <li>
                    {{-- bg-gray-100 text-gray-700  --}}
                    <a href="{{$module['link']}}" class="block rounded-lg px-4 py-2 text-sm font-medium  text-white hover:bg-gray-100 hover:text-gray-700">
                        {{$module['name']}}
                    </a>
                </li>
            @endif
        @endforeach


    </ul>
</div>