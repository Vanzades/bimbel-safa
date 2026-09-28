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

        $label = 'block text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1';
        $field = 'w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-medium outline-none';
        $fieldStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';
    @endphp

    {{-- Wrapper utama --}}
    <div class="py-4 lg:py-6 min-h-screen transition-colors duration-150" style="background-color: var(--admin-bg); color: var(--admin-text);">
        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">

            {{-- ====== Breadcrumb ====== --}}
            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3" style="color: var(--admin-muted);">
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('admin.schedules.index') }}" class="hover:opacity-85">Jadwal</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="font-semibold" style="color: var(--admin-text);">Detail Jadwal</span>
            </nav>

            {{-- ====== JUDUL HALAMAN ====== --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                        Detail Jadwal Pembelajaran
                    </h1>
                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Informasi lengkap jadwal, mata pelajaran, dan pengajar.
                    </p>
                </div>
            </div>

            {{-- ====== CARD UTAMA ====== --}}
            <div class="rounded-2xl p-6 sm:p-8 shadow-sm space-y-8" style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                {{-- Header Singkat di dalam Card --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b" style="border-color: var(--admin-border);">
                    <div>
                        <h2 class="text-sm sm:text-base font-bold tracking-tight" style="color: var(--admin-text);">
                            {{ $schedule->subject }}
                        </h2>
                        <p class="text-xs sm:text-sm mt-0.5" style="color: var(--admin-muted);">
                            Kelas: <span class="font-medium" style="color: var(--admin-text);">{{ $schedule->classRoom->name }} ({{ $schedule->classRoom->code }})</span>
                        </p>
                    </div>

                    <div>
                        @if ($schedule->status === 'active')
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100/80 px-3 py-1.5 text-xs sm:text-sm font-semibold text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs sm:text-sm font-semibold" style="background-color: var(--admin-surface-soft); color: var(--admin-muted); border: 1px solid var(--admin-border);">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Tidak Aktif
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Grid Informasi Jadwal --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="{{ $label }}" style="color: var(--admin-muted);">Mata Pelajaran</label>
                        <input type="text" value="{{ $schedule->subject }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">
                    </div>

                    <div>
                        <label class="{{ $label }}" style="color: var(--admin-muted);">Kelas</label>
                        <input type="text" value="{{ $schedule->classRoom->name }} — {{ $schedule->classRoom->code }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">
                    </div>

                    <div>
                        <label class="{{ $label }}" style="color: var(--admin-muted);">Guru Pengajar</label>
                        <input type="text" value="{{ $schedule->teacher->name }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">
                    </div>

                    <div>
                        <label class="{{ $label }}" style="color: var(--admin-muted);">Hari</label>
                        <input type="text" value="{{ $days[$schedule->day] ?? $schedule->day }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">
                    </div>

                    <div>
                        <label class="{{ $label }}" style="color: var(--admin-muted);">Waktu Pembelajaran</label>
                        <input type="text" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">
                    </div>

                    <div>
                        <label class="{{ $label }}" style="color: var(--admin-muted);">Ruangan</label>
                        <input type="text" value="{{ $schedule->room ?: '-' }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">
                    </div>
                </div>

                {{-- Footer Timestamps --}}
                <div class="pt-4 border-t flex flex-col sm:flex-row items-center justify-between text-[11px] sm:text-xs gap-2" style="border-color: var(--admin-border); color: var(--admin-muted);">
                    <div>Data Dibuat: <span class="font-medium" style="color: var(--admin-text);">{{ $schedule->created_at?->format('d F Y, H:i') }}</span></div>
                    <div>Terakhir Diperbarui: <span class="font-medium" style="color: var(--admin-text);">{{ $schedule->updated_at?->format('d F Y, H:i') }}</span></div>
                </div>

            </div>

        </div>
    </div>
</x-admin-layout>
