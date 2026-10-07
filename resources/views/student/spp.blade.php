<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} - SPP Siswa</title>

    {{-- Favicon Responsif --}}
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
        .tone-paid    { color: #059669; }
        .tone-unpaid  { color: #d97706; }
        .tone-pending { color: #2563eb; }

        .stat-icon.tone-total   { background: rgba(100, 116, 139, .12); }
        .stat-icon.tone-paid    { background: rgba(16, 185, 129, .12); }
        .stat-icon.tone-unpaid  { background: rgba(245, 158, 11, .14); }
        .stat-icon.tone-pending { background: rgba(37, 99, 235, .12); }

        html[data-student-theme="dark"] .tone-paid    { color: #6ee7b7; }
        html[data-student-theme="dark"] .tone-unpaid  { color: #fcd34d; }
        html[data-student-theme="dark"] .tone-pending { color: #93c5fd; }

        /* Badge status (lembut + titik penanda) */
        .spp-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 4px 10px;
            font-weight: 600;
            line-height: 1.25;
        }

        .spp-badge::before {
            content: "";
            height: 6px;
            width: 6px;
            border-radius: 999px;
            background: currentColor;
        }

        .spp-badge-paid    { background: #d1fae5; color: #047857; }
        .spp-badge-pending { background: #dbeafe; color: #1d4ed8; }
        .spp-badge-failed  { background: #fee2e2; color: #b91c1c; }
        .spp-badge-expired { background: #e2e8f0; color: #475569; }
        .spp-badge-unpaid  { background: #fef3c7; color: #b45309; }

        html[data-student-theme="dark"] .spp-badge-paid    { background: rgba(16, 185, 129, .18); color: #6ee7b7; }
        html[data-student-theme="dark"] .spp-badge-pending { background: rgba(59, 130, 246, .18); color: #93c5fd; }
        html[data-student-theme="dark"] .spp-badge-failed  { background: rgba(239, 68, 68, .18); color: #fca5a5; }
        html[data-student-theme="dark"] .spp-badge-expired { background: rgba(148, 163, 184, .16); color: #cbd5e1; }
        html[data-student-theme="dark"] .spp-badge-unpaid  { background: rgba(245, 158, 11, .18); color: #fcd34d; }

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

        /* Link Detail di tabel */
        .detail-link {
            color: #2563EB;
            transition: background-color .15s ease;
        }

        .detail-link:hover {
            background: rgba(37, 99, 235, .1);
        }

        html[data-student-theme="dark"] .detail-link {
            color: #93c5fd;
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

        <x-student-topbar :student="$student" title="SPP" />

        @php
            $isFiltering = request()->filled('status') || request()->filled('year');

            $totalBills = method_exists($sppBills, 'total') ? $sppBills->total() : $sppBills->count();

            $th = 'whitespace-nowrap px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider student-muted';
            $td = 'px-6 py-4 text-xs sm:text-sm';
            $field = 'student-field box-border h-9 w-full rounded-lg pl-3 pr-9 text-xs sm:text-[13px] outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500';
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pt-4 pb-4 sm:px-6 lg:px-10 lg:pt-6 lg:pb-6">

            {{-- Breadcrumb --}}
            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--student-muted, #64748b);"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('student.dashboard') }}" class="hover:opacity-85">Dashboard</a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--student-text, #1f2937);">SPP</span>
            </nav>

            {{-- Judul --}}
            <div class="mt-8 mb-12 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">SPP</h1>

                    <p class="mt-1.5 text-xs sm:text-sm student-muted">
                        Lihat tagihan dan riwayat pembayaran SPP kamu.
                    </p>
                </div>
            </div>

            {{-- Ringkasan --}}
            <section class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm student-muted">Total Tagihan</p>

                        <span class="stat-icon tone-total">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <path d="M3 10h18M7 15h3"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $sppStats['total'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">Semua tagihan</p>
                </div>

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-paid">Lunas</p>

                        <span class="stat-icon tone-paid">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="m8.5 12.5 2.5 2.5 4.5-5"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $sppStats['paid'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">
                        Rp {{ number_format($sppStats['paidAmount'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-unpaid">Belum Lunas</p>

                        <span class="stat-icon tone-unpaid">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $sppStats['unpaid'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">
                        Rp {{ number_format($sppStats['unpaidAmount'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="student-card stat-card rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-medium sm:text-sm tone-pending">Menunggu</p>

                        <span class="stat-icon tone-pending">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M6 3h12M6 21h12M7 3v4a5 5 0 0 0 2 4l1 1-1 1a5 5 0 0 0-2 4v4M17 3v4a5 5 0 0 1-2 4l-1 1 1 1a5 5 0 0 1 2 4v4"/>
                            </svg>
                        </span>
                    </div>

                    <p class="mt-3 text-xl font-bold sm:text-2xl">{{ $sppStats['pending'] }}</p>
                    <p class="mt-1 text-[11px] sm:text-xs student-muted">Menunggu pembayaran</p>
                </div>

            </section>

            {{-- Card besar: toolbar filter + tabel --}}
            <section class="student-card rounded-2xl p-5 shadow-sm sm:p-6">

                <form
                    method="GET"
                    action="{{ route('student.spp') }}"
                    class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between"
                >

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                        <div class="select-wrap relative w-full sm:w-56 sm:shrink-0">
                            <label for="status" class="sr-only">Status</label>

                            <select id="status" name="status" class="{{ $field }}">
                                <option value="">Semua Status</option>
                                <option value="paid" @selected(request('status') === 'paid')>Lunas</option>
                                <option value="unpaid" @selected(request('status') === 'unpaid')>Belum Lunas</option>
                                <option value="pending" @selected(request('status') === 'pending')>Menunggu Pembayaran</option>
                                <option value="failed" @selected(request('status') === 'failed')>Gagal</option>
                                <option value="expired" @selected(request('status') === 'expired')>Expired</option>
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
                                href="{{ route('student.spp') }}"
                                class="student-field inline-flex h-9 shrink-0 items-center justify-center rounded-lg px-3 text-xs font-medium transition-colors duration-150 hover:opacity-80 sm:text-[13px] student-muted"
                            >
                                Reset
                            </a>
                        @endif

                    </div>

                    <div class="student-field inline-flex h-7 w-fit items-center rounded-full px-3 text-[11px] font-medium sm:text-xs student-muted">
                        {{ $totalBills }} tagihan
                    </div>

                </form>

                <div class="student-divider overflow-hidden rounded-xl border">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-900px border-collapse text-left">

                            <thead class="student-table-head border-b student-divider">
                                <tr>
                                    <th class="{{ $th }}">Periode</th>
                                    <th class="{{ $th }}">Jumlah</th>
                                    <th class="{{ $th }}">Status</th>
                                    <th class="{{ $th }}">Dibayar</th>
                                    <th class="{{ $th }} text-right">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($sppBills as $sppBill)

                                    @php
                                        [$statusLabel, $statusClass] = match ($sppBill->status) {
                                            'paid' => ['Lunas', 'spp-badge-paid'],
                                            'pending' => ['Menunggu Pembayaran', 'spp-badge-pending'],
                                            'failed' => ['Gagal', 'spp-badge-failed'],
                                            'expired' => ['Expired', 'spp-badge-expired'],
                                            default => ['Belum Lunas', 'spp-badge-unpaid'],
                                        };
                                    @endphp

                                    <tr class="student-row border-b student-divider">

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <div class="min-w-0">
                                                <div class="truncate font-semibold">
                                                    {{ $sppBill->period }}
                                                </div>

                                                <div class="mt-0.5 text-[11px] sm:text-xs student-muted">
                                                    {{ $sppBill->created_at->translatedFormat('d F Y') }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap font-semibold">
                                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap">
                                            <span class="spp-badge {{ $statusClass }} text-xs sm:text-[13px]">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap student-muted">
                                            {{ $sppBill->paid_at
                                                ? $sppBill->paid_at->translatedFormat('d F Y, H:i')
                                                : '-' }}
                                        </td>

                                        <td class="{{ $td }} whitespace-nowrap text-right">
                                            <a
                                                href="{{ route('student.spp.show', $sppBill->id) }}"
                                                class="detail-link inline-flex h-8 items-center gap-1 rounded-lg px-3 text-xs font-semibold sm:text-[13px]"
                                            >
                                                Detail

                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path d="m9 5 7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="px-6 py-14 text-center">

                                            <div
                                                class="student-divider mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full border student-muted"
                                                style="background: var(--student-soft, #f6f7f9);"
                                            >
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                                    <path d="M3 10h18M7 15h3"/>
                                                </svg>
                                            </div>

                                            <p class="text-xs font-medium sm:text-sm">
                                                Belum ada tagihan SPP
                                            </p>

                                            <p class="mt-1 text-[11px] sm:text-xs student-muted">
                                                Tagihan SPP kamu akan muncul di halaman ini.
                                            </p>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                @if ($sppBills->hasPages())
                    <div class="mt-4">
                        {{ $sppBills->links() }}
                    </div>
                @endif

            </section>

        </main>

    </div>

</body>

</html>
