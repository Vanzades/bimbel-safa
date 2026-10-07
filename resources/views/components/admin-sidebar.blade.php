@php
    $navigation = [
        [
            'label' => 'Overview',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'admin.dashboard',
                    'active' => ['admin.dashboard', 'admin.dashboard.*'],
                    'icon' => 'dashboard'
                ],
            ]
        ],
        [
            'label' => 'Master Data',
            'items' => [
                ['label' => 'Akun',        'route' => 'admin.users.index',       'active' => ['admin.users', 'admin.users.*'],             'icon' => 'users'],
                ['label' => 'Guru',        'route' => 'admin.teachers.index',    'active' => ['admin.teachers', 'admin.teachers.*'],       'icon' => 'teacher'],
                ['label' => 'Siswa',       'route' => 'admin.students.index',    'active' => ['admin.students', 'admin.students.*'],       'icon' => 'student'],
                ['label' => 'Kelas',       'route' => 'admin.class-rooms.index', 'active' => ['admin.class-rooms', 'admin.class-rooms.*'], 'icon' => 'class'],
                ['label' => 'Jadwal Kelas','route' => 'admin.schedules.index',   'active' => ['admin.schedules', 'admin.schedules.*'],     'icon' => 'schedule'],
                ['label' => 'SPP',         'route' => 'admin.spp-bills.index',   'active' => ['admin.spp-bills', 'admin.spp-bills.*'],     'icon' => 'spp'],
            ]
        ],
    ];

    $icons = [
        'dashboard' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
        'users'     => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'teacher'   => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/><path d="M8 6h8"/><path d="M8 10h6"/>',
        'student'   => '<path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12.5V16c3 2 9 2 12 0v-3.5"/><path d="M22 10v6"/>',
        'class'     => '<path d="M3 21h18"/><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/><path d="M9 7h6"/><path d="M9 11h6"/><path d="M9 15h6"/>',
        'schedule'  => '<rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/><path d="M8 14h3"/><path d="M8 17h6"/>',
        'spp'       => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M7 14h4"/><path d="M16 14h1"/><path d="M16 17h1"/>',
        'profile'   => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
    ];

    $logoPath = public_path('image/logo.png');
    $logoUrl  = is_file($logoPath) && is_readable($logoPath) ? asset('image/logo.png') : null;
@endphp

