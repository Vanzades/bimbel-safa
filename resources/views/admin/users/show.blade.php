<x-admin-layout>
    <x-slot name="title">
        Detail Akun
    </x-slot>

    @php
        $roleStyles = [
            'super_admin' => [
                'label' => 'Super Admin',
                'badge' => 'bg-rose-100/80 dark:bg-rose-500/20',
            ],
            'admin' => [
                'label' => 'Admin',
                'badge' => 'bg-purple-100/80 dark:bg-purple-500/20',
            ],
            'guru' => [
                'label' => 'Guru',
                'badge' => 'bg-indigo-100/80 dark:bg-indigo-500/20',
            ],
            'siswa' => [
                'label' => 'Siswa',
                'badge' => 'bg-emerald-100/80 dark:bg-emerald-500/20',
            ],
        ];

        $statusStyles = [
            'active' => 'bg-emerald-100/80 dark:bg-emerald-500/20',
            'inactive' => 'bg-red-100/80 dark:bg-red-500/20',
        ];

        $style = $roleStyles[$user->role] ?? [
            'label' => ucfirst($user->role ?? 'Pengguna'),
            'badge' => 'bg-slate-100/80 dark:bg-slate-500/20',
        ];

        $label = 'mb-2 block text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
        $infoBox = 'min-w-0 rounded-xl border p-3.5 sm:p-4';
        $infoBoxStyle = 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);';
        $value = 'wrap-break-word text-xs font-medium leading-relaxed sm:text-sm';
        $createdAt = $user->created_at?->format('d F Y, H:i') ?? '-';
    @endphp

    <div
        class="-mt-3 min-h-screen pb-4 pt-0 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);"
    >
        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-6">

            <nav
                class="mb-3 flex flex-wrap items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('admin.dashboard') }}" class="transition hover:opacity-75">
                    Dashboard
                </a>

                <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <a href="{{ route('admin.users.index') }}" class="transition hover:opacity-75">
                    Akun
                </a>

                <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Detail Akun
                </span>
            </nav>

            <div class="mb-7 mt-7 flex flex-col gap-4 sm:mb-9 sm:mt-8 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Detail Akun
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Informasi login dan data pengguna yang terhubung.
                    </p>
                </div>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="inline-flex w-fit items-center justify-center gap-2 rounded-xl border px-4 py-2.5 text-xs font-semibold transition hover:opacity-80 sm:text-sm"
                    style="border-color: var(--admin-border); background-color: var(--admin-surface); color: var(--admin-text);"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Akun
                </a>
            </div>

            <div
                class="overflow-hidden rounded-2xl"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                <div
                    class="flex flex-col justify-between gap-4 border-b p-5 sm:flex-row sm:items-center sm:p-6"
                    style="border-color: var(--admin-border);"
                >
                    <div class="flex min-w-0 items-center gap-3.5">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl text-base font-bold"
                            style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                        >
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <h2 class="wrap-break-word text-sm font-bold tracking-tight sm:text-base">
                                {{ $user->name }}
                            </h2>

                            <p class="mt-1 break-all text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                {{ $user->email }}
                            </p>

                            <p class="mt-1 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                ID Pengguna:
                                <span class="font-semibold" style="color: var(--admin-text);">
                                    #{{ $user->id }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <span
                        class="inline-flex w-fit shrink-0 items-center gap-2 rounded-lg px-3 py-1.5 text-xs font-semibold {{ $style['badge'] }} sm:text-[13px]"
                        style="color: var(--admin-text);"
                    >
                        <span class="h-1.5 w-1.5 rounded-full" style="background-color: currentColor;"></span>
                        {{ $style['label'] }}
                    </span>
                </div>

                <div class="space-y-7 p-5 sm:space-y-8 sm:p-6">

                    <section>
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <rect x="4" y="5" width="16" height="14" rx="2" stroke-width="1.8"/>
                                    <circle cx="9" cy="11" r="2" stroke-width="1.8"/>
                                    <path stroke-linecap="round" stroke-width="1.8" d="M6.5 16c.6-1.3 1.5-2 2.5-2s1.9.7 2.5 2M14 10h3M14 14h3"/>
                                </svg>
                            </span>

                            <div>
                                <h3 class="text-sm font-bold sm:text-base">
                                    Informasi Login
                                </h3>
                                <p class="mt-0.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                    Informasi yang digunakan untuk mengakses sistem.
                                </p>
                            </div>
                        </div>

                        <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Nama Pengguna
                                </span>
                                <p class="{{ $value }}">
                                    {{ $user->name }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Email
                                </span>
                                <p class="{{ $value }} break-all">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Role
                                </span>
                                <p class="{{ $value }}">
                                    {{ $style['label'] }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Akun Dibuat
                                </span>
                                <p class="{{ $value }}">
                                    {{ $createdAt }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Email Terverifikasi
                                </span>
                                <p class="{{ $value }}">
                                    {{ $user->email_verified_at ? $user->email_verified_at->format('d F Y, H:i') : 'Belum terverifikasi' }}
                                </p>
                            </div>
                        </div>
                    </section>

                    @if ($user->teacher)
                        <section class="border-t pt-6" style="border-color: var(--admin-border);">
                            <div class="mb-4 flex items-center gap-3">
                                <span
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                    style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM17 8h4M19 6v4"/>
                                    </svg>
                                </span>

                                <div>
                                    <h3 class="text-sm font-bold sm:text-base">
                                        Data Guru Terhubung
                                    </h3>
                                    <p class="mt-0.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                        Profil guru yang terhubung dengan akun ini.
                                    </p>
                                </div>
                            </div>

                            <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Nama Guru
                                    </span>
                                    <p class="{{ $value }}">
                                        {{ $user->teacher->name ?: '-' }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        NIP / NIK
                                    </span>
                                    <p class="{{ $value }}">
                                        {{ $user->teacher->identity_number ?: '-' }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        No. Telepon
                                    </span>
                                    <p class="{{ $value }}">
                                        {{ $user->teacher->phone ?: '-' }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Status Guru
                                    </span>
                                    <span
                                        class="inline-flex rounded-md px-2.5 py-1 text-xs font-semibold {{ $statusStyles[$user->teacher->status] ?? $statusStyles['inactive'] }}"
                                        style="color: var(--admin-text);"
                                    >
                                        {{ $user->teacher->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </div>
                            </div>
                        </section>

                    @elseif ($user->student)
                        <section class="border-t pt-6" style="border-color: var(--admin-border);">
                            <div class="mb-4 flex items-center gap-3">
                                <span
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                    style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM17 8h4M19 6v4"/>
                                    </svg>
                                </span>

                                <div>
                                    <h3 class="text-sm font-bold sm:text-base">
                                        Data Siswa Terhubung
                                    </h3>
                                    <p class="mt-0.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                        Profil siswa yang terhubung dengan akun ini.
                                    </p>
                                </div>
                            </div>

                            <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Nama Siswa
                                    </span>
                                    <p class="{{ $value }}">
                                        {{ $user->student->name }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        NIS / NISN
                                    </span>
                                    <p class="{{ $value }}">
                                        {{ $user->student->identity_number ?: '-' }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Kelas
                                    </span>
                                    <p class="{{ $value }}">
                                        {{ $user->student->classRoom->name ?? '-' }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        No. Telepon
                                    </span>
                                    <p class="{{ $value }}">
                                        {{ $user->student->phone ?: '-' }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Status Siswa
                                    </span>
                                    <span
                                        class="inline-flex rounded-md px-2.5 py-1 text-xs font-semibold {{ $statusStyles[$user->student->status] ?? $statusStyles['inactive'] }}"
                                        style="color: var(--admin-text);"
                                    >
                                        {{ $user->student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </div>

            
<div
    class="mt-5 overflow-hidden rounded-2xl"
    style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
>
    <div class="border-b p-5 sm:p-6" style="border-color: var(--admin-border);">
        <div class="flex items-center gap-3">
            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v4"/>
                </svg>
            </div>

            <div>
                <h2 class="text-sm font-bold sm:text-base">Reset Password</h2>
                <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                    Buat password baru untuk akun {{ $user->name }}.
                </p>
            </div>
        </div>
    </div>

    <form
        method="POST"
        action="{{ route('admin.users.reset-password', $user) }}"
        class="space-y-4 p-5 sm:p-6"
    >
        @csrf

        <div>
            <label for="password" class="mb-2 block text-xs font-semibold">
                Password Baru
            </label>
            <input
                id="password"
                name="password"
                type="password"
                minlength="8"
                autocomplete="new-password"
                required
                class="w-full rounded-xl border px-3.5 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"
                style="border-color: var(--admin-border); background-color: var(--admin-surface-soft); color: var(--admin-text);"
            >
            @error('password')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-xs font-semibold">
                Konfirmasi Password Baru
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                minlength="8"
                autocomplete="new-password"
                required
                class="w-full rounded-xl border px-3.5 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"
                style="border-color: var(--admin-border); background-color: var(--admin-surface-soft); color: var(--admin-text);"
            >
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs leading-relaxed" style="color: var(--admin-muted);">
                Password lama tidak dapat dilihat kembali. Perubahan ini langsung mengganti password akun.
            </p>

            <button
                type="submit"
                onclick="return confirm('Yakin ingin mengatur ulang password akun ini?')"
                class="inline-flex shrink-0 items-center justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                Simpan Password Baru
            </button>
        </div>
    </form>
</div>


            <div class="mt-5 flex items-start gap-3 rounded-xl border p-4" style="border-color: var(--admin-border); background-color: var(--admin-surface);">
                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3m0 4h.01M10.3 3.9 1.8 18.5A1.7 1.7 0 0 0 3.3 21h17.4a1.7 1.7 0 0 0 1.5-2.5L13.7 3.9a1.9 1.9 0 0 0-3.4 0Z"/>
                </svg>
                <p class="text-xs leading-relaxed sm:text-sm" style="color: var(--admin-muted);">
                    Jaga kerahasiaan informasi login. Password yang sudah tersimpan dalam bentuk hash tidak dapat dilihat kembali; gunakan proses reset password jika pengguna lupa password.
                </p>
            </div>
        </div>
    </div>

    @if (!empty($temporaryPassword))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const passwordInput = document.getElementById('account-password');
                const toggleButton = document.getElementById('toggle-account-password');
                const eyeIcon = document.getElementById('password-eye-icon');

                if (!passwordInput || !toggleButton || !eyeIcon) return;

                const eyeOpen = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z"
                    />
                    <circle cx="12" cy="12" r="3" stroke-width="1.8"/>
                `;

                const eyeClosed = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M3 3l18 18M10.6 5.2A9.8 9.8 0 0 1 12 5c6 0 9.5 7 9.5 7a16 16 0 0 1-3.1 3.9M6.2 6.2C3.8 7.8 2.5 12 2.5 12s3.5 7 9.5 7a9.8 9.8 0 0 0 3-.5"
                    />
                `;

                toggleButton.addEventListener('click', function () {
                    const showPassword = passwordInput.type === 'password';

                    passwordInput.type = showPassword ? 'text' : 'password';
                    eyeIcon.innerHTML = showPassword ? eyeClosed : eyeOpen;

                    toggleButton.setAttribute('aria-pressed', String(showPassword));
                    toggleButton.setAttribute(
                        'aria-label',
                        showPassword ? 'Sembunyikan password' : 'Tampilkan password'
                    );
                });
            });
        </script>
    @endif
</x-admin-layout>
