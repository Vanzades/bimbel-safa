<x-admin-layout>

    <x-slot name="title">

        Tambah Siswa

    </x-slot>



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



                <a href="{{ route('admin.students.index') }}" class="transition-opacity hover:opacity-85">

                    Siswa

                </a>



                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>



                <span class="font-semibold" style="color: var(--admin-text);">

                    Tambah Siswa

                </span>

            </nav>



            {{-- Judul halaman --}}

            <div class="mb-8 mt-8 sm:mb-10">

                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">

                    Tambah Siswa

                </h1>



                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                    Tambahkan data siswa baru ke sistem.

                </p>

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



            {{-- Form utama --}}

            <section

                class="rounded-2xl p-5 shadow-sm sm:p-6"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

            >

                <div class="mb-6">

                    <h2 class="text-sm sm:text-base font-semibold">

                        Informasi Siswa

                    </h2>



                    <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Lengkapi data siswa dan tentukan kelasnya.

                    </p>

                </div>



                <form

                    method="POST"

                    action="{{ route('admin.students.store') }}"

                    class="space-y-6"

                >

                    @csrf



                    <div class="grid gap-5 sm:grid-cols-2">

                        <div class="sm:col-span-2">

                            <label for="name" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Nama Lengkap

                            </label>



                            <input

                                id="name"

                                name="name"

                                type="text"

                                value="{{ old('name') }}"

                                required

                                autofocus

                                placeholder="Masukkan nama lengkap siswa"

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

                                NIS / NISN

                            </label>



                            <input

                                id="identity_number"

                                name="identity_number"

                                type="text"

                                value="{{ old('identity_number') }}"

                                required

                                placeholder="Masukkan NIS atau NISN"

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

                                <option value="male" @selected(old('gender') === 'male')>

                                    Laki-laki

                                </option>

                                <option value="female" @selected(old('gender') === 'female')>

                                    Perempuan

                                </option>

                            </select>



                            @error('gender')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



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



                                @forelse ($classRooms as $classRoom)

                                    <option

                                        value="{{ $classRoom->id }}"

                                        @selected((string) old('class_room_id') === (string) $classRoom->id)

                                    >

                                        {{ $classRoom->name }}

                                        @if ($classRoom->code)

                                            — {{ $classRoom->code }}

                                        @endif

                                    </option>

                                @empty

                                    <option value="" disabled>

                                        Belum ada kelas aktif

                                    </option>

                                @endforelse

                            </select>



                            @error('class_room_id')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror



                            @if ($classRooms->isEmpty())

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-warning, #d97706);">

                                    Belum ada kelas aktif. Buat data kelas terlebih dahulu.

                                </p>

                            @endif

                        </div>



                        <div>

                            <label for="phone" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Nomor Telepon

                            </label>



                            <input

                                id="phone"

                                name="phone"

                                type="text"

                                value="{{ old('phone') }}"

                                placeholder="Contoh: 081234567890"

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >



                            @error('phone')

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

                                <option value="active" @selected(old('status', 'active') === 'active')>

                                    Aktif

                                </option>

                                <option value="inactive" @selected(old('status') === 'inactive')>

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

                            <label for="address" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Alamat

                            </label>



                            <textarea

                                id="address"

                                name="address"

                                rows="4"

                                placeholder="Masukkan alamat siswa"

                                class="w-full resize-y rounded-xl px-4 py-3 text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >{{ old('address') }}</textarea>



                            @error('address')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>



                    <div

                        class="flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:justify-end"

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

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition hover:brightness-110"

                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"

                        >

                            Simpan Siswa

                        </button>

                    </div>

                </form>

            </section>

        </div>

    </div>

</x-admin-layout>
