<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Absensi Siswa - {{ config('app.name', 'GuruBimbel') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('image/favicon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('image/favicon-512x512.png') }}">

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

        .t-field::placeholder {
            color: var(--teacher-muted, #94a3b8);
            opacity: .8;
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

        /* Ikon judul section */
        .section-icon {
            display: inline-flex;
            height: 2rem;
            width: 2rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(37, 99, 235, .12);
            color: #2563EB;
        }

        .section-icon svg {
            height: 1rem;
            width: 1rem;
        }

        /* Inisial siswa */
        .student-initial {
            display: inline-flex;
            height: 2rem;
            width: 2rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(37, 99, 235, .12);
            color: #2563EB;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Tombol biru */
        .btn-blue {
            background-color: #2563EB;
            box-shadow: 0 3px 8px rgba(37, 99, 235, .25);
            transition: filter .15s ease, transform .15s ease;
        }

        .btn-blue:hover {
            filter: brightness(1.1);
        }

        .btn-blue:active {
            transform: translateY(1px);
        }

        .btn-blue:focus-visible {
            outline: 2px solid #93c5fd;
            outline-offset: 2px;
        }

        .select-wrap select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Alert */
        .t-success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #047857;
        }

        .t-error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        html[data-teacher-theme="dark"] .t-success {
            border-color: rgba(16, 185, 129, .18);
            background: rgba(16, 185, 129, .08);
            color: #6ee7b7;
        }

        html[data-teacher-theme="dark"] .t-error {
            border-color: rgba(239, 68, 68, .18);
            background: rgba(239, 68, 68, .08);
            color: #fca5a5;
        }

        html[data-teacher-theme="dark"] .section-icon,
        html[data-teacher-theme="dark"] .student-initial {
            color: #93c5fd;
        }
    </style>
</head>

<body
    class="min-h-screen antialiased"
    style="background-color:var(--teacher-topbar,#F6F6F6);color:var(--teacher-text,#1f2937)"
>
    <x-teacher-sidebar :teacher="$teacher" />

    <div class="min-h-screen lg:pl-64">
        <x-teacher-topbar :teacher="$teacher" />

        @php
            $activeStudents = $schedule?->classRoom?->students?->where('status', 'active') ?? collect();

            $dashboardUrl = \Illuminate\Support\Facades\Route::has('teacher.dashboard')
                ? route('teacher.dashboard')
                : '#';

            $label = 'mb-1.5 block text-[13px] font-medium sm:text-sm';
            $input = 't-field box-border h-9 w-full rounded-lg px-3 text-xs sm:text-sm outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500';
            $th = 'whitespace-nowrap px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider t-muted';
            $td = 'px-6 py-3.5 text-xs sm:text-sm';
            $tableField = 't-field box-border h-9 w-full rounded-lg px-3 text-xs sm:text-sm outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500';
            $chevron = '<span class="pointer-events-none absolute inset-y-0 right-3 flex items-center t-muted"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg></span>';
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

                <span class="font-semibold" style="color:var(--teacher-text,#1f2937)">
                    Absensi Siswa
                </span>
            </nav>

            {{-- Judul --}}
            <div class="mb-6 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Absensi Siswa
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm t-muted">
                    Kelola kehadiran siswa berdasarkan jadwal mengajar Anda.
                </p>
            </div>

            {{-- Menu absensi --}}
            <nav class="t-tabnav mb-8 flex gap-6" aria-label="Menu absensi">
                <a
                    href="{{ route('teacher.attendance.index') }}"
                    class="t-tablink t-tablink-active text-[13px] sm:text-sm"
                    aria-current="page"
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
                    class="t-tablink text-[13px] font-medium sm:text-sm"
                >
                    Rekap
                </a>
            </nav>

            @if (session('success'))
                <div class="t-success mb-6 rounded-xl px-4 py-3 text-xs font-medium sm:text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="t-error mb-6 rounded-xl px-4 py-3 text-xs sm:text-sm">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Pilih jadwal --}}
            <section class="t-card mb-6 rounded-2xl p-5 shadow-sm sm:p-6">
                <div class="mb-5 flex items-center gap-3">
                    <span class="section-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="18" rx="3"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>
                    </span>

                    <div>
                        <h2 class="text-sm font-semibold sm:text-base">Pilih Jadwal</h2>

                        <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                            Pilih jadwal dan tanggal untuk menampilkan daftar siswa.
                        </p>
                    </div>
                </div>

                <form
                    method="GET"
                    action="{{ route('teacher.attendance.index') }}"
                    class="grid gap-4 lg:grid-cols-[1fr_220px_auto] lg:items-end"
                >
                    <div>
                        <label for="schedule_id" class="{{ $label }}">Jadwal</label>

                        <div class="select-wrap relative">
                            <select
                                id="schedule_id"
                                name="schedule_id"
                                required
                                class="{{ $input }} pr-9"
                            >
                                <option value="">Pilih jadwal</option>

                                @foreach ($schedules as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(request('schedule_id') == $item->id)
                                    >
                                        {{ $item->subject }} —
                                        {{ $item->classRoom?->name ?? 'Kelas tidak tersedia' }} —
                                        {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                    </option>
                                @endforeach
                            </select>

                            {!! $chevron !!}
                        </div>
                    </div>

                    <div>
                        <label for="date" class="{{ $label }}">Tanggal</label>

                        <input
                            type="date"
                            id="date"
                            name="date"
                            value="{{ request('date', today()->format('Y-m-d')) }}"
                            required
                            class="{{ $input }}"
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn-blue inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-[13px] font-semibold text-white sm:text-sm lg:w-auto"
                    >
                        Tampilkan Siswa
                    </button>
                </form>
            </section>

            @if ($schedule)
                <section class="t-card rounded-2xl p-5 shadow-sm sm:p-6">
                    {{-- Info jadwal --}}
                    <div class="mb-6 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center gap-3">
                            <span class="section-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </span>

                            <div class="min-w-0">
                                <h2 class="truncate text-sm font-semibold sm:text-base">
                                    {{ $schedule->subject }}
                                </h2>

                                <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                    {{ $schedule->classRoom?->name ?? 'Kelas tidak tersedia' }}
                                    <span class="mx-1">·</span>
                                    {{ $schedule->day }}
                                    <span class="mx-1">·</span>
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            <span class="t-field inline-flex h-7 items-center rounded-full px-3 text-[11px] font-medium sm:text-xs">
                                {{ \Carbon\Carbon::parse(request('date', today()))->translatedFormat('d F Y') }}
                            </span>

                            <span class="t-field t-muted inline-flex h-7 items-center rounded-full px-3 text-[11px] font-medium sm:text-xs">
                                {{ $activeStudents->count() }} siswa
                            </span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('teacher.attendance.store') }}">
                        @csrf

                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                        <input
                            type="hidden"
                            name="date"
                            value="{{ request('date', today()->format('Y-m-d')) }}"
                        >

                        <div class="t-divider overflow-hidden rounded-xl border">
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-760px border-collapse text-left">
                                    <thead class="t-head t-divider border-b">
                                        <tr>
                                            <th class="{{ $th }} w-20">No</th>
                                            <th class="{{ $th }}">Siswa</th>
                                            <th class="{{ $th }} w-56">Status</th>
                                            <th class="{{ $th }}">Catatan</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($activeStudents as $student)
                                            @php
                                                $attendance = $attendances->get($student->id);
                                            @endphp

                                            <tr class="t-row t-divider border-b">
                                                <td class="{{ $td }} t-muted">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="{{ $td }}">
                                                    <div class="flex items-center gap-3">
                                                        <span class="student-initial">
                                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                                        </span>

                                                        <div class="min-w-0">
                                                            <div class="truncate font-medium">
                                                                {{ $student->name }}
                                                            </div>

                                                            <div class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                                                {{ $student->identity_number ?: '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="{{ $td }}">
                                                    <div class="select-wrap relative">
                                                        <select
                                                            name="attendance[{{ $student->id }}][status]"
                                                            class="{{ $tableField }} pr-9"
                                                        >
                                                            <option
                                                                value="present"
                                                                @selected(($attendance?->status ?? 'present') === 'present')
                                                            >
                                                                Hadir
                                                            </option>

                                                            <option
                                                                value="permission"
                                                                @selected(($attendance?->status ?? '') === 'permission')
                                                            >
                                                                Izin
                                                            </option>

                                                            <option
                                                                value="sick"
                                                                @selected(($attendance?->status ?? '') === 'sick')
                                                            >
                                                                Sakit
                                                            </option>

                                                            <option
                                                                value="absent"
                                                                @selected(($attendance?->status ?? '') === 'absent')
                                                            >
                                                                Alpa
                                                            </option>
                                                        </select>

                                                        {!! $chevron !!}
                                                    </div>
                                                </td>

                                                <td class="{{ $td }}">
                                                    <input
                                                        type="text"
                                                        name="attendance[{{ $student->id }}][notes]"
                                                        value="{{ $attendance?->notes }}"
                                                        placeholder="Catatan..."
                                                        class="{{ $tableField }}"
                                                    >
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-14 text-center">
                                                    <div class="t-field t-muted mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full">
                                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                                            <circle cx="9" cy="7" r="4"/>
                                                        </svg>
                                                    </div>

                                                    <p class="text-xs font-medium sm:text-sm">
                                                        Belum ada siswa aktif
                                                    </p>

                                                    <p class="mt-1 text-[11px] sm:text-xs t-muted">
                                                        Belum ada siswa aktif pada kelas ini.
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if ($activeStudents->count())
                            <div class="mt-5 flex justify-end">
                                <button
                                    type="submit"
                                    class="btn-blue inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-[13px] font-semibold text-white sm:w-auto sm:text-sm"
                                >
                                    Simpan Absensi
                                </button>
                            </div>
                        @endif
                    </form>
                </section>
            @endif
        </main>
    </div>
</body>
</html>
