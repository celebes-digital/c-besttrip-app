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
    <body class="bg-zinc-100 dark:bg-zinc-800">
        <main>
            {{ $slot }}
        </main>
        {{-- @livewireScripts --}}
        @filamentScripts
    </body>
</html>
