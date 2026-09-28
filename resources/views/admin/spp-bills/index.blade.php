<x-admin-layout>

    <x-slot name="title">

        SPP

    </x-slot>



    @php

        $isFiltering = request()->hasAny(['search', 'class_room_id', 'status', 'month', 'year']);



        $th = 'px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';

        $td = 'px-6 py-4 text-xs sm:text-sm';

        $iconBtn = 'w-8 h-8 inline-flex items-center justify-center rounded-lg transition-colors duration-150';

    @endphp



    {{-- Wrapper utama: Hapus transisi lambat, gunakan instant/durasi sangat singkat (150ms) --}}

    <div class="py-4 lg:py-6 min-h-screen transition-colors duration-150" style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">



            {{-- ====== Breadcrumb ====== --}}

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3" style="color: var(--admin-muted);">

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>

                <span class="font-semibold" style="color: var(--admin-text);">SPP</span>

            </nav>



            {{-- ====== JUDUL HALAMAN ====== --}}

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



            {{-- Flash / Error Messages --}}

            @if ($errors->any())

            <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm" style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">

                <div class="font-semibold mb-1">Terjadi kesalahan.</div>

                <ul class="list-disc list-inside space-y-0.5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif



            {{-- ====== CARD UTAMA ====== --}}

            <div class="rounded-2xl p-5 sm:p-6 shadow-sm" style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">



                {{-- TOOLBAR / FILTER --}}

                <form method="GET" action="{{ route('admin.spp-bills.index') }}" class="mb-6">



                    {{-- BARIS ATAS: Cari Siswa, Terapkan Filter, Reset, Tambah Tagihan --}}

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                        <div class="relative w-full sm:w-80">

                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none" style="color: var(--admin-icon);">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>

                            </span>

                            <input

                                type="text"

                                name="search"

                                value="{{ request('search') }}"

                                placeholder="Nama atau NIS/NISN..."

                                class="w-full pl-10 pr-4 py-2.5 rounded-xl text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                        </div>



                        <div class="flex items-center gap-2">

                            <button

                                type="submit"

                                class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-medium transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">

                                Terapkan Filter

                            </button>



                            @if ($isFiltering)

                            <a href="{{ route('admin.spp-bills.index') }}"

                                class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-medium transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                                onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">

                                Reset

                            </a>

                            @endif



                            <a href="{{ route('admin.spp-bills.create') }}"

                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white transition-opacity shadow-md hover:brightness-110 shrink-0"

                                style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>

                                Tambah Tagihan

                            </a>

                        </div>

                    </div>



                    {{-- BARIS BAWAH: Kelas, Status, Bulan, Tahun --}}

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 pt-2 border-t" style="border-color: var(--admin-border);">

                        <div>

                            <label for="class_room_id" class="mb-1.5 block text-[13px] sm:text-sm font-medium" style="color: var(--admin-muted);">

                                Kelas

                            </label>

                            <select

                                id="class_room_id"

                                name="class_room_id"

                                class="w-full py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Kelas</option>

                                @foreach ($classRooms as $classRoom)

                                    <option value="{{ $classRoom->id }}" {{ request('class_room_id') == $classRoom->id ? 'selected' : '' }}>

                                        {{ $classRoom->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>



                        <div>

                            <label for="status" class="mb-1.5 block text-[13px] sm:text-sm font-medium" style="color: var(--admin-muted);">

                                Status

                            </label>

                            <select

                                id="status"

                                name="status"

                                class="w-full py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Status</option>

                                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>

                                <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>

                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>

                                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>

                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>

                            </select>

                        </div>



                        <div>

                            <label for="month" class="mb-1.5 block text-[13px] sm:text-sm font-medium" style="color: var(--admin-muted);">

                                Bulan

                            </label>

                            <select

                                id="month"

                                name="month"

                                class="w-full py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Bulan</option>

                                @foreach ([

                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',

                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',

                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'

                                ] as $number => $monthName)

                                    <option value="{{ $number }}" {{ (string) request('month') === (string) $number ? 'selected' : '' }}>

                                        {{ $monthName }}

                                    </option>

                                @endforeach

                            </select>

                        </div>



                        <div>

                            <label for="year" class="mb-1.5 block text-[13px] sm:text-sm font-medium" style="color: var(--admin-muted);">

                                Tahun

                            </label>

                            <select

                                id="year"

                                name="year"

                                class="w-full py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">Semua Tahun</option>

                                @foreach ($years as $year)

                                    <option value="{{ $year }}" {{ (string) request('year') === (string) $year ? 'selected' : '' }}>

                                        {{ $year }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </form>



                {{-- Showing X - Y of Z records --}}

                @if (method_exists($sppBills, 'firstItem') && $sppBills->total() > 0)

                <p class="text-[11px] sm:text-xs mb-4 pt-2" style="color: var(--admin-muted);">

                    Showing <span class="font-semibold" style="color: var(--admin-text);">{{ $sppBills->firstItem() ?? 0 }}</span>

                    – <span class="font-semibold" style="color: var(--admin-text);">{{ $sppBills->lastItem() ?? 0 }}</span>

                    of <span class="font-semibold" style="color: var(--admin-text);">{{ $sppBills->total() }}</span> records

                </p>

                @endif



                {{-- ====== TABEL ====== --}}

                <div class="rounded-xl overflow-hidden" style="border: 1px solid var(--admin-border);">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-900px text-left border-collapse">

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

                            <tbody class="divide-y" style="border-color: var(--admin-border);">

                                @forelse ($sppBills as $sppBill)

                                @php

                                    $statusStyles = [

                                        'paid' => 'bg-emerald-100/80 text-emerald-700 font-semibold dark:bg-emerald-500/20 dark:text-emerald-300',

                                        'unpaid' => 'bg-amber-100/80 text-amber-700 font-semibold dark:bg-amber-500/20 dark:text-amber-300',

                                        'pending' => 'bg-blue-100/80 text-blue-700 font-semibold dark:bg-blue-500/20 dark:text-blue-300',

                                        'failed' => 'bg-red-100/80 text-red-700 font-semibold dark:bg-red-500/20 dark:text-red-300',

                                        'expired' => 'bg-slate-100/80 text-slate-700 font-semibold dark:bg-slate-500/20 dark:text-slate-300',

                                    ];



                                    $statusLabels = [

                                        'paid' => 'Lunas',

                                        'unpaid' => 'Belum Lunas',

                                        'pending' => 'Menunggu',

                                        'failed' => 'Gagal',

                                        'expired' => 'Expired',

                                    ];

                                @endphp



                                <tr style="border-bottom: 1px solid var(--admin-border);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                    <td class="{{ $td }}">

                                        <div class="font-medium" style="color: var(--admin-text);">

                                            {{ $sppBill->student->name }}

                                        </div>

                                        <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">

                                            {{ $sppBill->student->identity_number }}

                                        </div>

                                    </td>



                                    <td class="{{ $td }}">

                                        <span style="color: var(--admin-muted);">

                                            {{ $sppBill->student->classRoom->name ?? '-' }}

                                        </span>

                                    </td>



                                    <td class="{{ $td }}">

                                        <span class="font-medium" style="color: var(--admin-text);">

                                            {{ $sppBill->period }}

                                        </span>

                                    </td>



                                    <td class="{{ $td }}">

                                        <span class="font-medium" style="color: var(--admin-text);">

                                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}

                                        </span>

                                    </td>



                                    <td class="{{ $td }}">

                                        <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm {{ $statusStyles[$sppBill->status] ?? 'bg-slate-100/80 text-slate-600' }}">

                                            {{ $statusLabels[$sppBill->status] ?? ucfirst($sppBill->status) }}

                                        </span>

                                    </td>



                                    <td class="{{ $td }}">

                                        <div class="flex items-center justify-end gap-1">

                                            {{-- Detail --}}

                                            <a href="{{ route('admin.spp-bills.show', $sppBill) }}" title="Detail"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>

                                            </a>



                                            {{-- Edit --}}

                                            <a href="{{ route('admin.spp-bills.edit', $sppBill) }}" title="Edit"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>

                                            </a>



                                            {{-- Hapus --}}

                                            <form action="{{ route('admin.spp-bills.destroy', $sppBill) }}" method="POST" onsubmit="return confirm('Hapus tagihan SPP ini?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" title="Hapus"

                                                    class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.1)'; this.style.color='#ef4444';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--admin-icon)';">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>

                                                <circle cx="9" cy="7" r="4"/>

                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>

                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                                            </svg>

                                        </div>

                                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">Belum ada tagihan SPP</p>

                                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">Tambahkan tagihan SPP untuk mulai mengelola pembayaran siswa.</p>

                                        <a href="{{ route('admin.spp-bills.create') }}"

                                            class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white shadow-md hover:brightness-110"

                                            style="background-color: #2563EB;">

                                            Tambah Tagihan

                                        </a>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>



            </div>



            {{-- Pagination --}}

            @if (method_exists($sppBills, 'hasPages') && $sppBills->hasPages())

            <div class="mt-4">

                {{ $sppBills->links() }}

            </div>

            @endif



        </div>

    </div>

</x-admin-layout>
