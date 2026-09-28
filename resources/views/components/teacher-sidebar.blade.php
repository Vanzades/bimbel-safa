@props(['teacher'])

@php
    $navigation = [
        [
            'label' => 'Overview',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'teacher.dashboard',
                    'fallback' => '/teacher',
                    'active' => 'teacher.dashboard*',
                    'icon' => 'dashboard',
                ],
            ],
        ],
        [
            'label' => 'Akademik',
            'items' => [
                [
                    'label' => 'Jadwal Mengajar',
                    'route' => 'teacher.schedules.index',
                    'fallback' => '/teacher/schedules',
                    'active' => 'teacher.schedules.*',
                    'icon' => 'schedule',
                ],
                [
                    'label' => 'Absensi',
                    'route' => 'teacher.attendance',
                    'fallback' => '/teacher/attendance',
                    'active' => 'teacher.attendance*',
                    'icon' => 'attendance',
                ],
            ],
        ],
        [
            'label' => 'Account',
            'items' => [
                [
                    'label' => 'Profil',
                    'route' => 'teacher.profile',
                    'fallback' => '/teacher/profile',
                    'active' => 'teacher.profile*',
                    'icon' => 'profile',
                ],
            ],
        ],
    ];

    $icons = [
        'dashboard'  => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
        'schedule'   => '<rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h3M8 17h6"/>',
        'attendance' => '<rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="m9 16 2 2 4-4"/>',
        'profile'    => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
    ];

    $logoPath = public_path('image/logo.png');
    $logoUrl = is_file($logoPath) && is_readable($logoPath)
        ? asset('image/logo.png')
        : null;
@endphp

