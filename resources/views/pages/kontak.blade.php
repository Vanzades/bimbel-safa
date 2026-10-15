@php
$name = config('app.name', 'Bimbel Safa');
@endphp

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


<meta
    name="description"
    content="Hubungi {{ $name }} untuk mendapatkan informasi mengenai program belajar dan pendaftaran."
>

<title>Kontak - {{ $name }}</title>

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
    <section class="border-b border-slate-100 bg-slate-50 pt-32">
        <div class="mx-auto max-w-6xl px-4 pb-20 sm:px-6 lg:px-8 lg:pb-24">
            <div class="max-w-3xl">
                <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                    Hubungi Kami
                </span>

                <h1 class="font-display mt-5 text-5xl font-bold leading-[1.05] tracking-tight text-slate-900 sm:text-6xl">
                    Mari terhubung dengan {{ $name }}.
                </h1>

                <p class="mt-7 max-w-2xl text-lg leading-8 text-slate-600">
                    Punya pertanyaan mengenai program belajar, jadwal, atau pendaftaran?
                    Kami siap membantu memberikan informasi yang Anda butuhkan.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

                <div class="lg:col-span-5">
                    <div class="max-w-md">
                        <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                            Informasi Kontak
                        </span>

                        <h2 class="font-display mt-4 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            Kami siap membantu.
                        </h2>

                        <p class="mt-5 text-sm leading-7 text-slate-500">
                            Silakan hubungi kami melalui informasi yang tersedia untuk mendapatkan
                            informasi lebih lanjut mengenai {{ $name }}.
                        </p>
                    </div>

                    <div class="mt-10 space-y-4">
                        <div class="flex gap-4 rounded-2xl border border-slate-200 p-5">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z"/>
                                    <circle cx="12" cy="10" r="2.5"/>
                                </svg>
                            </span>

                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    Alamat
                                </p>

                                <p class="mt-1 text-sm leading-6 text-slate-500">
                                    Jalan AMD, Kel. Sasak Panjang, Kec. Tajurhalang,
                                    Kab. Bogor, Jawa Barat 16320
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 rounded-2xl border border-slate-200 p-5">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 0 1 2-2h2.3a2 2 0 0 1 1.9 1.4L10 7a2 2 0 0 1-.5 2.1L8.2 10.4a16 16 0 0 0 5.4 5.4l1.3-1.3A2 2 0 0 1 17 14l2.6.8A2 2 0 0 1 21 16.7V19a2 2 0 0 1-2 2C10.7 21 3 13.3 3 5Z"/>
                                </svg>
                            </span>

                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    Telepon
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Hubungi kami untuk informasi program dan pendaftaran.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 rounded-2xl border border-slate-200 p-5">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 6 9 7 9-7"/>
                                </svg>
                            </span>

                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    Informasi & Pendaftaran
                                </p>

                                <p class="mt-1 text-sm leading-6 text-slate-500">
                                    Konsultasikan kebutuhan belajar siswa bersama kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-[2rem] bg-slate-50 p-6 sm:p-8 lg:p-10">
                        <div>
                            <span class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-600">
                                Pertanyaan Umum
                            </span>

                            <h2 class="font-display mt-4 text-3xl font-bold tracking-tight text-slate-900">
                                Ingin mengetahui lebih banyak?
                            </h2>

                            <p class="mt-4 text-sm leading-6 text-slate-500">
                                Beberapa hal yang bisa Anda konsultasikan bersama tim {{ $name }}.
                            </p>
                        </div>

                        <div class="mt-8 divide-y divide-slate-200">
                            <div class="py-5 first:pt-0">
                                <div class="flex items-start gap-4">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">
                                        01
                                    </span>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900">
                                            Program belajar yang tersedia
                                        </h3>

                                        <p class="mt-2 text-sm leading-6 text-slate-500">
                                            Informasi program berdasarkan jenjang SD, SMP, dan SMA.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-5">
                                <div class="flex items-start gap-4">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">
                                        02
                                    </span>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900">
                                            Proses pendaftaran
                                        </h3>

                                        <p class="mt-2 text-sm leading-6 text-slate-500">
                                            Panduan mengenai proses pendaftaran siswa baru di {{ $name }}.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-5">
                                <div class="flex items-start gap-4">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">
                                        03
                                    </span>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900">
                                            Kebutuhan belajar siswa
                                        </h3>

                                        <p class="mt-2 text-sm leading-6 text-slate-500">
                                            Diskusikan kebutuhan pendampingan belajar yang sesuai untuk siswa.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-5 last:pb-0">
                                <div class="flex items-start gap-4">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">
                                        04
                                    </span>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900">
                                            Informasi lainnya
                                        </h3>

                                        <p class="mt-2 text-sm leading-6 text-slate-500">
                                            Sampaikan pertanyaan lainnya dan kami akan membantu memberikan informasi yang diperlukan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex h-12 w-full items-center justify-center rounded-full bg-blue-600 px-6 text-sm font-semibold text-white transition hover:bg-blue-700"
                            >
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-slate-50">
        <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white">
                <div class="flex min-h-72 items-center justify-center bg-slate-100 p-8">
                    <div class="text-center">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z"/>
                                <circle cx="12" cy="10" r="2.5"/>
                            </svg>
                        </span>

                        <h2 class="font-display mt-5 text-2xl font-bold text-slate-900">
                            Lokasi {{ $name }}
                        </h2>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Jalan AMD, Kel. Sasak Panjang, Kec. Tajurhalang,
                            Kab. Bogor, Jawa Barat 16320
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8 lg:py-24">
            <div class="rounded-[2rem] bg-blue-600 px-7 py-12 text-center sm:px-12">
                <h2 class="font-display text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Siap memulai perjalanan belajar?
                </h2>

                <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-blue-100 sm:text-base">
                    Kenali program {{ $name }} dan pilih pendampingan yang sesuai dengan kebutuhan siswa.
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
