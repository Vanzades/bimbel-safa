<!DOCTYPE html>

<html lang="{{ str_replace('\_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — SPP Siswa</title>

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

        .student-row:hover {

            background: var(--student-hover, rgba(15, 23, 42, .055));

        }

        .spp-badge-paid { background: #059669; color: #fff; }

        .spp-badge-pending { background: #2563eb; color: #fff; }

        .spp-badge-failed { background: #dc2626; color: #fff; }

        .spp-badge-expired { background: #64748b; color: #fff; }

        .spp-badge-unpaid { background: #d97706; color: #fff; }

        html[data-student-theme="dark"] .spp-badge-paid {

            background: rgba(16, 185, 129, .18);

            color: #6ee7b7;

        }

        html[data-student-theme="dark"] .spp-badge-pending {

            background: rgba(59, 130, 246, .18);

            color: #93c5fd;

        }

        html[data-student-theme="dark"] .spp-badge-failed {

            background: rgba(239, 68, 68, .18);

            color: #fca5a5;

        }

        html[data-student-theme="dark"] .spp-badge-expired {

            background: rgba(148, 163, 184, .16);

            color: #cbd5e1;

        }

        html[data-student-theme="dark"] .spp-badge-unpaid {

            background: rgba(245, 158, 11, .18);

            color: #fcd34d;

        }

    </style>

</head>

<body class="min-h-screen antialiased">

    <x-student-sidebar />

    <div class="student-page lg:pl-64">

        <x-student-topbar :student="$student" title="SPP" />

        <main class="mx-auto w-full max-w-90rem px-4 py-4 pb-10 sm:px-6 lg:px-10 lg:py-6">

            {{-- Breadcrumb --}}

            <nav

                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"

                style="color: var(--student-muted, #64748b);"

                aria-label="Breadcrumb"

            >

                <a href="{{ route('student.dashboard') }}" class="hover:opacity-75">Dashboard</a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>

                <span class="font-semibold" style="color: var(--student-text, #1f2937);">SPP</span>

            </nav>

            {{-- Judul --}}

            <div class="mb-8 mt-8 sm:mb-10">

                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">SPP</h1>

                <p class="mt-1.5 text-xs sm:text-sm student-muted">

                    Lihat tagihan dan riwayat pembayaran SPP kamu.

                </p>

            </div>

            {{-- Ringkasan --}}

            <section class="mb-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                <div class="student-card rounded-2xl p-5">

                    <p class="text-xs sm:text-sm font-medium student-muted">Total Tagihan</p>

                    <p class="mt-2 text-xs sm:text-sm font-bold">{{ $sppStats['total'] }}</p>

                </div>

                <div class="student-card rounded-2xl p-5">

                    <p class="text-xs sm:text-sm font-medium text-emerald-600 dark:text-emerald-400">Lunas</p>

                    <p class="mt-2 text-xs sm:text-sm font-bold">{{ $sppStats['paid'] }}</p>

                    <p class="mt-1 text-[11px] sm:text-xs student-muted">

                        Rp {{ number_format($sppStats['paidAmount'], 0, ',', '.') }}

                    </p>

                </div>

                <div class="student-card rounded-2xl p-5">

                    <p class="text-xs sm:text-sm font-medium text-amber-600 dark:text-amber-400">Belum Lunas</p>

                    <p class="mt-2 text-xs sm:text-sm font-bold">{{ $sppStats['unpaid'] }}</p>

                    <p class="mt-1 text-[11px] sm:text-xs student-muted">

                        Rp {{ number_format($sppStats['unpaidAmount'], 0, ',', '.') }}

                    </p>

                </div>

                <div class="student-card rounded-2xl p-5">

                    <p class="text-xs sm:text-sm font-medium text-blue-600 dark:text-blue-400">Menunggu</p>

                    <p class="mt-2 text-xs sm:text-sm font-bold">{{ $sppStats['pending'] }}</p>

                </div>

            </section>

            {{-- Filter --}}

            <section class="student-card mb-5 overflow-hidden rounded-2xl">

                <div class="border-b px-5 py-4 sm:px-6 student-divider">

                    <h2 class="text-sm sm:text-base font-semibold">Filter Tagihan</h2>

                </div>

                <form

                    method="GET"

                    action="{{ route('student.spp') }}"

                    class="grid gap-5 p-5 sm:grid-cols-3 sm:p-6"

                >

                    <div>

                        <label for="status" class="mb-2 block text-[13px] sm:text-sm font-semibold student-muted">

                            Status

                        </label>

                        <select

                            id="status"

                            name="status"

                            class="student-field w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition focus:border-blue-500 focus:ring-1 focus:ring-blue-500"

                        >

                            <option value="">Semua Status</option>

                            <option value="paid" @selected(request('status') === 'paid')>Lunas</option>

                            <option value="unpaid" @selected(request('status') === 'unpaid')>Belum Lunas</option>

                            <option value="pending" @selected(request('status') === 'pending')>Menunggu Pembayaran</option>

                            <option value="failed" @selected(request('status') === 'failed')>Gagal</option>

                            <option value="expired" @selected(request('status') === 'expired')>Expired</option>

                        </select>

                    </div>

                    <div>

                        <label for="year" class="mb-2 block text-[13px] sm:text-sm font-semibold student-muted">

                            Tahun

                        </label>

                        <select

                            id="year"

                            name="year"

                            class="student-field w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition focus:border-blue-500 focus:ring-1 focus:ring-blue-500"

                        >

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

                    </div>

                    <div class="flex items-end gap-2">

                        <button

                            type="submit"

                            class="rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition hover:brightness-110"

                            style="background-color: var(--student-accent, #2563eb);"

                        >

                            Terapkan

                        </button>

                        <a

                            href="{{ route('student.spp') }}"

                            class="student-field rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-medium transition hover:opacity-80"

                        >

                            Reset

                        </a>

                    </div>

                </form>

            </section>

            {{-- Daftar tagihan --}}

            <section class="student-card overflow-hidden rounded-2xl">

                <div class="border-b px-5 py-4 sm:px-6 student-divider">

                    <h2 class="text-sm sm:text-base font-semibold">Daftar Tagihan SPP</h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-xs sm:text-sm">

                        <thead class="student-table-head">

                            <tr class="border-b student-divider">

                                <th class="whitespace-nowrap px-5 py-3.5 text-xs sm:text-sm font-semibold student-muted">Periode</th>

                                <th class="whitespace-nowrap px-5 py-3.5 text-xs sm:text-sm font-semibold student-muted">Jumlah</th>

                                <th class="whitespace-nowrap px-5 py-3.5 text-xs sm:text-sm font-semibold student-muted">Status</th>

                                <th class="whitespace-nowrap px-5 py-3.5 text-xs sm:text-sm font-semibold student-muted">Dibayar</th>

                                <th class="whitespace-nowrap px-5 py-3.5 text-right text-xs sm:text-sm font-semibold student-muted">Aksi</th>

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

                                    <td class="whitespace-nowrap px-5 py-4">

                                        <p class="font-medium">{{ $sppBill->period }}</p>

                                        <p class="mt-0.5 text-[11px] sm:text-xs student-muted">

                                            {{ $sppBill->created_at->translatedFormat('d F Y') }}

                                        </p>

                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 font-medium">

                                        Rp {{ number_format($sppBill->amount, 0, ',', '.') }}

                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">

                                        <span class="{{ $statusClass }} inline-flex rounded-md px-2.5 py-1 text-xs sm:text-sm font-semibold">

                                            {{ $statusLabel }}

                                        </span>

                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 student-muted">

                                        {{ $sppBill->paid_at

                                            ? $sppBill->paid_at->translatedFormat('d F Y, H:i')

                                            : '-' }}

                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-right">

                                        <a

                                            href="{{ route('student.spp.show', $sppBill->id) }}"

                                            class="text-xs sm:text-sm font-semibold transition hover:opacity-75"

                                            style="color: var(--student-accent, #2563eb);"

                                        >

                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="px-5 py-12 text-center">

                                        <p class="text-xs sm:text-sm font-semibold">Belum ada tagihan SPP</p>

                                        <p class="mt-1 text-[11px] sm:text-xs student-muted">

                                            Tagihan SPP kamu akan muncul di halaman ini.

                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if ($sppBills->hasPages())

                    <div class="border-t px-5 py-4 student-divider">

                        {{ $sppBills->links() }}

                    </div>

                @endif

            </section>

        </main>

    </div>

</body>

</html>
