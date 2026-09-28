<script>
    (() => {
        let theme;

        try {
            theme = localStorage.getItem('admin-theme');
        } catch (error) {
        }

        if (theme !== 'light' && theme !== 'dark') {
            theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        document.documentElement.dataset.adminTheme = theme;
        document.documentElement.classList.toggle('dark', theme === 'dark');
    })();
</script>

<style>
    :root {
        --admin-surface: #ffffff;
        --admin-topbar-surface: #F6F6F6;
        --admin-surface-soft: #f6f7f9;
        --admin-border: #e5e7eb;
        --admin-text: #1f2937;
        --admin-muted: #64748b;
        --admin-icon: #7b8798;
        --admin-hover: rgba(15, 23, 42, 0.055);
        --admin-accent: #2563eb;
        --admin-scrollbar: #ccd2dc;
        --admin-shadow: rgba(15, 23, 42, 0.06);
        --admin-nav-hover: rgba(59, 130, 246, 0.08);
        --admin-nav-glass-start: rgba(96, 165, 250, 0.25);
        --admin-nav-glass-end: rgba(59, 130, 246, 0.10);
        --admin-nav-sheen: rgba(255, 255, 255, 0.50);
        --admin-nav-shadow: rgba(37, 99, 235, 0.10);
        --admin-danger-border: #f0cecb;
        --admin-danger-surface: #fff5f4;
        --admin-danger: #b33e36;
    }

    html[data-admin-theme="light"] { color-scheme: light; }

    html[data-admin-theme="dark"] {
        color-scheme: dark;
        --admin-surface: #101215;
        --admin-topbar-surface: #101215;
        --admin-surface-soft: #171a1f;
        --admin-border: #272c35;
        --admin-text: #d3d7df;
        --admin-muted: #a0a7b4;
        --admin-icon: #929ba9;
        --admin-hover: rgba(255, 255, 255, 0.045);
        --admin-accent: #91baff;
        --admin-scrollbar: #444b56;
        --admin-shadow: rgba(0, 0, 0, 0.18);
        --admin-nav-hover: rgba(96, 165, 250, 0.10);
        --admin-nav-glass-start: rgba(73, 134, 235, 0.20);
        --admin-nav-glass-end: rgba(82, 152, 255, 0.11);
        --admin-nav-sheen: rgba(147, 197, 253, 0.08);
        --admin-nav-shadow: rgba(24, 64, 140, 0.18);
        --admin-danger-border: #653e3b;
        --admin-danger-surface: #382523;
        --admin-danger: #ffaca3;
    }

    html[data-admin-theme="dark"] body {
        background-color: #101215;
        color: var(--admin-text);
    }

    html[data-admin-theme="dark"] :is(.bg-white, .bg-slate-50, .bg-gray-50, .bg-zinc-50, .bg-neutral-50) {
        background-color: var(--admin-surface);
    }

    html[data-admin-theme="dark"] :is(.bg-slate-100, .bg-gray-100, .bg-zinc-100, .bg-neutral-100) {
        background-color: var(--admin-surface-soft);
    }

    html[data-admin-theme="dark"] :is(.text-black, .text-slate-950, .text-slate-900, .text-slate-800, .text-gray-950, .text-gray-900, .text-gray-800, .text-zinc-950, .text-zinc-900, .text-zinc-800, .text-neutral-950, .text-neutral-900, .text-neutral-800) {
        color: var(--admin-text);
    }

    html[data-admin-theme="dark"] :is(.text-slate-700, .text-slate-600, .text-slate-500, .text-slate-400, .text-gray-700, .text-gray-600, .text-gray-500, .text-gray-400, .text-zinc-700, .text-zinc-600, .text-zinc-500, .text-zinc-400, .text-neutral-700, .text-neutral-600, .text-neutral-500, .text-neutral-400) {
        color: var(--admin-muted);
    }

    html[data-admin-theme="dark"] :is(.border-slate-100, .border-slate-200, .border-slate-300, .border-gray-100, .border-gray-200, .border-gray-300, .border-zinc-100, .border-zinc-200, .border-zinc-300, .border-neutral-100, .border-neutral-200, .border-neutral-300) {
        border-color: var(--admin-border);
    }

    html[data-admin-theme="dark"] :is(.divide-slate-100, .divide-slate-200, .divide-gray-100, .divide-gray-200) > :not([hidden]) ~ :not([hidden]) {
        border-color: var(--admin-border);
    }

    html[data-admin-theme="dark"] :is(.hover\:bg-slate-50, .hover\:bg-slate-100, .hover\:bg-gray-50, .hover\:bg-gray-100):hover {
        background-color: var(--admin-hover);
    }

    html[data-admin-theme="dark"] :is(input:not([type]), input[type="text"], input[type="email"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="url"], input[type="date"], input[type="datetime-local"], input[type="time"], select, textarea) {
        border-color: var(--admin-border);
        background-color: var(--admin-surface-soft);
        color: var(--admin-text);
    }

    html[data-admin-theme="dark"] :is(input, textarea)::placeholder {
        color: #8d96a5;
        opacity: 1;
    }

    html[data-admin-theme="dark"] :is(input[type="checkbox"], input[type="radio"], input[type="range"]) {
        accent-color: #719bd7;
    }

    #admin-topbar {
        border: 0;
        background: var(--admin-topbar-surface);
        box-shadow: none;
        color: var(--admin-text);
    }

    #admin-topbar .admin-topbar-inner { min-width: 0; }
    #admin-topbar .admin-heading { min-width: 0; }

    #admin-topbar .admin-topbar-actions { flex-shrink: 0; margin-left: auto; }

    #admin-topbar .admin-icon-button {
        display: inline-flex;
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: var(--admin-muted);
        cursor: pointer;
        list-style: none;
        transition: background-color 160ms ease, color 160ms ease;
    }

    /* Pengaturan Responsif Tombol Burger (Muncul di HP, Sembunyi di Laptop) */
    #admin-topbar .admin-burger-btn {
        display: inline-flex;
    }

    @media (min-width: 1024px) {
        #admin-topbar .admin-burger-btn {
            display: none !important;
        }
    }

    #admin-topbar .admin-icon-button:hover,
    #admin-topbar details[open] > .admin-icon-button {
        background: var(--admin-hover);
        color: var(--admin-accent);
    }

    #admin-topbar .admin-account-summary {
        height: 40px;
        gap: 10px;
        padding: 4px 6px;
        border-radius: 11px;
        color: var(--admin-text);
        list-style: none;
    }

    #admin-topbar .admin-account-summary:hover,
    #admin-topbar details[open] > .admin-account-summary { background: var(--admin-hover); }

    #admin-topbar summary::-webkit-details-marker { display: none; }

    #admin-topbar .admin-account-avatar {
        width: 32px;
        height: 32px;
        border: 0;
        border-radius: 10px;
        background: var(--admin-surface-soft);
        color: var(--admin-muted);
    }

    #admin-topbar .admin-account-name { font-size: 13px; }
    #admin-topbar .admin-account-chevron { color: var(--admin-icon); }

    #admin-topbar .admin-dropdown {
        position: absolute;
        top: calc(100% + 13px);
        right: 0;
        z-index: 50;
        width: 256px;
        max-width: calc(100vw - 32px);
        overflow: hidden;
        border: 0;
        border-radius: 14px;
        background: var(--admin-surface);
        box-shadow: 0 12px 32px var(--admin-shadow);
    }

    #admin-topbar .admin-dropdown-heading {
        padding: 15px 16px;
        border: 0;
        color: var(--admin-text);
        font-size: 13px;
        font-weight: 600;
    }

    #admin-topbar .admin-notifications-panel { width: 288px; }

    #admin-topbar .admin-notifications-empty {
        display: flex;
        min-height: 156px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 24px 16px;
        color: var(--admin-muted);
        font-size: 12px;
    }

    #admin-topbar .admin-empty-icon {
        display: flex;
        width: 44px;
        height: 44px;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: var(--admin-hover);
        color: var(--admin-accent);
    }

    #admin-topbar .admin-account-email {
        margin-top: 3px;
        color: var(--admin-muted);
        font-size: 11px;
        font-weight: 400;
    }

    #admin-topbar .admin-profile-link {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 6px;
        padding: 10px;
        border-radius: 9px;
        color: var(--admin-text);
        font-size: 13px;
        text-decoration: none;
    }

    #admin-topbar .admin-profile-link:hover {
        background: var(--admin-hover);
        color: var(--admin-accent);
    }

    #admin-topbar :is(button, summary, a):focus-visible {
        outline: none;
        box-shadow: 0 0 8px 2px var(--admin-accent);
    }

    #admin-topbar .admin-theme-sun { display: none; }
    html[data-admin-theme="dark"] #admin-topbar .admin-theme-moon { display: none; }
    html[data-admin-theme="dark"] #admin-topbar .admin-theme-sun { display: block; }

    @media (max-width: 639px) {
        #admin-topbar .admin-dropdown { max-width: calc(100vw - 104px); }
        #admin-topbar .admin-notifications { position: static; }
        #admin-topbar .admin-notifications-panel { right: 16px; }
        #admin-topbar .admin-topbar-actions { gap: 3px; }
    }

    @media (prefers-reduced-motion: reduce) {
        #admin-topbar .admin-icon-button { transition: none; }
    }
