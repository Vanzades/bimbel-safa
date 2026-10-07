@php
    $currentUser = auth()->user();
    $student = $currentUser?->student ?? $currentUser;
    $studentName = $student?->name ?? 'Siswa';
@endphp

@props(['title' => 'Dashboard Siswa'])

<script>
(() => {
    let theme;
    try {
        theme = localStorage.getItem('student-theme');
    } catch (e) {}

    if (theme !== 'light' && theme !== 'dark') {
        theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    document.documentElement.dataset.studentTheme = theme;
    document.documentElement.classList.toggle('dark', theme === 'dark');
})();
</script>

<style>
    :root {
        --student-surface:#fff; --student-topbar:#F6F6F6; --student-soft:#f6f7f9;
        --student-border:#e5e7eb; --student-text:#1f2937; --student-muted:#64748b;
        --student-accent:#2563eb; --student-hover:rgba(15,23,42,.055);
        --student-shadow:rgba(15,23,42,.08);
    }

    html[data-student-theme="dark"] {
        color-scheme:dark; --student-surface:#101215; --student-topbar:#101215;
        --student-soft:#171a1f; --student-border:#272c35; --student-text:#d3d7df;
        --student-muted:#a0a7b4; --student-accent:#91baff;
        --student-hover:rgba(255,255,255,.045); --student-shadow:rgba(0,0,0,.25);
        --student-icon:#8fa2c2; --student-nav-hover:rgba(145,186,255,.12);
        --student-nav-sheen:rgba(255,255,255,.08); --student-nav-glass-start:rgba(96,165,250,.22);
        --student-nav-glass-end:rgba(59,130,246,.14); --student-nav-shadow:rgba(0,0,0,.35);
        --student-danger:#ff9a90; --student-danger-surface:rgba(255,90,80,.12);
    }

    html[data-student-theme="dark"] body {
        background:#101215;
        color:var(--student-text);
    }

    html[data-student-theme="dark"] :is(.bg-white,.bg-slate-50,.bg-gray-50) {
        background:var(--student-surface);
    }

    html[data-student-theme="dark"] :is(.text-slate-950,.text-slate-900,.text-slate-800,.text-gray-900,.text-gray-800) {
        color:var(--student-text);
    }

    html[data-student-theme="dark"] :is(.text-slate-700,.text-slate-600,.text-slate-500,.text-gray-700,.text-gray-600,.text-gray-500) {
        color:var(--student-muted);
    }

    html[data-student-theme="dark"] :is(.border-slate-100,.border-slate-200,.border-gray-100,.border-gray-200) {
        border-color:var(--student-border);
    }

    html[data-student-theme="dark"] #student-sidebar {
        background:var(--student-surface);
        color:var(--student-text);
    }

    #student-topbar {
        background:var(--student-topbar);
        color:var(--student-text);
        border:0;
        box-shadow:none;
    }

    #student-topbar .student-icon {
        display:inline-flex;
        width:36px;
        height:36px;
        flex:none;
        align-items:center;
        justify-content:center;
        padding:0;
        border:0;
        border-radius:10px;
        background:transparent;
        color:var(--student-muted);
        cursor:pointer;
        list-style:none;
        transition:background-color .16s,color .16s;
    }

    /* Tombol Burger khusus mode HP (mobile), disembunyikan di layar besar (lg ke atas) */
    .student-burger-btn {
        display: inline-flex;
    }

    @media (min-width: 1024px) {
        .student-burger-btn {
            display: none !important;
        }
    }

    #student-topbar .student-icon:hover,
    #student-topbar details[open]>.student-icon,
    #student-topbar .student-account:hover {
        background:var(--student-hover);
        color:var(--student-accent);
    }

    #student-topbar summary::-webkit-details-marker {
        display:none;
    }

    #student-topbar .student-account {
        height:40px;
        gap:10px;
        padding:4px 6px;
        border-radius:11px;
        color:var(--student-text);
        list-style:none;
    }

    #student-topbar .student-avatar {
        width:32px;
        height:32px;
        border-radius:10px;
        background:var(--student-soft);
        color:var(--student-muted);
    }

    #student-topbar .student-dropdown {
        position:absolute;
        top:calc(100% + 13px);
        right:0;
        z-index:50;
        width:256px;
        max-width:calc(100vw - 32px);
        overflow:hidden;
        border-radius:14px;
        background:var(--student-surface);
        box-shadow:0 12px 32px var(--student-shadow);
    }

    #student-topbar .student-dropdown-title {
        padding:15px 16px;
        color:var(--student-text);
        font-size:13px;
        font-weight:600;
    }

    #student-topbar .student-email {
        margin-top:3px;
        color:var(--student-muted);
        font-size:11px;
        font-weight:400;
    }

    #student-topbar .student-profile {
        display:flex;
        align-items:center;
        gap:10px;
        margin:6px;
        padding:10px;
        border-radius:9px;
        color:var(--student-text);
        font-size:13px;
        text-decoration:none;
    }

    #student-topbar .student-profile:hover {
        background:var(--student-hover);
        color:var(--student-accent);
    }

    #student-topbar :is(button,summary,a):focus-visible {
        outline:none;
        box-shadow:0 0 8px 2px var(--student-accent);
    }

    #student-topbar .student-sun {
        display:none;
    }

    html[data-student-theme="dark"] #student-topbar .student-moon {
        display:none;
    }

    html[data-student-theme="dark"] #student-topbar .student-sun {
        display:block;
    }

    @media(max-width:639px) {
        #student-topbar .student-dropdown {
            max-width:calc(100vw - 104px);
        }

        #student-topbar .student-notifications {
            position:static;
        }

        #student-topbar .student-notifications-panel {
            right:16px;
        }
    }
</style>

