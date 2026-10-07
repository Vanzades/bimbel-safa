@php
    $billTotal  = max((int) $stats['sppBills'], 1);
    $paidPct    = round($stats['sppPaid'] / $billTotal * 100);
    $pendingPct = round($stats['sppPending'] / $billTotal * 100);
    $unpaidPct  = max(0, 100 - $paidPct - $pendingPct);
    $circ       = 2 * M_PI * 52;
    $firstName  = \Illuminate\Support\Str::of(auth()->user()?->name ?? 'Admin')->before(' ');
    $today      = strtolower(now()->translatedFormat('l'));
    $avatars    = ['bg-indigo-100 text-indigo-700', 'bg-sky-100 text-sky-700', 'bg-emerald-100 text-emerald-700', 'bg-amber-100 text-amber-700', 'bg-rose-100 text-rose-700'];
@endphp

<x-admin-layout>
    {{-- Favicon: pindahkan <link rel="icon"> ke <head> di x-admin-layout --}}
    <x-slot name="title">Dashboard</x-slot>

    <div class="space-y-4 pb-8">

        {{-- Hero --}}
        <section class="relative overflow-hidden rounded-2xl bg-indigo-950 p-4 text-white sm:p-6">
            <div class="pointer-events-none absolute -bottom-32 left-1/3 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl"></div>

            <div class="relative grid gap-4 lg:grid-cols-[1fr_auto] lg:items-center lg:gap-6">
                <div>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-xs text-indigo-200 sm:text-sm">
                        <span id="live-date">{{ now()->translatedFormat('l, d F Y') }}</span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 font-medium tabular-nums text-white ring-1 ring-inset ring-white/15">
                            <svg class="h-3.5 w-3.5 text-indigo-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                            <span id="live-clock">{{ now()->format('h:i:s A') }}</span>
                        </span>
                    </div>
                    <h1 class="mt-2 text-xl font-bold tracking-tight sm:mt-3 sm:text-2xl">Halo, {{ $firstName }}</h1>
                    <p class="mt-2 max-w-md text-xs leading-relaxed text-indigo-200 sm:mt-3 sm:text-sm">
                        Ada {{ $stats['schedules'] }} jadwal aktif dan {{ $stats['sppUnpaid'] }} tagihan SPP yang belum lunas.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2 sm:mt-6">
                        <a href="{{ route('admin.schedules.index') }}" class="rounded-lg bg-violet-600 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-violet-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-violet-400 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-950">Kelola jadwal</a>
                        <a href="{{ route('admin.students.index') }}" class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-semibold text-white ring-1 ring-inset ring-white/20 transition hover:bg-white/20 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white">Data siswa</a>
                        <a href="{{ route('admin.teachers.index') }}" class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-semibold text-white ring-1 ring-inset ring-white/20 transition hover:bg-white/20 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white">Data guru</a>
                    </div>
                </div>

                {{-- SPP ring --}}
                <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3 ring-1 ring-inset ring-white/10 sm:gap-4 sm:p-4">
                    <div class="relative h-20 w-20 shrink-0 sm:h-24 sm:w-24">
                        <svg viewBox="0 0 120 120" class="h-full w-full -rotate-90" role="img" aria-label="SPP lunas {{ $paidPct }}%">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="rgb(255 255 255 / .12)" stroke-width="10"/>
                            <circle cx="60" cy="60" r="52" fill="none" stroke="#34d399" stroke-width="10" stroke-linecap="round"
                                    stroke-dasharray="{{ $circ }}" stroke-dashoffset="{{ $circ * (1 - $paidPct / 100) }}"/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-lg font-bold tabular-nums sm:text-xl">{{ $paidPct }}%</span>
                            <span class="text-[9px] text-indigo-200 sm:text-[10px]">lunas</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-[11px] text-indigo-200 sm:text-xs">SPP terkumpul</p>
                        <p class="mt-0.5 text-sm font-bold tabular-nums sm:text-base">Rp {{ number_format($stats['sppPaidAmount'], 0, ',', '.') }}</p>
                        <p class="mt-1 text-[11px] text-indigo-200 sm:text-xs">{{ $stats['sppPaid'] }} dari {{ $stats['sppBills'] }} tagihan</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 gap-2.5 sm:gap-3 xl:grid-cols-4">
            @php
                $cards = [
                    ['Total akun',  $stats['users'],      'Semua pengguna sistem',  'bg-slate-900 text-white',   'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75'],
                    ['Guru aktif',  $stats['teachers'],   'Pengajar yang mengajar', 'bg-sky-500 text-white',     'M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2zM8 7h8M8 11h6'],
                    ['Siswa aktif', $stats['students'],   'Peserta didik terdaftar','bg-indigo-600 text-white',  'M22 10 12 5 2 10l10 5 10-5zM6 12.5V16c3 2 9 2 12 0v-3.5M22 10v6'],
                    ['Kelas aktif', $stats['classRooms'], 'Kelas yang berjalan',    'bg-amber-500 text-white',   'M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M9 7h6M9 11h6M9 15h6'],
                ];
            @endphp
            @foreach ($cards as [$label, $value, $hint, $tone, $icon])
                <div class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-white p-3 transition hover:border-slate-300 hover:shadow-sm sm:gap-3 sm:p-4">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $tone }} sm:h-10 sm:w-10">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] text-slate-500 sm:text-xs">{{ $label }}</p>
                        <p class="text-lg font-bold tabular-nums tracking-tight text-slate-900 sm:text-xl">{{ $value }}</p>
                        <p class="truncate text-[10px] text-slate-400 sm:text-[11px]">{{ $hint }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- SPP breakdown --}}
        <section>
            <div class="mb-3 flex items-end justify-between">
                <div>
                    <h2 class="text-xs font-bold text-slate-900 dark:text-white sm:text-sm">Status SPP</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 sm:text-xs">Total {{ $stats['sppBills'] }} tagihan SPP siswa.</p>
                </div>
            </div>
            <div class="grid gap-2.5 sm:gap-3 md:grid-cols-3">
                @foreach ([
                    ['Lunas',                $stats['sppPaid'],    'Rp ' . number_format($stats['sppPaidAmount'], 0, ',', '.'),   $paidPct,    'bg-emerald-600', 'bg-emerald-800'],
                    ['Belum lunas',          $stats['sppUnpaid'],  'Rp ' . number_format($stats['sppUnpaidAmount'], 0, ',', '.'), $unpaidPct,  'bg-amber-500',   'bg-amber-700'],
                    ['Menunggu pembayaran',  $stats['sppPending'], 'Sedang diproses sistem',                                       $pendingPct, 'bg-sky-600',     'bg-sky-800'],
                ] as [$label, $count, $sub, $pct, $box, $bar])
                    <div class="rounded-xl border border-transparent p-3.5 text-white {{ $box }} sm:p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-medium text-white/90">{{ $label }}</span>
                            <span class="text-[10px] font-semibold text-white/90 sm:text-[11px]">{{ $pct }}%</span>
                        </div>
                        <p class="mt-1.5 text-xl font-bold tabular-nums text-white sm:text-2xl">{{ $count }}</p>
                        <p class="mt-1 text-[11px] text-white/80 sm:text-xs">{{ $sub }}</p>
                        <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-white/25">
                            <div class="h-full rounded-full bg-white" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="grid gap-4 xl:grid-cols-[2fr_1fr]">

            {{-- Jadwal --}}
            <section class="self-start rounded-xl border border-slate-200 bg-white">
                <div class="flex items-center justify-between px-3.5 pt-4 pb-2.5 sm:px-5 sm:pt-5 sm:pb-3">
                    <div>
                        <h2 class="text-xs font-bold text-slate-900 sm:text-sm">Jadwal kelas terbaru</h2>
                        <p class="text-[11px] text-slate-500 sm:text-xs">{{ $stats['schedules'] }} jadwal aktif</p>
                    </div>
                    <a href="{{ route('admin.schedules.index') }}" class="rounded-lg px-2 py-1 text-[11px] font-medium text-indigo-600 transition hover:bg-indigo-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 sm:px-2.5 sm:text-xs">Lihat semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-[11px] sm:text-xs">
                        <thead>
                            <tr class="border-y border-slate-100 bg-slate-50 text-[10px] font-medium text-slate-500 sm:text-[11px]">
                                <th class="px-3 py-2 sm:px-5 sm:py-2.5">Hari</th>
                                <th class="px-2.5 py-2 sm:px-3 sm:py-2.5">Waktu</th>
                                <th class="px-2.5 py-2 sm:px-3 sm:py-2.5">Kelas</th>
                                <th class="px-3 py-2 sm:px-5 sm:py-2.5">Guru</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($latestSchedules as $schedule)
                                @php $isToday = strtolower($schedule->day) === $today; @endphp
                                <tr class="transition hover:bg-slate-50 {{ $isToday ? 'bg-indigo-50/40' : '' }}">
                                    <td class="whitespace-nowrap px-3 py-2.5 sm:px-5 sm:py-3">
                                        <span class="inline-flex rounded-md px-1.5 py-0.5 text-[10px] font-semibold sm:px-2 sm:text-[11px] {{ $isToday ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-700' }}">{{ ucfirst($schedule->day) }}</span>
                                        @if ($isToday)<span class="ml-1 text-[10px] font-medium text-indigo-600 sm:text-[11px]">Hari ini</span>@endif
                                    </td>
                                    <td class="whitespace-nowrap px-2.5 py-2.5 tabular-nums text-slate-600 sm:px-3 sm:py-3">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                    </td>
                                    <td class="px-2.5 py-2.5 sm:px-3 sm:py-3">
                                        <div class="font-medium text-slate-900">{{ $schedule->classRoom->name ?? '-' }}</div>
                                        @if ($schedule->classRoom?->code)
                                            <div class="text-[10px] text-slate-500 sm:text-[11px]">{{ $schedule->classRoom->code }}</div>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2.5 sm:px-5 sm:py-3">
                                        <div class="flex items-center gap-1.5 sm:gap-2">
                                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-slate-100 text-[10px] font-bold text-slate-600 sm:h-6 sm:w-6 sm:text-[11px]">{{ strtoupper(substr($schedule->teacher->name ?? '-', 0, 1)) }}</span>
                                            <span class="text-slate-700">{{ $schedule->teacher->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-8 text-center text-[11px] text-slate-500 sm:px-5 sm:py-10 sm:text-xs">
                                        Belum ada jadwal kelas aktif.
                                        <a href="{{ route('admin.schedules.index') }}" class="font-medium text-indigo-600 hover:underline">Buat jadwal</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- Guru & siswa terbaru --}}
            <div class="space-y-4">
                @foreach ([
                    ['Guru baru',  'Pengajar yang baru bergabung.',  $latestTeachers, 'admin.teachers.index', 'Belum ada data guru.'],
                    ['Siswa baru', 'Peserta didik yang baru daftar.', $latestStudents, 'admin.students.index', 'Belum ada data siswa.'],
                ] as [$title, $desc, $items, $routeName, $empty])
                    <section class="rounded-xl border border-slate-200 bg-white p-3.5 sm:p-4">
                        <div class="mb-2.5 flex items-start justify-between">
                            <div>
                                <h2 class="text-xs font-bold text-slate-900 sm:text-sm">{{ $title }}</h2>
                                <p class="text-[11px] text-slate-500 sm:text-xs">{{ $desc }}</p>
                            </div>
                            <a href="{{ route($routeName) }}" class="rounded-lg px-2 py-1 text-[11px] font-medium text-indigo-600 transition hover:bg-indigo-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 sm:px-2.5 sm:text-xs">Lihat semua</a>
                        </div>

                        <ul class="divide-y divide-slate-100">
                            @forelse ($items as $person)
                                <li class="flex items-center justify-between gap-2.5 py-2.5">
                                    <div class="flex min-w-0 items-center gap-2 sm:gap-2.5">
                                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-[11px] font-bold sm:h-9 sm:w-9 sm:text-xs {{ $avatars[ord(strtoupper($person->name[0] ?? 'A')) % count($avatars)] }}">
                                            {{ strtoupper(substr($person->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="truncate text-[11px] font-semibold text-slate-900 sm:text-xs">{{ $person->name }}</div>
                                            <div class="truncate text-[10px] text-slate-500 sm:text-[11px]">{{ $person->identity_number ?? ($person->classRoom->name ?? 'Belum ada kelas') }}</div>
                                        </div>
                                    </div>
                                    @if ($person->status === 'active')
                                        <span class="inline-flex shrink-0 items-center gap-1 rounded-full bg-emerald-50 px-1.5 py-0.5 text-[10px] font-medium text-emerald-700 sm:px-2 sm:text-[11px]"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Aktif</span>
                                    @else
                                        <span class="inline-flex shrink-0 items-center gap-1 rounded-full bg-slate-100 px-1.5 py-0.5 text-[10px] font-medium text-slate-600 sm:px-2 sm:text-[11px]"><span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>Tidak aktif</span>
                                    @endif
                                </li>
                            @empty
                                <li class="py-6 text-center text-[11px] text-slate-500 sm:text-xs">{{ $empty }}</li>
                            @endforelse
                        </ul>
                    </section>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        (function () {
            const dateEl = document.getElementById('live-date');
            const clockEl = document.getElementById('live-clock');
            if (!dateEl || !clockEl) return;

            const dateFmt = new Intl.DateTimeFormat('id-ID', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
            const timeFmt = new Intl.DateTimeFormat('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });

            function tick() {
                const now = new Date();
                dateEl.textContent = dateFmt.format(now);
                clockEl.textContent = timeFmt.format(now);
            }

            tick();
            setInterval(tick, 1000);
        })();
    </script>
</x-admin-layout>
