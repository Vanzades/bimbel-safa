<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Profil Guru</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('image/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/favicon-180x180.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .teacher-page {
            min-height: 100vh;
            background: var(--teacher-topbar, #F6F6F6);
            color: var(--teacher-text, #1f2937);
        }

        .teacher-card {
            border: 1px solid var(--teacher-border, #e5e7eb);
            background: var(--teacher-surface, #fff);
            box-shadow: 0 4px 20px var(--teacher-shadow, rgba(15, 23, 42, .08));
        }

        .teacher-field {
            border: 1px solid var(--teacher-border, #e5e7eb);
            background: var(--teacher-soft, #f6f7f9);
            color: var(--teacher-text, #1f2937);
        }

        .teacher-field:hover {
            border-color: var(--teacher-muted, #cbd5e1);
        }

        .teacher-field:focus {
            background: var(--teacher-surface, #fff);
        }

        .teacher-muted {
            color: var(--teacher-muted, #64748b);
        }

        .teacher-divider {
            border-color: var(--teacher-border, #e5e7eb);
        }

        .teacher-success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .teacher-error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

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
            width: 6px;
            height: 6px;
            flex-shrink: 0;
            border-radius: 999px;
            background: currentColor;
        }

        .teacher-active { background: #d1fae5; color: #047857; }
        .teacher-inactive { background: #e2e8f0; color: #475569; }

        .section-icon {
            display: inline-flex;
            width: 2rem;
            height: 2rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(37, 99, 235, .12);
            color: #2563EB;
        }

        .section-icon svg {
            width: 1rem;
            height: 1rem;
        }

        .avatar-ring {
            background: rgba(37, 99, 235, .12);
            color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .06);
        }

        .btn-blue {
            background-color: #2563EB;
            box-shadow: 0 3px 8px rgba(37, 99, 235, .25);
            transition: filter .15s ease, transform .15s ease;
        }

        .btn-blue:hover { filter: brightness(1.1); }
        .btn-blue:active { transform: translateY(1px); }
        .btn-blue:focus-visible { outline: 2px solid #93c5fd; outline-offset: 2px; }

        .select-wrap select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        html.dark .teacher-success {
            border-color: rgba(16, 185, 129, .18);
            background: rgba(16, 185, 129, .08);
            color: #6ee7b7;
        }

        html.dark .teacher-error {
            border-color: rgba(239, 68, 68, .18);
            background: rgba(239, 68, 68, .08);
            color: #fca5a5;
        }

        html.dark .teacher-active {
            background: rgba(16, 185, 129, .18);
            color: #6ee7b7;
        }

        html.dark .teacher-inactive {
            background: rgba(148, 163, 184, .16);
            color: #cbd5e1;
        }

        html.dark .section-icon,
        html.dark .avatar-ring {
            color: #93c5fd;
        }
    </style>
</head>
<body class="min-h-screen antialiased">
    <x-teacher-sidebar :teacher="$teacher" />

    <div class="teacher-page lg:pl-64">
        <x-teacher-topbar :teacher="$teacher" />

        @php
            $label = 'mb-1.5 block text-xs font-medium sm:text-[13px]';
            $input = 'teacher-field box-border h-9 w-full rounded-lg px-3 text-xs outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-[13px]';
            $errorText = 'mt-1.5 text-[11px] sm:text-xs';
            $infoLabel = 'teacher-muted text-[11px] font-semibold uppercase tracking-wider sm:text-xs';
            $infoValue = 'mt-1 break-words text-xs font-medium sm:text-sm';
        @endphp

        <main class="mx-auto w-full max-w-90rem px-4 pb-4 pt-4 sm:px-6 lg:px-10 lg:pb-6 lg:pt-6">
            {{-- Breadcrumb --}}
            <nav class="mb-3 flex min-w-0 items-center gap-1.5 text-[11px] font-medium sm:text-xs teacher-muted" aria-label="Breadcrumb">
                <a href="{{ route('teacher.dashboard') }}" class="shrink-0 transition-opacity hover:opacity-85">Dashboard</a>
                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>
                <span class="truncate font-semibold" style="color:var(--teacher-text,#1f2937)">Profil Guru</span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mb-8 mt-6 flex flex-col gap-3 sm:mb-8 sm:mt-7">
                <div>
                    <h1 class="text-xl font-bold tracking-tight sm:text-2xl">Profil Guru</h1>
                    <p class="mt-1.5 text-xs sm:text-sm teacher-muted">Kelola informasi pribadi dan lihat detail akun kamu.</p>
                </div>
            </div>

            @if (session('success'))
                <div role="status" class="teacher-success mb-5 rounded-xl px-4 py-3 text-xs sm:text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div role="alert" class="teacher-error mb-5 rounded-xl px-4 py-3 text-xs sm:text-sm">
                    <p class="mb-1 font-semibold">Periksa kembali data yang dimasukkan.</p>
                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid min-w-0 gap-5 lg:grid-cols-[minmax(0,1fr)_320px]">
                {{-- Form informasi pribadi --}}
                <section class="teacher-card min-w-0 rounded-2xl p-5 shadow-sm sm:p-6">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon" aria-hidden="true">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21a8 8 0 0 1 16 0"/>
                            </svg>
                        </span>
                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">Informasi Pribadi</h2>
                            <p class="mt-0.5 text-[11px] sm:text-xs teacher-muted">Perbarui data diri kamu.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('teacher.profile.update') }}" class="space-y-5">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="name" class="{{ $label }}">Nama Lengkap</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $teacher->name) }}"
                                autocomplete="name"
                                required
                                class="{{ $input }}"
                            >
                            @error('name')
                                <p class="{{ $errorText }} text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid min-w-0 gap-5 sm:grid-cols-2">
                            <div class="min-w-0">
                                <label for="gender" class="{{ $label }}">Jenis Kelamin</label>
                                <div class="select-wrap relative">
                                    <select id="gender" name="gender" required class="{{ $input }} pr-9">
                                        <option value="male" @selected(old('gender', $teacher->gender) === 'male')>Laki-laki</option>
                                        <option value="female" @selected(old('gender', $teacher->gender) === 'female')>Perempuan</option>
                                    </select>
                                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center teacher-muted">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </div>
                                @error('gender')
                                    <p class="{{ $errorText }} text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="min-w-0">
                                <label for="phone" class="{{ $label }}">Nomor Telepon</label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    value="{{ old('phone', $teacher->phone) }}"
                                    autocomplete="tel"
                                    class="{{ $input }}"
                                >
                                @error('phone')
                                    <p class="{{ $errorText }} text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="address" class="{{ $label }}">Alamat</label>
                            <textarea
                                id="address"
                                name="address"
                                rows="4"
                                class="teacher-field box-border w-full resize-y rounded-lg px-3 py-2.5 text-xs outline-none transition-colors duration-150 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-[13px]"
                            >{{ old('address', $teacher->address) }}</textarea>
                            @error('address')
                                <p class="{{ $errorText }} text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="teacher-divider flex justify-end border-t pt-5">
                            <button type="submit" class="btn-blue inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-xs font-semibold text-white sm:w-auto sm:text-[13px]">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </section>

                {{-- Detail akun --}}
                <section class="teacher-card min-w-0 rounded-2xl p-5 shadow-sm sm:p-6">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="section-icon" aria-hidden="true">
                            <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <circle cx="9" cy="11" r="2"/>
                                <path d="M5.5 16a3.5 3.5 0 0 1 7 0M15 10h3M15 14h3"/>
                            </svg>
                        </span>
                        <div>
                            <h2 class="text-sm font-semibold sm:text-base">Detail Akun</h2>
                            <p class="mt-0.5 text-[11px] sm:text-xs teacher-muted">Informasi akun guru kamu.</p>
                        </div>
                    </div>

                    <div class="flex min-w-0 flex-col items-center text-center">
                        <div class="avatar-ring flex h-16 w-16 items-center justify-center rounded-full text-xl font-semibold uppercase">
                            {{ strtoupper(substr($teacher->name ?? 'G', 0, 1)) }}
                        </div>
                        <h3 class="mt-3 max-w-full wrap-break-word text-sm font-semibold sm:text-base">{{ $teacher->name }}</h3>
                        <p class="mt-0.5 break-all text-xs sm:text-sm teacher-muted">{{ $teacher->identity_number ?: 'Nomor identitas belum tersedia' }}</p>

                        <span class="status-badge {{ $teacher->status === 'active' ? 'teacher-active' : 'teacher-inactive' }} mt-3 text-[11px] sm:text-xs">
                            {{ $teacher->status === 'active' ? 'Guru Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <div class="teacher-divider mt-5 space-y-3 border-t pt-5">
                        <div class="teacher-field min-w-0 rounded-xl px-4 py-3">
                            <p class="{{ $infoLabel }}">NIK / Nomor Identitas</p>
                            <p class="{{ $infoValue }}">{{ $teacher->identity_number ?: '-' }}</p>
                        </div>

                        <div class="teacher-field min-w-0 rounded-xl px-4 py-3">
                            <p class="{{ $infoLabel }}">Email Akun</p>
                            <p class="{{ $infoValue }}">{{ $teacher->user?->email ?? $teacher->email ?? 'Belum tersedia' }}</p>
                        </div>

                        <div class="teacher-field min-w-0 rounded-xl px-4 py-3">
                            <p class="{{ $infoLabel }}">Jenis Kelamin</p>
                            <p class="{{ $infoValue }}">
                                {{ $teacher->gender === 'male' ? 'Laki-laki' : ($teacher->gender === 'female' ? 'Perempuan' : '-') }}
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
