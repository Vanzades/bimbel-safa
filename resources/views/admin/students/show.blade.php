<x-admin-layout>
    <x-slot name="title">Detail Siswa</x-slot>
    @php
    $isActive = $student->status === 'active';
    $statusBadge = $isActive ? 'bg-emerald-100/80 dark:bg-emerald-500/20' : 'bg-red-100/80 dark:bg-red-500/20';
    $label = 'mb-1.5 block text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
    $infoBox = 'min-w-0 rounded-xl border p-3 sm:p-3.5';
    $infoBoxStyle = 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);';
    $value = 'wrap-break-word text-xs font-medium leading-relaxed sm:text-sm';
    $programs = $student->relationLoaded('programs') ? $student->programs : $student->programs()->get();
    @endphp
    <div class="-mt-3 min-h-screen pb-4 pt-0 transition-colors duration-150 lg:-mt-4 lg:pb-6" style="background-color:var(--admin-bg);color:var(--admin-text)">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <nav class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs" style="color:var(--admin-muted)" aria-label="Breadcrumb">
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a><svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                </svg>
                <a href="{{ route('admin.students.index') }}" class="hover:opacity-85">Siswa</a><svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                </svg><span class="font-semibold" style="color:var(--admin-text)">Detail Siswa</span>
            </nav>
            <div class="mb-5 mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">Detail Siswa</h1>
                    <p class="mt-1 text-xs sm:text-sm" style="color:var(--admin-muted)">Informasi data pribadi dan akademik siswa.</p>
                </div>
                <a href="{{ route('admin.students.index') }}" class="inline-flex h-9 items-center justify-center gap-2 rounded-lg border px-3 text-xs font-semibold transition-colors sm:text-[13px]" style="background-color:var(--admin-surface);border-color:var(--admin-border);color:var(--admin-text)" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='var(--admin-surface)'"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7-7-7 7-7" />
                    </svg>Kembali</a>
            </div>
            <div class="overflow-hidden rounded-2xl shadow-sm" style="border:1px solid var(--admin-border);background-color:var(--admin-surface);box-shadow:0 4px 20px var(--admin-shadow)">
                <div class="flex flex-col justify-between gap-3 border-b p-4 sm:flex-row sm:items-center sm:p-5" style="border-color:var(--admin-border)">
                    <div class="min-w-0">
                        <h2 class="wrap-break-word text-sm font-bold tracking-tight sm:text-base" style="color:var(--admin-text)">{{ $student->name }}</h2>
                        <p class="mt-1 text-[11px] sm:text-xs" style="color:var(--admin-muted)">Data siswa <span class="font-semibold" style="color:var(--admin-text)">#{{ $student->id }}</span></p>
                    </div>
                    <span class="inline-flex w-fit shrink-0 items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-semibold {{ $statusBadge }} sm:text-[13px]" style="color:var(--admin-text)"><span class="h-1.5 w-1.5 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-red-500' }}"></span>{{ $isActive ? 'Aktif' : 'Tidak Aktif' }}</span>
                </div>
                <div class="space-y-5 p-4 sm:p-5">
                    <section>
                        <div class="mb-3 flex items-center gap-2.5"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg" style="background-color:var(--admin-surface-soft);color:var(--admin-icon)"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM17 8h4m-2-2v4" />
                                </svg></span>
                            <h3 class="text-sm font-bold sm:text-base" style="color:var(--admin-text)">Informasi Siswa</h3>
                        </div>
                        <div class="grid min-w-0 grid-cols-1 gap-2.5 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Nama Lengkap</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->name }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Kelas Utama</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->classRoom?->name ?? '-' }} @if($student->classRoom?->code)<span class="text-[11px] font-normal" style="color:var(--admin-muted)">({{ $student->classRoom->code }})</span>@endif</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Program Bimbingan</span>
                                @if($programs->isNotEmpty())<div class="flex flex-wrap gap-1.5">@foreach($programs as $program)<span class="inline-flex max-w-full items-center rounded-md border px-2 py-1 text-xs font-medium" style="border-color:var(--admin-border);background-color:var(--admin-surface);color:var(--admin-text)">{{ $program->name }}</span>@endforeach</div>@else<p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->program?->name ?? '-' }}</p>@endif
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Jenis Kelamin</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->gender === 'male' ? 'Laki-laki' : ($student->gender === 'female' ? 'Perempuan' : '-') }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Tempat, Tanggal Lahir</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->birth_place ?: '-' }}{{ $student->birth_date ? ', '.$student->birth_date->format('d F Y') : '' }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Nomor Telepon</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->phone ?: 'Belum tersedia' }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Email</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->email ?: 'Belum tersedia' }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Status Akun</span><span class="inline-flex rounded-md px-2 py-1 text-xs font-semibold {{ $statusBadge }}" style="color:var(--admin-text)">{{ $isActive ? 'Aktif' : 'Tidak Aktif' }}</span></div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Status Pendaftaran</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ match($student->registration_status){'approved'=>'Disetujui','pending'=>'Menunggu','rejected'=>'Ditolak',default=>'-'} }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Data Dibuat</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->created_at?->format('d F Y, H:i') ?? '-' }}</p>
                            </div>
                            <div class="{{ $infoBox }} sm:col-span-2 lg:col-span-3" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Alamat Lengkap</span>
                                <p class="wrap-break-word whitespace-pre-line text-xs font-medium leading-relaxed sm:text-sm" style="color:var(--admin-text)">{{ $student->address ?: 'Belum tersedia' }}</p>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="mb-3 flex items-center gap-2.5"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg" style="background-color:var(--admin-surface-soft);color:var(--admin-icon)"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg></span>
                            <h3 class="text-sm font-bold sm:text-base" style="color:var(--admin-text)">Informasi Orang Tua / Wali</h3>
                        </div>
                        <div class="grid min-w-0 grid-cols-1 gap-2.5 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Nama Orang Tua / Wali</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->parent_name ?: 'Belum tersedia' }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Nomor Telepon Orang Tua</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->parent_phone ?: 'Belum tersedia' }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Pekerjaan Orang Tua</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->parent_occupation ?: 'Belum tersedia' }}</p>
                            </div>
                            <div class="{{ $infoBox }} sm:col-span-2 lg:col-span-3" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Alamat Orang Tua / Wali</span>
                                <p class="wrap-break-word whitespace-pre-line text-xs font-medium leading-relaxed sm:text-sm" style="color:var(--admin-text)">{{ $student->parent_address ?: 'Belum tersedia' }}</p>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="mb-3 flex items-center gap-2.5"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg" style="background-color:var(--admin-surface-soft);color:var(--admin-icon)"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                </svg></span>
                            <h3 class="text-sm font-bold sm:text-base" style="color:var(--admin-text)">Informasi Tambahan</h3>
                        </div>
                        <div class="grid min-w-0 grid-cols-1 gap-2.5 sm:grid-cols-2">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Bimbingan Sebelumnya</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->previous_tutoring === '1' || $student->previous_tutoring === 1 ? 'Ya' : ($student->previous_tutoring === '0' || $student->previous_tutoring === 0 ? 'Tidak' : ($student->previous_tutoring ?: 'Belum tersedia')) }}</p>
                            </div>
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Kebutuhan Khusus</span>
                                <p class="{{ $value }}" style="color:var(--admin-text)">{{ $student->special_needs === '1' || $student->special_needs === 1 ? 'Ya' : ($student->special_needs === '0' || $student->special_needs === 0 ? 'Tidak' : ($student->special_needs ?: 'Tidak ada informasi')) }}</p>
                            </div>
                            <div class="{{ $infoBox }} sm:col-span-2" style="{{ $infoBoxStyle }}"><span class="{{ $label }}" style="color:var(--admin-muted)">Catatan</span>
                                <p class="wrap-break-word whitespace-pre-line text-xs font-medium leading-relaxed sm:text-sm" style="color:var(--admin-text)">{{ $student->notes ?: 'Tidak ada catatan' }}</p>
                            </div>
                        </div>
                    </section>
                </div>
                @if($student->registration_status === 'approved' && $student->user_id)
                <section class="mx-4 mb-4 rounded-xl border p-4 sm:mx-5 sm:p-5" style="border-color:var(--admin-border);background-color:var(--admin-surface)">
                    <div class="mb-3 flex items-start gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 8V6a4 4 0 1 1 8 0v2" />
                            </svg></div>
                        <div>
                            <h3 class="text-sm font-bold sm:text-base" style="color:var(--admin-text)">Informasi Akun & WhatsApp</h3>
                            <p class="mt-1 text-xs" style="color:var(--admin-muted)">Tentukan password awal siswa sebelum menyiapkan pesan WhatsApp.</p>
                        </div>
                    </div>
                    <div class="mb-3 rounded-lg border border-amber-200 bg-amber-50 p-3">
                        <p class="text-xs leading-5 text-amber-800">Password yang kamu tentukan akan menggantikan password akun saat ini. Pastikan password benar sebelum melanjutkan. Pesan WhatsApp akan berisi password tersebut.</p>
                    </div>
                    <div class="mb-3"><label for="account-email" class="mb-1.5 block text-xs font-semibold" style="color:var(--admin-muted)">Email Siswa</label><input id="account-email" type="email" value="{{ $student->user?->email }}" readonly class="block w-full rounded-lg border px-3 py-2.5 text-sm" style="border-color:var(--admin-border);background-color:var(--admin-surface-soft);color:var(--admin-muted)"></div>
                    <form method="POST" action="{{ route('admin.students.whatsapp-credentials', $student) }}" class="space-y-3" onsubmit="return confirm('Password akun akan diganti dan pesan WhatsApp akan disiapkan. Lanjutkan?')">
                        @csrf
                        <div><label for="password" class="mb-1.5 block text-xs font-semibold" style="color:var(--admin-muted)">Password Awal</label><input id="password" name="password" type="password" minlength="10" maxlength="72" autocomplete="new-password" required placeholder="Masukkan password awal" class="block w-full rounded-lg border px-3 py-2.5 text-sm outline-none focus:border-blue-500 @error('password') border-red-400 @enderror" style="border-color:var(--admin-border);background-color:var(--admin-surface);color:var(--admin-text)">@error('password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                        <div><label for="password_confirmation" class="mb-1.5 block text-xs font-semibold" style="color:var(--admin-muted)">Konfirmasi Password Awal</label><input id="password_confirmation" name="password_confirmation" type="password" minlength="10" maxlength="72" autocomplete="new-password" required placeholder="Ulangi password awal" class="block w-full rounded-lg border px-3 py-2.5 text-sm outline-none focus:border-blue-500" style="border-color:var(--admin-border);background-color:var(--admin-surface);color:var(--admin-text)"></div>
                        @error('account')<p class="text-xs font-medium text-red-600">{{ $message }}</p>@enderror @error('phone')<p class="text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                        <button type="submit" class="inline-flex min-h-10 w-full items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 sm:w-auto"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M20.52 3.48A11.82 11.82 0 0 0 12.08 0C5.52 0 .18 5.34.18 11.9c0 2.1.55 4.16 1.6 5.98L.08 24l6.27-1.64a11.9 11.9 0 0 0 5.72 1.46h.01c6.56 0 11.9-5.34 11.9-11.9a11.82 11.82 0 0 0-3.46-8.44ZM12.08 21.8a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-3.72.97.99-3.62-.23-.37a9.86 9.86 0 0 1-1.52-5.29c0-5.46 4.44-9.9 9.9-9.9a9.83 9.83 0 0 1 7 2.9 9.83 9.83 0 0 1 2.9 7c-.02 5.46-4.46 9.9-9.92 9.9Zm5.43-7.41c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.21 5.09 4.5.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2.01-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35Z" />
                            </svg>Simpan Password & Buka WhatsApp</button>
                    </form>
                </section>
                @endif
                <div class="flex flex-col-reverse gap-2 border-t p-4 sm:flex-row sm:items-center sm:justify-end sm:p-5" style="border-color:var(--admin-border);background-color:var(--admin-surface-soft)">
                    <a href="{{ route('admin.students.index') }}" class="inline-flex h-9 items-center justify-center rounded-lg border px-4 text-xs font-semibold transition-colors sm:text-[13px]" style="border-color:var(--admin-border);color:var(--admin-text);background-color:var(--admin-surface)" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='var(--admin-surface)'"><span>Kembali ke Daftar</span></a>
                    <a href="{{ route('admin.students.edit', $student) }}" class="inline-flex h-9 items-center justify-center gap-2 rounded-lg px-4 text-xs font-semibold text-white transition-opacity hover:brightness-110 sm:text-[13px]" style="background-color:#2563EB;box-shadow:0 3px 8px rgba(37,99,235,.25)"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                        </svg>Edit Siswa</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>