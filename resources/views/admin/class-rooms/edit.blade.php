<x-admin-layout>
    <x-slot name="title">
        Edit Kelas
    </x-slot>

    @php
        $inputStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';
        $inputClass = 'box-border h-10 w-full min-w-0 rounded-xl px-3.5 text-xs outline-none transition duration-150 focus:ring-2 focus:ring-blue-500/20 sm:text-sm';
        $labelClass = 'mb-2 block text-[13px] font-medium sm:text-sm';
        $errorClass = 'mt-1.5 text-[11px] text-red-500 sm:text-xs';
    @endphp

    {{-- Wrapper mengikuti halaman Akun --}}
    <div
        class="-mt-3 min-h-screen pt-0 pb-4 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);"
    >
        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-6">

            {{-- Breadcrumb --}}
            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <a href="{{ route('admin.class-rooms.index') }}" class="hover:opacity-85">
                    Kelas
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Edit Kelas
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Edit Kelas
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Perbarui informasi kelas.
                </p>
            </div>

            {{-- Pesan error validasi --}}
            @if ($errors->any())
                <div
                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"
                    role="alert"
                >
                    <p class="mb-1 font-semibold">
                        Periksa kembali data yang dimasukkan.
                    </p>

                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card form --}}
            <div
                class="overflow-hidden rounded-2xl shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                {{-- Info kelas yang sedang diedit --}}
                <div class="p-5 pb-0 sm:p-6 sm:pb-0">
                    <div
                        class="flex min-w-0 items-start gap-3 rounded-xl border p-4"
                        style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                    >
                        <span
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                            style="background-color: var(--admin-surface); color: var(--admin-icon); border: 1px solid var(--admin-border);"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 7.5 12 3.75l8.25 3.75L12 11.25 3.75 7.5ZM5.25 9.5v6.25L12 19.5l6.75-3.75V9.5M12 11.25V19.5"/>
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                                Sedang mengedit data kelas
                            </p>

                            <p class="mt-0.5 wrap-break-word text-xs font-semibold sm:text-sm" style="color: var(--admin-text);">
                                {{ $classRoom->name }}
                            </p>

                            <p class="mt-1 wrap-break-word text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                Kode kelas: {{ $classRoom->code }}
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.class-rooms.update', $classRoom) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Informasi kelas --}}
                    <section class="p-5 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 7.5 12 3.75l8.25 3.75L12 11.25 3.75 7.5ZM5.25 9.5v6.25L12 19.5l6.75-3.75V9.5M12 11.25V19.5"/>
                                </svg>
                            </span>

                            <div>
                                <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                    Informasi Kelas
                                </h2>
                                <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Perbarui nama, kode, status, dan deskripsi kelas.
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid min-w-0 grid-cols-1 gap-x-5 gap-y-5 rounded-xl border p-4 sm:grid-cols-2 sm:p-5"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            {{-- Nama kelas --}}
                            <div class="min-w-0">
                                <label for="name" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Nama Kelas
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name', $classRoom->name) }}"
                                    required
                                    autofocus
                                    placeholder="Contoh: Kelas Reguler A"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                >

                                @error('name')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kode kelas --}}
                            <div class="min-w-0">
                                <label for="code" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Kode Kelas
                                </label>

                                <input
                                    type="text"
                                    name="code"
                                    id="code"
                                    value="{{ old('code', $classRoom->code) }}"
                                    required
                                    placeholder="Contoh: REG-A"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                >

                                @error('code')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="min-w-0">
                                <label for="status" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Status
                                </label>

                                <div class="relative">
                                    <select
                                        name="status"
                                        id="status"
                                        required
                                        class="{{ $inputClass }} appearance-none pr-10"
                                        style="{{ $inputStyle }}"
                                    >
                                        <option value="active" @selected(old('status', $classRoom->status) === 'active')>
                                            Aktif
                                        </option>
                                        <option value="inactive" @selected(old('status', $classRoom->status) === 'inactive')>
                                            Tidak Aktif
                                        </option>
                                    </select>

                                    <svg
                                        class="pointer-events-none absolute top-1/2 right-3 h-4 w-4 -translate-y-1/2"
                                        style="color: var(--admin-icon);"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('status')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="min-w-0 sm:col-span-2">
                                <label for="description" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="description"
                                    id="description"
                                    rows="5"
                                    placeholder="Deskripsi kelas"
                                    class="box-border w-full min-w-0 resize-y rounded-xl px-3.5 py-3 text-xs outline-none transition duration-150 focus:ring-2 focus:ring-blue-500/20 sm:text-sm"
                                    style="{{ $inputStyle }}"
                                >{{ old('description', $classRoom->description) }}</textarea>

                                @error('description')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    {{-- Tombol aksi --}}
                    <div
                        class="flex flex-col-reverse gap-2 border-t p-5 sm:flex-row sm:justify-end sm:gap-3 sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <a
                            href="{{ route('admin.class-rooms.index') }}"
                            class="inline-flex h-9 w-full items-center justify-center rounded-lg border px-4 text-[13px] font-medium transition-colors duration-150 sm:w-auto"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-text);"
                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-[13px] font-semibold text-white transition-opacity hover:brightness-110 sm:w-auto"
                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
