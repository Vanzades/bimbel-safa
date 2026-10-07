<x-admin-layout>
    <x-slot name="title">
        Tambah Akun
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

                <a href="{{ route('admin.users.index') }}" class="shrink-0 hover:opacity-85">
                    Akun
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="truncate font-semibold" style="color: var(--admin-text);">
                    Tambah Akun
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mb-12 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Tambah Akun Pengguna
                </h1>
                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Buat akun untuk Admin, Guru, atau Siswa.
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm10 2v6m3-3h-6"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h2 class="text-sm font-semibold sm:text-base">
                                Informasi Akun
                            </h2>
                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                Isi data akun dan pilih role pengguna.
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="p-5 sm:p-6">
                        <div class="grid min-w-0 grid-cols-1 gap-5 sm:grid-cols-2">

                            {{-- Nama --}}
                            <div class="min-w-0">
                                <label for="name" class="{{ $labelClass }}">
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
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('name')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="min-w-0">
                                <label for="email" class="{{ $labelClass }}">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="contoh@email.com"
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('email')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Role --}}
                            <div class="min-w-0">
                                <label for="role" class="{{ $labelClass }}">
                                    Role
                                </label>

                                <div class="relative">
                                    <select
                                        name="role"
                                        id="role"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
                                    >
                                        <option value="">Pilih role</option>
                                        <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                                        <option value="guru" @selected(old('role') === 'guru')>Guru</option>
                                        <option value="siswa" @selected(old('role') === 'siswa')>Siswa</option>
                                    </select>

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('role')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Data Guru --}}
                            <div
                                id="teacher-field"
                                class="{{ old('role') === 'guru' ? '' : 'hidden' }} min-w-0 sm:col-span-2"
                            >
                                <label for="teacher_id" class="{{ $labelClass }}">
                                    Data Guru
                                </label>

                                <div class="relative">
                                    <select
                                        name="teacher_id"
                                        id="teacher_id"
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
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

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

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
                                class="{{ old('role') === 'siswa' ? '' : 'hidden' }} min-w-0 sm:col-span-2"
                            >
                                <label for="student_id" class="{{ $labelClass }}">
                                    Data Siswa
                                </label>

                                <div class="relative">
                                    <select
                                        name="student_id"
                                        id="student_id"
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
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

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

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
                            <div class="min-w-0">
                                <label for="password" class="{{ $labelClass }}">
                                    Password
                                </label>

                                <div class="relative">
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        required
                                        placeholder="Minimal 8 karakter"
                                        class="{{ $fieldClass }} pr-12"
                                        style="{{ $fieldStyle }}"
                                    >

                                    <button
                                        type="button"
                                        data-password-toggle
                                        aria-controls="password"
                                        aria-label="Tampilkan password"
                                        class="absolute inset-y-0 right-0 flex items-center px-3 transition-opacity hover:opacity-70"
                                        style="color: var(--admin-muted);"
                                    >
                                        <svg data-eye-open class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.5 12s3.4-7 9.5-7 9.5 7 9.5 7-3.4 7-9.5 7-9.5-7-9.5-7Z"/>
                                            <circle cx="12" cy="12" r="3" stroke-width="1.8"/>
                                        </svg>

                                        <svg data-eye-closed class="hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.9 5.2A10 10 0 0 1 12 5c6.1 0 9.5 7 9.5 7a16 16 0 0 1-3 3.8M6.2 6.2C3.8 7.8 2.5 12 2.5 12s3.4 7 9.5 7c1.3 0 2.5-.3 3.5-.8"/>
                                        </svg>
                                    </button>
                                </div>

                                @error('password')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Konfirmasi password --}}
                            <div class="min-w-0">
                                <label for="password_confirmation" class="{{ $labelClass }}">
                                    Konfirmasi Password
                                </label>

                                <div class="relative">
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        required
                                        placeholder="Ulangi password"
                                        class="{{ $fieldClass }} pr-12"
                                        style="{{ $fieldStyle }}"
                                    >

                                    <button
                                        type="button"
                                        data-password-toggle
                                        aria-controls="password_confirmation"
                                        aria-label="Tampilkan password"
                                        class="absolute inset-y-0 right-0 flex items-center px-3 transition-opacity hover:opacity-70"
                                        style="color: var(--admin-muted);"
                                    >
                                        <svg data-eye-open class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.5 12s3.4-7 9.5-7 9.5 7 9.5 7-3.4 7-9.5 7-9.5-7-9.5-7Z"/>
                                            <circle cx="12" cy="12" r="3" stroke-width="1.8"/>
                                        </svg>

                                        <svg data-eye-closed class="hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.9 5.2A10 10 0 0 1 12 5c6.1 0 9.5 7 9.5 7a16 16 0 0 1-3 3.8M6.2 6.2C3.8 7.8 2.5 12 2.5 12s3.4 7 9.5 7c1.3 0 2.5-.3 3.5-.8"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <p class="mt-5 text-[11px] leading-5 sm:text-xs" style="color: var(--admin-muted);">
                            Akun Guru atau Siswa akan dihubungkan dengan data yang dipilih.
                        </p>
                    </div>

                    {{-- Tombol aksi --}}
                    <div
                        class="flex flex-col-reverse gap-3 border-t p-5 sm:flex-row sm:justify-end sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <a
                            href="{{ route('admin.users.index') }}"
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
                if (!role || !teacherField || !studentField || !teacherSelect || !studentSelect) {
                    return;
                }

                if (!isInitializing) {
                    teacherField.classList.add('hidden');
                    studentField.classList.add('hidden');

                    teacherSelect.removeAttribute('required');
                    studentSelect.removeAttribute('required');

                    if (role.value !== 'guru') {
                        teacherSelect.value = '';
                    }

                    if (role.value !== 'siswa') {
                        studentSelect.value = '';
                    }
                }

                if (role.value === 'guru') {
                    teacherField.classList.remove('hidden');
                    teacherSelect.setAttribute('required', 'required');
                } else if (role.value === 'siswa') {
                    studentField.classList.remove('hidden');
                    studentSelect.setAttribute('required', 'required');
                }
            }

            if (role) {
                role.addEventListener('change', function () {
                    updateFields();
                });

                updateFields(true);
            }

            document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
                button.addEventListener('click', function () {
                    const input = document.getElementById(button.getAttribute('aria-controls'));

                    if (!input) {
                        return;
                    }

                    const showPassword = input.type === 'password';
                    input.type = showPassword ? 'text' : 'password';

                    button.setAttribute(
                        'aria-label',
                        showPassword ? 'Sembunyikan password' : 'Tampilkan password'
                    );

                    button.querySelector('[data-eye-open]')?.classList.toggle('hidden', showPassword);
                    button.querySelector('[data-eye-closed]')?.classList.toggle('hidden', !showPassword);
                });
            });
        });
    </script>
</x-admin-layout>