<style>
    :root {
        --teacher-sidebar-collapsed: 72px;
        --teacher-sidebar-open: 256px;
        --teacher-sidebar-ease: cubic-bezier(.22, 1, .36, 1);
    }

    #teacher-overlay {
        background: rgba(15, 17, 20, .36);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 260ms ease, visibility 260ms ease;
    }

    #teacher-sidebar {
        width: var(--teacher-sidebar-collapsed);
        overflow: hidden;
        background: var(--teacher-surface, #fff);
        color: var(--teacher-text, #1f2937);
        box-shadow: 8px 0 28px rgba(15, 23, 42, .06);
        transition: width 260ms var(--teacher-sidebar-ease), transform 260ms var(--teacher-sidebar-ease);
    }

    html[data-teacher-sidebar-open="true"] #teacher-sidebar {
        width: var(--teacher-sidebar-open);
    }

    html[data-teacher-sidebar-open="false"] #teacher-sidebar {
        width: var(--teacher-sidebar-collapsed);
    }

    [class~="lg:pl-64"] {
        padding-left: var(--teacher-sidebar-collapsed);
        transition: padding-left 260ms var(--teacher-sidebar-ease);
    }

    [class~="lg:ml-64"] {
        margin-left: var(--teacher-sidebar-collapsed);
        transition: margin-left 260ms var(--teacher-sidebar-ease);
    }

    html.teacher-sidebar-scroll-locked,
    html.teacher-sidebar-scroll-locked body {
        overflow: hidden;
    }

    @media (max-width: 1023px) {
        #teacher-sidebar {
            width: var(--teacher-sidebar-open);
            transform: translateX(-100%);
        }

        html[data-teacher-sidebar-open="true"] #teacher-sidebar {
            transform: translateX(0);
        }

        html[data-teacher-sidebar-open="true"] #teacher-overlay {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        [class~="lg:pl-64"] { padding-left: 0 !important; }
        [class~="lg:ml-64"] { margin-left: 0 !important; }
    }

    @media (min-width: 1024px) {
        html[data-teacher-sidebar-open="true"] #teacher-sidebar {
            width: var(--teacher-sidebar-open);
        }

        html[data-teacher-sidebar-open="true"] [class~="lg:pl-64"] {
            padding-left: var(--teacher-sidebar-open);
        }

        html[data-teacher-sidebar-open="true"] [class~="lg:ml-64"] {
            margin-left: var(--teacher-sidebar-open);
        }

        html[data-teacher-sidebar-open="false"] #teacher-sidebar {
            width: var(--teacher-sidebar-collapsed);
        }

        html[data-teacher-sidebar-open="false"] [class~="lg:pl-64"] {
            padding-left: var(--teacher-sidebar-collapsed);
        }

        html[data-teacher-sidebar-open="false"] [class~="lg:ml-64"] {
            margin-left: var(--teacher-sidebar-collapsed);
        }
    }

    #teacher-sidebar .teacher-brand-wrap {
        position: relative;
        display: flex;
        height: 64px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        margin-top: 14px;
        padding: 0 8px;
    }

    #teacher-sidebar .teacher-brand {
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

    #teacher-sidebar .teacher-brand-logo {
        width: 112px;
        height: 42px;
        object-fit: contain;
        object-position: center;
        transition: width 260ms var(--teacher-sidebar-ease);
    }

    #teacher-sidebar .teacher-brand-mark {
        display: flex;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #2563eb;
        color: #fff;
        font-weight: 700;
    }

    #teacher-sidebar .teacher-sidebar-close {
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
        color: var(--teacher-icon, #7693b9);
        cursor: pointer;
        transform: translateY(-50%);
    }

    #teacher-sidebar .teacher-sidebar-close:hover {
        background: var(--teacher-nav-hover, rgba(59, 130, 246, .08));
        color: var(--teacher-accent, #2563eb);
    }

    #teacher-sidebar .teacher-menu {
        min-width: 0;
        min-height: 0;
        padding: 24px 12px;
        overflow-x: hidden;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #teacher-sidebar .teacher-menu::-webkit-scrollbar { display: none; }
    #teacher-sidebar .teacher-nav-section + .teacher-nav-section { margin-top: 25px; }

    #teacher-sidebar .teacher-section-label {
        margin-bottom: 9px;
        padding: 0 15px;
        overflow: hidden;
        color: var(--teacher-muted, #62769a);
        font-size: 10px;
        font-weight: 600;
        line-height: 16px;
        letter-spacing: .12em;
        white-space: nowrap;
        transition: opacity 160ms ease;
    }

    #teacher-sidebar .teacher-nav-link,
    #teacher-sidebar .teacher-logout-button {
        display: grid;
        grid-template-columns: 16px minmax(0, 1fr);
        justify-content: start;
        column-gap: 12px;
        align-items: center;
        min-width: 0;
        box-sizing: border-box;
        overflow: hidden;
        border-radius: 10px;
        text-decoration: none;
        transition: background-color 160ms ease, color 160ms ease, box-shadow 160ms ease, transform 140ms ease;
    }

    #teacher-sidebar .teacher-nav-link {
        min-height: 43px;
        padding: 10px 15px;
        color: var(--teacher-muted, #62769a);
        font-size: 13px;
        font-weight: 500;
        line-height: 20px;
    }

    #teacher-sidebar .teacher-nav-link > svg,
    #teacher-sidebar .teacher-logout-button > svg {
        grid-column: 1;
        justify-self: center;
        align-self: center;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    #teacher-sidebar .teacher-nav-link > svg {
        width: 16px;
        height: 16px;
        color: var(--teacher-icon, #7693b9);
        stroke-width: 1.7;
        transition: color 160ms ease;
    }

    #teacher-sidebar .teacher-nav-label,
    #teacher-sidebar .teacher-logout-label {
        grid-column: 2;
        min-width: 0;
        overflow: hidden;
        opacity: 1;
        white-space: nowrap;
        text-overflow: ellipsis;
        transition: opacity 160ms ease;
    }

    #teacher-sidebar .teacher-nav-link:hover {
        background: var(--teacher-nav-hover, rgba(59, 130, 246, .08));
        color: var(--teacher-accent, #2563eb);
    }

    #teacher-sidebar .teacher-nav-link:hover > svg,
    #teacher-sidebar .teacher-nav-link.is-active > svg {
        color: var(--teacher-accent, #2563eb);
    }

    #teacher-sidebar .teacher-nav-link.is-active,
    #teacher-sidebar .teacher-nav-link:active {
        background:
            linear-gradient(125deg, var(--teacher-nav-sheen, rgba(255, 255, 255, .5)), transparent 55%),
            linear-gradient(115deg, var(--teacher-nav-glass-start, rgba(96, 165, 250, .25)), var(--teacher-nav-glass-end, rgba(59, 130, 246, .1)));
        box-shadow: 0 5px 16px var(--teacher-nav-shadow, rgba(37, 99, 235, .1));
        backdrop-filter: blur(10px) saturate(140%);
        -webkit-backdrop-filter: blur(10px) saturate(140%);
        color: var(--teacher-accent, #2563eb);
        font-weight: 600;
    }

    #teacher-sidebar .teacher-nav-link:active { transform: scale(.98); }

    #teacher-sidebar .teacher-footer {
        flex-shrink: 0;
        padding: 14px 12px 16px;
        overflow: hidden;
    }

    #teacher-sidebar .teacher-logout-form { margin: 0; }

    #teacher-sidebar .teacher-logout-button {
        width: 100%;
        min-height: 40px;
        padding: 9px 15px;
        border: 0;
        background: var(--teacher-surface, #fff);
        box-shadow: 0 3px 12px var(--teacher-shadow, rgba(15, 23, 42, .06));
        color: var(--teacher-muted, #62769a);
        font: inherit;
        font-size: 12px;
        font-weight: 600;
        line-height: 20px;
        cursor: pointer;
        transition: background-color 160ms ease, color 160ms ease;
    }

    #teacher-sidebar .teacher-logout-button:hover {
        background: var(--teacher-danger-surface, #fff5f4);
        color: var(--teacher-danger, #b33e36);
    }

    html[data-teacher-sidebar-open="false"] #teacher-sidebar .teacher-brand-logo {
        width: 42px;
    }

    html[data-teacher-sidebar-open="false"] #teacher-sidebar .teacher-sidebar-close {
        display: none;
    }

    html[data-teacher-sidebar-open="false"] #teacher-sidebar .teacher-section-label,
    html[data-teacher-sidebar-open="false"] #teacher-sidebar .teacher-nav-label,
    html[data-teacher-sidebar-open="false"] #teacher-sidebar .teacher-logout-label {
        opacity: 0;
    }