<header id="student-topbar" class="sticky top-0 z-30 flex h-16 items-center">
    <div class="flex w-full min-w-0 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        {{-- Sisi Kiri: Tombol Burger untuk memunculkan sidebar di mode HP --}}
        <div class="flex items-center">
            <button
                type="button"
                onclick="toggleStudentSidebar()"
                class="student-icon student-burger-btn"
                aria-label="Buka menu navigasi"
                title="Buka menu navigasi"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

        {{-- Sisi Kanan: Theme Toggle, Notifikasi, dan Akun --}}
        <div class="ml-auto flex shrink-0 items-center gap-2">
            <button
                id="student-theme-toggle"
                type="button"
                class="student-icon"
                aria-label="Aktifkan tema gelap"
                aria-pressed="false"
                title="Aktifkan tema gelap"
            >
                <svg class="student-moon" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                    <path d="M20.9 13.1A9 9 0 0 1 10.9 3.1 9 9 0 1 0 20.9 13.1Z"/>
                </svg>
                <svg class="student-sun" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2m0 16v2M2 12h2m16 0h2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M4.93 19.07l-1.42 1.42m11.3-11.3 1.42-1.42"/>
                </svg>
            </button>

            <details class="student-notifications relative">
                @php
                    $unreadNotifications = $currentUser
                        ->unreadNotifications()
                        ->latest()
                        ->take(5)
                        ->get();

                    $unreadCount = $currentUser
                        ->unreadNotifications()
                        ->count();
                @endphp

                <summary class="student-icon relative" aria-label="Notifikasi" title="Notifikasi">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>

                    @if ($unreadCount > 0)
                        <span class="absolute right-0.5 top-0.5 flex min-h-[16px] min-w-[16px] items-center justify-center rounded-full bg-blue-600 px-1 text-[9px] font-bold text-white">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    @endif
                </summary>

                <div class="student-dropdown student-notifications-panel">
                    <div class="flex items-center justify-between border-b border-slate-100">
                        <div class="student-dropdown-title">
                            Notifikasi
                        </div>

                        @if ($unreadCount > 0)
                            <form method="POST" action="{{ route('notifications.read-all') }}" class="mr-2">
                                @csrf
                                <button
                                    type="submit"
                                    class="text-[11px] font-semibold text-blue-600 hover:text-blue-700"
                                >
                                    Tandai dibaca
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="max-h-[320px] overflow-y-auto">
                        @forelse ($unreadNotifications as $notification)
                            @php
                                $data = $notification->data;
                            @endphp

                            <form
                                method="POST"
                                action="{{ route('notifications.read', $notification->id) }}"
                            >
                                @csrf
                                <button
                                    type="submit"
                                    class="flex w-full gap-3 border-b border-slate-100 px-4 py-3 text-left transition hover:bg-slate-50"
                                >
                                    <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-blue-600"></span>

                                    <span class="min-w-0 flex-1">
                                        <span class="block truncate text-xs font-semibold text-slate-900">
                                            {{ $data['title'] ?? 'Notifikasi' }}
                                        </span>

                                        <span class="mt-1 block text-xs leading-5 text-slate-500">
                                            {{ $data['message'] ?? '' }}
                                        </span>

                                        <span class="mt-1.5 block text-[10px] text-slate-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </span>
                                </button>
                            </form>
                        @empty
                            <div class="flex min-h-36 flex-col items-center justify-center gap-3 px-4 py-6 text-xs text-slate-500">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                                    <path d="M10 21h4"/>
                                </svg>
                                <p>Belum ada notifikasi</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="border-t border-slate-100 bg-slate-50 px-4 py-3 text-center">
                        <a
                            href="{{ route('notifications.index') }}"
                            class="text-xs font-semibold text-blue-600 hover:text-blue-700"
                        >
                            Lihat semua notifikasi
                        </a>
                    </div>
                </div>
            </details>

            <div class="student-account flex items-center">
                <span class="student-avatar flex shrink-0 items-center justify-center text-xs font-semibold" aria-hidden="true">
                    {{ strtoupper(substr($studentName, 0, 1)) }}
                </span>
                <span class="hidden max-w-32 truncate text-[13px] font-medium lg:block">
                    {{ $studentName }}
                </span>
            </div>
        </div>
    </div>
</header>

<script>
(() => {
    const topbar = document.getElementById('student-topbar');
    const button = document.getElementById('student-theme-toggle');
    const root = document.documentElement;

    if (!topbar || !button) return;

    function updateButton() {
        const dark = root.dataset.studentTheme === 'dark';
        const label = dark ? 'Aktifkan tema terang' : 'Aktifkan tema gelap';

        button.setAttribute('aria-label', label);
        button.setAttribute('title', label);
        button.setAttribute('aria-pressed', String(dark));
    }

    updateButton();

    button.addEventListener('click', () => {
        const theme = root.dataset.studentTheme === 'dark' ? 'light' : 'dark';

        root.dataset.studentTheme = theme;
        root.classList.toggle('dark', theme === 'dark');

        try {
            localStorage.setItem('student-theme', theme);
        } catch (e) {}

        updateButton();
    });

    const dropdowns = [...topbar.querySelectorAll('details')];

    dropdowns.forEach((item) => item.addEventListener('toggle', () => {
        if (item.open) {
            dropdowns.forEach((other) => {
                if (other !== item) other.open = false;
            });
        }
    }));

    document.addEventListener('click', (event) => dropdowns.forEach((item) => {
        if (!item.contains(event.target)) item.open = false;
    }));

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;

        const open = dropdowns.find((item) => item.open);
        if (!open) return;

        const focused = open.contains(document.activeElement);
        open.open = false;

        if (focused) open.querySelector('summary')?.focus();
    });
})();
</script>
