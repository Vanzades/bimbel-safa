<x-admin-layout>

    <x-slot name="title">

        Jadwal Kelas

    </x-slot>



    @php

        $isFiltering = request()->filled('search') || request()->filled('class_room_id') || request()->filled('day') || request()->filled('status');



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

                <span class="font-semibold" style="color: var(--admin-text);">Jadwal Kelas</span>

            </nav>



            {{-- ====== JUDUL HALAMAN ====== --}}

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

                <form method="GET" action="{{ route('admin.schedules.index') }}" class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">



                    {{-- Kiri: dropdown filter (Kelas, Hari, Status) --}}

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">

                        <select

                            name="class_room_id"

                            onchange="this.form.submit()"

                            class="w-full sm:w-44 py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                            <option value="">Semua Kelas</option>

                            @foreach ($classRooms as $classRoom)

                                <option value="{{ $classRoom->id }}" {{ (string) request('class_room_id') === (string) $classRoom->id ? 'selected' : '' }}>

                                    {{ $classRoom->name }}

                                </option>

                            @endforeach

                        </select>



                        <select

                            name="day"

                            onchange="this.form.submit()"

                            class="w-full sm:w-44 py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                            <option value="">Semua Hari</option>

                            <option value="monday" {{ request('day') === 'monday' ? 'selected' : '' }}>Senin</option>

                            <option value="tuesday" {{ request('day') === 'tuesday' ? 'selected' : '' }}>Selasa</option>

                            <option value="wednesday" {{ request('day') === 'wednesday' ? 'selected' : '' }}>Rabu</option>

                            <option value="thursday" {{ request('day') === 'thursday' ? 'selected' : '' }}>Kamis</option>

                            <option value="friday" {{ request('day') === 'friday' ? 'selected' : '' }}>Jumat</option>

                            <option value="saturday" {{ request('day') === 'saturday' ? 'selected' : '' }}>Sabtu</option>

                        </select>



                        <select

                            name="status"

                            onchange="this.form.submit()"

                            class="w-full sm:w-44 py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                            <option value="">Semua Status</option>

                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>

                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>

                        </select>

                    </div>



                    {{-- Kanan: search + reset + tombol tambah jadwal --}}

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

                        <div class="relative w-full sm:w-64">

                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none" style="color: var(--admin-icon);">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>

                            </span>

                            <input

                                type="text"

                                name="search"

                                value="{{ request('search') }}"

                                placeholder="Cari mata pelajaran, kelas, guru..."

                                class="w-full pl-10 pr-4 py-2.5 rounded-xl text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                        </div>



                        @if ($isFiltering)

                        <a href="{{ route('admin.schedules.index') }}"

                            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-medium transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                            onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">

                            Reset

                        </a>

                        @endif



                        {{-- Tombol Tambah Jadwal --}}

                        <a href="{{ route('admin.schedules.create') }}"

                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white transition-opacity shadow-md hover:brightness-110 shrink-0"

                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);">

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>

                            Tambah Jadwal

                        </a>

                    </div>

                </form>



                {{-- Showing X - Y of Z records --}}

                @if (method_exists($schedules, 'firstItem') && $schedules->total() > 0)

                <p class="text-[11px] sm:text-xs mb-4 pt-2" style="color: var(--admin-muted);">

                    Showing <span class="font-semibold" style="color: var(--admin-text);">{{ $schedules->firstItem() ?? 0 }}</span>

                    – <span class="font-semibold" style="color: var(--admin-text);">{{ $schedules->lastItem() ?? 0 }}</span>

                    of <span class="font-semibold" style="color: var(--admin-text);">{{ $schedules->total() }}</span> records

                </p>

                @endif



                {{-- ====== TABEL ====== --}}

                <div class="rounded-xl overflow-hidden" style="border: 1px solid var(--admin-border);">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-900px text-left border-collapse">

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

                                <tr style="border-bottom: 1px solid var(--admin-border);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

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

                                            <span class="text-xs sm:text-sm" style="color: var(--admin-muted);">—</span>

                                        @endif

                                    </td>



                                    <td class="{{ $td }}">

                                        @if ($schedule->teacher)

                                            <div class="flex items-center gap-2.5">

                                                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-xs sm:text-sm font-semibold uppercase" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                                    {{ substr($schedule->teacher->name, 0, 1) }}

                                                </div>

                                                <span style="color: var(--admin-text);">

                                                    {{ $schedule->teacher->name }}

                                                </span>

                                            </div>

                                        @else

                                            <span class="text-xs sm:text-sm" style="color: var(--admin-muted);">—</span>

                                        @endif

                                    </td>



                                    <td class="{{ $td }}">

                                        @php

                                            $days = [

                                                'monday' => 'Senin',

                                                'tuesday' => 'Selasa',

                                                'wednesday' => 'Rabu',

                                                'thursday' => 'Kamis',

                                                'friday' => 'Jumat',

                                                'saturday' => 'Sabtu',

                                            ];

                                        @endphp

                                        <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm bg-slate-100/80 text-slate-700 font-semibold dark:bg-slate-500/20 dark:text-slate-300">

                                            {{ $days[$schedule->day] ?? $schedule->day }}

                                        </span>

                                    </td>



                                    <td class="{{ $td }}">

                                        <span class="whitespace-nowrap font-medium" style="color: var(--admin-text);">

                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                            —

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

                                            <a href="{{ route('admin.schedules.show', $schedule) }}" title="Detail"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>

                                            </a>



                                            {{-- Edit --}}

                                            <a href="{{ route('admin.schedules.edit', $schedule) }}" title="Edit"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>

                                            </a>



                                            {{-- Hapus --}}

                                            <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" title="Hapus"

                                                    class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.1)'; this.style.color='#ef4444';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--admin-icon)';">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="8" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

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

                                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">Belum ada jadwal kelas</p>

                                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">Tambahkan jadwal untuk mengatur kegiatan bimbingan belajar.</p>

                                        <a href="{{ route('admin.schedules.create') }}"

                                            class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white shadow-md hover:brightness-110"

                                            style="background-color: #2563EB;">

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

            <div class="mt-4">

                {{ $schedules->links() }}

            </div>

            @endif



        </div>

    </div>

</x-admin-layout>
