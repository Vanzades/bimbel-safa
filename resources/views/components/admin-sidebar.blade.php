@php
    $navigation = [
        ['label' => 'Overview', 'items' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'dashboard'],
        ]],
        ['label' => 'Master Data', 'items' => [
            ['label' => 'Akun',        'route' => 'admin.users.index',       'icon' => 'users'],
            ['label' => 'Guru',        'route' => 'admin.teachers.index',    'icon' => 'teacher'],
            ['label' => 'Siswa',       'route' => 'admin.students.index',    'icon' => 'student'],
            ['label' => 'Kelas',       'route' => 'admin.class-rooms.index', 'icon' => 'class'],
            ['label' => 'Jadwal Kelas', 'route' => 'admin.schedules.index',   'icon' => 'schedule'],
            ['label' => 'SPP',          'route' => 'admin.spp-bills.index',   'icon' => 'spp'],
        ]],
        ['label' => 'Account', 'items' => [
            ['label' => 'Profil', 'route' => 'profile.edit', 'icon' => 'profile'],
        ]],
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
    :root { --sidebar-collapsed: 72px; --sidebar-open: 256px; --sidebar-ease: cubic-bezier(0.22, 1, 0.36, 1); }

    #admin-overlay {
        background: rgba(15, 17, 20, 0.36);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 260ms ease, visibility 260ms ease;
    }

    #admin-sidebar {
        width: var(--sidebar-collapsed);
        background: var(--admin-surface, #ffffff);
        box-shadow: 8px 0 28px var(--admin-shadow, rgba(15, 23, 42, 0.06));
        color: var(--admin-text, #1f2937);
        overflow: hidden;
        transition: width 260ms var(--sidebar-ease);
    }

    html[data-admin-sidebar-open="true"] #admin-sidebar { width: var(--sidebar-open); }
    html[data-admin-sidebar-open="false"] #admin-sidebar { width: var(--sidebar-collapsed); }

    [class~="lg:pl-64"] { padding-left: var(--sidebar-collapsed); transition: padding-left 260ms var(--sidebar-ease); }
    [class~="lg:ml-64"] { margin-left: var(--sidebar-collapsed); transition: margin-left 260ms var(--sidebar-ease); }

    html.admin-sidebar-scroll-locked,
    html.admin-sidebar-scroll-locked body { overflow: hidden; }

    @media (max-width: 1023px) {
        /* Di HP, saat tertutup sidebar bergeser keluar layar atau tetap tersembunyi lewat transform/width */
        html[data-admin-sidebar-open="false"] #admin-sidebar { transform: translateX(-100%); width: var(--sidebar-open); }
        html[data-admin-sidebar-open="true"] #admin-sidebar { transform: translateX(0); width: var(--sidebar-open); }
        html[data-admin-sidebar-open="true"] #admin-overlay { opacity: 1; visibility: visible; pointer-events: auto; }

        [class~="lg:pl-64"] { padding-left: 0 !important; }
        [class~="lg:ml-64"] { margin-left: 0 !important; }
    }

    @media (min-width: 1024px) {
        #admin-sidebar { width: var(--sidebar-open); transform: none !important; }
        [class~="lg:pl-64"] { padding-left: var(--sidebar-open); }
        [class~="lg:ml-64"] { margin-left: var(--sidebar-open); }
        html[data-admin-sidebar-open="false"] [class~="lg:pl-64"] { padding-left: var(--sidebar-collapsed); }
        html[data-admin-sidebar-open="false"] [class~="lg:ml-64"] { margin-left: var(--sidebar-collapsed); }
    }

    #admin-sidebar .admin-brand-wrap {
        position: relative;
        display: flex;
        height: 64px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        padding: 0 8px;
        margin-top: 14px;
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
        transition: width 260ms var(--sidebar-ease);
    }

    #admin-sidebar .admin-brand-mark {
        display: flex;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--admin-accent, #2563eb);
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
        color: var(--admin-muted, #62769a);
        cursor: pointer;
        transform: translateY(-50%);
    }

    #admin-sidebar .admin-sidebar-close:hover {
        background: var(--admin-hover, rgba(59, 130, 246, 0.08));
        color: var(--admin-accent, #2563eb);
    }

    #admin-sidebar .admin-menu {
        min-height: 0;
        min-width: 0;
        padding: 24px 12px;
        overflow-x: hidden;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #admin-sidebar .admin-menu::-webkit-scrollbar { display: none; width: 0; height: 0; }
    #admin-sidebar .admin-nav-section + .admin-nav-section { margin-top: 25px; }

    #admin-sidebar .admin-section-label {
        margin-bottom: 9px;
        padding: 0 15px;
        color: var(--admin-muted, #62769a);
        font-size: 10px;
        font-weight: 600;
        line-height: 16px;
        letter-spacing: 0.12em;
        white-space: nowrap;
        overflow: hidden;
        transition: opacity 160ms ease;
    }

    #admin-sidebar .admin-nav-link {
        display: flex;
        min-height: 43px;
        min-width: 0;
        align-items: center;
        gap: 12px;
        padding: 10px 15px;
        border-radius: 10px;
        color: var(--admin-muted, #62769a);
        font-size: 13px;
        font-weight: 500;
        line-height: 20px;
        text-decoration: none;
        overflow: hidden;
        transition: background-color 160ms ease, color 160ms ease, box-shadow 160ms ease, transform 140ms ease;
    }

    #admin-sidebar .admin-nav-link > svg,
    #admin-sidebar .admin-logout-button > svg {
        flex: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: color 160ms ease;
    }

    #admin-sidebar .admin-nav-link > svg {
        width: 16px;
        height: 16px;
        color: var(--admin-icon, #7693b9);
        stroke-width: 1.7;
    }

    #admin-sidebar .admin-nav-label,
    #admin-sidebar .admin-logout-label {
        max-width: 180px;
        min-width: 0;
        overflow: hidden;
        white-space: nowrap;
        opacity: 1;
        transition: max-width 260ms ease, opacity 160ms ease;
    }

    #admin-sidebar .admin-nav-link:hover {
        background: var(--admin-nav-hover, rgba(59, 130, 246, 0.08));
        color: var(--admin-accent, #2563eb);
    }

    #admin-sidebar .admin-nav-link:hover > svg,
    #admin-sidebar .admin-nav-link.is-active > svg { color: var(--admin-accent, #2563eb); }

    #admin-sidebar .admin-nav-link.is-active,
    #admin-sidebar .admin-nav-link:active {
        background:
            linear-gradient(125deg, var(--admin-nav-sheen, rgba(255, 255, 255, 0.50)), transparent 55%),
            linear-gradient(115deg, var(--admin-nav-glass-start, rgba(96, 165, 250, 0.25)), var(--admin-nav-glass-end, rgba(59, 130, 246, 0.10)));
        box-shadow: 0 5px 16px var(--admin-nav-shadow, rgba(37, 99, 235, 0.10));
        backdrop-filter: blur(10px) saturate(140%);
        -webkit-backdrop-filter: blur(10px) saturate(140%);
        color: var(--admin-accent, #2563eb);
        font-weight: 600;
    }

    #admin-sidebar .admin-footer { padding: 14px 12px 16px; overflow: hidden; }
    #admin-sidebar .admin-logout-form { margin: 0; }

    #admin-sidebar .admin-logout-button {
        display: flex;
        width: 100%;
        min-height: 40px;
        min-width: 0;
        align-items: center;
        gap: 12px;
        padding: 9px 16px;
        border: 0;
        border-radius: 10px;
        background: var(--admin-surface, #ffffff);
        box-shadow: 0 3px 12px var(--admin-shadow, rgba(15, 23, 42, 0.06));
        color: var(--admin-muted, #62769a);
        font: inherit;
        font-size: 12px;
        font-weight: 600;
        line-height: 20px;
        cursor: pointer;
        overflow: hidden;
        transition: background-color 160ms ease, color 160ms ease;
    }

    #admin-sidebar .admin-logout-button:hover {
        background: var(--admin-danger-surface, #fff5f4);
        color: var(--admin-danger, #b33e36);
    }

    @media (min-width: 1024px) {
        html[data-admin-sidebar-open="false"] #admin-sidebar .admin-brand-logo { width: 42px; }
        html[data-admin-sidebar-open="false"] #admin-sidebar .admin-sidebar-close { display: none; }
        html[data-admin-sidebar-open="false"] #admin-sidebar .admin-section-label { opacity: 0; }
        html[data-admin-sidebar-open="false"] #admin-sidebar .admin-nav-label,
        html[data-admin-sidebar-open="false"] #admin-sidebar .admin-logout-label {
            max-width: 0;
            opacity: 0;
        }
    }
</style>

<div id="admin-overlay" class="fixed inset-0 z-40 lg:hidden" onclick="closeAdminSidebar()" aria-hidden="true"></div>

<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 flex flex-col overflow-hidden" aria-label="Navigasi Safa Bimbel">
    <div class="admin-brand-wrap">
        <button
            id="admin-sidebar-brand"
            type="button"
            class="admin-brand"
            onclick="toggleAdminSidebar()"
            aria-controls="admin-sidebar"
            aria-expanded="false"
            aria-label="Buka menu Safa Bimbel"
        >
            @if ($logoUrl !== null)
                <img src="{{ $logoUrl }}" alt="" width="112" height="42" class="admin-brand-logo">
            @else
                <span class="admin-brand-mark" aria-hidden="true">S</span>
            @endif
        </button>

        <button id="admin-sidebar-close" type="button" class="admin-sidebar-close" onclick="closeAdminSidebar()" aria-label="Tutup menu navigasi">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="3" width="18" height="18" rx="3"/>
                <path d="M9 3v18"/>
            </svg>
        </button>
    </div>

    <div class="admin-menu flex-1 overflow-y-auto">
        @foreach ($navigation as $section)
            <div class="admin-nav-section">
                <div class="admin-section-label uppercase">{{ $section['label'] }}</div>

                <nav class="space-y-1">
                    @foreach ($section['items'] as $item)
                        @php $active = request()->routeIs($item['route']); @endphp

                        <a
                            href="{{ route($item['route']) }}"
                            title="{{ $item['label'] }}"
                            aria-label="{{ $item['label'] }}"
                            class="admin-nav-link {{ $active ? 'is-active' : '' }}"
                            @if ($active) aria-current="page" @endif
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">{!! $icons[$item['icon']] ?? '' !!}</svg>
                            <span class="admin-nav-label">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        @endforeach
    </div>

    <div class="admin-footer shrink-0">
        <form method="POST" action="{{ route('logout') }}" class="admin-logout-form">
            @csrf

            <button type="submit" class="admin-logout-button" aria-label="Logout" title="Logout">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <path d="m16 17 5-5-5-5"/>
                    <path d="M21 12H9"/>
                </svg>
                <span class="admin-logout-label">Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    const ADMIN_SIDEBAR_STORAGE_KEY = 'admin-sidebar-open';

    function setAdminSidebarState(isOpen, options = {}) {
        const { persist = false } = options;
        const toggle = document.getElementById('admin-sidebar-toggle');
        const openers = document.getElementById('admin-sidebar-openers');
        const brand = document.getElementById('admin-sidebar-brand');
        const closeButton = document.getElementById('admin-sidebar-close');
        const isMobile = !window.matchMedia('(min-width: 1024px)').matches;
        const focusWasOnClose = document.activeElement === closeButton;
        const focusWasOnOpener = openers && openers.contains(document.activeElement);

        document.documentElement.dataset.adminSidebarOpen = String(isOpen);
        document.documentElement.classList.toggle('admin-sidebar-scroll-locked', isOpen && isMobile);

        if (persist && !isMobile) {
            try {
                localStorage.setItem(ADMIN_SIDEBAR_STORAGE_KEY, String(isOpen));
            } catch (error) {}
        }

        if (!isOpen && focusWasOnClose) (toggle || brand)?.focus({ preventScroll: true });

        if (toggle) toggle.setAttribute('aria-expanded', String(isOpen));

        if (brand) {
            brand.setAttribute('aria-expanded', String(isOpen));
            brand.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
        }

        if (closeButton) {
            closeButton.setAttribute('aria-expanded', String(isOpen));
            if (isOpen && focusWasOnOpener) closeButton.focus({ preventScroll: true });
        }
    }

    function openAdminSidebar() {
        setAdminSidebarState(true, { persist: true });

        if (!window.matchMedia('(min-width: 1024px)').matches) {
            const closeBtn = document.getElementById('admin-sidebar-close');
            if (closeBtn) closeBtn.focus({ preventScroll: true });
        }
    }

    function closeAdminSidebar() {
        setAdminSidebarState(false, { persist: true });
    }

    function toggleAdminSidebar() {
        const isOpen = document.documentElement.dataset.adminSidebarOpen === 'true';
        if (isOpen) {
            closeAdminSidebar();
        } else {
            openAdminSidebar();
        }
    }

    (() => {
        const desktop = window.matchMedia('(min-width: 1024px)');

        const getStoredOpenState = () => {
            try {
                const stored = localStorage.getItem(ADMIN_SIDEBAR_STORAGE_KEY);
                return stored === null ? null : stored === 'true';
            } catch (error) {
                return null;
            }
        };

        const initialize = () => {
            if (desktop.matches) {
                const stored = getStoredOpenState();
                setAdminSidebarState(stored === null ? true : stored);
            } else {
                setAdminSidebarState(false, { persist: false });
            }
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initialize, { once: true });
        } else {
            initialize();
        }

        desktop.addEventListener('change', initialize);

        document.addEventListener('keydown', (event) => {
            if (desktop.matches || document.documentElement.dataset.adminSidebarOpen !== 'true') return;

            if (event.key === 'Escape') {
                closeAdminSidebar();
                return;
            }

            if (event.key !== 'Tab') return;

            const sidebar = document.getElementById('admin-sidebar');
            if (!sidebar) return;

            const controls = [...sidebar.querySelectorAll('a[href], button:not([disabled])')];
            if (controls.length === 0) return;

            const first = controls[0];
            const last = controls[controls.length - 1];
            const outside = !sidebar.contains(document.activeElement);

            if (event.shiftKey && (document.activeElement === first || outside)) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && (document.activeElement === last || outside)) {
                event.preventDefault();
                first.focus();
            }
        });
    })();
</script>
