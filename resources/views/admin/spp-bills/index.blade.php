<x-admin-layout>
    <x-slot name="title">
        SPP
    </x-slot>

    @php
        $isFiltering = request()->hasAny([
            'search',
            'status',
            'month',
            'year',
            'class_room_id',
        ]);

        $th = 'px-4 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
        $td = 'px-4 py-4 text-xs sm:text-sm';
        $iconBtn = 'inline-flex h-8 w-8 items-center justify-center rounded-lg transition-colors duration-150';

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

        $currentYear = now()->year;
        $years = range($currentYear + 1, $currentYear - 5);
    @endphp

    <div
        class="-mt-3 min-h-screen pb-4 pt-0 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="mx-auto min-w-0 max-w-[90rem] px-4 sm:px-6 lg:px-6">

            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="transition-opacity hover:opacity-85">
                    Dashboard
                </a>

                <svg
                    class="h-2.5 w-2.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"/>
                </svg>

                <span
                    class="font-semibold"
                    style="color: var(--admin-text);">
                    SPP
                </span>
            </nav>

            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Tagihan SPP
                    </h1>

                    <p
                        class="mt-1.5 text-xs sm:text-sm"
                        style="color: var(--admin-muted);">
                        Kelola tagihan dan riwayat pembayaran SPP siswa.
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div
                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">

                    <div class="mb-1 font-semibold">
                        Terjadi kesalahan.
                    </div>

                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div
                class="min-w-0 rounded-2xl p-4 shadow-sm sm:p-6"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                <form
                    method="GET"
                    action="{{ route('admin.spp-bills.index') }}"
                    class="mb-6">

                    <div class="mb-4 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                        <div class="relative w-full min-w-0 lg:w-80 lg:shrink-0">
                            <span
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5"
                                style="color: var(--admin-icon);">

                                <svg
                                    class="h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="m21 21-4.3-4.3"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Nama atau NIS/NISN..."
                                class="box-border h-9 w-full min-w-0 rounded-lg py-2 pl-10 pr-3 text-xs outline-none transition-colors duration-150 sm:text-[13px]"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                        </div>

                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-3 lg:flex lg:flex-wrap lg:items-center">

                            <button
                                type="submit"
                                class="inline-flex h-9 w-full items-center justify-center rounded-lg px-3 text-xs font-medium transition-colors duration-150 sm:text-[13px] lg:w-auto"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"
                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                                Terapkan Filter
                            </button>

                            @if ($isFiltering)
                                <a
                                    href="{{ route('admin.spp-bills.index') }}"
                                    class="inline-flex h-9 w-full items-center justify-center rounded-lg px-3 text-xs font-medium transition-colors duration-150 sm:text-[13px] lg:w-auto"
                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"
                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                    onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                                    Reset
                                </a>
                            @endif

                            <a
                                href="{{ route('admin.spp-bills.create') }}"
                                class="inline-flex h-9 w-full items-center justify-center gap-1.5 rounded-lg px-3 text-xs font-semibold text-white transition-opacity hover:brightness-110 sm:text-[13px] lg:w-36"
                                style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">

                                <svg
                                    class="h-3.5 w-3.5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true">
                                    <path d="M5 12h14"/>
                                    <path d="M12 5v14"/>
                                </svg>

                                Tambah Tagihan
                            </a>
                        </div>
                    </div>

                    <div
                        class="grid grid-cols-1 gap-3 border-t pt-4 sm:grid-cols-2 xl:grid-cols-4"
                        style="border-color: var(--admin-border);">

                        <div class="min-w-0">
                            <label
                                for="status"
                                class="mb-1.5 block text-xs font-medium sm:text-[13px]"
                                style="color: var(--admin-muted);">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="box-border h-9 w-full min-w-0 rounded-lg px-3 text-xs font-medium outline-none transition-colors duration-150 sm:text-[13px]"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Status</option>
                                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>
                                    Lunas
                                </option>
                                <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>
                                    Belum Lunas
                                </option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                    Menunggu Pembayaran
                                </option>
                                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>
                                    Gagal
                                </option>
                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>
                                    Expired
                                </option>
                            </select>
                        </div>

                        <div class="min-w-0">
                            <label
                                for="month"
                                class="mb-1.5 block text-xs font-medium sm:text-[13px]"
                                style="color: var(--admin-muted);">
                                Bulan
                            </label>

                            <select
                                id="month"
                                name="month"
                                class="box-border h-9 w-full min-w-0 rounded-lg px-3 text-xs font-medium outline-none transition-colors duration-150 sm:text-[13px]"
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

                        <div class="min-w-0">
                            <label
                                for="year"
                                class="mb-1.5 block text-xs font-medium sm:text-[13px]"
                                style="color: var(--admin-muted);">
                                Tahun
                            </label>

                            <select
                                id="year"
                                name="year"
                                class="box-border h-9 w-full min-w-0 rounded-lg px-3 text-xs font-medium outline-none transition-colors duration-150 sm:text-[13px]"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Tahun</option>

                                @foreach ($years as $year)
                                    <option
                                        value="{{ $year }}"
                                        {{ (string) request('year') === (string) $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="min-w-0">
                            <label
                                for="class_room_id"
                                class="mb-1.5 block text-xs font-medium sm:text-[13px]"
                                style="color: var(--admin-muted);">
                                Kelas
                            </label>

                            <select
                                id="class_room_id"
                                name="class_room_id"
                                class="box-border h-9 w-full min-w-0 rounded-lg px-3 text-xs font-medium outline-none transition-colors duration-150 sm:text-[13px]"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Kelas</option>

                                @foreach ($classRooms as $classRoom)
                                    <option
                                        value="{{ $classRoom->id }}"
                                        {{ (string) request('class_room_id') === (string) $classRoom->id ? 'selected' : '' }}>
                                        {{ $classRoom->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                @if ($sppBills->total() > 0)
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <p
                            class="text-xs sm:text-sm"
                            style="color: var(--admin-muted);">
                            Menampilkan
                            <span
                                class="font-semibold"
                                style="color: var(--admin-text);">
                                {{ $sppBills->firstItem() }}
                            </span>
                            –
                            <span
                                class="font-semibold"
                                style="color: var(--admin-text);">
                                {{ $sppBills->lastItem() }}
                            </span>
                            dari
                            <span
                                class="font-semibold"
                                style="color: var(--admin-text);">
                                {{ $sppBills->total() }}
                            </span>
                            tagihan
                        </p>
                    </div>
                @endif

                @if ($sppBills->count() > 0)

                    <div
                        class="hidden overflow-hidden rounded-xl border xl:block"
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

                            <thead
                                style="border-bottom: 1px solid var(--admin-border); background-color: var(--admin-surface-soft);">
                                <tr>
                                    <th
                                        class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Siswa
                                    </th>

                                    <th
                                        class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Kelas
                                    </th>

                                    <th
                                        class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Periode
                                    </th>

                                    <th
                                        class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Nominal
                                    </th>

                                    <th
                                        class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Status
                                    </th>

                                    <th
                                        class="{{ $th }} text-right"
                                        style="color: var(--admin-muted);">
                                        Aksi
                                    </th>
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

                                        <td class="{{ $td }} break-words">
                                            <div
                                                class="font-medium"
                                                style="color: var(--admin-text);">
                                                {{ $sppBill->student->name }}
                                            </div>

                                            <div
                                                class="mt-0.5 text-[11px] sm:text-xs"
                                                style="color: var(--admin-muted);">
                                                {{ $sppBill->student->identity_number }}
                                            </div>
                                        </td>

                                        <td
                                            class="{{ $td }} break-words"
                                            style="color: var(--admin-text);">
                                            {{ $sppBill->student->classRoom->name ?? '—' }}
                                        </td>

                                        <td
                                            class="{{ $td }} break-words font-medium"
                                            style="color: var(--admin-text);">
                                            {{ $sppBill->period }}
                                        </td>

                                        <td
                                            class="{{ $td }} break-words font-medium"
                                            style="color: var(--admin-text);">
                                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                        </td>

                                        <td class="{{ $td }}">
                                            <span
                                                class="inline-flex max-w-full break-words rounded-md px-2.5 py-1 text-xs font-semibold sm:text-sm {{ $statusBadge }}"
                                                style="color: var(--admin-text);">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <div class="flex items-center justify-end gap-1">

                                                <a
                                                    href="{{ route('admin.spp-bills.show', $sppBill) }}"
                                                    title="Detail"
                                                    aria-label="Detail tagihan {{ $sppBill->student->name }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: var(--admin-icon);"
                                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">

                                                    <svg
                                                        class="h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        aria-hidden="true">
                                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>
                                                </a>

                                                @if ($canManageBill)
                                                    <a
                                                        href="{{ route('admin.spp-bills.edit', $sppBill) }}"
                                                        title="Edit"
                                                        aria-label="Edit tagihan {{ $sppBill->student->name }}"
                                                        class="{{ $iconBtn }}"
                                                        style="color: var(--admin-icon);"
                                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                        onmouseout="this.style.backgroundColor='transparent'">

                                                        <svg
                                                            class="h-4 w-4"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            aria-hidden="true">
                                                            <path d="M12 20h9"/>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                        </svg>
                                                    </a>

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

                                                            <svg
                                                                class="h-4 w-4"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                aria-hidden="true">
                                                                <path d="M3 6h18"/>
                                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                                <path d="m19 6-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                                <path d="M10 11v6M14 11v6"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span
                                                        class="h-8 w-8 shrink-0"
                                                        aria-hidden="true"></span>

                                                    <span
                                                        class="h-8 w-8 shrink-0"
                                                        aria-hidden="true"></span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

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

                            <article
                                class="min-w-0 rounded-xl border p-4"
                                style="border-color: var(--admin-border); background-color: var(--admin-surface);">

                                <div class="flex min-w-0 items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div
                                            class="break-words text-sm font-semibold"
                                            style="color: var(--admin-text);">
                                            {{ $sppBill->student->name }}
                                        </div>

                                        <div
                                            class="mt-0.5 break-words text-[11px] sm:text-xs"
                                            style="color: var(--admin-muted);">
                                            {{ $sppBill->student->identity_number }}
                                        </div>
                                    </div>

                                    <div class="flex shrink-0 items-center gap-1">
                                        <a
                                            href="{{ route('admin.spp-bills.show', $sppBill) }}"
                                            title="Detail"
                                            aria-label="Detail tagihan {{ $sppBill->student->name }}"
                                            class="{{ $iconBtn }}"
                                            style="color: var(--admin-icon);"
                                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                            onmouseout="this.style.backgroundColor='transparent'">

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true">
                                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </a>

                                        @if ($canManageBill)
                                            <a
                                                href="{{ route('admin.spp-bills.edit', $sppBill) }}"
                                                title="Edit"
                                                aria-label="Edit tagihan {{ $sppBill->student->name }}"
                                                class="{{ $iconBtn }}"
                                                style="color: var(--admin-icon);"
                                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                onmouseout="this.style.backgroundColor='transparent'">

                                                <svg
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    aria-hidden="true">
                                                    <path d="M12 20h9"/>
                                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                </svg>
                                            </a>

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

                                                    <svg
                                                        class="h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
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
                                        <div
                                            class="text-[11px] sm:text-xs"
                                            style="color: var(--admin-muted);">
                                            Kelas
                                        </div>

                                        <div
                                            class="mt-0.5 break-words text-xs sm:text-sm"
                                            style="color: var(--admin-text);">
                                            {{ $sppBill->student->classRoom->name ?? '—' }}
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="text-[11px] sm:text-xs"
                                            style="color: var(--admin-muted);">
                                            Periode
                                        </div>

                                        <div
                                            class="mt-0.5 break-words text-xs font-medium sm:text-sm"
                                            style="color: var(--admin-text);">
                                            {{ $sppBill->period }}
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="text-[11px] sm:text-xs"
                                            style="color: var(--admin-muted);">
                                            Nominal
                                        </div>

                                        <div
                                            class="mt-0.5 break-words text-xs font-medium sm:text-sm"
                                            style="color: var(--admin-text);">
                                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="text-[11px] sm:text-xs"
                                            style="color: var(--admin-muted);">
                                            Status
                                        </div>

                                        <span
                                            class="mt-1 inline-flex max-w-full break-words rounded-md px-2.5 py-1 text-xs font-semibold {{ $statusBadge }}"
                                            style="color: var(--admin-text);">
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                @else
                    <div
                        class="rounded-xl border px-4 py-12 text-center"
                        style="border-color: var(--admin-border);">

                        <div
                            class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full"
                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true">
                                <path d="M3 4h18v16H3z"/>
                                <path d="M7 8h10"/>
                                <path d="M7 12h6"/>
                                <path d="M7 16h8"/>
                            </svg>
                        </div>

                        <p
                            class="text-xs font-medium sm:text-sm"
                            style="color: var(--admin-text);">
                            Belum ada tagihan SPP
                        </p>

                        @if ($isFiltering)
                            <p
                                class="mt-1 text-xs"
                                style="color: var(--admin-muted);">
                                Coba ubah atau reset filter pencarian.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            @if ($sppBills->hasPages())
                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p
                        class="text-xs sm:text-sm"
                        style="color: var(--admin-muted);">
                        Halaman
                        <span
                            class="font-semibold"
                            style="color: var(--admin-text);">
                            {{ $sppBills->currentPage() }}
                        </span>
                        dari
                        <span
                            class="font-semibold"
                            style="color: var(--admin-text);">
                            {{ $sppBills->lastPage() }}
                        </span>
                    </p>

                    <div class="flex flex-wrap items-center gap-2">
                        @if ($sppBills->onFirstPage())
                            <span
                                class="inline-flex h-9 cursor-not-allowed items-center rounded-lg border px-3 text-xs font-medium opacity-50 sm:text-sm"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Sebelumnya
                            </span>
                        @else
                            <a
                                href="{{ $sppBills->appends(request()->query())->previousPageUrl() }}"
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs font-medium transition-colors sm:text-sm"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);"
                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                onmouseout="this.style.backgroundColor='var(--admin-surface)'">
                                Sebelumnya
                            </a>
                        @endif

                        @if ($sppBills->hasMorePages())
                            <a
                                href="{{ $sppBills->appends(request()->query())->nextPageUrl() }}"
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs font-medium transition-colors sm:text-sm"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);"
                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                onmouseout="this.style.backgroundColor='var(--admin-surface)'">
                                Berikutnya
                            </a>
                        @else
                            <span
                                class="inline-flex h-9 cursor-not-allowed items-center rounded-lg border px-3 text-xs font-medium opacity-50 sm:text-sm"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Berikutnya
                            </span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>

    <div
        id="delete-confirm-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="delete-modal-title"
        aria-hidden="true">

        <div
            class="w-full max-w-sm rounded-2xl border p-5 shadow-xl"
            style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">

            <h2
                id="delete-modal-title"
                class="text-base font-semibold">
                Hapus tagihan ini?
            </h2>

            <p
                class="mt-2 text-sm"
                style="color: var(--admin-muted);">
                Tagihan yang sudah dihapus tidak dapat dikembalikan.
            </p>

            <div class="mt-5 flex justify-end gap-2">
                <button
                    id="cancel-delete-button"
                    type="button"
                    class="h-9 rounded-lg border px-3 text-xs font-medium sm:text-sm"
                    style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-text);">
                    Batal
                </button>

                <button
                    id="confirm-delete-button"
                    type="button"
                    class="h-9 rounded-lg px-3 text-xs font-semibold text-white sm:text-sm"
                    style="background-color: #dc2626;">
                    Hapus Tagihan
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                if (event.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                    closeDeleteModal();
                }
            });
        });
    </script>
</x-admin-layout>