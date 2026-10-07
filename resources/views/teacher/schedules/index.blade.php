<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jadwal Mengajar - {{ config('app.name', 'GuruBimbel') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">

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

        html[data-teacher-theme="dark"] .section-icon {
            color: #93c5fd;
        }

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

        .time-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 8px;
            background: rgba(37, 99, 235, .1);
            padding: 4px 10px;
            font-weight: 600;
            color: #2563EB;
        }

        .time-chip svg {
            height: .8rem;
            width: .8rem;
        }

        html[data-teacher-theme="dark"] .time-chip {
            color: #93c5fd;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 4px 10px;
            font-weight: 600;
            line-height: 1.25;
        }

        .status-badge::before {
            content: "";
            height: 6px;
            width: 6px;
            border-radius: 999px;
            background: currentColor;
        }

        .status-active {
            background: #d1fae5;
            color: #047857;
        }

        .status-inactive {
            background: #e2e8f0;
            color: #475569;
        }

        html[data-teacher-theme="dark"] .status-active {
            background: rgba(16, 185, 129, .18);
            color: #6ee7b7;
        }

        html[data-teacher-theme="dark"] .status-inactive {
            background: rgba(148, 163, 184, .16);
            color: #cbd5e1;
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
            $dashboardUrl = \Illuminate\Support\Facades\Route::has('teacher.dashboard')
                ? route('teacher.dashboard')
                : '#';

            $th = 'whitespace-nowrap px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider sm:text-sm t-muted';
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

                <span class="font-semibold" style="color:var(--teacher-text,#1f2937)">
                    Jadwal Mengajar
                </span>
            </nav>

            {{-- Judul --}}
            <div class="mb-12 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Jadwal Mengajar
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm t-muted">
                    Lihat jadwal mengajar yang diberikan kepada Anda.
                </p>
            </div>

            {{-- Daftar jadwal --}}
            <section class="t-card rounded-2xl p-5 shadow-sm sm:p-6">
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <span class="section-icon" aria-hidden="true">
                            <svg
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                viewBox="0 0 24 24"
                            >
                                <rect x="3" y="4" width="18" height="18" rx="3"/>
                                <path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">Daftar Jadwal</h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                Jadwal mengajar berdasarkan hari, kelas, dan waktu.
                            </p>
                        </div>
                    </div>

                    <div class="t-field t-muted inline-flex h-7 w-fit items-center rounded-full px-3 text-[11px] font-medium sm:text-xs">
                        {{ $schedules->count() }} jadwal
                    </div>
                </div>

                <div class="t-divider overflow-hidden rounded-xl border">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-760px border-collapse text-left">
                            <thead class="t-head t-divider border-b">
                                <tr>
                                    <th class="{{ $th }} w-20">No</th>
                                    <th class="{{ $th }}">Mata Pelajaran</th>
                                    <th class="{{ $th }}">Kelas</th>
                                    <th class="{{ $th }}">Hari</th>
                                    <th class="{{ $th }}">Waktu</th>
                                    <th class="{{ $th }}">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($schedules as $schedule)
                                    @php
                                        $className = $schedule->classRoom?->name;
                                        $isActive = $schedule->status === 'active';
                                    @endphp

                                    <tr class="t-row t-divider border-b">
                                        <td class="{{ $td }} t-muted">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="font-semibold">
                                                {{ $schedule->subject }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            @if ($className)
                                                <span class="class-chip text-xs sm:text-sm">{{ $className }}</span>
                                            @else
                                                <span class="t-muted">-</span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap font-medium">
                                            {{ ucfirst($schedule->day) }}
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="time-chip text-xs sm:text-sm">
                                                <svg
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    viewBox="0 0 24 24"
                                                    aria-hidden="true"
                                                >
                                                    <circle cx="12" cy="12" r="9"/>
                                                    <path d="M12 7v5l3 2"/>
                                                </svg>

                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="status-badge {{ $isActive ? 'status-active' : 'status-inactive' }} text-xs sm:text-sm">
                                                {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-14 text-center">
                                            <div class="t-field t-muted mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full">
                                                <svg
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    viewBox="0 0 24 24"
                                                    aria-hidden="true"
                                                >
                                                    <rect x="3" y="4" width="18" height="18" rx="3"/>
                                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                                </svg>
                                            </div>

                                            <p class="text-xs font-medium sm:text-sm">
                                                Belum ada jadwal
                                            </p>

                                            <p class="mt-1 text-[11px] sm:text-xs t-muted">
                                                Belum ada jadwal mengajar yang diberikan kepada Anda.
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
