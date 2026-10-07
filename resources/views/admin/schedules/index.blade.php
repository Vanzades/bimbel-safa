<x-admin-layout>
    <x-slot name="title">
        Jadwal Kelas
    </x-slot>

    @php
        $isFiltering = request()->filled('search')
            || request()->filled('class_room_id')
            || request()->filled('day')
            || request()->filled('status');

        $th = 'px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
        $td = 'px-6 py-4 text-xs sm:text-sm';
        $iconBtn = 'w-8 h-8 inline-flex items-center justify-center rounded-lg transition-colors duration-150';

        $days = [
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
        ];

        $selectedClassRoomName = 'Semua Kelas';

        foreach ($classRooms as $classRoom) {
            if ((string) request('class_room_id') === (string) $classRoom->id) {
                $selectedClassRoomName = $classRoom->name;
                break;
            }
        }
    @endphp

    <div class="-mt-3 pt-0 pb-4 lg:-mt-4 lg:pb-6 min-h-screen transition-colors duration-150"
        style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-6">

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3"
                style="color: var(--admin-muted);">

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Jadwal Kelas
                </span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                        Jadwal Kelas
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Kelola jadwal kegiatan bimbingan belajar.
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">

                    <div class="font-semibold mb-1">
                        Terjadi kesalahan.
                    </div>

                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-2xl p-5 sm:p-6 shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                <form method="GET" action="{{ route('admin.schedules.index') }}"
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                    {{-- Kiri: search, filter, dan reset --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full lg:w-auto">

                        {{-- Search --}}
                        <div class="relative w-full sm:w-64 sm:shrink-0">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"
                                style="color: var(--admin-icon);">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="m21 21-4.3-4.3"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari mata pelajaran, kelas, guru..."
                                class="box-border w-full h-9 pl-10 pr-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                        </div>

                        {{-- Filter Kelas --}}
                        <div class="relative w-full sm:w-36 sm:shrink-0" data-filter-dropdown>
                            <input type="hidden" name="class_room_id" value="{{ request('class_room_id') }}">

                            <button
                                type="button"
                                data-filter-toggle
                                aria-haspopup="listbox"
                                aria-expanded="false"
                                class="box-border flex w-full h-9 items-center justify-between gap-2 px-3 rounded-lg text-xs sm:text-[13px] font-medium outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <span class="truncate" data-filter-label>
                                    {{ $selectedClassRoomName }}
                                </span>

                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>

                            <div
                                data-filter-menu
                                class="absolute left-0 top-full z-30 mt-1 hidden w-36 max-w-full max-h-56 overflow-y-auto rounded-lg border p-1 shadow-lg"
                                role="listbox"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border);">

                                <button type="button" data-filter-option data-filter-value=""
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Semua Kelas
                                </button>

                                @foreach ($classRooms as $classRoom)
                                    <button
                                        type="button"
                                        data-filter-option
                                        data-filter-value="{{ $classRoom->id }}"
                                        class="block w-full truncate rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                        style="color: var(--admin-text);">
                                        {{ $classRoom->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Filter Hari --}}
                        <div class="relative w-full sm:w-36 sm:shrink-0" data-filter-dropdown>
                            <input type="hidden" name="day" value="{{ request('day') }}">

                            <button
                                type="button"
                                data-filter-toggle
                                aria-haspopup="listbox"
                                aria-expanded="false"
                                class="box-border flex w-full h-9 items-center justify-between px-3 rounded-lg text-xs sm:text-[13px] font-medium outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <span data-filter-label>
                                    {{ $days[request('day')] ?? 'Semua Hari' }}
                                </span>

                                <svg class="w-4 h-4 shrink-0 ml-2" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>

                            <div
                                data-filter-menu
                                class="absolute left-0 top-full z-30 mt-1 hidden w-36 max-w-full max-h-56 overflow-y-auto rounded-lg border p-1 shadow-lg"
                                role="listbox"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border);">

                                <button type="button" data-filter-option data-filter-value=""
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Semua Hari
                                </button>

                                @foreach ($days as $value => $label)
                                    <button
                                        type="button"
                                        data-filter-option
                                        data-filter-value="{{ $value }}"
                                        class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                        style="color: var(--admin-text);">
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        @if ($isFiltering)
                            <a href="{{ route('admin.schedules.index') }}"
                                class="inline-flex h-9 items-center justify-center px-3 rounded-lg text-xs sm:text-[13px] font-medium transition-colors duration-150 shrink-0"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"
                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                                Reset
                            </a>
                        @endif
                    </div>

                    {{-- Kanan: tombol tambah --}}
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                        <a href="{{ route('admin.schedules.create') }}"
                            class="inline-flex h-9 w-full sm:w-36 items-center justify-center gap-1.5 px-3 rounded-lg text-xs sm:text-[13px] font-semibold text-white transition-opacity hover:brightness-110 shrink-0"
                            style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">

                            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>

                            Tambah Jadwal
                        </a>
                    </div>
                </form>

                @if (method_exists($schedules, 'firstItem') && $schedules->total() > 0)
                    <p class="text-xs sm:text-sm mb-4 pt-2" style="color: var(--admin-muted);">
                        Showing
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $schedules->firstItem() ?? 0 }}
                        </span>
                        –
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $schedules->lastItem() ?? 0 }}
                        </span>
                        of
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $schedules->total() }}
                        </span>
                        records
                    </p>
                @endif

                <div class="rounded-xl overflow-hidden" style="border: 1px solid var(--admin-border);">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-1000px text-left border-collapse">
                            <thead style="border-bottom: 1px solid var(--admin-border); background-color: var(--admin-surface-soft);">
                                <tr>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Jadwal</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Kelas</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Guru</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Hari</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Waktu</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Ruangan</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Status</th>
                                    <th class="{{ $th }} text-right" style="color: var(--admin-muted);">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y" style="border-color: var(--admin-border);">
                                @forelse ($schedules as $schedule)
                                    <tr
                                        style="border-bottom: 1px solid var(--admin-border);"
                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                        onmouseout="this.style.backgroundColor='transparent'">

                                        <td class="{{ $td }}">
                                            <div class="font-medium" style="color: var(--admin-text);">
                                                {{ $schedule->subject }}
                                            </div>

                                            <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">
                                                Jadwal #{{ $schedule->id }}
                                            </div>
                                        </td>

                                        <td class="{{ $td }}">
                                            @if ($schedule->classRoom)
                                                <div class="font-medium" style="color: var(--admin-text);">
                                                    {{ $schedule->classRoom->name }}
                                                </div>

                                                <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">
                                                    {{ $schedule->classRoom->code }}
                                                </div>
                                            @else
                                                <span class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                                                    —
                                                </span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            @if ($schedule->teacher)
                                                <span style="color: var(--admin-text);">
                                                    {{ $schedule->teacher->name }}
                                                </span>
                                            @else
                                                <span class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                                                    —
                                                </span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            <span
                                                class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-slate-100/80 dark:bg-slate-500/20"
                                                style="color: var(--admin-text);">
                                                {{ $days[$schedule->day] ?? $schedule->day }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <span class="whitespace-nowrap font-medium" style="color: var(--admin-text);">
                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                –
                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <span style="color: var(--admin-text);">
                                                {{ $schedule->room ?: '—' }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            @if ($schedule->status === 'active')
                                                <span
                                                    class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-emerald-100/80 dark:bg-emerald-500/20"
                                                    style="color: var(--admin-text);">
                                                    Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-slate-100/80 dark:bg-slate-500/20"
                                                    style="color: var(--admin-text);">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            <div class="flex items-center justify-end gap-1">
                                                {{-- Detail --}}
                                                <a href="{{ route('admin.schedules.show', $schedule) }}"
                                                    title="Detail"
                                                    aria-label="Detail jadwal {{ $schedule->subject }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: var(--admin-icon);"
                                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true">
                                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('admin.schedules.edit', $schedule) }}"
                                                    title="Edit"
                                                    aria-label="Edit jadwal {{ $schedule->subject }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: var(--admin-icon);"
                                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true">
                                                        <path d="M12 20h9"/>
                                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                    </svg>
                                                </a>

                                                {{-- Hapus --}}
                                                <form
                                                    action="{{ route('admin.schedules.destroy', $schedule) }}"
                                                    method="POST"
                                                    class="inline-flex"
                                                    data-delete-form>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        title="Hapus"
                                                        aria-label="Hapus jadwal {{ $schedule->subject }}"
                                                        class="{{ $iconBtn }}"
                                                        style="color: #dc2626;"
                                                        onmouseover="this.style.backgroundColor='rgba(220, 38, 38, 0.1)'"
                                                        onmouseout="this.style.backgroundColor='transparent'">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            aria-hidden="true">
                                                            <path d="M3 6h18"/>
                                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                            <path d="m19 6-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                            <path d="M10 11v6M14 11v6"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-14 text-center">
                                            <div
                                                class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3"
                                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M8 2v4"/>
                                                    <path d="M16 2v4"/>
                                                    <rect width="18" height="18" x="3" y="4" rx="2"/>
                                                    <path d="M3 10h18"/>
                                                    <path d="M8 14h.01"/>
                                                    <path d="M12 14h.01"/>
                                                    <path d="M16 14h.01"/>
                                                    <path d="M8 18h.01"/>
                                                    <path d="M12 18h.01"/>
                                                </svg>
                                            </div>

                                            <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">
                                                Belum ada jadwal kelas
                                            </p>

                                            <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">
                                                Tambahkan jadwal untuk mengatur kegiatan bimbingan belajar.
                                            </p>

                                            <a href="{{ route('admin.schedules.create') }}"
                                                class="mt-4 inline-flex h-9 items-center justify-center gap-1.5 px-3 rounded-lg text-xs sm:text-[13px] font-semibold text-white hover:brightness-110"
                                                style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">
                                                Tambah Jadwal
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Pagination --}}
            @if (method_exists($schedules, 'hasPages') && $schedules->hasPages())
                <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Menampilkan
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $schedules->firstItem() ?? 0 }}–{{ $schedules->lastItem() ?? 0 }}
                        </span>
                        dari
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $schedules->total() }}
                        </span>
                        jadwal
                    </p>

                    <div class="flex flex-wrap items-center gap-2">
                        @if ($schedules->onFirstPage())
                            <span
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium opacity-50 cursor-not-allowed"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $schedules->appends(request()->query())->previousPageUrl() }}"
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium transition-colors"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Sebelumnya
                            </a>
                        @endif

                        <span class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                            Halaman {{ $schedules->currentPage() }} dari {{ $schedules->lastPage() }}
                        </span>

                        @if ($schedules->hasMorePages())
                            <a href="{{ $schedules->appends(request()->query())->nextPageUrl() }}"
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium transition-colors"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Berikutnya
                            </a>
                        @else
                            <span
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium opacity-50 cursor-not-allowed"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Berikutnya
                            </span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Popup konfirmasi hapus --}}
    <div
        id="delete-confirm-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="delete-modal-title"
        aria-hidden="true">

        <div
            class="w-full max-w-sm rounded-2xl border p-5 shadow-xl"
            style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">

            <h2 id="delete-modal-title" class="text-base font-semibold">
                Hapus jadwal ini?
            </h2>

            <p class="mt-2 text-sm" style="color: var(--admin-muted);">
                Jadwal yang dihapus tidak dapat dikembalikan.
            </p>

            <div class="mt-5 flex justify-end gap-2">
                <button
                    id="cancel-delete-button"
                    type="button"
                    class="h-9 rounded-lg border px-3 text-xs sm:text-sm font-medium"
                    style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-text);">
                    Batal
                </button>

                <button
                    id="confirm-delete-button"
                    type="button"
                    class="h-9 rounded-lg px-3 text-xs sm:text-sm font-semibold text-white"
                    style="background-color: #dc2626;">
                    Hapus Jadwal
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('input[name="search"]');

            if (searchInput) {
                let searchTimer;

                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimer);

                    searchTimer = setTimeout(function () {
                        searchInput.form?.requestSubmit();
                    }, 300);
                });
            }

            // Dropdown filter Kelas dan Hari
            const filterDropdowns = Array.from(
                document.querySelectorAll('[data-filter-dropdown]')
            );

            function closeFilterDropdowns() {
                filterDropdowns.forEach(function (dropdown) {
                    const menu = dropdown.querySelector('[data-filter-menu]');
                    const toggle = dropdown.querySelector('[data-filter-toggle]');

                    menu.classList.add('hidden');
                    toggle.setAttribute('aria-expanded', 'false');
                });
            }

            filterDropdowns.forEach(function (dropdown) {
                const toggle = dropdown.querySelector('[data-filter-toggle]');
                const menu = dropdown.querySelector('[data-filter-menu]');
                const input = dropdown.querySelector('input[type="hidden"]');
                const label = dropdown.querySelector('[data-filter-label]');

                toggle.addEventListener('click', function () {
                    const shouldOpen = menu.classList.contains('hidden');

                    closeFilterDropdowns();

                    if (shouldOpen) {
                        menu.classList.remove('hidden');
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                });

                dropdown.querySelectorAll('[data-filter-option]').forEach(function (option) {
                    option.addEventListener('click', function () {
                        input.value = option.dataset.filterValue;
                        label.textContent = option.textContent.trim();

                        closeFilterDropdowns();
                        toggle.closest('form').requestSubmit();
                    });
                });
            });

            document.addEventListener('click', function (event) {
                if (!event.target.closest('[data-filter-dropdown]')) {
                    closeFilterDropdowns();
                }
            });

            // Popup konfirmasi hapus
            const deleteModal = document.getElementById('delete-confirm-modal');
            const cancelDeleteButton = document.getElementById('cancel-delete-button');
            const confirmDeleteButton = document.getElementById('confirm-delete-button');
            let pendingDeleteForm = null;

            function closeDeleteModal() {
                if (!deleteModal) return;

                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                deleteModal.setAttribute('aria-hidden', 'true');
                pendingDeleteForm = null;
            }

            function openDeleteModal() {
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
                deleteModal.setAttribute('aria-hidden', 'false');
            }

            document.querySelectorAll('[data-delete-form]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    pendingDeleteForm = form;
                    openDeleteModal();
                });
            });

            cancelDeleteButton.addEventListener('click', closeDeleteModal);

            confirmDeleteButton.addEventListener('click', function () {
                if (pendingDeleteForm) {
                    HTMLFormElement.prototype.submit.call(pendingDeleteForm);
                }
            });

            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeFilterDropdowns();
                    closeDeleteModal();
                }
            });
        });
    </script>
</x-admin-layout>
