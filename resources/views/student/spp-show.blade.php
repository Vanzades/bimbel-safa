<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} - Detail SPP</title>

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

        html[data-student-theme="dark"] .section-icon {
            color: #93c5fd;
        }

        /* Timeline status */
        .tl-item {
            position: relative;
            padding-left: 1.5rem;
            padding-bottom: 1.25rem;
        }

        .tl-item:last-child {
            padding-bottom: 0;
        }

        .tl-item::before {
            content: "";
            position: absolute;
            left: 4px;
            top: 14px;
            bottom: -2px;
            width: 1px;
            background: var(--student-border, #e5e7eb);
        }

        .tl-item:last-child::before {
            display: none;
        }

        .tl-dot {
            position: absolute;
            left: 0;
            top: 4px;
            height: 9px;
            width: 9px;
            border-radius: 999px;
            background: #94a3b8;
            box-shadow: 0 0 0 3px var(--student-surface, #fff);
        }

        .tl-dot-blue  { background: #2563eb; }
        .tl-dot-green { background: #059669; }
        .tl-dot-amber { background: #d97706; }
        .tl-dot-red   { background: #dc2626; }

        /* Notifikasi status */
        .spp-notice {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1px solid;
            border-radius: .75rem;
            padding: .875rem 1rem;
        }

        .spp-notice-icon {
            display: inline-flex;
            height: 1.75rem;
            width: 1.75rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: rgba(255, 255, 255, .6);
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

        html[data-student-theme="dark"] .spp-notice-icon {
            background: rgba(255, 255, 255, .06);
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
    </style>
</head>

<body class="min-h-screen antialiased">

    <x-student-sidebar />

    <div class="student-page lg:pl-64">

        <x-student-topbar :student="$student" title="Detail SPP" />

        @php
            [$statusLabel, $statusClass] = match ($sppBill->status) {
                'paid' => ['Lunas', 'spp-badge-paid'],
                'pending' => ['Menunggu Pembayaran', 'spp-badge-pending'],
                'failed' => ['Gagal', 'spp-badge-failed'],
                'expired' => ['Expired', 'spp-badge-expired'],
                default => ['Belum Lunas', 'spp-badge-unpaid'],
            };

            $dotClass = match ($sppBill->status) {
                'paid' => 'tl-dot-green',
                'pending' => 'tl-dot-blue',
                'failed' => 'tl-dot-red',
                'unpaid' => 'tl-dot-amber',
                default => '',
            };

            $label = 'text-[11px] sm:text-xs font-semibold uppercase tracking-wider student-muted';
            $value = 'mt-1 text-xs sm:text-sm font-medium';
            $cell = 'student-field rounded-xl px-4 py-3';
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pt-4 pb-4 sm:px-6 lg:px-10 lg:pt-6 lg:pb-6">

            {{-- Breadcrumb --}}
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

                <a href="{{ route('student.spp') }}" class="hover:opacity-85">
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
            <div class="mt-8 mb-12 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Detail Tagihan SPP
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm student-muted">
                        Rincian tagihan SPP periode {{ $sppBill->period }}.
                    </p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Kolom kiri: informasi tagihan --}}
                <section class="student-card rounded-2xl p-5 shadow-sm sm:p-6 lg:col-span-2">

                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8Z"/>
                                <path d="M14 3v5h5M9 13h6M9 17h4"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">Informasi Tagihan</h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs student-muted">
                                Data siswa dan rincian pembayaran.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">

                        <div class="{{ $cell }}">
                            <p class="{{ $label }}">Nama Siswa</p>
                            <p class="{{ $value }}">{{ $student->name }}</p>
                        </div>

                        <div class="{{ $cell }}">
                            <p class="{{ $label }}">NIS</p>
                            <p class="{{ $value }}">{{ $student->identity_number }}</p>
                        </div>

                        <div class="{{ $cell }}">
                            <p class="{{ $label }}">Kelas</p>
                            <p class="{{ $value }}">{{ $student->classRoom->name ?? '-' }}</p>
                        </div>

                        <div class="{{ $cell }}">
                            <p class="{{ $label }}">Periode</p>
                            <p class="{{ $value }}">{{ $sppBill->period }}</p>
                        </div>

                        <div class="{{ $cell }}">
                            <p class="{{ $label }}">Tanggal Dibuat</p>
                            <p class="{{ $value }}">
                                {{ $sppBill->created_at->translatedFormat('d F Y, H:i') }}
                            </p>
                        </div>

                        <div class="{{ $cell }}">
                            <p class="{{ $label }}">Dibayar Pada</p>
                            <p class="{{ $value }}">
                                {{ $sppBill->paid_at
                                    ? $sppBill->paid_at->translatedFormat('d F Y, H:i')
                                    : '-' }}
                            </p>
                        </div>

                        <div class="{{ $cell }} sm:col-span-2">
                            <p class="{{ $label }}">Referensi Pembayaran</p>
                            <p class="{{ $value }} break-all">
                                {{ $sppBill->payment_reference ?: '-' }}
                            </p>
                        </div>

                    </div>

                    @if ($sppBill->notes)
                        <div class="student-divider mt-5 border-t pt-5">
                            <p class="{{ $label }}">Catatan</p>

                            <p class="mt-1.5 whitespace-pre-line text-xs leading-6 sm:text-sm">
                                {{ $sppBill->notes }}
                            </p>
                        </div>
                    @endif

                </section>

                {{-- Kolom kanan: ringkasan --}}
                <aside class="flex flex-col gap-6">

                    <section class="student-card rounded-2xl p-5 shadow-sm sm:p-6">

                        <p class="{{ $label }}">Jumlah Tagihan</p>

                        <p class="mt-1.5 text-lg font-bold tracking-tight sm:text-xl">
                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                        </p>

                        <div class="mt-3">
                            <span class="spp-badge {{ $statusClass }} text-xs sm:text-[13px]">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <div class="student-divider my-5 border-t"></div>

                        <p class="{{ $label }} mb-4">Riwayat Status</p>

                        <div>
                            <div class="tl-item">
                                <span class="tl-dot"></span>

                                <p class="text-xs font-semibold sm:text-sm">Tagihan dibuat</p>

                                <p class="mt-0.5 text-[11px] sm:text-xs student-muted">
                                    {{ $sppBill->created_at->translatedFormat('d F Y, H:i') }}
                                </p>
                            </div>

                            <div class="tl-item">
                                <span class="tl-dot {{ $dotClass }}"></span>

                                <p class="text-xs font-semibold sm:text-sm">
                                    {{ $sppBill->paid_at ? 'Pembayaran diterima' : $statusLabel }}
                                </p>

                                <p class="mt-0.5 text-[11px] sm:text-xs student-muted">
                                    {{ $sppBill->paid_at
                                        ? $sppBill->paid_at->translatedFormat('d F Y, H:i')
                                        : 'Belum ada pembayaran' }}
                                </p>
                            </div>
                        </div>

                    </section>

                    {{-- Informasi status --}}
                    @if ($sppBill->status === 'unpaid')

                        <section class="spp-notice spp-notice-unpaid">
                            <span class="spp-notice-icon">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </span>

                            <div>
                                <p class="text-xs font-semibold sm:text-sm">Tagihan belum dibayar</p>

                                <p class="mt-0.5 text-[11px] sm:text-xs">
                                    Silakan lakukan pembayaran sesuai prosedur bimbel.
                                </p>
                            </div>
                        </section>

                    @elseif ($sppBill->status === 'paid')

                        <section class="spp-notice spp-notice-paid">
                            <span class="spp-notice-icon">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="m8.5 12.5 2.5 2.5 4.5-5"/>
                                </svg>
                            </span>

                            <div>
                                <p class="text-xs font-semibold sm:text-sm">Pembayaran berhasil</p>

                                <p class="mt-0.5 text-[11px] sm:text-xs">
                                    Tagihan SPP periode {{ $sppBill->period }} tercatat lunas.
                                </p>
                            </div>
                        </section>

                    @elseif ($sppBill->status === 'pending')

                        <section class="spp-notice spp-notice-pending">
                            <span class="spp-notice-icon">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 3a9 9 0 1 0 9 9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </span>

                            <div>
                                <p class="text-xs font-semibold sm:text-sm">Pembayaran sedang diproses</p>

                                <p class="mt-0.5 text-[11px] sm:text-xs">
                                    Status pembayaran masih menunggu konfirmasi.
                                </p>
                            </div>
                        </section>

                    @endif

                </aside>

            </div>

        </main>

    </div>

</body>

</html>
