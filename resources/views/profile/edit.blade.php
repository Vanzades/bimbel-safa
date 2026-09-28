<x-admin-layout>
    <x-slot name="title">
        Profil
    </x-slot>

    <div class="space-y-6">

        <nav
            class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium text-slate-500"
            aria-label="Breadcrumb"
        >
            <a href="{{ route('admin.dashboard') }}" class="transition hover:text-blue-600">
                Dashboard
            </a>

            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>

            <span class="font-semibold text-slate-900">
                Profil
            </span>
        </nav>

        <div>
            <h1 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-950">
                Profil
            </h1>

            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Kelola informasi akun administrator Anda.
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_320px]">

            <div class="space-y-6">

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="flex items-start gap-3 border-b border-slate-200 px-5 py-4">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm sm:text-base font-semibold text-slate-900">
                                Informasi Profil
                            </h2>

                            <p class="mt-1 text-[11px] sm:text-xs text-slate-500">
                                Perbarui nama dan alamat email yang digunakan pada akun.
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('profile.update') }}"
                        class="space-y-5 p-5"
                    >
                        @csrf
                        @method('PATCH')

                        <div>
                            <label
                                for="name"
                                class="mb-1.5 block text-[13px] sm:text-sm font-medium text-slate-700"
                            >
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
                                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3.5 text-xs sm:text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            @error('name')
                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="email"
                                class="mb-1.5 block text-[13px] sm:text-sm font-medium text-slate-700"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                autocomplete="username"
                                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3.5 text-xs sm:text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            @error('email')
                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end border-t border-slate-100 pt-5">
                            <button
                                type="submit"
                                class="inline-flex h-10 items-center justify-center rounded-xl bg-blue-600 px-5 text-[13px] sm:text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="flex items-start gap-3 border-b border-slate-200 px-5 py-4">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm sm:text-base font-semibold text-slate-900">
                                Ubah Password
                            </h2>

                            <p class="mt-1 text-[11px] sm:text-xs text-slate-500">
                                Gunakan password baru yang kuat untuk menjaga keamanan akun.
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('password.update') }}"
                        class="space-y-5 p-5"
                    >
                        @csrf
                        @method('PUT')

                        <div>
                            <label
                                for="current_password"
                                class="mb-1.5 block text-[13px] sm:text-sm font-medium text-slate-700"
                            >
                                Password Saat Ini
                            </label>

                            <input
                                id="current_password"
                                name="current_password"
                                type="password"
                                autocomplete="current-password"
                                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3.5 text-xs sm:text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            @error('current_password', 'updatePassword')
                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="password"
                                class="mb-1.5 block text-[13px] sm:text-sm font-medium text-slate-700"
                            >
                                Password Baru
                            </label>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3.5 text-xs sm:text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            @error('password', 'updatePassword')
                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="password_confirmation"
                                class="mb-1.5 block text-[13px] sm:text-sm font-medium text-slate-700"
                            >
                                Konfirmasi Password Baru
                            </label>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3.5 text-xs sm:text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            @error('password_confirmation', 'updatePassword')
                                <p class="mt-1.5 text-[11px] sm:text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end border-t border-slate-100 pt-5">
                            <button
                                type="submit"
                                class="inline-flex h-10 items-center justify-center rounded-xl bg-blue-600 px-5 text-[13px] sm:text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            >
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="space-y-6">

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="flex items-center gap-3 border-b border-slate-200 px-5 py-4">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z"/>
                            </svg>
                        </div>

                        <h2 class="text-sm sm:text-base font-semibold text-slate-900">
                            Detail Akun
                        </h2>
                    </div>

                    <div class="p-5">
                        <div class="flex flex-col items-center text-center">
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 text-2xl font-semibold uppercase text-blue-600 ring-4 ring-blue-50/60">
                                {{ substr($user->name, 0, 1) }}
                            </div>

                            <h3 class="mt-4 text-sm sm:text-base font-semibold text-slate-900">
                                {{ $user->name }}
                            </h3>

                            <p class="mt-1 break-all text-xs sm:text-sm text-slate-500">
                                {{ $user->email }}
                            </p>

                            <span class="mt-3 inline-flex rounded-full bg-blue-50 px-3 py-1 text-[11px] sm:text-xs font-medium capitalize text-blue-700">
                                {{ $user->role }}
                            </span>
                        </div>

                        <div class="mt-6 space-y-4 border-t border-slate-100 pt-5">

                            <div class="rounded-xl bg-slate-50 px-4 py-3">
                                <p class="text-[11px] sm:text-xs text-slate-400">
                                    Akun dibuat
                                </p>

                                <p class="mt-1 text-xs sm:text-sm font-medium text-slate-700">
                                    {{ $user->created_at?->format('d F Y, H:i') ?? '—' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-slate-50 px-4 py-3">
                                <p class="text-[11px] sm:text-xs text-slate-400">
                                    Terakhir diperbarui
                                </p>

                                <p class="mt-1 text-xs sm:text-sm font-medium text-slate-700">
                                    {{ $user->updated_at?->format('d F Y, H:i') ?? '—' }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-red-200 bg-white shadow-sm">
                    <div class="flex items-start gap-3 border-b border-red-100 px-5 py-4">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm sm:text-base font-semibold text-red-700">
                                Hapus Akun
                            </h2>

                            <p class="mt-1 text-[11px] sm:text-xs text-slate-500">
                                Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>

                    <div class="p-5">
                        <form
                            method="POST"
                            action="{{ route('profile.destroy') }}"
                            onsubmit="return confirm('Yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.')"
                        >
                            @csrf
                            @method('DELETE')

                            <div>
                                <label
                                    for="delete_password"
                                    class="mb-1.5 block text-[13px] sm:text-sm font-medium text-slate-700"
                                >
                                    Password
                                </label>

                                <input
                                    id="delete_password"
                                    name="password"
                                    type="password"
                                    required
                                    placeholder="Masukkan password"
                                    class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3.5 text-xs sm:text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-red-400 focus:bg-white focus:ring-4 focus:ring-red-100"
                                >

                                @error('password', 'userDeletion')
                                    <p class="mt-1.5 text-[11px] sm:text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="mt-4 inline-flex h-10 w-full items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 text-[13px] sm:text-sm font-medium text-red-600 transition hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-100"
                            >
                                Hapus Akun
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-admin-layout>