<style>
    :root {
        --admin-sidebar-collapsed: 72px;
        --admin-sidebar-open: 256px;
        --admin-sidebar-ease: cubic-bezier(.22, 1, .36, 1);

        /* 🌞 LIGHT MODE COLORS */
        --admin-surface: #ffffff;
        --admin-text: #1f2937;
        --admin-muted: #62769a;
        --admin-icon: #7693b9;
        --admin-accent: #2563eb;
        --admin-nav-hover: rgba(59, 130, 246, 0.08);
        --admin-nav-active-bg: rgba(59, 130, 246, 0.1);
        --admin-shadow: rgba(15, 23, 42, 0.06);
        --admin-danger: #ef4444; /* Merah solid */
    }

    /* 🌙 DARK MODE COLORS */
    html.dark,
    @media (prefers-color-scheme: dark) {
        :root {
            --admin-surface: #111827;
            --admin-text: #f3f4f6;
            --admin-muted: #9ca3af;
            --admin-icon: #6b7280;
            --admin-accent: #3b82f6;
            --admin-nav-hover: rgba(59, 130, 246, 0.15);
            --admin-nav-active-bg: rgba(59, 130, 246, 0.15);
            --admin-shadow: rgba(0, 0, 0, 0.3);
            --admin-danger: #ef4444;
        }
    }

    #admin-overlay {
        background: rgba(15, 17, 20, .4);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 260ms ease, visibility 260ms ease;
    }

    #admin-sidebar {
        width: var(--admin-sidebar-collapsed);
        overflow: hidden;
        background: var(--admin-surface);
        color: var(--admin-text);
        box-shadow: 8px 0 28px var(--admin-shadow);
        transition: width 260ms var(--admin-sidebar-ease), transform 260ms var(--admin-sidebar-ease), background-color 260ms ease;
    }

    html[data-admin-sidebar-open="true"] #admin-sidebar { width: var(--admin-sidebar-open); }
    html[data-admin-sidebar-open="false"] #admin-sidebar { width: var(--admin-sidebar-collapsed); }

    [class~="lg:pl-64"] { padding-left: var(--admin-sidebar-collapsed); transition: padding-left 260ms var(--admin-sidebar-ease); }
    [class~="lg:ml-64"] { margin-left: var(--admin-sidebar-collapsed); transition: margin-left 260ms var(--admin-sidebar-ease); }

    html.admin-sidebar-scroll-locked,
    html.admin-sidebar-scroll-locked body { overflow: hidden; }

    @media (max-width: 1023px) {
        #admin-sidebar {
            width: var(--admin-sidebar-open);
            transform: translateX(-100%);
        }
        html[data-admin-sidebar-open="true"] #admin-sidebar { transform: translateX(0); }
        html[data-admin-sidebar-open="true"] #admin-overlay {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
        [class~="lg:pl-64"] { padding-left: 0 !important; }
        [class~="lg:ml-64"] { margin-left: 0 !important; }
    }

    @media (min-width: 1024px) {
        html[data-admin-sidebar-open="true"] #admin-sidebar { width: var(--admin-sidebar-open); }
        html[data-admin-sidebar-open="true"] [class~="lg:pl-64"] { padding-left: var(--admin-sidebar-open); }
        html[data-admin-sidebar-open="true"] [class~="lg:ml-64"] { margin-left: var(--admin-sidebar-open); }

        html[data-admin-sidebar-open="false"] #admin-sidebar { width: var(--admin-sidebar-collapsed); }
        html[data-admin-sidebar-open="false"] [class~="lg:pl-64"] { padding-left: var(--admin-sidebar-collapsed); }
        html[data-admin-sidebar-open="false"] [class~="lg:ml-64"] { margin-left: var(--admin-sidebar-collapsed); }
    }

    #admin-sidebar .admin-brand-wrap {
        position: relative;
        display: flex;
        height: 64px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        margin-top: 14px;
        padding: 0 8px;
    }

    #admin-sidebar .admin-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: inherit;
        cursor: pointer;
    }

    #admin-sidebar .admin-brand-logo {
        width: 112px;
        height: 42px;
        object-fit: contain;
        object-position: center;
        transition: width 260ms var(--admin-sidebar-ease);
    }

    #admin-sidebar .admin-brand-mark {
        display: flex;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--admin-accent);
        color: #fff;
        font-weight: 700;
    }

    #admin-sidebar .admin-sidebar-close {
        position: absolute;
        top: 50%;
        right: 12px;
        display: inline-flex;
        width: 32px;
        height: 32px;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: var(--admin-icon);
        cursor: pointer;
        transform: translateY(-50%);
    }

    #admin-sidebar .admin-sidebar-close:hover {
        background: var(--admin-nav-hover);
        color: var(--admin-accent);
    }

    #admin-sidebar .admin-menu {
        min-width: 0;
        min-height: 0;
        padding: 24px 12px;
        overflow-x: hidden;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #admin-sidebar .admin-menu::-webkit-scrollbar { display: none; }
    #admin-sidebar .admin-nav-section + .admin-nav-section { margin-top: 25px; }

    #admin-sidebar .admin-section-label {
        margin-bottom: 9px;
        padding: 0 15px;
        overflow: hidden;
        color: var(--admin-muted);
        font-size: 10px;
        font-weight: 600;
        line-height: 16px;
        letter-spacing: .12em;
        white-space: nowrap;
        transition: opacity 160ms ease;
    }

    #admin-sidebar .admin-nav-link,
    #admin-sidebar .admin-logout-button {
        display: grid;
        grid-template-columns: 20px minmax(0, 1fr);
        justify-content: start;
        column-gap: 16px;
        align-items: center;
        min-width: 0;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 10px;
        text-decoration: none;
        transition: background-color 160ms ease, color 160ms ease, transform 140ms ease;
    }

    /* Ukuran disamakan persis antara menu link dan tombol logout */
    #admin-sidebar .admin-nav-link,
    #admin-sidebar .admin-logout-button {
        min-height: 43px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 500;
        line-height: 20px;
    }

    #admin-sidebar .admin-nav-link {
        color: var(--admin-muted);
    }

    #admin-sidebar .admin-nav-link > svg,
    #admin-sidebar .admin-logout-button > svg {
        grid-column: 1;
        justify-self: center;
        align-self: center;
        stroke-linecap: round;
        stroke-linejoin: round;
        width: 18px;
        height: 18px;
        stroke-width: 1.7;
        transition: color 160ms ease;
    }

    #admin-sidebar .admin-nav-link > svg {
        color: var(--admin-icon);
    }

    #admin-sidebar .admin-nav-label,
    #admin-sidebar .admin-logout-label {
        grid-column: 2;
        min-width: 0;
        overflow: hidden;
        opacity: 1;
        white-space: nowrap;
        text-overflow: ellipsis;
        transition: opacity 160ms ease;
    }

    /* HOVER & ACTIVE STATE MENU UTAMA */
    #admin-sidebar .admin-nav-link:hover {
        background: var(--admin-nav-hover);
        color: var(--admin-accent);
    }

    #admin-sidebar .admin-nav-link:hover > svg,
    #admin-sidebar .admin-nav-link.is-active > svg {
        color: var(--admin-accent);
    }

    #admin-sidebar .admin-nav-link.is-active {
        background-color: var(--admin-nav-active-bg);
        color: var(--admin-accent);
        font-weight: 600;
    }

    #admin-sidebar .admin-nav-link:active,
    #admin-sidebar .admin-logout-button:active {
        transform: scale(.98);
    }

    #admin-sidebar .admin-footer {
        flex-shrink: 0;
        padding: 14px 12px 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    #admin-sidebar .admin-logout-form { margin: 0; }

    /* =========================================================
       TOMBOL LOGOUT (MURNI MERAH & TRANSPARAN)
       ========================================================= */
    #admin-sidebar .admin-logout-button {
        width: 100%;
        border: 0;
        background: transparent;
        box-shadow: none;
        color: var(--admin-danger);
        font: inherit;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
    }

    #admin-sidebar .admin-logout-button > svg {
        color: var(--admin-danger);
    }

    #admin-sidebar .admin-logout-button:hover {
        background: rgba(239, 68, 68, 0.1); /* Merah muda transparan murni */
        color: var(--admin-danger);
    }

    #admin-sidebar .admin-logout-button:active {
        background: rgba(239, 68, 68, 0.2);
        transform: scale(.98);
    }

    html[data-admin-sidebar-open="false"] #admin-sidebar .admin-brand-logo { width: 42px; }
    html[data-admin-sidebar-open="false"] #admin-sidebar .admin-sidebar-close { display: none; }
    html[data-admin-sidebar-open="false"] #admin-sidebar .admin-section-label,
    html[data-admin-sidebar-open="false"] #admin-sidebar .admin-nav-label,
    html[data-admin-sidebar-open="false"] #admin-sidebar .admin-logout-label { opacity: 0; }
