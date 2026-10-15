<x-super-admin-layout title="Detail Guru">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('super-admin.teachers.index') }}" class="transition hover:text-blue-600">
                        Manajemen Guru
                    </a>
                    <span>/</span>
                    <span>Detail</span>
                </div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                Detail Guru
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap guru dan keterkaitannya dengan sistem.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('super-admin.teachers.edit', $teacher) }}"
               class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                Edit Guru
            </a>

            <a href="{{ route('super-admin.teachers.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Kembali
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-6">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-lg font-bold text-blue-600">
                        {{ strtoupper(substr($teacher->name, 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold text-slate-900">
                            {{ $teacher->name }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $teacher->identity_number ?: 'Nomor identitas belum diisi' }}
                        </p>
                    </div>
                </div>

                <span class="inline-flex w-fit items-center rounded-full px-3 py-1.5 text-xs font-semibold
                    {{ $teacher->status === 'active'
                        ? 'bg-emerald-50 text-emerald-700'
                        : 'bg-slate-100 text-slate-600' }}">
                    {{ $teacher->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>

        <div class="grid gap-4 p-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Cabang
                </p>
                <p class="mt-2 text-sm font-semibold text-slate-900">
                    {{ $teacher->branch?->name ?? '-' }}
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Jenis Kelamin
                </p>
                <p class="mt-2 text-sm font-semibold text-slate-900">
                    {{ $teacher->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Nomor Telepon
                </p>
                <p class="mt-2 text-sm font-semibold text-slate-900">
                    {{ $teacher->phone ?: '-' }}
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Jadwal
                </p>
                <p class="mt-2 text-sm font-semibold text-slate-900">
                    {{ $teacher->schedules->count() }} Jadwal
                </p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Informasi Pribadi
                </h2>
            </div>

            <div class="space-y-5 p-6">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Alamat
                    </p>
                    <p class="mt-2 text-sm leading-6 text-slate-700">
                        {{ $teacher->address ?: 'Alamat belum diisi.' }}
                    </p>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Dibuat
                        </p>
                        <p class="mt-2 text-sm font-medium text-slate-800">
                            {{ $teacher->created_at?->format('d M Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Terakhir Diperbarui
                        </p>
                        <p class="mt-2 text-sm font-medium text-slate-800">
                            {{ $teacher->updated_at?->format('d M Y, H:i') ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Akun Sistem
                </h2>
            </div>

            <div class="p-6">
                @if ($teacher->user)
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 font-semibold text-blue-600">
                            {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-slate-900">
                                {{ $teacher->user->name }}
                            </p>
                            <p class="truncate text-xs text-slate-500">
                                {{ $teacher->user->email }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 rounded-xl bg-emerald-50 px-4 py-3">
                        <p class="text-xs font-semibold text-emerald-700">
                            Akun Guru Terhubung
                        </p>
                        <p class="mt-1 text-xs leading-5 text-emerald-600">
                            Guru ini sudah memiliki akun untuk mengakses sistem.
                        </p>
                    </div>
                @else
                    <div class="rounded-xl bg-slate-50 px-4 py-4">
                        <p class="text-sm font-semibold text-slate-700">
                            Belum memiliki akun
                        </p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            Guru ini belum terhubung dengan akun pengguna.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">
                        Jadwal Mengajar
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Daftar jadwal yang terkait dengan guru ini.
                    </p>
                </div>

                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    {{ $teacher->schedules->count() }} Jadwal
                </span>
            </div>
        </div>

        @if ($teacher->schedules->isNotEmpty())
            <div class="divide-y divide-slate-100">
                @foreach ($teacher->schedules as $schedule)
                    <div class="flex flex-col gap-2 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $schedule->classRoom?->name ?? 'Kelas' }}
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                {{ $schedule->day ?? '-' }}
                                @if ($schedule->start_time && $schedule->end_time)
                                    · {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                @endif
                            </p>
                        </div>

                        <span class="text-xs font-medium text-slate-400">
                            {{ $schedule->classRoom?->code ?? '-' }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="px-6 py-10 text-center">
                <p class="text-sm font-medium text-slate-600">
                    Belum ada jadwal mengajar.
                </p>
                <p class="mt-1 text-xs text-slate-400">
                    Jadwal yang terkait dengan guru akan tampil di sini.
                </p>
            </div>
        @endif
    </div>

    <div class="flex justify-end">
        <form method="POST"
              action="{{ route('super-admin.teachers.destroy', $teacher) }}"
              onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-50">
                Hapus Guru
            </button>
        </form>
    </div>
</div>

</x-super-admin-layout>
