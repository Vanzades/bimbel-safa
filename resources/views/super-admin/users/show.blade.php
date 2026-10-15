<x-super-admin-layout title="Detail Pengguna">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
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
                    <p class="text-sm font-medium text-blue-600">Super Admin / Pengguna</p>
                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                        Detail Pengguna
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi lengkap akun pengguna dan keterkaitannya dengan sistem.
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <a
                    href="{{ route('super-admin.users.edit', $user) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16.862 4.487l1.651-1.651a2.121 2.121 0 113 3l-1.651 1.651M16.862 4.487L7.5 13.85V17h3.15l9.362-9.362M16.862 4.487L20.012 7.638" />
                    </svg>
                    Edit
                </a>

                <form
                    method="POST"
                    action="{{ route('super-admin.users.destroy', $user) }}"
                    onsubmit="return confirm('Hapus akun {{ addslashes($user->name) }}? Data akun akan dihapus dari sistem.')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-3a1 1 0 00-1 1v3m-4 0h10" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold">Berhasil</p>
                    <p class="mt-0.5 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700 px-6 py-7 text-white sm:px-8">
                <div class="absolute -right-12 -top-16 h-44 w-44 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-24 left-1/3 h-52 w-52 rounded-full bg-white/5"></div>

                <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center">
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl font-bold ring-1 ring-white/20">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="text-xl font-bold tracking-tight">
                                {{ $user->name }}
                            </h2>

                            @if ($user->role === 'admin')
                                <span class="rounded-full bg-violet-100 px-2.5 py-1 text-xs font-semibold text-violet-700">
                                    Admin
                                </span>
                            @elseif ($user->role === 'guru')
                                <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                    Guru
                                </span>
                            @elseif ($user->role === 'siswa')
                                <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                    Siswa
                                </span>
                            @endif
                        </div>

                        <p class="mt-1 truncate text-sm text-blue-100">
                            {{ $user->email }}
                        </p>

                        <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-blue-100">
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-2.5 py-1.5">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 21s8-4.35 8-10a8 8 0 10-16 0c0 5.65 8 10 8 10z" />
                                    <circle cx="12" cy="11" r="2.5" />
                                </svg>

                                {{ $user->branch?->name ?? 'Tidak terhubung' }}
                            </span>

                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-2.5 py-1.5">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>

                                Akun Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-px bg-slate-200 sm:grid-cols-3">
                <div class="bg-white p-5">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Role
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        {{ match ($user->role) {
                            'admin' => 'Administrator',
                            'guru' => 'Guru',
                            'siswa' => 'Siswa',
                            default => ucfirst($user->role),
                        } }}
                    </p>
                </div>

                <div class="bg-white p-5">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Cabang
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        {{ $user->branch?->name ?? 'Tidak terhubung' }}
                    </p>
                </div>

                <div class="bg-white p-5">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        ID Pengguna
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        #{{ $user->id }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Informasi Akun
                            </h2>
                            <p class="text-xs text-slate-500">
                                Data dasar akun pengguna.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-slate-100">
                    <div class="flex items-center justify-between gap-4 px-5 py-4">
                        <span class="text-sm text-slate-500">Nama</span>
                        <span class="text-right text-sm font-semibold text-slate-900">
                            {{ $user->name }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-4 px-5 py-4">
                        <span class="text-sm text-slate-500">Email</span>
                        <span class="break-all text-right text-sm font-semibold text-slate-900">
                            {{ $user->email }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-4 px-5 py-4">
                        <span class="text-sm text-slate-500">Role</span>

                        <span class="text-right text-sm font-semibold text-slate-900">
                            {{ match ($user->role) {
                                'admin' => 'Admin',
                                'guru' => 'Guru',
                                'siswa' => 'Siswa',
                                default => ucfirst($user->role),
                            } }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-4 px-5 py-4">
                        <span class="text-sm text-slate-500">Cabang</span>

                        <span class="text-right text-sm font-semibold text-slate-900">
                            {{ $user->branch?->name ?? 'Tidak terhubung' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 5.591 3.824 10.29 9 11.622C17.176 22.29 21 17.591 21 12c0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Data Terhubung
                            </h2>
                            <p class="text-xs text-slate-500">
                                Hubungan akun dengan data utama.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-5">
                    @if ($user->role === 'guru' && $user->teacher)
                        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.36-1.86M17 20H7m10 0v-2c0-.73.26-1.41-.7-1.94M7 20H2v-2a3 3 0 015.36-1.86M7 20v-2c0-.73.26-1.41.7-1.94m0 0a5 5 0 019.6 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-amber-700">
                                        Data Guru
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-slate-900">
                                        {{ $user->teacher->name }}
                                    </p>

                                    @if ($user->teacher->identity_number)
                                        <p class="mt-0.5 text-xs text-slate-500">
                                            {{ $user->teacher->identity_number }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif ($user->role === 'siswa' && $user->student)
                        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.36-1.86M17 20H7m10 0v-2c0-.73.26-1.41-.7-1.94M7 20H2v-2a3 3 0 015.36-1.86M7 20v-2c0-.73.26-1.41.7-1.94m0 0a5 5 0 019.6 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-emerald-700">
                                        Data Siswa
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-slate-900">
                                        {{ $user->student->name }}
                                    </p>

                                    @if ($user->student->identity_number)
                                        <p class="mt-0.5 text-xs text-slate-500">
                                            {{ $user->student->identity_number }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif ($user->role === 'admin')
                        <div class="rounded-xl border border-violet-200 bg-violet-50 p-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-violet-100 text-violet-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 5.591 3.824 10.29 9 11.622C17.176 22.29 21 17.591 21 12c0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-xs font-medium text-violet-700">
                                        Administrator Cabang
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-slate-900">
                                        Akun operasional cabang
                                    </p>

                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Memiliki akses pengelolaan data sesuai cabang.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm font-medium text-slate-700">
                                Belum ada data terhubung.
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Akun ini belum memiliki hubungan dengan data guru atau siswa.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            Informasi Sistem
                        </h2>
                        <p class="text-xs text-slate-500">
                            Riwayat dasar akun di dalam sistem.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid gap-px bg-slate-200 sm:grid-cols-3">
                <div class="bg-white p-5">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Dibuat
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        {{ $user->created_at?->format('d M Y, H:i') ?? '-' }}
                    </p>
                </div>

                <div class="bg-white p-5">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Diperbarui
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        {{ $user->updated_at?->format('d M Y, H:i') ?? '-' }}
                    </p>
                </div>

                <div class="bg-white p-5">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Verifikasi Email
                    </p>

                    <p class="mt-1 text-sm font-semibold {{ $user->email_verified_at ? 'text-emerald-600' : 'text-amber-600' }}">
                        {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Diverifikasi' }}
                    </p>
                </div>
            </div>
        </div>


<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-5 py-4">
        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-slate-900">Reset Password</h2>
                <p class="text-xs text-slate-500">
                    Atur password baru untuk akun pengguna.
                </p>
            </div>
        </div>
    </div>

    <form
        method="POST"
        action="{{ route('super-admin.users.reset-password', $user) }}"
        class="space-y-4 p-5"
    >
        @csrf

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                Password Baru
            </label>
            <input
                id="password"
                name="password"
                type="password"
                minlength="8"
                autocomplete="new-password"
                required
                class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
            >
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">
                Konfirmasi Password Baru
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                minlength="8"
                autocomplete="new-password"
                required
                class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
            >
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs leading-relaxed text-slate-500">
                Password lama tidak dapat dilihat kembali. Password baru akan langsung menggantikannya.
            </p>

            <button
                type="submit"
                onclick="return confirm('Yakin ingin mengatur ulang password akun ini?')"
                class="inline-flex shrink-0 items-center justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                Simpan Password Baru
            </button>
        </div>
    </form>
</div>


        <div>
            <a
                href="{{ route('super-admin.users.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Manajemen Pengguna
            </a>
        </div>
    </div>
</x-super-admin-layout>