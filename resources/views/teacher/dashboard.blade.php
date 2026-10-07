@php
    use Carbon\Carbon;

    $statCards = [
        ['label' => 'Total Siswa', 'value' => $stats['students'], 'hint' => 'Siswa dari kelas yang diajar', 'icon' => 'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m16 0h4v-2a4 4 0 0 0-3-3.87M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8m7-8.13a4 4 0 0 1 0 7.75'],
        ['label' => 'Kelas', 'value' => $stats['classes'], 'hint' => 'Kelas yang terkait', 'icon' => 'M3 21h18M5 21V7l8-4v18m6 0V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01M13 9v.01M13 12v.01M13 15v.01M13 18v.01M17 14v.01M17 17v.01'],
        ['label' => 'Jadwal Aktif', 'value' => $stats['schedules'], 'hint' => 'Total jadwal mengajar', 'icon' => 'M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Z'],
    ];

    $attendanceRows = [
        ['label' => 'Hadir', 'value' => $attendanceStats['present'], 'color' => '#10b981'],
        ['label' => 'Izin', 'value' => $attendanceStats['permission'], 'color' => '#f59e0b'],
        ['label' => 'Sakit', 'value' => $attendanceStats['sick'], 'color' => '#3b82f6'],
        ['label' => 'Alpa', 'value' => $attendanceStats['absent'], 'color' => '#ef4444'],
    ];

    $presentPercent = $attendanceStats['total'] > 0
        ? round($attendanceStats['present'] / $attendanceStats['total'] * 100)
        : 0;

    // --- Logika jadwal (murni di view, tanpa ubah controller) ---
    $now = now();
    $maxVisible = 3;
    $timeFormat = 'h:i A'; // format jam AM/PM

    $sortedSchedules = $todaySchedules->sortBy('start_time')->values();

    $decorated = $sortedSchedules->map(function ($schedule) use ($now) {
        $start = Carbon::parse($schedule->start_time);
        $end = Carbon::parse($schedule->end_time);

        $schedule->ui_start = $start;
        $schedule->ui_end = $end;
        $schedule->ui_status = $now->gt($end) ? 'done' : ($now->between($start, $end) ? 'ongoing' : 'upcoming');

        return $schedule;
    });

    $currentSchedule = $decorated->firstWhere('ui_status', 'ongoing');
    $nextSchedule = $decorated->firstWhere('ui_status', 'upcoming');
    $highlight = $currentSchedule ?? $nextSchedule;

    $remaining = $decorated->where('ui_status', '!=', 'done')->values();
    $visibleSchedules = ($remaining->isNotEmpty() ? $remaining : $decorated)->take($maxVisible);
    $hiddenCount = max($decorated->count() - $visibleSchedules->count(), 0);

    // Ganti dengan nama route jadwal guru kalau berbeda
    $scheduleUrl = \Illuminate\Support\Facades\Route::has('teacher.schedules.index')
        ? route('teacher.schedules.index')
        : null;

    // Transparan supaya aman di light & dark mode
    $statusStyles = [
        'ongoing' => ['label' => 'Berlangsung', 'bar' => '#10b981', 'bg' => 'rgba(16,185,129,.14)', 'text' => '#10b981'],
        'upcoming' => ['label' => 'Berikutnya', 'bar' => '#3b82f6', 'bg' => 'rgba(59,130,246,.14)', 'text' => '#3b82f6'],
        'done' => ['label' => 'Selesai', 'bar' => 'var(--teacher-border)', 'bg' => 'var(--teacher-soft)', 'text' => 'var(--teacher-muted)'],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Guru - {{ config('app.name', 'GuruBimbel') }}</title>
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
            <section class="relative overflow-hidden rounded-2xl bg-linear-to-br from-blue-950 via-blue-900 to-indigo-900 p-4 text-white shadow-sm sm:p-5">
                <div class="pointer-events-none absolute -bottom-32 left-1/3 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -right-16 -top-20 h-56 w-56 rounded-full bg-indigo-400/20 blur-3xl"></div>

                <div class="relative grid gap-4 lg:grid-cols-[1fr_auto] lg:items-center lg:gap-6">
                    <div>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[11px] text-blue-200 sm:text-xs">
                            <span id="live-date">{{ now()->translatedFormat('l, d F Y') }}</span>

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-2.5 py-1 font-medium tabular-nums text-white ring-1 ring-inset ring-white/15">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                                <span id="live-clock">{{ now()->format('h:i:s A') }}</span>
                            </span>
                        </div>

                        <h1 class="mt-2 text-lg font-semibold tracking-tight sm:text-xl">
                            Halo, {{ \Illuminate\Support\Str::of($teacher->name)->before(' ') }}
                        </h1>

                        <p class="mt-1.5 max-w-md text-[10px] leading-relaxed text-blue-200 sm:text-[11px]">
                            Pantau kelas, siswa, dan jadwal mengajar Anda.
                        </p>

                        {{-- Banner kelas: hanya tampil kalau ada kelas berlangsung / berikutnya --}}
                        @if ($highlight)
                            <div class="mt-3 flex max-w-md items-center gap-2.5 rounded-xl bg-white/10 px-3 py-2 ring-1 ring-inset ring-white/15">
                                <span class="relative flex h-2 w-2 shrink-0">
                                    @if ($currentSchedule)
                                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                                    @endif
                                    <span class="relative inline-flex h-2 w-2 rounded-full {{ $currentSchedule ? 'bg-emerald-400' : 'bg-amber-300' }}"></span>
                                </span>

                                <div class="min-w-0">
                                    <p class="text-[10px] font-semibold sm:text-[11px]">
                                        {{ $currentSchedule ? 'Sedang berlangsung' : 'Ada kelas pukul ' . $highlight->ui_start->format($timeFormat) }}
                                    </p>
                                    <p class="truncate text-[10px] text-blue-200 sm:text-[11px]">
                                        {{ $highlight->subject }}
                                        · {{ $highlight->classRoom?->name ?? 'Kelas tidak tersedia' }}
                                        · {{ $highlight->ui_start->format($timeFormat) }}–{{ $highlight->ui_end->format($timeFormat) }}
                                    </p>
                                </div>
                            </div>
                        @endif
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
            <section class="grid grid-cols-1 gap-2.5 sm:grid-cols-3 sm:gap-3">
                @foreach ($statCards as $card)
                    <div
                        class="flex items-center gap-3 rounded-xl border p-3.5 transition hover:shadow-sm"
                        style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
                    >
                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg"
                            style="background-color:var(--teacher-soft);color:var(--teacher-text)"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="{{ $card['icon'] }}"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <p class="text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                                {{ $card['label'] }}
                            </p>
                            <p class="text-base font-bold tracking-tight tabular-nums sm:text-lg">{{ $card['value'] }}</p>
                            <p class="truncate text-[9px] sm:text-[10px]" style="color:var(--teacher-muted)">
                                {{ $card['hint'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </section>

            {{-- Jadwal dan absensi (tinggi kartu sama) --}}
            <section class="grid gap-4 xl:grid-cols-[2fr_1fr]">
                {{-- Jadwal --}}
                <div
                    class="flex flex-col overflow-hidden rounded-xl border"
                    style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
                >
                    <div class="flex items-center justify-between gap-4 px-4 py-3.5 sm:px-5">
                        <div>
                            <h2 class="text-[11px] font-bold sm:text-xs">Jadwal Hari Ini</h2>
                            <p class="text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                                Kelas yang dijadwalkan hari ini
                            </p>
                        </div>

                        <span
                            class="rounded-full px-2.5 py-1 text-[9px] font-semibold tabular-nums sm:text-[10px]"
                            style="background-color:var(--teacher-soft);color:var(--teacher-muted)"
                        >
                            {{ $todaySchedules->count() }} jadwal
                        </span>
                    </div>

                    @if ($todaySchedules->isEmpty())
                        <div
                            class="flex flex-1 flex-col items-center justify-center border-t px-4 py-10 text-center sm:px-5"
                            style="border-color:var(--teacher-border)"
                        >
                            <div
                                class="mb-3 flex h-9 w-9 items-center justify-center rounded-full"
                                style="background-color:var(--teacher-soft);color:var(--teacher-muted)"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Z"/>
                                </svg>
                            </div>
                            <p class="text-[11px] font-medium">Tidak ada jadwal hari ini.</p>
                            <p class="mt-1 text-[10px]" style="color:var(--teacher-muted)">
                                Jadwal mengajar Anda akan muncul di sini.
                            </p>
                        </div>
                    @else
                        <div class="flex-1 border-t" style="border-color:var(--teacher-border)">
                            @foreach ($visibleSchedules as $schedule)
                                @php $style = $statusStyles[$schedule->ui_status]; @endphp

                                <div
                                    class="relative flex flex-col gap-3 border-b py-3 pl-5 pr-4 last:border-b-0 sm:flex-row sm:items-center sm:justify-between sm:pl-6 sm:pr-5"
                                    style="border-color:var(--teacher-border)"
                                >
                                    <span class="absolute inset-y-3 left-0 w-1 rounded-r-full" style="background-color:{{ $style['bar'] }}"></span>

                                    <div class="min-w-0">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <p class="truncate text-[11px] font-semibold sm:text-xs {{ $schedule->ui_status === 'done' ? 'opacity-60' : '' }}">
                                                {{ $schedule->subject }}
                                            </p>
                                            <span
                                                class="rounded-full px-2 py-0.5 text-[9px] font-semibold sm:text-[10px]"
                                                style="background-color:{{ $style['bg'] }};color:{{ $style['text'] }}"
                                            >
                                                {{ $style['label'] }}
                                            </span>
                                        </div>
                                        <p class="mt-1 text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                                            {{ $schedule->classRoom?->name ?? 'Kelas tidak tersedia' }}
                                            @if ($schedule->room)
                                                <span class="mx-1">·</span>{{ $schedule->room }}
                                            @endif
                                        </p>
                                    </div>

                                    <span
                                        class="inline-flex w-fit items-center rounded-lg px-2.5 py-1.5 text-[10px] font-medium tabular-nums sm:text-[11px]"
                                        style="background-color:var(--teacher-soft);color:var(--teacher-text)"
                                    >
                                        {{ $schedule->ui_start->format($timeFormat) }} – {{ $schedule->ui_end->format($timeFormat) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        @if ($hiddenCount > 0)
                            @if ($scheduleUrl)
                                <a
                                    href="{{ $scheduleUrl }}"
                                    class="flex items-center justify-center gap-1.5 border-t px-4 py-2.5 text-[10px] font-semibold transition hover:opacity-80 sm:text-[11px]"
                                    style="border-color:var(--teacher-border);color:var(--teacher-muted)"
                                >
                                    Lihat {{ $hiddenCount }} jadwal lainnya
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 12h14m-6-6 6 6-6 6"/>
                                    </svg>
                                </a>
                            @else
                                <p class="border-t px-4 py-2.5 text-center text-[10px] sm:text-[11px]" style="border-color:var(--teacher-border);color:var(--teacher-muted)">
                                    +{{ $hiddenCount }} jadwal lainnya
                                </p>
                            @endif
                        @endif
                    @endif
                </div>

                {{-- Absensi --}}
                <div
                    class="flex flex-col overflow-hidden rounded-xl border"
                    style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
                >
                    <div class="px-4 py-3.5 sm:px-5">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-[11px] font-bold sm:text-xs">Absensi Hari Ini</h2>
                                <p class="text-[10px] sm:text-[11px]" style="color:var(--teacher-muted)">
                                    Rekap absensi dari jadwal Anda
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xl font-semibold leading-none tabular-nums sm:text-2xl">{{ $attendanceStats['total'] }}</p>
                                <p class="mt-1 text-[10px]" style="color:var(--teacher-muted)">total</p>
                            </div>
                        </div>

                        <div class="mt-3 flex items-center gap-2.5">
                            <div class="h-1.5 flex-1 overflow-hidden rounded-full" style="background-color:var(--teacher-soft)">
                                <div class="h-full rounded-full bg-emerald-500 transition-all duration-500" style="width:{{ $presentPercent }}%"></div>
                            </div>
                            <span class="text-[10px] font-semibold tabular-nums" style="color:#10b981">{{ $presentPercent }}% hadir</span>
                        </div>
                    </div>

                    <div class="flex-1 border-t" style="border-color:var(--teacher-border)">
                        @foreach ($attendanceRows as $row)
                            <div
                                class="flex items-center justify-between border-b px-4 py-3 last:border-b-0 sm:px-5"
                                style="border-color:var(--teacher-border)"
                            >
                                <div class="flex items-center gap-2.5">
                                    <span class="h-2 w-2 rounded-full" style="background-color:{{ $row['color'] }}"></span>
                                    <span class="text-[11px] sm:text-xs">{{ $row['label'] }}</span>
                                </div>
                                <span class="text-[11px] font-semibold tabular-nums sm:text-xs" style="color:{{ $row['value'] > 0 ? $row['color'] : 'var(--teacher-muted)' }}">
                                    {{ $row['value'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Informasi guru (dilipat) --}}
            <details
                class="group overflow-hidden rounded-xl border"
                style="background-color:var(--teacher-surface);border-color:var(--teacher-border)"
            >
                <summary class="flex cursor-pointer list-none items-center justify-between px-4 py-3.5 sm:px-5 [&::-webkit-details-marker]:hidden">
                    <h2 class="text-[11px] font-bold sm:text-xs">Informasi Guru</h2>
                    <svg class="h-3.5 w-3.5 transition-transform duration-200 group-open:rotate-180" style="color:var(--teacher-muted)" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </summary>

                <div class="grid gap-4 border-t p-4 sm:grid-cols-2 sm:p-5 lg:grid-cols-4" style="border-color:var(--teacher-border)">
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
                        <p class="mt-1 text-[11px] font-semibold sm:text-xs {{ $teacher->status === 'active' ? 'text-emerald-500' : '' }}" @if($teacher->status !== 'active') style="color:var(--teacher-muted)" @endif>
                            {{ $teacher->status === 'active' ? 'Aktif' : 'Tidak aktif' }}
                        </p>
                    </div>
                </div>
            </details>
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

            // Format 12 jam (AM/PM)
            const timeFormat = new Intl.DateTimeFormat('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true,
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
