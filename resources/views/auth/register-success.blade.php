<x-guest-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-10 sm:px-6 lg:py-14">
        <div class="mx-auto flex min-h-[calc(100vh-5rem)] max-w-2xl flex-col justify-center">
            <div class="mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 text-sm font-extrabold tracking-tight text-white shadow-lg shadow-blue-600/20">
                        BS
                    </div>

                    <div class="text-left">
                        <span class="block text-lg font-bold tracking-tight text-slate-900">
                            Bimbel Safa
                        </span>
                        <span class="block text-xs font-medium text-slate-500">
                            Bimbingan Belajar
                        </span>
                    </div>
                </a>
            </div>

            <main class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-200/50">
                <div class="px-6 pb-7 pt-9 text-center sm:px-10 sm:pt-11">
                    <div class="mx-auto flex h-[4.5rem] w-[4.5rem] items-center justify-center rounded-2xl bg-emerald-50 ring-8 ring-emerald-50/50">
                        <svg
                            class="h-9 w-9 text-emerald-600"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="m5 12 4 4L19 6" />
                        </svg>
                    </div>

                    <span class="mt-7 inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        Menunggu Verifikasi
                    </span>

                    <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                        Pendaftaran Berhasil!
                    </h1>

                    <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-slate-500 sm:text-base">
                        Terima kasih telah mendaftar di Bimbel Safa. Data pendaftaranmu telah kami terima dan sedang menunggu pemeriksaan Admin Cabang.
                    </p>
                </div>
            </main>

            <footer class="mt-7 text-center">
                <p class="text-xs leading-5 text-slate-400">
                    © {{ date('Y') }} Bimbel Safa
                    <span class="mx-1.5">·</span>
                    Bimbingan belajar untuk masa depan yang lebih baik
                </p>
            </footer>
        </div>
    </div>

    @if (session()->has('temporary_password') && session('temporary_password'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const passwordInput = document.getElementById('temporary-password');
                const toggleButton = document.getElementById('toggle-password');
                const copyButton = document.getElementById('copy-password');
                const copyLabel = document.getElementById('copy-password-label');
                const status = document.getElementById('copy-password-status');

                toggleButton?.addEventListener('click', () => {
                    const isHidden = passwordInput.type === 'password';

                    passwordInput.type = isHidden ? 'text' : 'password';
                    toggleButton.textContent = isHidden ? 'Sembunyikan' : 'Lihat';
                    toggleButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
                    toggleButton.setAttribute('aria-pressed', String(isHidden));
                });

                copyButton?.addEventListener('click', async () => {
                    try {
                        await navigator.clipboard.writeText(passwordInput.value);
                        copyLabel.textContent = 'Tersalin';
                        status.textContent = 'Password berhasil disalin.';
                        copyButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                        copyButton.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                    } catch {
                        passwordInput.type = 'text';
                        passwordInput.focus();
                        passwordInput.select();
                        status.textContent = 'Penyalinan otomatis gagal. Salin password yang dipilih secara manual.';
                    }
                });
            });
        </script>
    @endif
</x-guest-layout>