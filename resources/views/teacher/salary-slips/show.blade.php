<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Slip Gaji - {{ config('app.name', 'GuruBimbel') }}</title>

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

        .section-icon {
            display: inline-flex;
            height: 2rem;
            width: 2rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(37, 99, 235, .12);
            color: #2563eb;
        }

        .section-icon svg {
            height: 1rem;
            width: 1rem;
        }

        .income-value {
            color: #047857;
        }

        .deduction-value {
            color: #dc2626;
        }

        .net-value {
            color: #2563eb;
        }

        .detail-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            border-bottom: 1px solid var(--teacher-border, #e5e7eb);
            padding: .75rem 0;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        html[data-teacher-theme="dark"] .section-icon {
            color: #93c5fd;
        }

        html[data-teacher-theme="dark"] .income-value {
            color: #6ee7b7;
        }

        html[data-teacher-theme="dark"] .deduction-value {
            color: #fca5a5;
        }

        html[data-teacher-theme="dark"] .net-value {
            color: #93c5fd;
        }
    </style>
</head>

<body
    class="min-h-screen antialiased"
    style="background-color:var(--teacher-topbar,#F6F6F6);color:var(--teacher-text,#1f2937)"
>
    <x-teacher-sidebar :teacher="$salarySlip->teacher" />

    <div class="min-h-screen lg:pl-64">
        <x-teacher-topbar :teacher="$salarySlip->teacher" />

        @php
            $dashboardUrl = \Illuminate\Support\Facades\Route::has('teacher.dashboard')
                ? route('teacher.dashboard')
                : '#';

            $salaryUrl = route('teacher.salary-slips');
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pb-4 pt-4 sm:px-6 lg:px-10 lg:pb-6 lg:pt-6">
            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs t-muted"
                aria-label="Breadcrumb"
            >
                <a href="{{ $dashboardUrl }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <a href="{{ $salaryUrl }}" class="hover:opacity-85">
                    Penggajian
                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color:var(--teacher-text,#1f2937)">
                    Detail Slip Gaji
                </span>
            </nav>

            <div class="mb-10 mt-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Detail Slip Gaji
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm t-muted">
                        Rincian penghasilan dan potongan gaji Anda.
                    </p>
                </div>

                <a
                    href="{{ $salaryUrl }}"
                    class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 sm:text-sm"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="m12 19-7-7 7-7"/>
                    </svg>

                    Kembali
                </a>
            </div>

            <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="t-card rounded-2xl p-5">
                    <p class="text-xs font-medium t-muted">
                        Guru
                    </p>

                    <p class="mt-1 text-base font-bold">
                        {{ $salarySlip->teacher->name }}
                    </p>

                    <p class="mt-1 text-xs t-muted">
                        NIK: {{ $salarySlip->teacher->identity_number ?? '-' }}
                    </p>
                </div>

                <div class="t-card rounded-2xl p-5">
                    <p class="text-xs font-medium t-muted">
                        Periode
                    </p>

                    <p class="mt-1 text-base font-bold">
                        {{ $salarySlip->period }}
                    </p>

                    <p class="mt-1 text-xs t-muted">
                        Tanggal terbit: {{ $salarySlip->issued_at?->format('d M Y') ?? '-' }}
                    </p>
                </div>

                <div class="t-card rounded-2xl p-5">
                    <p class="text-xs font-medium t-muted">
                        Total Pendapatan
                    </p>

                    <p class="mt-1 text-lg font-bold income-value">
                        Rp {{ number_format($salarySlip->total_income, 0, ',', '.') }}
                    </p>
                </div>

                <div class="t-card rounded-2xl p-5">
                    <p class="text-xs font-medium t-muted">
                        Gaji Bersih
                    </p>

                    <p class="mt-1 text-lg font-bold net-value">
                        Rp {{ number_format($salarySlip->net_salary, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <section class="t-card rounded-2xl p-5 sm:p-6">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon">
                            <svg
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.75v18.5M17 6.5h-6a3 3 0 1 0 0 6h2a3 3 0 1 1 0 6H7"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">
                                Penerimaan
                            </h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                Rincian seluruh komponen pendapatan.
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="detail-row">
                            <div>
                                <p class="text-sm font-medium">Insentif Kehadiran</p>
                                <p class="mt-0.5 text-xs t-muted">Gaji pokok / insentif kehadiran</p>
                            </div>

                            <span class="whitespace-nowrap text-sm font-semibold income-value">
                                Rp {{ number_format($salarySlip->attendance_incentive, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm font-medium">Honor Mengajar Reguler</span>

                            <span class="whitespace-nowrap text-sm font-semibold income-value">
                                Rp {{ number_format($salarySlip->regular_teaching_honor, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm font-medium">Honor Mengajar Privat</span>

                            <span class="whitespace-nowrap text-sm font-semibold income-value">
                                Rp {{ number_format($salarySlip->private_teaching_honor, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm font-medium">Lembur</span>

                            <span class="whitespace-nowrap text-sm font-semibold income-value">
                                Rp {{ number_format($salarySlip->overtime, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm font-medium">Tunjangan Kesehatan</span>

                            <span class="whitespace-nowrap text-sm font-semibold income-value">
                                Rp {{ number_format($salarySlip->health_allowance, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm font-medium">Bonus</span>

                            <span class="whitespace-nowrap text-sm font-semibold income-value">
                                Rp {{ number_format($salarySlip->bonus, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="mt-4 flex items-center justify-between rounded-xl bg-emerald-50 px-4 py-3">
                            <span class="text-sm font-semibold text-emerald-800">
                                Total Penerimaan
                            </span>

                            <span class="text-sm font-bold text-emerald-700">
                                Rp {{ number_format($salarySlip->total_income, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </section>

                <section class="t-card rounded-2xl p-5 sm:p-6">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon">
                            <svg
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M6 11h12M8 15h8M10 19h4"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">
                                Potongan
                            </h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                Rincian seluruh komponen potongan.
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="detail-row">
                            <span class="text-sm font-medium">Potongan Pinjaman</span>

                            <span class="whitespace-nowrap text-sm font-semibold deduction-value">
                                Rp {{ number_format($salarySlip->loan_deduction, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm font-medium">Pajak Penghasilan</span>

                            <span class="whitespace-nowrap text-sm font-semibold deduction-value">
                                Rp {{ number_format($salarySlip->income_tax, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="mt-4 flex items-center justify-between rounded-xl bg-red-50 px-4 py-3">
                            <span class="text-sm font-semibold text-red-800">
                                Total Potongan
                            </span>

                            <span class="text-sm font-bold text-red-700">
                                Rp {{ number_format($salarySlip->total_deduction, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </section>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <section class="t-card rounded-2xl p-5 sm:p-6">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon">
                            <svg
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <rect x="4" y="3" width="16" height="18" rx="2"/>
                                <path stroke-linecap="round" d="M8 7h8M8 11h8M8 15h5"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">
                                Data Mengajar
                            </h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                Jumlah kegiatan mengajar pada periode ini.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="t-field rounded-xl p-4">
                            <p class="text-xs t-muted">
                                Bermain / Calistung / SD
                            </p>

                            <p class="mt-1 text-lg font-bold">
                                {{ number_format($salarySlip->play_calistung_sd_count, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="t-field rounded-xl p-4">
                            <p class="text-xs t-muted">
                                SMP
                            </p>

                            <p class="mt-1 text-lg font-bold">
                                {{ number_format($salarySlip->smp_count, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="t-field rounded-xl p-4">
                            <p class="text-xs t-muted">
                                SMA
                            </p>

                            <p class="mt-1 text-lg font-bold">
                                {{ number_format($salarySlip->sma_count, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="t-field rounded-xl p-4">
                            <p class="text-xs t-muted">
                                Privat
                            </p>

                            <p class="mt-1 text-lg font-bold">
                                {{ number_format($salarySlip->private_count, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </section>

                <section class="t-card rounded-2xl p-5 sm:p-6">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon">
                            <svg
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" d="M12 8v4l2.5 2"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">
                                Informasi Slip
                            </h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                Informasi penerbitan dan penerimaan slip gaji.
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="detail-row">
                            <span class="text-sm t-muted">Cabang</span>

                            <span class="text-right text-sm font-semibold">
                                {{ $salarySlip->teacher->branch?->name ?? '-' }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm t-muted">Dibuat oleh</span>

                            <span class="text-right text-sm font-semibold">
                                {{ $salarySlip->creator?->name ?? '-' }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="text-sm t-muted">Diterima oleh</span>

                            <span class="text-right text-sm font-semibold">
                                {{ $salarySlip->receiver?->name ?? '-' }}
                            </span>
                        </div>

                        @if ($salarySlip->notes)
                            <div class="mt-4 rounded-xl t-field p-4">
                                <p class="text-xs font-semibold">
                                    Catatan
                                </p>

                                <p class="mt-2 whitespace-pre-line text-sm leading-6 t-muted">
                                    {{ $salarySlip->notes }}
                                </p>
                            </div>
                        @endif
                    </div>
                </section>
            </div>

            <section class="t-card mt-6 rounded-2xl p-5 sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-medium t-muted">
                            Total Gaji Bersih
                        </p>

                        <p class="mt-1 text-2xl font-bold net-value sm:text-3xl">
                            Rp {{ number_format($salarySlip->net_salary, 0, ',', '.') }}
                        </p>

                        <p class="mt-1 text-xs t-muted">
                            Total penerimaan dikurangi total potongan.
                        </p>
                    </div>

                    <a
                        href="{{ $salaryUrl }}"
                        class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 sm:text-sm"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12 19-7-7 7-7"/>
                        </svg>

                        Kembali ke Penggajian
                    </a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
