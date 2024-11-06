<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'C-Besttrip' }}</title>
        @filamentStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- @livewireStyles --}}
    </head>
    <body class="bg-white dark:bg-zinc-800">
            {{ $slot }}
        {{-- @livewireScripts --}}
        @filamentScripts
    </body>
</html>
