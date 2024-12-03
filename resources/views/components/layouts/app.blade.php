<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'C-Besttrip - Celebes Group' }}</title>
        <meta name="description" content="{{ $metaDescription ?? 'C-Besttrip is a premier travel agency specializing in Umrah services. As part of the Celebes Group, we are dedicated to providing exceptional travel experiences for pilgrims and travelers alike. Our comprehensive services include travel planning, accommodation arrangements, and guided tours to ensure a seamless and spiritually fulfilling journey. Trust C-Besttrip for all your travel needs, and embark on a memorable Umrah pilgrimage with confidence and peace of mind.'}}">

        {{-- Favicon --}}
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- SEO Meta --}}
        <meta name="robots" content="index, follow">
        <meta name="author" content="PT. Celebes Solusi Digital">
        <meta name="keywords" content="C-Besttrip, Traveler, Travel Agency, Umrah, Umrah Agency, Travel, Travel Services, Umrah Services, Celebes Group, Travel Indonesia, Umrah Indonesia, Travel Makassar, Umrah Makassar">
        <meta name="googlebot" content="index, follow">
        <meta name="bingbot" content="index, follow">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="application-name" content="C-Besttrip">

        {{-- Open Graph / Facebook --}}
        <meta property="og:title" content="{{ $title ?? 'C-Besttrip - Celebes Group' }}">
        <meta property="og:description" content="{{ $description ?? 'C-Besttrip - Celebes Group' }}">
        <meta property="og:image" content="{{ asset('logo.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">

        {{-- Twitter --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $title ?? 'C-Besttrip - Celebes Group' }}">
        <meta name="twitter:description" content="{{ $description ?? 'C-Besttrip - Celebes Group' }}">
        <meta name="twitter:image" content="{{ asset('logo.png') }}">
        <meta name="twitter:site" content="@your_twitter_handle">
        <meta name="twitter:creator" content="@your_twitter_handle">
        
        {{-- Font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        @filamentStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>

    <body class="bg-white dark:bg-zinc-800">
        
        {{ $slot }}
            
        @filamentScripts
    </body>

</html>
