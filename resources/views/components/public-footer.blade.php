@php
    $name = config('app.name', 'Bimbel Safa');

    $phone = '021-XXXXXXXX';
    $whatsapp = '628XXXXXXXXXX';
    $email = 'info@bimbelsafa.com';
    $address = 'Alamat Bimbel Safa, Jakarta';

    $instagram = 'https://instagram.com/bimbelsafa';
    $facebook = 'https://facebook.com/bimbelsafa';
    $youtube = 'https://youtube.com/@bimbelsafa';
    $tiktok = 'https://tiktok.com/@bimbelsafa';
@endphp

<footer class="bg-blue-50 px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="rounded-[1.75rem] border border-blue-100 bg-blue-100/70 px-7 py-10 sm:px-10 lg:px-12 lg:py-12">
            <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-5">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                        <img
                            src="{{ asset('image/logo.png') }}"
                            alt="{{ $name }}"
                            class="h-12 w-auto"
                        >

                        <span class="font-display text-2xl font-bold tracking-tight text-slate-900">
                            {{ $name }}
                        </span>
                    </a>

                    <p class="mt-5 max-w-md text-sm leading-6 text-slate-600">
                        Bimbingan belajar yang membantu siswa memahami pelajaran dengan lebih
                        terarah, nyaman, dan konsisten.
                    </p>

                    <a
                        href="https://www.google.com/maps/search/?api=1&query={{ urlencode($address) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-5 inline-flex max-w-md items-start gap-3 text-sm leading-6 text-slate-600 transition hover:text-blue-700"
                    >
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z"/>
                            <circle cx="12" cy="10" r="2.5"/>
                        </svg>

                        <span>{{ $address }}</span>
                    </a>
                </div>

                <div class="lg:col-span-2">
                    <h3 class="text-base font-bold text-slate-900">
                        Navigasi
                    </h3>

                    <div class="mt-5 space-y-3 text-sm text-slate-600">
                        <a href="{{ route('home') }}" class="block transition hover:text-blue-700">
                            Beranda
                        </a>

                        <a href="{{ route('tentang') }}" class="block transition hover:text-blue-700">
                            Tentang Kami
                        </a>

                        <a href="{{ route('program') }}" class="block transition hover:text-blue-700">
                            Program
                        </a>

                        <a href="{{ route('kontak') }}" class="block transition hover:text-blue-700">
                            Kontak
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <h3 class="text-base font-bold text-slate-900">
                        Hubungi
                    </h3>

                    <div class="mt-5 space-y-3 text-sm text-slate-600">
                        <a
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                            class="block transition hover:text-blue-700"
                        >
                            Telepon
                        </a>

                        <a
                            href="https://wa.me/{{ $whatsapp }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block transition hover:text-blue-700"
                        >
                            WhatsApp
                        </a>

                        <a
                            href="mailto:{{ $email }}"
                            class="block transition hover:text-blue-700"
                        >
                            Email
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <h3 class="text-base font-bold text-slate-900">
                        Program
                    </h3>

                    <div class="mt-5 space-y-3 text-sm text-slate-600">
                        <a
                            href="{{ route('program.detail', 'sd') }}"
                            class="block transition hover:text-blue-700"
                        >
                            SD
                        </a>

                        <a
                            href="{{ route('program.detail', 'smp') }}"
                            class="block transition hover:text-blue-700"
                        >
                            SMP
                        </a>

                        <a
                            href="{{ route('program.detail', 'sma') }}"
                            class="block transition hover:text-blue-700"
                        >
                            SMA
                        </a>

                        <a
                            href="{{ route('program') }}"
                            class="block transition hover:text-blue-700"
                        >
                            Semua Program
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-5 py-7 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-600">
                © {{ date('Y') }}
                <span class="font-semibold text-blue-600">{{ $name }}</span>
            </p>

            <div class="flex items-center gap-2">
                <a
                    href="{{ $youtube }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="YouTube"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-slate-700 transition hover:bg-white hover:text-blue-600"
                >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.6 7.2a2.9 2.9 0 0 0-2-2C17.8 4.7 12 4.7 12 4.7s-5.8 0-7.6.5a2.9 2.9 0 0 0-2 2C2 9 2 12 2 12s0 3 .4 4.8a2.9 2.9 0 0 0 2 2c1.8.5 7.6.5 7.6.5s5.8 0 7.6-.5a2.9 2.9 0 0 0 2-2C22 15 22 12 22 12s0-3-.4-4.8Z"/>
                        <path d="m10 15.5 5-3.5-5-3.5v7Z" fill="white"/>
                    </svg>
                </a>

                <a
                    href="{{ $tiktok }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="TikTok"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-slate-700 transition hover:bg-white hover:text-blue-600"
                >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M15.5 3c.3 1.8 1.3 3.2 3 4v2.5c-1.1-.1-2.1-.5-3-1.1v6.1a6.2 6.2 0 1 1-5.4-6.1v2.6a3.6 3.6 0 1 0 2.8 3.5V3h2.6Z"/>
                    </svg>
                </a>

                <a
                    href="{{ $instagram }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Instagram"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-slate-700 transition hover:bg-white hover:text-blue-600"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="3" width="18" height="18" rx="5"/>
                        <circle cx="12" cy="12" r="4"/>
                        <circle cx="17.5" cy="6.5" r=".75" fill="currentColor" stroke="none"/>
                    </svg>
                </a>

                <a
                    href="{{ $facebook }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Facebook"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-slate-700 transition hover:bg-white hover:text-blue-600"
                >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13.5 21v-8h2.7l.4-3h-3.1V8.1c0-.9.3-1.5 1.6-1.5h1.7V4c-.3 0-1.2-.1-2.3-.1-2.3 0-3.9 1.4-3.9 4v2.1H8v3h2.6v8h2.9Z"/>
                    </svg>
                </a>

                <a
                    href="mailto:{{ $email }}"
                    aria-label="Email"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-slate-700 transition hover:bg-white hover:text-blue-600"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
