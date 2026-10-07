@php
    $name = config('app.name', 'Bimbel');

    $contact = [
        'whatsapp' => '',
        'email'    => '',
        'address'  => '',
        'hours'    => '',
        'maps'     => '',
    ];

    $programs = [
        ['title' => 'SD',  'desc' => 'Pendampingan pelajaran sekolah dan penguatan dasar membaca, menulis, dan berhitung.'],
        ['title' => 'SMP', 'desc' => 'Pendalaman Matematika, IPA, dan Bahasa Inggris, serta persiapan ujian sekolah.'],
        ['title' => 'SMA', 'desc' => 'Pendampingan mata pelajaran dan persiapan ujian masuk perguruan tinggi.'],
    ];

    $strengths = [
        ['title' => 'Kelas kecil',          'desc' => 'Jumlah siswa per kelas dibatasi agar guru bisa memperhatikan setiap anak.',                 'icon' => 'M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m10-4.13a4 4 0 1 0-8 0 4 4 0 0 0 8 0Z'],
        ['title' => 'Guru berpengalaman',   'desc' => 'Materi dijelaskan runtut dan sabar, sesuai kurikulum yang dipakai di sekolah.',            'icon' => 'M12 14l9-5-9-5-9 5 9 5Zm0 0v7m-5-9.5V16c0 1 2.2 2.5 5 2.5s5-1.5 5-2.5v-4.5'],
        ['title' => 'Jadwal yang teratur',  'desc' => 'Jadwal kelas tersusun jelas sehingga siswa dan orang tua mudah mengaturnya.',              'icon' => 'M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z'],
        ['title' => 'Perkembangan terpantau','desc' => 'Absensi dan status SPP bisa dilihat siswa lewat Student Portal kapan saja.',                'icon' => 'M9 17v-6m4 6V7m4 10v-3M5 21h14a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1Z'],
    ];

    $steps = [
        ['title' => 'Hubungi kami',        'desc' => 'Tanyakan program, jadwal, dan biaya sesuai jenjang anak.'],
        ['title' => 'Pilih program',       'desc' => 'Kami bantu menentukan kelas yang paling cocok dengan kebutuhan belajarnya.'],
        ['title' => 'Daftar dan mulai',    'desc' => 'Selesaikan pendaftaran, terima akun Student Portal, lalu ikuti kelas pertama.'],
    ];

    $waLink = $contact['whatsapp'] !== '' ? 'https://wa.me/' . preg_replace('/\D/', '', $contact['whatsapp']) : null;
    $hasContact = collect($contact)->filter()->isNotEmpty();

    $user = auth()->user();
    if ($user && $user->isAdmin()) {
        $loginUrl = route('admin.dashboard');
        $loginLabel = 'Dashboard';
    } elseif ($user && $user->isSiswa()) {
        $loginUrl = route('student.dashboard');
        $loginLabel = 'Student Portal';
    } else {
        $loginUrl = route('login');
        $loginLabel = 'Masuk';
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $name }} adalah bimbingan belajar yang mendampingi siswa memahami pelajaran sekolah dengan jadwal teratur dan perkembangan yang terpantau.">

    <title>{{ $name }} - Bimbingan Belajar</title>

    <link rel="icon" href="{{ asset('image/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('image/favicon-512x512.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/favicon-512x512.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand: #1e40af;
            --brand-dark: #1e3a8a;
            --brand-soft: #eff6ff;
            --line: #dbeafe;
            --ink: #0f1f4d;
            --ink-muted: #3d4d7d;
            --ink-faint: #5f6f9c;
        }
        body { font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif; }
        .font-display { font-family: 'Bricolage Grotesque', 'Figtree', ui-sans-serif, system-ui, sans-serif; }
        section[id] { scroll-margin-top: 4.5rem; }
        a:focus-visible { outline: 2px solid var(--brand); outline-offset: 2px; border-radius: 6px; }
        .on-brand a:focus-visible { outline-color: #fff; }
        @media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } }
    </style>
