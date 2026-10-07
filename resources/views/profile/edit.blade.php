<x-admin-layout>
    <x-slot name="title">
        Profil
    </x-slot>

    @php
        $labelClass = 'mb-2 block text-[13px] font-medium sm:text-sm';
        $fieldClass = 'box-border h-10 w-full min-w-0 rounded-lg px-3.5 text-xs outline-none transition-colors duration-150 sm:text-[13px]';
        $fieldStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';
    @endphp

    <div
        class="-mt-3 min-h-screen pt-0 pb-4 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);"
    >
        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-6">

            {{-- Breadcrumb --}}
            <nav
                aria-label="Breadcrumb"
                class="mb-3 flex min-w-0 items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);"
            >
                <a href="{{ route('admin.dashboard') }}" class="shrink-0 hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="truncate font-semibold" style="color: var(--admin-text);">
                    Profil
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mb-12 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Profil
                </h1>
                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Kelola informasi akun administrator Anda.
                </p>
            </div>

            <div class="grid min-w-0 grid-cols-1 items-start gap-6 lg:grid-cols-[minmax(0,1fr)_20rem]">

                {{-- Kolom form --}}
                <div class="min-w-0 space-y-6">

                    {{-- Informasi profil --}}
                    <section
                        class="overflow-hidden rounded-2xl border shadow-sm"
                        style="border-color: var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
                    >
                        <div class="border-b px-5 py-5 sm:px-6" style="border-color: var(--admin-border);">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                                    style="background-color: var(--admin-surface-soft); color: #2563EB;"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <h2 class="text-sm font-semibold sm:text-base">
                                        Informasi Profil
                                    </h2>
                                    <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                        Perbarui nama dan alamat email yang digunakan pada akun.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="space-y-5 p-5 sm:p-6">
                                <div class="min-w-0">
                                    <label for="name" class="{{ $labelClass }}">
                                        Nama
                                    </label>

                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        autofocus
                                        autocomplete="name"
                                        class="{{ $fieldClass }}"
                                        style="{{ $fieldStyle }}"
                                    >

                                    @error('name')
                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="min-w-0">
                                    <label for="email" class="{{ $labelClass }}">
                                        Email
                                    </label>

                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                        autocomplete="username"
                                        class="{{ $fieldClass }}"
                                        style="{{ $fieldStyle }}"
                                    >

                                    @error('email')
                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div
                                class="flex flex-col-reverse gap-3 border-t p-5 sm:flex-row sm:justify-end sm:px-6"
                                style="border-color: var(--admin-border);"
                            >
                                <button
                                    type="submit"
                                    class="inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-xs font-semibold text-white transition-opacity hover:brightness-110 sm:w-auto sm:min-w-36 sm:text-[13px]"
                                    style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"
                                >
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </section>

                    {{-- Ubah password --}}
                    <section
                        class="overflow-hidden rounded-2xl border shadow-sm"
                        style="border-color: var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
                    >
                        <div class="border-b px-5 py-5 sm:px-6" style="border-color: var(--admin-border);">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                                    style="background-color: var(--admin-surface-soft); color: #2563EB;"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <h2 class="text-sm font-semibold sm:text-base">
                                        Ubah Password
                                    </h2>
                                    <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                        Gunakan password baru yang kuat untuk menjaga keamanan akun.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="space-y-5 p-5 sm:p-6">
                                <div class="min-w-0">
                                    <label for="current_password" class="{{ $labelClass }}">
                                        Password Saat Ini
                                    </label>

                                    <input
                                        id="current_password"
                                        name="current_password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="{{ $fieldClass }}"
                                        style="{{ $fieldStyle }}"
                                    >

                                    @error('current_password', 'updatePassword')
                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="min-w-0">
                                    <label for="password" class="{{ $labelClass }}">
                                        Password Baru
                                    </label>

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="new-password"
                                        class="{{ $fieldClass }}"
                                        style="{{ $fieldStyle }}"
                                    >

                                    @error('password', 'updatePassword')
                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="min-w-0">
                                    <label for="password_confirmation" class="{{ $labelClass }}">
                                        Konfirmasi Password Baru
                                    </label>

                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        autocomplete="new-password"
                                        class="{{ $fieldClass }}"
                                        style="{{ $fieldStyle }}"
                                    >

                                    @error('password_confirmation', 'updatePassword')
                                        <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div
                                class="flex flex-col-reverse gap-3 border-t p-5 sm:flex-row sm:justify-end sm:px-6"
                                style="border-color: var(--admin-border);"
                            >
                                <button
                                    type="submit"
                                    class="inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-xs font-semibold text-white transition-opacity hover:brightness-110 sm:w-auto sm:min-w-36 sm:text-[13px]"
                                    style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"
                                >
                                    Ubah Password
                                </button>
                            </div>
                        </form>
                    </section>
                </div>

                {{-- Kolom detail akun --}}
                <div class="min-w-0 space-y-6">

                    {{-- Detail akun --}}
                    <section
                        class="overflow-hidden rounded-2xl border shadow-sm"
                        style="border-color: var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
                    >
                        <div class="flex items-center gap-3 border-b px-5 py-4" style="border-color: var(--admin-border);">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-surface-soft); color: #2563EB;"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z"/>
                                </svg>
                            </div>

                            <h2 class="text-sm font-semibold sm:text-base">
                                Detail Akun
                            </h2>
                        </div>

                        <div class="space-y-4 p-5">
                            <div class="min-w-0">
                                <p class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                    Nama
                                </p>
                                <p class="mt-1 wrap-break-word text-xs font-medium sm:text-[13px]">
                                    {{ $user->name }}
                                </p>
                            </div>

                            <div class="min-w-0 border-t pt-4" style="border-color: var(--admin-border);">
                                <p class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                    Email
                                </p>
                                <p class="mt-1 wrap-break-word text-xs font-medium sm:text-[13px]">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="min-w-0 border-t pt-4" style="border-color: var(--admin-border);">
                                <p class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                    Role
                                </p>
                                <span
                                    class="mt-1 inline-flex max-w-full rounded-full border px-3 py-1 text-[11px] font-medium capitalize sm:text-xs"
                                    style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-text);"
                                >
                                    {{ $user->role }}
                                </span>
                            </div>

                            <div class="min-w-0 border-t pt-4" style="border-color: var(--admin-border);">
                                <p class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                    Akun dibuat
                                </p>
                                <p class="mt-1 text-xs font-medium sm:text-[13px]">
                                    {{ $user->created_at?->format('d F Y, H:i') ?? '—' }}
                                </p>
                            </div>

                            <div class="min-w-0 border-t pt-4" style="border-color: var(--admin-border);">
                                <p class="text-[11px] sm:text-xs" style="color: var(--admin-muted);">
                                    Terakhir diperbarui
                                </p>
                                <p class="mt-1 text-xs font-medium sm:text-[13px]">
                                    {{ $user->updated_at?->format('d F Y, H:i') ?? '—' }}
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- Hapus akun --}}
                    <section
                        class="overflow-hidden rounded-2xl border shadow-sm"
                        style="border-color: var(--admin-danger-border, #fecaca); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
                    >
                        <div
                            class="flex items-start gap-3 border-b px-5 py-4"
                            style="border-color: var(--admin-danger-border, #fecaca);"
                        >
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                                style="background-color: var(--admin-danger-surface, #fef2f2); color: var(--admin-danger, #dc2626);"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <h2 class="text-sm font-semibold sm:text-base" style="color: var(--admin-danger, #dc2626);">
                                    Hapus Akun
                                </h2>
                                <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                    Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
                                </p>
                            </div>
                        </div>

                        <form
                            id="delete-account-form"
                            method="POST"
                            action="{{ route('profile.destroy') }}"
                            class="p-5"
                        >
                            @csrf
                            @method('DELETE')

                            <div class="min-w-0">
                                <label for="delete_password" class="{{ $labelClass }}">
                                    Password
                                </label>

                                <input
                                    id="delete_password"
                                    name="password"
                                    type="password"
                                    required
                                    placeholder="Masukkan password"
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('password', 'userDeletion')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button
                                type="button"
                                data-open-delete-modal
                                class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-lg border px-4 text-xs font-semibold transition-colors duration-150 sm:text-[13px]"
                                style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"
                            >
                                Hapus Akun
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- Popup konfirmasi hapus akun --}}
    <div
        id="delete-account-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="delete-modal-title"
        aria-describedby="delete-modal-description"
    >
        <div
            class="w-full max-w-sm rounded-2xl border p-5 shadow-xl sm:p-6"
            style="border-color: var(--admin-border); background-color: var(--admin-surface); color: var(--admin-text);"
        >
            <div class="flex items-start gap-3">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                    style="background-color: var(--admin-danger-surface, #fef2f2); color: var(--admin-danger, #dc2626);"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <h2 id="delete-modal-title" class="text-sm font-semibold sm:text-base">
                        Hapus akun?
                    </h2>
                    <p id="delete-modal-description" class="mt-1 text-xs leading-5 sm:text-[13px]" style="color: var(--admin-muted);">
                        Yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    data-close-delete-modal
                    class="inline-flex h-9 w-full items-center justify-center rounded-lg border px-4 text-xs font-medium transition-colors duration-150 sm:w-auto sm:text-[13px]"
                    style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-muted);"
                >
                    Batal
                </button>

                <button
                    type="button"
                    data-confirm-delete
                    class="inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-xs font-semibold text-white transition-opacity hover:brightness-110 sm:w-auto sm:text-[13px]"
                    style="background-color: var(--admin-danger, #dc2626);"
                >
                    Ya, Hapus Akun
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('delete-account-modal');
            const deleteForm = document.getElementById('delete-account-form');
            const openButton = document.querySelector('[data-open-delete-modal]');
            const closeButton = document.querySelector('[data-close-delete-modal]');
            const confirmButton = document.querySelector('[data-confirm-delete]');

            if (!modal || !deleteForm || !openButton || !closeButton || !confirmButton) {
                return;
            }

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
                closeButton.focus();
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                openButton.focus();
            }

            openButton.addEventListener('click', openModal);
            closeButton.addEventListener('click', closeModal);

            confirmButton.addEventListener('click', function () {
                deleteForm.requestSubmit();
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