</style>

<div
    id="teacher-overlay"
    class="fixed inset-0 z-40 lg:hidden"
    onclick="closeTeacherSidebar()"
    aria-hidden="true"
></div>

<aside id="teacher-sidebar" class="fixed inset-y-0 left-0 z-50 flex flex-col" aria-label="Navigasi guru">
    <div class="teacher-brand-wrap">
        <button
            id="teacher-sidebar-brand"
            type="button"
            class="teacher-brand"
            onclick="toggleTeacherSidebar()"
            aria-controls="teacher-sidebar"
            aria-expanded="false"
            aria-label="Buka menu guru"
            title="Buka atau tutup menu"
        >
            @if ($logoUrl !== null)
                <img src="{{ $logoUrl }}" alt="" width="112" height="42" class="teacher-brand-logo">
            @else
                <span class="teacher-brand-mark" aria-hidden="true">G</span>
            @endif
        </button>

        <button
            id="teacher-sidebar-close"
            type="button"
            class="teacher-sidebar-close"
            onclick="closeTeacherSidebar()"
            aria-label="Tutup menu navigasi"
            title="Tutup menu"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="3" width="18" height="18" rx="3"/>
                <path d="M9 3v18"/>
            </svg>
        </button>
    </div>

    <div class="teacher-menu flex-1">
        @foreach ($navigation as $section)
            <div class="teacher-nav-section">
                <div class="teacher-section-label uppercase">{{ $section['label'] }}</div>

                <nav class="space-y-1">
                    @foreach ($section['items'] as $item)
                        @php
                            $active = request()->routeIs($item['active']);
                            $url = \Illuminate\Support\Facades\Route::has($item['route'])
                                ? route($item['route'])
                                : url($item['fallback']);
                        @endphp

                        <a href="{{ $url }}"
                            title="{{ $item['label'] }}"
                            aria-label="{{ $item['label'] }}"
                            class="teacher-nav-link {{ $active ? 'is-active' : '' }}"
                            @if ($active) aria-current="page" @endif
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                {!! $icons[$item['icon']] ?? '' !!}
                            </svg>
                            <span class="teacher-nav-label">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        @endforeach
    </div>

    <div class="teacher-footer">
        <form method="POST" action="{{ route('logout') }}" class="teacher-logout-form">
            @csrf
            <button type="submit" class="teacher-logout-button" aria-label="Keluar" title="Keluar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <path d="m16 17 5-5-5-5"/>
                    <path d="M21 12H9"/>
                </svg>
                <span class="teacher-logout-label">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    const TEACHER_SIDEBAR_STORAGE_KEY = 'teacher-sidebar-open';

    function setTeacherSidebarState(isOpen, options = {}) {
        const { persist = false } = options;
        const brand = document.getElementById('teacher-sidebar-brand');
        const closeButton = document.getElementById('teacher-sidebar-close');
        const isMobile = !window.matchMedia('(min-width: 1024px)').matches;
        const focusWasOnClose = document.activeElement === closeButton;

        document.documentElement.dataset.teacherSidebarOpen = String(isOpen);
        document.documentElement.classList.toggle('teacher-sidebar-scroll-locked', isOpen && isMobile);

        if (persist && !isMobile) {
            try {
                localStorage.setItem(TEACHER_SIDEBAR_STORAGE_KEY, String(isOpen));
            } catch (error) {}
        }

        brand?.setAttribute('aria-expanded', String(isOpen));
        brand?.setAttribute('aria-label', isOpen ? 'Tutup menu guru' : 'Buka menu guru');
        closeButton?.setAttribute('aria-expanded', String(isOpen));

        if (!isOpen && focusWasOnClose) {
            brand?.focus({ preventScroll: true });
        }
    }

    function openTeacherSidebar() {
        setTeacherSidebarState(true, { persist: true });
        if (!window.matchMedia('(min-width: 1024px)').matches) {
            document.getElementById('teacher-sidebar-close')?.focus({ preventScroll: true });
        }
    }

    function closeTeacherSidebar() {
        setTeacherSidebarState(false, { persist: true });
    }

    function toggleTeacherSidebar() {
        const isOpen = document.documentElement.dataset.teacherSidebarOpen === 'true';
        setTeacherSidebarState(!isOpen, { persist: true });
    }

    (() => {
        const desktop = window.matchMedia('(min-width: 1024px)');

        function initializeSidebar() {
            if (desktop.matches) {
                let stored = null;
                try {
                    const value = localStorage.getItem(TEACHER_SIDEBAR_STORAGE_KEY);
                    stored = value === null ? null : value === 'true';
                } catch (error) {}
                setTeacherSidebarState(stored === null ? true : stored);
            } else {
                setTeacherSidebarState(false);
            }
        }

        initializeSidebar();
        desktop.addEventListener('change', initializeSidebar);

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !desktop.matches && document.documentElement.dataset.teacherSidebarOpen === 'true') {
                closeTeacherSidebar();
            }
        });
    })();
</script>
