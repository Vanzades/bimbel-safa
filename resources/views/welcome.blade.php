<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white text-slate-950 antialiased">
    <div class="min-h-screen">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-md bg-slate-950 text-sm font-bold text-white">
                        B
                    </div>

                    <div>
                        <div class="text-sm font-semibold text-slate-950">
                            Bimbel
                        </div>

                        <div class="text-xs text-slate-500">
                            Sistem Informasi Bimbingan Belajar
                        </div>
                    </div>
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-300 hover:bg-slate-50"
                            >
                                Dashboard
                            </a>
                        @elseif (auth()->user()->isSiswa())
                            <a
                                href="{{ route('student.dashboard') }}"
                                class="inline-flex items-center border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-300 hover:bg-slate-50"
                            >
                                Student Portal
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center bg-slate-950 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800"
                            >
                                Masuk
                            </a>
                        @endif
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center bg-slate-950 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800"
                        >
                            Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <main>
            <section class="border-b border-slate-200 bg-slate-50">
                <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8 lg:py-28">
                    <div class="max-w-3xl">
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                            Sistem Informasi Bimbingan Belajar
                        </p>

                        <h1 class="mt-4 text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                            Kelola kegiatan bimbingan belajar dalam satu sistem.
                        </h1>

                        <p class="mt-6 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
                            Bimbel membantu pengelolaan data siswa, guru, kelas, jadwal,
                            absensi, dan pembayaran SPP secara terpusat dan terstruktur.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <a
                                        href="{{ route('admin.dashboard') }}"
                                        class="inline-flex items-center justify-center bg-slate-950 px-5 py-3 text-sm font-medium text-white transition hover:bg-slate-800"
                                    >
                                        Buka Dashboard
                                    </a>
                                @elseif (auth()->user()->isSiswa())
                                    <a
                                        href="{{ route('student.dashboard') }}"
                                        class="inline-flex items-center justify-center bg-slate-950 px-5 py-3 text-sm font-medium text-white transition hover:bg-slate-800"
                                    >
                                        Buka Student Portal
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="inline-flex items-center justify-center bg-slate-950 px-5 py-3 text-sm font-medium text-white transition hover:bg-slate-800"
                                    >
                                        Masuk ke Sistem
                                    </a>
                                @endif
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center bg-slate-950 px-5 py-3 text-sm font-medium text-white transition hover:bg-slate-800"
                                >
                                    Masuk ke Sistem
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </section>

            <section class="border-b border-slate-200 bg-white">
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                    <div class="grid gap-px overflow-hidden border border-slate-200 bg-slate-200 md:grid-cols-3">
                        <div class="bg-white p-6 sm:p-8">
                            <div class="flex h-10 w-10 items-center justify-center rounded-md bg-slate-100 text-sm font-semibold text-slate-700">
                                01
                            </div>

                            <h2 class="mt-5 text-base font-semibold text-slate-950">
                                Data Terpusat
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Kelola data guru, siswa, kelas, akun, dan informasi akademik
                                dalam satu sistem.
                            </p>
                        </div>

                        <div class="bg-white p-6 sm:p-8">
                            <div class="flex h-10 w-10 items-center justify-center rounded-md bg-slate-100 text-sm font-semibold text-slate-700">
                                02
                            </div>

                            <h2 class="mt-5 text-base font-semibold text-slate-950">
                                Akademik
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Pantau jadwal kelas, absensi siswa, serta informasi akademik
                                secara lebih terorganisir.
                            </p>
                        </div>

                        <div class="bg-white p-6 sm:p-8">
                            <div class="flex h-10 w-10 items-center justify-center rounded-md bg-slate-100 text-sm font-semibold text-slate-700">
                                03
                            </div>

                            <h2 class="mt-5 text-base font-semibold text-slate-950">
                                Pembayaran SPP
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Kelola tagihan SPP, status pembayaran, dan riwayat pembayaran
                                siswa secara terstruktur.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white">
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                    <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Akses Berdasarkan Peran
                            </p>

                            <h2 class="mt-2 text-2xl font-semibold tracking-tight text-slate-950 sm:text-3xl">
                                Setiap pengguna memiliki akses sesuai kebutuhannya.
                            </h2>

                            <p class="mt-4 max-w-xl text-sm leading-6 text-slate-500 sm:text-base">
                                Sistem membedakan akses berdasarkan peran pengguna sehingga
                                pengelolaan administrasi dan informasi siswa dapat dilakukan
                                melalui area masing-masing.
                            </p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="border border-slate-200 p-5">
                                <p class="text-sm font-semibold text-slate-950">
                                    Admin
                                </p>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Mengelola data dan administrasi sistem.
                                </p>
                            </div>

                            <div class="border border-slate-200 p-5">
                                <p class="text-sm font-semibold text-slate-950">
                                    Guru
                                </p>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Mengakses informasi kelas dan kegiatan akademik.
                                </p>
                            </div>

                            <div class="border border-slate-200 p-5">
                                <p class="text-sm font-semibold text-slate-950">
                                    Siswa
                                </p>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Memantau profil, absensi, dan SPP.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-slate-200 bg-slate-50">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-6 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <div>
                    <p class="text-sm font-semibold text-slate-900">
                        Bimbel
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Sistem Informasi Bimbingan Belajar
                    </p>
                </div>

                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} Bimbel. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
