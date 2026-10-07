<x-admin-layout>
    <x-slot name="title">
        SPP
    </x-slot>

    @php
        $isFiltering = request()->hasAny(['search', 'status', 'month']);

        $th = 'px-4 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
        $td = 'px-4 py-4 text-xs sm:text-sm';
        $iconBtn = 'w-8 h-8 inline-flex items-center justify-center rounded-lg transition-colors duration-150';

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
            'unpaid' => 'Belum Lunas',
            'pending' => 'Menunggu',
            'failed' => 'Gagal',
            'expired' => 'Expired',
        ];

        $statusBadges = [
            'paid' => 'bg-emerald-100/80 dark:bg-emerald-500/20',
            'unpaid' => 'bg-amber-100/80 dark:bg-amber-500/20',
            'pending' => 'bg-blue-100/80 dark:bg-blue-500/20',
            'failed' => 'bg-red-100/80 dark:bg-red-500/20',
            'expired' => 'bg-slate-100/80 dark:bg-slate-500/20',
        ];
    @endphp

    <div class="-mt-3 pt-0 pb-4 lg:-mt-4 lg:pb-6 min-h-screen transition-colors duration-150"
        style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="max-w-90rem mx-auto min-w-0 px-4 sm:px-6 lg:px-6">

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3"
                style="color: var(--admin-muted);">

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    SPP
                </span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                        Tagihan SPP
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Kelola tagihan dan riwayat pembayaran SPP siswa.
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">

                    <div class="font-semibold mb-1">
                        Terjadi kesalahan.
                    </div>

                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="min-w-0 rounded-2xl p-4 sm:p-6 shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                <form method="GET" action="{{ route('admin.spp-bills.index') }}" class="mb-6">

                    {{-- Search dan tombol --}}
                    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="relative w-full min-w-0 sm:w-80 sm:shrink-0">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none"
                                style="color: var(--admin-icon);">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="m21 21-4.3-4.3"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Nama atau NIS/NISN..."
                                class="box-border h-9 w-full min-w-0 rounded-lg py-2 pl-10 pr-3 text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                        </div>

                        <div class="grid grid-cols-1 gap-2 sm:flex sm:flex-wrap sm:items-center">
                            <button
                                type="submit"
                                class="inline-flex h-9 w-full items-center justify-center rounded-lg px-3 text-xs sm:w-auto sm:text-[13px] font-medium transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"
                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                                Terapkan Filter
                            </button>

                            @if ($isFiltering)
                                <a href="{{ route('admin.spp-bills.index') }}"
                                    class="inline-flex h-9 w-full items-center justify-center rounded-lg px-3 text-xs sm:w-auto sm:text-[13px] font-medium transition-colors duration-150"
                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"
                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                    onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                                    Reset
                                </a>
                            @endif

                            <a href="{{ route('admin.spp-bills.create') }}"
                                class="inline-flex h-9 w-full items-center justify-center gap-1.5 rounded-lg px-3 text-xs sm:w-36 sm:shrink-0 sm:text-[13px] font-semibold text-white transition-opacity hover:brightness-110"
                                style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">

                                <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"/>
                                    <path d="M12 5v14"/>
                                </svg>

                                Tambah Tagihan
                            </a>
                        </div>
                    </div>

                    {{-- Filter Status dan Bulan --}}
                    <div class="grid grid-cols-1 gap-3 border-t pt-4 sm:grid-cols-2"
                        style="border-color: var(--admin-border);">

                        <div class="min-w-0">
                            <label for="status"
                                class="mb-1.5 block text-xs sm:text-[13px] font-medium"
                                style="color: var(--admin-muted);">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="box-border h-9 w-full min-w-0 rounded-lg px-3 text-xs sm:text-[13px] font-medium outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Status</option>
                                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
                                <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>

                        <div class="min-w-0">
                            <label for="month"
                                class="mb-1.5 block text-xs sm:text-[13px] font-medium"
                                style="color: var(--admin-muted);">
                                Bulan
                            </label>

                            <select
                                id="month"
                                name="month"
                                class="box-border h-9 w-full min-w-0 rounded-lg px-3 text-xs sm:text-[13px] font-medium outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Bulan</option>

                                @foreach ($months as $number => $monthName)
                                    <option
                                        value="{{ $number }}"
                                        {{ (string) request('month') === (string) $number ? 'selected' : '' }}>
                                        {{ $monthName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                @if (method_exists($sppBills, 'firstItem') && $sppBills->total() > 0)
                    <p class="text-xs sm:text-sm mb-4 pt-2" style="color: var(--admin-muted);">
                        Showing
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $sppBills->firstItem() ?? 0 }}
                        </span>
                        –
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $sppBills->lastItem() ?? 0 }}
                        </span>
                        of
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $sppBills->total() }}
                        </span>
                        records
                    </p>
                @endif

                @if ($sppBills->count() > 0)

                    {{-- Tabel untuk layar lebar --}}
                    <div class="hidden overflow-hidden rounded-xl border xl:block"
                        style="border-color: var(--admin-border);">

                        <table class="w-full table-fixed border-collapse text-left">
                            <colgroup>
                                <col style="width: 22%;">
                                <col style="width: 14%;">
                                <col style="width: 14%;">
                                <col style="width: 16%;">
                                <col style="width: 17%;">
                                <col style="width: 17%;">
                            </colgroup>

                            <thead style="border-bottom: 1px solid var(--admin-border); background-color: var(--admin-surface-soft);">
                                <tr>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Siswa</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Kelas</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Periode</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Nominal</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Status</th>
                                    <th class="{{ $th }} text-right" style="color: var(--admin-muted);">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sppBills as $sppBill)
                                    @php
                                        $canManageBill = in_array(
                                            $sppBill->status,
                                            ['unpaid', 'failed', 'expired'],
                                            true
                                        );

                                        $statusBadge = $statusBadges[$sppBill->status]
                                            ?? 'bg-slate-100/80 dark:bg-slate-500/20';

                                        $statusLabel = $statusLabels[$sppBill->status]
                                            ?? ucfirst($sppBill->status);
                                    @endphp

                                    <tr
                                        style="border-bottom: 1px solid var(--admin-border);"
                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                        onmouseout="this.style.backgroundColor='transparent'">

                                        <td class="{{ $td }} wrap-break-word">
                                            <div class="font-medium" style="color: var(--admin-text);">
                                                {{ $sppBill->student->name }}
                                            </div>

                                            <div class="mt-0.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                                {{ $sppBill->student->identity_number }}
                                            </div>
                                        </td>

                                        <td class="{{ $td }} wrap-break-word" style="color: var(--admin-text);">
                                            {{ $sppBill->student->classRoom->name ?? '—' }}
                                        </td>

                                        <td class="{{ $td }} wrap-break-word font-medium" style="color: var(--admin-text);">
                                            {{ $sppBill->period }}
                                        </td>

                                        <td class="{{ $td }} wrap-break-word font-medium" style="color: var(--admin-text);">
                                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                        </td>

                                        <td class="{{ $td }}">
                                            <span
                                                class="inline-flex max-w-full wrap-break-word rounded-md px-2.5 py-1 text-xs sm:text-sm font-semibold {{ $statusBadge }}"
                                                style="color: var(--admin-text);">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <div class="flex items-center justify-end gap-1">
                                                {{-- Detail --}}
                                                <a href="{{ route('admin.spp-bills.show', $sppBill) }}"
                                                    title="Detail"
                                                    aria-label="Detail tagihan {{ $sppBill->student->name }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: var(--admin-icon);"
                                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true">
                                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>
                                                </a>

                                                @if ($canManageBill)
                                                    {{-- Edit --}}
                                                    <a href="{{ route('admin.spp-bills.edit', $sppBill) }}"
                                                        title="Edit"
                                                        aria-label="Edit tagihan {{ $sppBill->student->name }}"
                                                        class="{{ $iconBtn }}"
                                                        style="color: var(--admin-icon);"
                                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                        onmouseout="this.style.backgroundColor='transparent'">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            aria-hidden="true">
                                                            <path d="M12 20h9"/>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                        </svg>
                                                    </a>

                                                    {{-- Hapus --}}
                                                    <form
                                                        action="{{ route('admin.spp-bills.destroy', $sppBill) }}"
                                                        method="POST"
                                                        class="inline-flex"
                                                        data-delete-form>
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            title="Hapus"
                                                            aria-label="Hapus tagihan {{ $sppBill->student->name }}"
                                                            class="{{ $iconBtn }}"
                                                            style="color: #dc2626;"
                                                            onmouseover="this.style.backgroundColor='rgba(220, 38, 38, 0.1)'"
                                                            onmouseout="this.style.backgroundColor='transparent'">
                                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                aria-hidden="true">
                                                                <path d="M3 6h18"/>
                                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                                <path d="m19 6-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                                <path d="M10 11v6M14 11v6"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    {{-- Slot kosong agar posisi icon Detail tetap sejajar --}}
                                                    <span class="w-8 h-8 shrink-0" aria-hidden="true"></span>
                                                    <span class="w-8 h-8 shrink-0" aria-hidden="true"></span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Tampilan kartu untuk layar kecil --}}
                    <div class="grid grid-cols-1 gap-3 xl:hidden">
                        @foreach ($sppBills as $sppBill)
                            @php
                                $canManageBill = in_array(
                                    $sppBill->status,
                                    ['unpaid', 'failed', 'expired'],
                                    true
                                );

                                $statusBadge = $statusBadges[$sppBill->status]
                                    ?? 'bg-slate-100/80 dark:bg-slate-500/20';

                                $statusLabel = $statusLabels[$sppBill->status]
                                    ?? ucfirst($sppBill->status);
                            @endphp

                            <article class="min-w-0 rounded-xl border p-4"
                                style="border-color: var(--admin-border); background-color: var(--admin-surface);">

                                <div class="flex min-w-0 items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="wrap-break-word text-sm font-semibold" style="color: var(--admin-text);">
                                            {{ $sppBill->student->name }}
                                        </div>

                                        <div class="mt-0.5 wrap-break-word text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                            {{ $sppBill->student->identity_number }}
                                        </div>
                                    </div>

                                    <div class="flex shrink-0 items-center gap-1">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.spp-bills.show', $sppBill) }}"
                                            title="Detail"
                                            aria-label="Detail tagihan {{ $sppBill->student->name }}"
                                            class="{{ $iconBtn }}"
                                            style="color: var(--admin-icon);"
                                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                aria-hidden="true">
                                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </a>

                                        @if ($canManageBill)
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.spp-bills.edit', $sppBill) }}"
                                                title="Edit"
                                                aria-label="Edit tagihan {{ $sppBill->student->name }}"
                                                class="{{ $iconBtn }}"
                                                style="color: var(--admin-icon);"
                                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                onmouseout="this.style.backgroundColor='transparent'">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    aria-hidden="true">
                                                    <path d="M12 20h9"/>
                                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                </svg>
                                            </a>

                                            {{-- Hapus --}}
                                            <form
                                                action="{{ route('admin.spp-bills.destroy', $sppBill) }}"
                                                method="POST"
                                                class="inline-flex"
                                                data-delete-form>
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Hapus"
                                                    aria-label="Hapus tagihan {{ $sppBill->student->name }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: #dc2626;"
                                                    onmouseover="this.style.backgroundColor='rgba(220, 38, 38, 0.1)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true">
                                                        <path d="M3 6h18"/>
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                        <path d="m19 6-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                        <path d="M10 11v6M14 11v6"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4 grid min-w-0 grid-cols-2 gap-x-4 gap-y-3">
                                    <div class="min-w-0">
                                        <div class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                            Kelas
                                        </div>
                                        <div class="mt-0.5 wrap-break-word text-xs sm:text-sm" style="color: var(--admin-text);">
                                            {{ $sppBill->student->classRoom->name ?? '—' }}
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <div class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                            Periode
                                        </div>
                                        <div class="mt-0.5 wrap-break-word text-xs sm:text-sm font-medium" style="color: var(--admin-text);">
                                            {{ $sppBill->period }}
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <div class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                            Nominal
                                        </div>
                                        <div class="mt-0.5 wrap-break-word text-xs sm:text-sm font-medium" style="color: var(--admin-text);">
                                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <div class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                            Status
                                        </div>
                                        <span
                                            class="mt-1 inline-flex max-w-full wrap-break-word rounded-md px-2.5 py-1 text-xs font-semibold {{ $statusBadge }}"
                                            style="color: var(--admin-text);">
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                @else
                    <div class="rounded-xl border px-4 py-12 text-center"
                        style="border-color: var(--admin-border);">

                        <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full"
                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M3 4h18v16H3z"/>
                                <path d="M7 8h10"/>
                                <path d="M7 12h6"/>
                                <path d="M7 16h8"/>
                            </svg>
                        </div>

                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">
                            Belum ada tagihan SPP
                        </p>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            @if (method_exists($sppBills, 'hasPages') && $sppBills->hasPages())
                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Menampilkan
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $sppBills->firstItem() ?? 0 }}–{{ $sppBills->lastItem() ?? 0 }}
                        </span>
                        dari
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $sppBills->total() }}
                        </span>
                        tagihan
                    </p>

                    <div class="flex flex-wrap items-center gap-2">
                        @if ($sppBills->onFirstPage())
                            <span
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium opacity-50 cursor-not-allowed"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $sppBills->appends(request()->query())->previousPageUrl() }}"
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium transition-colors"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Sebelumnya
                            </a>
                        @endif

                        <span class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                            Halaman {{ $sppBills->currentPage() }} dari {{ $sppBills->lastPage() }}
                        </span>

                        @if ($sppBills->hasMorePages())
                            <a href="{{ $sppBills->appends(request()->query())->nextPageUrl() }}"
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium transition-colors"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Berikutnya
                            </a>
                        @else
                            <span
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium opacity-50 cursor-not-allowed"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Berikutnya
                            </span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Popup konfirmasi hapus --}}
    <div
        id="delete-confirm-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="delete-modal-title"
        aria-hidden="true">

        <div class="w-full max-w-sm rounded-2xl border p-5 shadow-xl"
            style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">

            <h2 id="delete-modal-title" class="text-base font-semibold">
                Hapus tagihan ini?
            </h2>

            <p class="mt-2 text-sm" style="color: var(--admin-muted);">
                Tagihan yang sudah dihapus tidak dapat dikembalikan.
            </p>

            <div class="mt-5 flex justify-end gap-2">
                <button
                    id="cancel-delete-button"
                    type="button"
                    class="h-9 rounded-lg border px-3 text-xs sm:text-sm font-medium"
                    style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-text);">
                    Batal
                </button>

                <button
                    id="confirm-delete-button"
                    type="button"
                    class="h-9 rounded-lg px-3 text-xs sm:text-sm font-semibold text-white"
                    style="background-color: #dc2626;">
                    Hapus Tagihan
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Popup konfirmasi hapus
            const deleteModal = document.getElementById('delete-confirm-modal');
            const cancelDeleteButton = document.getElementById('cancel-delete-button');
            const confirmDeleteButton = document.getElementById('confirm-delete-button');
            let pendingDeleteForm = null;

            function openDeleteModal() {
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
                deleteModal.setAttribute('aria-hidden', 'false');
            }

            function closeDeleteModal() {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                deleteModal.setAttribute('aria-hidden', 'true');
                pendingDeleteForm = null;
            }

            document.querySelectorAll('[data-delete-form]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    pendingDeleteForm = form;
                    openDeleteModal();
                });
            });

            cancelDeleteButton.addEventListener('click', closeDeleteModal);

            confirmDeleteButton.addEventListener('click', function () {
                if (pendingDeleteForm) {
                    HTMLFormElement.prototype.submit.call(pendingDeleteForm);
                }
            });

            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeDeleteModal();
                }
            });
        });
    </script>
</x-admin-layout>
