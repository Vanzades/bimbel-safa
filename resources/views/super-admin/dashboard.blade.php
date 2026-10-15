@php
    $firstName = \Illuminate\Support\Str::of(auth()->user()?->name ?? 'Super Admin')->before(' ');
    $avatars = [
        'bg-indigo-100 text-indigo-700',
        'bg-sky-100 text-sky-700',
        'bg-emerald-100 text-emerald-700',
        'bg-amber-100 text-amber-700',
        'bg-rose-100 text-rose-700',
    ];
@endphp

<x-super-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="space-y-4 pb-8">

        <section class="relative overflow-hidden rounded-2xl bg-indigo-950 p-4 text-white sm:p-6">
            <div class="pointer-events-none absolute -bottom-32 left-1/3 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -right-20 -top-20 h-48 w-48 rounded-full bg-blue-500/10 blur-3xl"></div>

            <div class="relative grid gap-5 lg:grid-cols-[1fr_auto] lg:items-center lg:gap-8">
                <div>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-xs text-indigo-200 sm:text-sm">
                        <span id="live-date">{{ now()->translatedFormat('l, d F Y') }}</span>

                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 font-medium tabular-nums text-white ring-1 ring-inset ring-white/15">
                            <svg class="h-3.5 w-3.5 text-indigo-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                            <span id="live-clock">{{ now()->format('h:i:s A') }}</span>
                        </span>
                    </div>

                    <h1 class="mt-2 text-xl font-bold tracking-tight sm:mt-3 sm:text-2xl">
                        Halo, {{ $firstName }}
                    </h1>

                    <p class="mt-2 max-w-xl text-xs leading-relaxed text-indigo-200 sm:mt-3 sm:text-sm">
                        Pantau kondisi seluruh cabang Bimbel Safa, pengguna, guru, siswa, kelas, dan jadwal dari satu dashboard.
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2 sm:mt-6">
                        <a
                            href="{{ route('super-admin.branches.index') }}"
                            class="rounded-lg bg-violet-600 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-violet-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-violet-400 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-950"
                        >
                            Kelola cabang
                        </a>

                        <a
                            href="{{ route('super-admin.branches.index') }}"
                            class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-semibold text-white ring-1 ring-inset ring-white/20 transition hover:bg-white/20 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white"
                        >
                            Lihat seluruh cabang
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                    <div class="rounded-xl bg-white/5 p-3 ring-1 ring-inset ring-white/10 sm:p-4">
                        <p class="text-[11px] text-indigo-200 sm:text-xs">Cabang aktif</p>
                        <p class="mt-1 text-2xl font-bold tabular-nums sm:text-3xl">
                            {{ $activeBranchCount }}
                        </p>
                        <p class="mt-1 text-[10px] text-indigo-200 sm:text-[11px]">
                            dari {{ $branchCount }} cabang
                        </p>
                    </div>

                    <div class="rounded-xl bg-white/5 p-3 ring-1 ring-inset ring-white/10 sm:p-4">
                        <p class="text-[11px] text-indigo-200 sm:text-xs">Pengguna</p>
                        <p class="mt-1 text-2xl font-bold tabular-nums sm:text-3xl">
                            {{ $adminCount + $teacherCount + $studentCount }}
                        </p>
                        <p class="mt-1 text-[10px] text-indigo-200 sm:text-[11px]">
                            Admin, guru & siswa
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-2 gap-2.5 sm:gap-3 xl:grid-cols-4">
            @php
                $cards = [
                    [
                        'Cabang',
                        $branchCount,
                        'Total cabang terdaftar',
                        'bg-slate-900 text-white',
                        'M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M9 7h6M9 11h6M9 15h6'
                    ],
                    [
                        'Admin',
                        $adminCount,
                        'Administrator cabang',
                        'bg-violet-600 text-white',
                        'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0-8 0 4 4 0 0 0 8 0zM16 3.13a4 4 0 0 1 0 7.75'
                    ],
                    [
                        'Guru aktif',
                        $teacherCount,
                        'Pengajar terdaftar',
                        'bg-sky-500 text-white',
                        'M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2zM8 7h8M8 11h6'
                    ],
                    [
                        'Siswa aktif',
                        $studentCount,
                        'Peserta didik terdaftar',
                        'bg-indigo-600 text-white',
                        'M22 10 12 5 2 10l10 5 10-5zM6 12.5V16c3 2 9 2 12 0v-3.5M22 10v6'
                    ],
                ];
            @endphp

            @foreach ($cards as [$label, $value, $hint, $tone, $icon])
                <div class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-white p-3 transition hover:border-slate-300 hover:shadow-sm sm:gap-3 sm:p-4">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $tone }} sm:h-10 sm:w-10">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="{{ $icon }}"/>
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <p class="text-[11px] text-slate-500 sm:text-xs">{{ $label }}</p>
                        <p class="text-lg font-bold tabular-nums tracking-tight text-slate-900 sm:text-xl">
                            {{ $value }}
                        </p>
                        <p class="truncate text-[10px] text-slate-400 sm:text-[11px]">
                            {{ $hint }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-2 gap-2.5 sm:gap-3 md:grid-cols-4">
            @php
                $secondaryCards = [
                    [
                        'Kelas',
                        $classRoomCount,
                        'Kelas terdaftar',
                        'bg-amber-500 text-white',
                        'M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M9 7h6M9 11h6M9 15h6'
                    ],
                    [
                        'Jadwal',
                        $scheduleCount,
                        'Jadwal pembelajaran',
                        'bg-emerald-600 text-white',
                        'M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z'
                    ],
                    [
                        'Cabang aktif',
                        $activeBranchCount,
                        'Sedang beroperasi',
                        'bg-blue-600 text-white',
                        'M5 12l4 4L19 6'
                    ],
                    [
                        'Nonaktif',
                        $inactiveBranchCount,
                        'Perlu perhatian',
                        'bg-slate-500 text-white',
                        'M18 6 6 18M6 6l12 12'
                    ],
                ];
            @endphp

            @foreach ($secondaryCards as [$label, $value, $hint, $tone, $icon])
                <div class="rounded-xl border border-slate-200 bg-white p-3 sm:p-4">
                    <div class="flex items-center gap-2.5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $tone }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="{{ $icon }}"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <p class="text-[11px] text-slate-500 sm:text-xs">{{ $label }}</p>
                            <p class="text-lg font-bold tabular-nums tracking-tight text-slate-900 sm:text-xl">
                                {{ $value }}
                            </p>
                        </div>
                    </div>

                    <p class="mt-2 truncate text-[10px] text-slate-400 sm:text-[11px]">
                        {{ $hint }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="grid gap-4 xl:grid-cols-[1.4fr_1fr]">

            <section class="self-start rounded-xl border border-slate-200 bg-white">
                <div class="flex items-center justify-between px-3.5 pb-3 pt-4 sm:px-5 sm:pb-3.5 sm:pt-5">
                    <div>
                        <h2 class="text-xs font-bold text-slate-900 sm:text-sm">
                            Cabang Bimbel Safa
                        </h2>
                        <p class="text-[11px] text-slate-500 sm:text-xs">
                            Ringkasan kondisi setiap cabang.
                        </p>
                    </div>

                    <a
                        href="{{ route('super-admin.branches.index') }}"
                        class="rounded-lg px-2 py-1 text-[11px] font-medium text-indigo-600 transition hover:bg-indigo-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 sm:px-2.5 sm:text-xs"
                    >
                        Lihat semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-[11px] sm:text-xs">
                        <thead>
                            <tr class="border-y border-slate-100 bg-slate-50 text-[10px] font-medium text-slate-500 sm:text-[11px]">
                                <th class="px-3 py-2 sm:px-5 sm:py-2.5">Cabang</th>
                                <th class="px-2.5 py-2 sm:px-3 sm:py-2.5">Pengguna</th>
                                <th class="px-2.5 py-2 sm:px-3 sm:py-2.5">Guru</th>
                                <th class="px-2.5 py-2 sm:px-3 sm:py-2.5">Siswa</th>
                                <th class="px-3 py-2 sm:px-5 sm:py-2.5">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($latestBranches as $branch)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="px-3 py-3 sm:px-5">
                                        <div class="flex items-center gap-2.5">
                                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-xs font-bold text-indigo-700">
                                                {{ strtoupper(substr($branch->name, 0, 1)) }}
                                            </div>

                                            <div class="min-w-0">
                                                <div class="truncate font-semibold text-slate-900">
                                                    {{ $branch->name }}
                                                </div>

                                                <div class="truncate text-[10px] text-slate-500 sm:text-[11px]">
                                                    {{ $branch->address ?: 'Alamat belum diisi' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-2.5 py-3 tabular-nums text-slate-600 sm:px-3">
                                        {{ $branch->users_count }}
                                    </td>

                                    <td class="px-2.5 py-3 tabular-nums text-slate-600 sm:px-3">
                                        {{ $branch->teachers_count }}
                                    </td>

                                    <td class="px-2.5 py-3 tabular-nums text-slate-600 sm:px-3">
                                        {{ $branch->students_count }}
                                    </td>

                                    <td class="px-3 py-3 sm:px-5">
                                        @if ($branch->is_active)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-medium text-emerald-700 sm:text-[11px]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-1 text-[10px] font-medium text-slate-600 sm:text-[11px]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-10 text-center text-[11px] text-slate-500 sm:px-5 sm:text-xs">
                                        Belum ada cabang yang terdaftar.
                                        <a href="{{ route('super-admin.branches.create') }}" class="font-medium text-indigo-600 hover:underline">
                                            Tambah cabang
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-3.5 sm:p-4">
                <div class="mb-2.5 flex items-start justify-between">
                    <div>
                        <h2 class="text-xs font-bold text-slate-900 sm:text-sm">
                            Pengguna terbaru
                        </h2>
                        <p class="text-[11px] text-slate-500 sm:text-xs">
                            Akun yang baru ditambahkan.
                        </p>
                    </div>
                </div>

                <ul class="divide-y divide-slate-100">
                    @forelse ($latestUsers as $user)
                        @php
                            $avatarClass = $avatars[ord(strtoupper($user->name[0] ?? 'A')) % count($avatars)];

                            $roleLabel = match ($user->role) {
                                'admin' => 'Admin',
                                'guru' => 'Guru',
                                'siswa' => 'Siswa',
                                default => ucfirst($user->role),
                            };

                            $roleClass = match ($user->role) {
                                'admin' => 'bg-violet-50 text-violet-700',
                                'guru' => 'bg-sky-50 text-sky-700',
                                'siswa' => 'bg-emerald-50 text-emerald-700',
                                default => 'bg-slate-100 text-slate-600',
                            };
                        @endphp

                        <li class="flex items-center justify-between gap-3 py-2.5">
                            <div class="flex min-w-0 items-center gap-2.5">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-[11px] font-bold sm:h-9 sm:w-9 sm:text-xs {{ $avatarClass }}">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">
                                    <div class="truncate text-[11px] font-semibold text-slate-900 sm:text-xs">
                                        {{ $user->name }}
                                    </div>

                                    <div class="truncate text-[10px] text-slate-500 sm:text-[11px]">
                                        {{ $user->branch?->name ?? 'Tanpa cabang' }}
                                    </div>
                                </div>
                            </div>

                            <span class="inline-flex shrink-0 rounded-full px-2 py-1 text-[10px] font-medium {{ $roleClass }}">
                                {{ $roleLabel }}
                            </span>
                        </li>
                    @empty
                        <li class="py-8 text-center text-[11px] text-slate-500 sm:text-xs">
                            Belum ada pengguna.
                        </li>
                    @endforelse
                </ul>
            </section>
        </div>

        <section class="rounded-xl border border-slate-200 bg-white">
            <div class="flex items-center justify-between px-3.5 pb-3 pt-4 sm:px-5 sm:pb-3.5 sm:pt-5">
                <div>
                    <h2 class="text-xs font-bold text-slate-900 sm:text-sm">
                        Ringkasan sistem
                    </h2>
                    <p class="text-[11px] text-slate-500 sm:text-xs">
                        Gambaran data utama seluruh cabang.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 divide-x divide-y divide-slate-100 border-t border-slate-100 sm:grid-cols-4 sm:divide-y-0">
                <div class="p-3.5 sm:p-4">
                    <p class="text-[10px] text-slate-500 sm:text-[11px]">Total cabang</p>
                    <p class="mt-1 text-lg font-bold tabular-nums text-slate-900 sm:text-xl">
                        {{ $branchCount }}
                    </p>
                </div>

                <div class="p-3.5 sm:p-4">
                    <p class="text-[10px] text-slate-500 sm:text-[11px]">Total guru</p>
                    <p class="mt-1 text-lg font-bold tabular-nums text-slate-900 sm:text-xl">
                        {{ $teacherCount }}
                    </p>
                </div>

                <div class="p-3.5 sm:p-4">
                    <p class="text-[10px] text-slate-500 sm:text-[11px]">Total siswa</p>
                    <p class="mt-1 text-lg font-bold tabular-nums text-slate-900 sm:text-xl">
                        {{ $studentCount }}
                    </p>
                </div>

                <div class="p-3.5 sm:p-4">
                    <p class="text-[10px] text-slate-500 sm:text-[11px]">Total kelas</p>
                    <p class="mt-1 text-lg font-bold tabular-nums text-slate-900 sm:text-xl">
                        {{ $classRoomCount }}
                    </p>
                </div>
            </div>
        </section>
    </div>

    <script>
        (function () {
            const dateEl = document.getElementById('live-date');
            const clockEl = document.getElementById('live-clock');

            if (!dateEl || !clockEl) return;

            const dateFmt = new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });

            const timeFmt = new Intl.DateTimeFormat('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });

            function tick() {
                const now = new Date();

                dateEl.textContent = dateFmt.format(now);
                clockEl.textContent = timeFmt.format(now);
            }

            tick();
            setInterval(tick, 1000);
        })();
    </script>
</x-super-admin-layout>