<x-super-admin-layout title="Laporan Absensi Guru">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-medium text-blue-600">Monitoring Kehadiran</p>
                <h1 class="mt-1 text-2xl font-semibold tracking-tight text-slate-900">
                    Laporan Absensi Guru
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Pantau dan lihat rekap kehadiran guru dari seluruh cabang Bimbel Safa.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Total Absensi</p>
                <p class="mt-2 text-2xl font-semibold text-slate-900">
                    {{ number_format($totalAttendance) }}
                </p>
            </div>

            <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
                <p class="text-sm font-medium text-emerald-700">Hadir</p>
                <p class="mt-2 text-2xl font-semibold text-emerald-800">
                    {{ number_format($presentCount) }}
                </p>
            </div>

            <div class="rounded-2xl border border-amber-100 bg-amber-50 p-5">
                <p class="text-sm font-medium text-amber-700">Izin</p>
                <p class="mt-2 text-2xl font-semibold text-amber-800">
                    {{ number_format($permissionCount) }}
                </p>
            </div>

            <div class="rounded-2xl border border-sky-100 bg-sky-50 p-5">
                <p class="text-sm font-medium text-sky-700">Sakit</p>
                <p class="mt-2 text-2xl font-semibold text-sky-800">
                    {{ number_format($sickCount) }}
                </p>
            </div>

            <div class="rounded-2xl border border-rose-100 bg-rose-50 p-5">
                <p class="text-sm font-medium text-rose-700">Alpa</p>
                <p class="mt-2 text-2xl font-semibold text-rose-800">
                    {{ number_format($absentCount) }}
                </p>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-5">
                <h2 class="text-base font-semibold text-slate-900">Filter Laporan</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Gunakan filter untuk menampilkan data absensi sesuai kebutuhan.
                </p>
            </div>

            <form method="GET" action="{{ route('super-admin.teacher-attendance.index') }}">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                    <div>
                        <label for="branch_id" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Cabang
                        </label>

                        <select
                            id="branch_id"
                            name="branch_id"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">Semua Cabang</option>

                            @foreach ($branches as $branch)
                                <option
                                    value="{{ $branch->id }}"
                                    @selected(request('branch_id') == $branch->id)
                                >
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="teacher_id" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Guru
                        </label>

                        <select
                            id="teacher_id"
                            name="teacher_id"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">Semua Guru</option>

                            @foreach ($teachers as $teacher)
                                <option
                                    value="{{ $teacher->id }}"
                                    @selected(request('teacher_id') == $teacher->id)
                                >
                                    {{ $teacher->name }}
                                    @if ($teacher->branch)
                                        — {{ $teacher->branch->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="date_from" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Dari Tanggal
                        </label>

                        <input
                            id="date_from"
                            type="date"
                            name="date_from"
                            value="{{ request('date_from') }}"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                    </div>

                    <div>
                        <label for="date_to" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Sampai Tanggal
                        </label>

                        <input
                            id="date_to"
                            type="date"
                            name="date_to"
                            value="{{ request('date_to') }}"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                    </div>

                    <div>
                        <label for="status" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">Semua Status</option>
                            <option value="present" @selected(request('status') === 'present')>
                                Hadir
                            </option>
                            <option value="permission" @selected(request('status') === 'permission')>
                                Izin
                            </option>
                            <option value="sick" @selected(request('status') === 'sick')>
                                Sakit
                            </option>
                            <option value="absent" @selected(request('status') === 'absent')>
                                Alpa
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
                    >
                        Terapkan Filter
                    </button>

                    <a
                        href="{{ route('super-admin.teacher-attendance.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                    >
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <h2 class="text-base font-semibold text-slate-900">Rekap Absensi Per Guru</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Ringkasan kehadiran guru berdasarkan filter yang dipilih.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Guru
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Cabang
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Hadir
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Izin
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Sakit
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Alpa
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Total
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($teacherRecaps as $recap)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-5 py-4">
                                    <div class="font-medium text-slate-900">
                                        {{ $recap['teacher']->name }}
                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">
                                        {{ $recap['teacher']->identity_number ?: 'NIK belum tersedia' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-sm text-slate-600">
                                    {{ $recap['branch']->name ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="font-semibold text-emerald-600">
                                        {{ $recap['present'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="font-semibold text-amber-600">
                                        {{ $recap['permission'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="font-semibold text-sky-600">
                                        {{ $recap['sick'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="font-semibold text-rose-600">
                                        {{ $recap['absent'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="font-semibold text-slate-900">
                                        {{ $recap['total'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center">
                                    <div class="text-sm font-medium text-slate-900">
                                        Belum ada data rekap absensi.
                                    </div>

                                    <div class="mt-1 text-sm text-slate-500">
                                        Data akan muncul setelah absensi guru tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <h2 class="text-base font-semibold text-slate-900">Riwayat Absensi Guru</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Detail absensi guru berdasarkan tanggal dan status.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Tanggal
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Guru
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Cabang
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Status
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Keterangan
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($attendances as $attendance)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-700">
                                    {{ $attendance->date->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-medium text-slate-900">
                                        {{ $attendance->teacher->name }}
                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">
                                        {{ $attendance->teacher->identity_number ?: '-' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-sm text-slate-600">
                                    {{ $attendance->branch->name ?? '-' }}
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                        $statusClasses = [
                                            'present' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                            'permission' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                            'sick' => 'bg-sky-50 text-sky-700 ring-sky-600/20',
                                            'absent' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
                                        ];

                                        $statusLabels = [
                                            'present' => 'Hadir',
                                            'permission' => 'Izin',
                                            'sick' => 'Sakit',
                                            'absent' => 'Alpa',
                                        ];
                                    @endphp

                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClasses[$attendance->status] ?? 'bg-slate-50 text-slate-700 ring-slate-600/20' }}">
                                        {{ $statusLabels[$attendance->status] ?? ucfirst($attendance->status) }}
                                    </span>
                                </td>

                                <td class="max-w-xs px-5 py-4 text-sm text-slate-600">
                                    {{ $attendance->notes ?: '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center">
                                    <div class="text-sm font-medium text-slate-900">
                                        Belum ada riwayat absensi guru.
                                    </div>

                                    <div class="mt-1 text-sm text-slate-500">
                                        Belum terdapat data yang sesuai dengan filter.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($attendances->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">
                    {{ $attendances->links() }}
                </div>
            @endif
        </div>
    </div>
</x-super-admin-layout>