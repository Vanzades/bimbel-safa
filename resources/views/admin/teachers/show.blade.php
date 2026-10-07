<x-admin-layout>
    <x-slot name="title">
        Detail Guru
    </x-slot>

    @php
        $isActive = $teacher->status === 'active';

        $statusBadge = $isActive
            ? 'bg-emerald-100/80 dark:bg-emerald-500/20'
            : 'bg-red-100/80 dark:bg-red-500/20';

        $label = 'mb-2 block text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
        $infoBox = 'min-w-0 rounded-xl border p-3.5 sm:p-4';
        $infoBoxStyle = 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);';
        $value = 'wrap-break-word text-xs font-medium leading-relaxed sm:text-sm';
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

                <a href="{{ route('admin.teachers.index') }}" class="hover:opacity-85">
                    Guru
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Detail Guru
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Detail Guru
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Informasi lengkap data pribadi dan akun guru.
                    </p>
                </div>
            </div>

            {{-- Card detail guru --}}
            <div
                class="overflow-hidden rounded-2xl shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                {{-- Header guru --}}
                <div
                    class="flex flex-col justify-between gap-4 border-b p-5 sm:flex-row sm:items-center sm:p-6"
                    style="border-color: var(--admin-border);"
                >
                    <div class="min-w-0">
                        <h2
                            class="wrap-break-word text-sm font-bold tracking-tight sm:text-base"
                            style="color: var(--admin-text);"
                        >
                            {{ $teacher->name }}
                        </h2>

                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                            NIK / Nomor Identitas:
                            <span class="font-semibold" style="color: var(--admin-text);">
                                {{ $teacher->identity_number }}
                            </span>
                        </p>
                    </div>

                    <span
                        class="inline-flex w-fit shrink-0 items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-semibold {{ $statusBadge }} sm:text-[13px]"
                        style="color: var(--admin-text);"
                    >
                        <span class="h-1.5 w-1.5 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                        {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>

                <div class="space-y-7 p-5 sm:space-y-8 sm:p-6">
                    {{-- Informasi guru --}}
                    <section>
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
                                Informasi Guru
                            </h3>
                        </div>

                        <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Nama Lengkap
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $teacher->name }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    NIK / Nomor Identitas
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $teacher->identity_number }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Email
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $teacher->email ?: 'Belum tersedia' }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Nomor Telepon
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $teacher->phone ?: 'Belum tersedia' }}
                                </p>
                            </div>

                            {{-- Akun login --}}
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Akun Login
                                </span>

                                @if ($teacher->user)
                                    <div class="flex min-w-0 flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <span class="min-w-0 wrap-break-word text-xs font-medium sm:text-sm" style="color: var(--admin-text);">
                                            {{ $teacher->user->email }}
                                        </span>

                                        <a
                                            href="{{ route('admin.users.show', $teacher->user) }}"
                                            class="inline-flex w-fit shrink-0 items-center gap-1 text-xs font-semibold hover:underline sm:text-[13px]"
                                            style="color: #2563EB;"
                                        >
                                            Lihat
                                            <span aria-hidden="true">→</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="flex min-w-0 flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <span class="text-xs italic sm:text-sm" style="color: var(--admin-muted);">
                                            Belum ada akun
                                        </span>

                                        <a
                                            href="{{ route('admin.users.create') }}"
                                            class="inline-flex w-fit shrink-0 items-center gap-1 text-xs font-semibold hover:underline sm:text-[13px]"
                                            style="color: #2563EB;"
                                        >
                                            Buat
                                            <span aria-hidden="true">→</span>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            {{-- Data dibuat --}}
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Data Dibuat
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $teacher->created_at?->format('d F Y, H:i') ?? '-' }}
                                </p>
                            </div>

                            {{-- Alamat --}}
                            <div class="{{ $infoBox }} sm:col-span-2 lg:col-span-3" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Alamat Lengkap
                                </span>
                                <p class="wrap-break-word whitespace-pre-line text-xs font-medium leading-relaxed sm:text-sm" style="color: var(--admin-text);">
                                    {{ $teacher->address ?: 'Belum tersedia' }}
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