</head>

<body class="min-h-screen bg-white text-(--ink) antialiased">

    <header class="sticky top-0 z-30 border-b border-(--line) bg-white">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('image/logo.png') }}" alt="{{ $name }}" class="h-10 w-auto">
            </a>

            <nav class="hidden items-center gap-8 text-sm font-medium text-(--ink-muted) md:flex" aria-label="Navigasi utama">
                <a href="#tentang" class="transition hover:text-(--brand)">Tentang</a>
                <a href="#program" class="transition hover:text-(--brand)">Program</a>
                <a href="#keunggulan" class="transition hover:text-(--brand)">Keunggulan</a>
                <a href="#cara-daftar" class="transition hover:text-(--brand)">Cara daftar</a>
                @if ($hasContact)
                    <a href="#kontak" class="transition hover:text-(--brand)">Kontak</a>
                @endif
            </nav>

            <a
                href="{{ $loginUrl }}"
                class="inline-flex h-10 items-center rounded-lg bg-(--brand) px-4 text-sm font-semibold text-white transition hover:bg-(--brand-dark)"
            >
                {{ $loginLabel }}
            </a>
        </div>
    </header>

    <main>
        <section class="on-brand bg-(--brand) text-white">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-28">
                <div class="grid gap-12 {{ file_exists(public_path('image/hero.jpg')) ? 'lg:grid-cols-2 lg:items-center' : '' }}">
                    <div class="max-w-2xl">
                        <h1 class="font-display text-4xl font-bold leading-[1.1] tracking-tight sm:text-5xl lg:text-[3.5rem]">
                            Belajar jadi lebih terarah, nilai ikut membaik.
                        </h1>

                        <p class="mt-6 text-base leading-7 text-white/80 sm:text-lg">
                            {{ $name }} mendampingi siswa memahami pelajaran sekolah dengan
                            kelas yang terjadwal, guru yang dekat, dan perkembangan yang
                            bisa dipantau orang tua.
                        </p>

                        <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                            @if ($waLink)
                                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-(--brand) transition hover:bg-(--brand-soft)">
                                    Tanya lewat WhatsApp
                                </a>
                            @else
                                <a href="#program" class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-(--brand) transition hover:bg-(--brand-soft)">
                                    Lihat program
                                </a>
                            @endif
                            <a href="#cara-daftar" class="inline-flex items-center justify-center rounded-lg border border-white/40 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                                Cara mendaftar
                            </a>
                        </div>
                    </div>

                    @if (file_exists(public_path('image/hero.jpg')))
                        <img src="{{ asset('image/hero.jpg') }}" alt="Kegiatan belajar di {{ $name }}" class="aspect-4/3 w-full rounded-2xl object-cover">
                    @endif
                </div>
            </div>
        </section>

        <section id="tentang">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-16 sm:px-6 sm:py-20 lg:grid-cols-12 lg:gap-12 lg:px-8">
                <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl lg:col-span-5">
                    Tentang {{ $name }}
                </h2>

                <div class="space-y-4 text-base leading-7 text-(--ink-muted) lg:col-span-7">
                    <p>
                        Kami percaya anak belajar paling baik ketika materinya jelas, gurunya
                        mudah dihampiri, dan perkembangannya terlihat. Karena itu setiap kelas
                        disusun terjadwal, dan kehadiran serta pembayaran dicatat rapi dalam satu sistem.
                    </p>
                    <p>
                        Siswa dan orang tua dapat memantau absensi dan status SPP kapan saja
                        lewat Student Portal, tanpa perlu menunggu rekap manual.
                    </p>
                </div>
            </div>
        </section>

        <section id="program" class="border-y border-(--line) bg-(--brand-soft)">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
                <div class="max-w-2xl">
                    <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Program belajar</h2>
                    <p class="mt-4 text-base leading-7 text-(--ink-muted)">Pilih jenjang yang sesuai dengan kebutuhan anak.</p>
                </div>

                <div class="mt-10 grid gap-4 md:grid-cols-3">
                    @foreach ($programs as $program)
                        <div class="flex flex-col rounded-2xl border border-(--line) bg-white p-6 sm:p-8">
                            <span class="font-display text-3xl font-bold text-(--brand)">{{ $program['title'] }}</span>
                            <p class="mt-3 text-sm leading-6 text-(--ink-muted)">{{ $program['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="keunggulan">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
                <div class="max-w-2xl">
                    <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Kenapa belajar di {{ $name }}</h2>
                </div>

                <div class="mt-10 grid gap-x-10 gap-y-10 sm:grid-cols-2">
                    @foreach ($strengths as $item)
                        <div class="flex gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-(--brand-soft) text-(--brand)">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="font-display text-lg font-semibold">{{ $item['title'] }}</h3>
                                <p class="mt-1 text-sm leading-6 text-(--ink-muted)">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="cara-daftar" class="border-y border-(--line) bg-(--brand-soft)">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
                <div class="max-w-2xl">
                    <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Cara bergabung</h2>
                    <p class="mt-4 text-base leading-7 text-(--ink-muted)">Tiga langkah sederhana untuk mulai belajar.</p>
                </div>

                <ol class="mt-10 grid gap-4 md:grid-cols-3">
                    @foreach ($steps as $i => $step)
                        <li class="rounded-2xl border border-(--line) bg-white p-6 sm:p-8">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-(--brand) text-sm font-semibold text-white">{{ $i + 1 }}</span>
                            <h3 class="mt-5 font-display text-lg font-semibold">{{ $step['title'] }}</h3>
                            <p class="mt-2 text-sm leading-6 text-(--ink-muted)">{{ $step['desc'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        @if ($hasContact)
            <section id="kontak">
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
                    <div class="grid gap-10 rounded-2xl bg-(--brand) p-8 text-white sm:p-12 lg:grid-cols-2 lg:items-center">
                        <div>
                            <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl">Ada pertanyaan? Hubungi kami.</h2>
                            <p class="mt-4 max-w-md text-base leading-7 text-white/80">
                                Kami siap membantu memilih program yang sesuai untuk anak Anda.
                            </p>
                            @if ($waLink)
                                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="mt-8 inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-(--brand) transition hover:bg-(--brand-soft)">
                                    Chat via WhatsApp
                                </a>
                            @endif
                        </div>

                        <dl class="space-y-5 text-sm">
                            @if ($contact['address'])
                                <div>
                                    <dt class="font-semibold">Alamat</dt>
                                    <dd class="mt-1 leading-6 text-white/80">
                                        {{ $contact['address'] }}
                                        @if ($contact['maps'])
                                            <a href="{{ $contact['maps'] }}" target="_blank" rel="noopener" class="ml-1 underline underline-offset-2 hover:text-white">Lihat peta</a>
                                        @endif
                                    </dd>
                                </div>
                            @endif
                            @if ($contact['hours'])
                                <div>
                                    <dt class="font-semibold">Jam operasional</dt>
                                    <dd class="mt-1 text-white/80">{{ $contact['hours'] }}</dd>
                                </div>
                            @endif
                            @if ($contact['whatsapp'])
                                <div>
                                    <dt class="font-semibold">WhatsApp</dt>
                                    <dd class="mt-1 text-white/80">{{ $contact['whatsapp'] }}</dd>
                                </div>
                            @endif
                            @if ($contact['email'])
                                <div>
                                    <dt class="font-semibold">Email</dt>
                                    <dd class="mt-1 text-white/80">
                                        <a href="mailto:{{ $contact['email'] }}" class="underline underline-offset-2 hover:text-white">{{ $contact['email'] }}</a>
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </section>
        @endif
    </main>

    <footer class="border-t border-(--line) bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-8 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <img src="{{ asset('image/logo.png') }}" alt="{{ $name }}" class="h-8 w-auto self-start">

            <p class="text-xs text-(--ink-faint)">&copy; {{ date('Y') }} {{ $name }}. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
