<!DOCTYPE html>

<html lang="{{ str_replace('\_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Riwayat Absensi</title>

    {{-- Favicon Responsif --}}

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">

    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        .attendance-page {

            min-height: 100vh;

            background: var(--student-topbar, #F6F6F6);

            color: var(--student-text, #1f2937);

        }

        .attendance-card {

            border: 1px solid var(--student-border, #e5e7eb);

            background: var(--student-surface, #fff);

            box-shadow: 0 4px 20px var(--student-shadow, rgba(15, 23, 42, .08));

        }

        .attendance-field {

            border: 1px solid var(--student-border, #e5e7eb);

            background: var(--student-soft, #f6f7f9);

            color: var(--student-text, #1f2937);

        }

        .attendance-muted {

            color: var(--student-muted, #64748b);

        }

        .attendance-divider {

            border-color: var(--student-border, #e5e7eb);

        }

        .attendance-table-head {

            background: var(--student-soft, #f6f7f9);

        }

        .attendance-row:hover {

            background: var(--student-hover, rgba(15, 23, 42, .055));

        }

        .attendance-badge-present {

            background: #059669;

            color: #fff;

        }

        .attendance-badge-permission {

            background: #4f46e5;

            color: #fff;

        }

        .attendance-badge-sick {

            background: #d97706;

            color: #fff;

        }

        .attendance-badge-absent {

            background: #dc2626;

            color: #fff;

        }

        html[data-student-theme="dark"] .attendance-badge-present {

            background: rgba(16, 185, 129, .18);

            color: #6ee7b7;

        }

        html[data-student-theme="dark"] .attendance-badge-permission {

            background: rgba(99, 102, 241, .18);

            color: #a5b4fc;

        }

        html[data-student-theme="dark"] .attendance-badge-sick {

            background: rgba(245, 158, 11, .18);

            color: #fcd34d;

        }

        html[data-student-theme="dark"] .attendance-badge-absent {

            background: rgba(239, 68, 68, .18);

            color: #fca5a5;

        }

    </style>

</head>

<body class="min-h-screen antialiased">

    <x-student-sidebar />

    <div class="attendance-page lg:pl-64">

        <x-student-topbar :student="$student" title="Riwayat Absensi" />

        <main class="mx-auto w-full max-w-90rem space-y-5 px-4 py-4 pb-10 sm:px-6 lg:px-10 lg:py-6">

            {{-- Breadcrumb --}}

            <nav

                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"

                style="color: var(--student-muted, #64748b);"

                aria-label="Breadcrumb"

            >

                <a href="{{ route('student.dashboard') }}" class="transition hover:opacity-75">

                    Dashboard

                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>

                <span class="font-semibold" style="color: var(--student-text, #1f2937);">

                    Riwayat Absensi

                </span>

            </nav>

            {{-- Judul halaman --}}

            <div class="mb-8 mt-8 sm:mb-12">

                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">

                    Riwayat Absensi

                </h1>

                <p class="mt-1.5 text-xs sm:text-sm attendance-muted">

                    Pantau riwayat kehadiran kamu.

                </p>

            </div>

            {{-- Ringkasan Stats dengan Desain Baru --}}

            <section class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">

                @php

                    $stats = [

                        [

                            'label' => 'Total',

                            'value' => $attendanceStats['total'],

                            'color' => 'text-slate-600 dark:text-slate-400',

                            'bg' => 'bg-slate-500/10 dark:bg-slate-400/20',

                            'border' => 'border-slate-200 dark:border-slate-700/50',

                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>'

                        ],

                        [

                            'label' => 'Hadir',

                            'value' => $attendanceStats['present'],

                            'color' => 'text-emerald-600 dark:text-emerald-400',

                            'bg' => 'bg-emerald-500/10 dark:bg-emerald-500/20',

                            'border' => 'border-emerald-200 dark:border-emerald-500/20',

                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'

                        ],

                        [

                            'label' => 'Izin',

                            'value' => $attendanceStats['permission'],

                            'color' => 'text-indigo-600 dark:text-indigo-400',

                            'bg' => 'bg-indigo-500/10 dark:bg-indigo-500/20',

                            'border' => 'border-indigo-200 dark:border-indigo-500/20',

                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'

                        ],

                        [

                            'label' => 'Sakit',

                            'value' => $attendanceStats['sick'],

                            'color' => 'text-amber-600 dark:text-amber-400',

                            'bg' => 'bg-amber-500/10 dark:bg-amber-500/20',

                            'border' => 'border-amber-200 dark:border-amber-500/20',

                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>'

                        ],

                        [

                            'label' => 'Alpa',

                            'value' => $attendanceStats['absent'],

                            'color' => 'text-rose-600 dark:text-rose-400',

                            'bg' => 'bg-rose-500/10 dark:bg-rose-500/20',

                            'border' => 'border-rose-200 dark:border-rose-500/20',

                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>'

                        ],

                    ];

                @endphp

                @foreach ($stats as $stat)

                    <div class="attendance-card group relative overflow-hidden rounded-2xl p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">

                        <div class="flex items-center justify-between gap-3">

                            <div>

                                <p class="text-xs sm:text-sm font-medium attendance-muted">

                                    {{ $stat['label'] }}

                                </p>

                                <p class="mt-2 text-xs sm:text-sm font-bold tracking-tight">

                                    {{ $stat['value'] }}

                                </p>

                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $stat['bg'] }} {{ $stat['color'] }} transition-transform duration-300 group-hover:scale-110">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                                    {!! $stat['icon'] !!}

                                </svg>

                            </div>

                        </div>

                    </div>

                @endforeach

            </section>

            {{-- Filter --}}

            <section class="attendance-card overflow-hidden rounded-2xl">

                <div class="border-b px-5 py-4 sm:px-6 attendance-divider">

                    <h2 class="text-sm sm:text-base font-semibold">Filter Absensi</h2>

                </div>

                <form

                    method="GET"

                    action="{{ route('student.attendance') }}"

                    class="grid gap-5 p-5 sm:grid-cols-3 sm:p-6"

                >

                    <div>

                        <label for="status" class="mb-2 block text-[13px] sm:text-sm font-semibold attendance-muted">

                            Status

                        </label>

                        <select

                            id="status"

                            name="status"

                            class="attendance-field w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition focus:border-blue-500 focus:ring-1 focus:ring-blue-500"

                        >

                            <option value="">Semua Status</option>

                            <option value="present" @selected(request('status') === 'present')>Hadir</option>

                            <option value="permission" @selected(request('status') === 'permission')>Izin</option>

                            <option value="sick" @selected(request('status') === 'sick')>Sakit</option>

                            <option value="absent" @selected(request('status') === 'absent')>Alpa</option>

                        </select>

                    </div>

                    <div>

                        <label for="month" class="mb-2 block text-[13px] sm:text-sm font-semibold attendance-muted">

                            Bulan

                        </label>

                        <select

                            id="month"

                            name="month"

                            class="attendance-field w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition focus:border-blue-500 focus:ring-1 focus:ring-blue-500"

                        >

                            <option value="">Semua Bulan</option>

                            @foreach ([

                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',

                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',

                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',

                            ] as $number => $monthName)

                                <option

                                    value="{{ $number }}"

                                    @selected((string) request('month') === (string) $number)

                                >

                                    {{ $monthName }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label for="year" class="mb-2 block text-[13px] sm:text-sm font-semibold attendance-muted">

                            Tahun

                        </label>

                        <select

                            id="year"

                            name="year"

                            class="attendance-field w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition focus:border-blue-500 focus:ring-1 focus:ring-blue-500"

                        >

                            <option value="">Semua Tahun</option>

                            @foreach (range(now()->year, now()->year - 5) as $year)

                                <option

                                    value="{{ $year }}"

                                    @selected((string) request('year') === (string) $year)

                                >

                                    {{ $year }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="flex items-center gap-2 sm:col-span-3">

                        <button

                            type="submit"

                            class="rounded-xl bg-blue-600 px-5 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition hover:bg-blue-700"

                        >

                            Terapkan Filter

                        </button>

                        <a

                            href="{{ route('student.attendance') }}"

                            class="attendance-field rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-medium transition hover:opacity-80"

                        >

                            Reset

                        </a>

                    </div>

                </form>

            </section>

            {{-- Riwayat kehadiran --}}

            <section class="attendance-card overflow-hidden rounded-2xl">

                <div class="border-b px-5 py-4 sm:px-6 attendance-divider">

                    <h2 class="text-sm sm:text-base font-semibold">Riwayat Kehadiran</h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-xs sm:text-sm">

                        <thead class="attendance-table-head">

                            <tr class="border-b attendance-divider">

                                <th class="whitespace-nowrap px-5 py-3.5 text-xs sm:text-sm font-semibold attendance-muted sm:px-6">

                                    Tanggal

                                </th >

                                <th class="whitespace-nowrap px-5 py-3.5 text-xs sm:text-sm font-semibold attendance-muted sm:px-6">

                                    Mata Pelajaran

                                </th>

                                <th class="whitespace-nowrap px-5 py-3.5 text-xs sm:text-sm font-semibold attendance-muted sm:px-6">

                                    Status

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <!-- Baris tabel riwayat -->

                        </tbody>

                    </table>

                </div>

            </section>

        </main>

    </div>

</body>

</html>
