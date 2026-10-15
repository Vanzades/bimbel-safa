<x-admin-layout>
    <x-slot name="title">Program</x-slot>

    @php
        $isFiltering = request()->filled('search') || request()->filled('status');
        $th = 'px-5 py-3.5 text-left text-xs sm:text-sm font-semibold uppercase tracking-wider';
        $td = 'px-5 py-4 text-xs sm:text-sm';
        $iconBtn = 'w-8 h-8 inline-flex items-center justify-center rounded-lg transition-colors duration-150';
        $baseRoute = $routePrefix . '.programs';
    @endphp

    <div class="-mt-3 pt-0 pb-6 min-h-screen" style="background-color: var(--admin-bg); color: var(--admin-text);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-6">
            <nav class="flex items-center gap-1.5 text-xs font-medium mb-3" style="color: var(--admin-muted);">
                <a href="{{ route($routePrefix . '.dashboard') }}" class="hover:opacity-80">Dashboard</a>
                <span>/</span><span style="color: var(--admin-text);">Program</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mt-7 mb-7">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">Program</h1>
                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">Kelola program bimbingan belajar.</p>
                </div>
                <a href="{{ route($baseRoute . '.create') }}" class="inline-flex h-9 items-center justify-center gap-2 px-4 rounded-lg text-xs sm:text-sm font-semibold text-white hover:brightness-110" style="background-color:#2563EB;">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Program
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-xl border px-4 py-3 text-sm" style="background:#ecfdf5;border-color:#a7f3d0;color:#047857">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded-xl border px-4 py-3 text-sm" style="background:#fef2f2;border-color:#fecaca;color:#b91c1c">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-4 rounded-xl border px-4 py-3 text-sm" style="background:#fef2f2;border-color:#fecaca;color:#b91c1c">
                    <ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-5">
                @foreach ([['Total Program', $totalPrograms], ['Program Aktif', $activePrograms], ['Program Nonaktif', $inactivePrograms]] as $stat)
                    <div class="rounded-xl p-4 sm:p-5" style="border:1px solid var(--admin-border);background:var(--admin-surface);box-shadow:0 4px 20px var(--admin-shadow);">
                        <p class="text-xs sm:text-sm" style="color:var(--admin-muted)">{{ $stat[0] }}</p>
                        <p class="mt-2 text-2xl font-bold">{{ $stat[1] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="rounded-2xl p-4 sm:p-6" style="border:1px solid var(--admin-border);background:var(--admin-surface);box-shadow:0 4px 20px var(--admin-shadow);">
                <form method="GET" action="{{ route($baseRoute . '.index') }}" class="flex flex-col sm:flex-row gap-3 mb-5">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode program..." class="h-10 w-full sm:max-w-sm rounded-lg px-3 text-sm outline-none" style="background:var(--admin-surface-soft);border:1px solid var(--admin-border);color:var(--admin-text)">
                    <select name="status" class="h-10 rounded-lg px-3 text-sm outline-none" style="background:var(--admin-surface-soft);border:1px solid var(--admin-border);color:var(--admin-text)">
                        <option value="">Semua Status</option>
                        <option value="active" @selected(request('status') === 'active')>Aktif</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
                    </select>
                    <button class="h-10 px-4 rounded-lg text-sm font-semibold text-white" style="background:#2563EB">Terapkan</button>
                    @if ($isFiltering)<a href="{{ route($baseRoute . '.index') }}" class="h-10 px-4 inline-flex items-center justify-center rounded-lg text-sm" style="background:var(--admin-surface-soft);border:1px solid var(--admin-border)">Reset</a>@endif
                </form>

                <p class="text-xs sm:text-sm mb-4" style="color:var(--admin-muted)">Menampilkan {{ $programs->firstItem() ?? 0 }}–{{ $programs->lastItem() ?? 0 }} dari {{ $programs->total() }} program</p>
                <div class="overflow-x-auto rounded-xl" style="border:1px solid var(--admin-border)">
                    <table class="w-full min-w-[760px] border-collapse text-left">
                        <thead style="background:var(--admin-surface-soft);border-bottom:1px solid var(--admin-border)"><tr>
                            <th class="{{ $th }}" style="color:var(--admin-muted)">Program</th>
                            <th class="{{ $th }}" style="color:var(--admin-muted)">Kode</th>
                            <th class="{{ $th }}" style="color:var(--admin-muted)">Penggunaan</th>
                            <th class="{{ $th }}" style="color:var(--admin-muted)">Status</th>
                            <th class="{{ $th }} text-right" style="color:var(--admin-muted)">Aksi</th>
                        </tr></thead>
                        <tbody>
                            @forelse ($programs as $program)
                                <tr style="border-bottom:1px solid var(--admin-border)" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <td class="{{ $td }}"><div class="font-semibold">{{ $program->name }}</div><div class="mt-1 text-xs" style="color:var(--admin-muted)">Dibuat {{ $program->created_at?->format('d M Y') ?? '—' }}</div></td>
                                    <td class="{{ $td }}"><span class="inline-flex px-2.5 py-1 rounded-md font-semibold" style="background:var(--admin-surface-soft)">{{ $program->code }}</span></td>
                                    <td class="{{ $td }}"><div>{{ $program->students_count }} siswa</div><div class="text-xs mt-1" style="color:var(--admin-muted)">{{ $program->class_rooms_count }} kelas</div></td>
                                    <td class="{{ $td }}"><span class="inline-flex px-2.5 py-1 rounded-md font-semibold" style="background:{{ $program->status === 'active' ? '#d1fae5' : '#e2e8f0' }};color:{{ $program->status === 'active' ? '#065f46' : '#475569' }}">{{ $program->status === 'active' ? 'Aktif' : 'Nonaktif' }}</span></td>
                                    <td class="{{ $td }}"><div class="flex items-center justify-end gap-1">
                                        <a href="{{ route($baseRoute . '.show', $program) }}" title="Detail" class="{{ $iconBtn }}" style="color:var(--admin-icon)" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></a>
                                        <a href="{{ route($baseRoute . '.edit', $program) }}" title="Edit" class="{{ $iconBtn }}" style="color:var(--admin-icon)" onmouseover="this.style.backgroundColor='var(--admin-hover)'" onmouseout="this.style.backgroundColor='transparent'"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></a>
                                        <form action="{{ route($baseRoute . '.destroy', $program) }}" method="POST" data-delete-form>@csrf @method('DELETE')<button type="submit" title="Hapus" class="{{ $iconBtn }}" style="color:#dc2626" onmouseover="this.style.backgroundColor='rgba(220,38,38,.1)'" onmouseout="this.style.backgroundColor='transparent'"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 10v6m4-6v6"/></svg></button></form>
                                    </div></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-14 text-center"><p class="font-semibold">Belum ada data program</p><p class="mt-1 text-sm" style="color:var(--admin-muted)">Tambahkan program untuk mulai mengelola data bimbingan.</p><a href="{{ route($baseRoute . '.create') }}" class="mt-4 inline-flex h-9 items-center px-4 rounded-lg text-sm font-semibold text-white" style="background:#2563EB">Tambah Program</a></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($programs->hasPages())
                    <div class="mt-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3"><p class="text-sm" style="color:var(--admin-muted)">Halaman {{ $programs->currentPage() }} dari {{ $programs->lastPage() }}</p><div class="flex gap-2">@if($programs->onFirstPage())<span class="px-3 py-2 rounded-lg text-sm opacity-50" style="border:1px solid var(--admin-border)">Sebelumnya</span>@else<a class="px-3 py-2 rounded-lg text-sm" style="border:1px solid var(--admin-border)" href="{{ $programs->previousPageUrl() }}">Sebelumnya</a>@endif @if($programs->hasMorePages())<a class="px-3 py-2 rounded-lg text-sm" style="border:1px solid var(--admin-border)" href="{{ $programs->nextPageUrl() }}">Berikutnya</a>@else<span class="px-3 py-2 rounded-lg text-sm opacity-50" style="border:1px solid var(--admin-border)">Berikutnya</span>@endif</div></div>
                @endif
            </div>
        </div>
    </div>

    <div id="delete-confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="w-full max-w-sm rounded-2xl border p-5 shadow-xl" style="background:var(--admin-surface);border-color:var(--admin-border);color:var(--admin-text)">
            <h2 class="text-base font-semibold">Hapus program ini?</h2><p class="mt-2 text-sm" style="color:var(--admin-muted)">Program yang masih digunakan siswa atau kelas tidak dapat dihapus.</p>
            <div class="mt-5 flex justify-end gap-2"><button id="cancel-delete-button" type="button" class="h-9 rounded-lg border px-3 text-sm" style="border-color:var(--admin-border)">Batal</button><button id="confirm-delete-button" type="button" class="h-9 rounded-lg px-3 text-sm font-semibold text-white" style="background:#dc2626">Hapus Program</button></div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('delete-confirm-modal');
            const cancel = document.getElementById('cancel-delete-button');
            const confirm = document.getElementById('confirm-delete-button');
            let pendingForm = null;
            document.querySelectorAll('[data-delete-form]').forEach(form => form.addEventListener('submit', event => { event.preventDefault(); pendingForm = form; modal.classList.remove('hidden'); modal.classList.add('flex'); modal.setAttribute('aria-hidden', 'false'); }));
            function closeModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); modal.setAttribute('aria-hidden', 'true'); pendingForm = null; }
            cancel.addEventListener('click', closeModal);
            confirm.addEventListener('click', () => { if (pendingForm) HTMLFormElement.prototype.submit.call(pendingForm); });
            modal.addEventListener('click', event => { if (event.target === modal) closeModal(); });
            document.addEventListener('keydown', event => { if (event.key === 'Escape') closeModal(); });
        });
    </script>
</x-admin-layout>
