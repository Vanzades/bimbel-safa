@props(['teacher', 'title' => 'Dashboard Guru'])

<script>
(() => {
    let theme;
    try {
        theme = localStorage.getItem('teacher-theme');
    } catch (error) {}

    if (theme !== 'light' && theme !== 'dark') {
        theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    document.documentElement.dataset.teacherTheme = theme;
    document.documentElement.classList.toggle('dark', theme === 'dark');
})();
</script>

<style>
    :root {
        --teacher-surface:#fff;
        --teacher-topbar:#F6F6F6;
        --teacher-soft:#f6f7f9;
        --teacher-border:#e5e7eb;
        --teacher-text:#1f2937;
        --teacher-muted:#64748b;
        --teacher-accent:#2563eb;
        --teacher-hover:rgba(15,23,42,.055);
        --teacher-shadow:rgba(15,23,42,.08);
        --teacher-icon:#7693b9;
    }

    html[data-teacher-theme="dark"] {
        color-scheme:dark;
        --teacher-surface:#101215;
        --teacher-topbar:#101215;
        --teacher-soft:#171a1f;
        --teacher-border:#272c35;
        --teacher-text:#d3d7df;
        --teacher-muted:#a0a7b4;
        --teacher-accent:#91baff;
        --teacher-hover:rgba(255,255,255,.045);
        --teacher-shadow:rgba(0,0,0,.25);
        --teacher-icon:#8fa2c2;
    }

    #teacher-topbar {
        background: var(--teacher-topbar);
        color: var(--teacher-text);
        border: 0;
        box-shadow: none;
    }

    #teacher-topbar .teacher-icon {
        display: inline-flex;
        width: 36px;
        height: 36px;
        flex: none;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: var(--teacher-muted);
        cursor: pointer;
        transition: background-color .16s, color .16s;
    }

    /* Tombol burger hanya tampil di mobile/tablet, tersembunyi di layar besar (lg) */
    #teacher-topbar .teacher-burger-btn {
        display: inline-flex;
    }

    @media (min-width: 1024px) {
        #teacher-topbar .teacher-burger-btn {
            display: none !important;
        }
    }

    #teacher-topbar .teacher-icon:hover,
    #teacher-topbar details[open] > .teacher-icon,
    #teacher-topbar .teacher-account:hover {
        background: var(--teacher-hover);
        color: var(--teacher-accent);
    }

    #teacher-topbar summary::-webkit-details-marker { display:none; }

    #teacher-topbar .teacher-account {
        height: 40px;
        gap: 10px;
        padding: 4px 6px;
        border-radius: 11px;
        color: var(--teacher-text);
        list-style: none;
    }

    #teacher-topbar .teacher-avatar {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: var(--teacher-soft);
        color: var(--teacher-muted);
    }

    #teacher-topbar .teacher-dropdown {
        position: absolute;
        top: calc(100% + 13px);
        right: 0;
        z-index: 50;
        width: 256px;
        max-width: calc(100vw - 32px);
        overflow: hidden;
        border: 1px solid var(--teacher-border);
        border-radius: 14px;
        background: var(--teacher-surface);
        box-shadow: 0 12px 32px var(--teacher-shadow);
    }

    #teacher-topbar .teacher-dropdown-title {
        padding: 15px 16px;
        color: var(--teacher-text);
        font-size: 13px;
        font-weight: 600;
    }

    #teacher-topbar .teacher-email {
        margin-top: 3px;
        color: var(--teacher-muted);
        font-size: 11px;
        font-weight: 400;
    }

    #teacher-topbar .teacher-profile,
    #teacher-topbar .teacher-logout {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 6px;
        padding: 10px;
        border: 0;
        border-radius: 9px;
        background: transparent;
        color: var(--teacher-text);
        font: inherit;
        font-size: 13px;
        text-align: left;
        text-decoration: none;
        cursor: pointer;
    }

    #teacher-topbar .teacher-profile:hover,
    #teacher-topbar .teacher-logout:hover {
        background: var(--teacher-hover);
        color: var(--teacher-accent);
    }

    #teacher-topbar .teacher-sun { display: none; }
    html[data-teacher-theme="dark"] #teacher-topbar .teacher-moon { display: none; }
    html[data-teacher-theme="dark"] #teacher-topbar .teacher-sun { display: block; }
