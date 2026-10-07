@php
    $unreadNotifications = auth()->user()
        ->unreadNotifications()
        ->latest()
        ->take(5)
        ->get();

    $unreadCount = auth()->user()
        ->unreadNotifications()
        ->count();
@endphp

<div
    x-data="{ open: false }"
    class="relative"
>
    <button
        type="button"
        @click="open = !open"
        class="relative flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
        aria-label="Notifikasi"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 1 0-12 0v.75c0 2.22-.806 4.254-2.143 5.832a23.848 23.848 0 0 0 5.454 1.31m5.546 0a24.255 24.255 0 0 1-5.546 0m5.546 0a3 3 0 1 1-5.546 0"
            />
        </svg>

        @if ($unreadCount > 0)
            <span class="absolute right-1 top-1 flex min-h-[17px] min-w-[17px] items-center justify-center rounded-full bg-blue-600 px-1 text-[9px] font-bold text-white">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        class="absolute right-0 top-12 z-50 w-[340px] overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl"
    >
        <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">

            <div>
                <h3 class="text-sm font-semibold text-slate-900">
                    Notifikasi
                </h3>

                <p class="mt-0.5 text-[11px] text-slate-500">
                    Informasi terbaru
                </p>
            </div>

            @if ($unreadCount > 0)
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-[11px] font-semibold text-blue-600 hover:text-blue-700"
                    >
                        Tandai dibaca
                    </button>
                </form>
            @endif

        </div>

        <div class="max-h-[360px] overflow-y-auto">

            @forelse ($unreadNotifications as $notification)

                @php
                    $data = $notification->data;
                @endphp

                <form
                    method="POST"
                    action="{{ route('notifications.read', $notification->id) }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="flex w-full gap-3 border-b border-slate-100 px-4 py-3 text-left transition hover:bg-slate-50"
                    >
                        <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-blue-600"></span>

                        <span class="min-w-0 flex-1">

                            <span class="block text-xs font-semibold text-slate-900">
                                {{ $data['title'] ?? 'Notifikasi' }}
                            </span>

                            <span class="mt-1 block text-xs leading-5 text-slate-500">
                                {{ $data['message'] ?? '' }}
                            </span>

                            <span class="mt-1.5 block text-[10px] text-slate-400">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>

                        </span>
                    </button>
                </form>

            @empty

                <div class="px-5 py-10 text-center">

                    <p class="text-sm font-medium text-slate-700">
                        Tidak ada notifikasi
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Informasi baru akan muncul di sini.
                    </p>

                </div>

            @endforelse

        </div>

        <div class="border-t border-slate-100 bg-slate-50 px-4 py-3 text-center">

            <a
                href="{{ route('notifications.index') }}"
                class="text-xs font-semibold text-blue-600 hover:text-blue-700"
            >
                Lihat semua notifikasi
            </a>

        </div>

    </div>
</div>
