<x-admin-layout>

    <x-slot name="title">

        Tambah Tagihan SPP

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

        class="min-h-screen py-4 transition-colors duration-150 lg:py-6"

        style="background-color: var(--admin-bg); color: var(--admin-text);"

    >

        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-10">



            {{-- Breadcrumb --}}

            <nav

                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"

                style="color: var(--admin-muted);"

                aria-label="Breadcrumb"

            >

                <a href="{{ route('admin.dashboard') }}" class="transition-opacity hover:opacity-85">

                    Dashboard

                </a>



                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>



                <a href="{{ route('admin.spp-bills.index') }}" class="transition-opacity hover:opacity-85">

                    SPP

                </a>



                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>



                <span class="font-semibold" style="color: var(--admin-text);">

                    Tambah Tagihan

                </span>

            </nav>



            {{-- Judul halaman --}}

            <div class="mb-8 mt-8 sm:mb-10">

                <div class="flex items-start gap-4">

                    <div>

                        <h1 class="text-xl font-bold tracking-tight sm:text-2xl">

                            Tambah Tagihan SPP

                        </h1>

                        <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                            Buat tagihan baru dan tentukan periode pembayaran siswa.

                        </p>

                    </div>

                </div>

            </div>



            {{-- Ringkasan error --}}

            @if ($errors->any())

                <div

                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"

                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"

                >

                    <p class="mb-1 font-semibold">Periksa kembali data yang dimasukkan.</p>

                    <ul class="list-inside list-disc space-y-0.5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- Form --}}

            <section

                class="overflow-hidden rounded-2xl shadow-sm"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

            >

                <div

                    class="border-b px-5 py-5 sm:px-7"

                    style="border-color: var(--admin-border);"

                >

                    <h2 class="text-sm sm:text-base font-semibold">Informasi Tagihan</h2>

                    <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Isi informasi siswa, nominal, dan periode tagihan.

                    </p>

                </div>



                <form action="{{ route('admin.spp-bills.store') }}" method="POST" class="p-5 sm:p-7">

                    @csrf



                    <div class="space-y-8">



                        {{-- Data siswa --}}

                        <section>

                            <div class="mb-5">

                                <h3 class="text-sm sm:text-base font-semibold">Data Siswa</h3>

                                <p class="mt-1 text-[11px] sm:text-xs" style="color: var(--admin-muted);">

                                    Pilih siswa yang akan menerima tagihan.

                                </p>

                            </div>



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

                                            @selected(old('student_id') == $student->id)

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

                        </section>



                        <div class="border-t" style="border-color: var(--admin-border);"></div>



                        {{-- Rincian tagihan --}}

                        <section>

                            <div class="mb-5">

                                <h3 class="text-sm sm:text-base font-semibold">Rincian Tagihan</h3>

                                <p class="mt-1 text-[11px] sm:text-xs" style="color: var(--admin-muted);">

                                    Atur nominal, status, dan periode pembayaran.

                                </p>

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

                                            value="{{ old('amount') }}"

                                            min="0"

                                            step="0.01"

                                            required

                                            placeholder="500000"

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

                                        <option value="unpaid" @selected(old('status', 'unpaid') === 'unpaid')>

                                            Belum Lunas

                                        </option>

                                        <option value="pending" @selected(old('status') === 'pending')>

                                            Menunggu Pembayaran

                                        </option>

                                        <option value="paid" @selected(old('status') === 'paid')>

                                            Lunas

                                        </option>

                                        <option value="failed" @selected(old('status') === 'failed')>

                                            Gagal

                                        </option>

                                        <option value="expired" @selected(old('status') === 'expired')>

                                            Expired

                                        </option>

                                    </select>



                                    @error('status')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>



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

                                            <option value="{{ $number }}" @selected(old('month') == $number)>

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

                                        value="{{ old('year', date('Y')) }}"

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

                        </section>



                        <div class="border-t" style="border-color: var(--admin-border);"></div>



                        {{-- Informasi pembayaran --}}

                        <section>

                            <div class="mb-5">

                                <h3 class="text-sm sm:text-base font-semibold">Informasi Pembayaran</h3>

                                <p class="mt-1 text-[11px] sm:text-xs" style="color: var(--admin-muted);">

                                    Data berikut opsional dan bisa diisi untuk mencatat pembayaran.

                                </p>

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

                                        value="{{ old('paid_at') }}"

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

                                        value="{{ old('payment_reference') }}"

                                        placeholder="Contoh: PAY-2026-0001"

                                        class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                    >



                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">

                                        Opsional untuk mencatat nomor transaksi.

                                    </p>



                                    @error('payment_reference')

                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                            {{ $message }}

                                        </p>

                                    @enderror

                                </div>

                            </div>

                        </section>



                        <div class="border-t" style="border-color: var(--admin-border);"></div>



                        {{-- Catatan --}}

                        <section>

                            <label for="notes" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Catatan

                            </label>



                            <textarea

                                id="notes"

                                name="notes"

                                rows="4"

                                placeholder="Tambahkan catatan jika diperlukan..."

                                class="w-full resize-y rounded-xl px-4 py-3 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >{{ old('notes') }}</textarea>



                            @error('notes')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </section>



                        {{-- Informasi tambahan --}}

                        <aside

                            class="rounded-xl border p-4 sm:p-5"

                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

                        >

                            <div class="flex items-start gap-3">

                                <div

                                    class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg"

                                    style="background-color: rgba(245, 158, 11, 0.12); color: #D97706;"

                                >

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"

                                            d="M12 9v3m0 4h.01M10.3 3.9 2.7 17a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/>

                                    </svg>

                                </div>



                                <div>

                                    <h3 class="text-sm sm:text-base font-semibold">Perhatian</h3>

                                    <p class="mt-1 text-[11px] sm:text-xs leading-6" style="color: var(--admin-muted);">

                                        Setiap siswa hanya dapat memiliki satu tagihan untuk bulan dan tahun yang sama.

                                        Jika status dipilih Lunas, tanggal pembayaran bisa dicatat untuk riwayat pembayaran.

                                    </p>

                                </div>

                            </div>

                        </aside>

                    </div>



                    {{-- Tombol aksi --}}

                    <div

                        class="mt-7 flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:justify-end"

                        style="border-color: var(--admin-border);"

                    >

                        <a

                            href="{{ route('admin.spp-bills.index') }}"

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-medium transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"

                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"

                        >

                            Batal

                        </a>



                        <button

                            type="submit"

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition hover:brightness-110"

                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"

                        >

                            Simpan Tagihan

                        </button>

                    </div>

                </form>

            </section>

        </div>

    </div>

</x-admin-layout>
