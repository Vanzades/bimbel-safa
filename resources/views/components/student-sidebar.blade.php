@php
    $navigation = [
        [
            'label' => 'Overview',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'student.dashboard',
                    'active' => ['student.dashboard', 'student.dashboard.*'],
                    'icon' => 'dashboard'
                ],
            ],
        ],
        [
            'label' => 'Akademik',
            'items' => [
                [
                    'label' => 'Absensi',
                    'route' => 'student.attendance',
                    'active' => ['student.attendance', 'student.attendance.*'],
                    'icon' => 'attendance'
                ],
                [
                    'label' => 'SPP',
                    'route' => 'student.spp',
                    'active' => ['student.spp', 'student.spp.*'],
                    'icon' => 'spp'
                ],
            ],
        ],
    ];

    $icons = [
        'dashboard'  => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
        'profile'    => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
        'attendance' => '<rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/><path d="m9 16 2 2 4-4"/>',
        'spp'        => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M7 14h4"/><path d="M16 14h1"/><path d="M16 17h1"/>',
    ];

    $logoPath = public_path('image/logo.png');
    $logoUrl = is_file($logoPath) && is_readable($logoPath)
        ? asset('image/logo.png')
        : null;
@endphp

<style>
    :root {
        --student-sidebar-collapsed: 72px;
        --student-sidebar-open: 256px;
        --student-sidebar-ease: cubic-bezier(0.22, 1, 0.36, 1);

        /* 🌞 LIGHT MODE COLORS */
        --student-surface: #ffffff;
        --student-text: #1f2937;
        --student-muted: #62769a;
        --student-icon: #7693b9;
        --student-accent: #2563eb;
        --student-nav-hover: rgba(59, 130, 246, 0.08);
        --student-nav-active-bg: rgba(59, 130, 246, 0.1); /* Flat blue */
        --student-shadow: rgba(15, 23, 42, 0.06);
        --student-danger: #ef4444; /* Pure red */
    }

    /* 🌙 DARK MODE COLORS */
    html.dark,
    @media (prefers-color-scheme: dark) {
        :root {
            --student-surface: #111827;
            --student-text: #f3f4f6;
            --student-muted: #9ca3af;
            --student-icon: #6b7280;
            --student-accent: #3b82f6;
            --student-nav-hover: rgba(59, 130, 246, 0.15);
            --student-nav-active-bg: rgba(59, 130, 246, 0.15); /* Flat blue Dark */
            --student-shadow: rgba(0, 0, 0, 0.3);
            --student-danger: #ef4444;
        }
    }

    #student-overlay {
        background: rgba(15, 17, 20, 0.4);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 260ms ease, visibility 260ms ease;
    }

    #student-sidebar {
        width: var(--student-sidebar-collapsed);
        background: var(--student-surface);
        box-shadow: 8px 0 28px var(--student-shadow);
        color: var(--student-text);
        overflow: hidden;
        transition: width 260ms var(--student-sidebar-ease), transform 260ms var(--student-sidebar-ease);
    }

    html[data-student-sidebar-open="true"] #student-sidebar { width: var(--student-sidebar-open); }
    html[data-student-sidebar-open="false"] #student-sidebar { width: var(--student-sidebar-collapsed); }

    [class~="lg:pl-64"] { padding-left: var(--student-sidebar-collapsed); transition: padding-left 260ms var(--student-sidebar-ease); }
    [class~="lg:ml-64"] { margin-left: var(--student-sidebar-collapsed); transition: margin-left 260ms var(--student-sidebar-ease); }

    html.student-sidebar-scroll-locked,
    html.student-sidebar-scroll-locked body { overflow: hidden; }

    @media (max-width: 1023px) {
        #student-sidebar {
            transform: translateX(-100%);
            width: var(--student-sidebar-open);
        }
        html[data-student-sidebar-open="true"] #student-sidebar { transform: translateX(0); }
        html[data-student-sidebar-open="true"] #student-overlay {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        [class~="lg:pl-64"] { padding-left: 0 !important; }
        [class~="lg:ml-64"] { margin-left: 0 !important; }
    }

    @media (min-width: 1024px) {
        #student-sidebar { transform: none !important; width: var(--student-sidebar-open); }
        [class~="lg:pl-64"] { padding-left: var(--student-sidebar-open); }
        [class~="lg:ml-64"] { margin-left: var(--student-sidebar-open); }
        html[data-student-sidebar-open="false"] [class~="lg:pl-64"] { padding-left: var(--student-sidebar-collapsed); }
        html[data-student-sidebar-open="false"] [class~="lg:ml-64"] { margin-left: var(--student-sidebar-collapsed); }
        html[data-student-sidebar-open="false"] #student-sidebar { width: var(--student-sidebar-collapsed); }
    }

    #student-sidebar .student-brand-wrap {
        position: relative;
        display: flex;
        height: 64px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        padding: 0 8px;
        margin-top: 14px;
    }

    #student-sidebar .student-brand {
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

    #student-sidebar .student-brand-logo {
        width: 112px;
        height: 42px;
        object-fit: contain;
        object-position: center;
        transition: width 260ms var(--student-sidebar-ease);
    }

    #student-sidebar .student-brand-mark {
        display: flex;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--student-accent);
        color: #fff;
        font-weight: 700;
    }

    #student-sidebar .student-sidebar-close {
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
        color: var(--student-icon);
        cursor: pointer;
        transform: translateY(-50%);
    }

    #student-sidebar .student-sidebar-close:hover {
        background: var(--student-nav-hover);
        color: var(--student-accent);
    }

    #student-sidebar .student-menu {
        min-height: 0;
        min-width: 0;
        padding: 24px 12px;
        overflow-x: hidden;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #student-sidebar .student-menu::-webkit-scrollbar { display: none; }
    #student-sidebar .student-nav-section + .student-nav-section { margin-top: 25px; }

    #student-sidebar .student-section-label {
        margin-bottom: 9px;
        padding: 0 15px;
        color: var(--student-muted);
        font-size: 10px;
        font-weight: 600;
        line-height: 16px;
        letter-spacing: 0.12em;
        white-space: nowrap;
        overflow: hidden;
        transition: opacity 160ms ease;
    }

    /* === GRID & UKURAN MENU (SAMAKAN MENU LINK DAN LOGOUT) === */
    #student-sidebar .student-nav-link,
    #student-sidebar .student-logout-button {
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
        min-height: 43px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 500;
        line-height: 20px;
    }

    #student-sidebar .student-nav-link {
        color: var(--student-muted);
    }

    #student-sidebar .student-nav-link > svg,
    #student-sidebar .student-logout-button > svg {
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

    #student-sidebar .student-nav-link > svg {
        color: var(--student-icon);
    }

    #student-sidebar .student-nav-label,
    #student-sidebar .student-logout-label {
        grid-column: 2;
        max-width: 180px;
        min-width: 0;
        overflow: hidden;
        white-space: nowrap;
        opacity: 1;
        transition: max-width 260ms ease, opacity 160ms ease;
    }

    /* === EFEK HOVER & ACTIVE (TANPA GRADIEN) === */
    #student-sidebar .student-nav-link:hover {
        background: var(--student-nav-hover);
        color: var(--student-accent);
    }

    #student-sidebar .student-nav-link:hover > svg,
    #student-sidebar .student-nav-link.is-active > svg {
        color: var(--student-accent);
    }

    #student-sidebar .student-nav-link.is-active {
        background-color: var(--student-nav-active-bg);
        color: var(--student-accent);
        font-weight: 600;
    }

    #student-sidebar .student-nav-link:active,
    #student-sidebar .student-logout-button:active {
        transform: scale(.98);
    }

    #student-sidebar .student-footer {
        padding: 14px 12px 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    #student-sidebar .student-logout-form { margin: 0; }

    /* === TOMBOL LOGOUT TRANSPARAN + MERAH === */
    #student-sidebar .student-logout-button {
        width: 100%;
        border: 0;
        background: transparent;
        box-shadow: none;
        color: var(--student-danger);
        font: inherit;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
    }

    #student-sidebar .student-logout-button > svg {
        color: var(--student-danger);
    }

    #student-sidebar .student-logout-button:hover {
        background: rgba(239, 68, 68, 0.1);
        color: var(--student-danger);
    }

    #student-sidebar .student-logout-button:active {
        background: rgba(239, 68, 68, 0.2);
        transform: scale(.98);
    }

    @media (min-width: 1024px) {
        html[data-student-sidebar-open="false"] #student-sidebar .student-brand-logo { width: 42px; }
        html[data-student-sidebar-open="false"] #student-sidebar .student-sidebar-close { display: none; }
        html[data-student-sidebar-open="false"] #student-sidebar .student-section-label { opacity: 0; }
        html[data-student-sidebar-open="false"] #student-sidebar .student-nav-label,
        html[data-student-sidebar-open="false"] #student-sidebar .student-logout-label {
            max-width: 0;
            opacity: 0;
        }
    }
