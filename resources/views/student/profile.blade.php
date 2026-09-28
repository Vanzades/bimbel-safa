<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Profil Siswa</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .student-page {
            min-height: 100vh;
            background: var(--student-topbar, #F6F6F6);
            color: var(--student-text, #1f2937);
        }

        .student-card {
            border: 1px solid var(--student-border, #e5e7eb);
            background: var(--student-surface, #fff);
            box-shadow: 0 1px 2px var(--student-shadow, rgba(15, 23, 42, .08));
        }

        .student-field {
            border: 1px solid var(--student-border, #e5e7eb);
            background: var(--student-soft, #f6f7f9);
            color: var(--student-text, #1f2937);
        }

        .student-field:hover {
            border-color: var(--student-muted, #cbd5e1);
        }

        .student-field:focus {
            background: var(--student-surface, #fff);
        }

        .student-box {
            background: var(--student-soft, #f6f7f9);
        }

        .student-muted {
            color: var(--student-muted, #64748b);
        }

        .student-divider {
            border-color: var(--student-border, #e5e7eb);
        }

        .student-success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .student-error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .student-active {
            background: #059669;
            color: #fff;
        }

        .student-inactive {
            background: #64748b;
            color: #fff;
        }

        html[data-student-theme="dark"] .student-success {
            border-color: rgba(16, 185, 129, .18);
            background: rgba(16, 185, 129, .08);
            color: #6ee7b7;
        }

        html[data-student-theme="dark"] .student-error {
            border-color: rgba(239, 68, 68, .18);
            background: rgba(239, 68, 68, .08);
            color: #fca5a5;
        }

        html[data-student-theme="dark"] .student-active {
            background: rgba(16, 185, 129, .18);
            color: #6ee7b7;
        }

        html[data-student-theme="dark"] .student-inactive {
            background: rgba(148, 163, 184, .16);
            color: #cbd5e1;
        }
    </style>
</head>

<body class="min-h-screen antialiased">
    <x-student-sidebar />

    <div class="student-page lg:pl-64">
        <x-student-topbar :student="$student" title="Profil Siswa" />

        <main class="mx-auto w-full max-w-90rem px-4 py-4 pb-10 sm:px-6 lg:px-10 lg:py-6">
            <div class="space-y-6">

                <nav
                    class="flex items-center gap-1.5 text-[11px] font-medium sm:text-xs student-muted"
                    aria-label="Breadcrumb"
                >
                    <a href="{{ route('student.dashboard') }}" class="transition hover:text-blue-600">
                        Dashboard
                    </a>

                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                    </svg>

                    <span class="font-semibold" style="color: var(--student-text, #1f2937);">
                        Profil Siswa
                    </span>
                </nav>

                <div>
                    <h1 class="text-xl font-semibold tracking-tight sm:text-2xl">
                        Profil Siswa
                    </h1>

                    <p class="mt-1 text-xs sm:text-sm student-muted">
                        Kelola informasi pribadi kamu.
                    </p>
                </div>

                @if (session('success'))
                    <div class="student-success rounded-xl px-4 py-3 text-xs sm:text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="student-error rounded-xl px-4 py-3 text-xs sm:text-sm">
                        <p class="mb-1 font-semibold">Periksa kembali data yang dimasukkan.</p>
                        <ul class="list-inside list-disc space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid gap-6 lg:grid-cols-[1fr_320px]">

                    <section class="student-card overflow-hidden rounded-2xl">
                        <div class="student-divider flex items-center gap-3 border-b px-5 py-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 text-blue-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </div>

                            <h2 class="text-sm font-semibold sm:text-base">Informasi Pribadi</h2>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('student.profile.update') }}"
                            class="space-y-5 p-5"
                        >
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="name" class="mb-1.5 block text-[13px] font-medium sm:text-sm">
                                    Nama Lengkap
                                </label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', $student->name) }}"
                                    required
                                    class="student-field h-11 w-full rounded-xl px-3.5 text-xs outline-none transition sm:text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20"
                                >
                                @error('name')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--student-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="gender" class="mb-1.5 block text-[13px] font-medium sm:text-sm">
                                    Jenis Kelamin
                                </label>
                                <select
                                    id="gender"
                                    name="gender"
                                    required
                                    class="student-field h-11 w-full rounded-xl px-3.5 text-xs outline-none transition sm:text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20"
                                >
                                    <option value="male" @selected(old('gender', $student->gender) === 'male')>
                                        Laki-laki
                                    </option>
                                    <option value="female" @selected(old('gender', $student->gender) === 'female')>
                                        Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--student-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="mb-1.5 block text-[13px] font-medium sm:text-sm">
                                    Nomor Telepon
                                </label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone', $student->phone) }}"
                                    class="student-field h-11 w-full rounded-xl px-3.5 text-xs outline-none transition sm:text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20"
                                >
                                @error('phone')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--student-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="address" class="mb-1.5 block text-[13px] font-medium sm:text-sm">
                                    Alamat
                                </label>
                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    class="student-field w-full resize-y rounded-xl px-3.5 py-3 text-xs outline-none transition sm:text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20"
                                >{{ old('address', $student->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--student-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="student-divider flex justify-end border-t pt-5">
                                <button
                                    type="submit"
                                    class="inline-flex h-10 items-center justify-center rounded-xl bg-blue-600 px-5 text-[13px] font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 sm:text-sm"
                                >
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </section>

                    <section class="student-card overflow-hidden rounded-2xl">
                        <div class="student-divider flex items-center gap-3 border-b px-5 py-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 text-blue-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z"/>
                                </svg>
                            </div>

                            <h2 class="text-sm font-semibold sm:text-base">Detail Akun</h2>
                        </div>

                        <div class="p-5">
                            <div class="flex flex-col items-center text-center">
                                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-500/10 text-2xl font-semibold uppercase text-blue-600 ring-4 ring-blue-500/5">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>

                                <h3 class="mt-4 text-sm font-semibold sm:text-base">
                                    {{ $student->name }}
                                </h3>

                                <p class="mt-1 break-all text-xs sm:text-sm student-muted">
                                    {{ $student->identity_number }}
                                </p>

                                <span class="{{ $student->status === 'active' ? 'student-active' : 'student-inactive' }} mt-3 inline-flex rounded-full px-3 py-1 text-[11px] font-medium sm:text-xs">
                                    {{ $student->status === 'active' ? 'Siswa Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            <div class="student-divider mt-6 space-y-4 border-t pt-5">
                                <div class="student-box rounded-xl px-4 py-3">
                                    <p class="text-[11px] sm:text-xs student-muted">NIS</p>
                                    <p class="mt-1 text-xs font-medium sm:text-sm">
                                        {{ $student->identity_number }}
                                    </p>
                                </div>

                                <div class="student-box rounded-xl px-4 py-3">
                                    <p class="text-[11px] sm:text-xs student-muted">Kelas</p>
                                    <p class="mt-1 text-xs font-medium sm:text-sm">
                                        {{ $student->classRoom->name ?? '-' }}
                                    </p>
                                </div>

                                <div class="student-box rounded-xl px-4 py-3">
                                    <p class="text-[11px] sm:text-xs student-muted">Jenis Kelamin</p>
                                    <p class="mt-1 text-xs font-medium sm:text-sm">
                                        {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </main>
    </div>
</body>
</html>
