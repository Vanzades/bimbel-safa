<x-super-admin-layout title="Slip Gaji Guru">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between print:hidden">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('super-admin.salary-slips.index') }}" class="hover:text-blue-600">
                        Penggajian Guru
                    </a>
                    <span>/</span>
                    <span>Slip Gaji</span>
                </div>

            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                Slip Gaji
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Detail penggajian {{ $salarySlip->teacher->name }}.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('super-admin.salary-slips.edit', $salarySlip) }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                Edit
            </a>

            <button type="button"
                    onclick="window.print()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9V2h12v7"/>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                    <path d="M6 14h12v8H6z"/>
                </svg>
                Cetak Slip
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 print:hidden">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm print:border-0 print:shadow-none">
        <div class="p-8 sm:p-10">
            <div class="flex flex-col gap-6 border-b-2 border-slate-900 pb-6 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">
                        Bimbel Safa
                    </p>

                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        SLIP GAJI
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Periode {{ $salarySlip->period }}
                    </p>
                </div>

                <div class="sm:text-right">
                    <p class="text-sm text-slate-500">
                        Tanggal
                    </p>

                    <p class="mt-1 text-base font-semibold text-slate-900">
                        {{ $salarySlip->issued_at?->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>

            <div class="grid gap-4 border-b border-slate-200 py-6 sm:grid-cols-3">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        NIK
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        {{ $salarySlip->teacher->identity_number ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Nama
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        {{ $salarySlip->teacher->name }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Jabatan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        Pengajar
                    </p>
                </div>
            </div>

            <div class="grid gap-8 py-6 md:grid-cols-2">
                <div>
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-900">
                            Penerimaan
                        </h3>

                        <span class="rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                            Penerimaan
                        </span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">Gaji Pokok (Insentif Kehadiran)</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->attendance_incentive, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">Honor Mengajar Reguler</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->regular_teaching_honor, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">Honor Mengajar Privat</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->private_teaching_honor, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">Uang Lembur</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->overtime, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">Tunjangan Kesehatan</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->health_allowance, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">Bonus</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->bonus, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="border-t border-slate-200 pt-3">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm font-bold text-slate-900">
                                    Total Penerimaan
                                </span>

                                <span class="text-base font-bold text-emerald-600">
                                    Rp {{ number_format($salarySlip->total_income, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-900">
                            Potongan
                        </h3>

                        <span class="rounded-lg bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                            Potongan
                        </span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">Pinjaman</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->loan_deduction, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between gap-4 text-sm">
                            <span class="text-slate-600">PPh 21</span>
                            <span class="font-medium text-slate-900">
                                Rp {{ number_format($salarySlip->income_tax, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="border-t border-slate-200 pt-3">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm font-bold text-slate-900">
                                    Total Potongan
                                </span>

                                <span class="text-base font-bold text-red-600">
                                    Rp {{ number_format($salarySlip->total_deduction, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl bg-slate-900 p-5">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Gaji Bersih
                            </p>

                            <p class="mt-2 text-2xl font-bold text-white">
                                Rp {{ number_format($salarySlip->net_salary, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-200 pt-6">
                <h3 class="text-sm font-bold text-slate-900">
                    Keterangan
                </h3>

                <div class="mt-4 overflow-hidden rounded-xl border border-slate-200">
                    <table class="min-w-full text-sm">
                        <tbody class="divide-y divide-slate-200">
                            <tr>
                                <td class="bg-slate-50 px-4 py-3 font-medium text-slate-600">
                                    Kelas Bermain, Calistung dan SD
                                </td>

                                <td class="px-4 py-3 text-right font-semibold text-slate-900">
                                    {{ number_format($salarySlip->play_calistung_sd_count, 0, ',', '.') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-slate-50 px-4 py-3 font-medium text-slate-600">
                                    Kelas SMP
                                </td>

                                <td class="px-4 py-3 text-right font-semibold text-slate-900">
                                    {{ number_format($salarySlip->smp_count, 0, ',', '.') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-slate-50 px-4 py-3 font-medium text-slate-600">
                                    Kelas SMA
                                </td>

                                <td class="px-4 py-3 text-right font-semibold text-slate-900">
                                    {{ number_format($salarySlip->sma_count, 0, ',', '.') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-slate-50 px-4 py-3 font-medium text-slate-600">
                                    Kelas Privat
                                </td>

                                <td class="px-4 py-3 text-right font-semibold text-slate-900">
                                    {{ number_format($salarySlip->private_count, 2, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if ($salarySlip->notes)
                    <div class="mt-4 rounded-xl bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Catatan
                        </p>

                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-600">
                            {{ $salarySlip->notes }}
                        </p>
                    </div>
                @endif
            </div>

            <div class="mt-10 grid gap-10 border-t border-slate-200 pt-8 sm:grid-cols-2">
                <div>
                    <p class="text-sm text-slate-500">
                        Dibuat oleh
                    </p>

                    <p class="mt-12 text-sm font-semibold text-slate-900">
                        {{ $salarySlip->creator?->name ?? '-' }}
                    </p>
                </div>

                <div class="sm:text-right">
                    <p class="text-sm text-slate-500">
                        Diterima Oleh
                    </p>

                    <p class="mt-12 text-sm font-semibold text-slate-900">
                        {{ $salarySlip->receiver?->name ?? $salarySlip->teacher->name }}
                    </p>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-sm text-slate-500">
                    {{ $salarySlip->teacher->branch?->name ?? 'Bimbel Safa' }},
                    {{ $salarySlip->issued_at?->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: white !important;
            }

            .lg\:pl-72 {
                padding-left: 0 !important;
            }

            main {
                padding: 0 !important;
            }

            .print\:hidden {
                display: none !important;
            }
        }
    </style>
@endpush
</x-super-admin-layout>