</style>

<div
    id="admin-overlay"
    class="fixed inset-0 z-40 lg:hidden"
    onclick="closeAdminSidebar()"
    aria-hidden="true"
></div>

<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 flex flex-col" aria-label="Navigasi Admin">
    <div class="admin-brand-wrap">
        <button
            id="admin-sidebar-brand"
            type="button"
            class="admin-brand"
            onclick="toggleAdminSidebar()"
            aria-controls="admin-sidebar"
            aria-expanded="false"
            aria-label="Buka menu admin"
            title="Buka atau tutup menu"
        >
            @if ($logoUrl !== null)
                <img src="{{ $logoUrl }}" alt="" width="112" height="42" class="admin-brand-logo">
            @else
                <span class="admin-brand-mark" aria-hidden="true">S</span>
            @endif
        </button>

        <button
            id="admin-sidebar-close"
            type="button"
            class="admin-sidebar-close"
            onclick="closeAdminSidebar()"
            aria-label="Tutup menu navigasi"
            title="Tutup menu"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="3" width="18" height="18" rx="3"/>
                <path d="M9 3v18"/>
            </svg>
        </button>
    </div>

    <div class="admin-menu flex-1">
        @foreach ($navigation as $section)
            <div class="admin-nav-section">
                <div class="admin-section-label uppercase">{{ $section['label'] }}</div>

                <nav class="space-y-1">
                    @foreach ($section['items'] as $item)
                        @php $active = request()->routeIs($item['active']); @endphp

                        <a href="{{ route($item['route']) }}"
                            title="{{ $item['label'] }}"
                            aria-label="{{ $item['label'] }}"
                            class="admin-nav-link {{ $active ? 'is-active' : '' }}"
                            @if ($active) aria-current="page" @endif
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                {!! $icons[$item['icon']] ?? '' !!}
                            </svg>
                            <span class="admin-nav-label">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        @endforeach
    </div>

    <div class="admin-footer">
        @php
            $profileActive = request()->routeIs('profile.edit', 'profile.*');
            $profileUrl = \Illuminate\Support\Facades\Route::has('profile.edit')
                ? route('profile.edit')
                : url('/profile');
        @endphp

        <a href="{{ $profileUrl }}"
            title="Profil"
            aria-label="Profil"
            class="admin-nav-link {{ $profileActive ? 'is-active' : '' }}"
            @if ($profileActive) aria-current="page" @endif
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                {!! $icons['profile'] !!}
            </svg>
            <span class="admin-nav-label">Profil</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="admin-logout-form">
            @csrf
            <button type="submit" class="admin-logout-button" aria-label="Keluar" title="Keluar">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <path d="m16 17 5-5-5-5"/>
                    <path d="M21 12H9"/>
                </svg>
                <span class="admin-logout-label">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    const ADMIN_SIDEBAR_STORAGE_KEY = 'admin-sidebar-open';

    function setAdminSidebarState(isOpen, options = {}) {
        const { persist = false } = options;
        const brand = document.getElementById('admin-sidebar-brand');
        const closeButton = document.getElementById('admin-sidebar-close');
        const isMobile = !window.matchMedia('(min-width: 1024px)').matches;
        const focusWasOnClose = document.activeElement === closeButton;

        document.documentElement.dataset.adminSidebarOpen = String(isOpen);
        document.documentElement.classList.toggle('admin-sidebar-scroll-locked', isOpen && isMobile);

        if (persist && !isMobile) {
            try {
                localStorage.setItem(ADMIN_SIDEBAR_STORAGE_KEY, String(isOpen));
            } catch (error) {}
        }

        brand?.setAttribute('aria-expanded', String(isOpen));
        brand?.setAttribute('aria-label', isOpen ? 'Tutup menu admin' : 'Buka menu admin');
        closeButton?.setAttribute('aria-expanded', String(isOpen));

        if (!isOpen && focusWasOnClose) {
            brand?.focus({ preventScroll: true });
        }
    }

    function openAdminSidebar() {
        setAdminSidebarState(true, { persist: true });
        if (!window.matchMedia('(min-width: 1024px)').matches) {
            document.getElementById('admin-sidebar-close')?.focus({ preventScroll: true });
        }
    }

    function closeAdminSidebar() {
        setAdminSidebarState(false, { persist: true });
    }

    function toggleAdminSidebar() {
        const isOpen = document.documentElement.dataset.adminSidebarOpen === 'true';
        setAdminSidebarState(!isOpen, { persist: true });
    }

    (() => {
        const desktop = window.matchMedia('(min-width: 1024px)');

        function initializeSidebar() {
            if (desktop.matches) {
                let stored = null;
                try {
                    const value = localStorage.getItem(ADMIN_SIDEBAR_STORAGE_KEY);
                    stored = value === null ? null : value === 'true';
                } catch (error) {}
                setAdminSidebarState(stored === null ? true : stored);
            } else {
                setAdminSidebarState(false);
            }
        }

        initializeSidebar();
        desktop.addEventListener('change', initializeSidebar);

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !desktop.matches && document.documentElement.dataset.adminSidebarOpen === 'true') {
                closeAdminSidebar();
            }
        });
    })();
</script>
