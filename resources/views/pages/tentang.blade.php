@php
    $name = config('app.name', 'Bimbel Safa');

    $values = [
        [
            'number' => '01',
            'title' => 'Pembelajaran terarah',
            'description' => 'Materi dan kegiatan belajar disusun agar siswa dapat memahami pelajaran secara bertahap dan terarah.',
        ],
        [
            'number' => '02',
            'title' => 'Pendampingan yang dekat',
            'description' => 'Guru mendampingi siswa dalam proses memahami materi, berlatih, dan menyelesaikan kesulitan belajar.',
        ],
        [
            'number' => '03',
            'title' => 'Lingkungan belajar nyaman',
            'description' => 'Kami berusaha menciptakan suasana belajar yang nyaman sehingga siswa lebih percaya diri untuk berkembang.',
        ],
        [
            'number' => '04',
            'title' => 'Administrasi teratur',
            'description' => 'Informasi jadwal, kehadiran, dan pembayaran dikelola secara lebih teratur melalui sistem.',
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
        content="Tentang {{ $name }} dan bagaimana kami mendampingi siswa dalam proses belajar."
    >

    <title>Tentang Kami - {{ $name }}</title>

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
            <div class="mx-auto max-w-6xl px-4 pb-20 sm:px-6 lg:px-8 lg:pb-28">
                <div class="max-w-3xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                        Tentang Kami
                    </span>

                    <h1 class="font-display mt-5 text-5xl font-bold leading-[1.05] tracking-tight text-slate-900 sm:text-6xl">
                        Membantu siswa belajar dengan lebih terarah.
                    </h1>

                    <p class="mt-7 max-w-2xl text-lg leading-8 text-slate-600">
                        {{ $name }} hadir sebagai ruang belajar yang membantu siswa memahami
                        pelajaran, membangun kebiasaan belajar, dan berkembang dengan lebih percaya diri.
                    </p>
                </div>
            </div>
        </section>

        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
                <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
                    <div class="lg:col-span-5">
                        <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                            Siapa Kami
                        </span>

                        <h2 class="font-display mt-4 text-4xl font-bold leading-tight tracking-tight text-slate-900 sm:text-5xl">
                            Belajar bukan hanya tentang nilai.
                        </h2>
                    </div>

                    <div class="space-y-5 text-base leading-7 text-slate-600 lg:col-span-7">
                        <p>
                            Kami percaya bahwa proses belajar yang baik dimulai dari pemahaman
                            yang kuat. Siswa perlu memiliki kesempatan untuk bertanya, mencoba,
                            berlatih, dan mendapatkan pendampingan ketika menghadapi kesulitan.
                        </p>

                        <p>
                            Karena itu, {{ $name }} berusaha menghadirkan proses pembelajaran
                            yang terarah dengan jadwal yang teratur dan pendampingan guru yang dekat
                            dengan kebutuhan siswa.
                        </p>

                        <p>
                            Kami juga memanfaatkan sistem digital untuk membantu pengelolaan
                            informasi akademik dan administrasi sehingga data siswa, jadwal,
                            kehadiran, serta pembayaran dapat dikelola dengan lebih rapi.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-slate-50">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
                <div class="max-w-2xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                        Nilai Kami
                    </span>

                    <h2 class="font-display mt-4 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        Prinsip yang kami bawa dalam pembelajaran.
                    </h2>

                    <p class="mt-5 text-base leading-7 text-slate-600">
                        Setiap proses belajar diarahkan untuk memberikan pengalaman yang
                        terstruktur, nyaman, dan bermanfaat bagi siswa.
                    </p>
                </div>

                <div class="mt-12 grid gap-x-12 gap-y-10 sm:grid-cols-2">
                    @foreach ($values as $value)
                        <div class="border-t border-slate-200 pt-6">
                            <span class="text-sm font-semibold text-blue-600">
                                {{ $value['number'] }}
                            </span>

                            <h3 class="font-display mt-3 text-xl font-semibold text-slate-900">
                                {{ $value['title'] }}
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                {{ $value['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
                <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                    <div>
                        <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                            Untuk Siswa
                        </span>

                        <h2 class="font-display mt-4 text-4xl font-bold leading-tight tracking-tight text-slate-900 sm:text-5xl">
                            Ruang untuk memahami, mencoba, dan berkembang.
                        </h2>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-7 sm:p-9">
                        <div class="space-y-7">
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white">
                                    01
                                </div>

                                <div>
                                    <h3 class="font-semibold text-slate-900">
                                        Memahami materi
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-slate-500">
                                        Siswa dibantu memahami konsep sebelum melanjutkan ke materi berikutnya.
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white">
                                    02
                                </div>

                                <div>
                                    <h3 class="font-semibold text-slate-900">
                                        Berlatih secara konsisten
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-slate-500">
                                        Latihan membantu siswa mengukur pemahaman dan membangun kebiasaan belajar.
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white">
                                    03
                                </div>

                                <div>
                                    <h3 class="font-semibold text-slate-900">
                                        Berkembang dengan percaya diri
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-slate-500">
                                        Pendampingan guru membantu siswa lebih berani menghadapi tantangan belajar.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-blue-50">
            <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
                <div class="rounded-[2rem] bg-blue-600 px-7 py-12 text-center text-white sm:px-12">
                    <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">
                        Mari mulai perjalanan belajar bersama.
                    </h2>

                    <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-blue-100 sm:text-base">
                        Temukan program yang sesuai dan mulai proses belajar yang lebih terarah.
                    </p>

                    <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                        <a
                            href="{{ route('program') }}"
                            class="inline-flex h-12 items-center justify-center rounded-full bg-white px-6 text-sm font-semibold text-blue-700 transition hover:bg-blue-50"
                        >
                            Lihat Program
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex h-12 items-center justify-center rounded-full border border-white/30 px-6 text-sm font-semibold text-white transition hover:bg-white/10"
                        >
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-public-footer />

</body>
</html>
