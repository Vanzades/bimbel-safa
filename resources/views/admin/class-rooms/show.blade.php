<x-admin-layout>

    <x-slot name="title">

        Detail Kelas

    </x-slot>

    @php

        $th = 'px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';

        $td = 'px-6 py-4 text-xs sm:text-sm';

    @endphp

    <div

        class="py-4 lg:py-6 min-h-screen transition-colors duration-150"

        style="background-color: var(--admin-bg); color: var(--admin-text);"

    >

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">

            {{-- Breadcrumb --}}

            <nav

                class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3"

                style="color: var(--admin-muted);"

            >

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">

                    Dashboard

                </a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>

                <a href="{{ route('admin.class-rooms.index') }}" class="hover:opacity-85">

                    Kelas

                </a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">

                    {{ $classRoom->name }}

                </span>

            </nav>

            {{-- Judul halaman --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Detail Kelas

                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Informasi kelas dan daftar siswa.

                    </p>

                </div>

                <div class="flex flex-col sm:flex-row gap-3">

                    <a

                        href="{{ route('admin.class-rooms.edit', $classRoom) }}"

                        class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition-opacity hover:brightness-110"

                        style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"

                    >

                        Edit Kelas

                    </a>

                    <a

                        href="{{ route('admin.class-rooms.index') }}"

                        class="inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-[13px] sm:text-sm font-medium transition-colors duration-150"

                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"

                        onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"

                    >

                        Kembali

                    </a>

                </div>

            </div>

            {{-- Informasi kelas --}}

            <div

                class="mb-6 rounded-2xl p-5 sm:p-6 shadow-sm"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

            >

                <div class="mb-5">

                    <h2 class="text-sm sm:text-base font-semibold">

                        Informasi Kelas

                    </h2>

                    <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Ringkasan informasi kelas ini.

                    </p>

                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                    <div

                        class="rounded-xl border p-4"

                        style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

                    >

                        <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                            Nama Kelas

                        </p>

                        <p class="mt-2 text-xs sm:text-sm font-semibold">

                            {{ $classRoom->name }}

                        </p>

                    </div>

                    <div

                        class="rounded-xl border p-4"

                        style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

                    >

                        <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                            Kode Kelas

                        </p>

                        <p class="mt-2 text-xs sm:text-sm font-semibold">

                            {{ $classRoom->code }}

                        </p>

                    </div>

                    <div

                        class="rounded-xl border p-4"

                        style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

                    >

                        <p class="text-xs sm:text-sm font-medium uppercase tracking-wide" style="color: var(--admin-muted);">

                            Status

                        </p>

                        <div class="mt-2">

                            @if ($classRoom->status === 'active')

                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs sm:text-sm font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">

                                    Aktif

                                </span>

                            @else

                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs sm:text-sm font-semibold bg-gray-100 text-gray-600 dark:bg-gray-500/20 dark:text-gray-300">

                                    Tidak Aktif

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                <div class="mt-5 border-t pt-5" style="border-color: var(--admin-border);">

                    <h3 class="text-sm sm:text-base font-semibold">

                        Deskripsi

                    </h3>

                    <p class="mt-2 text-xs sm:text-sm leading-6" style="color: var(--admin-muted);">

                        {{ $classRoom->description ?: 'Tidak ada deskripsi.' }}

                    </p>

                </div>

            </div>

            {{-- Daftar siswa --}}

            <div

                class="rounded-2xl p-5 sm:p-6 shadow-sm"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

            >

                <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h2 class="text-sm sm:text-base font-semibold">

                            Daftar Siswa

                        </h2>

                        <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                            {{ $classRoom->students->count() }} siswa terdaftar di kelas ini.

                        </p>

                    </div>

                </div>

                @if ($classRoom->students->count())

                    <div class="overflow-x-auto rounded-xl border" style="border-color: var(--admin-border);">

                        <table class="w-full text-xs sm:text-sm">

                            <thead style="background-color: var(--admin-surface-soft);">

                                <tr style="border-bottom: 1px solid var(--admin-border);">

                                    <th class="{{ $th }}" style="color: var(--admin-muted);">

                                        No

                                    </th>

                                    <th class="{{ $th }}" style="color: var(--admin-muted);">

                                        Nama

                                    </th>

                                    <th class="{{ $th }}" style="color: var(--admin-muted);">

                                        NIS/NISN

                                    </th>

                                    <th class="{{ $th }}" style="color: var(--admin-muted);">

                                        Jenis Kelamin

                                    </th>

                                    <th class="{{ $th }}" style="color: var(--admin-muted);">

                                        Status

                                    </th>

                                    <th class="{{ $th }} text-right" style="color: var(--admin-muted);">

                                        Aksi

                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($classRoom->students as $index => $student)

                                    <tr

                                        class="transition-colors duration-150"

                                        style="border-bottom: 1px solid var(--admin-border);"

                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"

                                        onmouseout="this.style.backgroundColor='transparent'"

                                    >

                                        <td class="{{ $td }}" style="color: var(--admin-muted);">

                                            {{ $index + 1 }}

                                        </td>

                                        <td class="{{ $td }} font-medium">

                                            {{ $student->name }}

                                        </td>

                                        <td class="{{ $td }}" style="color: var(--admin-muted);">

                                            {{ $student->identity_number }}

                                        </td>

                                        <td class="{{ $td }}" style="color: var(--admin-muted);">

                                            {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}

                                        </td>

                                        <td class="{{ $td }}">

                                            @if ($student->status === 'active')

                                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs sm:text-sm font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">

                                                    Aktif

                                                </span>

                                            @else

                                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs sm:text-sm font-semibold bg-gray-100 text-gray-600 dark:bg-gray-500/20 dark:text-gray-300">

                                                    Tidak Aktif

                                                </span>

                                            @endif

                                        </td>

                                        <td class="{{ $td }} text-right">

                                            <a

                                                href="{{ route('admin.students.show', $student) }}"

                                                class="font-semibold transition-colors duration-150"

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

                        class="rounded-xl border px-5 py-12 text-center"

                        style="background-color: var(--admin-surface-soft); border-color: var(--admin-border);"

                    >

                        <p class="text-xs sm:text-sm" style="color: var(--admin-muted);">

                            Belum ada siswa yang terdaftar di kelas ini.

                        </p>

                        <a

                            href="{{ route('students.create') }}"

                            class="mt-4 inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition-opacity hover:brightness-110"

                            style="background-color: #2563EB;"

                        >

                            Tambah Siswa

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-admin-layout>
