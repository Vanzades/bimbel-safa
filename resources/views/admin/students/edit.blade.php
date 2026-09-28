<x-admin-layout>

    <x-slot name="title">

        Edit Siswa

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



                <a href="{{ route('admin.students.index') }}" class="hover:opacity-85">

                    Siswa

                </a>



                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>



                <span class="font-semibold" style="color: var(--admin-text);">

                    Edit Siswa

                </span>

            </nav>



            {{-- Judul halaman --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Edit Siswa

                    </h1>



                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Perbarui informasi siswa yang dipilih.

                    </p>

                </div>

            </div>



            {{-- Pesan error --}}

            @if ($errors->any())

                <div

                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"

                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"

                >

                    <div class="font-semibold mb-1">Periksa kembali data yang dimasukkan.</div>



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

                    action="{{ route('admin.students.update', $student) }}"

                    method="POST"

                >

                    @csrf

                    @method('PUT')



                    {{-- Identitas Siswa --}}

                    <section class="pb-6 border-b" style="border-color: var(--admin-border);">

                        <div class="mb-5">

                            <h2 class="text-sm sm:text-base font-semibold">

                                Identitas Siswa

                            </h2>



                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                                Perbarui nama, nomor identitas, dan jenis kelamin siswa.

                            </p>

                        </div>



                        <div class="grid gap-5 sm:grid-cols-2">

                            <div class="sm:col-span-2">

                                <label for="name" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    Nama Siswa

                                </label>



                                <input

                                    id="name"

                                    name="name"

                                    type="text"

                                    value="{{ old('name', $student->name) }}"

                                    required

                                    autofocus

                                    class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >



                                @error('name')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>



                            <div>

                                <label for="identity_number" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    NIS/NISN

                                </label>



                                <input

                                    id="identity_number"

                                    name="identity_number"

                                    type="text"

                                    value="{{ old('identity_number', $student->identity_number) }}"

                                    required

                                    class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >



                                @error('identity_number')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>



                            <div>

                                <label for="gender" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    Jenis Kelamin

                                </label>



                                <select

                                    id="gender"

                                    name="gender"

                                    required

                                    class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >

                                    <option value="">Pilih jenis kelamin</option>

                                    <option value="male" {{ old('gender', $student->gender) === 'male' ? 'selected' : '' }}>

                                        Laki-laki

                                    </option>

                                    <option value="female" {{ old('gender', $student->gender) === 'female' ? 'selected' : '' }}>

                                        Perempuan

                                    </option>

                                </select>



                                @error('gender')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>

                        </div>

                    </section>



                    {{-- Data Akademik --}}

                    <section

                        class="py-6 border-b"

                        style="border-color: var(--admin-border);"

                    >

                        <div class="mb-5">

                            <h2 class="text-sm sm:text-base font-semibold">

                                Data Akademik

                            </h2>



                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                                Atur kelas dan status siswa.

                            </p>

                        </div>



                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>

                                <label for="class_room_id" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    Kelas

                                </label>



                                <select

                                    id="class_room_id"

                                    name="class_room_id"

                                    required

                                    class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >

                                    <option value="">Pilih kelas</option>



                                    @foreach ($classRooms as $classRoom)

                                        <option

                                            value="{{ $classRoom->id }}"

                                            {{ (string) old('class_room_id', $student->class_room_id) === (string) $classRoom->id ? 'selected' : '' }}

                                        >

                                            {{ $classRoom->name }} ({{ $classRoom->code }})

                                        </option>

                                    @endforeach

                                </select>



                                @error('class_room_id')

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

                                    id="status"

                                    name="status"

                                    required

                                    class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >

                                    <option value="active" {{ old('status', $student->status) === 'active' ? 'selected' : '' }}>

                                        Aktif

                                    </option>

                                    <option value="inactive" {{ old('status', $student->status) === 'inactive' ? 'selected' : '' }}>

                                        Tidak Aktif

                                    </option>

                                </select>



                                @error('status')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>

                        </div>

                    </section>



                    {{-- Informasi Kontak --}}

                    <section class="pt-6">

                        <div class="mb-5">

                            <h2 class="text-sm sm:text-base font-semibold">

                                Informasi Kontak

                            </h2>



                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                                Perbarui nomor telepon dan alamat siswa.

                            </p>

                        </div>



                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>

                                <label for="phone" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    No. Telepon

                                </label>



                                <input

                                    id="phone"

                                    name="phone"

                                    type="text"

                                    value="{{ old('phone', $student->phone) }}"

                                    placeholder="08xxxxxxxxxx"

                                    class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >



                                @error('phone')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>



                            <div class="sm:col-span-2">

                                <label for="address" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                    Alamat

                                </label>



                                <textarea

                                    id="address"

                                    name="address"

                                    rows="4"

                                    placeholder="Masukkan alamat lengkap"

                                    class="w-full resize-none rounded-xl px-4 py-3 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >{{ old('address', $student->address) }}</textarea>



                                @error('address')

                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>

                        </div>

                    </section>



                    {{-- Tombol aksi --}}

                    <div

                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6 pt-5 border-t"

                        style="border-color: var(--admin-border);"

                    >

                        <a

                            href="{{ route('admin.students.index') }}"

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
