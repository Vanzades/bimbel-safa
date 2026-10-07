<x-admin-layout>
    <x-slot name="title">
        Detail Akun
    </x-slot>

    @php
        $roleStyles = [
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

        $style = $roleStyles[$user->role] ?? $roleStyles['siswa'];

        $label = 'mb-2 block text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
        $infoBox = 'min-w-0 rounded-xl border p-3.5 sm:p-4';
        $infoBoxStyle = 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);';
        $value = 'wrap-break-word text-xs font-medium leading-relaxed sm:text-sm';
    @endphp

    {{-- Wrapper mengikuti halaman Akun --}}
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
                    Akun
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Detail Akun
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Detail Akun
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Informasi akun dan data yang terhubung.
                    </p>
                </div>
            </div>

            {{-- Card detail akun --}}
            <div
                class="overflow-hidden rounded-2xl shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                {{-- Header akun --}}
                <div
                    class="flex flex-col justify-between gap-4 border-b p-5 sm:flex-row sm:items-center sm:p-6"
                    style="border-color: var(--admin-border);"
                >
                    <div class="min-w-0">
                        <h2
                            class="wrap-break-word text-sm font-bold tracking-tight sm:text-base"
                            style="color: var(--admin-text);"
                        >
                            {{ $user->name }}
                        </h2>

                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                            ID Pengguna:
                            <span class="font-semibold" style="color: var(--admin-text);">
                                #{{ $user->id }}
                            </span>
                        </p>
                    </div>

                    <span
                        class="inline-flex w-fit shrink-0 items-center rounded-lg px-3 py-1.5 text-xs font-semibold {{ $style['badge'] }} sm:text-[13px]"
                        style="color: var(--admin-text);"
                    >
                        {{ $style['label'] }}
                    </span>
                </div>

                <div class="space-y-7 p-5 sm:space-y-8 sm:p-6">

                    {{-- Informasi login --}}
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

                            <h3 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                Informasi Login
                            </h3>
                        </div>

                        <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Nama Pengguna
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $user->name }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Email
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Role
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $style['label'] }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }} sm:col-span-2 lg:col-span-3" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Akun Dibuat
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $user->created_at->format('d F Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- Data guru terhubung --}}
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

                                <h3 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                    Data Guru Terhubung
                                </h3>
                            </div>

                            <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Nama Guru
                                    </span>
                                    <p class="{{ $value }}" style="color: var(--admin-text);">
                                        {{ $user->teacher->name }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        NIP / NIK
                                    </span>
                                    <p class="{{ $value }}" style="color: var(--admin-text);">
                                        {{ $user->teacher->identity_number }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        No. Telepon
                                    </span>
                                    <p class="{{ $value }}" style="color: var(--admin-text);">
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

                    {{-- Data siswa terhubung --}}
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

                                <h3 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                    Data Siswa Terhubung
                                </h3>
                            </div>

                            <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Nama Siswa
                                    </span>
                                    <p class="{{ $value }}" style="color: var(--admin-text);">
                                        {{ $user->student->name }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        NIS / NISN
                                    </span>
                                    <p class="{{ $value }}" style="color: var(--admin-text);">
                                        {{ $user->student->identity_number }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        Kelas
                                    </span>
                                    <p class="{{ $value }}" style="color: var(--admin-text);">
                                        {{ $user->student->classRoom->name ?? '-' }}
                                    </p>
                                </div>

                                <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                    <span class="{{ $label }}" style="color: var(--admin-muted);">
                                        No. Telepon
                                    </span>
                                    <p class="{{ $value }}" style="color: var(--admin-text);">
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
        </div>
    </div>
</x-admin-layout>
