
<x-super-admin-layout title="Manajemen Siswa">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <span>Super Admin</span>
                    <span>/</span>
                    <span>Master Data</span>
                    <span>/</span>
                    <span class="text-slate-700">Siswa</span>
                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                    Manajemen Siswa
                </h1>

                <p class="mt-1 max-w-2xl text-sm leading-6 text-slate-500">
                    Pantau dan kelola data siswa dari seluruh cabang Bimbel Safa dalam satu halaman.
                </p>
            </div>

            <a
                href="{{ route('super-admin.students.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M12 5v14"/>
                    <path d="M5 12h14"/>
                </svg>
                Tambah Siswa
            </a>
        </div>

        @if (session('success'))
            <div role="status" class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="m5 12 4 4L19 6"/>
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div role="alert" class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4"/>
                    <path d="M12 16h.01"/>
                </svg>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div role="alert" class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <p class="font-semibold">Data belum dapat diproses.</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Siswa</p>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-slate-900">
                            {{ number_format($totalStudents, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Siswa terdaftar dan disetujui</p>
                    </div>
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Siswa Aktif</p>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-emerald-600">
                            {{ number_format($activeStudents, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Berstatus aktif</p>
                    </div>
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="m5 12 4 4L19 6"/>
                            <circle cx="12" cy="12" r="10"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Siswa Nonaktif</p>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-slate-700">
                            {{ number_format($inactiveStudents, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Berstatus nonaktif</p>
                    </div>
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 12h8"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Akun Terhubung</p>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-blue-600">
                            {{ number_format($linkedStudents, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Siswa memiliki akun pengguna</p>
                    </div>
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="16" rx="3"/>
                            <circle cx="9" cy="10" r="2.5"/>
                            <path d="M5.5 16a3.5 3.5 0 0 1 7 0M15 9h3M15 13h3"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                <h2 class="text-base font-semibold text-slate-900">Filter Data Siswa</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Cari berdasarkan identitas siswa, kontak, orang tua, cabang, kelas, atau program.
                </p>
            </div>

            <form method="GET" action="{{ route('super-admin.students.index') }}" class="space-y-4 p-5 sm:p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <div class="xl:col-span-2">
                        <label for="search" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Pencarian
                        </label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m20 20-4-4"/>
                            </svg>
                            <input
                                id="search"
                                type="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Nama, NIK, telepon, email, atau nama orang tua"
                                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="branch_id" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Cabang
                        </label>
                        <select
                            id="branch_id"
                            name="branch_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">Semua Cabang</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @selected((string) request('branch_id') === (string) $branch->id)>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="class_room_id" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Kelas
                        </label>
                        <select
                            id="class_room_id"
                            name="class_room_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">Semua Kelas</option>
                            @foreach ($classRooms as $classRoom)
                                <option value="{{ $classRoom->id }}" @selected((string) request('class_room_id') === (string) $classRoom->id)>
                                    {{ $classRoom->name }}{{ $classRoom->branch ? ' · '.$classRoom->branch->name : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="program_id" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Program
                        </label>
                        <select
                            id="program_id"
                            name="program_id"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">Semua Program</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" @selected((string) request('program_id') === (string) $program->id)>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Status Siswa
                        </label>
                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">Semua Status</option>
                            <option value="active" @selected(request('status') === 'active')>Aktif</option>
                            <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-2 border-t border-slate-100 pt-4 sm:flex-row sm:items-center">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-900/10"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M4 7h16M7 12h10m-7 5h4"/>
                        </svg>
                        Terapkan Filter
                    </button>

                    <a
                        href="{{ route('super-admin.students.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50"
                    >
                        Reset Filter
                    </a>

                    <p class="text-xs text-slate-500 sm:ml-auto">
                        {{ number_format($students->total(), 0, ',', '.') }} data ditemukan
                    </p>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Daftar Siswa</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi siswa yang telah disetujui dari seluruh cabang.
                    </p>
                </div>

                <span class="inline-flex w-fit items-center rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                    {{ $students->firstItem() ?? 0 }}–{{ $students->lastItem() ?? 0 }} dari {{ number_format($students->total(), 0, ',', '.') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-6">
                                Siswa
                            </th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Kontak
                            </th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Cabang
                            </th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Program & Kelas
                            </th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Orang Tua / Wali
                            </th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Status
                            </th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Akun
                            </th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3.5 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($students as $student)
                            <tr class="transition hover:bg-slate-50/70">
                                <td class="px-5 py-4 sm:px-6">
                                    <div class="flex min-w-48 items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-blue-700">
                                            {{ strtoupper(mb_substr($student->name ?? 'S', 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-semibold text-slate-900">
                                                {{ $student->name }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-500">
                                                NIK: {{ $student->identity_number ?: 'Belum diisi' }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-500">
                                                {{ $student->gender === 'male' ? 'Laki-laki' : ($student->gender === 'female' ? 'Perempuan' : 'Belum diisi') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="min-w-44 space-y-1">
                                        <p class="text-sm text-slate-700">
                                            {{ $student->email ?: 'Email belum diisi' }}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            {{ $student->phone ?: 'Nomor telepon belum diisi' }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="whitespace-nowrap text-sm font-medium text-slate-800">
                                        {{ $student->branch?->name ?? '-' }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="min-w-40">
                                        <p class="text-sm font-medium text-slate-800">
                                            {{ $student->program?->name ?? '-' }}
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500">
                                            Kelas: {{ $student->classRoom?->name ?? '-' }}
                                        </p>
                                        @if ($student->classRoom?->code)
                                            <p class="mt-1 text-xs text-slate-400">
                                                Kode: {{ $student->classRoom->code }}
                                            </p>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="min-w-40">
                                        <p class="text-sm font-medium text-slate-800">
                                            {{ $student->parent_name ?: '-' }}
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $student->parent_phone ?: 'Nomor wali belum diisi' }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    @if ($student->status === 'active')
                                        <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if ($student->user)
                                        <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path d="m5 12 4 4L19 6"/>
                                            </svg>
                                            Terhubung
                                        </span>
                                    @else
                                        <span class="inline-flex whitespace-nowrap rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">
                                            Belum ada akun
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a
                                            href="{{ route('super-admin.students.show', $student) }}"
                                            class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50"
                                        >
                                            Detail
                                        </a>

                                        <a
                                            href="{{ route('super-admin.students.edit', $student) }}"
                                            class="inline-flex items-center justify-center rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('super-admin.students.destroy', $student) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus data siswa {{ addslashes($student->name) }}?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                            <circle cx="11" cy="11" r="7"/>
                                            <path d="m20 20-4-4"/>
                                        </svg>
                                    </div>
                                    <p class="mt-4 text-sm font-semibold text-slate-800">
                                        Data siswa tidak ditemukan
                                    </p>
                                    <p class="mt-1 text-sm text-slate-500">
                                        Coba ubah kata kunci atau filter yang digunakan.
                                    </p>
                                    <a
                                        href="{{ route('super-admin.students.index') }}"
                                        class="mt-4 inline-flex text-sm font-semibold text-blue-600 hover:text-blue-700"
                                    >
                                        Reset pencarian
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($students->hasPages())
                <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-sm text-slate-500">
                        Menampilkan {{ $students->firstItem() }}–{{ $students->lastItem() }}
                        dari {{ number_format($students->total(), 0, ',', '.') }} siswa
                    </p>
                    <div>
                        {{ $students->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-super-admin-layout>
