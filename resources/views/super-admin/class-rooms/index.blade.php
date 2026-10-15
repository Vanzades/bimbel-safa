<x-super-admin-layout title="Monitoring Kelas">
    <div class="space-y-6">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                <span>Super Admin</span>
                <span>/</span>
                <span>Kelas</span>
            </div>

        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
            Monitoring Kelas
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Pantau jumlah dan data kelas dari seluruh cabang Bimbel Safa.
        </p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Kelas</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">
                {{ $totalClasses }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Kelas Aktif</p>
            <p class="mt-2 text-2xl font-semibold text-emerald-600">
                {{ $activeClasses }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Kelas Tidak Aktif</p>
            <p class="mt-2 text-2xl font-semibold text-slate-500">
                {{ $inactiveClasses }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Siswa</p>
            <p class="mt-2 text-2xl font-semibold text-blue-600">
                {{ $totalStudents }}
            </p>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" class="grid gap-3 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama atau kode kelas..."
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
            </div>

            <select name="branch_id"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                <option value="">Semua Cabang</option>

                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}"
                        @selected(request('branch_id') == $branch->id)>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>

            <select name="status"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                <option value="">Semua Status</option>
                <option value="active" @selected(request('status') === 'active')>
                    Aktif
                </option>
                <option value="inactive" @selected(request('status') === 'inactive')>
                    Tidak Aktif
                </option>
            </select>

            <div class="flex gap-2 lg:col-span-4">
                <button type="submit"
                        class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Filter
                </button>

                <a href="{{ route('super-admin.class-rooms.index') }}"
                   class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="text-base font-semibold text-slate-900">
                Daftar Kelas
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Data kelas yang tersedia pada setiap cabang.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="border-b border-slate-100 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Kelas
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Cabang
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Siswa
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Jadwal
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($classRooms as $classRoom)
                        <tr class="transition hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">
                                        {{ $classRoom->name }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-slate-500">
                                        {{ $classRoom->code }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $classRoom->branch?->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-900">
                                    {{ $classRoom->students_count }}
                                </span>
                                <span class="text-xs text-slate-400">
                                    siswa
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-900">
                                    {{ $classRoom->schedules_count }}
                                </span>
                                <span class="text-xs text-slate-400">
                                    jadwal
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if ($classRoom->status === 'active')
                                    <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center">
                                <p class="text-sm font-semibold text-slate-700">
                                    Belum ada data kelas.
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    Data kelas akan tampil setelah dibuat oleh Admin Cabang.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($classRooms->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $classRooms->links() }}
            </div>
        @endif
    </div>
</div>

</x-super-admin-layout>
