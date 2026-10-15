@php
$name = config('app.name', 'Bimbel Safa');


$programs = [
    'sd' => [
        'level' => 'SD',
        'title' => 'Program Sekolah Dasar',
        'subtitle' => 'Membangun fondasi belajar yang kuat sejak dini.',
        'description' => 'Program pendampingan belajar untuk siswa sekolah dasar dengan pendekatan yang membantu memahami materi, membangun kebiasaan belajar, dan meningkatkan rasa percaya diri.',
        'image' => 'image/program-sd.jpg',
        'focus' => [
            'Membaca, menulis, dan berhitung',
            'Matematika dasar',
            'Bahasa Indonesia',
            'Bahasa Inggris dasar',
            'Pendampingan tugas sekolah',
            'Persiapan ulangan dan ujian',
        ],
        'benefits' => [
            [
                'number' => '01',
                'title' => 'Pemahaman Dasar',
                'description' => 'Membantu siswa memahami konsep dasar pelajaran dengan cara yang mudah dipahami.',
            ],
            [
                'number' => '02',
                'title' => 'Pendampingan Belajar',
                'description' => 'Mendampingi siswa dalam memahami materi dan menyelesaikan tugas sekolah.',
            ],
            [
                'number' => '03',
                'title' => 'Kebiasaan Positif',
                'description' => 'Mendorong siswa membangun kebiasaan belajar yang lebih teratur dan mandiri.',
            ],
        ],
    ],
    'smp' => [
        'level' => 'SMP',
        'title' => 'Program Sekolah Menengah Pertama',
        'subtitle' => 'Memperkuat pemahaman materi dan menghadapi tantangan belajar.',
        'description' => 'Program pendampingan untuk membantu siswa SMP memahami materi pelajaran dengan lebih mendalam, meningkatkan kemampuan akademik, dan mempersiapkan diri menghadapi evaluasi sekolah.',
        'image' => 'image/program-smp.jpg',
        'focus' => [
            'Matematika',
            'IPA',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Pendampingan tugas sekolah',
            'Persiapan ulangan dan ujian',
        ],
        'benefits' => [
            [
                'number' => '01',
                'title' => 'Materi Lebih Terarah',
                'description' => 'Pembelajaran membantu siswa memahami materi sesuai kebutuhan dan tingkat pemahamannya.',
            ],
            [
                'number' => '02',
                'title' => 'Latihan Terarah',
                'description' => 'Siswa mendapatkan kesempatan memperkuat pemahaman melalui latihan dan pembahasan.',
            ],
            [
                'number' => '03',
                'title' => 'Persiapan Evaluasi',
                'description' => 'Membantu siswa mempersiapkan diri menghadapi ulangan, ujian, dan evaluasi sekolah.',
            ],
        ],
    ],
    'sma' => [
        'level' => 'SMA',
        'title' => 'Program Sekolah Menengah Atas',
        'subtitle' => 'Mempersiapkan siswa menghadapi tuntutan akademik yang lebih tinggi.',
        'description' => 'Program pendampingan belajar bagi siswa SMA untuk memperkuat pemahaman materi, meningkatkan kemampuan menyelesaikan soal, dan mempersiapkan diri menghadapi ujian.',
        'image' => 'image/program-sma.jpg',
        'focus' => [
            'Matematika',
            'Bahasa Inggris',
            'Mata pelajaran sekolah',
            'Pendalaman materi',
            'Pendampingan tugas sekolah',
            'Persiapan ulangan dan ujian',
        ],
        'benefits' => [
            [
                'number' => '01',
                'title' => 'Pendalaman Materi',
                'description' => 'Membantu siswa memahami materi secara lebih mendalam dan terstruktur.',
            ],
            [
                'number' => '02',
                'title' => 'Pembahasan Soal',
                'description' => 'Melatih kemampuan siswa dalam memahami dan menyelesaikan berbagai bentuk soal.',
            ],
            [
                'number' => '03',
                'title' => 'Persiapan Masa Depan',
                'description' => 'Membantu siswa membangun kesiapan akademik untuk menghadapi jenjang pendidikan berikutnya.',
            ],
        ],
    ],
];

$data = $programs[$program] ?? $programs['sd'];

@endphp

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<meta
    name="description"
    content="{{ $data['title'] }} {{ $name }} - {{ $data['subtitle'] }}"
