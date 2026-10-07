<x-admin-layout>
    <x-slot name="title">
        Detail Kelas
    </x-slot>

    @php
        $th = 'px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider sm:px-5 sm:text-sm';
        $td = 'px-4 py-4 text-xs sm:px-5 sm:text-sm';

        $classIsActive = $classRoom->status === 'active';
        $classStatusBadge = $classIsActive
            ? 'bg-emerald-100/80 dark:bg-emerald-500/20'
            : 'bg-red-100/80 dark:bg-red-500/20';

        $infoBox = 'min-w-0 rounded-xl border p-3.5 sm:p-4';
        $infoBoxStyle = 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);';
        $label = 'mb-2 block text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
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

                <a href="{{ route('admin.class-rooms.index') }}" class="hover:opacity-85">
                    Kelas
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    {{ $classRoom->name }}
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Detail Kelas
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Informasi kelas dan daftar siswa.
                </p>
            </div>

            {{-- Informasi kelas --}}
            <section
                class="mb-6 rounded-2xl p-5 shadow-sm sm:p-6"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                <div class="mb-4 flex items-center gap-3">
                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                        style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 7.5 12 3.75l8.25 3.75L12 11.25 3.75 7.5ZM5.25 9.5v6.25L12 19.5l6.75-3.75V9.5M12 11.25V19.5"/>
                        </svg>
                    </span>

                    <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                        Informasi Kelas
                    </h2>
                </div>

                <div class="grid min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-4">
                    <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                        <span class="{{ $label }}" style="color: var(--admin-muted);">
                            Nama Kelas
                        </span>
                        <p class="{{ $value }}" style="color: var(--admin-text);">
                            {{ $classRoom->name }}
                        </p>
                    </div>

                    <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                        <span class="{{ $label }}" style="color: var(--admin-muted);">
                            Kode Kelas
                        </span>
                        <p class="{{ $value }}" style="color: var(--admin-text);">
                            {{ $classRoom->code }}
                        </p>
                    </div>

                    <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                        <span class="{{ $label }}" style="color: var(--admin-muted);">
                            Status
                        </span>
                        <span
                            class="inline-flex rounded-md px-2.5 py-1 text-xs font-semibold {{ $classStatusBadge }}"
                            style="color: var(--admin-text);"
                        >
                            {{ $classIsActive ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                        <span class="{{ $label }}" style="color: var(--admin-muted);">
                            Data Dibuat
                        </span>
                        <p class="{{ $value }}" style="color: var(--admin-text);">
                            {{ $classRoom->created_at?->format('d F Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <div class="{{ $infoBox }} sm:col-span-2 lg:col-span-3" style="{{ $infoBoxStyle }}">
                        <span class="{{ $label }}" style="color: var(--admin-muted);">
                            Deskripsi
                        </span>
                        <p class="wrap-break-word whitespace-pre-line text-xs leading-relaxed sm:text-sm" style="color: var(--admin-text);">
                            {{ $classRoom->description ?: 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>
            </section>

            {{-- Daftar siswa --}}
            <section
                class="rounded-2xl p-5 shadow-sm sm:p-6"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                <div class="mb-5">
                    <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                        Daftar Siswa
                    </h2>
                    <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        {{ $classRoom->students->count() }} siswa terdaftar di kelas ini.
                    </p>
                </div>

                @if ($classRoom->students->count())
                    {{-- Tampilan kartu di layar kecil --}}
                    <div class="space-y-3 lg:hidden">
                        @foreach ($classRoom->students as $index => $student)
                            @php
                                $studentIsActive = $student->status === 'active';
                                $studentStatusBadge = $studentIsActive
                                    ? 'bg-emerald-100/80 dark:bg-emerald-500/20'
                                    : 'bg-red-100/80 dark:bg-red-500/20';
                            @endphp

                            <article
                                class="rounded-xl border p-4"
                                style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                            >
                                <div class="flex min-w-0 items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="wrap-break-word text-xs font-semibold sm:text-sm" style="color: var(--admin-text);">
                                            {{ $student->name }}
                                        </p>
                                        <p class="mt-1 wrap-break-word text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                            NIS/NISN: {{ $student->identity_number }}
                                        </p>
                                    </div>

                                    <span
                                        class="inline-flex shrink-0 rounded-md px-2 py-1 text-[10px] font-semibold sm:text-xs {{ $studentStatusBadge }}"
                                        style="color: var(--admin-text);"
                                    >
                                        {{ $studentIsActive ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </div>

                                <div class="mt-3 flex items-center justify-between border-t pt-3" style="border-color: var(--admin-border);">
                                    <span class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                        Siswa {{ $index + 1 }}
                                    </span>

                                    <a
                                        href="{{ route('admin.students.show', $student) }}"
                                        class="text-xs font-semibold sm:text-[13px]"
                                        style="color: #2563EB;"
                                    >
                                        Detail
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Tampilan tabel di layar besar --}}
                    <div class="hidden lg:block">
                        <table class="w-full table-fixed text-xs sm:text-sm">
                            <thead style="background-color: var(--admin-surface-soft);">
                                <tr style="border-bottom: 1px solid var(--admin-border);">
                                    <th class="{{ $th }} w-[8%]" style="color: var(--admin-muted);">
                                        No
                                    </th>
                                    <th class="{{ $th }} w-[32%]" style="color: var(--admin-muted);">
                                        Nama
                                    </th>
                                    <th class="{{ $th }} w-[28%]" style="color: var(--admin-muted);">
                                        NIS/NISN
                                    </th>
                                    <th class="{{ $th }} w-[18%]" style="color: var(--admin-muted);">
                                        Status
                                    </th>
                                    <th class="{{ $th }} w-[14%] text-right" style="color: var(--admin-muted);">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($classRoom->students as $index => $student)
                                    @php
                                        $studentIsActive = $student->status === 'active';
                                        $studentStatusBadge = $studentIsActive
                                            ? 'bg-emerald-100/80 dark:bg-emerald-500/20'
                                            : 'bg-red-100/80 dark:bg-red-500/20';
                                    @endphp

                                    <tr
                                        class="transition-colors duration-150"
                                        style="border-bottom: 1px solid var(--admin-border);"
                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                        onmouseout="this.style.backgroundColor='transparent'"
                                    >
                                        <td class="{{ $td }}" style="color: var(--admin-muted);">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="{{ $td }} wrap-break-word font-medium" style="color: var(--admin-text);">
                                            {{ $student->name }}
                                        </td>

                                        <td class="{{ $td }} wrap-break-word" style="color: var(--admin-muted);">
                                            {{ $student->identity_number }}
                                        </td>

                                        <td class="{{ $td }}">
                                            <span
                                                class="inline-flex rounded-md px-2.5 py-1 text-xs font-semibold {{ $studentStatusBadge }}"
                                                style="color: var(--admin-text);"
                                            >
                                                {{ $studentIsActive ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }} text-right">
                                            <a
                                                href="{{ route('admin.students.show', $student) }}"
                                                class="font-semibold transition-opacity hover:opacity-75"
                                                style="color: #2563EB;"
                                            >
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div
                        class="rounded-xl border px-5 py-10 text-center sm:py-12"
                        style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"
                    >
                        <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">
                            Belum ada siswa yang terdaftar di kelas ini.
                        </p>

                        <a
                            href="{{ route('students.create') }}"
                            class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-[13px] font-semibold text-white transition-opacity hover:brightness-110 sm:w-auto"
                            style="background-color: #2563EB;"
                        >
                            Tambah Siswa
                        </a>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-admin-layout>
