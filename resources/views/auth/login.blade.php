<x-guest-layout>
    <div class="flex min-h-screen w-full flex-col bg-blue-50">
        <div class="h-1 bg-blue-800"></div>

        <div class="flex flex-1 items-center justify-center px-5 py-10">
            <div class="w-full max-w-sm">

                <div class="mb-6 flex justify-center">
                    <a href="{{ url('/') }}" class="inline-flex">
                        <img src="{{ asset('image/logo.png') }}" alt="{{ config('app.name', 'Bimbel') }}" class="h-10 w-auto">
                    </a>
                </div>

                <div class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm sm:p-7">
                    <div class="mb-6 text-center">
                        <h1 class="text-xl font-semibold tracking-tight text-blue-950">
                            Masuk ke akun
                        </h1>

                        <p class="mt-1.5 text-sm text-blue-900/70">
                            Masukkan email dan password Anda.
                        </p>
                    </div>

                    <x-auth-session-status
                        class="mb-5"
                        :status="session('status')"
                    />

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label
                                for="email"
                                :value="'Email'"
                                class="mb-1.5 text-sm font-medium text-blue-950"
                            />

                            <div class="relative">
                                <svg class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 8 9 6 9-6M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z"/>
                                </svg>

                                <x-text-input
                                    id="email"
                                    class="block w-full rounded-lg border-blue-200 bg-white py-2.5 pr-3 pl-10 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="nama@email.com"
                                />
                            </div>

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="password"
                                :value="'Password'"
                                class="mb-1.5 text-sm font-medium text-blue-950"
                            />

                            <div class="relative">
                                <svg class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 10V7a4 4 0 0 0-8 0v3m-1 0h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1Z"/>
                                </svg>

                                <x-text-input
                                    id="password"
                                    class="block w-full rounded-lg border-blue-200 bg-white py-2.5 pr-20 pl-10 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                />

                                <button
                                    type="button"
                                    class="absolute top-1/2 right-2 -translate-y-1/2 rounded-md px-2 py-1 text-xs font-semibold text-blue-800 transition hover:bg-blue-50"
                                    aria-controls="password"
                                    onclick="const i = document.getElementById('password'); const s = i.type === 'password'; i.type = s ? 'text' : 'password'; this.textContent = s ? 'Sembunyikan' : 'Lihat';"
                                >Lihat</button>
                            </div>

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />
                        </div>

                        <label for="remember" class="inline-flex items-center">
                            <input
                                id="remember"
                                type="checkbox"
                                name="remember"
                                class="size-4 rounded border-blue-300 text-blue-800 focus:ring-blue-800"
                            >

                            <span class="ms-2 text-sm text-blue-900/70">
                                Ingat saya
                            </span>
                        </label>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-blue-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-900 focus:outline-hidden focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"
                        >
                            Masuk
                        </button>
                    </form>
                </div>

                <p class="mt-5 text-center text-xs leading-5 text-blue-900/60">
                    Akun pengguna dibuat dan dikelola oleh administrator sistem.
                </p>

                <div class="mt-3 text-center">
                    <a href="{{ url('/') }}" class="text-sm text-blue-800 transition hover:text-blue-900 hover:underline">
                        Kembali ke halaman utama
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
