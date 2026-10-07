<x-admin-layout>
    <x-slot name="title">
        Edit Siswa
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

                <a href="{{ route('admin.students.index') }}" class="hover:opacity-85">
                    Siswa
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Edit Siswa
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Edit Siswa
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Perbarui informasi siswa yang dipilih.
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
                {{-- Info siswa yang sedang diedit --}}
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM17 8h4M19 6v4"/>
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                                Sedang mengedit data siswa
                            </p>

                            <p class="mt-0.5 wrap-break-word text-xs font-semibold sm:text-sm" style="color: var(--admin-text);">
                                {{ $student->name }}
                            </p>

                            <p class="mt-1 wrap-break-word text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                NIS/NISN: {{ $student->identity_number }}
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Identitas siswa --}}
                    <section class="p-5 sm:p-6">
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0ZM4 21a8 8 0 0 1 16 0"/>
                                </svg>
                            </span>

                            <div>
                                <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                    Identitas Siswa
                                </h2>
                                <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Perbarui nama, nomor identitas, dan jenis kelamin siswa.
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid min-w-0 grid-cols-1 gap-x-5 gap-y-5 rounded-xl border p-4 sm:grid-cols-2 sm:p-5"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            {{-- Nama siswa --}}
                            <div class="min-w-0 sm:col-span-2">
                                <label for="name" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Nama Siswa
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', $student->name) }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                >

                                @error('name')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- NIS/NISN --}}
                            <div class="min-w-0">
                                <label for="identity_number" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    NIS/NISN
                                </label>

                                <input
                                    id="identity_number"
                                    name="identity_number"
                                    type="text"
                                    value="{{ old('identity_number', $student->identity_number) }}"
                                    required
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                >

                                @error('identity_number')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jenis kelamin --}}
                            <div class="min-w-0">
                                <label for="gender" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Jenis Kelamin
                                </label>

                                <div class="relative">
                                    <select
                                        id="gender"
                                        name="gender"
                                        required
                                        class="{{ $inputClass }} appearance-none pr-10"
                                        style="{{ $inputStyle }}"
                                    >
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="male" @selected(old('gender', $student->gender) === 'male')>
                                            Laki-laki
                                        </option>
                                        <option value="female" @selected(old('gender', $student->gender) === 'female')>
                                            Perempuan
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

                                @error('gender')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    {{-- Data akademik --}}
                    <section
                        class="border-t px-5 py-5 sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20V5.75A1.75 1.75 0 0 1 5.75 4h12.5A1.75 1.75 0 0 1 20 5.75V20M8 8h2m4 0h2M8 12h2m4 0h2M9 20v-4h6v4"/>
                                </svg>
                            </span>

                            <div>
                                <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                    Data Akademik
                                </h2>
                                <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Atur kelas dan status siswa.
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid min-w-0 grid-cols-1 gap-x-5 gap-y-5 rounded-xl border p-4 sm:grid-cols-2 sm:p-5"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            {{-- Kelas --}}
                            <div class="min-w-0">
                                <label for="class_room_id" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Kelas
                                </label>

                                <div class="relative">
                                    <select
                                        id="class_room_id"
                                        name="class_room_id"
                                        required
                                        class="{{ $inputClass }} appearance-none pr-10"
                                        style="{{ $inputStyle }}"
                                    >
                                        <option value="">Pilih kelas</option>

                                        @foreach ($classRooms as $classRoom)
                                            <option
                                                value="{{ $classRoom->id }}"
                                                @selected((string) old('class_room_id', $student->class_room_id) === (string) $classRoom->id)
                                            >
                                                {{ $classRoom->name }} ({{ $classRoom->code }})
                                            </option>
                                        @endforeach
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

                                @error('class_room_id')
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
                                        id="status"
                                        name="status"
                                        required
                                        class="{{ $inputClass }} appearance-none pr-10"
                                        style="{{ $inputStyle }}"
                                    >
                                        <option value="active" @selected(old('status', $student->status) === 'active')>
                                            Aktif
                                        </option>
                                        <option value="inactive" @selected(old('status', $student->status) === 'inactive')>
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
                        </div>
                    </section>

                    {{-- Informasi kontak --}}
                    <section
                        class="border-t px-5 py-5 sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6.75A2.75 2.75 0 0 1 6.75 4h10.5A2.75 2.75 0 0 1 20 6.75v10.5A2.75 2.75 0 0 1 17.25 20H6.75A2.75 2.75 0 0 1 4 17.25V6.75ZM5 6l7 6 7-6"/>
                                </svg>
                            </span>

                            <div>
                                <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                    Informasi Kontak
                                </h2>
                                <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Perbarui nomor telepon dan alamat siswa.
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid min-w-0 grid-cols-1 gap-x-5 gap-y-5 rounded-xl border p-4 sm:grid-cols-2 sm:p-5"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            {{-- Nomor telepon --}}
                            <div class="min-w-0">
                                <label for="phone" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    No. Telepon
                                </label>

                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone', $student->phone) }}"
                                    placeholder="08xxxxxxxxxx"
                                    autocomplete="tel"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                >

                                @error('phone')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="min-w-0 sm:col-span-2">
                                <label for="address" class="{{ $labelClass }}" style="color: var(--admin-text);">
                                    Alamat
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    placeholder="Masukkan alamat lengkap"
                                    class="box-border w-full min-w-0 resize-y rounded-xl px-3.5 py-3 text-xs outline-none transition duration-150 focus:ring-2 focus:ring-blue-500/20 sm:text-sm"
                                    style="{{ $inputStyle }}"
                                >{{ old('address', $student->address) }}</textarea>

                                @error('address')
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
                            href="{{ route('admin.students.index') }}"
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
