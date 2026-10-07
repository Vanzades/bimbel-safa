<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Absensi | {{ $teacher->name }}</title>
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

        /* Badge status */
        .att-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 4px 10px;
            font-weight: 600;
            line-height: 1.25;
        }

        .att-badge::before {
            content: "";
            height: 6px;
            width: 6px;
            border-radius: 999px;
            background: currentColor;
        }

        .att-present {
            background: #d1fae5;
            color: #047857;
        }

        .att-permission {
            background: #fef3c7;
            color: #b45309;
        }

        .att-sick {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .att-absent {
            background: #fee2e2;
            color: #b91c1c;
        }

        .att-unknown {
            background: var(--teacher-soft, #f6f7f9);
            color: var(--teacher-muted, #64748b);
        }

        html[data-teacher-theme="dark"] .att-present {
            background: rgba(16, 185, 129, .18);
            color: #6ee7b7;
        }

        html[data-teacher-theme="dark"] .att-permission {
            background: rgba(245, 158, 11, .18);
            color: #fcd34d;
        }

        html[data-teacher-theme="dark"] .att-sick {
            background: rgba(59, 130, 246, .18);
            color: #93c5fd;
        }

        html[data-teacher-theme="dark"] .att-absent {
            background: rgba(239, 68, 68, .18);
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

        html[data-teacher-theme="dark"] .student-initial {
            color: #93c5fd;
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

            $input = 't-field box-border h-9 w-full rounded-lg px-3 text-xs sm:text-sm outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500';
            $th = 'whitespace-nowrap px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider t-muted';
            $td = 'px-6 py-4 text-xs sm:text-sm';

            $statusMap = [
                'present' => ['Hadir', 'att-present'],
                'permission' => ['Izin', 'att-permission'],
                'sick' => ['Sakit', 'att-sick'],
                'absent' => ['Alpa', 'att-absent'],
            ];
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
                    Riwayat
                </span>
            </nav>

            {{-- Judul --}}
            <div class="mb-6 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Riwayat Absensi
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm t-muted">
                    Lihat data absensi siswa berdasarkan tanggal dan jadwal.
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
                    class="t-tablink t-tablink-active text-[13px] sm:text-sm"
                    aria-current="page"
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

            {{-- Card filter dan tabel --}}
            <section class="t-card rounded-2xl p-5 shadow-sm sm:p-6">
                <form
                    id="history-filter"
                    action="{{ route('teacher.attendance.history') }}"
                    method="GET"
                    class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between"
                >
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div class="w-full sm:w-44 sm:shrink-0">
                            <label for="date" class="sr-only">Tanggal</label>

                            <input
                                type="date"
                                name="date"
                                id="date"
                                value="{{ request('date') }}"
                                onchange="this.form.requestSubmit()"
                                class="{{ $input }}"
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

                                @foreach ($schedules as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(request('schedule_id') == $item->id)
                                    >
                                        {{ $item->subject }} - {{ $item->classRoom?->name }}
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
                        {{ $attendances->count() }} data
                    </div>
                </form>

                <div class="t-divider overflow-hidden rounded-xl border">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-900px border-collapse text-left">
                            <thead class="t-head t-divider border-b">
                                <tr>
                                    <th class="{{ $th }}">Tanggal</th>
                                    <th class="{{ $th }}">Jadwal</th>
                                    <th class="{{ $th }}">Kelas</th>
                                    <th class="{{ $th }}">Siswa</th>
                                    <th class="{{ $th }}">Status</th>
                                    <th class="{{ $th }}">Catatan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($attendances as $attendance)
                                    @php
                                        [$statusLabel, $statusClass] = $statusMap[$attendance->status]
                                            ?? ['Tidak Diketahui', 'att-unknown'];

                                        $className = $attendance->schedule?->classRoom?->name;
                                    @endphp

                                    <tr class="t-row t-divider border-b">
                                        <td class="{{ $td }} whitespace-nowrap">
                                            <div class="min-w-0">
                                                <div class="truncate font-semibold">
                                                    {{ $attendance->date->translatedFormat('d F Y') }}
                                                </div>

                                                <div class="mt-0.5 text-[11px] sm:text-xs t-muted">
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
                                                <span class="class-chip text-xs sm:text-sm">
                                                    {{ $className }}
                                                </span>
                                            @else
                                                <span class="t-muted">-</span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <span class="student-initial">
                                                    {{ strtoupper(substr($attendance->student?->name ?? '-', 0, 1)) }}
                                                </span>

                                                <span class="font-medium">
                                                    {{ $attendance->student?->name ?? '-' }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="att-badge {{ $statusClass }} text-xs sm:text-sm">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} max-w-xs t-muted">
                                            {{ $attendance->notes ?: '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-14 text-center">
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
                                                Coba ubah tanggal atau jadwal, atau input absensi terlebih dahulu.
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