>

<title>{{ $data['title'] }} - {{ $name }}</title>

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
</style>


</head>

<body class="min-h-screen bg-white text-slate-900 antialiased">


<x-public-navbar />

<main>
    <section class="relative overflow-hidden bg-slate-950 pt-32">
        <div class="absolute inset-0">
            <img
                src="{{ asset($data['image']) }}"
                alt="{{ $data['title'] }}"
                class="h-full w-full object-cover opacity-25"
                onerror="this.style.display='none'"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/95 to-slate-950/70"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 pb-20 sm:px-6 lg:px-8 lg:pb-28">
            <div class="max-w-3xl">


                <div class="mt-10 flex items-center gap-4">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 font-display text-xl font-bold text-white">
                        {{ $data['level'] }}
                    </span>

                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-400">
                        Program {{ $data['level'] }}
                    </span>
                </div>

                <h1 class="font-display mt-7 text-5xl font-bold leading-[1.05] tracking-tight text-white sm:text-6xl">
                    {{ $data['title'] }}
                </h1>

                <p class="mt-6 text-xl leading-8 text-slate-300">
                    {{ $data['subtitle'] }}
                </p>

                <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-400 sm:text-base">
                    {{ $data['description'] }}
                </p>

                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a
                        href="{{ route('register') }}"
                        class="inline-flex h-12 items-center justify-center rounded-full bg-blue-600 px-6 text-sm font-semibold text-white transition hover:bg-blue-500"
                    >
                        Daftar Sekarang
                    </a>

                    <a
                        href="{{ route('kontak') }}"
                        class="inline-flex h-12 items-center justify-center rounded-full border border-white/15 px-6 text-sm font-semibold text-white transition hover:bg-white/10"
                    >
                        Konsultasi Program
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-20">
                <div class="lg:col-span-5">
                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                        Fokus Pembelajaran
                    </span>

                    <h2 class="font-display mt-4 text-4xl font-bold leading-tight tracking-tight text-slate-900 sm:text-5xl">
                        Materi yang mendukung kebutuhan siswa.
                    </h2>

                    <p class="mt-6 text-base leading-7 text-slate-500">
                        Materi pembelajaran disusun untuk membantu siswa memahami pelajaran sekolah,
                        memperkuat kemampuan akademik, dan menghadapi evaluasi dengan lebih percaya diri.
                    </p>
                </div>

                <div class="lg:col-span-7">
                    <div class="grid gap-3 sm:grid-cols-2">
                        @foreach ($data['focus'] as $index => $item)
                            <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <span class="text-sm font-medium text-slate-700">
                                    {{ $item }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50">
        <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
            <div class="max-w-2xl">
                <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                    Keunggulan Program
                </span>

                <h2 class="font-display mt-4 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                    Pendampingan yang lebih terarah.
                </h2>
            </div>

            <div class="mt-12 grid gap-5 md:grid-cols-3">
                @foreach ($data['benefits'] as $benefit)
                    <div class="rounded-3xl border border-slate-200 bg-white p-7">
                        <span class="text-sm font-bold text-blue-600">
                            {{ $benefit['number'] }}
                        </span>

                        <h3 class="font-display mt-6 text-xl font-semibold text-slate-900">
                            {{ $benefit['title'] }}
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            {{ $benefit['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
            <div class="overflow-hidden rounded-[2rem] bg-blue-600">
                <div class="grid lg:grid-cols-2">
                    <div class="p-8 sm:p-12 lg:p-14">
                        <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-200">
                            Mulai Belajar
                        </span>

                        <h2 class="font-display mt-5 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Siap mulai belajar bersama {{ $name }}?
                        </h2>

                        <p class="mt-5 max-w-lg text-sm leading-7 text-blue-100 sm:text-base">
                            Daftarkan diri dan pilih program yang sesuai dengan jenjang belajar siswa.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
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

                    <div class="hidden items-center justify-center bg-blue-700/40 p-12 lg:flex">
                        <div class="text-center">
                            <span class="font-display text-8xl font-bold text-white/90">
                                {{ $data['level'] }}
                            </span>

                            <p class="mt-3 text-sm font-medium text-blue-100">
                                Program {{ $data['level'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<x-public-footer />

</body>
</html>
