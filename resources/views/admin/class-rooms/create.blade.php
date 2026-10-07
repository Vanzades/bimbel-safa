<x-admin-layout>
    <x-slot name="title">
        Tambah Kelas
    </x-slot>

    @php
        $labelClass = 'mb-2 block text-[13px] font-medium sm:text-sm';
        $fieldClass = 'box-border h-10 w-full min-w-0 rounded-lg px-3.5 text-xs outline-none transition-colors duration-150 sm:text-[13px]';
        $fieldStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';
    @endphp

    <div
        class="-mt-3 min-h-screen pt-0 pb-4 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);"
    >
        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-6">

            {{-- Breadcrumb --}}
            <nav
                aria-label="Breadcrumb"
                class="mb-3 flex min-w-0 items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);"
            >
                <a href="{{ route('admin.dashboard') }}" class="shrink-0 hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <a href="{{ route('admin.class-rooms.index') }}" class="shrink-0 hover:opacity-85">
                    Kelas
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="truncate font-semibold" style="color: var(--admin-text);">
                    Tambah Kelas
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mb-12 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Tambah Kelas
                </h1>
                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Tambahkan kelas baru ke sistem.
                </p>
            </div>

            {{-- Pesan error --}}
            @if ($errors->any())
                <div
                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
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

            {{-- Card form --}}
            <section
                class="overflow-hidden rounded-2xl border shadow-sm"
                style="border-color: var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                <div class="border-b px-5 py-5 sm:px-6" style="border-color: var(--admin-border);">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                            style="background-color: var(--admin-surface-soft); color: #2563EB;"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 7.5A1.75 1.75 0 0 1 5.5 5.75h4l2 2h7A1.75 1.75 0 0 1 20.25 9.5v8A1.75 1.75 0 0 1 18.5 19.25h-13A1.75 1.75 0 0 1 3.75 17.5v-10Z"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h2 class="text-sm font-semibold sm:text-base">
                                Informasi Kelas
                            </h2>
                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                Masukkan informasi kelas yang akan digunakan untuk mengelompokkan siswa.
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.class-rooms.store') }}">
                    @csrf

                    <div class="grid min-w-0 grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                        {{-- Nama kelas --}}
                        <div class="min-w-0">
                            <label for="name" class="{{ $labelClass }}">
                                Nama Kelas
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                placeholder="Contoh: Matematika Dasar"
                                class="{{ $fieldClass }}"
                                style="{{ $fieldStyle }}"
                            >

                            @error('name')
                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Kode kelas --}}
                        <div class="min-w-0">
                            <label for="code" class="{{ $labelClass }}">
                                Kode Kelas
                            </label>

                            <input
                                id="code"
                                name="code"
                                type="text"
                                value="{{ old('code') }}"
                                required
                                placeholder="Contoh: MTK-DASAR"
                                class="{{ $fieldClass }} uppercase"
                                style="{{ $fieldStyle }}"
                            >

                            <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                Kode kelas harus berbeda dari kelas lainnya.
                            </p>

                            @error('code')
                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="min-w-0">
                            <label for="status" class="{{ $labelClass }}">
                                Status
                            </label>

                            <div class="relative">
                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="{{ $fieldClass }} appearance-none pr-10"
                                    style="{{ $fieldStyle }}"
                                >
                                    <option value="active" @selected(old('status', 'active') === 'active')>
                                        Aktif
                                    </option>
                                    <option value="inactive" @selected(old('status') === 'inactive')>
                                        Tidak Aktif
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

                        {{-- Deskripsi --}}
                        <div class="min-w-0 sm:col-span-2">
                            <label for="description" class="{{ $labelClass }}">
                                Deskripsi
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Tambahkan deskripsi kelas jika diperlukan"
                                class="box-border w-full min-w-0 resize-y rounded-lg px-3.5 py-3 text-xs outline-none transition-colors duration-150 sm:text-[13px]"
                                style="{{ $fieldStyle }}"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol aksi --}}
                    <div
                        class="flex flex-col-reverse gap-3 border-t p-5 sm:flex-row sm:justify-end sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <a
                            href="{{ route('admin.class-rooms.index') }}"
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
                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"
                        >
                            Simpan Kelas
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-admin-layout>