</style>

<header id="admin-topbar" class="sticky top-0 z-30 flex h-16 items-center bg-[#F6F6F6]">
    <div class="admin-topbar-inner flex w-full items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        {{-- Bagian Kiri: Tombol Burger (Otomatis hilang di laptop via CSS .admin-burger-btn) --}}
        <div class="admin-heading flex items-center gap-3">
            <button
                type="button"
                onclick="toggleAdminSidebar()"
                class="admin-icon-button admin-burger-btn"
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

        <div class="admin-topbar-actions flex items-center gap-2">
            <button
                id="admin-theme-toggle"
                type="button"
                class="admin-icon-button"
                aria-label="Aktifkan tema gelap"
                aria-pressed="false"
                title="Aktifkan tema gelap"
            >
                <svg class="admin-theme-moon" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20.9 13.1A9 9 0 0 1 10.9 3.1 9 9 0 1 0 20.9 13.1Z"/>
                </svg>
                <svg class="admin-theme-sun" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2m0 16v2M2 12h2m16 0h2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/>
                </svg>
            </button>

            <details class="admin-notifications relative">
                <summary class="admin-icon-button" aria-label="Notifikasi" title="Notifikasi">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>
                </summary>

                <div class="admin-dropdown admin-notifications-panel">
                    <div class="admin-dropdown-heading">Notifikasi</div>
                    <div class="admin-notifications-empty">
                        <div class="admin-empty-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                                <path d="M10 21h4"/>
                            </svg>
                        </div>
                        <p>Belum ada notifikasi</p>
                    </div>
                </div>
            </details>

            <details class="admin-account relative">
                <summary class="admin-account-summary flex cursor-pointer items-center" aria-label="Menu akun">
                    <div class="admin-account-avatar flex shrink-0 items-center justify-center text-xs font-semibold" aria-hidden="true">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="admin-account-name hidden max-w-32 truncate font-medium lg:block">
                        {{ auth()->user()->name }}
                    </span>
                    <svg class="admin-account-chevron hidden lg:block" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </summary>

                <div class="admin-dropdown">
                    <div class="admin-dropdown-heading">
                        <div class="truncate">{{ auth()->user()->name }}</div>
                        <div class="admin-account-email truncate">{{ auth()->user()->email }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="admin-profile-link">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 21a8 8 0 0 1 16 0"/>
                        </svg>
                        Profil
                    </a>
                </div>
            </details>
        </div>
    </div>
</header>

<script>
    (() => {
        const topbar = document.getElementById('admin-topbar');
        const themeButton = document.getElementById('admin-theme-toggle');
        const root = document.documentElement;

        const updateThemeButton = () => {
            const isDark = root.dataset.adminTheme === 'dark';
            const label = isDark ? 'Aktifkan tema terang' : 'Aktifkan tema gelap';
            themeButton.setAttribute('aria-label', label);
            themeButton.setAttribute('title', label);
            themeButton.setAttribute('aria-pressed', String(isDark));
        };

        updateThemeButton();

        themeButton.addEventListener('click', () => {
            const theme = root.dataset.adminTheme === 'dark' ? 'light' : 'dark';
            root.dataset.adminTheme = theme;
            root.classList.toggle('dark', theme === 'dark');

            try {
                localStorage.setItem('admin-theme', theme);
            } catch (error) {
            }

            updateThemeButton();
        });

        const dropdowns = [...topbar.querySelectorAll('details')];

        dropdowns.forEach((dropdown) => {
            dropdown.addEventListener('toggle', () => {
                if (!dropdown.open) return;

                dropdowns.forEach((other) => {
                    if (other !== dropdown) other.open = false;
                });
            });
        });

        document.addEventListener('click', (event) => {
            dropdowns.forEach((dropdown) => {
                if (!dropdown.contains(event.target)) dropdown.open = false;
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;

            const openDropdown = dropdowns.find((dropdown) => dropdown.open);
            if (!openDropdown) return;

            const focusWasInside = openDropdown.contains(document.activeElement);
            openDropdown.open = false;

            if (focusWasInside) openDropdown.querySelector('summary').focus();
        });
    })();
</script>
