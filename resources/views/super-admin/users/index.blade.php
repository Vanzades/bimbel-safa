<x-super-admin-layout title="Manajemen Pengguna">
    @php
        $totalUsers = $users->total();
        $adminCount = \App\Models\User::where('role', 'admin')->count();
        $teacherCount = \App\Models\User::where('role', 'guru')->count();
        $studentCount = \App\Models\User::where('role', 'siswa')->count();

        $isFiltering = request()->filled('search')
            || request()->filled('role')
            || request()->filled('branch_id');
    @endphp

    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-medium text-blue-600">Super Admin</p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Manajemen Pengguna
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola akun Admin, Guru, dan Siswa dari seluruh cabang.
                </p>
            </div>

            <a href="{{ route('super-admin.users.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 5v14M5 12h14" />
                </svg>
                Tambah Pengguna
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z" />
                </svg>

                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="font-semibold">Terjadi kesalahan.</p>

                <ul class="mt-1 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Pengguna
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $totalUsers }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m9-10a4 4 0 100-8 4 4 0 000 8zm7 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Seluruh akun aktif dalam sistem
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Admin
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $adminCount }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 15a4 4 0 100-8 4 4 0 000 8zm8 6a8 8 0 00-16 0m14-14a4 4 0 01-2.5 3.7" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Administrator cabang
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Guru
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $teacherCount }}
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
                    Akun guru terdaftar
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Siswa
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $studentCount }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm7-1a4 4 0 100-8 4 4 0 000 8zm-1 11v-2a4 4 0 00-3-3.87" />
                        </svg>
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-400">
                    Akun siswa terdaftar
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
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            Pencarian dan Filter
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Cari pengguna berdasarkan nama, email, role, atau cabang.
                        </p>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('super-admin.users.index') }}"
                class="flex flex-col gap-3 px-5 py-5 sm:px-6 lg:flex-row lg:items-center">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="h-10 w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
                    >
                </div>

                <select
                    name="role"
                    class="h-10 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 sm:w-40"
                >
                    <option value="">Semua Role</option>
                    <option value="admin" @selected(request('role') === 'admin')>
                        Admin
                    </option>
                    <option value="guru" @selected(request('role') === 'guru')>
                        Guru
                    </option>
                    <option value="siswa" @selected(request('role') === 'siswa')>
                        Siswa
                    </option>
                </select>

                <select
                    name="branch_id"
                    class="h-10 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 sm:w-48"
                >
                    <option value="">Semua Cabang</option>

                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" @selected((string) request('branch_id') === (string) $branch->id)>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>

                <button
                    type="submit"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M3 4h18M6 12h12m-8 8h4" />
                    </svg>
                    Filter
                </button>

                @if ($isFiltering)
                    <a href="{{ route('super-admin.users.index') }}"
                        class="inline-flex h-10 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">
                        Daftar Pengguna
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Menampilkan {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}
                        dari {{ $users->total() }} pengguna.
                    </p>
                </div>

                @if ($isFiltering)
                    <span class="inline-flex w-fit items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                        Filter aktif
                    </span>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Pengguna
                            </th>

                            <th class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Role
                            </th>

                            <th class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Cabang
                            </th>

                            <th class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Terhubung
                            </th>

                            <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($users as $user)
                            @php
                                $roleStyles = [
                                    'admin' => [
                                        'label' => 'Admin',
                                        'class' => 'bg-violet-50 text-violet-700',
                                    ],
                                    'guru' => [
                                        'label' => 'Guru',
                                        'class' => 'bg-amber-50 text-amber-700',
                                    ],
                                    'siswa' => [
                                        'label' => 'Siswa',
                                        'class' => 'bg-emerald-50 text-emerald-700',
                                    ],
                                ];

                                $role = $roleStyles[$user->role] ?? [
                                    'label' => ucfirst($user->role),
                                    'class' => 'bg-slate-100 text-slate-600',
                                ];
                            @endphp

                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-blue-600">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-slate-900">
                                                {{ $user->name }}
                                            </p>

                                            <p class="mt-0.5 truncate text-xs text-slate-500">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $role['class'] }}">
                                        {{ $role['label'] }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($user->branch)
                                        <div class="flex items-center gap-2">
                                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                        d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M8 9h.01M12 9h.01M16 9h.01" />
                                                </svg>
                                            </div>

                                            <div>
                                                <p class="text-sm font-medium text-slate-800">
                                                    {{ $user->branch->name }}
                                                </p>

                                                <p class="text-xs text-slate-400">
                                                    Cabang
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-sm text-slate-400">
                                            Tidak ada cabang
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if ($user->teacher)
                                        <p class="text-sm font-medium text-slate-800">
                                            {{ $user->teacher->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            Data Guru
                                        </p>
                                    @elseif ($user->student)
                                        <p class="text-sm font-medium text-slate-800">
                                            {{ $user->student->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            Data Siswa
                                        </p>
                                    @elseif ($user->isAdmin())
                                        <p class="text-sm font-medium text-slate-600">
                                            Administrator
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            Akun Cabang
                                        </p>
                                    @else
                                        <span class="text-sm text-slate-400">
                                            Belum terhubung
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('super-admin.users.show', $user) }}"
                                            title="Detail"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-blue-50 hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('super-admin.users.edit', $user) }}"
                                            title="Edit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-blue-50 hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('super-admin.users.destroy', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus akun {{ addslashes($user->name) }}?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Hapus"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-red-50 hover:text-red-600"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                        d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 5v6m4-6v6" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm7 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-sm font-semibold text-slate-900">
                                        Tidak ada pengguna
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Belum ada pengguna yang sesuai dengan filter yang dipilih.
                                    </p>

                                    @if ($isFiltering)
                                        <a href="{{ route('super-admin.users.index') }}"
                                            class="mt-4 inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                                            Reset Filter
                                        </a>
                                    @else
                                        <a href="{{ route('super-admin.users.create') }}"
                                            class="mt-4 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M12 5v14M5 12h14" />
                                            </svg>
                                            Tambah Pengguna
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-super-admin-layout>