<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi | {{ $teacher->name }}</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .t-card {
            border: 1px solid var(--teacher-border, #e5e7eb);
            background: var(--teacher-surface, #fff);
            box-shadow: 0 4px 20px var(--teacher-shadow, rgba(15, 23, 42, .08));
        }

        .t-field {
            border: 1px solid var(--teacher-border, #e5e7eb);
            background: var(--teacher-soft, #f6f7f9);
            color: var(--teacher-text, #1f2937);
        }

        .t-field:hover {
            border-color: var(--teacher-muted, #cbd5e1);
        }

        .t-field:focus {
            background: var(--teacher-surface, #fff);
        }

        .t-muted {
            color: var(--teacher-muted, #64748b);
        }

        .t-divider {
            border-color: var(--teacher-border, #e5e7eb);
        }

        .t-head {
            background: var(--teacher-soft, #f6f7f9);
        }

        .t-row {
            transition: background-color .15s ease;
        }

        .t-row:hover {
            background: var(--teacher-hover, rgba(15, 23, 42, .045));
        }

        .t-row:last-child {
            border-bottom: 0;
        }

        /* Tab menu absensi */
        .t-tabnav {
            border-bottom: 1px solid var(--teacher-border, #e5e7eb);
        }

        .t-tablink {
            position: relative;
            padding-bottom: .75rem;
            color: var(--teacher-muted, #64748b);
            transition: color .15s ease;
        }

        .t-tablink:hover {
            color: var(--teacher-text, #1f2937);
        }

        .t-tablink-active {
            color: #2563EB;
            font-weight: 600;
        }

        .t-tablink-active:hover {
            color: #2563EB;
        }

        .t-tablink-active::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            height: 2px;
            border-radius: 2px;
            background: #2563EB;
        }

        html[data-teacher-theme="dark"] .t-tablink-active,
        html[data-teacher-theme="dark"] .t-tablink-active:hover {
            color: #93c5fd;
        }

        html[data-teacher-theme="dark"] .t-tablink-active::after {
            background: #60a5fa;
        }

        /* Kartu statistik */
        .stat-card {
            transition: transform .15s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            display: inline-flex;
            height: 2rem;
            width: 2rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .stat-icon svg {
            height: 1rem;
            width: 1rem;
        }

        .tone-total {
            color: var(--teacher-muted, #64748b);
        }

        .tone-present {
            color: #059669;
        }

        .tone-permission {
            color: #d97706;
        }

        .tone-sick {
            color: #2563eb;
        }

        .tone-absent {
            color: #dc2626;
        }

        .stat-icon.tone-total {
            background: rgba(100, 116, 139, .12);
        }

        .stat-icon.tone-present {
            background: rgba(16, 185, 129, .12);
        }

        .stat-icon.tone-permission {
            background: rgba(245, 158, 11, .14);
        }

        .stat-icon.tone-sick {
            background: rgba(37, 99, 235, .12);
        }

        .stat-icon.tone-absent {
            background: rgba(239, 68, 68, .12);
        }

        html[data-teacher-theme="dark"] .tone-present {
            color: #6ee7b7;
        }

        html[data-teacher-theme="dark"] .tone-permission {
            color: #fcd34d;
        }

        html[data-teacher-theme="dark"] .tone-sick {
            color: #93c5fd;
        }

        html[data-teacher-theme="dark"] .tone-absent {
            color: #fca5a5;
        }

        /* Chip kelas */
        .class-chip {
            display: inline-flex;
            align-items: center;
            border-radius: 8px;
            border: 1px solid var(--teacher-border, #e5e7eb);
            background: var(--teacher-soft, #f6f7f9);
            padding: 3px 10px;
            font-weight: 500;
            color: var(--teacher-text, #1f2937);
        }

        .select-wrap select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
    </style>
</head>

<body
    class="min-h-screen"
    style="background-color:var(--teacher-topbar,#F6F6F6);color:var(--teacher-text,#1f2937)"
>
    <x-teacher-sidebar :teacher="$teacher" />

    <div class="min-h-screen lg:pl-64">
        <x-teacher-topbar :teacher="$teacher" />

        @php
            $dashboardUrl = \Illuminate\Support\Facades\Route::has('teacher.dashboard')
                ? route('teacher.dashboard')
                : '#';

            $totals = [
                'present' => $recap->sum('present'),
                'permission' => $recap->sum('permission'),
                'sick' => $recap->sum('sick'),
                'absent' => $recap->sum('absent'),
                'total' => $recap->sum('total'),
            ];

            $rate = $totals['total'] > 0
                ? round(($totals['present'] / $totals['total']) * 100)
                : 0;

            $input = 't-field box-border h-9 w-full rounded-lg px-3 text-xs sm:text-sm outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500';
            $th = 'whitespace-nowrap px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
            $thCenter = 'whitespace-nowrap px-6 py-3.5 text-center text-xs sm:text-sm font-semibold uppercase tracking-wider';
            $td = 'px-6 py-4 text-xs sm:text-sm';
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pb-4 pt-4 sm:px-6 lg:px-10 lg:pb-6 lg:pt-6">
            {{-- Breadcrumb --}}
            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs t-muted"
                aria-label="Breadcrumb"
            >
                <a href="{{ $dashboardUrl }}" class="hover:opacity-85">Dashboard</a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <a href="{{ route('teacher.attendance.index') }}" class="hover:opacity-85">
                    Absensi Siswa
                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color:var(--teacher-text,#1f2937)">
                    Rekap
                </span>
            </nav>

            {{-- Judul --}}
            <div class="mb-6 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Rekap Absensi
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm t-muted">
                    Rekap kehadiran siswa berdasarkan periode dan jadwal.
                </p>
            </div>

            {{-- Menu absensi --}}
            <nav class="t-tabnav mb-8 flex gap-6" aria-label="Menu absensi">
                <a
                    href="{{ route('teacher.attendance.index') }}"
                    class="t-tablink text-[13px] font-medium sm:text-sm"
                >
                    Input
                </a>

                <a
                    href="{{ route('teacher.attendance.history') }}"
                    class="t-tablink text-[13px] font-medium sm:text-sm"
                >
                    History
                </a>

                <a
                    href="{{ route('teacher.attendance.recap') }}"
                    class="t-tablink t-tablink-active text-[13px] sm:text-sm"
                    aria-current="page"
                >
                    Rekap
                </a>
            </nav>

            {{-- Ringkasan --}}
            <section class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div class="t-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm t-muted">Total</p>

                        <span class="stat-icon tone-total">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4"/>
                                <path d="M9 5a3 3 0 0 0 6 0M9 5h6M9 12h6M9 16h4"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $totals['total'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs t-muted">Data absensi</p>
                </div>

                <div class="t-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-present">Hadir</p>

                        <span class="stat-icon tone-present">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="m8.5 12.5 2.5 2.5 4.5-5"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $totals['present'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs t-muted">{{ $rate }}% dari total</p>
                </div>

                <div class="t-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-permission">Izin</p>

                        <span class="stat-icon tone-permission">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8Z"/>
                                <path d="M14 3v5h5M9 13h6M9 17h4"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $totals['permission'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs t-muted">Izin tidak hadir</p>
                </div>

                <div class="t-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-sick">Sakit</p>

                        <span class="stat-icon tone-sick">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="4"/>
                                <path d="M12 8v8M8 12h8"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $totals['sick'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs t-muted">Tidak hadir</p>
                </div>

                <div class="t-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-absent">Alpa</p>

                        <span class="stat-icon tone-absent">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="m9 9 6 6M15 9l-6 6"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $totals['absent'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs t-muted">Tanpa keterangan</p>
                </div>
            </section>

            {{-- Filter dan tabel --}}
            <section class="t-card rounded-2xl p-5 shadow-sm sm:p-6">
                <form
                    action="{{ route('teacher.attendance.recap') }}"
                    method="GET"
                    class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between"
                >
                    <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                        <div class="relative w-full sm:w-56 sm:shrink-0">
                            <label for="start_date" class="sr-only">Dari Tanggal</label>

                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-[11px] font-medium sm:text-xs t-muted">
                                Dari
                            </span>

                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ $startDate }}"
                                onchange="this.form.requestSubmit()"
                                class="{{ $input }} pl-12"
                            >
                        </div>

                        <div class="relative w-full sm:w-60 sm:shrink-0">
                            <label for="end_date" class="sr-only">Sampai Tanggal</label>

                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-[11px] font-medium sm:text-xs t-muted">
                                Sampai
                            </span>

                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                value="{{ $endDate }}"
                                onchange="this.form.requestSubmit()"
                                class="{{ $input }} pl-16"
                            >
                        </div>

                        <div class="select-wrap relative w-full sm:w-72 sm:shrink-0">
                            <label for="schedule_id" class="sr-only">Jadwal</label>

                            <select
                                name="schedule_id"
                                id="schedule_id"
                                onchange="this.form.requestSubmit()"
                                class="{{ $input }} pr-9"
                            >
                                <option value="">Semua Jadwal</option>

                                @foreach ($schedules as $schedule)
                                    <option
                                        value="{{ $schedule->id }}"
                                        @selected(request('schedule_id') == $schedule->id)
                                    >
                                        {{ $schedule->subject }} - {{ $schedule->classRoom?->name }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center t-muted">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="t-field t-muted inline-flex h-7 w-fit items-center rounded-full px-3 text-[11px] font-medium sm:text-xs">
                        {{ $recap->count() }} siswa
                    </div>
                </form>

                <div class="t-divider overflow-hidden rounded-xl border">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-900px border-collapse text-left">
                            <thead class="t-head t-divider border-b">
                                <tr>
                                    <th class="{{ $th }} t-muted w-20">No</th>
                                    <th class="{{ $th }} t-muted">Siswa</th>
                                    <th class="{{ $th }} t-muted">Kelas</th>
                                    <th class="{{ $thCenter }} tone-present">Hadir</th>
                                    <th class="{{ $thCenter }} tone-permission">Izin</th>
                                    <th class="{{ $thCenter }} tone-sick">Sakit</th>
                                    <th class="{{ $thCenter }} tone-absent">Alpa</th>
                                    <th class="{{ $thCenter }} t-muted">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($recap as $item)
                                    <tr class="t-row t-divider border-b">
                                        <td class="{{ $td }} t-muted">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="font-medium">
                                                {{ $item['student']->name }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="class-chip text-xs sm:text-sm">
                                                {{ $item['class_room']->name }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} text-center font-semibold {{ $item['present'] > 0 ? 'tone-present' : 't-muted' }}">
                                            {{ $item['present'] }}
                                        </td>

                                        <td class="{{ $td }} text-center font-semibold {{ $item['permission'] > 0 ? 'tone-permission' : 't-muted' }}">
                                            {{ $item['permission'] }}
                                        </td>

                                        <td class="{{ $td }} text-center font-semibold {{ $item['sick'] > 0 ? 'tone-sick' : 't-muted' }}">
                                            {{ $item['sick'] }}
                                        </td>

                                        <td class="{{ $td }} text-center font-semibold {{ $item['absent'] > 0 ? 'tone-absent' : 't-muted' }}">
                                            {{ $item['absent'] }}
                                        </td>

                                        <td class="{{ $td }} text-center font-bold">
                                            {{ $item['total'] }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-14 text-center">
                                            <div class="t-field t-muted mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 5H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4M9 5a3 3 0 0 0 6 0M9 5h6"
                                                    />
                                                </svg>
                                            </div>

                                            <p class="text-xs font-medium sm:text-sm">
                                                Belum ada data absensi
                                            </p>

                                            <p class="mt-1 text-[11px] sm:text-xs t-muted">
                                                Tidak ditemukan data pada periode yang dipilih.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
