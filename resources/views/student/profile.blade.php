<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} - Profil Siswa</title>

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
            box-shadow: 0 4px 20px var(--student-shadow, rgba(15, 23, 42, .08));
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

        /* Badge status (lembut + titik penanda) */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 4px 10px;
            font-weight: 600;
            line-height: 1.25;
        }

        .status-badge::before {
            content: "";
            height: 6px;
            width: 6px;
            border-radius: 999px;
            background: currentColor;
        }

        .student-active   { background: #d1fae5; color: #047857; }
        .student-inactive { background: #e2e8f0; color: #475569; }

        /* Ikon judul section */
        .section-icon {
            display: inline-flex;
            height: 2rem;
            width: 2rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(37, 99, 235, .12);
            color: #2563EB;
        }

        .section-icon svg {
            height: 1rem;
            width: 1rem;
        }

        .avatar-ring {
            background: rgba(37, 99, 235, .12);
            color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .06);
        }

        /* Tombol biru tetap (tidak mengikuti variabel tema) */
        .btn-blue {
            background-color: #2563EB;
            box-shadow: 0 3px 8px rgba(37, 99, 235, .25);
            transition: filter .15s ease, transform .15s ease;
        }

        .btn-blue:hover {
            filter: brightness(1.1);
        }

        .btn-blue:active {
            transform: translateY(1px);
        }

        .btn-blue:focus-visible {
            outline: 2px solid #93c5fd;
            outline-offset: 2px;
        }

        .select-wrap select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
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

        html[data-student-theme="dark"] .section-icon,
        html[data-student-theme="dark"] .avatar-ring {
            color: #93c5fd;
        }
    </style>
</head>

<body class="min-h-screen antialiased">
    <x-student-sidebar />

    <div class="student-page lg:pl-64">
        <x-student-topbar :student="$student" title="Profil Siswa" />

        @php
            $label = 'mb-1.5 block text-xs sm:text-[13px] font-medium';
            $input = 'student-field box-border h-9 w-full rounded-lg px-3 text-xs sm:text-[13px] outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500';
            $errorText = 'mt-1.5 text-[11px] sm:text-xs';
            $infoLabel = 'text-[11px] sm:text-xs font-semibold uppercase tracking-wider student-muted';
            $infoValue = 'mt-1 text-xs sm:text-sm font-medium';
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pt-4 pb-4 sm:px-6 lg:px-10 lg:pt-6 lg:pb-6">

            {{-- Breadcrumb --}}
            <nav
                class="mb-3 flex items-center gap-1.5 text-[11px] font-medium sm:text-xs student-muted"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('student.dashboard') }}" class="hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>

                <span class="font-semibold" style="color: var(--student-text, #1f2937);">
                    Profil Siswa
                </span>
            </nav>

            {{-- Judul --}}
            <div class="mt-8 mb-12 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                        Profil Siswa
                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm student-muted">
                        Kelola informasi pribadi kamu.
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div class="student-success mb-6 rounded-xl px-4 py-3 text-xs sm:text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="student-error mb-6 rounded-xl px-4 py-3 text-xs sm:text-sm">
                    <p class="mb-1 font-semibold">Periksa kembali data yang dimasukkan.</p>

                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-[1fr_320px]">

                {{-- Informasi pribadi --}}
                <section class="student-card rounded-2xl p-5 shadow-sm sm:p-6">

                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21a8 8 0 0 1 16 0"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">Informasi Pribadi</h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs student-muted">
                                Perbarui data diri kamu.
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('student.profile.update') }}"
                        class="space-y-5"
                    >
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="name" class="{{ $label }}">Nama Lengkap</label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $student->name) }}"
                                required
                                class="{{ $input }}"
                            >

                            @error('name')
                                <p class="{{ $errorText }}" style="color: var(--student-danger, #dc2626);">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>
                                <label for="gender" class="{{ $label }}">Jenis Kelamin</label>

                                <div class="select-wrap relative">
                                    <select
                                        id="gender"
                                        name="gender"
                                        required
                                        class="{{ $input }} pr-9"
                                    >
                                        <option value="male" @selected(old('gender', $student->gender) === 'male')>
                                            Laki-laki
                                        </option>
                                        <option value="female" @selected(old('gender', $student->gender) === 'female')>
                                            Perempuan
                                        </option>
                                    </select>

                                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center student-muted">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </div>

                                @error('gender')
                                    <p class="{{ $errorText }}" style="color: var(--student-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="{{ $label }}">Nomor Telepon</label>

                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone', $student->phone) }}"
                                    class="{{ $input }}"
                                >

                                @error('phone')
                                    <p class="{{ $errorText }}" style="color: var(--student-danger, #dc2626);">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div>
                            <label for="address" class="{{ $label }}">Alamat</label>

                            <textarea
                                id="address"
                                name="address"
                                rows="4"
                                class="student-field box-border w-full resize-y rounded-lg px-3 py-2.5 text-xs outline-none transition-colors duration-150 sm:text-[13px] focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            >{{ old('address', $student->address) }}</textarea>

                            @error('address')
                                <p class="{{ $errorText }}" style="color: var(--student-danger, #dc2626);">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="student-divider flex justify-end border-t pt-5">
                            <button
                                type="submit"
                                class="btn-blue inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-xs font-semibold text-white sm:w-auto sm:text-[13px]"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </section>

                {{-- Detail akun --}}
                <section class="student-card rounded-2xl p-5 shadow-sm sm:p-6">

                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <circle cx="9" cy="11" r="2"/>
                                <path d="M5.5 16a3.5 3.5 0 0 1 7 0M15 10h3M15 14h3"/>
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">Detail Akun</h2>

                            <p class="mt-0.5 text-[11px] sm:text-xs student-muted">
                                Data akun kamu.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <div class="avatar-ring flex h-16 w-16 items-center justify-center rounded-full text-xl font-semibold uppercase">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <h3 class="mt-3 text-sm font-semibold sm:text-base">
                            {{ $student->name }}
                        </h3>

                        <p class="mt-0.5 break-all text-xs sm:text-sm student-muted">
                            {{ $student->identity_number }}
                        </p>

                        <span class="status-badge {{ $student->status === 'active' ? 'student-active' : 'student-inactive' }} mt-3 text-[11px] sm:text-xs">
                            {{ $student->status === 'active' ? 'Siswa Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <div class="student-divider mt-5 space-y-3 border-t pt-5">

                        <div class="student-field rounded-xl px-4 py-3">
                            <p class="{{ $infoLabel }}">NIS</p>
                            <p class="{{ $infoValue }}">{{ $student->identity_number }}</p>
                        </div>

                        <div class="student-field rounded-xl px-4 py-3">
                            <p class="{{ $infoLabel }}">Kelas</p>
                            <p class="{{ $infoValue }}">{{ $student->classRoom->name ?? '-' }}</p>
                        </div>

                        <div class="student-field rounded-xl px-4 py-3">
                            <p class="{{ $infoLabel }}">Jenis Kelamin</p>
                            <p class="{{ $infoValue }}">
                                {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>

                    </div>

                </section>

            </div>

        </main>
    </div>
</body>
</html>
