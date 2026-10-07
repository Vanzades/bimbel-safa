<x-admin-layout>
    <x-slot name="title">
        Edit Akun Pengguna
    </x-slot>

    @php
        $inputStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';
        $inputClass = 'box-border h-10 w-full min-w-0 rounded-xl px-3.5 text-xs outline-none transition duration-150 focus:ring-2 focus:ring-blue-500/20 sm:text-sm';
        $labelClass = 'mb-2 block text-[13px] font-medium sm:text-sm';
        $labelStyle = 'color: var(--admin-text);';
        $errorClass = 'mt-1.5 text-[11px] text-red-500 sm:text-xs';
    @endphp

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

                <a href="{{ route('admin.users.index') }}" class="hover:opacity-85">
                    Akun Pengguna
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Edit Akun Pengguna
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Edit Akun Pengguna
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Perbarui informasi akun pengguna yang dipilih.
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
                {{-- Info akun yang sedang diedit --}}
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
                                Sedang mengedit akun pengguna
                            </p>

                            <p class="mt-0.5 wrap-break-word text-xs font-semibold sm:text-sm" style="color: var(--admin-text);">
                                {{ $user->name }}
                            </p>

                            <p class="mt-1 wrap-break-word text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Informasi akun --}}
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
                                    Informasi Akun
                                </h2>
                                <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Atur nama, email, dan role pengguna.
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid min-w-0 grid-cols-1 gap-x-5 gap-y-5 rounded-xl border p-4 sm:grid-cols-2 sm:p-5 lg:grid-cols-3"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            {{-- Nama --}}
                            <div class="min-w-0">
                                <label for="name" class="{{ $labelClass }}" style="{{ $labelStyle }}">
                                    Nama Pengguna <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name', $user->name) }}"
                                    required
                                    autocomplete="name"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                    placeholder="Masukkan nama pengguna"
                                >

                                @error('name')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="min-w-0">
                                <label for="email" class="{{ $labelClass }}" style="{{ $labelStyle }}">
                                    Email <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email', $user->email) }}"
                                    required
                                    autocomplete="email"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                    placeholder="contoh@email.com"
                                >

                                @error('email')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Role --}}
                            <div class="min-w-0">
                                <label for="role" class="{{ $labelClass }}" style="{{ $labelStyle }}">
                                    Role <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <select
                                        name="role"
                                        id="role"
                                        required
                                        class="{{ $inputClass }} appearance-none pr-10"
                                        style="{{ $inputStyle }}"
                                    >
                                        <option value="">Pilih Role</option>
                                        <option value="admin" @selected(old('role', $user->role) === 'admin')>
                                            Admin
                                        </option>
                                        <option value="guru" @selected(old('role', $user->role) === 'guru')>
                                            Guru
                                        </option>
                                        <option value="siswa" @selected(old('role', $user->role) === 'siswa')>
                                            Siswa
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

                                @error('role')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    {{-- Relasi data Guru/Siswa --}}
                    <section
                        id="relation-section"
                        class="hidden border-t px-5 py-5 sm:px-6"
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
                                    Koneksi Data Master
                                </h2>
                                <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Hubungkan akun dengan data Guru atau Siswa.
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid min-w-0 grid-cols-1 gap-5 rounded-xl border p-4 sm:p-5"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            {{-- Pilih guru --}}
                            <div id="teacher-field" class="hidden min-w-0">
                                <label for="teacher_id" class="{{ $labelClass }}" style="{{ $labelStyle }}">
                                    Pilih Data Guru <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <select
                                        name="teacher_id"
                                        id="teacher_id"
                                        class="{{ $inputClass }} appearance-none pr-10"
                                        style="{{ $inputStyle }}"
                                    >
                                        <option value="">Pilih Guru</option>

                                        @foreach ($teachers as $teacher)
                                            <option
                                                value="{{ $teacher->id }}"
                                                @selected(old('teacher_id', $user->teacher_id) == $teacher->id)
                                            >
                                                {{ $teacher->name }} — {{ $teacher->identity_number }}
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

                                @if ($teachers->isEmpty())
                                    <p class="mt-2 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                        Semua data guru aktif sudah memiliki akun atau belum tersedia.
                                    </p>
                                @endif

                                @error('teacher_id')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Pilih siswa --}}
                            <div id="student-field" class="hidden min-w-0">
                                <label for="student_id" class="{{ $labelClass }}" style="{{ $labelStyle }}">
                                    Pilih Data Siswa <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <select
                                        name="student_id"
                                        id="student_id"
                                        class="{{ $inputClass }} appearance-none pr-10"
                                        style="{{ $inputStyle }}"
                                    >
                                        <option value="">Pilih Siswa</option>

                                        @foreach ($students as $student)
                                            <option
                                                value="{{ $student->id }}"
                                                @selected(old('student_id', $user->student_id) == $student->id)
                                            >
                                                {{ $student->name }} — {{ $student->identity_number }}
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

                                @if ($students->isEmpty())
                                    <p class="mt-2 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                        Semua data siswa aktif sudah memiliki akun atau belum tersedia.
                                    </p>
                                @endif

                                @error('student_id')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            <p class="text-[11px] leading-relaxed sm:text-xs" style="color: var(--admin-muted);">
                                * Akun untuk Guru atau Siswa wajib dihubungkan dengan data master masing-masing agar sinkron.
                            </p>
                        </div>
                    </section>

                    {{-- Keamanan / password --}}
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 10V7a5 5 0 0 1 10 0v3m-11 0h12a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2Zm6 4v3"/>
                                </svg>
                            </span>

                            <div>
                                <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                    Keamanan
                                </h2>
                                <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Password baru bersifat opsional.
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid min-w-0 grid-cols-1 gap-x-5 gap-y-5 rounded-xl border p-4 sm:grid-cols-2 sm:p-5"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                        >
                            <div class="min-w-0">
                                <label for="password" class="{{ $labelClass }}" style="{{ $labelStyle }}">
                                    Password Baru
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    autocomplete="new-password"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                    placeholder="Kosongkan jika tetap"
                                >

                                @error('password')
                                    <p class="{{ $errorClass }}">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="min-w-0">
                                <label for="password_confirmation" class="{{ $labelClass }}" style="{{ $labelStyle }}">
                                    Konfirmasi Password Baru
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    autocomplete="new-password"
                                    class="{{ $inputClass }}"
                                    style="{{ $inputStyle }}"
                                    placeholder="Ulangi password baru"
                                >
                            </div>

                            <p class="text-[11px] leading-relaxed sm:col-span-2 sm:text-xs" style="color: var(--admin-muted);">
                                Kosongkan bagian password jika Anda tidak ingin mengganti sandi pengguna saat ini. Minimal 8 karakter jika diisi.
                            </p>
                        </div>
                    </section>

                    {{-- Tombol aksi --}}
                    <div
                        class="flex flex-col-reverse gap-2 border-t p-5 sm:flex-row sm:justify-end sm:gap-3 sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <a
                            href="{{ route('admin.users.index') }}"
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const role = document.getElementById('role');
            const relationSection = document.getElementById('relation-section');
            const teacherField = document.getElementById('teacher-field');
            const studentField = document.getElementById('student-field');
            const teacherSelect = document.getElementById('teacher_id');
            const studentSelect = document.getElementById('student_id');

            if (!role || !relationSection || !teacherField || !studentField || !teacherSelect || !studentSelect) {
                return;
            }

            function updateFields() {
                relationSection.classList.add('hidden');
                teacherField.classList.add('hidden');
                studentField.classList.add('hidden');

                teacherSelect.removeAttribute('required');
                studentSelect.removeAttribute('required');

                if (role.value === 'guru') {
                    relationSection.classList.remove('hidden');
                    teacherField.classList.remove('hidden');
                    teacherSelect.setAttribute('required', 'required');
                } else if (role.value === 'siswa') {
                    relationSection.classList.remove('hidden');
                    studentField.classList.remove('hidden');
                    studentSelect.setAttribute('required', 'required');
                }
            }

            role.addEventListener('change', updateFields);
            updateFields();
        });
    </script>
</x-admin-layout>
