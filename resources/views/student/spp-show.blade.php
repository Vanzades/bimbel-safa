<!DOCTYPE html>

<html lang="{{ str_replace('\_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Detail SPP</title>

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

        .student-muted {

            color: var(--student-muted, #64748b);

        }

        .student-divider {

            border-color: var(--student-border, #e5e7eb);

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

        .spp-notice {

            border: 1px solid;

            border-radius: 1rem;

            padding: 1rem 1.25rem;

        }

        .spp-notice-unpaid {

            border-color: #fde68a;

            background: #fffbeb;

            color: #92400e;

        }

        .spp-notice-paid {

            border-color: #a7f3d0;

            background: #ecfdf5;

            color: #065f46;

        }

        .spp-notice-pending {

            border-color: #bfdbfe;

            background: #eff6ff;

            color: #1e40af;

        }

        html[data-student-theme="dark"] .spp-notice-unpaid {

            border-color: rgba(245, 158, 11, .18);

            background: rgba(245, 158, 11, .08);

            color: #fcd34d;

        }

        html[data-student-theme="dark"] .spp-notice-paid {

            border-color: rgba(16, 185, 129, .18);

            background: rgba(16, 185, 129, .08);

            color: #6ee7b7;

        }

        html[data-student-theme="dark"] .spp-notice-pending {

            border-color: rgba(59, 130, 246, .18);

            background: rgba(59, 130, 246, .08);

            color: #93c5fd;

        }

    </style>

</head>

<body class="min-h-screen antialiased">

    <x-student-sidebar />

    <div class="student-page lg:pl-64">

        <x-student-topbar :student="$student" title="Detail SPP" />

        <main class="mx-auto w-full max-w-90rem px-4 py-4 pb-10 sm:px-6 lg:px-10 lg:py-6">

            {{-- Breadcrumb --}}

            <nav

                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"

                style="color: var(--student-muted, #64748b);"

                aria-label="Breadcrumb"

            >

                <a href="{{ route('student.dashboard') }}" class="hover:opacity-75">

                    Dashboard

                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>

                <a href="{{ route('student.spp') }}" class="hover:opacity-75">

                    SPP

                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>

                <span class="font-semibold" style="color: var(--student-text, #1f2937);">

                    Detail Tagihan

                </span>

            </nav>

            {{-- Judul --}}

            <div class="mb-8 mt-8 sm:mb-10">

                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">

                    Detail Tagihan SPP

                </h1>

            </div>

            {{-- Detail tagihan --}}

            <section class="student-card overflow-hidden rounded-2xl">

                <div class="flex flex-col gap-4 border-b px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7 student-divider">

                    <div>

                        <p class="text-xs sm:text-sm font-medium student-muted">Periode</p>

                        <h2 class="mt-1 text-sm sm:text-base font-bold">{{ $sppBill->period }}</h2>

                    </div>

                    @php

                        [$statusLabel, $statusClass] = match ($sppBill->status) {

                            'paid' => ['Lunas', 'spp-badge-paid'],

                            'pending' => ['Menunggu Pembayaran', 'spp-badge-pending'],

                            'failed' => ['Gagal', 'spp-badge-failed'],

                            'expired' => ['Expired', 'spp-badge-expired'],

                            default => ['Belum Lunas', 'spp-badge-unpaid'],

                        };

                    @endphp

                    <span class="{{ $statusClass }} inline-flex w-fit rounded-md px-3 py-1.5 text-xs sm:text-sm font-semibold">

                        {{ $statusLabel }}

                    </span>

                </div>

                <div class="grid gap-x-8 gap-y-6 p-5 sm:grid-cols-2 sm:p-7 lg:grid-cols-3">

                    <div>

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">Nama Siswa</p>

                        <p class="mt-2 text-xs sm:text-sm font-medium">{{ $student->name }}</p>

                    </div>

                    <div>

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">NIS</p>

                        <p class="mt-2 text-xs sm:text-sm font-medium">{{ $student->identity_number }}</p>

                    </div>

                    <div>

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">Kelas</p>

                        <p class="mt-2 text-xs sm:text-sm font-medium">{{ $student->classRoom->name ?? '-' }}</p>

                    </div>

                    <div>

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">Jumlah Tagihan</p>

                        <p class="mt-2 text-xs sm:text-sm font-bold">

                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">Tanggal Dibuat</p>

                        <p class="mt-2 text-[11px] sm:text-xs font-medium">

                            {{ $sppBill->created_at->translatedFormat('d F Y, H:i') }}

                        </p>

                    </div>

                    <div>

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">Dibayar Pada</p>

                        <p class="mt-2 text-[11px] sm:text-xs font-medium">

                            {{ $sppBill->paid_at

                                ? $sppBill->paid_at->translatedFormat('d F Y, H:i')

                                : '-' }}

                        </p>

                    </div>

                    <div class="sm:col-span-2 lg:col-span-3">

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">

                            Referensi Pembayaran

                        </p>

                        <p class="mt-2 text-xs sm:text-sm font-medium">

                            {{ $sppBill->payment_reference ?: '-' }}

                        </p>

                    </div>

                </div>

                @if ($sppBill->notes)

                    <div class="border-t px-5 py-5 sm:px-7 student-divider">

                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wide student-muted">Catatan</p>

                        <p class="mt-2 whitespace-pre-line text-xs sm:text-sm leading-6">

                            {{ $sppBill->notes }}

                        </p>

                    </div>

                @endif

            </section>

            {{-- Informasi status --}}

            @if ($sppBill->status === 'unpaid')

                <section class="spp-notice spp-notice-unpaid mt-5">

                    <p class="text-sm sm:text-base font-semibold">Tagihan belum dibayar</p>

                    <p class="mt-1 text-xs sm:text-sm">

                        Silakan lakukan pembayaran sesuai prosedur bimbel.

                    </p>

                </section>

            @elseif ($sppBill->status === 'paid')

                <section class="spp-notice spp-notice-paid mt-5">

                    <p class="text-sm sm:text-base font-semibold">Pembayaran berhasil</p>

                    <p class="mt-1 text-xs sm:text-sm">

                        Tagihan SPP periode {{ $sppBill->period }} tercatat lunas.

                    </p>

                </section>

            @elseif ($sppBill->status === 'pending')

                <section class="spp-notice spp-notice-pending mt-5">

                    <p class="text-sm sm:text-base font-semibold">Pembayaran sedang diproses</p>

                    <p class="mt-1 text-xs sm:text-sm">

                        Status pembayaran masih menunggu konfirmasi.

                    </p>

                </section>

            @endif

        </main>

    </div>

</body>

</html>
