<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $metaDescription ?? 'Portal Layanan Sosial Terpadu Dinas Sosial Kabupaten Blitar. Ajukan layanan, sampaikan pengaduan, dan pantau status secara online.' }}">
        <meta name="author" content="Dinas Sosial Kabupaten Blitar">
        <meta name="robots" content="index, follow">

        <title>{{ $title ?? 'SAPA SOSIAL — Satu Pintu Layanan Sosial Kabupaten Blitar' }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/logo-sapa-sosial.png') }}" sizes="96x96">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="portal-body min-h-screen flex flex-col">
        {{-- Navbar --}}
        <x-portal.navbar />

        {{-- Main Content --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-portal.footer />

        {{-- Mobile Bottom Dock --}}
        <x-portal.mobile-dock />
    </body>
</html>
