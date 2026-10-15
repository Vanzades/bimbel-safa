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

        $labelClass = 'mb-2 block text-[13px] font-medium sm:text-sm';
        $fieldClass = 'box-border h-10 w-full min-w-0 rounded-lg px-3.5 text-xs outline-none transition-colors duration-150 sm:text-[13px]';
        $fieldStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';
    @endphp

    <div
        class="-mt-3 min-h-screen pb-4 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);"
    >
        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-6">
            <nav
                aria-label="Breadcrumb"
                class="mb-3 flex min-w-0 items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);"
            >
                <a href="{{ route('admin.dashboard') }}" class="shrink-0 hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7-7"/>
                </svg>

                <a href="{{ route('admin.spp-bills.index') }}" class="shrink-0 hover:opacity-85">
                    SPP
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7-7"/>
                </svg>

                <span class="truncate font-semibold" style="color: var(--admin-text);">
                    Edit Tagihan
                </span>
            </nav>

            <div class="mb-8 mt-7">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Edit Tagihan SPP
                </h1>
                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Perbarui informasi tagihan SPP siswa.
                </p>
            </div>

            @if ($errors->any())
                <div
                    class="mb-5 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"
                >
                    <p class="mb-1 font-semibold">Periksa kembali data yang dimasukkan.</p>
                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li class="wrap-break-word">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section
                class="overflow-hidden rounded-2xl border shadow-sm"
                style="border-color: var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                <div class="border-b px-5 py-5 sm:px-6" style="border-color: var(--admin-border);">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                            style="background-color: var(--admin-surface-soft); color: #2563eb;"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5v-13ZM8 8h8M8 12h8M8 16h4"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h2 class="text-sm font-semibold sm:text-base">
                                Informasi Tagihan
                            </h2>
                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                Perbarui data utama tagihan SPP.
                            </p>
                            <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                Tagihan dibuat:
                                <span style="color: var(--admin-text);">
                                    {{ $sppBill->created_at?->format('d F Y, H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.spp-bills.update', $sppBill) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-5 sm:p-6">
                        <div
                            class="mb-5 rounded-xl border p-4"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            <p class="text-xs font-semibold sm:text-[13px]">
                                Perhatian
                            </p>
                            <p class="mt-1 text-[11px] leading-5 sm:text-xs" style="color: var(--admin-muted);">
                                Perubahan siswa, bulan, atau tahun tetap divalidasi agar tidak terjadi duplikasi tagihan pada periode yang sama.
                            </p>
                        </div>

                        <div class="grid min-w-0 grid-cols-1 gap-5 sm:grid-cols-2">
                            <div class="min-w-0 sm:col-span-2">
                                <label for="student_id" class="{{ $labelClass }}">
                                    Siswa <span style="color: var(--admin-danger, #dc2626);">*</span>
                                </label>

                                <div class="relative">
                                    <select
                                        id="student_id"
                                        name="student_id"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
                                    >
                                        <option value="">Pilih siswa</option>

                                        @foreach ($students as $student)
                                            <option
                                                value="{{ $student->id }}"
                                                @selected(old('student_id', $sppBill->student_id) == $student->id)
                                            >
                                                {{ $student->name }} — {{ $student->identity_number }}@if ($student->classRoom) — {{ $student->classRoom->name }}@endif
                                            </option>
                                        @endforeach
                                    </select>

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('student_id')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="min-w-0">
                                <label for="amount" class="{{ $labelClass }}">
                                    Nominal SPP <span style="color: var(--admin-danger, #dc2626);">*</span>
                                </label>

                                <div class="relative">
                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-xs sm:text-[13px]"
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
                                        class="{{ $fieldClass }} pl-10"
                                        style="{{ $fieldStyle }}"
                                    >
                                </div>

                                @error('amount')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="min-w-0">
                                <label for="status" class="{{ $labelClass }}">
                                    Status <span style="color: var(--admin-danger, #dc2626);">*</span>
                                </label>

                                <div class="relative">
                                    <select
                                        id="status"
                                        name="status"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
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

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('status')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="min-w-0">
                                <label for="month" class="{{ $labelClass }}">
                                    Bulan <span style="color: var(--admin-danger, #dc2626);">*</span>
                                </label>

                                <div class="relative">
                                    <select
                                        id="month"
                                        name="month"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
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

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('month')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="min-w-0">
                                <label for="year" class="{{ $labelClass }}">
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
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('year')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="min-w-0">
                                <label for="paid_at" class="{{ $labelClass }}">
                                    Tanggal Pembayaran
                                </label>

                                <input
                                    type="datetime-local"
                                    id="paid_at"
                                    name="paid_at"
                                    value="{{ old('paid_at', $sppBill->paid_at?->format('Y-m-d\TH:i')) }}"
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
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

                            <div class="min-w-0">
                                <label for="payment_reference" class="{{ $labelClass }}">
                                    Referensi Pembayaran
                                </label>

                                <input
                                    type="text"
                                    id="payment_reference"
                                    name="payment_reference"
                                    value="{{ old('payment_reference', $sppBill->payment_reference) }}"
                                    placeholder="Contoh: PAY-2026-0001"
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
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

                            <div class="min-w-0 sm:col-span-2">
                                <label for="notes" class="{{ $labelClass }}">
                                    Catatan
                                </label>

                                <textarea
                                    id="notes"
                                    name="notes"
                                    rows="4"
                                    placeholder="Tambahkan catatan jika diperlukan..."
                                    class="box-border w-full min-w-0 resize-y rounded-lg px-3.5 py-3 text-xs outline-none transition-colors duration-150 sm:text-[13px]"
                                    style="{{ $fieldStyle }}"
                                >{{ old('notes', $sppBill->notes) }}</textarea>

                                @error('notes')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col-reverse gap-3 border-t p-5 sm:flex-row sm:justify-end sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <a
                            href="{{ route('admin.spp-bills.show', $sppBill) }}"
                            class="inline-flex h-9 w-full items-center justify-center rounded-lg border px-4 text-xs font-medium transition-colors duration-150 sm:w-auto sm:min-w-28 sm:text-[13px]"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-muted);"
                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-xs font-semibold text-white transition-opacity hover:brightness-110 sm:w-auto sm:min-w-36 sm:text-[13px]"
                            style="background-color: #2563eb; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-admin-layout>