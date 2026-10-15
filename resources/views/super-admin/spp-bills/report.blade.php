<x-super-admin-layout title="Laporan SPP">
    @php
        $months = [
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
        ];

        $statusLabels = [
            'paid' => 'Lunas',
            'unpaid' => 'Belum Dibayar',
            'failed' => 'Gagal',
            'expired' => 'Kedaluwarsa',
        ];
    @endphp

    <div class="mx-auto max-w-7xl space-y-6">
        <div>
            <p class="text-sm font-medium text-blue-600">
                Super Admin / Laporan
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Laporan Seluruh SPP
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Pantau data pembayaran SPP siswa dari seluruh cabang Bimbel Safa.
            </p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Tagihan
                        </p>

                        <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                            {{ number_format($totalBills) }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 14.25h6m-6-3h6m-6-3h6M7.5 3.75h9A1.5 1.5 0 0118 5.25v13.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 016 18.75V5.25a1.5 1.5 0 011.5-1.5z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Nominal
                        </p>

                        <p class="mt-2 text-xl font-bold tracking-tight text-slate-900">
                            Rp {{ number_format($totalAmount, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v12m4.5-9.75c0-1.243-1.567-2.25-3.5-2.25h-2c-1.933 0-3.5 1.007-3.5 2.25S9.067 8.5 11 8.5h2c1.933 0 3.5 1.007 3.5 2.25S14.933 13 13 13h-2c-1.933 0-3.5-1.007-3.5-2.25" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Sudah Dibayar
                        </p>

                        <p class="mt-2 text-xl font-bold tracking-tight text-slate-900">
                            Rp {{ number_format($totalPaid, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Belum Dibayar
                        </p>

                        <p class="mt-2 text-xl font-bold tracking-tight text-slate-900">
                            Rp {{ number_format($totalUnpaid, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 4h.01M10.29 3.86l-8.17 14a2 2 0 001.74 2.64h16.28a2 2 0 001.74-2.64l-8.17-14a2 2 0 00-3.42 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <form method="GET" action="{{ route('super-admin.spp-bills.report') }}">
                <div class="grid gap-3 lg:grid-cols-[1fr_190px_170px_160px_160px_auto]">
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau NIS..."
                            class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                    </div>

                    <select
                        name="branch_id"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                    >
                        <option value="">Semua Cabang</option>

                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" @selected(request('branch_id') == $branch->id)>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>

                    <select
                        name="status"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                    >
                        <option value="">Semua Status</option>

                        @foreach ($statusLabels as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    <select
                        name="month"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                    >
                        <option value="">Semua Bulan</option>

                        @foreach ($months as $number => $month)
                            <option value="{{ $number }}" @selected(request('month') == $number)>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>

                    <select
                        name="year"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                    >
                        <option value="">Semua Tahun</option>

                        @foreach ($years as $year)
                            <option value="{{ $year }}" @selected(request('year') == $year)>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0014 14.414V19l-4 2v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>

                        @if (request()->hasAny(['search', 'branch_id', 'status', 'month', 'year']))
                            <a
                                href="{{ route('super-admin.spp-bills.report') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">
                        Data Pembayaran SPP
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        {{ $sppBills->total() }} data ditemukan
                    </p>
                </div>
            </div>

            @if ($sppBills->count())
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1050px] text-left">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Siswa
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Cabang
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Kelas
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Periode
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Nominal
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Status
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Dibayar
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach ($sppBills as $sppBill)
                                <tr class="transition hover:bg-slate-50/70">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-blue-600">
                                                {{ strtoupper(substr($sppBill->student?->name ?? '-', 0, 1)) }}
                                            </div>

                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-semibold text-slate-900">
                                                    {{ $sppBill->student?->name ?? 'Siswa tidak ditemukan' }}
                                                </p>

                                                <p class="mt-0.5 text-xs text-slate-500">
                                                    {{ $sppBill->student?->identity_number ?: 'NIS belum diisi' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 21s8-4.35 8-10a8 8 0 10-16 0c0 5.65 8 10 8 10z" />
                                                    <circle cx="12" cy="11" r="2.5" />
                                                </svg>
                                            </div>

                                            <span class="text-sm font-medium text-slate-700">
                                                {{ $sppBill->student?->branch?->name ?? 'Tidak terhubung' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-5 py-4">
                                        <span class="text-sm text-slate-600">
                                            {{ $sppBill->student?->classRoom?->name ?? 'Belum ditentukan' }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="text-sm font-medium text-slate-700">
                                            {{ $months[(int) $sppBill->month] ?? '-' }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-500">
                                            {{ $sppBill->year }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4">
                                        <span class="text-sm font-semibold text-slate-900">
                                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4">
                                        @if ($sppBill->status === 'paid')
                                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                Lunas
                                            </span>
                                        @elseif ($sppBill->status === 'unpaid')
                                            <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                Belum Dibayar
                                            </span>
                                        @elseif ($sppBill->status === 'failed')
                                            <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                Gagal
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                                Kedaluwarsa
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4">
                                        @if ($sppBill->paid_at)
                                            <p class="text-sm font-medium text-slate-700">
                                                {{ $sppBill->paid_at->format('d M Y') }}
                                            </p>

                                            <p class="mt-0.5 text-xs text-slate-500">
                                                {{ $sppBill->paid_at->format('H:i') }}
                                            </p>
                                        @else
                                            <span class="text-sm text-slate-400">
                                                —
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($sppBills->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4">
                        {{ $sppBills->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-16 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 14.25h6m-6-3h6m-6-3h6M7.5 3.75h9A1.5 1.5 0 0118 5.25v13.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 016 18.75V5.25a1.5 1.5 0 011.5-1.5z" />
                        </svg>
                    </div>

                    <h3 class="mt-4 text-sm font-semibold text-slate-900">
                        Data SPP tidak ditemukan
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Belum ada data SPP yang sesuai dengan filter yang dipilih.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-super-admin-layout>