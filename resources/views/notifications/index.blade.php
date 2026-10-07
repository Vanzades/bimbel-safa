<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Notifikasi — {{ config('app.name', 'Bimbel Safa') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f6f7f9] text-slate-900 antialiased">

    @if (auth()->user()->isAdmin())

        <x-admin-sidebar />

        <div class="min-h-screen lg:pl-64">

            <x-admin-topbar :user="auth()->user()" />

            <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    @elseif (auth()->user()->isGuru())

        <x-teacher-sidebar :teacher="auth()->user()->teacher" />

        <div class="min-h-screen lg:pl-64">

            <x-teacher-topbar :teacher="auth()->user()->teacher" />

            <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    @else

        <x-student-sidebar />

        <div class="min-h-screen lg:pl-64">

            <x-student-topbar :student="auth()->user()->student" title="Notifikasi" />

            <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    @endif

                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-sm font-medium text-blue-600">
                            Informasi
                        </p>

                        <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                            Notifikasi
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            Informasi terbaru untuk akun kamu.
                        </p>
                    </div>

                    @if (auth()->user()->unreadNotifications()->exists())

                        <form method="POST" action="{{ route('notifications.read-all') }}">
                            @csrf

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                            >
                                Tandai semua dibaca
                            </button>
                        </form>

                    @endif

                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    @forelse ($notifications as $notification)

                        @php
                            $data = $notification->data;
                            $isUnread = is_null($notification->read_at);
                            $type = $data['type'] ?? 'info';

                            $typeClass = match ($type) {
                                'success' => 'bg-emerald-50 text-emerald-600',
                                'warning' => 'bg-amber-50 text-amber-600',
                                'danger' => 'bg-red-50 text-red-600',
                                default => 'bg-blue-50 text-blue-600',
                            };
                        @endphp

                        <div class="border-b border-slate-100 last:border-0 {{ $isUnread ? 'bg-blue-50/30' : 'bg-white' }}">

                            <div class="flex gap-4 px-5 py-5 sm:px-6">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $typeClass }}">
                                    <span class="h-2.5 w-2.5 rounded-full bg-current"></span>
                                </div>

                                <div class="min-w-0 flex-1">

                                    <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">

                                        <div>

                                            <div class="flex items-center gap-2">

                                                <h2 class="text-sm font-semibold text-slate-900">
                                                    {{ $data['title'] ?? 'Notifikasi' }}
                                                </h2>

                                                @if ($isUnread)
                                                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                                                @endif

                                            </div>

                                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                                {{ $data['message'] ?? '' }}
                                            </p>

                                        </div>

                                        <span class="shrink-0 text-xs text-slate-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>

                                    </div>

                                    @if ($isUnread)

                                        <form
                                            method="POST"
                                            action="{{ route('notifications.read', $notification->id) }}"
                                            class="mt-3"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                class="text-xs font-semibold text-blue-600 hover:text-blue-700"
                                            >
                                                Buka notifikasi
                                            </button>
                                        </form>

                                    @elseif (($data['url'] ?? '#') !== '#')

                                        <a
                                            href="{{ $data['url'] }}"
                                            class="mt-3 inline-flex text-xs font-semibold text-blue-600 hover:text-blue-700"
                                        >
                                            Buka halaman
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                <span class="text-lg">—</span>
                            </div>

                            <h2 class="mt-4 text-sm font-semibold text-slate-900">
                                Belum ada notifikasi
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Informasi baru akan muncul di sini.
                            </p>

                        </div>

                    @endforelse

                </div>

                @if ($notifications->hasPages())

                    <div class="mt-5">
                        {{ $notifications->links() }}
                    </div>

                @endif

            </main>

        </div>

</body>

</html>
