<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    @livewireStyles
    @vite(['resources/css/app.css'])

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen relative">
    {{--        @include('layouts.navigation')--}}

    <div class="sm:px-4">
        <livewire:Quiz/>
    </div>
</div>
@livewireScripts
@stack('scripts')
@vite(['resources/js/app.js'])
</body>
</html>
