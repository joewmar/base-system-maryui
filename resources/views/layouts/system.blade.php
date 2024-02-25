<div class="absolute h-screen w-screen top-0 left-0 -z-50 bg-opacity-85 bg-gray-700">
    <img src="{{asset('img/sample-bg.jpg')}}" alt="" class="opacity-20 w-full h-full object-center">
</div>
<div class="grid overflow-y-hidden grid-cols-5 grid-rows-8 md:w-screen h-screen">
    @yield('top')
    <div class="col-span-5 row-span-1 size-full">
        <nav class="bg-transparent">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <button type="button" onclick="toggleMenu()"  class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" >
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
    
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
    
                            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex flex-shrink-0 items-center">
                            <img class="h-10 w-auto" src="{{asset('img/bfc-logo-white.png')}}" alt="BFC Logo">
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <button class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </button>
            
                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div>
                                <button type="button" onclick="toggleProfile()" id="profileTab" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" >
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="{{asset('img/no-avatar.jpg')}}" alt="" class="object-fill">
                                </button>
                            </div>
                
                            <div id="profileContent" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" >
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div id="sidebar" class="block bg-transparent overflow-y-auto col-span-7 md:col-span-1 row-span-11 md:row-span-9 ">
        <aside class="flex h-screen flex-col justify-between border-e ">
            <x-sidebar />
        </aside>
    </div>
    <section class=" bg-white col-span-5  md:col-span-4 row-span-8 md:row-span-9 w-full overflow-y-auto">
        <div class="h-fit m-5">
            @isset ($slot)
                {{$slot}}
            @else
                @yield('content')
            @endisset
        </div>
        {{-- <div class="py-3 flex justify-end text-gray-500">
            <div class="text-sm mx-8 ">
              <span>© <span id="year"></span>, {{env('SYSTEM_NAME', 'Brookside Group of Companies')}}. All rights reserved</span>
            </div>
        </div> --}}
        <footer class="footer footer-center p-4 bg-base-300 text-base-content">
            <aside>
                <p>© <span id="year"></span>, {{env('SYSTEM_NAME', 'Brookside Group of Companies')}}. All rights reserved</p>
            </aside>
        </footer>
    </section>
    @yield('bottom')
    <script>
        var profileContent = document.getElementById('profileContent');
        var sidebar = document.getElementById('sidebar');
        var isSidebarOpen = true;
        var isProfileTabOpen = true;

        // Define profileTab in the global scope
        function toggleProfile() {
            if (isProfileTabOpen) {
                profileContent.classList.add('block');
                profileContent.classList.remove('hidden');
            } else {
                profileContent.classList.add('hidden');
                profileContent.classList.remove('block');
            }
            isProfileTabOpen = !isProfileTabOpen;
        }
        function toggleMenu() {
            if (isSidebarOpen) {
                sidebar.classList.add('block');
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('block');
            }
            isSidebarOpen = !isSidebarOpen;
        }
    </script>
</div>