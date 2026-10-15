@php
    $name = config('app.name', 'Bimbel Safa');

    $programs = [
        [
            'slug' => 'sd',
            'level' => 'SD',
            'title' => 'Program Sekolah Dasar',
            'description' => 'Pendampingan belajar untuk membantu siswa memahami pelajaran sekolah sekaligus memperkuat kemampuan dasar.',
            'subjects' => ['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Membaca, Menulis & Berhitung'],
        ],
        [
            'slug' => 'smp',
            'level' => 'SMP',
            'title' => 'Program Sekolah Menengah Pertama',
            'description' => 'Pembelajaran yang membantu siswa memperdalam materi sekolah dan mempersiapkan diri menghadapi ujian.',
            'subjects' => ['Matematika', 'IPA', 'Bahasa Inggris', 'Persiapan Ujian'],
        ],
        [
            'slug' => 'sma',
            'level' => 'SMA',
            'title' => 'Program Sekolah Menengah Atas',
            'description' => 'Pendampingan mata pelajaran dan persiapan siswa menghadapi ujian serta jenjang pendidikan berikutnya.',
            'subjects' => ['Matematika', 'Bahasa Inggris', 'Mata Pelajaran Sekolah', 'Persiapan Ujian'],
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta
        name="description"
        content="Program belajar {{ $name }} untuk siswa SD, SMP, dan SMA."
    >

    <title>Program Belajar - {{ $name }}</title>

    <link rel="icon" href="{{ asset('image/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('image/favicon-512x512.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/favicon-512x512.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
        }

        .font-display {
            font-family: 'Bricolage Grotesque', 'Figtree', ui-sans-serif, system-ui, sans-serif;
        }

        .soft-grid {
            background-image:
                linear-gradient(rgba(37, 99, 235, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 99, 235, 0.04) 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>

<body class="min-h-screen bg-white text-slate-900 antialiased">

    <x-public-navbar />

    <main>
        <section class="soft-grid border-b border-slate-100 pt-32">
            <div class="mx-auto max-w-6xl px-4 pb-20 sm:px-6 lg:px-8 lg:pb-24">
                <div class="max-w-3xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                        Program Belajar
                    </span>

                    <h1 class="font-display mt-5 text-5xl font-bold leading-[1.05] tracking-tight text-slate-900 sm:text-6xl">
                        Program yang disesuaikan dengan jenjang belajar.
                    </h1>

                    <p class="mt-7 max-w-2xl text-lg leading-8 text-slate-600">
                        Pilih program berdasarkan jenjang sekolah siswa dan temukan
                        pendampingan belajar yang sesuai dengan kebutuhannya.
                    </p>
                </div>
            </div>
        </section>

        <section class="bg-slate-50">
            <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
                <div class="grid gap-5 lg:grid-cols-3">
                    @foreach ($programs as $program)
                        <article class="group flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5">
                            <div class="flex items-center justify-between border-b border-slate-100 px-7 py-6">
                                <span class="font-display text-5xl font-bold text-blue-600">
                                    {{ $program['level'] }}
                                </span>

                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5"/>
                                    </svg>
                                </span>
                            </div>

                            <div class="flex flex-1 flex-col p-7">
                                <h2 class="font-display text-2xl font-semibold tracking-tight text-slate-900">
                                    {{ $program['title'] }}
                                </h2>

                                <p class="mt-4 text-sm leading-6 text-slate-500">
                                    {{ $program['description'] }}
                                </p>

                                <div class="mt-7">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                        Fokus Pembelajaran
                                    </p>

                                    <ul class="mt-4 space-y-3">
                                        @foreach ($program['subjects'] as $subject)
                                            <li class="flex items-start gap-3 text-sm text-slate-600">
                                                <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                                                    </svg>
                                                </span>

                                                <span>{{ $subject }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <a
                                    href="{{ route('program.detail', $program['slug']) }}"
                                    class="mt-8 inline-flex h-11 items-center justify-center rounded-full bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-blue-600"
                                >
                                    Lihat Detail {{ $program['level'] }}
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
                <div class="grid gap-12 lg:grid-cols-12 lg:items-center lg:gap-16">
                    <div class="lg:col-span-5">
                        <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                            Pendekatan Belajar
                        </span>

                        <h2 class="font-display mt-4 text-4xl font-bold leading-tight tracking-tight text-slate-900 sm:text-5xl">
                            Bukan hanya mengejar materi.
                        </h2>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2 lg:col-span-7">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 text-sm font-semibold text-white">
                                01
                            </span>

                            <h3 class="mt-6 font-display text-lg font-semibold text-slate-900">
                                Pahami konsep
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Siswa memahami dasar materi sebelum masuk ke latihan yang lebih kompleks.
                            </p>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 text-sm font-semibold text-white">
                                02
                            </span>

                            <h3 class="mt-6 font-display text-lg font-semibold text-slate-900">
                                Latihan
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Materi diperkuat melalui latihan agar siswa semakin terbiasa menerapkan konsep.
                            </p>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 text-sm font-semibold text-white">
                                03
                            </span>

                            <h3 class="mt-6 font-display text-lg font-semibold text-slate-900">
                                Evaluasi
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Pemahaman siswa dapat dievaluasi untuk mengetahui bagian yang masih perlu diperkuat.
                            </p>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 text-sm font-semibold text-white">
                                04
                            </span>

                            <h3 class="mt-6 font-display text-lg font-semibold text-slate-900">
                                Berkembang
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Siswa membangun kepercayaan diri dan kebiasaan belajar yang lebih baik.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-blue-50">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
                <div class="rounded-[2rem] bg-blue-600 px-7 py-12 text-center text-white sm:px-12">
                    <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">
                        Temukan program yang tepat.
                    </h2>

                    <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-blue-100 sm:text-base">
                        Daftarkan diri dan mulai proses belajar bersama {{ $name }}.
                    </p>

                    <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex h-12 items-center justify-center rounded-full bg-white px-6 text-sm font-semibold text-blue-700 transition hover:bg-blue-50"
                        >
                            Daftar Sekarang
                        </a>

                        <a
                            href="{{ route('kontak') }}"
                            class="inline-flex h-12 items-center justify-center rounded-full border border-white/30 px-6 text-sm font-semibold text-white transition hover:bg-white/10"
                        >
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-public-footer />

</body>
</html>