</style>

<div
    id="student-overlay"
    class="fixed inset-0 z-40 lg:hidden"
    onclick="closeStudentSidebar()"
    aria-hidden="true"
></div>

<aside
    id="student-sidebar"
    class="fixed inset-y-0 left-0 z-50 flex flex-col overflow-hidden"
    aria-label="Navigasi siswa"
>
    <div class="student-brand-wrap">
        <button
            id="student-sidebar-brand"
            type="button"
            class="student-brand"
            onclick="toggleStudentSidebar()"
            aria-controls="student-sidebar"
            aria-expanded="false"
            aria-label="Buka menu siswa"
        >
            @if ($logoUrl !== null)
                <img src="{{ $logoUrl }}" alt="" width="112" height="42" class="student-brand-logo">
            @else
                <span class="student-brand-mark" aria-hidden="true">S</span>
            @endif
        </button>

        <button
            id="student-sidebar-close"
            type="button"
            class="student-sidebar-close"
            onclick="closeStudentSidebar()"
            aria-label="Tutup menu navigasi"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="3" width="18" height="18" rx="3"/>
                <path d="M9 3v18"/>
            </svg>
        </button>
    </div>

    <div class="student-menu flex-1 overflow-y-auto">
        @foreach ($navigation as $section)
            <div class="student-nav-section">
                <div class="student-section-label uppercase">
                    {{ $section['label'] }}
                </div>

                <nav class="space-y-1">
                    @foreach ($section['items'] as $item)
                        @php
                            // Menggunakan parameter array active
                            $active = request()->routeIs($item['active']);
                        @endphp

                        <a
                            href="{{ route($item['route']) }}"
                            title="{{ $item['label'] }}"
                            aria-label="{{ $item['label'] }}"
                            class="student-nav-link {{ $active ? 'is-active' : '' }}"
                            @if ($active) aria-current="page" @endif
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                {!! $icons[$item['icon']] ?? '' !!}
                            </svg>
                            <span class="student-nav-label">
                                {{ $item['label'] }}
                            </span>
                        </a>
                    @endforeach
                </nav>
            </div>
        @endforeach
    </div>

    <div class="student-footer shrink-0">
        @php
            $profileActive = request()->routeIs('student.profile', 'student.profile.*');
        @endphp

        <a
            href="{{ route('student.profile') }}"
            title="Profil"
            aria-label="Profil"
            class="student-nav-link {{ $profileActive ? 'is-active' : '' }}"
            @if ($profileActive) aria-current="page" @endif
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                {!! $icons['profile'] !!}
            </svg>
            <span class="student-nav-label">Profil</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="student-logout-form">
            @csrf

            <button
                type="submit"
                class="student-logout-button"
                aria-label="Keluar"
                title="Keluar"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <path d="m16 17 5-5-5-5"/>
                    <path d="M21 12H9"/>
                </svg>
                <span class="student-logout-label">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    const STUDENT_SIDEBAR_STORAGE_KEY = 'student-sidebar-open';

    function setStudentSidebarState(isOpen, options = {}) {
        const { persist = false } = options;
        const brand = document.getElementById('student-sidebar-brand');
        const closeButton = document.getElementById('student-sidebar-close');
        const isMobile = !window.matchMedia('(min-width: 1024px)').matches;
        const focusWasOnClose = document.activeElement === closeButton;

        document.documentElement.dataset.studentSidebarOpen = String(isOpen);
        document.documentElement.classList.toggle('student-sidebar-scroll-locked', isOpen && isMobile);

        if (persist && !isMobile) {
            try {
                localStorage.setItem(STUDENT_SIDEBAR_STORAGE_KEY, String(isOpen));
            } catch (error) {}
        }

        if (!isOpen && focusWasOnClose) brand?.focus({ preventScroll: true });

        if (brand) {
            brand.setAttribute('aria-expanded', String(isOpen));
            brand.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
        }

        if (closeButton) {
            closeButton.setAttribute('aria-expanded', String(isOpen));
        }
    }

    function openStudentSidebar() {
        setStudentSidebarState(true, { persist: true });
        if (!window.matchMedia('(min-width: 1024px)').matches) {
            const closeBtn = document.getElementById('student-sidebar-close');
            if (closeBtn) closeBtn.focus({ preventScroll: true });
        }
    }

    function closeStudentSidebar() {
        setStudentSidebarState(false, { persist: true });
    }

    function toggleStudentSidebar() {
        const isOpen = document.documentElement.dataset.studentSidebarOpen === 'true';
        if (isOpen) {
            closeStudentSidebar();
        } else {
            openStudentSidebar();
        }
    }

    // Eksekusi segera supaya tidak ada flicker/flash transisi
    (() => {
        const desktop = window.matchMedia('(min-width: 1024px)');

        const getStoredOpenState = () => {
            try {
                const stored = localStorage.getItem(STUDENT_SIDEBAR_STORAGE_KEY);
                return stored === null ? null : stored === 'true';
            } catch (error) {
                return null;
            }
        };

        const initialize = () => {
            if (desktop.matches) {
                const stored = getStoredOpenState();
                setStudentSidebarState(stored === null ? true : stored);
            } else {
                setStudentSidebarState(false, { persist: false });
            }
        };

        initialize();
        desktop.addEventListener('change', initialize);

        document.addEventListener('keydown', (event) => {
            if (desktop.matches || document.documentElement.dataset.studentSidebarOpen !== 'true') return;

            if (event.key === 'Escape') {
                closeStudentSidebar();
                return;
            }
        });
    })();
</script>
