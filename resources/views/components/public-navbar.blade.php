@php
    $name = config('app.name', 'Bimbel Safa');

    $user = auth()->user();

    if ($user && $user->isSuperAdmin()) {
        $accountUrl = route('super-admin.dashboard');
        $accountLabel = 'Dashboard';
    } elseif ($user && $user->isAdmin()) {
        $accountUrl = route('admin.dashboard');
        $accountLabel = 'Dashboard';
    } elseif ($user && $user->isGuru()) {
        $accountUrl = route('teacher.dashboard');
        $accountLabel = 'Dashboard';
    } elseif ($user && $user->isSiswa()) {
        $accountUrl = route('student.dashboard');
        $accountLabel = 'Student Portal';
    } else {
        $accountUrl = route('login');
        $accountLabel = 'Masuk';
    }
@endphp

<header
    x-data="{ open: false, programOpen: false }"
    class="fixed inset-x-0 top-0 z-50 px-4 pt-4 sm:px-6"
>
    <div class="mx-auto max-w-6xl">
        <div class="relative rounded-full border border-white/60 bg-white/95 px-3 py-2 shadow-lg shadow-slate-900/10 backdrop-blur-xl">
            <div class="flex h-12 items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="flex shrink-0 items-center pl-2">
                    <img
                        src="{{ asset('image/logo.png') }}"
                        alt="{{ $name }}"
                        class="h-9 w-auto"
                    >
                </a>

                <nav class="hidden items-center gap-1 md:flex" aria-label="Navigasi utama">
                    <a
                        href="{{ route('home') }}"
                        class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        Beranda
                    </a>

                    <a
                        href="{{ route('tentang') }}"
                        class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->routeIs('tentang') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        Tentang Kami
                    </a>

                    <div class="relative" @mouseenter="programOpen = true" @mouseleave="programOpen = false">
                        <button
                            type="button"
                            @click="programOpen = !programOpen"
                            class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                        >
                            Program
                            <svg class="h-4 w-4 transition-transform" :class="programOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>

                        <div
                            x-show="programOpen"
                            x-transition
                            @click.outside="programOpen = false"
                            class="absolute left-1/2 top-full mt-3 w-52 -translate-x-1/2 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl shadow-slate-900/10"
                        >
                            <a href="{{ route('program') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                                Semua Program
                            </a>
                            <a href="{{ route('program.detail', 'sd') }}" class="block rounded-xl px-4 py-3 text-sm text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                                Program SD
                            </a>
                            <a href="{{ route('program.detail', 'smp') }}" class="block rounded-xl px-4 py-3 text-sm text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                                Program SMP
                            </a>
                            <a href="{{ route('program.detail', 'sma') }}" class="block rounded-xl px-4 py-3 text-sm text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                                Program SMA
                            </a>
                        </div>
                    </div>

                    <a
                        href="{{ route('kontak') }}"
                        class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->routeIs('kontak') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        Kontak
                    </a>
                </nav>

                <div class="hidden items-center gap-2 md:flex">
                    <a
                        href="{{ $accountUrl }}"
                        class="inline-flex h-10 items-center rounded-full bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                    >
                        {{ $accountLabel }}
                    </a>

                    @guest
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex h-10 items-center rounded-full border border-slate-200 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700"
                        >
                            Daftar Sekarang
                        </a>
                    @endguest
                </div>

                <button
                    type="button"
                    @click="open = !open"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-700 transition hover:bg-slate-200 md:hidden"
                    aria-label="Buka menu"
                >
                    <svg x-show="!open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>

                    <svg x-show="open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18"/>
                    </svg>
                </button>
            </div>

            <div
                x-show="open"
                x-transition
                class="border-t border-slate-100 pb-3 pt-3 md:hidden"
            >
                <nav class="space-y-1" aria-label="Navigasi mobile">
                    <a
                        href="{{ route('home') }}"
                        class="block rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-50' }}"
                    >
                        Beranda
                    </a>

                    <a
                        href="{{ route('tentang') }}"
                        class="block rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('tentang') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-50' }}"
                    >
                        Tentang Kami
                    </a>

                    <div>
                        <button
                            type="button"
                            @click="programOpen = !programOpen"
                            class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50"
                        >
                            Program
                            <svg class="h-4 w-4 transition-transform" :class="programOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>

                        <div x-show="programOpen" x-transition class="mt-1 space-y-1 pl-3">
                            <a href="{{ route('program') }}" class="block rounded-xl px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50">
                                Semua Program
                            </a>
                            <a href="{{ route('program.detail', 'sd') }}" class="block rounded-xl px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50">
                                Program SD
                            </a>
                            <a href="{{ route('program.detail', 'smp') }}" class="block rounded-xl px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50">
                                Program SMP
                            </a>
                            <a href="{{ route('program.detail', 'sma') }}" class="block rounded-xl px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50">
                                Program SMA
                            </a>
                        </div>
                    </div>

                    <a
                        href="{{ route('kontak') }}"
                        class="block rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('kontak') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-50' }}"
                    >
                        Kontak
                    </a>

                    <div class="grid grid-cols-2 gap-2 pt-2">
                        <a
                            href="{{ $accountUrl }}"
                            class="flex h-11 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white"
                        >
                            {{ $accountLabel }}
                        </a>

                        @guest
                            <a
                                href="{{ route('register') }}"
                                class="flex h-11 items-center justify-center rounded-full border border-slate-200 text-sm font-semibold text-slate-700"
                            >
                                Daftar
                            </a>
                        @endguest
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
