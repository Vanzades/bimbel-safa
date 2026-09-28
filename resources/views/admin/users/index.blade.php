<x-admin-layout>

    <x-slot name="title">

        Akun

    </x-slot>



    @php

        $roleStyles = [

            'admin' => [

                'label' => 'Admin',

                'badge' => 'bg-purple-100/80 text-purple-700 font-semibold dark:bg-purple-500/20 dark:text-purple-300',

            ],

            'guru' => [

                'label' => 'Guru',

                'badge' => 'bg-indigo-100/80 text-indigo-700 font-semibold dark:bg-indigo-500/20 dark:text-indigo-300',

            ],

            'siswa' => [

                'label' => 'Siswa',

                'badge' => 'bg-emerald-100/80 text-emerald-700 font-semibold dark:bg-emerald-500/20 dark:text-emerald-300',

            ],

        ];



        $isFiltering = request()->filled('search') || request()->filled('role');



        $th = 'px-6 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';

        $td = 'px-6 py-4 text-xs sm:text-sm';

        $iconBtn = 'w-8 h-8 inline-flex items-center justify-center rounded-lg transition-colors duration-150';

    @endphp



    {{-- Wrapper utama: Hapus transisi lambat, gunakan instant/durasi sangat singkat (150ms) --}}

    <div class="py-4 lg:py-6 min-h-screen transition-colors duration-150" style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">



            {{-- ====== Breadcrumb ====== --}}

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3" style="color: var(--admin-muted);">

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>

                <span class="font-semibold" style="color: var(--admin-text);">Akun</span>

            </nav>



            {{-- ====== JUDUL HALAMAN ====== --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Akun

                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Kelola akun Admin, Guru, dan Siswa.

                    </p>

                </div>

            </div>



            {{-- Flash / Error Messages --}}

            @if ($errors->any())

            <div class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm" style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);">

                <div class="font-semibold mb-1">Terjadi kesalahan.</div>

                <ul class="list-disc list-inside space-y-0.5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif



            {{-- ====== CARD UTAMA ====== --}}

            <div class="rounded-2xl p-5 sm:p-6 shadow-sm" style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">



                {{-- TOOLBAR --}}

                <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">



                    {{-- Kiri: dropdown role --}}

                    <select

                        name="role"

                        onchange="this.form.submit()"

                        class="w-full sm:w-44 py-2.5 px-4 rounded-xl text-[13px] sm:text-sm font-medium outline-none transition-colors duration-150"

                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                        <option value="">Semua Role</option>

                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>

                        <option value="guru" {{ request('role') === 'guru' ? 'selected' : '' }}>Guru</option>

                        <option value="siswa" {{ request('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>

                    </select>



                    {{-- Kanan: search + reset + tombol tambah akun --}}

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

                        <div class="relative w-full sm:w-64">

                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none" style="color: var(--admin-icon);">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>

                            </span>

                            <input

                                type="text"

                                name="search"

                                value="{{ request('search') }}"

                                placeholder="Cari nama atau email..."

                                class="w-full pl-10 pr-4 py-2.5 rounded-xl text-[13px] sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                        </div>



                        @if ($isFiltering)

                        <a href="{{ route('admin.users.index') }}"

                            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-medium transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                            onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'">

                            Reset

                        </a>

                        @endif



                        {{-- Tombol Tambah Akun --}}

                        <a href="{{ route('admin.users.create') }}"

                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white transition-opacity shadow-md hover:brightness-110 shrink-0"

                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);">

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>

                            Tambah Akun

                        </a>

                    </div>

                </form>



                {{-- Showing X - Y of Z records --}}

                @if (method_exists($users, 'firstItem') && $users->total() > 0)

                <p class="text-xs sm:text-sm mb-4 pt-2" style="color: var(--admin-muted);">

                    Showing <span class="font-semibold" style="color: var(--admin-text);">{{ $users->firstItem() ?? 0 }}</span>

                    – <span class="font-semibold" style="color: var(--admin-text);">{{ $users->lastItem() ?? 0 }}</span>

                    of <span class="font-semibold" style="color: var(--admin-text);">{{ $users->total() }}</span> records

                </p>

                @endif



                {{-- ====== TABEL ====== --}}

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

                                <tr style="border-bottom: 1px solid var(--admin-border);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                    <td class="{{ $td }}">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-xs sm:text-sm font-semibold uppercase" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                                                {{ substr($user->name, 0, 1) }}

                                            </div>

                                            <div class="min-w-0">

                                                <div class="font-medium truncate" style="color: var(--admin-text);">

                                                    {{ $user->name }}

                                                </div>

                                                <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">

                                                    ID #{{ $user->id }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>



                                    <td class="{{ $td }}">

                                        <span style="color: var(--admin-text);">

                                            {{ $user->email }}

                                        </span>

                                    </td>



                                    <td class="{{ $td }}">

                                        <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm {{ $style['badge'] }}">

                                            {{ $style['label'] }}

                                        </span>

                                    </td>



                                    <td class="{{ $td }}">

                                        @if ($user->teacher)

                                            <div class="font-medium" style="color: var(--admin-text);">{{ $user->teacher->name }}</div>

                                            <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">Data Guru</div>

                                        @elseif ($user->student)

                                            <div class="font-medium" style="color: var(--admin-text);">{{ $user->student->name }}</div>

                                            <div class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">Data Siswa</div>

                                        @else

                                            <span class="text-xs sm:text-sm italic" style="color: var(--admin-muted);">—</span>

                                        @endif

                                    </td>



                                    <td class="{{ $td }}">

                                        <div class="flex items-center justify-end gap-1">

                                            {{-- Detail --}}

                                            <a href="{{ route('admin.users.show', $user) }}" title="Detail"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>

                                            </a>



                                            {{-- Edit --}}

                                            <a href="{{ route('admin.users.edit', $user) }}" title="Edit"

                                                class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>

                                            </a>



                                            {{-- Hapus --}}

                                            @if (!$user->isAdmin())

                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" title="Hapus"

                                                    class="{{ $iconBtn }}" style="color: var(--admin-icon);" onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.1)'; this.style.color='#ef4444';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--admin-icon)';">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>

                                                </button>

                                            </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full mb-3" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);">

                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>

                                                <circle cx="9" cy="7" r="4"/>

                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>

                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                                            </svg>

                                        </div>

                                        <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">Belum ada akun</p>

                                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">Tambahkan akun untuk Guru atau Siswa.</p>

                                        <a href="{{ route('admin.users.create') }}"

                                            class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-[13px] sm:text-sm font-semibold text-white shadow-md hover:brightness-110"

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



            {{-- Pagination --}}

            @if (method_exists($users, 'hasPages') && $users->hasPages())

            <div class="mt-4">

                {{ $users->links() }}

            </div>

            @endif



        </div>

    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('input[name="search"]');
        if (!searchInput) return;

        let searchTimer;
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function () {
                searchInput.form?.requestSubmit();
            }, 300);
        });
    });
</script>

</x-admin-layout>
