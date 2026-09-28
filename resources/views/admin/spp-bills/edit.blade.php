<x-admin-layout>

    <x-slot name="title">

        Edit Tagihan SPP

    </x-slot>



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

                    Edit Tagihan SPP

                </span>

            </nav>



            {{-- Judul halaman --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Edit Tagihan SPP

                    </h1>



                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Perbarui informasi tagihan SPP siswa.

                    </p>

                </div>

            </div>



            {{-- Pesan error --}}

            @if ($errors->any())

                <div

                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"

                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"

                >

                    <div class="font-semibold mb-1">

                        Periksa kembali data yang dimasukkan.

                    </div>



                    <ul class="list-disc list-inside space-y-0.5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- Satu card utama --}}

            <div

                class="rounded-2xl p-5 sm:p-6 shadow-sm"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

            >

{{-- Ringkasan Tagihan --}}

<section class="pb-6 border-b" style="border-color: var(--admin-border);">

    <h2 class="text-sm sm:text-base font-semibold">

        Ringkasan Tagihan

    </h2>



    <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div

            class="rounded-xl border p-4"

            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

        >

            <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                Siswa

            </p>

            <p class="mt-2 text-xs sm:text-sm font-semibold">

                {{ $sppBill->student->name }}

            </p>

        </div>



        <div

            class="rounded-xl border p-4"

            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

        >

            <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                Kelas

            </p>

            <p class="mt-2 text-xs sm:text-sm font-semibold">

                {{ $sppBill->student->classRoom?->name ?? '-' }}

            </p>

        </div>



        <div

            class="rounded-xl border p-4"

            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

        >

            <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                Periode

            </p>

            <p class="mt-2 text-xs sm:text-sm font-semibold">

                {{ $sppBill->period }}

            </p>

        </div>



        <div

            class="rounded-xl border p-4"

            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

        >

            <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                Dibuat

            </p>

            <p class="mt-2 text-[11px] sm:text-xs font-semibold">

                {{ $sppBill->created_at?->format('d M Y, H:i') }}

            </p>

        </div>

    </div>



    <div

        class="mt-4 rounded-xl border p-4"

        style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

    >

        <p class="text-sm sm:text-base font-semibold">

            Perhatian

        </p>

        <p class="mt-1 text-xs sm:text-sm leading-5" style="color: var(--admin-muted);">

            Perubahan siswa, bulan, atau tahun akan tetap divalidasi agar tidak terjadi duplikasi tagihan pada periode yang sama.

        </p>

    </div>

</section>



                <form

                    action="{{ route('admin.spp-bills.update', $sppBill) }}"

                    method="POST"

                >

                    @csrf

                    @method('PUT')



                    {{-- Informasi Tagihan --}}

                    <section class="py-6">

                        <div class="mb-5">

                            <h2 class="text-sm sm:text-base font-semibold">

                                Informasi Tagihan

                            </h2>



                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                                Perbarui data utama tagihan SPP.

                            </p>

                        </div>



                        <div class="space-y-5">

                            <div>

                                <label for="student_id" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    Siswa <span style="color: var(--admin-danger, #dc2626);">*</span>

                                </label>



                                <select

                                    id="student_id"

                                    name="student_id"

                                    required

                                    class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >

                                    <option value="">Pilih siswa</option>



                                    @foreach ($students as $student)

                                        <option

                                            value="{{ $student->id }}"

                                            @selected(old('student_id', $sppBill->student_id) == $student->id)

                                        >

                                            {{ $student->name }} — {{ $student->identity_number }}

                                            @if ($student->classRoom)

                                                — {{ $student->classRoom->name }}

                                            @endif

                                        </option>

                                    @endforeach

                                </select>



                                @error('student_id')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>



                            <div class="grid gap-5 sm:grid-cols-2">

                                <div>

                                    <label for="amount" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                        Nominal SPP <span style="color: var(--admin-danger, #dc2626);">*</span>

                                    </label>



                                    <div class="relative">

                                        <span

                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[13px] sm:text-sm"

                                            style="color: var(--admin-muted);"

                                        >

                                            Rp

                                        </span>



                                        <input

                                            type="number"

                                            id="amount"

                                            name="amount"

                                            value="{{ old('amount', $sppBill->amount) }}"

                                            min="0"

                                            step="0.01"

                                            required

                                            class="w-full rounded-xl py-2.5 pl-11 pr-4 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                        >

                                    </div>



                                    @error('amount')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>



                                <div>

                                    <label for="status" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                        Status <span style="color: var(--admin-danger, #dc2626);">*</span>

                                    </label>



                                    <select

                                        id="status"

                                        name="status"

                                        required

                                        class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                    >

                                        <option value="unpaid" @selected(old('status', $sppBill->status) === 'unpaid')>

                                            Belum Lunas

                                        </option>

                                        <option value="pending" @selected(old('status', $sppBill->status) === 'pending')>

                                            Menunggu Pembayaran

                                        </option>

                                        <option value="paid" @selected(old('status', $sppBill->status) === 'paid')>

                                            Lunas

                                        </option>

                                        <option value="failed" @selected(old('status', $sppBill->status) === 'failed')>

                                            Gagal

                                        </option>

                                        <option value="expired" @selected(old('status', $sppBill->status) === 'expired')>

                                            Expired

                                        </option>

                                    </select>



                                    @error('status')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>

                            </div>



                            <div class="grid gap-5 sm:grid-cols-2">

                                <div>

                                    <label for="month" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                        Bulan <span style="color: var(--admin-danger, #dc2626);">*</span>

                                    </label>



                                    <select

                                        id="month"

                                        name="month"

                                        required

                                        class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                    >

                                        <option value="">Pilih bulan</option>



                                        @foreach ($months as $number => $name)

                                            <option

                                                value="{{ $number }}"

                                                @selected(old('month', $sppBill->month) == $number)

                                            >

                                                {{ $name }}

                                            </option>

                                        @endforeach

                                    </select>



                                    @error('month')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>



                                <div>

                                    <label for="year" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                        Tahun <span style="color: var(--admin-danger, #dc2626);">*</span>

                                    </label>



                                    <input

                                        type="number"

                                        id="year"

                                        name="year"

                                        value="{{ old('year', $sppBill->year) }}"

                                        min="2000"

                                        max="2100"

                                        required

                                        class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                    >



                                    @error('year')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>

                            </div>



                            <div class="grid gap-5 sm:grid-cols-2">

                                <div>

                                    <label for="paid_at" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                        Tanggal Pembayaran

                                    </label>



                                    <input

                                        type="datetime-local"

                                        id="paid_at"

                                        name="paid_at"

                                        value="{{ old('paid_at', $sppBill->paid_at?->format('Y-m-d\TH:i')) }}"

                                        class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                    >



                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">

                                        Isi jika tagihan sudah dibayar.

                                    </p>



                                    @error('paid_at')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>



                                <div>

                                    <label for="payment_reference" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                        Referensi Pembayaran

                                    </label>



                                    <input

                                        type="text"

                                        id="payment_reference"

                                        name="payment_reference"

                                        value="{{ old('payment_reference', $sppBill->payment_reference) }}"

                                        placeholder="Contoh: PAY-2026-0001"

                                        class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                    >



                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">

                                        Nomor transaksi atau referensi pembayaran.

                                    </p>



                                    @error('payment_reference')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>

                            </div>



                            <div>

                                <label for="notes" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    Catatan

                                </label>



                                <textarea

                                    id="notes"

                                    name="notes"

                                    rows="4"

                                    placeholder="Tambahkan catatan jika diperlukan..."

                                    class="w-full resize-none rounded-xl px-4 py-3 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >{{ old('notes', $sppBill->notes) }}</textarea>



                                @error('notes')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>

                        </div>

                    </section>



                    {{-- Tombol aksi --}}

                    <div

                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t pt-5"

                        style="border-color: var(--admin-border);"

                    >

                        <a

                            href="{{ route('admin.spp-bills.show', $sppBill) }}"

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-medium transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"

                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"

                        >

                            Batal

                        </a>



                        <button

                            type="submit"

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition-opacity hover:brightness-110"

                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"

                        >

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-admin-layout>
