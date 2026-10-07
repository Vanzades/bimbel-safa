@php
    $billTotal = max((int) $sppStats['total'], 1);
    $paidPct = min(100, max(0, round($sppStats['paid'] / $billTotal * 100)));
    $circ = 2 * M_PI * 52;

    $cards = [
        ['Total tagihan', $sppStats['total'], 'Tagihan SPP kamu', 'bg-slate-500/10 text-slate-700', 'M3 4h18v16H3zM3 9h18M7 14h4'],
        ['Lunas', $sppStats['paid'], 'Pembayaran berhasil', 'bg-emerald-500/10 text-emerald-600', 'm5 12 4 4L19 6'],
        ['Belum lunas', $sppStats['unpaid'], 'Perlu dibayar', 'bg-amber-500/10 text-amber-600', 'M12 8v4m0 4h.01M10.3 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.7 3.86a2 2 0 0 0-3.4 0'],
        ['Menunggu', $sppStats['pending'], 'Sedang diproses', 'bg-sky-500/10 text-sky-600', 'M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0'],
    ];

    // Label + warna status tagihan
    $billStatuses = [
        'paid' => ['Lunas', '#10b981'],
        'pending' => ['Menunggu pembayaran', '#0ea5e9'],
        'failed' => ['Gagal', '#f43f5e'],
        'expired' => ['Kedaluwarsa', '#64748b'],
    ];
    $billStatus = $latestSppBill
        ? ($billStatuses[$latestSppBill->status] ?? ['Belum lunas', '#f59e0b'])
        : null;

    $cardClass = 'rounded-xl bg-white shadow-[0_2px_16px_rgba(15,23,42,0.04)] dark:border dark:border-white/10';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} - Dashboard Siswa</title>

    {{-- Favicon Responsif --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="min-h-screen antialiased"
    style="background-color: var(--student-topbar, #F6F6F6); color: #1f2937;"
>
    <x-student-sidebar />
    <div class="min-h-screen lg:pl-64">
        <x-student-topbar :student="$student" title="Dashboard Siswa" />

        <main class="mx-auto w-full max-w-7xl space-y-4 px-4 py-5 pb-8 sm:px-6 lg:px-8">

            {{-- Hero --}}
            <section class="relative overflow-hidden rounded-2xl bg-blue-950 p-4 text-white sm:p-5 dark:border dark:border-white/10">
                <div class="pointer-events-none absolute -bottom-32 left-1/3 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="relative grid gap-4 lg:grid-cols-[1fr_auto] lg:items-center lg:gap-6">
                    <div>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[11px] text-blue-200 sm:text-xs">
                            <span id="live-date">{{ now()->translatedFormat('l, d F Y') }}</span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-2.5 py-1 font-medium tabular-nums text-white ring-1 ring-inset ring-white/15">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                <span id="live-clock">{{ now()->format('h:i:s A') }}</span>
                            </span>
                        </div>
                        <h1 class="mt-2 text-lg font-semibold tracking-tight sm:mt-2.5 sm:text-xl">
                            Halo, {{ \Illuminate\Support\Str::of($student->name)->before(' ') }}
                        </h1>
                        <p class="mt-1.5 max-w-md text-[10px] leading-relaxed text-blue-200 sm:mt-2 sm:text-[11px]">
                            Ada {{ $sppStats['unpaid'] }} tagihan SPP belum lunas dan {{ $sppStats['pending'] }} pembayaran yang sedang diproses.
                        </p>
                        <div class="mt-3 flex flex-wrap gap-2 sm:mt-4">
                            <a href="{{ route('student.spp') }}" class="rounded-lg bg-blue-600 px-2.5 py-1.5 text-[11px] font-semibold text-white transition hover:bg-blue-500">Lihat SPP</a>
                            <a href="{{ route('student.attendance') }}" class="rounded-lg bg-white/10 px-2.5 py-1.5 text-[11px] font-semibold text-white ring-1 ring-inset ring-white/20 transition hover:bg-white/20">Lihat absensi</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3 ring-1 ring-inset ring-white/10 sm:gap-3.5">
                        <div class="relative h-16 w-16 shrink-0 sm:h-20 sm:w-20">
                            <svg viewBox="0 0 120 120" class="h-full w-full -rotate-90" role="img" aria-label="SPP lunas {{ $paidPct }} persen">
                                <circle cx="60" cy="60" r="52" fill="none" stroke="rgb(255 255 255 / .12)" stroke-width="10"/>
                                <circle cx="60" cy="60" r="52" fill="none" stroke="#34d399" stroke-width="10" stroke-linecap="round" stroke-dasharray="{{ $circ }}" stroke-dashoffset="{{ $circ * (1 - $paidPct / 100) }}"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-sm font-bold tabular-nums sm:text-base">{{ $paidPct }}%</span>
                                <span class="text-[8px] text-blue-200 sm:text-[9px]">lunas</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] text-blue-200 sm:text-[11px]">SPP yang sudah dibayar</p>
                            <p class="mt-0.5 text-xs font-bold tabular-nums sm:text-sm">Rp {{ number_format($sppStats['paidAmount'], 0, ',', '.') }}</p>
                            <p class="mt-1 text-[10px] text-blue-200 sm:text-[11px]">{{ $sppStats['paid'] }} dari {{ $sppStats['total'] }} tagihan</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Statistik --}}
            <section class="grid grid-cols-2 gap-2.5 sm:gap-3 xl:grid-cols-4">
                @foreach ($cards as [$label, $value, $hint, $tone, $icon])
                    <div class="{{ $cardClass }} group flex items-center gap-2.5 p-3 transition duration-200 hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl {{ $tone }} transition group-hover:scale-105 sm:h-9 sm:w-9">
                            <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icon }}"/></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] text-slate-500 sm:text-[11px]">{{ $label }}</p>
                            <p class="text-base font-bold tabular-nums tracking-tight text-slate-900 sm:text-lg">{{ $value }}</p>
                            <p class="truncate text-[9px] text-slate-400 sm:text-[10px]">{{ $hint }}</p>
                        </div>
                    </div>
                @endforeach
            </section>

            {{-- SPP terakhir & info siswa --}}
            <section class="grid gap-4 xl:grid-cols-[2fr_1fr]">

                {{-- Tagihan SPP terakhir --}}
                <div class="{{ $cardClass }} flex flex-col overflow-hidden">
                    <div class="flex items-center justify-between px-4 pb-2.5 pt-3.5 sm:px-5 sm:pt-4">
                        <div>
                            <h2 class="text-[11px] font-bold text-slate-900 sm:text-xs">Tagihan SPP terakhir</h2>
                            <p class="text-[10px] text-slate-500 sm:text-[11px]">Informasi pembayaran terbaru</p>
                        </div>
                        <a href="{{ route('student.spp') }}" class="rounded-lg px-2.5 py-1.5 text-[10px] font-medium text-blue-600 transition hover:bg-blue-50 sm:text-[11px]">Lihat semua</a>
                    </div>

                    @if ($latestSppBill)
                        <div class="flex-1 space-y-3 border-t border-slate-100 p-4 sm:p-5 dark:border-white/10">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[9px] font-semibold sm:text-[10px]"
                                    style="background-color:{{ $billStatus[1] }}22;color:{{ $billStatus[1] }}"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full" style="background-color:{{ $billStatus[1] }}"></span>
                                    {{ $billStatus[0] }}
                                </span>

                                @if ($latestSppBill->paid_at)
                                    <p class="inline-flex items-center gap-1.5 text-[11px] text-slate-500">
                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                        Dibayar pada <span class="font-medium text-slate-700">{{ $latestSppBill->paid_at->translatedFormat('d F Y, h:i A') }}</span>
                                    </p>
                                @endif
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="rounded-lg bg-slate-50 p-3.5 dark:border dark:border-white/10">
                                    <p class="text-[11px] text-slate-500">Periode</p>
                                    <p class="mt-1 text-sm font-semibold text-slate-900 sm:text-base">{{ $latestSppBill->period }}</p>
                                </div>
                                <div class="rounded-lg bg-slate-50 p-3.5 dark:border dark:border-white/10">
                                    <p class="text-[11px] text-slate-500">Jumlah tagihan</p>
                                    <p class="mt-1 text-lg font-bold tabular-nums text-slate-900 sm:text-xl">Rp {{ number_format($latestSppBill->amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-1 flex-col items-center justify-center border-t border-slate-100 px-4 py-9 text-center sm:px-5 dark:border-white/10">
                            <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h18v16H3zM3 9h18M7 14h4"/></svg>
                            </div>
                            <p class="text-[11px] text-slate-500">Belum ada tagihan SPP.</p>
                        </div>
                    @endif
                </div>

                {{-- Informasi siswa --}}
                <div class="{{ $cardClass }} flex flex-col overflow-hidden">
                    <div class="flex items-center gap-2.5 border-b border-slate-100 px-4 py-3.5 sm:px-5 dark:border-white/10">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-500/10 text-[11px] font-bold text-blue-600">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <h2 class="text-[11px] font-bold text-slate-900 sm:text-xs">Informasi siswa</h2>
                    </div>

                    <div class="flex-1 divide-y divide-slate-100 dark:divide-white/10">
                        <div class="flex items-center justify-between gap-3 px-4 py-2.5 sm:px-5"><span class="text-[11px] text-slate-500">Nama</span><span class="text-right text-[11px] font-medium text-slate-900">{{ $student->name }}</span></div>
                        <div class="flex items-center justify-between gap-3 px-4 py-2.5 sm:px-5"><span class="text-[11px] text-slate-500">NIS</span><span class="text-right text-[11px] font-medium tabular-nums text-slate-900">{{ $student->identity_number }}</span></div>
                        <div class="flex items-center justify-between gap-3 px-4 py-2.5 sm:px-5"><span class="text-[11px] text-slate-500">Kelas</span><span class="text-right text-[11px] font-medium text-slate-900">{{ $student->classRoom->name ?? '-' }}</span></div>
                        <div class="flex items-center justify-between gap-3 px-4 py-2.5 sm:px-5">
                            <span class="text-[11px] text-slate-500">Status</span>
                            <span class="inline-flex items-center gap-1.5 text-right text-[11px] font-semibold {{ $student->status === 'active' ? 'text-emerald-500' : 'text-slate-500' }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $student->status === 'active' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                {{ $student->status === 'active' ? 'Aktif' : 'Tidak aktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
    (() => {
        const dateEl = document.getElementById('live-date');
        const clockEl = document.getElementById('live-clock');
        if (!dateEl || !clockEl) return;
        const dateFormat = new Intl.DateTimeFormat('id-ID', { weekday:'long', day:'2-digit', month:'long', year:'numeric' });
        const timeFormat = new Intl.DateTimeFormat('en-US', { hour:'2-digit', minute:'2-digit', second:'2-digit', hour12:true });
        function tick() {
            const current = new Date();
            dateEl.textContent = dateFormat.format(current);
            clockEl.textContent = timeFormat.format(current);
        }
        tick();
        setInterval(tick, 1000);
    })();
    </script>
</body>
</html>
