<x-admin-layout>



    <x-slot name="title">

        Edit Guru

    </x-slot>



    @php

        $inputStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';

        $labelStyle = 'color: var(--admin-text);';

    @endphp



    <div class="py-4 lg:py-6 min-h-screen transition-colors duration-150"

        style="background-color: var(--admin-bg); color: var(--admin-text);">



        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">



            {{-- Breadcrumb --}}

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3"

                style="color: var(--admin-muted);">



                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">

                    Dashboard

                </a>



                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                </svg>



                <a href="{{ route('admin.teachers.index') }}" class="hover:opacity-85">

                    Guru

                </a>



                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                </svg>



                <span class="font-semibold" style="color: var(--admin-text);">

                    Edit Guru

                </span>

            </nav>



            {{-- Judul Halaman --}}

            <div class="mt-8 mb-12">

                <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                    Edit Guru

                </h1>



                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                    Perbarui informasi guru yang dipilih.

                </p>

            </div>



            {{-- Error Messages --}}

            @if ($errors->any())

                <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"

                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">



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



            {{-- Card Utama --}}

            <div class="rounded-2xl shadow-sm"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">



                {{-- Informasi Guru yang Sedang Diedit --}}

                <div class="mx-5 mt-5 sm:mx-6 sm:mt-6 rounded-xl px-4 py-3"

                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">



                    <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Sedang mengedit data guru

                    </p>



                    <p class="mt-1 text-xs sm:text-sm font-semibold" style="color: var(--admin-text);">

                        {{ $teacher->name }}

                    </p>



                    <p class="mt-0.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">

                        Nomor identitas: {{ $teacher->identity_number }}

                    </p>

                </div>



                <form

                    method="POST"

                    action="{{ route('admin.teachers.update', $teacher) }}"

                    class="mt-5 sm:mt-6">



                    @csrf

                    @method('PUT')



                    {{-- Header Form --}}

                    <div class="px-5 sm:px-6 pb-5 border-b"

                        style="border-color: var(--admin-border);">



                        <h2 class="text-sm sm:text-base font-semibold" style="color: var(--admin-text);">

                            Informasi Guru

                        </h2>



                        <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                            Perbarui informasi dasar guru sesuai kebutuhan.

                        </p>

                    </div>



                    {{-- Form Fields --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5 sm:p-6">



                        {{-- Nama Lengkap --}}

                        <div class="md:col-span-2">

                            <label for="name" class="block text-[13px] sm:text-sm font-medium mb-2" style="{{ $labelStyle }}">

                                Nama Lengkap

                            </label>



                            <input

                                id="name"

                                name="name"

                                type="text"

                                value="{{ old('name', $teacher->name) }}"

                                required

                                autofocus

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="{{ $inputStyle }}">



                            @error('name')

                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-500">{{ $message }}</p>

                            @enderror

                        </div>



                        {{-- NIK / Nomor Identitas --}}

                        <div>

                            <label for="identity_number" class="block text-[13px] sm:text-sm font-medium mb-2" style="{{ $labelStyle }}">

                                NIK / Nomor Identitas

                            </label>



                            <input

                                id="identity_number"

                                name="identity_number"

                                type="text"

                                value="{{ old('identity_number', $teacher->identity_number) }}"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="{{ $inputStyle }}">



                            @error('identity_number')

                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-500">{{ $message }}</p>

                            @enderror

                        </div>



                        {{-- Jenis Kelamin --}}

                        <div>

                            <label for="gender" class="block text-[13px] sm:text-sm font-medium mb-2" style="{{ $labelStyle }}">

                                Jenis Kelamin

                            </label>



                            <select

                                id="gender"

                                name="gender"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="{{ $inputStyle }}">



                                <option value="">Pilih jenis kelamin</option>



                                <option value="male" @selected(old('gender', $teacher->gender) === 'male')>

                                    Laki-laki

                                </option>



                                <option value="female" @selected(old('gender', $teacher->gender) === 'female')>

                                    Perempuan

                                </option>

                            </select>



                            @error('gender')

                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-500">{{ $message }}</p>

                            @enderror

                        </div>



                        {{-- Email --}}

                        <div>

                            <label for="email" class="block text-[13px] sm:text-sm font-medium mb-2" style="{{ $labelStyle }}">

                                Email

                            </label>



                            <input

                                id="email"

                                name="email"

                                type="email"

                                value="{{ old('email', $teacher->email) }}"

                                placeholder="contoh\@email.com"

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="{{ $inputStyle }}">



                            @error('email')

                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-500">{{ $message }}</p>

                            @enderror

                        </div>



                        {{-- Nomor Telepon --}}

                        <div>

                            <label for="phone" class="block text-[13px] sm:text-sm font-medium mb-2" style="{{ $labelStyle }}">

                                Nomor Telepon

                            </label>



                            <input

                                id="phone"

                                name="phone"

                                type="text"

                                value="{{ old('phone', $teacher->phone) }}"

                                placeholder="08xxxxxxxxxx"

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="{{ $inputStyle }}">



                            @error('phone')

                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-500">{{ $message }}</p>

                            @enderror

                        </div>



                        {{-- Status --}}

                        <div>

                            <label for="status" class="block text-[13px] sm:text-sm font-medium mb-2" style="{{ $labelStyle }}">

                                Status

                            </label>



                            <select

                                id="status"

                                name="status"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="{{ $inputStyle }}">



                                <option value="active" @selected(old('status', $teacher->status) === 'active')>

                                    Aktif

                                </option>



                                <option value="inactive" @selected(old('status', $teacher->status) === 'inactive')>

                                    Nonaktif

                                </option>

                            </select>



                            @error('status')

                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-500">{{ $message }}</p>

                            @enderror

                        </div>



                        {{-- Alamat --}}

                        <div class="md:col-span-2">

                            <label for="address" class="block text-[13px] sm:text-sm font-medium mb-2" style="{{ $labelStyle }}">

                                Alamat

                            </label>



                            <textarea

                                id="address"

                                name="address"

                                rows="4"

                                placeholder="Masukkan alamat lengkap"

                                class="w-full resize-none rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="{{ $inputStyle }}">{{ old('address', $teacher->address) }}</textarea>



                            @error('address')

                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-500">{{ $message }}</p>

                            @enderror

                        </div>

                    </div>



                    {{-- Tombol Aksi --}}

                    <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 px-5 sm:px-6 py-5 border-t"

                        style="border-color: var(--admin-border);">



                        <a href="{{ route('admin.teachers.index') }}"

                            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-medium transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"

                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">

                            Batal

                        </a>



                        <button

                            type="submit"

                            class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white transition-opacity shadow-md hover:brightness-110"

                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>



</x-admin-layout>
