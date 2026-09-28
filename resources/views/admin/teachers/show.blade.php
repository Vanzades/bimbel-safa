<x-admin-layout>
    <x-slot name="title">
        Detail Guru
    </x-slot>

    {{-- Wrapper utama --}}
    <div class="py-4 lg:py-6 min-h-screen transition-colors duration-150" style="background-color: var(--admin-bg); color: var(--admin-text);">
        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">

            {{-- ====== Breadcrumb ====== --}}
            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3" style="color: var(--admin-muted);">
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('admin.teachers.index') }}" class="hover:opacity-85">Guru</a>
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="font-semibold" style="color: var(--admin-text);">Detail Guru</span>
            </nav>

            {{-- ====== JUDUL HALAMAN ====== --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                        Detail Guru
                    </h1>
                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Informasi lengkap data pribadi dan akun guru.
                    </p>
                </div>>
            </div>

            {{-- ====== CARD UTAMA (Full Width / Panjang) ====== --}}
            <div class="rounded-2xl p-6 sm:p-8 shadow-sm space-y-8" style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                {{-- Header Profile Singkat di dalam Card --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b" style="border-color: var(--admin-border);">
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl text-xl font-bold uppercase" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                            {{ substr($teacher->name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-bold tracking-tight" style="color: var(--admin-text);">
                                {{ $teacher->name }}
                            </h2>
                            <p class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">
                                NIK / Nomor Identitas: <span class="font-medium" style="color: var(--admin-text);">{{ $teacher->identity_number }}</span>
                            </p>
                        </div>
                    </div>

                    <div>
                        @if ($teacher->status === 'active')
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100/80 px-3 py-1.5 text-xs sm:text-sm font-semibold text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs sm:text-sm font-semibold" style="background-color: var(--admin-surface-soft); color: var(--admin-muted); border: 1px solid var(--admin-border);">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Grid Informasi Detail --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="p-4 rounded-xl" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1" style="color: var(--admin-muted);">Nama Lengkap</p>
                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">{{ $teacher->name }}</p>
                    </div>

                    <div class="p-4 rounded-xl" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1" style="color: var(--admin-muted);">NIK / Nomor Identitas</p>
                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">{{ $teacher->identity_number }}</p>
                    </div>

                    <div class="p-4 rounded-xl" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1" style="color: var(--admin-muted);">Jenis Kelamin</p>
                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">{{ $teacher->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>

                    <div class="p-4 rounded-xl" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1" style="color: var(--admin-muted);">Email</p>
                        <p class="text-xs sm:text-sm font-medium break-all" style="color: var(--admin-text);">{{ $teacher->email ?: 'Belum tersedia' }}</p>
                    </div>

                    <div class="p-4 rounded-xl" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1" style="color: var(--admin-muted);">Nomor Telepon</p>
                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">{{ $teacher->phone ?: 'Belum tersedia' }}</p>
                    </div>

                    <div class="p-4 rounded-xl" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1" style="color: var(--admin-muted);">Akun Login</p>
                        @if ($teacher->user)
                            <div class="flex items-center justify-between mt-0.5">
                                <span class="text-xs sm:text-sm font-medium truncate" style="color: var(--admin-text);">{{ $teacher->user->email }}</span>
                                <a href="{{ route('admin.users.show', $teacher->user) }}" class="text-[13px] sm:text-sm font-semibold hover:underline shrink-0 ml-2" style="color: #2563EB;">Lihat →</a>
                            </div>
                        @else
                            <div class="flex items-center justify-between mt-0.5">
                                <span class="text-xs sm:text-sm italic" style="color: var(--admin-muted);">Belum ada akun</span>
                                <a href="{{ route('admin.users.create') }}" class="text-[13px] sm:text-sm font-semibold hover:underline shrink-0 ml-2" style="color: #2563EB;">Buat →</a>
                            </div>
                        @endif
                    </div>

                    <div class="sm:col-span-2 lg:col-span-3 p-4 rounded-xl" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);">
                        <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider mb-1" style="color: var(--admin-muted);">Alamat Lengkap</p>
                        <p class="text-xs sm:text-sm font-medium whitespace-pre-line leading-relaxed" style="color: var(--admin-text);">{{ $teacher->address ?: 'Belum tersedia' }}</p>
                    </div>
                </div>

                {{-- Footer Timestamps --}}
                <div class="pt-4 border-t flex flex-col sm:flex-row items-center justify-between text-[11px] sm:text-xs gap-2" style="border-color: var(--admin-border); color: var(--admin-muted);">
                    <div>Data Dibuat: <span class="font-medium" style="color: var(--admin-text);">{{ $teacher->created_at?->format('d F Y, H:i') }}</span></div>
                    <div>Terakhir Diperbarui: <span class="font-medium" style="color: var(--admin-text);">{{ $teacher->updated_at?->format('d F Y, H:i') }}</span></div>
                </div>

            </div>

        </div>
    </div>
</x-admin-layout>
