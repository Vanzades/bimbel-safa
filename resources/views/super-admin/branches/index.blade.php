<x-super-admin-layout title="Manajemen Cabang">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-blue-600">Super Admin</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Manajemen Cabang
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola dan pantau seluruh cabang Bimbel Safa.
                </p>
            </div>

            <a href="{{ route('super-admin.branches.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 5v14M5 12h14" />
                </svg>
                Tambah Cabang
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 9v4m0 4h.01M10.3 3.8L2.9 17a2 2 0 001.7 3h14.8a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @php
            $totalBranches = $branches->total();
            $activeBranches = $branches->where('is_active', true)->count();
            $inactiveBranches = $branches->where('is_active', false)->count();
            $totalUsers = $branches->sum('users_count');
            $totalTeachers = $branches->sum('teachers_count');
            $totalStudents = $branches->sum('students_count');
        @endphp

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Cabang</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">{{ $totalBranches }}</p>
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
                    Seluruh cabang terdaftar
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Cabang Aktif</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">{{ $activeBranches }}</p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Cabang yang sedang beroperasi
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Cabang Tidak Aktif</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">{{ $inactiveBranches }}</p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M18 12H6" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Cabang yang tidak beroperasi
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Pengguna</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">{{ $totalUsers }}</p>
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
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Guru</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">{{ $totalTeachers }}</p>
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
                    Guru yang terdaftar pada cabang
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Siswa</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">{{ $totalStudents }}</p>
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
                    Siswa yang terdaftar pada cabang
                </p>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">
                        Daftar Cabang
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi dan aktivitas setiap cabang Bimbel Safa.
                    </p>
                </div>

                <span class="text-sm text-slate-400">
                    {{ $totalBranches }} cabang
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="whitespace-nowrap px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Cabang
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Admin
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Guru
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Siswa
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Status
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($branches as $branch)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-blue-600">
                                            {{ strtoupper(substr($branch->name, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="truncate font-semibold text-slate-900">
                                                {{ $branch->name }}
                                            </p>
                                            <p class="mt-0.5 max-w-xs truncate text-xs text-slate-500">
                                                {{ $branch->address ?: 'Alamat belum diisi' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $branch->users_count }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $branch->teachers_count }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $branch->students_count }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
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
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('super-admin.branches.show', $branch) }}"
                                            class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                                            Detail
                                        </a>

                                        <a href="{{ route('super-admin.branches.edit', $branch) }}"
                                            class="rounded-lg px-3 py-2 text-xs font-semibold text-blue-600 transition hover:bg-blue-50">
                                            Edit
                                        </a>

                                        <form action="{{ route('super-admin.branches.destroy', $branch) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus cabang ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6" />
                                        </svg>
                                    </div>

                                    <p class="mt-4 font-semibold text-slate-700">
                                        Belum ada cabang
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan cabang pertama untuk mulai mengelola data.
                                    </p>

                                    <a href="{{ route('super-admin.branches.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                                        Tambah Cabang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($branches->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">
                    {{ $branches->links() }}
                </div>
            @endif
        </div>
    </div>
</x-super-admin-layout>