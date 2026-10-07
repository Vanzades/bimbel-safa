<x-admin-layout>
    <x-slot name="title">
        Kelas
    </x-slot>

    @php
        $isFiltering = request()->filled('search') || request()->filled('status');

        $th = 'px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
        $td = 'px-6 py-4 text-xs sm:text-sm';
        $iconBtn = 'w-8 h-8 inline-flex items-center justify-center rounded-lg transition-colors duration-150';
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
                    Kelas
                </span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                        Kelas
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Kelola data kelas yang digunakan dalam kegiatan bimbingan belajar.
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

                <form method="GET" action="{{ route('admin.class-rooms.index') }}"
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                    {{-- Kiri: search, status, reset --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full lg:w-auto">

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
                                placeholder="Cari nama atau kode kelas..."
                                class="box-border w-full h-9 pl-10 pr-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                        </div>

                        {{-- Filter Status --}}
                        <div class="relative w-full sm:w-36 sm:shrink-0" data-filter-dropdown>
                            <input type="hidden" name="status" value="{{ request('status') }}">

                            <button
                                type="button"
                                data-filter-toggle
                                aria-haspopup="listbox"
                                aria-expanded="false"
                                class="box-border flex w-full h-9 items-center justify-between px-3 rounded-lg text-xs sm:text-[13px] font-medium outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <span data-filter-label>
                                    @if (request('status') === 'active')
                                        Aktif
                                    @elseif (request('status') === 'inactive')
                                        Nonaktif
                                    @else
                                        Semua Status
                                    @endif
                                </span>

                                <svg class="w-4 h-4 shrink-0 ml-2" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>

                            <div
                                data-filter-menu
                                class="absolute left-0 top-full z-30 mt-1 hidden w-36 max-w-full rounded-lg border p-1 shadow-lg"
                                role="listbox"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border);">

                                <button type="button" data-filter-option data-filter-value=""
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Semua Status
                                </button>

                                <button type="button" data-filter-option data-filter-value="active"
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Aktif
                                </button>

                                <button type="button" data-filter-option data-filter-value="inactive"
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Nonaktif
                                </button>
                            </div>
                        </div>

                        @if ($isFiltering)
                            <a href="{{ route('admin.class-rooms.index') }}"
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
                        <a href="{{ route('admin.class-rooms.create') }}"
                            class="inline-flex h-9 w-full sm:w-36 items-center justify-center gap-1.5 px-3 rounded-lg text-xs sm:text-[13px] font-semibold text-white transition-opacity hover:brightness-110 shrink-0"
                            style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">

                            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>

                            Tambah Kelas
                        </a>
                    </div>
                </form>

                @if (method_exists($classRooms, 'firstItem') && $classRooms->total() > 0)
                    <p class="text-xs sm:text-sm mb-4 pt-2" style="color: var(--admin-muted);">
                        Showing
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $classRooms->firstItem() ?? 0 }}
                        </span>
                        –
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $classRooms->lastItem() ?? 0 }}
                        </span>
                        of
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $classRooms->total() }}
                        </span>
                        records
                    </p>
                @endif

                <div class="rounded-xl overflow-hidden" style="border: 1px solid var(--admin-border);">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-900px text-left border-collapse">
                            <thead style="border-bottom: 1px solid var(--admin-border); background-color: var(--admin-surface-soft);">
                                <tr>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Kelas</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Kode</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Siswa</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Deskripsi</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Status</th>
                                    <th class="{{ $th }} text-right" style="color: var(--admin-muted);">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y" style="border-color: var(--admin-border);">
                                @forelse ($classRooms as $classRoom)
                                    @php
                                        $studentCount = $classRoom->students_count
                                            ?? $classRoom->students->count();
                                    @endphp

                                    <tr
                                        style="border-bottom: 1px solid var(--admin-border);"
                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                        onmouseout="this.style.backgroundColor='transparent'">

                                        <td class="{{ $td }}">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="M3 21h18"/>
                                                        <path d="M5 21V5l7-2v18"/>
                                                        <path d="M19 21V9l-7-2"/>
                                                    </svg>
                                                </div>

                                                <div class="min-w-0">
                                                    <div class="font-medium truncate" style="color: var(--admin-text);">
                                                        {{ $classRoom->name }}
                                                    </div>

                                                    <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">
                                                        Dibuat {{ $classRoom->created_at?->format('d M Y') ?? '—' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="{{ $td }}">
                                            <span
                                                class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-slate-100/80 dark:bg-slate-500/20"
                                                style="color: var(--admin-text);">
                                                {{ $classRoom->code }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <span class="font-medium" style="color: var(--admin-text);">
                                                {{ $studentCount }}
                                            </span>

                                            <span class="text-xs sm:text-sm ml-0.5" style="color: var(--admin-muted);">
                                                siswa
                                            </span>
                                        </td>

                                        <td class="max-w-xs {{ $td }}">
                                            @if ($classRoom->description)
                                                <p class="truncate" style="color: var(--admin-muted);">
                                                    {{ $classRoom->description }}
                                                </p>
                                            @else
                                                <span style="color: var(--admin-muted);">—</span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            @if ($classRoom->status === 'active')
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
                                                <a href="{{ route('admin.class-rooms.show', $classRoom) }}"
                                                    title="Detail"
                                                    aria-label="Detail {{ $classRoom->name }}"
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
                                                <a href="{{ route('admin.class-rooms.edit', $classRoom) }}"
                                                    title="Edit"
                                                    aria-label="Edit {{ $classRoom->name }}"
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

                                                {{-- Hapus (hanya jika kelas tidak punya siswa) --}}
                                                @if ($studentCount === 0)
                                                    <form
                                                        action="{{ route('admin.class-rooms.destroy', $classRoom) }}"
                                                        method="POST"
                                                        class="inline-flex"
                                                        data-delete-form>

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            title="Hapus"
                                                            aria-label="Hapus {{ $classRoom->name }}"
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
                                                @else
                                                    <button
                                                        type="button"
                                                        disabled
                                                        title="Kelas masih memiliki siswa"
                                                        aria-label="Hapus tidak tersedia, kelas masih memiliki siswa"
                                                        class="{{ $iconBtn }} cursor-not-allowed opacity-40"
                                                        style="color: var(--admin-muted);">
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
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-14 text-center">
                                            <div
                                                class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3"
                                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M3 21h18"/>
                                                    <path d="M5 21V5l7-2v18"/>
                                                    <path d="M19 21V9l-7-2"/>
                                                </svg>
                                            </div>

                                            <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">
                                                Belum ada data kelas
                                            </p>

                                            <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">
                                                Tambahkan kelas untuk mulai mengelola data bimbingan.
                                            </p>

                                            <a href="{{ route('admin.class-rooms.create') }}"
                                                class="mt-4 inline-flex h-9 items-center justify-center gap-1.5 px-3 rounded-lg text-xs sm:text-[13px] font-semibold text-white hover:brightness-110"
                                                style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">
                                                Tambah Kelas
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
            @if (method_exists($classRooms, 'hasPages') && $classRooms->hasPages())
                <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Menampilkan
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $classRooms->firstItem() ?? 0 }}–{{ $classRooms->lastItem() ?? 0 }}
                        </span>
                        dari
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $classRooms->total() }}
                        </span>
                        kelas
                    </p>

                    <div class="flex flex-wrap items-center gap-2">
                        @if ($classRooms->onFirstPage())
                            <span
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium opacity-50 cursor-not-allowed"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $classRooms->appends(request()->query())->previousPageUrl() }}"
                                class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium transition-colors"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                Sebelumnya
                            </a>
                        @endif

                        <span class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                            Halaman {{ $classRooms->currentPage() }} dari {{ $classRooms->lastPage() }}
                        </span>

                        @if ($classRooms->hasMorePages())
                            <a href="{{ $classRooms->appends(request()->query())->nextPageUrl() }}"
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
                Hapus kelas ini?
            </h2>

            <p class="mt-2 text-sm" style="color: var(--admin-muted);">
                Data kelas yang dihapus tidak dapat dikembalikan.
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
                    Hapus Kelas
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

            // Dropdown status
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
