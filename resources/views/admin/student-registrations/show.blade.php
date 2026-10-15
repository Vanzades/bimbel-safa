<x-admin-layout>
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('admin.student-registrations.index') }}" class="transition hover:text-blue-600">
                        Pendaftaran Siswa
                    </a>
                    <span>/</span>
                    <span class="text-slate-700">Detail</span>
                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                    Detail Pendaftaran
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Periksa data pendaftaran dan kelola proses penerimaan siswa.
                </p>
            </div>

            <a href="{{ route('admin.student-registrations.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5" />
                    <path d="m12 19-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        @if (session('success'))
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">
            <div class="space-y-6">
                <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <div class="flex items-start justify-between gap-4 border-b border-slate-200 px-6 py-5">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900">Data Siswa</h2>
                            <p class="mt-1 text-sm text-slate-500">Informasi pribadi siswa.</p>
                        </div>

                        @if ($student->registration_status === 'approved')
                        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700">
                            Disetujui
                        </span>
                        @elseif ($student->registration_status === 'rejected')
                        <span class="inline-flex rounded-full bg-red-50 px-3 py-1 text-xs font-medium text-red-700">
                            Ditolak
                        </span>
                        @else
                        <span class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-amber-700">
                            Menunggu Pemeriksaan
                        </span>
                        @endif
                    </div>

                    <div class="grid gap-x-8 gap-y-5 px-6 py-6 sm:grid-cols-2">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Nama Lengkap</p>
                            <p class="mt-1 text-sm font-medium text-slate-900">{{ $student->name }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Jenis Kelamin</p>
                            <p class="mt-1 text-sm text-slate-700">
                                {{ $student->gender === 'male' ? 'Laki-laki' : ($student->gender === 'female' ? 'Perempuan' : '-') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Tempat, Tanggal Lahir</p>
                            <p class="mt-1 text-sm text-slate-700">
                                {{ $student->birth_place ?: '-' }},
                                {{ $student->birth_date?->translatedFormat('d F Y') ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Nomor HP / WhatsApp</p>
                            <p class="mt-1 text-sm text-slate-700">{{ $student->phone ?: '-' }}</p>
                        </div>

                        <div class="sm:col-span-2">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Alamat Lengkap</p>
                            <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                                {{ $student->address ?: '-' }}
                            </p>
                        </div>
                    </div>
                </section>

                <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-base font-semibold text-slate-900">Data Orang Tua / Wali</h2>
                        <p class="mt-1 text-sm text-slate-500">Informasi orang tua atau wali siswa.</p>
                    </div>

                    <div class="grid gap-x-8 gap-y-5 px-6 py-6 sm:grid-cols-2">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Nama Lengkap</p>
                            <p class="mt-1 text-sm font-medium text-slate-900">{{ $student->parent_name ?: '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Nomor HP / WhatsApp</p>
                            <p class="mt-1 text-sm text-slate-700">{{ $student->parent_phone ?: '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Pekerjaan</p>
                            <p class="mt-1 text-sm text-slate-700">{{ $student->parent_occupation ?: '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Email Siswa</p>
                            <p class="mt-1 break-all text-sm text-slate-700">{{ $student->email ?: '-' }}</p>
                        </div>

                        <div class="sm:col-span-2">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Alamat Orang Tua / Wali</p>
                            <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                                {{ $student->parent_address ?: 'Sama dengan alamat siswa.' }}
                            </p>
                        </div>
                    </div>
                </section>

                <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-base font-semibold text-slate-900">Program dan Jadwal</h2>
                        <p class="mt-1 text-sm text-slate-500">Program bimbingan belajar dan jadwal yang dipilih.</p>
                    </div>

                    <div class="grid gap-x-8 gap-y-5 px-6 py-6 sm:grid-cols-2">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Program Bimbingan</p>
                            <div class="mt-1 flex flex-wrap gap-1.5">
                                @forelse ($student->programs as $program)
                                <span class="inline-flex rounded-md bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">{{ $program->name }}</span>
                                @empty
                                <span class="text-sm text-slate-500">Belum ada program</span>
                                @endforelse
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Kelas</p>
                            <p class="mt-1 text-sm text-slate-700">{{ $student->classRoom?->name ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Cabang</p>
                            <p class="mt-1 text-sm text-slate-700">{{ $student->branch?->name ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Kode Kelas</p>
                            <p class="mt-1 text-sm text-slate-700">{{ $student->classRoom?->code ?? '-' }}</p>
                        </div>

                        <div class="sm:col-span-2">
                            <p class="mb-3 text-xs font-medium uppercase tracking-wide text-slate-400">Jadwal Dipilih</p>

                            <div class="space-y-3">
                                @forelse ($student->schedules as $schedule)
                                <div class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">
                                                {{ ucfirst($schedule->day) }}
                                                · {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-500">
                                                {{ $schedule->subject ?: 'Mata pelajaran belum ditentukan' }}
                                                @if ($schedule->room)
                                                · Ruang {{ $schedule->room }}
                                                @endif
                                            </p>
                                        </div>

                                        @if ($schedule->teacher)
                                        <span class="text-xs font-medium text-slate-600">{{ $schedule->teacher->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="rounded-lg border border-dashed border-slate-200 px-4 py-4 text-sm text-slate-500">
                                    Jadwal belum tersedia.
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-base font-semibold text-slate-900">Informasi Tambahan</h2>
                        <p class="mt-1 text-sm text-slate-500">Informasi tambahan dari formulir pendaftaran.</p>
                    </div>

                    <div class="grid gap-x-8 gap-y-5 px-6 py-6 sm:grid-cols-2">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Pernah Mengikuti Bimbel</p>
                            <div class="mt-2">
                                @if ($student->previous_tutoring)
                                <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700">Ya</span>
                                @else
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">Tidak</span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Kebutuhan Khusus</p>
                            <div class="mt-2">
                                @if ($student->special_needs)
                                <span class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-amber-700">Ya</span>
                                @else
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">Tidak</span>
                                @endif
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Keterangan</p>
                            <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                                {{ $student->notes ?: 'Tidak ada keterangan tambahan.' }}
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <aside class="space-y-6">
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-slate-900">Tindakan</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500">
                        Tindakan yang tersedia mengikuti status pendaftaran siswa.
                    </p>

                    <div class="mt-5 space-y-3">
                        @if ($student->registration_status === 'pending')
                        <form action="{{ route('admin.student-registrations.approve', $student) }}" method="POST">
                            @csrf
                            <button type="submit"
                                onclick="return confirm('Setujui pendaftaran siswa ini?')"
                                class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                                Setujui Pendaftaran
                            </button>
                        </form>

                        <button type="button"
                            onclick="document.getElementById('reject-modal').classList.remove('hidden'); document.getElementById('reject-modal').classList.add('flex')"
                            class="flex w-full items-center justify-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                            Tolak Pendaftaran
                        </button>
                        @elseif ($student->registration_status === 'approved' && $student->user_id)
                        <a href="{{ route('admin.students.show', $student) }}" class="flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M20.52 3.48A11.86 11.86 0 0 0 12.06 0C5.5 0 .16 5.34.16 11.9c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.65a11.9 11.9 0 0 0 5.76 1.47h.01c6.56 0 11.9-5.34 11.9-11.9 0-3.18-1.24-6.17-3.45-8.44ZM12.06 21.8h-.01a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.86 9.86 0 0 1-1.52-5.26c0-5.46 4.45-9.9 9.92-9.9a9.84 9.84 0 0 1 7.01 2.91 9.84 9.84 0 0 1 2.9 7.01c0 5.47-4.45 9.88-9.92 9.88Z" />
                            </svg>
                            Buka Detail Siswa & WhatsApp
                        </a>
                        @elseif ($student->registration_status === 'rejected')
                        <p class="rounded-lg bg-red-50 px-3 py-3 text-sm text-red-700">
                            Pendaftaran ini telah ditolak.
                        </p>
                        @endif
                    </div>
                </section>

                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-slate-900">Status Pendaftaran</h2>

                    <div class="mt-4 flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg
                            {{ $student->registration_status === 'approved' ? 'bg-emerald-50 text-emerald-600' : ($student->registration_status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600') }}">
                            @if ($student->registration_status === 'approved')
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m5 12 4 4L19 6" />
                            </svg>
                            @elseif ($student->registration_status === 'rejected')
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                            @else
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M12 7v5l3 2" />
                            </svg>
                            @endif
                        </span>

                        <div>
                            <p class="text-sm font-semibold text-slate-900">
                                @if ($student->registration_status === 'approved')
                                Pendaftaran Disetujui
                                @elseif ($student->registration_status === 'rejected')
                                Pendaftaran Ditolak
                                @else
                                Menunggu Pemeriksaan
                                @endif
                            </p>

                            <p class="text-xs text-slate-500">
                                @if ($student->registration_status === 'approved')
                                Akun siswa telah dibuat.
                                @elseif ($student->registration_status === 'rejected')
                                Pendaftaran tidak disetujui.
                                @else
                                Pendaftaran belum diproses.
                                @endif
                            </p>
                        </div>
                    </div>
                </section>

                <section class="rounded-xl border border-blue-100 bg-blue-50 p-5">
                    <div class="flex gap-3">
                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M12 16v-4" />
                                <path d="M12 8h.01" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-blue-900">Informasi Akun Siswa</p>
                            <p class="mt-1 text-xs leading-5 text-blue-700">
                                Setelah pendaftaran disetujui, akun siswa dibuat menggunakan email terdaftar.
                                Admin dapat membuka WhatsApp untuk mengirim informasi akun dan tautan pengaturan kata sandi.
                                Pesan hanya terkirim setelah admin menekan tombol Kirim di WhatsApp.
                            </p>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>

    @if ($student->registration_status === 'pending')
    <div id="reject-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 px-4"
        onclick="if (event.target === this) { this.classList.add('hidden'); this.classList.remove('flex'); }">
        <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Tolak Pendaftaran</h2>
                    <p class="mt-1 text-sm leading-5 text-slate-500">
                        Berikan alasan penolakan jika diperlukan.
                    </p>
                </div>

                <button type="button"
                    onclick="document.getElementById('reject-modal').classList.add('hidden'); document.getElementById('reject-modal').classList.remove('flex')"
                    class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.student-registrations.reject', $student) }}" method="POST" class="mt-5">
                @csrf

                <label for="rejection_reason" class="text-sm font-medium text-slate-700">
                    Alasan Penolakan
                </label>

                <textarea id="rejection_reason" name="rejection_reason" rows="4"
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Tuliskan alasan penolakan jika ada..."></textarea>

                @error('rejection_reason')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <div class="mt-5 flex justify-end gap-3">
                    <button type="button"
                        onclick="document.getElementById('reject-modal').classList.add('hidden'); document.getElementById('reject-modal').classList.remove('flex')"
                        class="rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </button>

                    <button type="submit"
                        class="rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700">
                        Tolak Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</x-admin-layout>