<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Penggajian - {{ config('app.name', 'GuruBimbel') }}</title>

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

        .stat-icon {
            display: inline-flex;
            height: 2.25rem;
            width: 2.25rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(37, 99, 235, .12);
            color: #2563eb;
        }

        .stat-icon svg {
            height: 1.1rem;
            width: 1.1rem;
        }

        .salary-positive {
            color: #047857;
        }

        .salary-negative {
            color: #dc2626;
        }

        .salary-net {
            color: #2563eb;
        }

        html[data-teacher-theme="dark"] .stat-icon {
            color: #93c5fd;
        }

        html[data-teacher-theme="dark"] .salary-positive {
            color: #6ee7b7;
        }

        html[data-teacher-theme="dark"] .salary-negative {
            color: #fca5a5;
        }

        html[data-teacher-theme="dark"] .salary-net {
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
            $dashboardUrl = \Illuminate\Support\Facades\Route::has('teacher.dashboard')
                ? route('teacher.dashboard')
                : '#';

            $th = 'whitespace-nowrap px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider sm:text-sm t-muted';
            $td = 'px-6 py-4 text-xs sm:text-sm';
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pb-4 pt-4 sm:px-6 lg:px-10 lg:pb-6 lg:pt-6">
            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs t-muted"
                aria-label="Breadcrumb"
            >
                <a href="{{ $dashboardUrl }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color:var(--teacher-text,#1f2937)">
                    Penggajian
                </span>
            </nav>

            <div class="mb-10 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Penggajian
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm t-muted">
                    Lihat riwayat dan rincian slip gaji yang telah diterbitkan untuk Anda.
                </p>
            </div>

            <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="t-card rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                        <span class="stat-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>
                                <path stroke-linecap="round" d="M8 7h8M8 11h8M8 15h5"/>
                            </svg>
                        </span>

                        <div>
                            <p class="text-xs font-medium t-muted">
                                Total Slip
                            </p>

                            <p class="mt-1 text-xl font-bold">
                                {{ $totalSlips }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="t-card rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                        <span class="stat-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.75v18.5M17 6.5h-6a3 3 0 1 0 0 6h2a3 3 0 1 1 0 6H7"/>
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <p class="text-xs font-medium t-muted">
                                Total Pendapatan
                            </p>

                            <p class="mt-1 truncate text-lg font-bold salary-positive sm:text-xl">
                                Rp {{ number_format($totalIncome, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="t-card rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                        <span class="stat-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M6 11h12M8 15h8M10 19h4"/>
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <p class="text-xs font-medium t-muted">
                                Total Potongan
                            </p>

                            <p class="mt-1 truncate text-lg font-bold salary-negative sm:text-xl">
                                Rp {{ number_format($totalDeduction, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="t-card rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                        <span class="stat-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M12 3v18"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m7 7 5-4 5 4M7 17l5 4 5-4"/>
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <p class="text-xs font-medium t-muted">
                                Total Gaji Bersih
                            </p>

                            <p class="mt-1 truncate text-lg font-bold salary-net sm:text-xl">
                                Rp {{ number_format($totalNetSalary, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <section class="t-card overflow-hidden rounded-2xl">
                <div class="border-b t-divider px-5 py-5 sm:px-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">
                                Riwayat Penggajian
                            </h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs t-muted">
                                Daftar slip gaji yang telah diterbitkan untuk Anda.
                            </p>
                        </div>

                        <div class="t-field t-muted inline-flex h-7 w-fit items-center rounded-full px-3 text-[11px] font-medium sm:text-xs">
                            {{ $salarySlips->total() }} slip
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px] border-collapse text-left">
                        <thead class="t-head border-b t-divider">
                            <tr>
                                <th class="{{ $th }}">No</th>
                                <th class="{{ $th }}">Periode</th>
                                <th class="{{ $th }}">Tanggal Terbit</th>
                                <th class="{{ $th }} text-right">Pendapatan</th>
                                <th class="{{ $th }} text-right">Potongan</th>
                                <th class="{{ $th }} text-right">Gaji Bersih</th>
                                <th class="{{ $th }} text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($salarySlips as $salarySlip)
                                <tr class="t-row border-b t-divider">
                                    <td class="{{ $td }} t-muted">
                                        {{ $salarySlips->firstItem() + $loop->index }}
                                    </td>

                                    <td class="{{ $td }} whitespace-nowrap">
                                        <span class="font-semibold">
                                            {{ $salarySlip->period }}
                                        </span>
                                    </td>

                                    <td class="{{ $td }} whitespace-nowrap t-muted">
                                        {{ $salarySlip->issued_at?->format('d M Y') ?? '-' }}
                                    </td>

                                    <td class="{{ $td }} whitespace-nowrap text-right font-medium salary-positive">
                                        Rp {{ number_format($salarySlip->total_income, 0, ',', '.') }}
                                    </td>

                                    <td class="{{ $td }} whitespace-nowrap text-right font-medium salary-negative">
                                        Rp {{ number_format($salarySlip->total_deduction, 0, ',', '.') }}
                                    </td>

                                    <td class="{{ $td }} whitespace-nowrap text-right font-bold salary-net">
                                        Rp {{ number_format($salarySlip->net_salary, 0, ',', '.') }}
                                    </td>

                                    <td class="{{ $td }} whitespace-nowrap text-right">
                                        <a
                                            href="{{ route('teacher.salary-slips.show', $salarySlip) }}"
                                            class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 sm:text-sm"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                                                <circle cx="12" cy="12" r="2.5"/>
                                            </svg>

                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-14 text-center">
                                        <div class="t-field t-muted mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full">
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>
                                                <path stroke-linecap="round" d="M8 8h8M8 12h8M8 16h5"/>
                                            </svg>
                                        </div>

                                        <p class="text-xs font-medium sm:text-sm">
                                            Belum ada slip gaji
                                        </p>

                                        <p class="mt-1 text-[11px] sm:text-xs t-muted">
                                            Slip gaji Anda akan tampil di halaman ini setelah diterbitkan.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($salarySlips->hasPages())
                    <div class="border-t t-divider px-5 py-4 sm:px-6">
                        {{ $salarySlips->links() }}
                    </div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>