<x-admin-layout>

    <x-slot name="title">
        Kirim Notifikasi
    </x-slot>

    @php
        $inputClass = 'w-full py-2.5 px-4 rounded-xl text-[13px] sm:text-sm outline-none transition-colors duration-150';
        $labelClass = 'block text-xs sm:text-sm font-semibold mb-2';
    @endphp

    <div class="py-4 lg:py-6 min-h-screen" style="background-color: var(--admin-bg); color: var(--admin-text);">
        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3" style="color: var(--admin-muted);">
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <a href="{{ route('admin.users.index') }}" class="hover:opacity-85">Akun</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">Kirim Notifikasi</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-8">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                        Kirim Notifikasi
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                        Kirim informasi langsung kepada Guru atau Siswa tertentu.
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

            <form method="POST" action="{{ route('admin.notifications.store') }}">
                @csrf

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                    <div class="xl:col-span-2 rounded-2xl p-5 sm:p-6 shadow-sm"
                        style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                        <div class="mb-6">
                            <label for="title" class="{{ $labelClass }}">
                                Judul Notifikasi
                            </label>

                            <input
                                id="title"
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Contoh: Informasi Jadwal Pembelajaran"
                                class="{{ $inputClass }}"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"
                                required
                            >
                        </div>

                        <div class="mb-6">
                            <label for="type" class="{{ $labelClass }}">
                                Tipe Notifikasi
                            </label>

                            <select
                                id="type"
                                name="type"
                                class="{{ $inputClass }}"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"
                                required
                            >
                                <option value="info" {{ old('type', 'info') === 'info' ? 'selected' : '' }}>Informasi</option>
                                <option value="success" {{ old('type') === 'success' ? 'selected' : '' }}>Berhasil</option>
                                <option value="warning" {{ old('type') === 'warning' ? 'selected' : '' }}>Peringatan</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="{{ $labelClass }}">
                                Pesan
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="7"
                                placeholder="Tulis isi informasi atau pengumuman..."
                                class="{{ $inputClass }} resize-none"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"
                                required
                            >{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <div class="rounded-2xl p-5 sm:p-6 shadow-sm"
                        style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">

                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h2 class="text-sm sm:text-base font-bold">
                                    Penerima
                                </h2>

                                <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">
                                    Pilih satu atau beberapa pengguna.
                                </p>
                            </div>

                            <button
                                type="button"
                                id="selectAll"
                                class="text-xs font-semibold hover:opacity-80"
                                style="color: #2563EB;"
                            >
                                Pilih Semua
                            </button>
                        </div>

                        <div class="relative mb-4">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none" style="color: var(--admin-icon);">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="m21 21-4.3-4.3"/>
                                </svg>
                            </span>

                            <input
                                id="recipientSearch"
                                type="text"
                                placeholder="Cari penerima..."
                                class="{{ $inputClass }} pl-10"
                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"
                            >
                        </div>

                        <div id="recipientList" class="space-y-2 max-h-[430px] overflow-y-auto pr-1">

                            @forelse ($users as $user)
                                <label
                                    class="recipient-item flex items-center gap-3 p-3 rounded-xl cursor-pointer transition-colors"
                                    data-name="{{ strtolower($user->name) }}"
                                    data-email="{{ strtolower($user->email) }}"
                                    style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border);"
                                >
                                    <input
                                        type="checkbox"
                                        name="user_ids[]"
                                        value="{{ $user->id }}"
                                        class="recipient-checkbox w-4 h-4 rounded accent-blue-600"
                                        {{ in_array($user->id, old('user_ids', [])) ? 'checked' : '' }}
                                    >

                                    <div class="min-w-0 flex-1">
                                        <div class="text-xs sm:text-sm font-semibold truncate" style="color: var(--admin-text);">
                                            {{ $user->name }}
                                        </div>

                                        <div class="text-[10px] sm:text-xs mt-0.5 truncate" style="color: var(--admin-muted);">
                                            {{ $user->email }}
                                        </div>
                                    </div>

                                    <span class="shrink-0 px-2 py-1 rounded-md text-[10px] font-semibold
                                        {{ $user->role === 'guru'
                                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300'
                                            : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300' }}">
                                        {{ $user->role === 'guru' ? 'Guru' : 'Siswa' }}
                                    </span>
                                </label>
                            @empty
                                <div class="py-10 text-center">
                                    <p class="text-xs sm:text-sm font-medium" style="color: var(--admin-text);">
                                        Belum ada penerima.
                                    </p>

                                    <p class="text-[11px] sm:text-xs mt-1" style="color: var(--admin-muted);">
                                        Tambahkan akun Guru atau Siswa terlebih dahulu.
                                    </p>
                                </div>
                            @endforelse

                        </div>

                        <div class="mt-4 pt-4" style="border-top: 1px solid var(--admin-border);">
                            <div class="flex items-center justify-between text-xs">
                                <span style="color: var(--admin-muted);">Terpilih</span>
                                <span id="selectedCount" class="font-semibold" style="color: var(--admin-text);">0 penerima</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6">
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-xs sm:text-sm font-medium transition-colors"
                        style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-white shadow-md hover:brightness-110 transition-opacity"
                        style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 2 11 13"/>
                            <path d="m22 2-7 20-4-9-9-4Z"/>
                        </svg>
                        Kirim Notifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('recipientSearch');
            const selectAllButton = document.getElementById('selectAll');
            const selectedCount = document.getElementById('selectedCount');
            const items = Array.from(document.querySelectorAll('.recipient-item'));
            const checkboxes = Array.from(document.querySelectorAll('.recipient-checkbox'));

            function updateCount() {
                const count = checkboxes.filter(checkbox => checkbox.checked).length;
                selectedCount.textContent = `${count} penerima`;
            }

            searchInput?.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();

                items.forEach(item => {
                    const name = item.dataset.name || '';
                    const email = item.dataset.email || '';
                    item.style.display = !keyword || name.includes(keyword) || email.includes(keyword) ? 'flex' : 'none';
                });
            });

            selectAllButton?.addEventListener('click', function () {
                const visibleItems = items.filter(item => item.style.display !== 'none');
                const visibleCheckboxes = visibleItems
                    .map(item => item.querySelector('.recipient-checkbox'))
                    .filter(Boolean);

                const shouldCheck = visibleCheckboxes.some(checkbox => !checkbox.checked);

                visibleCheckboxes.forEach(checkbox => {
                    checkbox.checked = shouldCheck;
                });

                updateCount();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCount);
            });

            updateCount();
        });
    </script>

</x-admin-layout>