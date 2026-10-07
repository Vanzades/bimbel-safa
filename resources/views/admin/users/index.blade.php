<x-admin-layout>
    <x-slot name="title">
        Akun
    </x-slot>

    @php
        $roleStyles = [
            'admin' => [
                'label' => 'Admin',
                'badge' => 'bg-purple-100/80 dark:bg-purple-500/20',
            ],
            'guru' => [
                'label' => 'Guru',
                'badge' => 'bg-indigo-100/80 dark:bg-indigo-500/20',
            ],
            'siswa' => [
                'label' => 'Siswa',
                'badge' => 'bg-emerald-100/80 dark:bg-emerald-500/20',
            ],
        ];

        $isFiltering = request()->filled('search') || request()->filled('role');

        $th = 'px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
        $td = 'px-6 py-4 text-xs sm:text-sm';
        $iconBtn = 'w-8 h-8 inline-flex items-center justify-center rounded-lg transition-colors duration-150';

        // Ringkasan "Showing X – Y of Z records" (mendukung paginator Laravel maupun collection biasa)
        $isPaginator = method_exists($users, 'firstItem');
        $showTotal = $isPaginator ? $users->total() : count($users);
        $showFrom = $isPaginator ? ($users->firstItem() ?? 0) : ($showTotal > 0 ? 1 : 0);
        $showTo = $isPaginator ? ($users->lastItem() ?? 0) : min(10, $showTotal);
    @endphp

    <div class="-mt-3 pt-0 pb-4 lg:-mt-4 lg:pb-6 min-h-screen transition-colors duration-150"
        style="background-color: var(--admin-bg); color: var(--admin-text);">
        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-6">
            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3"
                style="color: var(--admin-muted);">
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">Akun</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">Akun</h1>
                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Kelola akun Admin, Guru, dan Siswa.
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">
                    <div class="font-semibold mb-1">Terjadi kesalahan.</div>

                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-2xl p-5 sm:p-6 shadow-sm"
                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                <form method="GET" action="{{ route('admin.users.index') }}"
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                        <div class="relative w-full sm:w-64 sm:shrink-0">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"
                                style="color: var(--admin-icon);">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="m21 21-4.3-4.3"/>
                                </svg>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama atau email..."
                                class="box-border w-full h-9 pl-10 pr-3 rounded-lg text-xs sm:text-[13px] outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">
                        </div>

                        <div id="role-filter-dropdown" class="relative w-full sm:w-36 sm:shrink-0">
                            <input type="hidden" name="role" value="{{ request('role') }}">

                            <button
                                id="role-filter-toggle"
                                type="button"
                                aria-haspopup="listbox"
                                aria-expanded="false"
                                class="box-border flex w-full h-9 items-center justify-between px-3 rounded-lg text-xs sm:text-[13px] font-medium outline-none transition-colors duration-150"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                <span id="role-filter-label">
                                    @if (request('role') === 'admin')
                                        Admin
                                    @elseif (request('role') === 'guru')
                                        Guru
                                    @elseif (request('role') === 'siswa')
                                        Siswa
                                    @else
                                        Semua Role
                                    @endif
                                </span>

                                <svg class="w-4 h-4 shrink-0 ml-2" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>

                            <div
                                id="role-filter-menu"
                                class="absolute left-0 top-full z-30 mt-1 hidden w-36 max-w-full rounded-lg border p-1 shadow-lg"
                                role="listbox"
                                style="background-color: var(--admin-surface); border-color: var(--admin-border);">

                                <button type="button" data-role-value=""
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Semua Role
                                </button>

                                <button type="button" data-role-value="admin"
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Admin
                                </button>

                                <button type="button" data-role-value="guru"
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Guru
                                </button>

                                <button type="button" data-role-value="siswa"
                                    class="block w-full rounded-md px-3 py-2 text-left text-xs sm:text-[13px] hover:opacity-80"
                                    style="color: var(--admin-text);">
                                    Siswa
                                </button>
                            </div>
                        </div>

                        @if ($isFiltering)
                            <a href="{{ route('admin.users.index') }}"
                                class="inline-flex h-9 items-center justify-center px-3 rounded-lg text-xs sm:text-[13px] font-medium transition-colors duration-150 shrink-0"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"
                                onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                                Reset
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                        <a href="{{ route('admin.notifications.create') }}"
                            class="inline-flex h-9 w-full sm:w-36 items-center justify-center gap-1.5 px-3 rounded-lg text-xs sm:text-[13px] font-semibold transition-colors duration-150 shrink-0"
                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"
                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m22 2-7 20-4-9-9-4Z"/>
                                <path d="M22 2 11 13"/>
                            </svg>
                            Kirim Notifikasi
                        </a>

                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex h-9 w-full sm:w-36 items-center justify-center gap-1.5 px-3 rounded-lg text-xs sm:text-[13px] font-semibold text-white transition-opacity hover:brightness-110 shrink-0"
                            style="background-color: #2563EB; box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);">
                            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>
                            Tambah Akun
                        </a>
                    </div>
                </form>

                @if ($showTotal > 0)
                    <p class="text-xs sm:text-sm mb-4 pt-2" style="color: var(--admin-muted);">
                        Showing
                        <span class="font-semibold" style="color: var(--admin-text);" data-showing-from>
                            {{ $showFrom }}
                        </span>
                        –
                        <span class="font-semibold" style="color: var(--admin-text);" data-showing-to>
                            {{ $showTo }}
                        </span>
                        of
                        <span class="font-semibold" style="color: var(--admin-text);">
                            {{ $showTotal }}
                        </span>
                        records
                    </p>
                @endif

                <div class="rounded-xl overflow-hidden" style="border: 1px solid var(--admin-border);">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-900px text-left border-collapse">
                            <thead style="border-bottom: 1px solid var(--admin-border); background-color: var(--admin-surface-soft);">
                                <tr>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Pengguna</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Email</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Role</th>
                                    <th class="{{ $th }}" style="color: var(--admin-muted);">Terhubung</th>
                                    <th class="{{ $th }} text-right" style="color: var(--admin-muted);">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y" style="border-color: var(--admin-border);">
                                @forelse ($users as $user)
                                    @php
                                        $style = $roleStyles[$user->role] ?? $roleStyles['siswa'];
                                    @endphp

                                    <tr
                                        data-user-row
                                        style="border-bottom: 1px solid var(--admin-border);"
                                        onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                        onmouseout="this.style.backgroundColor='transparent'">

                                        <td class="{{ $td }}">
                                            <div class="min-w-0">
                                                <div class="font-medium truncate" style="color: var(--admin-text);">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">
                                                    ID #{{ $user->id }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="{{ $td }}">
                                            <span style="color: var(--admin-text);">{{ $user->email }}</span>
                                        </td>

                                        <td class="{{ $td }}">
                                            <span
                                                class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm font-semibold {{ $style['badge'] }}"
                                                style="color: var(--admin-text);">
                                                {{ $style['label'] }}
                                            </span>
                                        </td>

                                        <td class="{{ $td }}">
                                            @if ($user->teacher)
                                                <div class="font-medium" style="color: var(--admin-text);">
                                                    {{ $user->teacher->name }}
                                                </div>
                                                <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">
                                                    Data Guru
                                                </div>
                                            @elseif ($user->student)
                                                <div class="font-medium" style="color: var(--admin-text);">
                                                    {{ $user->student->name }}
                                                </div>
                                                <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">
                                                    Data Siswa
                                                </div>
                                            @else
                                                <span class="text-xs sm:text-sm italic" style="color: var(--admin-muted);">—</span>
                                            @endif
                                        </td>

                                        <td class="{{ $td }}">
                                            <div class="flex items-center justify-end gap-1">
                                                {{-- Detail --}}
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                    title="Detail"
                                                    aria-label="Detail {{ $user->name }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: var(--admin-icon);"
                                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true">
                                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                    title="Edit"
                                                    aria-label="Edit {{ $user->name }}"
                                                    class="{{ $iconBtn }}"
                                                    style="color: var(--admin-icon);"
                                                    onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                                                    onmouseout="this.style.backgroundColor='transparent'">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true">
                                                        <path d="M12 20h9"/>
                                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                    </svg>
                                                </a>

                                                {{-- Hapus (admin tidak bisa dihapus; slot dikosongkan agar ikon tetap sejajar) --}}
                                                @if (!$user->isAdmin())
                                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                                        method="POST"
                                                        class="inline-flex"
                                                        data-delete-form>
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            title="Hapus"
                                                            aria-label="Hapus {{ $user->name }}"
                                                            class="{{ $iconBtn }}"
                                                            style="color: #dc2626;"
                                                            onmouseover="this.style.backgroundColor='rgba(220, 38, 38, 0.1)'"
                                                            onmouseout="this.style.backgroundColor='transparent'">
                                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                aria-hidden="true">
                                                                <path d="M3 6h18"/>
                                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                                <path d="m19 6-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                                <path d="M10 11v6M14 11v6"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="w-8 h-8 shrink-0" aria-hidden="true"></span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-14 text-center">
                                            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3"
                                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                                    <circle cx="9" cy="7" r="4"/>
                                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                                </svg>
                                            </div>

                                            <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">
                                                Belum ada akun
                                            </p>
                                            <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">
                                                Tambahkan akun untuk Guru atau Siswa.
                                            </p>

                                            <a href="{{ route('admin.users.create') }}"
                                                class="mt-4 inline-flex h-9 items-center justify-center gap-1.5 px-3 rounded-lg text-xs sm:text-[13px] font-semibold text-white hover:brightness-110"
                                                style="background-color: #2563EB;">
                                                Tambah Akun
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="user-pagination"></div>
        </div>
    </div>

    <div id="delete-confirm-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="delete-modal-title"
        aria-hidden="true">

        <div class="w-full max-w-sm rounded-2xl border p-5 shadow-xl"
            style="background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);">

            <h2 id="delete-modal-title" class="text-base font-semibold">
                Hapus akun ini?
            </h2>

            <p class="mt-2 text-sm" style="color: var(--admin-muted);">
                Akun yang dihapus tidak dapat dikembalikan.
            </p>

            <div class="mt-5 flex justify-end gap-2">
                <button id="cancel-delete-button"
                    type="button"
                    class="h-9 rounded-lg border px-3 text-xs sm:text-sm font-medium"
                    style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-text);">
                    Batal
                </button>

                <button id="confirm-delete-button"
                    type="button"
                    class="h-9 rounded-lg px-3 text-xs sm:text-sm font-semibold text-white"
                    style="background-color: #dc2626;">
                    Hapus Akun
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('input[name="search"]');

            if (searchInput) {
                let searchTimer;

                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimer);

                    searchTimer = setTimeout(function () {
                        searchInput.form?.requestSubmit();
                    }, 300);
                });
            }

            const roleDropdown = document.getElementById('role-filter-dropdown');

            if (roleDropdown) {
                const roleToggle = document.getElementById('role-filter-toggle');
                const roleMenu = document.getElementById('role-filter-menu');
                const roleInput = roleDropdown.querySelector('input[name="role"]');
                const roleLabel = document.getElementById('role-filter-label');

                roleToggle.addEventListener('click', function () {
                    const isOpen = !roleMenu.classList.contains('hidden');

                    roleMenu.classList.toggle('hidden', isOpen);
                    roleToggle.setAttribute('aria-expanded', String(!isOpen));
                });

                roleMenu.querySelectorAll('[data-role-value]').forEach(function (option) {
                    option.addEventListener('click', function () {
                        roleInput.value = option.dataset.roleValue;
                        roleLabel.textContent = option.textContent.trim();
                        roleMenu.classList.add('hidden');
                        roleToggle.setAttribute('aria-expanded', 'false');
                        roleToggle.closest('form').requestSubmit();
                    });
                });

                document.addEventListener('click', function (event) {
                    if (!roleDropdown.contains(event.target)) {
                        roleMenu.classList.add('hidden');
                        roleToggle.setAttribute('aria-expanded', 'false');
                    }
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        roleMenu.classList.add('hidden');
                        roleToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            const rows = Array.from(document.querySelectorAll('[data-user-row]'));
            const pagination = document.getElementById('user-pagination');
            const perPage = 10;

            if (pagination && rows.length > perPage) {
                let currentPage = 1;
                const totalPages = Math.ceil(rows.length / perPage);

                const info = document.createElement('p');
                info.className = 'text-xs sm:text-sm';
                info.style.color = 'var(--admin-muted)';

                const controls = document.createElement('div');
                controls.className = 'flex flex-wrap items-center gap-2';

                const previousButton = document.createElement('button');
                previousButton.type = 'button';
                previousButton.textContent = 'Sebelumnya';
                previousButton.className = 'h-9 px-3 rounded-lg border text-xs sm:text-sm font-medium transition-colors';
                previousButton.style.cssText =
                    'background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);';

                const pageInfo = document.createElement('span');
                pageInfo.className = 'text-xs sm:text-sm';
                pageInfo.style.color = 'var(--admin-muted)';

                const nextButton = document.createElement('button');
                nextButton.type = 'button';
                nextButton.textContent = 'Berikutnya';
                nextButton.className = 'h-9 px-3 rounded-lg border text-xs sm:text-sm font-medium transition-colors';
                nextButton.style.cssText =
                    'background-color: var(--admin-surface); border-color: var(--admin-border); color: var(--admin-text);';

                function renderPage() {
                    const start = (currentPage - 1) * perPage;
                    const end = start + perPage;

                    rows.forEach(function (row, index) {
                        row.classList.toggle('hidden', index < start || index >= end);
                    });

                    const visibleStart = start + 1;
                    const visibleEnd = Math.min(end, rows.length);

                    info.textContent = `Menampilkan ${visibleStart}–${visibleEnd} dari ${rows.length} akun`;

                    const showingFrom = document.querySelector('[data-showing-from]');
                    const showingTo = document.querySelector('[data-showing-to]');

                    if (showingFrom) showingFrom.textContent = visibleStart;
                    if (showingTo) showingTo.textContent = visibleEnd;
                    pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;

                    previousButton.disabled = currentPage === 1;
                    nextButton.disabled = currentPage === totalPages;

                    previousButton.classList.toggle('opacity-50', previousButton.disabled);
                    previousButton.classList.toggle('cursor-not-allowed', previousButton.disabled);
                    nextButton.classList.toggle('opacity-50', nextButton.disabled);
                    nextButton.classList.toggle('cursor-not-allowed', nextButton.disabled);
                }

                previousButton.addEventListener('click', function () {
                    if (currentPage > 1) {
                        currentPage--;
                        renderPage();
                    }
                });

                nextButton.addEventListener('click', function () {
                    if (currentPage < totalPages) {
                        currentPage++;
                        renderPage();
                    }
                });

                controls.append(previousButton, pageInfo, nextButton);

                pagination.className = 'mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3';
                pagination.append(info, controls);

                renderPage();
            }

            const deleteModal = document.getElementById('delete-confirm-modal');
            const cancelDeleteButton = document.getElementById('cancel-delete-button');
            const confirmDeleteButton = document.getElementById('confirm-delete-button');
            let pendingDeleteForm = null;

            function closeDeleteModal() {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                deleteModal.setAttribute('aria-hidden', 'true');
                pendingDeleteForm = null;
            }

            document.querySelectorAll('[data-delete-form]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    pendingDeleteForm = form;

                    deleteModal.classList.remove('hidden');
                    deleteModal.classList.add('flex');
                    deleteModal.setAttribute('aria-hidden', 'false');
                });
            });

            cancelDeleteButton.addEventListener('click', closeDeleteModal);

            confirmDeleteButton.addEventListener('click', function () {
                if (pendingDeleteForm) {
                    HTMLFormElement.prototype.submit.call(pendingDeleteForm);
                }
            });

            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                    closeDeleteModal();
                }
            });
        });
    </script>
</x-admin-layout>