</style>

<header id="teacher-topbar" class="sticky top-0 z-30 flex h-16 items-center">
    <div class="flex w-full min-w-0 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <!-- Bagian Kiri: Tombol Burger untuk membuka sidebar di HP -->
        <div class="flex items-center gap-3">
            <button
                type="button"
                onclick="toggleTeacherSidebar()"
                class="teacher-icon teacher-burger-btn"
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

        <!-- Bagian Kanan: Aksi (Tema, Notifikasi, Akun) -->
        <div class="flex shrink-0 items-center gap-2">
            <button
                id="teacher-theme-toggle"
                type="button"
                class="teacher-icon"
                aria-label="Aktifkan tema gelap"
                aria-pressed="false"
                title="Aktifkan tema gelap"
            >
                <svg class="teacher-moon" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                    <path d="M20.9 13.1A9 9 0 0 1 10.9 3.1 9 9 0 1 0 20.9 13.1Z"/>
                </svg>
                <svg class="teacher-sun" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2m0 16v2M2 12h2m16 0h2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/>
                </svg>
            </button>

            <details class="teacher-notifications relative">
                <summary class="teacher-icon" aria-label="Notifikasi" title="Notifikasi">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>
                </summary>

                <div class="teacher-dropdown teacher-notifications-panel">
                    <div class="teacher-dropdown-title">Notifikasi</div>
                    <div class="flex min-h-36 flex-col items-center justify-center gap-3 px-4 py-6 text-xs" style="color:var(--teacher-muted)">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>
                        <p>Belum ada notifikasi</p>
                    </div>
                </div>
            </details>

            <details class="relative">
                <summary class="teacher-account flex cursor-pointer items-center" aria-label="Menu akun">
                    <span class="teacher-avatar flex shrink-0 items-center justify-center text-xs font-semibold" aria-hidden="true">
                        {{ strtoupper(substr($teacher->name, 0, 1)) }}
                    </span>
                    <span class="hidden max-w-32 truncate text-[13px] font-medium lg:block">
                        {{ $teacher->name }}
                    </span>
                    <svg class="hidden lg:block" style="color:var(--teacher-muted)" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </summary>

                <div class="teacher-dropdown">
                    <div class="teacher-dropdown-title">
                        <div class="truncate">{{ $teacher->name }}</div>
                        <div class="teacher-email truncate">{{ auth()->user()?->email ?? '' }}</div>
                    </div>

                    @if (\Illuminate\Support\Facades\Route::has('teacher.profile'))
                        <a href="{{ route('teacher.profile') }}" class="teacher-profile">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21a8 8 0 0 1 16 0"/>
                            </svg>
                            Profil
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="teacher-logout w-full">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <path d="m16 17 5-5-5-5"/>
                                <path d="M21 12H9"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </details>
        </div>
    </div>
</header>

<script>
(() => {
    const topbar = document.getElementById('teacher-topbar');
    const button = document.getElementById('teacher-theme-toggle');
    const root = document.documentElement;

    if (!topbar || !button) return;

    function updateButton() {
        const dark = root.dataset.teacherTheme === 'dark';
        const label = dark ? 'Aktifkan tema terang' : 'Aktifkan tema gelap';
        button.setAttribute('aria-label', label);
        button.setAttribute('title', label);
        button.setAttribute('aria-pressed', String(dark));
    }

    updateButton();

    button.addEventListener('click', () => {
        const theme = root.dataset.teacherTheme === 'dark' ? 'light' : 'dark';
        root.dataset.teacherTheme = theme;
        root.classList.toggle('dark', theme === 'dark');

        try {
            localStorage.setItem('teacher-theme', theme);
        } catch (error) {}

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
