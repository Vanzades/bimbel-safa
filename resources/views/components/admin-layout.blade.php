<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-favicon />

    <title>{{ config('app.name', 'Bimbel') }}{{ isset($title) ? ' - ' . $title : '' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F6F6F6] text-slate-950 antialiased">
    <x-admin-sidebar />

    <div class="lg:pl-64">
        <x-admin-topbar />

        <main class="min-h-[calc(100vh-4rem)] p-4 sm:p-6 lg:p-8">
            <div class="mx-auto w-full max-w-[1600px]">

                @if (session('success'))
                    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}

            </div>
        </main>
    </div>
</body>
</html>
