<x-admin-layout>
    <x-slot name="title">
        Pendaftaran Siswa
    </x-slot>

    @php
        $isFiltering = request()->filled('search');

        $th = 'px-5 py-4 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider whitespace-nowrap';
        $td = 'px-5 py-4 text-xs sm:text-sm align-top';
        $iconBtn = 'inline-flex h-9 w-9 items-center justify-center rounded-lg transition-colors duration-150';
    @endphp

    <div class="min-h-screen pb-6 transition-colors duration-150"
        style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="mx-auto max-w-[90rem] px-4 sm:px-6 lg:px-8">

            <nav class="mb-4 flex items-center gap-2 text-xs font-medium"
                style="color: var(--admin-muted);">
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-75">
                    Dashboard
                </a>

                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="m9 18 6-6-6-6"/>
                </svg>

                <span style="color: var(--admin-text);">
                    Pendaftaran Siswa
                </span>
            </nav>

            <div class="mb-8 mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">
                        Pendaftaran Siswa
                    </h1>

                    <p class="mt-2 text-sm" style="color: var(--admin-muted);">
                        Periksa dan kelola pendaftaran siswa yang menunggu persetujuan.
                    </p>
                </div>

                <div class="inline-flex h-10 items-center gap-2 self-start rounded-lg px-4 text-sm font-semibold sm:self-auto"
                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>

                    {{ $registrations->total() }} Pendaftar
                </div>
            </div>

            @if (session('success'))
                <div class="mb-5 rounded-xl border px-4 py-3 text-sm"
                    style="background-color: rgba(16,185,129,.08); border-color: rgba(16,185,129,.25); color: #059669;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 rounded-xl border px-4 py-3 text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl border px-4 py-3 text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">
                    <p class="mb-2 font-semibold">Terjadi kesalahan.</p>

                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-2xl p-4 shadow-sm sm:p-6"
                style="background-color: var(--admin-surface); border: 1px solid var(--admin-border); box-shadow: 0 4px 20px var(--admin-shadow);">

                <form method="GET"
                    action="{{ route('admin.student-registrations.index') }}"
                    class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center">

                    <div class="relative w-full sm:max-w-md">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5"
                            style="color: var(--admin-icon);">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                        </span>

                        <input
                            type="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama, HP, email, atau orang tua..."
                            autocomplete="off"
                            class="h-10 w-full rounded-lg pl-10 pr-3 text-sm outline-none"
                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                    </div>

                    <button type="submit"
                        class="inline-flex h-10 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition-opacity hover:opacity-90"
                        style="background-color: var(--admin-primary, #2563eb);">
                        Cari
                    </button>

                    @if ($isFiltering)
                        <a href="{{ route('admin.student-registrations.index') }}"
                            class="inline-flex h-10 items-center justify-center rounded-lg px-4 text-sm font-medium"
                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                            Reset
                        </a>
                    @endif
                </form>

                @if ($registrations->total() > 0)
                    <p class="mb-4 text-sm" style="color: var(--admin-muted);">
                        Menampilkan
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $registrations->firstItem() }}–{{ $registrations->lastItem() }}
                        </span>
                        dari
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $registrations->total() }}
                        </span>
                        pendaftar
                    </p>
                @endif

                <div class="overflow-hidden rounded-xl"
                    style="border: 1px solid var(--admin-border);">

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[1250px] border-collapse text-left">
                            <thead style="background-color: var(--admin-surface-soft); border-bottom: 1px solid var(--admin-border);">
                                <tr>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Siswa</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Kontak</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Orang Tua / Wali</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Program</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Jadwal</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Informasi</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Status</th>
                                    <th class="{{ $th }} text-right" style="color: var(--admin-muted);">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($registrations as $student)
                                    <tr style="border-bottom: 1px solid var(--admin-border);"
                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                        onmouseout="this.style.backgroundColor='transparent'">

                                        <td class="{{ $td }}">
                                            <div class="flex items-start gap-3">
                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">
                                                        <circle cx="12" cy="8" r="4"/>
                                                        <path d="M4 21a8 8 0 0 1 16 0"/>
                                                    </svg>
                                                </div>

                                                <div class="min-w-0">
                                                    <p class="font-semibold" style="color: var(--admin-text);">
                                                        {{ $student->name }}
                                                    </p>

                                                    <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                                                        {{ $student->gender === 'male' ? 'Laki-laki' : ($student->gender === 'female' ? 'Perempuan' : '—') }}
                                                    </p>

                                                    <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                                                        {{ $student->birth_place ?: '—' }},
                                                        {{ $student->birth_date?->format('d M Y') ?? '—' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="{{ $td }}">
                                            <p class="font-medium" style="color: var(--admin-text);">
                                                {{ $student->phone ?: 'Nomor HP belum diisi' }}
                                            </p>

                                            <p class="mt-1 max-w-[210px] break-words text-xs"
                                                style="color: var(--admin-muted);">
                                                {{ $student->email ?: 'Email belum diisi' }}
                                            </p>
                                        </td>

                                        <td class="{{ $td }}">
                                            <p class="font-medium" style="color: var(--admin-text);">
                                                {{ $student->parent_name ?: '—' }}
                                            </p>

                                            <p class="mt-1" style="color: var(--admin-muted);">
                                                {{ $student->parent_phone ?: 'Nomor HP belum diisi' }}
                                            </p>

                                            <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                                                {{ $student->parent_occupation ?: '—' }}
                                            </p>
                                        </td>

                                        <td class="{{ $td }}">
                                            <p class="font-medium" style="color: var(--admin-text);">
                                                {{ $student->program?->name ?? 'Belum ditentukan' }}
                                            </p>

                                            <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                                                Kelas: {{ $student->classRoom?->name ?? 'Belum ditentukan' }}
                                            </p>

                                            <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                                                Cabang: {{ $student->branch?->name ?? 'Belum ditentukan' }}
                                            </p>
                                        </td>

                                        <td class="{{ $td }}">
                                            @if ($student->schedules->isNotEmpty())
                                                <div class="space-y-3">
                                                    @foreach ($student->schedules->take(2) as $schedule)
                                                        <div>
                                                            <p class="font-medium" style="color: var(--admin-text);">
                                                                {{ ucfirst($schedule->day) }}
                                                            </p>

                                                            <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                                –
                                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                            </p>

                                                            <p class="mt-1 text-xs" style="color: var(--admin-muted);">
                                                                {{ $schedule->subject ?: 'Mata pelajaran belum ditentukan' }}
                                                            </p>
                                                        </div>
                                                    @endforeach

                                                    @if ($student->schedules->count() > 2)
                                                        <p class="text-xs" style="color: var(--admin-muted);">
                                                            +{{ $student->schedules->count() - 2 }} jadwal lainnya
                                                        </p>
                                                    @endif
                                                </div>
                                            @else
                                                <span style="color: var(--admin-muted);">
                                                    Belum tersedia
                                                </span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            <div class="space-y-2">
                                                <p style="color: var(--admin-text);">
                                                    Bimbel sebelumnya:
                                                    <span class="font-medium">
                                                        {{ $student->previous_tutoring ? 'Ya' : 'Tidak' }}
                                                    </span>
                                                </p>

                                                <p style="color: var(--admin-text);">
                                                    Kebutuhan khusus:
                                                    <span class="font-medium">
                                                        {{ $student->special_needs ? 'Ya' : 'Tidak' }}
                                                    </span>
                                                </p>

                                                @if ($student->notes)
                                                    <p class="max-w-[220px] break-words text-xs"
                                                        style="color: var(--admin-muted);">
                                                        Catatan: {{ $student->notes }}
                                                    </p>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="{{ $td }}">
                                            <span class="inline-flex whitespace-nowrap rounded-lg px-2.5 py-1 text-xs font-semibold"
                                                style="background-color: rgba(245,158,11,.12); color: #d97706;">
                                                Menunggu Persetujuan
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <div class="flex justify-end">
                                                <a href="{{ route('admin.student-registrations.show', $student) }}"
                                                    title="Lihat detail pendaftaran"
                                                    aria-label="Detail {{ $student->name }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: var(--admin-icon);"
                                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">

                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-16 text-center">
                                            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full"
                                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">
                                                    @if ($isFiltering)
                                                        <circle cx="11" cy="11" r="7"/>
                                                        <path d="m16 16 4 4"/>
                                                    @else
                                                        <circle cx="12" cy="12" r="9"/>
                                                        <path d="M12 8v4"/>
                                                        <path d="M12 16h.01"/>
                                                    @endif
                                                </svg>
                                            </div>

                                            <p class="text-sm font-semibold" style="color: var(--admin-text);">
                                                {{ $isFiltering ? 'Pendaftaran tidak ditemukan' : 'Belum ada pendaftaran siswa' }}
                                            </p>

                                            <p class="mx-auto mt-2 max-w-lg text-sm"
                                                style="color: var(--admin-muted);">
                                                @if ($isFiltering)
                                                    Tidak ada pendaftaran yang cocok dengan kata kunci tersebut. Coba kata kunci lain atau reset pencarian.
                                                @else
                                                    Pendaftaran akan muncul di sini setelah siswa mengisi formulir dan datanya tersimpan dengan status menunggu persetujuan pada cabang Anda.
                                                @endif
                                            </p>

                                            @if ($isFiltering)
                                                <a href="{{ route('admin.student-registrations.index') }}"
                                                    class="mt-4 inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold text-white"
                                                    style="background-color: var(--admin-primary, #2563eb);">
                                                    Reset Pencarian
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($registrations->hasPages())
                    <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm" style="color: var(--admin-muted);">
                            Halaman {{ $registrations->currentPage() }}
                            dari {{ $registrations->lastPage() }}
                        </p>

                        <div class="flex items-center gap-2">
                            @if ($registrations->onFirstPage())
                                <span class="inline-flex h-9 cursor-not-allowed items-center rounded-lg px-3 text-sm opacity-50"
                                    style="border: 1px solid var(--admin-border);">
                                    Sebelumnya
                                </span>
                            @else
                                <a href="{{ $registrations->previousPageUrl() }}"
                                    class="inline-flex h-9 items-center rounded-lg px-3 text-sm"
                                    style="border: 1px solid var(--admin-border);">
                                    Sebelumnya
                                </a>
                            @endif

                            @if ($registrations->hasMorePages())
                                <a href="{{ $registrations->nextPageUrl() }}"
                                    class="inline-flex h-9 items-center rounded-lg px-3 text-sm"
                                    style="border: 1px solid var(--admin-border);">
                                    Berikutnya
                                </a>
                            @else
                                <span class="inline-flex h-9 cursor-not-allowed items-center rounded-lg px-3 text-sm opacity-50"
                                    style="border: 1px solid var(--admin-border);">
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