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

    {{-- Wrapper utama: Hapus transisi lambat, gunakan instant/durasi sangat singkat (150ms) --}}

    <div class="py-4 lg:py-6 min-h-screen transition-colors duration-150" style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">

            {{-- ====== Breadcrumb ====== --}}

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3" style="color: var(--admin-muted);">

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>

                <span class="font-semibold" style="color: var(--admin-text);">Kelas</span>

            </nav>

            {{-- ====== JUDUL HALAMAN ====== --}}

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

            {{-- Flash / Error Messages --}}

            @if ($errors->any())

            <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm" style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">

                <div class="font-semibold mb-1">Terjadi kesalahan.</div>

                <ul class="list-disc list-inside space-y-0.5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            {{-- ====== CARD UTAMA ====== --}}

            <div class="rounded-2xl p-5 sm:p-6 shadow-sm" style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                {{-- TOOLBAR / FILTER --}}

                <form method="GET" action="{{ route('admin.class-rooms.index') }}" class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                    {{-- Kiri: dropdown status --}}

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">

                        <select

                            name="status"

                            onchange="this.form.submit()"

                            class="w-full sm:w-44 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-medium outline-none transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                            <option value="">Semua Status</option>

                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>

                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>

                        </select>

                    </div>

                    {{-- Kanan: search + reset + tombol tambah kelas --}}

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

                        <div class="relative w-full sm:w-64">

                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none" style="color: var(--admin-icon);">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>

                            </span>

                            <input

                                type="text"

                                name="search"

                                value="{{ request('search') }}"

                                placeholder="Cari nama atau kode kelas..."

                                class="w-full pl-10 pr-4 py-2.5 rounded-xl text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                        </div>

                        @if ($isFiltering)

                        <a href="{{ route('admin.class-rooms.index') }}"

                            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-medium transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                            onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">

                            Reset

                        </a>

                        @endif

                        {{-- Tombol Tambah Kelas --}}

                        <a href="{{ route('admin.class-rooms.create') }}"

                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white transition-opacity shadow-md hover:brightness-110 shrink-0"

                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);">

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>

                            Tambah Kelas

                        </a>

                    </div>

                </form>

                {{-- Showing X - Y of Z records --}}

                @if (method_exists($classRooms, 'firstItem') && $classRooms->total() > 0)

                <p class="text-xs sm:text-sm mb-4 pt-2" style="color: var(--admin-muted);">

                    Showing <span class="font-semibold" style="color: var(--admin-text);">{{ $classRooms->firstItem() ?? 0 }}</span>

                    – <span class="font-semibold" style="color: var(--admin-text);">{{ $classRooms->lastItem() ?? 0 }}</span>

                    of <span class="font-semibold" style="color: var(--admin-text);">{{ $classRooms->total() }}</span> records

                </p>

                @endif

                {{-- ====== TABEL ====== --}}

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

                                <tr style="border-bottom: 1px solid var(--admin-border);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                    <td class="{{ $td }}">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-xs font-semibold uppercase" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

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

                                        <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm bg-slate-100/80 text-slate-700 font-semibold dark:bg-slate-500/20 dark:text-slate-300">

                                            {{ $classRoom->code }}

                                        </span>

                                    </td>

                                    <td class="{{ $td }}">

                                        <span class="font-medium" style="color: var(--admin-text);">

                                            {{ $classRoom->students_count ?? $classRoom->students->count() }}

                                        </span>

                                        <span class="text-xs sm:text-sm ml-0.5" style="color: var(--admin-muted);">siswa</span>

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

                                            <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm bg-emerald-100/80 text-emerald-700 font-semibold dark:bg-emerald-500/20 dark:text-emerald-300">

                                                Aktif

                                            </span>

                                        @else

                                            <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm bg-slate-100/80 text-slate-700 font-semibold dark:bg-slate-500/20 dark:text-slate-300">

                                                Nonaktif

                                            </span>

                                        @endif

                                    </td>

                                    <td class="{{ $td }}">

                                        <div class="flex items-center justify-end gap-1">

                                            {{-- Detail --}}

                                            <a href="{{ route('admin.class-rooms.show', $classRoom) }}" title="Detail"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>

                                            </a>

                                            {{-- Edit --}}

                                            <a href="{{ route('admin.class-rooms.edit', $classRoom) }}" title="Edit"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>

                                            </a>

                                            {{-- Hapus --}}

                                            @if (($classRoom->students_count ?? $classRoom->students->count()) === 0)

                                                <form action="{{ route('admin.class-rooms.destroy', $classRoom) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" title="Hapus"

                                                        class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.1)'; this.style.color='#ef4444';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--admin-icon)';">

                                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>

                                                    </button>

                                                </form>

                                            @else

                                                <button type="button" title="Tidak dapat dihapus karena masih memiliki siswa"

                                                    class="{{ $iconBtn }} opacity-40 cursor-not-allowed" style="color: var(--admin-icon);">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>

                                                </button>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                                <path d="M3 21h18"/>

                                                <path d="M5 21V5l7-2v18"/>

                                                <path d="M19 21V9l-7-2"/>

                                            </svg>

                                        </div>

                                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">Belum ada data kelas</p>

                                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">Tambahkan kelas untuk mulai mengelola data bimbingan.</p>

                                        <a href="{{ route('admin.class-rooms.create') }}"

                                            class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white shadow-md hover:brightness-110"

                                            style="background-color: #2563EB;">

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

            <div class="mt-4">

                {{ $classRooms->links() }}

            </div>

            @endif

        </div>

    </div>

</x-admin-layout>
