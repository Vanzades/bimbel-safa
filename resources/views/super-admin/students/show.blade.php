
<x-super-admin-layout title="Detail Siswa">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('super-admin.dashboard') }}" class="transition hover:text-blue-600">Super Admin</a>
                    <span>/</span>
                    <a href="{{ route('super-admin.students.index') }}" class="transition hover:text-blue-600">Manajemen Siswa</a>
                    <span>/</span>
                    <span class="text-slate-700">Detail Siswa</span>
                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                    Detail Siswa
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Informasi lengkap siswa yang terdaftar di Bimbel Safa.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a
                    href="{{ route('super-admin.students.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    Kembali
                </a>

                <a
                    href="{{ route('super-admin.students.edit', $student) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L9 17l-4 1 1-4Z"/>
                    </svg>
                    Edit Data
                </a>
            </div>
        </div>

        @php
            $formatDate = function ($date) {
                return $date ? \Illuminate\Support\Carbon::parse($date)->translatedFormat('d F Y') : '-';
            };

            $genderLabel = match ($student->gender) {
                'male' => 'Laki-laki',
                'female' => 'Perempuan',
                default => '-',
            };

            $statusLabel = $student->status === 'active' ? 'Aktif' : 'Nonaktif';
            $attendances = $student->attendances ?? collect();
            $attendanceCount = $attendances->count();
        @endphp

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="bg-gradient-to-r from-blue-700 to-blue-600 px-5 py-6 sm:px-7 sm:py-8">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl border border-white/20 bg-white/15 text-3xl font-bold text-white shadow-sm">
                        {{ strtoupper(mb_substr($student->name ?? 'S', 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <h2 class="text-xl font-semibold text-white sm:text-2xl">
                            {{ $student->name }}
                        </h2>
                        <p class="mt-1 text-sm text-blue-100">
                            {{ $student->program?->name ?? 'Program belum ditentukan' }}
                            <span class="px-1">·</span>
                            {{ $student->classRoom?->name ?? 'Kelas belum ditentukan' }}
                        </p>
                        <p class="mt-2 text-sm text-blue-100">
                            {{ $student->branch?->name ?? 'Cabang belum ditentukan' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white px-3 py-1.5 text-xs font-semibold {{ $student->status === 'active' ? 'text-emerald-700' : 'text-slate-600' }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $student->status === 'active' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                            {{ $statusLabel }}
                        </span>

                        <span class="inline-flex items-center rounded-full border border-white/25 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white">
                            {{ $student->user ? 'Akun Terhubung' : 'Belum Ada Akun' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 divide-y divide-slate-100 sm:grid-cols-3 sm:divide-x sm:divide-y-0">
                <div class="p-5 sm:px-6">
                    <p class="text-sm text-slate-500">Nomor Identitas</p>
                    <p class="mt-2 break-words text-sm font-semibold text-slate-900">
                        {{ $student->identity_number ?: 'Belum diisi' }}
                    </p>
                </div>

                <div class="p-5 sm:px-6">
                    <p class="text-sm text-slate-500">Tanggal Lahir</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        {{ $student->birth_date ? $formatDate($student->birth_date) : 'Belum diisi' }}
                    </p>
                </div>

                <div class="p-5 sm:px-6">
                    <p class="text-sm text-slate-500">Tanggal Terdaftar</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        {{ $student->created_at ? $formatDate($student->created_at) : '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900">Data Pribadi</h2>
                        <p class="text-sm text-slate-500">Identitas dan informasi kontak siswa</p>
                    </div>
                </div>

                <dl class="divide-y divide-slate-100 px-5 sm:px-6">
                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Nama Lengkap</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->name ?: '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Nomor Identitas</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->identity_number ?: '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Jenis Kelamin</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">{{ $genderLabel }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Tempat Lahir</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->birth_place ?: '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Tanggal Lahir</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->birth_date ? $formatDate($student->birth_date) : '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Email</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">
                            @if ($student->email)
                                <a href="mailto:{{ $student->email }}" class="text-blue-600 hover:underline">{{ $student->email }}</a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Nomor Telepon</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">
                            @if ($student->phone)
                                <a href="tel:{{ $student->phone }}" class="text-blue-600 hover:underline">{{ $student->phone }}</a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Alamat</dt>
                        <dd class="whitespace-pre-line break-words text-sm leading-6 text-slate-800 sm:col-span-2">{{ $student->address ?: '-' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M20 8v6M17 11h6"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900">Data Orang Tua / Wali</h2>
                        <p class="text-sm text-slate-500">Informasi penanggung jawab siswa</p>
                    </div>
                </div>

                <dl class="divide-y divide-slate-100 px-5 sm:px-6">
                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Nama Orang Tua / Wali</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->parent_name ?: '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Nomor Telepon</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">
                            @if ($student->parent_phone)
                                <a href="tel:{{ $student->parent_phone }}" class="text-blue-600 hover:underline">{{ $student->parent_phone }}</a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Pekerjaan</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->parent_occupation ?: '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Alamat Orang Tua / Wali</dt>
                        <dd class="whitespace-pre-line break-words text-sm leading-6 text-slate-800 sm:col-span-2">{{ $student->parent_address ?: '-' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                            <path d="M8 7h8M8 11h8"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900">Informasi Akademik</h2>
                        <p class="text-sm text-slate-500">Program, kelas, cabang, dan jadwal</p>
                    </div>
                </div>

                <dl class="divide-y divide-slate-100 px-5 sm:px-6">
                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Cabang</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->branch?->name ?? '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Program</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->program?->name ?? '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Kelas</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->classRoom?->name ?? '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Kode Kelas</dt>
                        <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->classRoom?->code ?? '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Jadwal Belajar</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">
                            @if ($student->schedules->isNotEmpty())
                                <div class="space-y-3">
                                    @foreach ($student->schedules as $schedule)
                                        <div class="rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-3">
                                            <p class="font-semibold text-slate-800">
                                                {{ $schedule->name ?? 'Jadwal Belajar' }}
                                            </p>
                                            @if ($schedule->day ?? false)
                                                <p class="mt-1 text-xs text-slate-500">{{ $schedule->day }}</p>
                                            @endif
                                            @if ($schedule->start_time ?? false)
                                                <p class="mt-1 text-xs text-slate-500">
                                                    {{ $schedule->start_time }}{{ $schedule->end_time ? ' – '.$schedule->end_time : '' }}
                                                </p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="font-normal text-slate-500">Belum ada jadwal yang terhubung.</span>
                            @endif
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Riwayat Bimbel Sebelumnya</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">
                            {{ $student->previous_tutoring ? 'Pernah mengikuti bimbel' : 'Belum pernah / tidak diisi' }}
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Kebutuhan Khusus</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">
                            {{ $student->special_needs ? 'Ada kebutuhan khusus' : 'Tidak ada / tidak diisi' }}
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Catatan</dt>
                        <dd class="whitespace-pre-line break-words text-sm leading-6 text-slate-800 sm:col-span-2">{{ $student->notes ?: '-' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="16" rx="3"/>
                            <circle cx="9" cy="10" r="2.5"/>
                            <path d="M5.5 16a3.5 3.5 0 0 1 7 0M15 9h3M15 13h3"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900">Informasi Akun</h2>
                        <p class="text-sm text-slate-500">Status hubungan data siswa dengan akun login</p>
                    </div>
                </div>

                <dl class="divide-y divide-slate-100 px-5 sm:px-6">
                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Status Siswa</dt>
                        <dd class="sm:col-span-2">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $student->status === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $statusLabel }}
                            </span>
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Status Pendaftaran</dt>
                        <dd class="sm:col-span-2">
                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                {{ ucfirst($student->registration_status ?? 'approved') }}
                            </span>
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Akun Pengguna</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">
                            {{ $student->user ? 'Sudah terhubung dengan akun' : 'Belum terhubung dengan akun' }}
                        </dd>
                    </div>

                    @if ($student->user)
                        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm text-slate-500">Email Akun</dt>
                            <dd class="break-words text-sm font-medium text-slate-800 sm:col-span-2">
                                {{ $student->user->email ?: '-' }}
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm text-slate-500">Status Akun</dt>
                            <dd class="text-sm font-medium text-slate-800 sm:col-span-2">
                                {{ $student->user->status ?? 'Tidak tersedia' }}
                            </dd>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Dibuat Pada</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->created_at ? $formatDate($student->created_at) : '-' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm text-slate-500">Terakhir Diperbarui</dt>
                        <dd class="text-sm font-medium text-slate-800 sm:col-span-2">{{ $student->updated_at ? $formatDate($student->updated_at) : '-' }}</dd>
                    </div>
                </dl>
            </section>
        </div>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Riwayat Kehadiran</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Riwayat absensi yang tercatat untuk siswa ini.
                    </p>
                </div>

                <span class="inline-flex w-fit items-center rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                    {{ number_format($attendanceCount, 0, ',', '.') }} catatan
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="whitespace-nowrap px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-6">Tanggal</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Jadwal</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                            <th scope="col" class="whitespace-nowrap px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($attendances->sortByDesc('created_at')->take(10) as $attendance)
                            <tr class="hover:bg-slate-50/70">
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-700 sm:px-6">
                                    {{ $attendance->created_at ? $formatDate($attendance->created_at) : '-' }}
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-700">
                                    {{ $attendance->schedule?->name ?? '-' }}
                                </td>
                                <td class="px-5 py-4">
                                    @php
                                        $attendanceStatus = strtolower((string) ($attendance->status ?? ''));
                                        $attendanceLabel = match ($attendanceStatus) {
                                            'present', 'hadir' => 'Hadir',
                                            'late', 'terlambat' => 'Terlambat',
                                            'sick', 'izin_sakit' => 'Sakit',
                                            'permission', 'izin' => 'Izin',
                                            'absent', 'alpha', 'alpa' => 'Tidak Hadir',
                                            default => $attendance->status ?: 'Belum diisi',
                                        };

                                        $attendanceClass = match ($attendanceStatus) {
                                            'present', 'hadir' => 'bg-emerald-50 text-emerald-700',
                                            'late', 'terlambat' => 'bg-amber-50 text-amber-700',
                                            'sick', 'izin_sakit', 'permission', 'izin' => 'bg-blue-50 text-blue-700',
                                            'absent', 'alpha', 'alpa' => 'bg-red-50 text-red-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };
                                    @endphp

                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $attendanceClass }}">
                                        {{ $attendanceLabel }}
                                    </span>
                                </td>
                                <td class="max-w-xs whitespace-pre-line break-words px-5 py-4 text-sm text-slate-600">
                                    {{ $attendance->notes ?? $attendance->description ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <p class="text-sm font-semibold text-slate-700">Belum ada riwayat kehadiran</p>
                                    <p class="mt-1 text-sm text-slate-500">Data absensi siswa akan ditampilkan setelah tersedia.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($attendanceCount > 10)
                <div class="border-t border-slate-100 px-5 py-3 sm:px-6">
                    <p class="text-xs text-slate-500">
                        Menampilkan 10 catatan kehadiran terbaru.
                    </p>
                </div>
            @endif
        </section>

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-between">
            <a
                href="{{ route('super-admin.students.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
            >
                Kembali ke Daftar Siswa
            </a>

            <a
                href="{{ route('super-admin.students.edit', $student) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L9 17l-4 1 1-4Z"/>
                </svg>
                Edit Data Siswa
            </a>
        </div>
    </div>
</x-super-admin-layout>
