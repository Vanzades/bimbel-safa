@php
    $name = config('app.name', 'Bimbel Safa');

    $programs = [
        [
            'level' => 'SD',
            'title' => 'Fondasi belajar yang kuat',
            'description' => 'Pendampingan pelajaran sekolah dan penguatan kemampuan membaca, menulis, berhitung, serta pemahaman materi dasar.',
        ],
        [
            'level' => 'SMP',
            'title' => 'Lebih siap menghadapi pelajaran',
            'description' => 'Pendalaman Matematika, IPA, Bahasa Inggris, dan materi sekolah untuk membantu siswa belajar lebih percaya diri.',
        ],
        [
            'level' => 'SMA',
            'title' => 'Persiapan menuju jenjang berikutnya',
            'description' => 'Pendampingan mata pelajaran dan persiapan menghadapi ujian dengan pembelajaran yang lebih terarah.',
        ],
    ];

    $strengths = [
        [
            'number' => '01',
            'title' => 'Kelas lebih fokus',
            'description' => 'Jumlah siswa yang terkontrol membuat proses belajar lebih fokus dan guru dapat memberikan perhatian lebih.',
        ],
        [
            'number' => '02',
            'title' => 'Pendampingan guru',
            'description' => 'Materi dijelaskan secara runtut dan disesuaikan dengan kebutuhan belajar siswa.',
        ],
        [
            'number' => '03',
            'title' => 'Jadwal teratur',
            'description' => 'Jadwal belajar tersusun jelas sehingga siswa dapat membangun kebiasaan belajar yang konsisten.',
        ],
        [
            'number' => '04',
            'title' => 'Perkembangan terpantau',
            'description' => 'Informasi absensi dan pembayaran dapat dipantau melalui Student Portal.',
        ],
    ];

    $steps = [
        [
            'number' => '01',
            'title' => 'Kenali program',
            'description' => 'Pilih jenjang belajar yang sesuai dengan kebutuhan siswa.',
        ],
        [
            'number' => '02',
            'title' => 'Daftar',
            'description' => 'Buat akun dan lengkapi informasi pendaftaran yang diperlukan.',
        ],
        [
            'number' => '03',
            'title' => 'Mulai belajar',
            'description' => 'Dapatkan informasi kelas dan mulai mengikuti kegiatan belajar.',
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
        content="{{ $name }} adalah bimbingan belajar yang membantu siswa belajar lebih terarah dan berkembang dengan percaya diri."
    >

    <title>{{ $name }} - Bimbingan Belajar</title>

    <link rel="icon" href="{{ asset('image/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('image/favicon-512x512.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/favicon-512x512.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand: #2563eb;
            --brand-dark: #1d4ed8;
            --brand-soft: #eff6ff;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
        }

        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
        }

        .font-display {
            font-family: 'Bricolage Grotesque', 'Figtree', ui-sans-serif, system-ui, sans-serif;
        }

        .hero-bg {
            background-image:
                linear-gradient(90deg, rgba(7, 24, 58, 0.88) 0%, rgba(7, 24, 58, 0.62) 45%, rgba(7, 24, 58, 0.18) 100%),
                url('{{ asset('image/hero.jpg') }}');
            background-position: center;
            background-size: cover;
        }

        .hero-fallback {
            background:
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.3), transparent 35%),
                linear-gradient(135deg, #0f2f68 0%, #1d4ed8 55%, #2563eb 100%);
        }

        .soft-grid {
            background-image:
                linear-gradient(rgba(37, 99, 235, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 99, 235, 0.04) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
        }

.promo-popup {
    position: fixed;
    inset: 0;
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(15, 23, 42, 0.58);
    backdrop-filter: blur(4px);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.25s ease, visibility 0.25s ease;
}

.promo-popup.is-visible {
    opacity: 1;
    visibility: visible;
}

.promo-popup-card {
    position: relative;
    width: min(420px, 100%);
    aspect-ratio: 1 / 1;
    overflow: hidden;
    border-radius: 24px;
    background: #fff;
    box-shadow: 0 25px 70px rgba(15, 23, 42, 0.25);
    transform: scale(0.94) translateY(10px);
    transition: transform 0.3s ease;
}

.promo-popup.is-visible .promo-popup-card {
    transform: scale(1) translateY(0);
}

.promo-popup-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.promo-popup-close {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 2;
    display: flex;
    width: 38px;
    height: 38px;
    align-items: center;
    justify-content: center;
    border: 0;
    border-radius: 999px;
    background: rgba(15, 23, 42, 0.72);
    color: #fff;
    cursor: pointer;
    backdrop-filter: blur(8px);
    transition: background 0.2s ease, transform 0.2s ease;
}

.promo-popup-close:hover {
    background: rgba(15, 23, 42, 0.9);
    transform: scale(1.05);
}

.promo-popup-close svg {
    width: 19px;
    height: 19px;
}

.promo-popup-link {
    position: absolute;
    inset: 0;
    z-index: 1;
}

@media (max-width: 640px) {
    .promo-popup {
        padding: 16px;
    }

    .promo-popup-card {
        width: min(360px, 100%);
        border-radius: 20px;
    }

    .promo-popup-close {
        top: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
    }
}


.program-background {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    background-color: #102b50;
    background-image:
        linear-gradient(115deg, rgba(8, 28, 59, 0.91), rgba(20, 70, 130, 0.76)),
        url('{{ asset('image/program.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.program-background::before {
    position: absolute;
    inset: 0;
    z-index: -1;
    background-image: radial-gradient(circle at 85% 15%, rgba(147, 197, 253, 0.22), transparent 34%);
    content: "";
    pointer-events: none;
}

.program-background .program-card {
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.96);
    box-shadow: 0 16px 45px rgba(2, 12, 27, 0.15);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.program-background .program-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 24px 50px rgba(2, 12, 27, 0.25);
}

.program-background .program-link {
    color: #bfdbfe;
}

.program-background .program-link:hover {
    color: #fff;
}

.reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}

.reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.testimonial-card {
    border: 1px solid #e2e8f0;
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
}

.testimonial-stars {
    color: #f59e0b;
    letter-spacing: 0.15em;
}

@media (max-width: 767px) {
    .program-background {
        background-attachment: scroll;
    }
}

@media (prefers-reduced-motion: reduce) {
    html {
        scroll-behavior: auto;
    }

    .reveal {
        opacity: 1;
        transform: none;
        transition: none;
    }

    .program-background .program-card,
    .testimonial-card {
        transition: none;
    }
}
    </style>
</head>

<body class="min-h-screen bg-white text-slate-900 antialiased">

    <x-public-navbar />

    <main>
        <section class="relative min-h-[720px] overflow-hidden bg-slate-900">
            @if (file_exists(public_path('image/hero.jpg')))
                <div class="hero-bg absolute inset-0"></div>
            @else
                <div class="hero-fallback absolute inset-0"></div>
            @endif

            <div class="absolute inset-0 bg-slate-950/10"></div>

            <div class="relative mx-auto flex min-h-[720px] max-w-6xl items-center px-4 pb-20 pt-32 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white backdrop-blur-md">
                        <span class="h-2 w-2 rounded-full bg-blue-400"></span>
                        Bimbingan belajar untuk masa depan yang lebih baik
                    </div>

                    <h1 class="font-display max-w-3xl text-5xl font-bold leading-[1.05] tracking-tight text-white sm:text-6xl lg:text-7xl">
                        Belajar lebih terarah.
                        <span class="text-blue-300">Berkembang lebih percaya diri.</span>
                    </h1>

                    <p class="mt-7 max-w-2xl text-base leading-7 text-white/80 sm:text-lg">
                        {{ $name }} hadir untuk mendampingi siswa memahami pelajaran,
                        membangun kebiasaan belajar, dan mencapai perkembangan yang lebih baik
                        melalui program belajar yang terarah.
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex h-13 items-center justify-center rounded-full bg-white px-7 text-sm font-semibold text-blue-700 shadow-xl shadow-slate-950/20 transition hover:bg-blue-50"
                        >
                            Daftar Sekarang
                        </a>

                        <a
                            href="{{ route('program') }}"
                            class="inline-flex h-13 items-center justify-center rounded-full border border-white/30 bg-white/10 px-7 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/20"
                        >
                            Lihat Program
                        </a>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-slate-950/30 to-transparent"></div>
        </section>

        <section class="border-b border-slate-100 bg-white">
            <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="grid gap-6 sm:grid-cols-3">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Jadwal teratur</p>
                            <p class="mt-0.5 text-sm text-slate-500">Belajar lebih konsisten</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m10-4.13a4 4 0 1 0-8 0 4 4 0 0 0 8 0Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Pendampingan</p>
                            <p class="mt-0.5 text-sm text-slate-500">Belajar bersama guru</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6m4 6V7m4 10v-3M5 21h14a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Perkembangan terpantau</p>
                            <p class="mt-0.5 text-sm text-slate-500">Informasi tersimpan rapi</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="soft-grid">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
                <div class="grid gap-12 lg:grid-cols-12 lg:items-center lg:gap-16">
                    <div class="lg:col-span-5">
                        <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                            Tentang Kami
                        </span>

                        <h2 class="font-display mt-4 text-4xl font-bold leading-tight tracking-tight text-slate-900 sm:text-5xl">
                            Tempat belajar yang membantu siswa terus berkembang.
                        </h2>
                    </div>

                    <div class="space-y-5 text-base leading-7 text-slate-600 lg:col-span-7">
                        <p>
                            Kami percaya setiap siswa memiliki cara belajar dan kebutuhan yang berbeda.
                            Karena itu, proses pembelajaran perlu dilakukan dengan pendampingan yang jelas,
                            suasana yang nyaman, dan jadwal yang teratur.
                        </p>

                        <p>
                            Melalui {{ $name }}, siswa mendapatkan ruang untuk memahami materi,
                            bertanya, berlatih, dan membangun kepercayaan diri dalam proses belajarnya.
                        </p>

                        <a
                            href="{{ route('tentang') }}"
                            class="inline-flex items-center gap-2 pt-2 text-sm font-semibold text-blue-600 transition hover:text-blue-700"
                        >
                            Kenali {{ $name }}
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        
<section class="program-background">
    <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
        <div class="reveal flex flex-col justify-between gap-6 md:flex-row md:items-end">
            <div class="max-w-2xl">
                <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-200">
                    Program Belajar
                </span>

                <h2 class="font-display mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl">
                    Program untuk setiap jenjang.
                </h2>

                <p class="mt-4 text-base leading-7 text-blue-100">
                    Temukan program belajar yang sesuai dengan jenjang dan kebutuhan siswa bersama {{ $name }}.
                </p>
            </div>

            <a
                href="{{ route('program') }}"
                class="program-link inline-flex shrink-0 items-center gap-2 text-sm font-semibold transition"
            >
                Lihat semua program
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5"/>
                </svg>
            </a>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach ($programs as $program)
                <a
                    href="{{ route('program.detail', strtolower($program['level'])) }}"
                    class="program-card reveal group relative overflow-hidden rounded-3xl p-7"
                >
                    <div class="flex items-start justify-between">
                        <span class="font-display text-5xl font-bold text-blue-600">
                            {{ $program['level'] }}
                        </span>

                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5"/>
                            </svg>
                        </span>
                    </div>

                    <h3 class="font-display mt-8 text-xl font-semibold text-slate-900">
                        {{ $program['title'] }}
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        {{ $program['description'] }}
                    </p>

                    <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">
                        Pelajari program
                        <span aria-hidden="true">→</span>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>


<section class="bg-white">
    <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
        <div class="reveal mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                Cerita dan Pengalaman
            </span>

            <h2 class="font-display mt-4 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                Pengalaman belajar yang berarti.
            </h2>

            <p class="mt-4 text-base leading-7 text-slate-600">
                Setiap perjalanan belajar memiliki cerita. Kami ingin terus membangun
                lingkungan belajar yang nyaman bagi siswa dan orang tua.
            </p>
        </div>

        <div class="mt-12 grid gap-5 md:grid-cols-3">
            <article class="testimonial-card reveal rounded-3xl p-7">
                <div class="testimonial-stars text-lg" aria-label="Contoh rating lima bintang">
                    ★★★★★
                </div>

                <p class="mt-5 text-sm leading-7 text-slate-600">
                    “Saya merasa terbantu ketika belajar dengan pendampingan yang terarah
                    dan penjelasan materi yang mudah dipahami.”
                </p>

                <div class="mt-6 border-t border-slate-100 pt-5">
                    <p class="font-semibold text-slate-900">Contoh testimoni siswa</p>
                    <p class="mt-1 text-xs text-slate-500">Ganti dengan ulasan siswa sebenarnya</p>
                </div>
            </article>

            <article class="testimonial-card reveal rounded-3xl p-7">
                <div class="testimonial-stars text-lg" aria-label="Contoh rating lima bintang">
                    ★★★★★
                </div>

                <p class="mt-5 text-sm leading-7 text-slate-600">
                    “Kami berharap anak dapat belajar dengan lebih teratur,
                    berani bertanya, dan semakin percaya diri saat memahami pelajaran.”
                </p>

                <div class="mt-6 border-t border-slate-100 pt-5">
                    <p class="font-semibold text-slate-900">Contoh testimoni orang tua</p>
                    <p class="mt-1 text-xs text-slate-500">Ganti dengan ulasan orang tua sebenarnya</p>
                </div>
            </article>

            <article class="testimonial-card reveal rounded-3xl p-7">
                <div class="testimonial-stars text-lg" aria-label="Contoh rating lima bintang">
                    ★★★★★
                </div>

                <p class="mt-5 text-sm leading-7 text-slate-600">
                    “Suasana belajar yang nyaman dapat membantu siswa berlatih,
                    bertanya, dan membangun kebiasaan belajar yang lebih baik.”
                </p>

                <div class="mt-6 border-t border-slate-100 pt-5">
                    <p class="font-semibold text-slate-900">Contoh pengalaman belajar</p>
                    <p class="mt-1 text-xs text-slate-500">Ganti dengan ulasan yang terverifikasi</p>
                </div>
            </article>
        </div>

        <div class="reveal mt-10 text-center">
            <a
                href="{{ route('kontak') }}"
                class="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                Kenali {{ $name }} lebih lanjut
            </a>
        </div>
    </div>
</section>

        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
                <div class="max-w-2xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                        Kenapa {{ $name }}
                    </span>

                    <h2 class="font-display mt-4 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        Belajar dengan sistem yang lebih terarah.
                    </h2>
                </div>

                <div class="mt-12 grid gap-x-12 gap-y-10 sm:grid-cols-2">
                    @foreach ($strengths as $item)
                        <div class="border-t border-slate-200 pt-6">
                            <span class="text-sm font-semibold text-blue-600">
                                {{ $item['number'] }}
                            </span>

                            <h3 class="font-display mt-3 text-xl font-semibold text-slate-900">
                                {{ $item['title'] }}
                            </h3>

                            <p class="mt-2 max-w-lg text-sm leading-6 text-slate-500">
                                {{ $item['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-blue-50">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
                <div class="max-w-2xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                        Cara Bergabung
                    </span>

                    <h2 class="font-display mt-4 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        Mulai belajar dalam tiga langkah.
                    </h2>
                </div>

                <div class="mt-12 grid gap-5 md:grid-cols-3">
                    @foreach ($steps as $step)
                        <div class="rounded-3xl border border-blue-100 bg-white p-7">
                            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white">
                                {{ $step['number'] }}
                            </span>

                            <h3 class="font-display mt-7 text-xl font-semibold text-slate-900">
                                {{ $step['title'] }}
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                {{ $step['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-white px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="mx-auto max-w-6xl overflow-hidden rounded-[2rem] bg-blue-600 px-7 py-12 text-white sm:px-12 lg:px-16 lg:py-14">
                <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-center">
                    <div class="max-w-2xl">
                        <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">
                            Siap memulai perjalanan belajar?
                        </h2>

                        <p class="mt-4 max-w-xl text-sm leading-6 text-blue-100 sm:text-base">
                            Kenali program {{ $name }} dan pilih pembelajaran yang paling sesuai
                            untuk kebutuhan siswa.
                        </p>
                    </div>

                    <div class="flex shrink-0 flex-col gap-3 sm:flex-row">
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
<div id="promoPopup" class="promo-popup" aria-hidden="true">
    <div class="promo-popup-card" role="dialog" aria-modal="true" aria-label="Informasi promo">
        <button
            type="button"
            id="promoPopupClose"
            class="promo-popup-close"
            aria-label="Tutup promo"
        >
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18"/>
            </svg>
        </button>

        <a href="{{ route('register') }}" class="promo-popup-link" aria-label="Daftar sekarang"></a>

        <img
            src="{{ asset('image/promo.jpg') }}"
            alt="Promo {{ $name }}"
            class="promo-popup-image"
        >
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const elements = document.querySelectorAll(
            'main section > div, main section .grid > *, main section .reveal'
        );

        elements.forEach(function (element) {
            element.classList.add('reveal');
        });

        if (
            window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
            !('IntersectionObserver' in window)
        ) {
            elements.forEach(function (element) {
                element.classList.add('is-visible');
            });

            return;
        }

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -30px 0px'
        });

        elements.forEach(function (element, index) {
            element.style.transitionDelay = `${(index % 3) * 90}ms`;
            observer.observe(element);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popup = document.getElementById('promoPopup');
        const closeButton = document.getElementById('promoPopupClose');

        if (!popup || !closeButton) {
            return;
        }

        if (sessionStorage.getItem('promoPopupClosed') !== '1') {
            setTimeout(() => {
                popup.classList.add('is-visible');
                popup.setAttribute('aria-hidden', 'false');
            }, 700);
        }

        const closePopup = () => {
            popup.classList.remove('is-visible');
            popup.setAttribute('aria-hidden', 'true');
            sessionStorage.setItem('promoPopupClosed', '1');
        };

        closeButton.addEventListener('click', closePopup);

        popup.addEventListener('click', function (event) {
            if (event.target === popup) {
                closePopup();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && popup.classList.contains('is-visible')) {
                closePopup();
            }
        });
    });
</script>
</body>
</html>
