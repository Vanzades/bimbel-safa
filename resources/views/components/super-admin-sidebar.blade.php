<aside
    id="super-admin-sidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-slate-200 bg-white transition-transform duration-300 lg:translate-x-0"
>
    <div class="flex h-20 items-center border-b border-slate-200 px-6">
        <a href="{{ route('super-admin.dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-sm font-bold text-white">
                BS
            </div>

            <div>
                <p class="text-sm font-bold text-slate-900">
                    Bimbel Safa
                </p>

                <p class="text-xs text-slate-500">
                    Super Admin
                </p>
            </div>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-5">
        <div class="space-y-1">
            <a
                href="{{ route('super-admin.dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6" />
                </svg>

                <span>Dashboard</span>
            </a>
        </div>

        <div class="px-4 pb-2 pt-7">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                Monitoring
            </p>
        </div>

        <div class="space-y-1">
            <a
                href="{{ route('super-admin.branches.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.branches.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3 21h18M5 21V6l7-3 7 3v15M9 21v-6h6v6M8 9h1M8 12h1M15 9h1M15 12h1" />
                </svg>

                <span>Cabang</span>
            </a>

            <a
                href="{{ route('super-admin.users.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.users.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>

                <span>Pengguna</span>
            </a>

            <a
                href="{{ route('super-admin.teachers.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.teachers.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 14a6 6 0 00-12 0m12 0H3a6 6 0 0112 0z" />
                </svg>

                <span>Guru</span>
            </a>

            <a
                href="{{ route('super-admin.students.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.students.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M16 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2m6-8a4 4 0 100-8 4 4 0 000 8zm9-1v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>

                <span>Siswa</span>
            </a>

            <a
                href="{{ route('super-admin.teacher-attendance.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.teacher-attendance.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z" />
                </svg>

                <span>Absensi Guru</span>
            </a>

            <a
    href="{{ route('super-admin.salary-slips.index') }}"
    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.salary-slips.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
            d="M12 2.5v19M17 6.5h-7a3 3 0 100 6h4a3 3 0 110 6H7" />
    </svg>

    <span>Penggajian</span>
</a>

            <a
                href="{{ route('super-admin.spp-bills.report') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('super-admin.spp-bills.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 3v18M5 8h14M5 16h14" />
                </svg>

                <span>Laporan SPP</span>
            </a>
        </div>
    </nav>

    <div class="border-t border-slate-200 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-red-50 hover:text-red-600"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M15 8V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-2M10 12h11m0 0l-3-3m3 3l-3 3" />
                </svg>

                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>

<div
    id="super-admin-sidebar-overlay"
    class="fixed inset-0 z-40 hidden bg-slate-900/40 lg:hidden"
></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('super-admin-sidebar');
        const overlay = document.getElementById('super-admin-sidebar-overlay');
        const toggle = document.getElementById('super-admin-menu-toggle');

        if (!sidebar || !overlay || !toggle) {
            return;
        }

        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    });
</script>
