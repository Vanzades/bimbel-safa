<x-super-admin-layout title="Tambah Pengguna">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('super-admin.users.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-blue-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Pengguna
                </a>

                <div class="mt-4">
                    <p class="text-sm font-medium text-blue-600">Super Admin</p>
                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                        Tambah Pengguna
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Buat akun pengguna dan hubungkan dengan data cabang.
                    </p>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 p-4">
                <div class="flex gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M10.29 3.86l-8.17 14a2 2 0 001.74 2.64h16.28a2 2 0 001.74-2.64l-8.17-14a2 2 0 00-3.42 0z" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-red-800">
                            Data belum dapat disimpan
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('super-admin.users.store') }}" class="space-y-6">
            @csrf

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m14-10a4 4 0 10-8 0 4 4 0 008 0zm4 10v-2a4 4 0 00-3-3.87m-1-12a4 4 0 010 7.75" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Informasi Akun
                            </h2>
                            <p class="text-xs text-slate-500">
                                Tentukan identitas dan hak akses pengguna.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Lengkap
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            placeholder="Masukkan nama lengkap"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="nama@email.com"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                    </div>

                    <div>
                        <label for="role" class="mb-2 block text-sm font-medium text-slate-700">
                            Role
                        </label>
                        <select
                            id="role"
                            name="role"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">Pilih role</option>
                            <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                            <option value="guru" @selected(old('role') === 'guru')>Guru</option>
                            <option value="siswa" @selected(old('role') === 'siswa')>Siswa</option>
                        </select>
                    </div>

                    <div>
                        <label for="branch_id" class="mb-2 block text-sm font-medium text-slate-700">
                            Cabang
                        </label>
                        <select
                            id="branch_id"
                            name="branch_id"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">Pilih cabang</option>
                            @foreach ($branches as $branch)
                                <option
                                    value="{{ $branch->id }}"
                                    @selected(old('branch_id') == $branch->id)
                                >
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div id="teacher-section" class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.36-1.86M17 20H7m10 0v-2c0-.73-.26-1.41-.7-1.94M7 20H2v-2a3 3 0 015.36-1.86M7 20v-2c0-.73.26-1.41.7-1.94m0 0a5 5 0 019.6 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Hubungkan Data Guru
                            </h2>
                            <p class="text-xs text-slate-500">
                                Pilih data guru yang akan menggunakan akun ini.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <label for="teacher_id" class="mb-2 block text-sm font-medium text-slate-700">
                        Data Guru
                    </label>

                    <select
                        id="teacher_id"
                        name="teacher_id"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                    >
                        <option value="">Pilih guru</option>

                        @foreach ($teachers as $teacher)
                            <option
                                value="{{ $teacher->id }}"
                                data-branch-id="{{ $teacher->branch_id }}"
                                @selected(old('teacher_id') == $teacher->id)
                            >
                                {{ $teacher->name }}
                                @if ($teacher->identity_number)
                                    — {{ $teacher->identity_number }}
                                @endif
                            </option>
                        @endforeach
                    </select>

                    <p class="mt-2 text-xs text-slate-500">
                        Hanya guru yang belum memiliki akun yang dapat dipilih.
                    </p>
                </div>
            </div>

            <div id="student-section" class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.36-1.86M17 20H7m10 0v-2c0-.73.26-1.41-.7-1.94M7 20H2v-2a3 3 0 005.36-1.86M7 20v-2c0-.73.26-1.41.7-1.94m0 0a5 5 0 019.6 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Hubungkan Data Siswa
                            </h2>
                            <p class="text-xs text-slate-500">
                                Pilih data siswa yang akan menggunakan akun ini.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <label for="student_id" class="mb-2 block text-sm font-medium text-slate-700">
                        Data Siswa
                    </label>

                    <select
                        id="student_id"
                        name="student_id"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                    >
                        <option value="">Pilih siswa</option>

                        @foreach ($students as $student)
                            <option
                                value="{{ $student->id }}"
                                data-branch-id="{{ $student->branch_id }}"
                                @selected(old('student_id') == $student->id)
                            >
                                {{ $student->name }}
                                @if ($student->identity_number)
                                    — {{ $student->identity_number }}
                                @endif
                            </option>
                        @endforeach
                    </select>

                    <p class="mt-2 text-xs text-slate-500">
                        Hanya siswa yang belum memiliki akun yang dapat dipilih.
                    </p>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Keamanan Akun
                            </h2>
                            <p class="text-xs text-slate-500">
                                Tentukan password untuk akun pengguna.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">
                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                            Password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">
                            Konfirmasi Password
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('super-admin.users.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4" />
                    </svg>
                    Simpan Pengguna
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const role = document.getElementById('role');
                const branch = document.getElementById('branch_id');
                const teacherSection = document.getElementById('teacher-section');
                const studentSection = document.getElementById('student-section');
                const teacherSelect = document.getElementById('teacher_id');
                const studentSelect = document.getElementById('student_id');

                const filterOptions = (select, branchId) => {
                    const selectedValue = select.value;

                    Array.from(select.options).forEach((option, index) => {
                        if (index === 0) {
                            option.hidden = false;
                            return;
                        }

                        option.hidden = branchId && option.dataset.branchId !== branchId;
                    });

                    if (selectedValue && select.selectedOptions[0]?.hidden) {
                        select.value = '';
                    }
                };

                const updateFields = () => {
                    const selectedRole = role.value;
                    const branchId = branch.value;

                    teacherSection.classList.toggle('hidden', selectedRole !== 'guru');
                    studentSection.classList.toggle('hidden', selectedRole !== 'siswa');

                    teacherSelect.required = selectedRole === 'guru';
                    studentSelect.required = selectedRole === 'siswa';

                    if (selectedRole === 'guru') {
                        filterOptions(teacherSelect, branchId);
                        studentSelect.value = '';
                    }

                    if (selectedRole === 'siswa') {
                        filterOptions(studentSelect, branchId);
                        teacherSelect.value = '';
                    }

                    if (selectedRole === 'admin') {
                        teacherSelect.value = '';
                        studentSelect.value = '';
                    }
                };

                role.addEventListener('change', updateFields);
                branch.addEventListener('change', updateFields);

                updateFields();
            });
        </script>
    @endpush
</x-super-admin-layout>