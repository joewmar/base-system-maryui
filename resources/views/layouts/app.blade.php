<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="adam">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    {{-- Styles --}}
    @yield('styles')
    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Scripts --}}
    {{-- <script type="module" src="{{Vite::asset('resources/js/alert.js')}}"></script> --}}
  </head>
  <body class="font-sans antialiased">
    {{-- @auth('web') --}}
      @extends('layouts.system')
    {{-- @else
      @yield('content')
    @endauth     --}}

    {{-- Alerts  --}}
    @if (session()->has('success'))
      <script>
        window.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
              title: "Success!",
              text: "{{session('success')}}",
              icon: "success"
            });
        });
      </script>
    @elseif (session()->has('error'))
      <script>
        window.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
              title: "Something went wrong!",
              text: "{{session('error')}}",
              icon: "error",
            });
        });
      </script>
    @endif
    @yield('scripts')
    @livewireScripts
  </body>
</html>
