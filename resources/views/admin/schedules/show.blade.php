<x-admin-layout>
    <x-slot name="title">
        Detail Jadwal
    </x-slot>

    @php
        $days = [
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
            'sunday' => 'Minggu',
        ];

        $isActive = $schedule->status === 'active';

        $statusBadge = $isActive
            ? 'bg-emerald-100/80 dark:bg-emerald-500/20'
            : 'bg-red-100/80 dark:bg-red-500/20';

        $infoBox = 'min-w-0 rounded-xl border p-3.5 sm:p-4';
        $infoBoxStyle = 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);';
        $label = 'mb-2 block text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
        $value = 'wrap-break-word text-xs font-medium leading-relaxed sm:text-sm';

        $className = $schedule->classRoom?->name ?? '-';
        $classCode = $schedule->classRoom?->code ?? '';
        $teacherName = $schedule->teacher?->name ?? '-';

        $startTime = $schedule->start_time
            ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
            : '-';

        $endTime = $schedule->end_time
            ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i')
            : '-';
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

                <a href="{{ route('admin.schedules.index') }}" class="hover:opacity-85">
                    Jadwal
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Detail Jadwal
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Detail Jadwal Pembelajaran
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Informasi lengkap jadwal, mata pelajaran, dan pengajar.
                </p>
            </div>

            {{-- Card detail jadwal --}}
            <div
                class="overflow-hidden rounded-2xl shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                {{-- Header jadwal --}}
                <div
                    class="flex flex-col justify-between gap-4 border-b p-5 sm:flex-row sm:items-center sm:p-6"
                    style="border-color: var(--admin-border);"
                >
                    <div class="min-w-0">
                        <h2
                            class="wrap-break-word text-sm font-bold tracking-tight sm:text-base"
                            style="color: var(--admin-text);"
                        >
                            {{ $schedule->subject }}
                        </h2>

                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                            Kelas:
                            <span class="font-semibold" style="color: var(--admin-text);">
                                {{ $className }}@if ($classCode) ({{ $classCode }})@endif
                            </span>
                        </p>
                    </div>

                    <span
                        class="inline-flex w-fit shrink-0 items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-semibold {{ $statusBadge }} sm:text-[13px]"
                        style="color: var(--admin-text);"
                    >
                        <span class="h-1.5 w-1.5 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                        {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>

                <div class="space-y-7 p-5 sm:space-y-8 sm:p-6">

                    {{-- Informasi jadwal --}}
                    <section>
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <rect x="3.75" y="5.75" width="16.5" height="14.5" rx="2" stroke-width="1.8"/>
                                    <path stroke-linecap="round" stroke-width="1.8" d="M7.5 3.75v4M16.5 3.75v4M4 10h16M8 14h3M8 17h5"/>
                                </svg>
                            </span>

                            <h3 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                Informasi Jadwal
                            </h3>
                        </div>

                        <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Mata Pelajaran
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $schedule->subject }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Kelas
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $className }}@if ($classCode) — {{ $classCode }}@endif
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Guru Pengajar
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $teacherName }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Hari
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $days[$schedule->day] ?? $schedule->day }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Waktu Pembelajaran
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $startTime }} – {{ $endTime }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Ruangan
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $schedule->room ?: '-' }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">
                                    Data Dibuat
                                </span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $schedule->created_at?->format('d F Y, H:i') ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
