<x-admin-layout>

    <x-slot name="title">

        Tambah Akun

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

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">

                    Dashboard

                </a>



                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>



                <a href="{{ route('admin.users.index') }}" class="hover:opacity-85">

                    Akun

                </a>



                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>

                </svg>



                <span class="font-semibold" style="color: var(--admin-text);">

                    Tambah Akun

                </span>

            </nav>



            {{-- Judul halaman --}}

            <div class="mb-8 mt-8">

                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">

                    Tambah Akun Pengguna

                </h1>

                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                    Buat akun untuk Admin, Guru, atau Siswa.

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



            {{-- Form --}}

            <section

                class="overflow-hidden rounded-2xl shadow-sm"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

            >

                <div class="border-b px-5 py-5 sm:px-7" style="border-color: var(--admin-border);">

                    <h2 class="text-sm sm:text-base font-semibold">Informasi Akun</h2>

                </div>



                <form action="{{ route('admin.users.store') }}" method="POST" class="p-5 sm:p-7">

                    @csrf



                    <div class="grid gap-5 sm:grid-cols-2">

                        {{-- Nama --}}

                        <div>

                            <label for="name" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Nama Pengguna

                            </label>

                            <input

                                type="text"

                                name="name"

                                id="name"

                                value="{{ old('name') }}"

                                required

                                autofocus

                                placeholder="Masukkan nama pengguna"

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('name')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- Email --}}

                        <div>

                            <label for="email" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Email

                            </label>

                            <input

                                type="email"

                                name="email"

                                id="email"

                                value="{{ old('email') }}"

                                required

                                placeholder="contoh\@email.com"

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('email')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- Role --}}

                        <div>

                            <label for="role" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Role

                            </label>

                            <select

                                name="role"

                                id="role"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                                <option value="">Pilih role</option>

                                <option value="admin" @selected(old('role') === 'admin')>Admin</option>

                                <option value="guru" @selected(old('role') === 'guru')>Guru</option>

                                <option value="siswa" @selected(old('role') === 'siswa')>Siswa</option>

                            </select>

                            @error('role')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- Data Guru --}}

                        <div

                            id="teacher-field"

                            class="{{ old('role') === 'guru' ? '' : 'hidden' }} sm:col-span-2"

                        >

                            <label for="teacher_id" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Data Guru

                            </label>

                            <select

                                name="teacher_id"

                                id="teacher_id"

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                                <option value="">Pilih guru</option>

                                @foreach ($teachers as $teacher)

                                    <option

                                        value="{{ $teacher->id }}"

                                        @selected(old('teacher_id') == $teacher->id)

                                    >

                                        {{ $teacher->name }} — {{ $teacher->identity_number }}

                                    </option>

                                @endforeach

                            </select>

                            @if ($teachers->isEmpty())

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-warning, #d97706);">

                                    Data guru aktif belum tersedia atau sudah memiliki akun.

                                </p>

                            @endif

                            @error('teacher_id')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- Data Siswa --}}

                        <div

                            id="student-field"

                            class="{{ old('role') === 'siswa' ? '' : 'hidden' }} sm:col-span-2"

                        >

                            <label for="student_id" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Data Siswa

                            </label>

                            <select

                                name="student_id"

                                id="student_id"

                                class="w-full rounded-xl px-4 py-2.5 text-[13px] sm:text-sm outline-none transition-colors"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                                <option value="">Pilih siswa</option>

                                @foreach ($students as $student)

                                    <option

                                        value="{{ $student->id }}"

                                        @selected(old('student_id') == $student->id)

                                    >

                                        {{ $student->name }} — {{ $student->identity_number }}

                                    </option>

                                @endforeach

                            </select>

                            @if ($students->isEmpty())

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-warning, #d97706);">

                                    Data siswa aktif belum tersedia atau sudah memiliki akun.

                                </p>

                            @endif

                            @error('student_id')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- Password --}}

                        <div>

                            <label for="password" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Password

                            </label>

                            <div class="relative">

                                <input

                                    type="password"

                                    name="password"

                                    id="password"

                                    required

                                    placeholder="Minimal 8 karakter"

                                    class="w-full rounded-xl px-4 py-2.5 pr-12 text-[13px] sm:text-sm outline-none transition-colors"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >

                                <button

                                    type="button"

                                    data-password-toggle

                                    aria-controls="password"

                                    aria-label="Tampilkan password"

                                    class="absolute inset-y-0 right-0 flex items-center px-4 transition-opacity hover:opacity-70"

                                    style="color: var(--admin-muted);"

                                >

                                    <svg data-eye-open class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"

                                            d="M2.5 12s3.4-7 9.5-7 9.5 7 9.5 7-3.4 7-9.5 7-9.5-7-9.5-7Z"/>

                                        <circle cx="12" cy="12" r="3" stroke-width="1.8"/>

                                    </svg>

                                    <svg data-eye-closed class="hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"

                                            d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8"/>

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"

                                            d="M9.9 5.2A10 10 0 0 1 12 5c6.1 0 9.5 7 9.5 7a16 16 0 0 1-3 3.8M6.2 6.2C3.8 7.8 2.5 12 2.5 12s3.4 7 9.5 7c1.3 0 2.5-.3 3.5-.8"/>

                                    </svg>

                                </button>

                            </div>

                            @error('password')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- Konfirmasi Password --}}

                        <div>

                            <label for="password_confirmation" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Konfirmasi Password

                            </label>

                            <div class="relative">

                                <input

                                    type="password"

                                    name="password_confirmation"

                                    id="password_confirmation"

                                    required

                                    placeholder="Ulangi password"

                                    class="w-full rounded-xl px-4 py-2.5 pr-12 text-[13px] sm:text-sm outline-none transition-colors"

                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                                >

                                <button

                                    type="button"

                                    data-password-toggle

                                    aria-controls="password_confirmation"

                                    aria-label="Tampilkan password"

                                    class="absolute inset-y-0 right-0 flex items-center px-4 transition-opacity hover:opacity-70"

                                    style="color: var(--admin-muted);"

                                >

                                    <svg data-eye-open class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"

                                            d="M2.5 12s3.4-7 9.5-7 9.5 7 9.5 7-3.4 7-9.5 7-9.5-7-9.5-7Z"/>

                                        <circle cx="12" cy="12" r="3" stroke-width="1.8"/>

                                    </svg>

                                    <svg data-eye-closed class="hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"

                                            d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8"/>

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"

                                            d="M9.9 5.2A10 10 0 0 1 12 5c6.1 0 9.5 7 9.5 7a16 16 0 0 1-3 3.8M6.2 6.2C3.8 7.8 2.5 12 2.5 12s3.4 7 9.5 7c1.3 0 2.5-.3 3.5-.8"/>

                                    </svg>

                                </button>

                            </div>

                        </div>

                    </div>



                    <p class="mt-5 text-[11px] sm:text-xs leading-5" style="color: var(--admin-muted);">

                        Akun Guru atau Siswa akan dihubungkan dengan data yang dipilih.

                    </p>



                    {{-- Tombol aksi --}}

                    <div

                        class="mt-6 flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:justify-end"

                        style="border-color: var(--admin-border);"

                    >

                        <a

                            href="{{ route('admin.users.index') }}"

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-medium transition-colors"

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

                            Buat Akun

                        </button>

                    </div>

                </form>

            </section>

        </div>

    </div>



    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const role = document.getElementById('role');

            const teacherField = document.getElementById('teacher-field');

            const studentField = document.getElementById('student-field');

            const teacherSelect = document.getElementById('teacher_id');

            const studentSelect = document.getElementById('student_id');



            function updateFields(isInitializing = false) {

                if (!isInitializing) {

                    teacherField.classList.add('hidden');

                    studentField.classList.add('hidden');



                    teacherSelect.removeAttribute('required');

                    studentSelect.removeAttribute('required');



                    if (role.value !== 'guru') teacherSelect.value = '';

                    if (role.value !== 'siswa') studentSelect.value = '';

                }



                if (role.value === 'guru') {

                    teacherField.classList.remove('hidden');

                    teacherSelect.setAttribute('required', 'required');

                } else if (role.value === 'siswa') {

                    studentField.classList.remove('hidden');

                    studentSelect.setAttribute('required', 'required');

                }

            }



            role.addEventListener('change', function () {

                updateFields(false);

            });



            updateFields(true);



            document.querySelectorAll('[data-password-toggle]').forEach(function (button) {

                button.addEventListener('click', function () {

                    const input = document.getElementById(button.getAttribute('aria-controls'));

                    const showPassword = input.type === 'password';



                    input.type = showPassword ? 'text' : 'password';

                    button.setAttribute(

                        'aria-label',

                        showPassword ? 'Sembunyikan password' : 'Tampilkan password'

                    );



                    button.querySelector('[data-eye-open]').classList.toggle('hidden', showPassword);

                    button.querySelector('[data-eye-closed]').classList.toggle('hidden', !showPassword);

                });

            });

        });

    </script>

</x-admin-layout>
