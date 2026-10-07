<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} - Absensi Siswa</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .student-page {
            min-height: 100vh;
            background: var(--student-topbar, #F6F6F6);
            color: var(--student-text, #1f2937);
        }

        .student-card {
            border: 1px solid var(--student-border, #e5e7eb);
            background: var(--student-surface, #fff);
            box-shadow: 0 4px 20px var(--student-shadow, rgba(15, 23, 42, .08));
        }

        .student-field {
            border: 1px solid var(--student-border, #e5e7eb);
            background: var(--student-soft, #f6f7f9);
            color: var(--student-text, #1f2937);
        }

        .student-muted {
            color: var(--student-muted, #64748b);
        }

        .student-divider {
            border-color: var(--student-border, #e5e7eb);
        }

        .student-table-head {
            background: var(--student-soft, #f6f7f9);
        }

        .student-row {
            transition: background-color .15s ease;
        }

        .student-row:hover {
            background: var(--student-hover, rgba(15, 23, 42, .055));
        }

        .student-row:last-child {
            border-bottom: 0;
        }

        /* Kartu statistik */
        .stat-card {
            position: relative;
            overflow: hidden;
            transition: transform .15s ease, box-shadow .15s ease;
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

        .tone-total   { color: var(--student-muted, #64748b); }
        .tone-present { color: #059669; }
        .tone-permission { color: #d97706; }
        .tone-sick    { color: #2563eb; }
        .tone-absent  { color: #dc2626; }

        .stat-icon.tone-total      { background: rgba(100, 116, 139, .12); }
        .stat-icon.tone-present    { background: rgba(16, 185, 129, .12); }
        .stat-icon.tone-permission { background: rgba(245, 158, 11, .14); }
        .stat-icon.tone-sick       { background: rgba(37, 99, 235, .12); }
        .stat-icon.tone-absent     { background: rgba(239, 68, 68, .12); }

        html[data-student-theme="dark"] .tone-present    { color: #6ee7b7; }
        html[data-student-theme="dark"] .tone-permission { color: #fcd34d; }
        html[data-student-theme="dark"] .tone-sick       { color: #93c5fd; }
        html[data-student-theme="dark"] .tone-absent     { color: #fca5a5; }

        /* Badge status (lembut + titik penanda) */
        .attendance-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 4px 10px;
            font-weight: 600;
            line-height: 1.25;
        }

        .attendance-badge::before {
            content: "";
            height: 6px;
            width: 6px;
            border-radius: 999px;
            background: currentColor;
        }

        .attendance-present    { background: #d1fae5; color: #047857; }
        .attendance-permission { background: #fef3c7; color: #b45309; }
        .attendance-sick       { background: #dbeafe; color: #1d4ed8; }
        .attendance-absent     { background: #fee2e2; color: #b91c1c; }
        .attendance-unknown    { background: var(--student-soft, #f6f7f9); color: var(--student-muted, #64748b); }

        html[data-student-theme="dark"] .attendance-present    { background: rgba(16, 185, 129, .18); color: #6ee7b7; }
        html[data-student-theme="dark"] .attendance-permission { background: rgba(245, 158, 11, .18); color: #fcd34d; }
        html[data-student-theme="dark"] .attendance-sick       { background: rgba(59, 130, 246, .18); color: #93c5fd; }
        html[data-student-theme="dark"] .attendance-absent     { background: rgba(239, 68, 68, .18); color: #fca5a5; }

        /* Chip kelas */
        .class-chip {
            display: inline-flex;
            align-items: center;
            border-radius: 8px;
            border: 1px solid var(--student-border, #e5e7eb);
            background: var(--student-soft, #f6f7f9);
            padding: 3px 10px;
            font-weight: 500;
            color: var(--student-text, #1f2937);
        }

        /* Tombol biru tetap (tidak mengikuti variabel tema) */
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
    </style>
</head>

<body class="min-h-screen antialiased">

    <x-student-sidebar />

    <div class="student-page lg:pl-64">

        <x-student-topbar :student="$student" title="Absensi" />

        @php
            $isFiltering = request()->filled('month') || request()->filled('year');

            $rate = $stats['total'] > 0
                ? round(($stats['present'] / $stats['total']) * 100)
                : 0;

            $th = 'whitespace-nowrap px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider student-muted';
            $td = 'px-6 py-4 text-xs sm:text-sm';
            $field = 'student-field box-border h-9 w-full rounded-lg pl-3 pr-9 text-xs sm:text-[13px] outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500';
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pt-4 pb-4 sm:px-6 lg:px-10 lg:pt-6 lg:pb-6">

            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--student-muted, #64748b);"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('student.dashboard') }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--student-text, #1f2937);">
                    Absensi
                </span>
            </nav>

            <div class="mt-8 mb-12 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Absensi
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm student-muted">
                        Lihat riwayat dan rekap kehadiran kamu.
                    </p>
                </div>
            </div>

            {{-- Statistik --}}
            <section class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm student-muted">Total</p>

                        <span class="stat-icon tone-total">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4"/>
                                <path d="M9 5a3 3 0 0 0 6 0M9 5h6M9 12h6M9 16h4"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $stats['total'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">Data absensi</p>
                </div>

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-present">Hadir</p>

                        <span class="stat-icon tone-present">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="m8.5 12.5 2.5 2.5 4.5-5"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $stats['present'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">{{ $rate }}% dari total</p>
                </div>

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-permission">Izin</p>

                        <span class="stat-icon tone-permission">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8Z"/>
                                <path d="M14 3v5h5M9 13h6M9 17h4"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $stats['permission'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">Izin tidak hadir</p>
                </div>

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-sick">Sakit</p>

                        <span class="stat-icon tone-sick">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="4"/>
                                <path d="M12 8v8M8 12h8"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $stats['sick'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">Tidak hadir</p>
                </div>

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-absent">Alpa</p>

                        <span class="stat-icon tone-absent">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="m9 9 6 6M15 9l-6 6"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $stats['absent'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">Tanpa keterangan</p>
                </div>

            </section>

            {{-- Card besar: toolbar filter + tabel --}}
            <section class="student-card rounded-2xl p-5 shadow-sm sm:p-6">

                <form
                    method="GET"
                    action="{{ route('student.attendance') }}"
                    class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between"
                >

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                        <div class="select-wrap relative w-full sm:w-40 sm:shrink-0">
                            <label for="month" class="sr-only">Bulan</label>

                            <select id="month" name="month" class="{{ $field }}">
                                <option value="">Semua Bulan</option>

                                @foreach ([
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ] as $monthNumber => $monthName)
                                    <option
                                        value="{{ $monthNumber }}"
                                        @selected((string) request('month') === (string) $monthNumber)
                                    >
                                        {{ $monthName }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center student-muted">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </span>
                        </div>

                        <div class="select-wrap relative w-full sm:w-36 sm:shrink-0">
                            <label for="year" class="sr-only">Tahun</label>

                            <select id="year" name="year" class="{{ $field }}">
                                <option value="">Semua Tahun</option>

                                @foreach ($years as $year)
                                    <option
                                        value="{{ $year }}"
                                        @selected((string) request('year') === (string) $year)
                                    >
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center student-muted">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </span>
                        </div>

                        <button
                            type="submit"
                            class="btn-blue inline-flex h-9 w-full shrink-0 items-center justify-center rounded-lg px-4 text-xs font-semibold text-white sm:w-auto sm:text-[13px]"
                        >
                            Terapkan
                        </button>

                        @if ($isFiltering)
                            <a
                                href="{{ route('student.attendance') }}"
                                class="student-field inline-flex h-9 shrink-0 items-center justify-center rounded-lg px-3 text-xs font-medium transition-colors duration-150 hover:opacity-80 sm:text-[13px] student-muted"
                            >
                                Reset
                            </a>
                        @endif

                    </div>

                    <div
                        class="student-field inline-flex h-7 w-fit items-center rounded-full px-3 text-[11px] font-medium sm:text-xs student-muted"
                    >
                        {{ $attendances->count() }} data
                    </div>

                </form>

                <div class="student-divider overflow-hidden rounded-xl border">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-900px border-collapse text-left">

                            <thead class="student-table-head border-b student-divider">
                                <tr>
                                    <th class="{{ $th }}">Tanggal</th>
                                    <th class="{{ $th }}">Mata Pelajaran</th>
                                    <th class="{{ $th }}">Kelas</th>
                                    <th class="{{ $th }}">Status</th>
                                    <th class="{{ $th }}">Catatan</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($attendances as $attendance)

                                    @php
                                        [$statusLabel, $statusClass] = match ($attendance->status) {
                                            'present' => ['Hadir', 'attendance-badge attendance-present'],
                                            'permission' => ['Izin', 'attendance-badge attendance-permission'],
                                            'sick' => ['Sakit', 'attendance-badge attendance-sick'],
                                            'absent' => ['Alpa', 'attendance-badge attendance-absent'],
                                            default => ['Tidak Diketahui', 'attendance-badge attendance-unknown'],
                                        };

                                        $className = $attendance->schedule?->classRoom?->name;
                                    @endphp

                                    <tr class="student-row border-b student-divider">

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <div class="min-w-0">
                                                <div class="truncate font-semibold">
                                                    {{ $attendance->date->translatedFormat('d F Y') }}
                                                </div>

                                                <div class="mt-0.5 text-[11px] sm:text-xs student-muted">
                                                    {{ $attendance->date->translatedFormat('l') }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="font-medium">
                                                {{ $attendance->schedule?->subject ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            @if ($className)
                                                <span class="class-chip text-xs sm:text-[13px]">{{ $className }}</span>
                                            @else
                                                <span class="student-muted">-</span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="{{ $statusClass }} text-xs sm:text-[13px]">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} max-w-xs student-muted">
                                            {{ $attendance->notes ?: '-' }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="px-6 py-14 text-center">

                                            <div
                                                class="student-divider mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full border student-muted"
                                                style="background: var(--student-soft, #f6f7f9);"
                                            >
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 5H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4M9 5a3 3 0 0 0 6 0M9 5h6"/>
                                                </svg>
                                            </div>

                                            <p class="text-xs font-medium sm:text-sm">
                                                Belum ada data absensi
                                            </p>

                                            <p class="mt-1 text-[11px] sm:text-xs student-muted">
                                                Data kehadiran kamu akan muncul setelah guru melakukan absensi.
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
