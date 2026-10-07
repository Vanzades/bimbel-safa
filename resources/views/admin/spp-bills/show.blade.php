<x-admin-layout>
    <x-slot name="title">
        Detail Tagihan SPP
    </x-slot>

    @php
        $statusLabels = [
            'paid' => 'Lunas',
            'unpaid' => 'Belum Lunas',
            'pending' => 'Menunggu Pembayaran',
            'failed' => 'Gagal',
            'expired' => 'Expired',
        ];

        $statusBadges = [
            'paid' => 'bg-emerald-100/80 dark:bg-emerald-500/20',
            'unpaid' => 'bg-red-100/80 dark:bg-red-500/20',
            'pending' => 'bg-blue-100/80 dark:bg-blue-500/20',
            'failed' => 'bg-red-100/80 dark:bg-red-500/20',
            'expired' => 'bg-slate-100 dark:bg-slate-800',
        ];

        $statusNotices = [
            'paid' => [
                'title' => 'Pembayaran Lunas',
                'description' => $sppBill->paid_at
                    ? 'Tagihan ini telah tercatat sebagai lunas pada ' . $sppBill->paid_at->format('d M Y, H:i') . '.'
                    : 'Tagihan ini telah tercatat sebagai lunas.',
                'style' => 'background-color: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3);',
            ],
            'unpaid' => [
                'title' => 'Belum Lunas',
                'description' => 'Tagihan ini masih memiliki status belum lunas.',
                'style' => 'background-color: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.3);',
            ],
            'pending' => [
                'title' => 'Menunggu Pembayaran',
                'description' => 'Pembayaran tagihan masih menunggu proses.',
                'style' => 'background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3);',
            ],
            'failed' => [
                'title' => 'Pembayaran Gagal',
                'description' => 'Pembayaran untuk tagihan ini gagal diproses.',
                'style' => 'background-color: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.3);',
            ],
            'expired' => [
                'title' => 'Tagihan Expired',
                'description' => 'Masa pembayaran untuk tagihan ini telah berakhir.',
                'style' => 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);',
            ],
        ];

        $currentStatusLabel = $statusLabels[$sppBill->status] ?? ucfirst($sppBill->status);
        $currentStatusBadge = $statusBadges[$sppBill->status] ?? 'bg-slate-100 dark:bg-slate-800';
        $currentStatusNotice = $statusNotices[$sppBill->status] ?? [
            'title' => 'Status Tagihan',
            'description' => 'Informasi status tagihan tidak tersedia.',
            'style' => 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);',
        ];

        $infoBox = 'min-w-0 rounded-xl border p-3.5 sm:p-4';
        $infoBoxStyle = 'background-color: var(--admin-surface-soft); border-color: var(--admin-border);';
        $label = 'mb-2 block text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
        $value = 'wrap-break-word text-xs font-medium leading-relaxed sm:text-sm';
    @endphp

    {{-- Wrapper mengikuti halaman Akun --}}
    <div
        class="-mt-3 min-h-screen pt-0 pb-4 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);"
    >
        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-6">

            {{-- Breadcrumb --}}
            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <a href="{{ route('admin.spp-bills.index') }}" class="hover:opacity-85">
                    SPP
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">
                    Detail Tagihan SPP
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mt-8 mb-12">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Detail Tagihan SPP
                </h1>

                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Informasi lengkap tagihan SPP siswa.
                </p>
            </div>

            {{-- Konten utama --}}
            <div class="grid min-w-0 gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">

                {{-- Informasi tagihan --}}
                <section
                    class="min-w-0 rounded-2xl p-5 shadow-sm sm:p-6"
                    style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
                >
                    {{-- Header tagihan --}}
                    <div
                        class="flex flex-col justify-between gap-4 border-b pb-5 sm:flex-row sm:items-center"
                        style="border-color: var(--admin-border);"
                    >
                        <div class="min-w-0">
                            <div class="flex items-center gap-3">
                                <span
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                    style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3.75h7.5l3 3v13.5H6.75V3.75Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.25 3.75v3h3M9 11.25h6M9 14.25h6M9 17.25h3"/>
                                    </svg>
                                </span>

                                <div class="min-w-0">
                                    <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                        Informasi Tagihan
                                    </h2>

                                    <p class="mt-0.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                        Periode {{ $sppBill->period }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <span
                            class="inline-flex w-fit shrink-0 items-center rounded-lg px-3 py-1.5 text-xs font-semibold {{ $currentStatusBadge }} sm:text-[13px]"
                            style="color: var(--admin-text);"
                        >
                            {{ $currentStatusLabel }}
                        </span>
                    </div>

                    {{-- Detail tagihan --}}
                    <div class="grid min-w-0 gap-3 py-6 sm:grid-cols-2 sm:gap-4">
                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Siswa</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                {{ $sppBill->student->name }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">NIS / Identitas</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                {{ $sppBill->student->identity_number }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Kelas</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                {{ $sppBill->student->classRoom?->name ?? '-' }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Periode</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                {{ $sppBill->period }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Nominal</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Status</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                {{ $currentStatusLabel }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Tanggal Pembayaran</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                {{ $sppBill->paid_at?->format('d M Y, H:i') ?? '-' }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Referensi Pembayaran</span>
                            <p class="{{ $value }}" style="color: var(--admin-text);">
                                {{ $sppBill->payment_reference ?: '-' }}
                            </p>
                        </div>

                        <div class="{{ $infoBox }} sm:col-span-2" style="{{ $infoBoxStyle }}">
                            <span class="{{ $label }}" style="color: var(--admin-muted);">Catatan</span>
                            <p class="wrap-break-word whitespace-pre-line text-xs leading-relaxed sm:text-sm" style="color: var(--admin-text);">
                                {{ $sppBill->notes ?: 'Tidak ada catatan untuk tagihan ini.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Informasi sistem --}}
                    <div class="border-t pt-5" style="border-color: var(--admin-border);">
                        <div class="mb-4 flex items-center gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: var(--admin-icon);"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <circle cx="12" cy="12" r="8.25" stroke-width="1.8"/>
                                    <path stroke-linecap="round" stroke-width="1.8" d="M12 11v5M12 8h.01"/>
                                </svg>
                            </span>

                            <h3 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                                Informasi Sistem
                            </h3>
                        </div>

                        <div class="grid min-w-0 gap-3 sm:grid-cols-2 sm:gap-4">
                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">ID Tagihan</span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    #{{ $sppBill->id }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">Siswa Aktif</span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $sppBill->student->status === 'active' ? 'Ya' : 'Tidak' }}
                                </p>
                            </div>

                            <div class="{{ $infoBox }}" style="{{ $infoBoxStyle }}">
                                <span class="{{ $label }}" style="color: var(--admin-muted);">Data Dibuat</span>
                                <p class="{{ $value }}" style="color: var(--admin-text);">
                                    {{ $sppBill->created_at?->format('d F Y, H:i') ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Ringkasan dan aksi --}}
                <aside class="min-w-0 space-y-6">
                    <section
                        class="rounded-2xl p-5 shadow-sm sm:p-6"
                        style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
                    >
                        <h2 class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                            Ringkasan Tagihan
                        </h2>

                        <div class="mt-5 space-y-4">
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wider sm:text-xs" style="color: var(--admin-muted);">
                                    Siswa
                                </p>
                                <p class="mt-1 wrap-break-word text-xs font-semibold sm:text-sm" style="color: var(--admin-text);">
                                    {{ $sppBill->student->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wider sm:text-xs" style="color: var(--admin-muted);">
                                    Kelas
                                </p>
                                <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-text);">
                                    {{ $sppBill->student->classRoom?->name ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wider sm:text-xs" style="color: var(--admin-muted);">
                                    Periode
                                </p>
                                <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-text);">
                                    {{ $sppBill->period }}
                                </p>
                            </div>

                            <div class="border-t pt-4" style="border-color: var(--admin-border);">
                                <p class="text-[11px] font-semibold uppercase tracking-wider sm:text-xs" style="color: var(--admin-muted);">
                                    Total Tagihan
                                </p>
                                <p class="mt-1 text-base font-bold tracking-tight sm:text-lg" style="color: var(--admin-text);">
                                    Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Aksi hapus --}}
                        <div class="mt-5 border-t pt-5" style="border-color: var(--admin-border);">
                            <form
                                id="delete-spp-bill-form"
                                action="{{ route('admin.spp-bills.destroy', $sppBill) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="button"
                                    id="delete-spp-bill-trigger"
                                    class="inline-flex h-9 w-full items-center justify-center rounded-lg border border-red-200 px-4 text-[13px] font-semibold text-red-600 transition-colors duration-150 hover:bg-red-50 dark:border-red-500/30 dark:text-red-400 dark:hover:bg-red-500/10"
                                    style="background-color: rgba(239, 68, 68, 0.08);"
                                >
                                    Hapus Tagihan
                                </button>
                            </form>
                        </div>
                    </section>

                    {{-- Keterangan status --}}
                    <section
                        class="rounded-2xl border p-5"
                        style="{{ $currentStatusNotice['style'] }}"
                    >
                        <h2 class="text-sm font-semibold sm:text-base" style="color: var(--admin-text);">
                            {{ $currentStatusNotice['title'] }}
                        </h2>

                        <p class="mt-1.5 text-xs leading-relaxed sm:text-sm" style="color: var(--admin-text);">
                            {{ $currentStatusNotice['description'] }}
                        </p>
                    </section>
                </aside>
            </div>
        </div>
    </div>

    {{-- Popup konfirmasi hapus --}}
    <div
        id="delete-confirm-modal"
        class="fixed inset-0 z-100 hidden items-center justify-center bg-black/50 p-4"
        aria-hidden="true"
    >
        <div
            class="w-full max-w-sm rounded-2xl border p-5 shadow-xl sm:p-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="delete-modal-title"
            style="background-color: var(--admin-surface); border-color: var(--admin-border);"
        >
            <div class="flex items-start gap-3">
                <span
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                    style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444;"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4m0 4h.01M10.3 3.9 2.9 16.7A2 2 0 0 0 4.6 19.7h14.8a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/>
                    </svg>
                </span>

                <div class="min-w-0">
                    <h2 id="delete-modal-title" class="text-sm font-bold sm:text-base" style="color: var(--admin-text);">
                        Hapus Tagihan SPP?
                    </h2>
                    <p class="mt-1 text-xs leading-relaxed sm:text-sm" style="color: var(--admin-muted);">
                        Tagihan ini akan dihapus. Aksi ini tidak bisa dibatalkan.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    id="cancel-delete-spp-bill"
                    class="inline-flex h-9 items-center justify-center rounded-lg border px-4 text-[13px] font-medium"
                    style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-text);"
                >
                    Batal
                </button>

                <button
                    type="button"
                    id="confirm-delete-spp-bill"
                    class="inline-flex h-9 items-center justify-center rounded-lg px-4 text-[13px] font-semibold text-white"
                    style="background-color: #dc2626;"
                >
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('delete-confirm-modal');
            const deleteForm = document.getElementById('delete-spp-bill-form');
            const openButton = document.getElementById('delete-spp-bill-trigger');
            const cancelButton = document.getElementById('cancel-delete-spp-bill');
            const confirmButton = document.getElementById('confirm-delete-spp-bill');

            if (!modal || !deleteForm || !openButton || !cancelButton || !confirmButton) {
                return;
            }

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                modal.setAttribute('aria-hidden', 'false');
                document.body.classList.add('overflow-hidden');
                cancelButton.focus();
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('overflow-hidden');
                openButton.focus();
            }

            openButton.addEventListener('click', openModal);
            cancelButton.addEventListener('click', closeModal);

            confirmButton.addEventListener('click', function () {
                deleteForm.submit();
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>
</x-admin-layout>
