<x-admin-layout>
    <x-slot name="title">
        Absensi Guru
    </x-slot>

    @php
        $isFiltering = request()->filled('date')
            || request()->filled('teacher_id');

        $th = 'px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
        $td = 'px-6 py-4 text-xs sm:text-sm';
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
                    Absensi Guru
                </span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                        Absensi Guru
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Kelola dan pantau kehadiran guru pada cabang Anda.
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-success-surface, #f0fdf4); border-color: var(--admin-success-border, #bbf7d0); color: var(--admin-success, #15803d);">
                    {{ session('success') }}
                </div>
            @endif

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

            <div class="rounded-2xl p-5 sm:p-6 shadow-sm mb-6"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold">
                            Input Absensi
                        </h2>

                        <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                            Tentukan status kehadiran setiap guru untuk tanggal yang dipilih.
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.teacher-attendance.store') }}">
                    @csrf

                    <div class="mb-6 max-w-xs">
                        <label for="input_date"
                            class="block mb-2 text-xs sm:text-sm font-semibold">
                            Tanggal Absensi
                        </label>

                        <input
                            type="date"
                            id="input_date"
                            name="date"
                            value="{{ old('date', $selectedDate) }}"
                            required
                            class="box-border w-full h-9 px-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                    </div>

                    <div class="rounded-xl overflow-hidden"
                        style="border: 1px solid var(--admin-border);">

                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[850px] text-left border-collapse">

                                <thead
                                    style="border-bottom: 1px solid var(--admin-border); background-color: var(--admin-surface-soft);">

                                    <tr>
                                        <th class="{{ $th }}" style="color: var(--admin-muted);">
                                            Guru
                                        </th>

                                        <th class="{{ $th }}" style="color: var(--admin-muted);">
                                            Status
                                        </th>

                                        <th class="{{ $th }}" style="color: var(--admin-muted);">
                                            Keterangan
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y"
                                    style="border-color: var(--admin-border);">

                                    @forelse ($teachers as $teacher)

                                        @php
                                            $existing = $todayAttendances->get($teacher->id);
                                        @endphp

                                        <tr
                                            style="border-bottom: 1px solid var(--admin-border);"
                                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                            onmouseout="this.style.backgroundColor='transparent'">

                                            <td class="{{ $td }}">
                                                <div class="min-w-0">
                                                    <div class="font-medium truncate"
                                                        style="color: var(--admin-text);">
                                                        {{ $teacher->name }}
                                                    </div>

                                                    <div class="text-[11px] sm:text-xs mt-0.5"
                                                        style="color: var(--admin-muted);">
                                                        {{ $teacher->identity_number ?: 'NIK belum tersedia' }}
                                                    </div>
                                                </div>

                                                <input
                                                    type="hidden"
                                                    name="attendance[{{ $teacher->id }}][teacher_id]"
                                                    value="{{ $teacher->id }}">
                                            </td>

                                            <td class="{{ $td }}">
                                                <select
                                                    name="attendance[{{ $teacher->id }}][status]"
                                                    required
                                                    class="box-border w-full min-w-40 h-9 px-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                                    <option value="present"
                                                        @selected(old("attendance.{$teacher->id}.status", $existing?->status ?? 'present') === 'present')>
                                                        Hadir
                                                    </option>

                                                    <option value="permission"
                                                        @selected(old("attendance.{$teacher->id}.status", $existing?->status) === 'permission')>
                                                        Izin
                                                    </option>

                                                    <option value="sick"
                                                        @selected(old("attendance.{$teacher->id}.status", $existing?->status) === 'sick')>
                                                        Sakit
                                                    </option>

                                                    <option value="absent"
                                                        @selected(old("attendance.{$teacher->id}.status", $existing?->status) === 'absent')>
                                                        Alpa
                                                    </option>
                                                </select>
                                            </td>

                                            <td class="{{ $td }}">
                                                <input
                                                    type="text"
                                                    name="attendance[{{ $teacher->id }}][notes]"
                                                    value="{{ old("attendance.{$teacher->id}.notes", $existing?->notes) }}"
                                                    placeholder="Tambahkan keterangan..."
                                                    class="box-border w-full min-w-64 h-9 px-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="3" class="px-6 py-14 text-center">

                                                <div
                                                    class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3"
                                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                                    <svg class="h-5 w-5" viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2">

                                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                                        <circle cx="9" cy="7" r="4"/>
                                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                                    </svg>
                                                </div>

                                                <p class="text-xs sm:text-sm font-medium"
                                                    style="color: var(--admin-text);">
                                                    Belum ada guru aktif
                                                </p>

                                                <p class="text-[11px] sm:text-xs mt-1"
                                                    style="color: var(--admin-muted);">
                                                    Belum ada guru aktif yang dapat dicatat kehadirannya.
                                                </p>

                                            </td>
                                        </tr>

                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($teachers->count())
                        <div class="flex justify-end mt-5">

                            <button
                                type="submit"
                                class="inline-flex h-9 items-center justify-center gap-1.5 px-4 rounded-lg text-xs sm:text-[13px] font-semibold text-white transition-opacity hover:brightness-110"
                                style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">

                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                                    <path d="M17 21v-8H7v8"/>
                                    <path d="M7 3v5h8"/>
                                </svg>

                                Simpan Absensi
                            </button>

                        </div>
                    @endif
                </form>
            </div>

            <div class="rounded-2xl p-5 sm:p-6 shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold">
                            Riwayat Absensi
                        </h2>

                        <p class="mt-1 text-xs sm:text-sm"
                            style="color: var(--admin-muted);">
                            Lihat riwayat kehadiran guru pada cabang Anda.
                        </p>
                    </div>
                </div>

                <form method="GET"
                    action="{{ route('admin.teacher-attendance.index') }}"
                    class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-6">

                    <div class="flex flex-col sm:flex-row sm:items-end gap-3 w-full lg:w-auto">

                        <div class="w-full sm:w-48">
                            <label for="date"
                                class="block mb-2 text-xs sm:text-sm font-semibold">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                id="date"
                                name="date"
                                value="{{ request('date') }}"
                                class="box-border w-full h-9 px-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                        </div>

                        <div class="w-full sm:w-56">
                            <label for="teacher_id"
                                class="block mb-2 text-xs sm:text-sm font-semibold">
                                Guru
                            </label>

                            <select
                                id="teacher_id"
                                name="teacher_id"
                                class="box-border w-full h-9 px-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <option value="">
                                    Semua Guru
                                </option>

                                @foreach ($teachers as $teacher)
                                    <option
                                        value="{{ $teacher->id }}"
                                        @selected(request('teacher_id') == $teacher->id)>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-2">

                            <button
                                type="submit"
                                class="inline-flex h-9 items-center justify-center px-4 rounded-lg text-xs sm:text-[13px] font-semibold text-white transition-opacity hover:brightness-110"
                                style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">
                                Filter
                            </button>

                            @if ($isFiltering)
                                <a
                                    href="{{ route('admin.teacher-attendance.index') }}"
                                    class="inline-flex h-9 items-center justify-center px-3 rounded-lg text-xs sm:text-[13px] font-medium transition-colors duration-150"
                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"
                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                    onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                                    Reset
                                </a>
                            @endif

                        </div>
                    </div>
                </form>

                @if (method_exists($attendances, 'firstItem') && $attendances->total() > 0)
                    <p class="text-xs sm:text-sm mb-4 pt-2"
                        style="color: var(--admin-muted);">

                        Showing

                        <span class="font-semibold"
                            style="color: var(--admin-text);">
                            {{ $attendances->firstItem() ?? 0 }}
                        </span>

                        –

                        <span class="font-semibold"
                            style="color: var(--admin-text);">
                            {{ $attendances->lastItem() ?? 0 }}
                        </span>

                        of

                        <span class="font-semibold"
                            style="color: var(--admin-text);">
                            {{ $attendances->total() }}
                        </span>

                        records
                    </p>
                @endif

                <div class="rounded-xl overflow-hidden"
                    style="border: 1px solid var(--admin-border);">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[850px] text-left border-collapse">

                            <thead
                                style="border-bottom: 1px solid var(--admin-border); background-color: var(--admin-surface-soft);">

                                <tr>
                                    <th class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Tanggal
                                    </th>

                                    <th class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Guru
                                    </th>

                                    <th class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Status
                                    </th>

                                    <th class="{{ $th }}"
                                        style="color: var(--admin-muted);">
                                        Keterangan
                                    </th>
                                </tr>

                            </thead>

                            <tbody class="divide-y"
                                style="border-color: var(--admin-border);">

                                @forelse ($attendances as $attendance)

                                    <tr
                                        style="border-bottom: 1px solid var(--admin-border);"
                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                        onmouseout="this.style.backgroundColor='transparent'">

                                        <td class="{{ $td }}">
                                            <span style="color: var(--admin-text);">
                                                {{ $attendance->date->format('d/m/Y') }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <div class="font-medium"
                                                style="color: var(--admin-text);">
                                                {{ $attendance->teacher?->name ?? '-' }}
                                            </div>

                                            @if ($attendance->teacher?->identity_number)
                                                <div class="text-[11px] sm:text-xs mt-0.5"
                                                    style="color: var(--admin-muted);">
                                                    {{ $attendance->teacher->identity_number }}
                                                </div>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            @if ($attendance->status === 'present')
                                                <span
                                                    class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-emerald-100/80 dark:bg-emerald-500/20"
                                                    style="color: var(--admin-text);">
                                                    Hadir
                                                </span>
                                            @elseif ($attendance->status === 'permission')
                                                <span
                                                    class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-amber-100/80 dark:bg-amber-500/20"
                                                    style="color: var(--admin-text);">
                                                    Izin
                                                </span>
                                            @elseif ($attendance->status === 'sick')
                                                <span
                                                    class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-blue-100/80 dark:bg-blue-500/20"
                                                    style="color: var(--admin-text);">
                                                    Sakit
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold bg-red-100/80 dark:bg-red-500/20"
                                                    style="color: var(--admin-text);">
                                                    Alpa
                                                </span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            <span style="color: var(--admin-text);">
                                                {{ $attendance->notes ?: '—' }}
                                            </span>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="px-6 py-14 text-center">

                                            <div
                                                class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3"
                                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                                <svg class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2">

                                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                                    <path d="M16 2v4"/>
                                                    <path d="M8 2v4"/>
                                                    <path d="M3 10h18"/>
                                                </svg>
                                            </div>

                                            <p class="text-xs sm:text-sm font-medium"
                                                style="color: var(--admin-text);">
                                                Belum ada data absensi
                                            </p>

                                            <p class="text-[11px] sm:text-xs mt-1"
                                                style="color: var(--admin-muted);">
                                                Data absensi guru akan muncul setelah absensi disimpan.
                                            </p>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

                @if (method_exists($attendances, 'hasPages') && $attendances->hasPages())
                    <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <p class="text-xs sm:text-sm"
                            style="color: var(--admin-muted);">

                            Menampilkan

                            <span class="font-semibold"
                                style="color: var(--admin-text);">
                                {{ $attendances->firstItem() ?? 0 }}–{{ $attendances->lastItem() ?? 0 }}
                            </span>

                            dari

                            <span class="font-semibold"
                                style="color: var(--admin-text);">
                                {{ $attendances->total() }}
                            </span>

                            data
                        </p>

                        <div class="flex flex-wrap items-center gap-2">

                            @if ($attendances->onFirstPage())
                                <span
                                    class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium opacity-50 cursor-not-allowed"
                                    style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                    Sebelumnya
                                </span>
                            @else
                                <a
                                    href="{{ $attendances->appends(request()->query())->previousPageUrl() }}"
                                    class="inline-flex h-9 items-center rounded-lg border px-3 text-xs sm:text-sm font-medium transition-colors"
                                    style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">
                                    Sebelumnya
                                </a>
                            @endif

                            <span class="text-xs sm:text-sm"
                                style="color: var(--admin-muted);">
                                Halaman {{ $attendances->currentPage() }} dari {{ $attendances->lastPage() }}
                            </span>

                            @if ($attendances->hasMorePages())
                                <a
                                    href="{{ $attendances->appends(request()->query())->nextPageUrl() }}"
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
    </div>
</x-admin-layout>