<div class="fixed bottom-5 right-5 z-50 flex flex-col items-center gap-3 sm:bottom-7 sm:right-7">
    <button
        type="button"
        id="scrollToTop"
        aria-label="Kembali ke atas"
        title="Kembali ke atas"
        class="invisible flex h-11 w-11 translate-y-2 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 opacity-0 shadow-lg shadow-slate-900/10 transition duration-300 hover:-translate-y-1 hover:bg-blue-50 hover:text-blue-600"
    >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="m18 15-6-6-6 6"/>
        </svg>
    </button>

    <a
        href="https://wa.me/628XXXXXXXXXX"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Hubungi kami melalui WhatsApp"
        title="Chat WhatsApp"
        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-lg shadow-green-900/20 transition duration-300 hover:-translate-y-1 hover:bg-[#20BD5A] hover:shadow-xl"
    >
        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M20.52 3.48A11.85 11.85 0 0 0 12.08 0C5.48 0 .11 5.37.11 11.97c0 2.11.55 4.17 1.6 5.99L0 24l6.19-1.62a11.96 11.96 0 0 0 5.89 1.5h.01c6.6 0 11.97-5.37 11.97-11.97 0-3.2-1.25-6.21-3.54-8.43ZM12.09 21.8a9.9 9.9 0 0 1-5.05-1.39l-.36-.21-3.67.96.98-3.58-.23-.37a9.86 9.86 0 0 1-1.52-5.24c0-5.45 4.44-9.89 9.9-9.89a9.8 9.8 0 0 1 6.99 2.9 9.8 9.8 0 0 1 2.9 6.99c0 5.45-4.44 9.89-9.89 9.89Zm5.43-7.4c-.3-.15-1.77-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.47-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.2 5.08 4.49.71.31 1.27.49 1.7.62.71.23 1.36.2 1.87.12.57-.08 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.08-.12-.27-.2-.57-.35Z"/>
        </svg>
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('scrollToTop');

        if (!button) {
            return;
        }

        const updateButton = () => {
            const visible = window.scrollY > 300;

            button.classList.toggle('invisible', !visible);
            button.classList.toggle('opacity-0', !visible);
            button.classList.toggle('translate-y-2', !visible);
            button.classList.toggle('opacity-100', visible);
            button.classList.toggle('translate-y-0', visible);
            button.classList.toggle('visible', visible);
        };

        window.addEventListener('scroll', updateButton, { passive: true });

        button.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        updateButton();
    });
</script>
</footer>
