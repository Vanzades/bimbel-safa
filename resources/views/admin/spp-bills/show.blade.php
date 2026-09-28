<x-admin-layout>

    <x-slot name="title">

        Detail Tagihan SPP

    </x-slot>



    @php

        $statusLabels = [

            'paid' => 'Lunas',

            'unpaid' => 'Belum Lunas',

            'pending' => 'Menunggu Pembayaran',

            'failed' => 'Gagal',

            'expired' => 'Expired',

        ];



        $statusClasses = [

            'paid' => 'bg-emerald-100/85 text-emerald-700 dark:bg-emerald-500/25 dark:text-emerald-300',

            'unpaid' => 'bg-amber-100/85 text-amber-700 dark:bg-amber-500/25 dark:text-amber-300',

            'pending' => 'bg-blue-100/85 text-blue-700 dark:bg-blue-500/25 dark:text-blue-300',

            'failed' => 'bg-red-100/85 text-red-700 dark:bg-red-500/25 dark:text-red-300',

            'expired' => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',

        ];



        $currentStatusLabel = $statusLabels[$sppBill->status] ?? ucfirst($sppBill->status);

        $currentStatusClass = $statusClasses[$sppBill->status] ?? 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400';

    @endphp



    <div

        class="py-4 lg:py-6 min-h-screen transition-colors duration-150"

        style="background-color: var(--admin-bg); color: var(--admin-text);"

    >

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">



            {{-- Breadcrumb --}}

            <nav

                class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3"

                style="color: var(--admin-muted);"

            >

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">

                    Dashboard

                </a>



                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>



                <a href="{{ route('admin.spp-bills.index') }}" class="hover:opacity-85">

                    SPP

                </a>



                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>



                <span class="font-semibold" style="color: var(--admin-text);">

                    Detail Tagihan SPP

                </span>

            </nav>



            {{-- Judul halaman --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Detail Tagihan SPP

                    </h1>



                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Informasi lengkap tagihan SPP siswa.

                    </p>

                </div>

            </div>



            {{-- Konten utama --}}

            <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">



                {{-- Informasi tagihan dan sistem --}}

                <div

                    class="rounded-2xl p-5 sm:p-6 shadow-sm"

                    style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

                >

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-5 border-b" style="border-color: var(--admin-border);">

                        <div>

                            <h2 class="text-sm sm:text-base font-semibold">

                                Informasi Tagihan

                            </h2>



                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                                Periode {{ $sppBill->period }}

                            </p>

                        </div>



                        <span class="inline-flex w-fit items-center rounded-full px-3 py-1.5 text-xs sm:text-sm font-semibold {{ $currentStatusClass }}">

                            {{ $currentStatusLabel }}

                        </span>

                    </div>



                    <div class="grid gap-x-6 gap-y-5 py-6 sm:grid-cols-2">

                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Siswa

                            </p>

                            <p class="mt-1.5 text-xs sm:text-sm font-medium">

                                {{ $sppBill->student->name }}

                            </p>

                        </div>



                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                NIS / Identitas

                            </p>

                            <p class="mt-1.5 text-xs sm:text-sm">

                                {{ $sppBill->student->identity_number }}

                            </p>

                        </div>



                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Kelas

                            </p>

                            <p class="mt-1.5 text-xs sm:text-sm">

                                {{ $sppBill->student->classRoom?->name ?? '-' }}

                            </p>

                        </div>



                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Periode

                            </p>

                            <p class="mt-1.5 text-xs sm:text-sm">

                                {{ $sppBill->period }}

                            </p>

                        </div>



                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Nominal

                            </p>

                            <p class="mt-1.5 text-xs sm:text-sm font-bold">

                                Rp {{ number_format($sppBill->amount, 0, ',', '.') }}

                            </p>

                        </div>



                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Status

                            </p>

                            <p class="mt-1.5 text-xs sm:text-sm font-medium">

                                {{ $currentStatusLabel }}

                            </p>

                        </div>



                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Tanggal Pembayaran

                            </p>

                            <p class="mt-1.5 text-[11px] sm:text-xs">

                                {{ $sppBill->paid_at?->format('d M Y, H:i') ?? '-' }}

                            </p>

                        </div>



                        <div>

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Referensi Pembayaran

                            </p>

                            <p class="mt-1.5 text-xs sm:text-sm wrap-break-word">

                                {{ $sppBill->payment_reference ?: '-' }}

                            </p>

                        </div>



                        <div class="sm:col-span-2">

                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                Catatan

                            </p>



                            <div

                                class="mt-1.5 rounded-xl border p-4 text-xs sm:text-sm leading-6"

                                style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

                            >

                                {{ $sppBill->notes ?: 'Tidak ada catatan untuk tagihan ini.' }}

                            </div>

                        </div>

                    </div>



                    {{-- Informasi sistem --}}

                    <div class="border-t pt-5" style="border-color: var(--admin-border);">

                        <h2 class="text-sm sm:text-base font-semibold">

                            Informasi Sistem

                        </h2>



                        <div class="mt-5 grid gap-5 sm:grid-cols-2">

                            <div>

                                <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                    ID Tagihan

                                </p>

                                <p class="mt-1.5 text-xs sm:text-sm font-medium">

                                    #{{ $sppBill->id }}

                                </p>

                            </div>



                            <div>

                                <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                    Siswa Aktif

                                </p>

                                <p class="mt-1.5 text-xs sm:text-sm">

                                    {{ $sppBill->student->status === 'active' ? 'Ya' : 'Tidak' }}

                                </p>

                            </div>



                            <div>

                                <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                    Dibuat

                                </p>

                                <p class="mt-1.5 text-[11px] sm:text-xs">

                                    {{ $sppBill->created_at?->format('d M Y, H:i') ?? '-' }}

                                </p>

                            </div>



                            <div>

                                <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider" style="color: var(--admin-muted);">

                                    Terakhir Diperbarui

                                </p>

                                <p class="mt-1.5 text-[11px] sm:text-xs">

                                    {{ $sppBill->updated_at?->format('d M Y, H:i') ?? '-' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- Ringkasan dan aksi --}}

                <div class="space-y-6">

                    <div

                        class="rounded-2xl p-5 sm:p-6 shadow-sm"

                        style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

                    >

                        <h2 class="text-sm sm:text-base font-semibold">

                            Ringkasan Tagihan

                        </h2>



                        <div class="mt-5 space-y-4">

                            <div>

                                <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                                    Siswa

                                </p>

                                <p class="mt-1 text-xs sm:text-sm font-semibold">

                                    {{ $sppBill->student->name }}

                                </p>

                            </div>



                            <div>

                                <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                                    Kelas

                                </p>

                                <p class="mt-1 text-xs sm:text-sm">

                                    {{ $sppBill->student->classRoom?->name ?? '-' }}

                                </p>

                            </div>



                            <div>

                                <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                                    Periode

                                </p>

                                <p class="mt-1 text-xs sm:text-sm">

                                    {{ $sppBill->period }}

                                </p>

                            </div>



                            <div class="border-t pt-4" style="border-color: var(--admin-border);">

                                <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                                    Total Tagihan

                                </p>

                                <p class="mt-1 text-xs sm:text-sm font-bold tracking-tight">

                                    Rp {{ number_format($sppBill->amount, 0, ',', '.') }}

                                </p>

                            </div>

                        </div>



                        {{-- Aksi hapus --}}

                        <div class="mt-5 border-t pt-5" style="border-color: var(--admin-border);">

                            <form

                                action="{{ route('admin.spp-bills.destroy', $sppBill) }}"

                                method="POST"

                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan SPP ini?')"

                            >

                                @csrf

                                @method('DELETE')



                                <button

                                    type="submit"

                                    class="inline-flex w-full items-center justify-center rounded-xl px-4 py-2.5 text-[13px] sm:text-sm font-semibold transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: #ef4444;"

                                    onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.1)'"

                                    onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"

                                >

                                    Hapus Tagihan

                                </button>

                            </form>

                        </div>

                    </div>



                    {{-- Keterangan status --}}

                    @if ($sppBill->status === 'paid')

                        <div

                            class="rounded-2xl p-5"

                            style="background-color: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3);"

                        >

                            <p class="text-sm sm:text-base font-semibold text-emerald-600 dark:text-emerald-400">

                                Pembayaran Lunas

                            </p>

                            <p class="mt-1 text-xs sm:text-sm leading-5" style="color: var(--admin-text);">

                                Tagihan ini telah tercatat sebagai lunas

                                @if ($sppBill->paid_at)

                                    pada {{ $sppBill->paid_at->format('d M Y, H:i') }}.

                                @else

                                    .

                                @endif

                            </p>

                        </div>

                    @elseif ($sppBill->status === 'unpaid')

                        <div

                            class="rounded-2xl p-5"

                            style="background-color: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3);"

                        >

                            <p class="text-sm sm:text-base font-semibold text-amber-600 dark:text-amber-400">

                                Belum Lunas

                            </p>

                            <p class="mt-1 text-xs sm:text-sm leading-5" style="color: var(--admin-text);">

                                Tagihan ini masih memiliki status belum lunas.

                            </p>

                        </div>

                    @elseif ($sppBill->status === 'pending')

                        <div

                            class="rounded-2xl p-5"

                            style="background-color: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3);"

                        >

                            <p class="text-sm sm:text-base font-semibold text-blue-600 dark:text-blue-400">

                                Menunggu Pembayaran

                            </p>

                            <p class="mt-1 text-xs sm:text-sm leading-5" style="color: var(--admin-text);">

                                Pembayaran tagihan masih menunggu proses.

                            </p>

                        </div>

                    @elseif ($sppBill->status === 'failed')

                        <div

                            class="rounded-2xl p-5"

                            style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3);"

                        >

                            <p class="text-sm sm:text-base font-semibold text-red-600 dark:text-red-400">

                                Pembayaran Gagal

                            </p>

                            <p class="mt-1 text-xs sm:text-sm leading-5" style="color: var(--admin-text);">

                                Pembayaran untuk tagihan ini gagal diproses.

                            </p>

                        </div>

                    @elseif ($sppBill->status === 'expired')

                        <div

                            class="rounded-2xl p-5"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);"

                        >

                            <p class="text-sm sm:text-base font-semibold">

                                Tagihan Expired

                            </p>

                            <p class="mt-1 text-xs sm:text-sm leading-5" style="color: var(--admin-muted);">

                                Masa pembayaran untuk tagihan ini telah berakhir.

                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-admin-layout>
