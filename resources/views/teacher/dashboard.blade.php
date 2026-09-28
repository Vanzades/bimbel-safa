@php
    $statCards = [
        [
            'label' => 'Total Siswa',
            'value' => $stats['students'],
            'hint' => 'Siswa dari kelas yang diajar',
            'color' => 'bg-slate-900',
            'icon' => 'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m16 0h4v-2a4 4 0 0 0-3-3.87M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8m7-8.13a4 4 0 0 1 0 7.75',
        ],
        [
            'label' => 'Kelas',
            'value' => $stats['classes'],
            'hint' => 'Kelas yang terkait',
            'color' => 'bg-blue-600',
            'icon' => 'M3 21h18M5 21V7l8-4v18m6 0V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01M13 9v.01M13 12v.01M13 15v.01M13 18v.01M17 14v.01M17 17v.01',
        ],
        [
            'label' => 'Jadwal Aktif',
            'value' => $stats['schedules'],
            'hint' => 'Total jadwal mengajar',
            'color' => 'bg-emerald-600',
            'icon' => 'M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Z',
        ],
        [
            'label' => 'Jadwal Hari Ini',
            'value' => $stats['todaySchedules'],
            'hint' => 'Jadwal mengajar hari ini',
            'color' => 'bg-amber-500',
            'icon' => 'M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0',
        ],
    ];

    $attendanceCards = [
        ['label' => 'Total', 'value' => $attendanceStats['total'], 'color' => 'var(--teacher-text)'],
        ['label' => 'Hadir', 'value' => $attendanceStats['present'], 'color' => '#059669'],
        ['label' => 'Izin', 'value' => $attendanceStats['permission'], 'color' => '#d97706'],
        ['label' => 'Sakit', 'value' => $attendanceStats['sick'], 'color' => '#2563eb'],
        ['label' => 'Alpa', 'value' => $attendanceStats['absent'], 'color' => '#dc2626'],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Guru — {{ config('app.name', 'GuruBimbel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('image/favicon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('image/favicon-512x512.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen antialiased"
    style="background-color:var(--teacher-topbar,#F6F6F6);color:var(--teacher-text,#1f2937)"
>
    <x-teacher-sidebar :teacher="$teacher" />

    <div class="min-h-screen lg:pl-64">
        <x-teacher-topbar :teacher="$teacher" />

        <main class="mx-auto w-full max-w-7xl space-y-4 px-4 py-5 pb-8 sm:px-6 lg:px-8">

            {{-- Sambutan --}}
            <section class="relative overflow-hidden rounded-2xl bg-blue-950 p-4 text-white sm:p-5">
                <div class="pointer-events-none absolute -bottom-32 left-1/3 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>

                <div class="relative grid gap-4 lg:grid-cols-[1fr_auto] lg:items-center lg:gap-6">
                    <div>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[11px] text-blue-200 sm:text-xs">
                            <span id="live-date">{{ now()->translatedFormat('l, d F Y') }}</span>

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-2.5 py-1 font-medium tabular-nums text-white ring-1 ring-inset ring-white/15">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                                <span id="live-clock">{{ now()->format('H:i:s') }}</span>
                            </span>
                        </div>

                        <h1 class="mt-2 text-lg font-semibold tracking-tight sm:text-xl">
                            Halo, {{ \Illuminate\Support\Str::of($teacher->name)->before(' ') }}
                        </h1>

                        <p class="mt-1.5 max-w-md text-[10px] leading-relaxed text-blue-200 sm:text-[11px]">
                            Pantau kelas, siswa, dan jadwal mengajar Anda.
                        </p>
                    </div>

                    <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3 ring-1 ring-inset ring-white/10 sm:gap-3.5">
                        <div class="flex h-16 w-16 shrink-0 flex-col items-center justify-center rounded-full border-[5px] border-blue-400/50 sm:h-20 sm:w-20">
                            <span class="text-lg font-bold tabular-nums sm:text-xl">{{ $stats['todaySchedules'] }}</span>
                            <span class="text-[8px] text-blue-200 sm:text-[9px]">jadwal</span>
                        </div>

                        <div>
                            <p class="text-[10px] text-blue-200 sm:text-[11px]">Jadwal mengajar hari ini</p>
                            <p class="mt-0.5 text-xs font-bold tabular-nums sm:text-sm">
                                {{ $stats['todaySchedules'] }} kelas
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Statistik --}}
            <section class="grid grid-cols-2 gap-2.5 sm:gap-3 xl:grid-cols-4">
                @foreach ($statCards as $card)
                    <div
                        class="flex items-center gap-2.5 rounded-xl border p-3 transition hover:shadow-sm"
                        style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
                    >
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl {{ $card['color'] }} text-white sm:h-9 sm:w-9">
                            <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="{{ $card['icon'] }}"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <p class="text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                                {{ $card['label'] }}
                            </p>
                            <p class="text-base font-bold tracking-tight sm:text-lg">{{ $card['value'] }}</p>
                            <p class="truncate text-[9px] sm:text-[10px]" style="color:var(--teacher-muted)">
                                {{ $card['hint'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </section>

            {{-- Jadwal dan absensi --}}
            <section class="grid gap-4 xl:grid-cols-[2fr_1fr]">
                <div
                    class="self-start overflow-hidden rounded-xl border"
                    style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
                >
                    <div class="flex items-center justify-between gap-4 px-4 pb-2.5 pt-3.5 sm:px-5 sm:pt-4">
                        <div>
                            <h2 class="text-[11px] font-bold sm:text-xs">Jadwal Hari Ini</h2>
                            <p class="text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                                Kelas yang dijadwalkan hari ini
                            </p>
                        </div>

                        <span
                            class="rounded-full px-2.5 py-1 text-[9px] font-semibold sm:text-[10px]"
                            style="background-color:var(--teacher-soft);color:var(--teacher-muted)"
                        >
                            {{ $todaySchedules->count() }} jadwal
                        </span>
                    </div>

                    @if ($todaySchedules->isEmpty())
                        <div class="border-t px-4 py-8 text-center sm:px-5" style="border-color:var(--teacher-border)">
                            <p class="text-[11px] font-medium">Tidak ada jadwal hari ini.</p>
                            <p class="mt-1 text-[10px]" style="color:var(--teacher-muted)">
                                Jadwal mengajar Anda akan muncul di sini.
                            </p>
                        </div>
                    @else
                        <div class="border-t" style="border-color:var(--teacher-border)">
                            @foreach ($todaySchedules as $schedule)
                                <div
                                    class="flex flex-col gap-3 border-b px-4 py-3 last:border-b-0 sm:flex-row sm:items-center sm:justify-between sm:px-5"
                                    style="border-color:var(--teacher-border)"
                                >
                                    <div class="min-w-0">
                                        <p class="truncate text-[11px] font-semibold sm:text-xs">
                                            {{ $schedule->subject }}
                                        </p>
                                        <p class="mt-1 text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                                            {{ $schedule->classRoom?->name ?? 'Kelas tidak tersedia' }}
                                            @if ($schedule->room)
                                                <span class="mx-1">·</span>{{ $schedule->room }}
                                            @endif
                                        </p>
                                    </div>

                                    <span
                                        class="inline-flex w-fit items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-[10px] font-medium tabular-nums sm:text-[11px]"
                                        style="background-color:var(--teacher-soft);color:var(--teacher-text)"
                                    >
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        –
                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div
                    class="self-start overflow-hidden rounded-xl border"
                    style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
                >
                    <div class="border-b px-4 py-3.5 sm:px-5" style="border-color:var(--teacher-border)">
                        <h2 class="text-[11px] font-bold sm:text-xs">Absensi Hari Ini</h2>
                        <p class="text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                            Rekap absensi dari jadwal Anda
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-px" style="background-color:var(--teacher-border)">
                        @foreach ($attendanceCards as $card)
                            <div
                                @class([
                                    'p-4',
                                    'col-span-2' => $card['label'] === 'Alpa',
                                ])
                                style="background-color:var(--teacher-surface)"
                            >
                                <p class="text-[10px]" style="color:var(--teacher-muted)">
                                    {{ $card['label'] }}
                                </p>
                                <p class="mt-1.5 text-xl font-semibold tabular-nums sm:text-2xl" style="color:{{ $card['color'] }}">
                                    {{ $card['value'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Informasi guru --}}
            <section
                class="overflow-hidden rounded-xl border"
                style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
            >
                <div class="border-b px-4 py-3.5 sm:px-5" style="border-color:var(--teacher-border)">
                    <h2 class="text-[11px] font-bold sm:text-xs">Informasi Guru</h2>
                </div>

                <div class="grid gap-4 p-4 sm:grid-cols-2 sm:p-5 lg:grid-cols-4">
                    <div>
                        <p class="text-[10px]" style="color:var(--teacher-muted)">Nama</p>
                        <p class="mt-1 text-[11px] font-medium sm:text-xs">{{ $teacher->name }}</p>
                    </div>

                    <div>
                        <p class="text-[10px]" style="color:var(--teacher-muted)">NIP / Identitas</p>
                        <p class="mt-1 text-[11px] font-medium sm:text-xs">{{ $teacher->identity_number ?: '-' }}</p>
                    </div>

                    <div class="min-w-0">
                        <p class="text-[10px]" style="color:var(--teacher-muted)">Email</p>
                        <p class="mt-1 break-all text-[11px] font-medium sm:text-xs">
                            {{ $teacher->email ?: $teacher->user?->email ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[10px]" style="color:var(--teacher-muted)">Status</p>
                        <p class="mt-1 text-[11px] font-semibold sm:text-xs {{ $teacher->status === 'active' ? 'text-emerald-600' : 'text-slate-500' }}">
                            {{ $teacher->status === 'active' ? 'Aktif' : 'Tidak aktif' }}
                        </p>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        (() => {
            const dateElement = document.getElementById('live-date');
            const clockElement = document.getElementById('live-clock');

            if (!dateElement || !clockElement) return;

            const dateFormat = new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric',
            });

            const timeFormat = new Intl.DateTimeFormat('en-GB', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
            });

            const updateClock = () => {
                const current = new Date();
                dateElement.textContent = dateFormat.format(current);
                clockElement.textContent = timeFormat.format(current);
            };

            updateClock();
            setInterval(updateClock, 1000);
        })();
    </script>
</body>
</html>
