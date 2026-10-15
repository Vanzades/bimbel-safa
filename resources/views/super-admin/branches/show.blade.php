<x-super-admin-layout title="Detail Cabang">
    <div class="mx-auto max-w-6xl space-y-6">
        <div>
            <a href="{{ route('super-admin.branches.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="m15 18-6-6 6-6" />
                </svg>
                Kembali ke Cabang
            </a>

            <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-base font-bold text-blue-600">
                            {{ strtoupper(substr($branch->name, 0, 1)) }}
                        </div>

                        <div>
                            <div class="flex flex-wrap items-center gap-3">
                                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                                    {{ $branch->name }}
                                </h1>

                                @if ($branch->is_active)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Tidak Aktif
                                    </span>
                                @endif
                            </div>

                            <p class="mt-1 text-sm text-slate-500">
                                Informasi dan ringkasan data cabang.
                            </p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('super-admin.branches.edit', $branch) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-9-3h3m0 0V7m0 3l7-7 3 3-7 7" />
                    </svg>
                    Edit Cabang
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Pengguna</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $branch->users_count }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m9-10a4 4 0 100-8 4 4 0 000 8zm7 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Admin, guru, dan siswa
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Guru</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $branch->teachers_count }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m-6-3v-4.33L12 16l6-3.33V17" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Guru yang terdaftar
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Siswa</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $branch->students_count }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm7-1a4 4 0 100-8 4 4 0 000 8zm-1 11v-2a4 4 0 00-3-3.87" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Siswa yang terdaftar
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Kelas</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $branch->class_rooms_count }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M8 9h.01M12 9h.01M16 9h.01" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Kelas pada cabang
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jadwal</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $branch->schedules_count }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Jadwal pembelajaran
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Status</p>
                        <p class="mt-2 text-lg font-bold text-slate-900">
                            {{ $branch->is_active ? 'Beroperasi' : 'Tidak Beroperasi' }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl {{ $branch->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Status operasional cabang
                </p>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            Informasi Cabang
                        </h2>
                        <p class="mt-0.5 text-xs text-slate-500">
                            Detail informasi dasar cabang.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 px-5 py-6 sm:grid-cols-2 sm:px-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Nama Cabang
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-slate-900">
                        {{ $branch->name }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Nomor Telepon
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-slate-900">
                        {{ $branch->phone ?: '-' }}
                    </p>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Alamat
                    </p>

                    <p class="mt-1.5 text-sm font-medium leading-6 text-slate-700">
                        {{ $branch->address ?: 'Alamat belum diisi.' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Dibuat
                    </p>

                    <p class="mt-1.5 text-sm font-medium text-slate-700">
                        {{ $branch->created_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Terakhir Diperbarui
                    </p>

                    <p class="mt-1.5 text-sm font-medium text-slate-700">
                        {{ $branch->updated_at->format('d M Y, H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('super-admin.branches.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="m15 18-6-6 6-6" />
                </svg>
                Kembali ke Daftar Cabang
            </a>
        </div>
    </div>
</x-super-admin-layout>