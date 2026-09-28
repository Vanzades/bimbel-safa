<x-admin-layout>

    <x-slot name="title">

        Edit Kelas

    </x-slot>

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

                <a href="{{ route('admin.class-rooms.index') }}" class="hover:opacity-85">

                    Kelas

                </a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">

                    Edit Kelas

                </span>

            </nav>

            {{-- Judul halaman --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Edit Kelas

                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Perbarui informasi kelas.

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

                <form

                    action="{{ route('admin.class-rooms.update', $classRoom) }}"

                    method="POST"

                >

                    @csrf

                    @method('PUT')

                    {{-- Informasi Kelas --}}

                    <div class="mb-6">

                        <h2 class="text-sm sm:text-base font-semibold">

                            Informasi Kelas

                        </h2>

                        <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                            Perbarui nama, kode, status, dan deskripsi kelas.

                        </p>

                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">

                        <div>

                            <label for="name" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Nama Kelas

                            </label>

                            <input

                                type="text"

                                name="name"

                                id="name"

                                value="{{ old('name', $classRoom->name) }}"

                                required

                                placeholder="Contoh: Kelas Reguler A"

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('name')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        <div>

                            <label for="code" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Kode Kelas

                            </label>

                            <input

                                type="text"

                                name="code"

                                id="code"

                                value="{{ old('code', $classRoom->code) }}"

                                required

                                placeholder="Contoh: REG-A"

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('code')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        <div>

                            <label for="status" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Status

                            </label>

                            <select

                                name="status"

                                id="status"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                                <option value="active" {{ old('status', $classRoom->status) === 'active' ? 'selected' : '' }}>

                                    Aktif

                                </option>

                                <option value="inactive" {{ old('status', $classRoom->status) === 'inactive' ? 'selected' : '' }}>

                                    Tidak Aktif

                                </option>

                            </select>

                            @error('status')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        <div class="sm:col-span-2">

                            <label for="description" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Deskripsi

                            </label>

                            <textarea

                                name="description"

                                id="description"

                                rows="5"

                                placeholder="Deskripsi kelas"

                                class="w-full resize-none rounded-xl px-4 py-3 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >{{ old('description', $classRoom->description) }}</textarea>

                            @error('description')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>

                    {{-- Tombol aksi --}}

                    <div

                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6 pt-5 border-t"

                        style="border-color: var(--admin-border);"

                    >

                        <a

                            href="{{ route('admin.class-rooms.index') }}"

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
