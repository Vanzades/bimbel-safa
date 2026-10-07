<x-admin-layout>
    <x-slot name="title">
        Edit Jadwal Kelas
    </x-slot>

    @php
        $labelClass = 'mb-2 block text-[13px] sm:text-sm font-medium';
        $fieldClass = 'box-border h-10 w-full min-w-0 rounded-lg px-3.5 text-xs sm:text-[13px] outline-none transition-colors duration-150';
        $fieldStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';
    @endphp

    <div
        class="-mt-3 min-h-screen pt-0 pb-4 transition-colors duration-150 lg:-mt-4 lg:pb-6"
        style="background-color: var(--admin-bg); color: var(--admin-text);"
    >
        <div class="mx-auto max-w-90rem px-4 sm:px-6 lg:px-6">

            {{-- Breadcrumb --}}
            <nav
                aria-label="Breadcrumb"
                class="mb-3 flex min-w-0 items-center gap-1.5 text-[11px] font-medium sm:text-xs"
                style="color: var(--admin-muted);"
            >
                <a href="{{ route('admin.dashboard') }}" class="shrink-0 hover:opacity-85">
                    Dashboard
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <a href="{{ route('admin.schedules.index') }}" class="shrink-0 hover:opacity-85">
                    Jadwal Kelas
                </a>

                <svg class="h-2.5 w-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="truncate font-semibold" style="color: var(--admin-text);">
                    Edit Jadwal
                </span>
            </nav>

            {{-- Judul halaman --}}
            <div class="mb-12 mt-8">
                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                    Edit Jadwal Kelas
                </h1>
                <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">
                    Perbarui informasi jadwal pembelajaran.
                </p>
            </div>

            {{-- Ringkasan error --}}
            @if ($errors->any())
                <div
                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"
                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"
                >
                    <p class="mb-1 font-semibold">Periksa kembali data yang dimasukkan.</p>
                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li class="wrap-break-word">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <div
                class="overflow-hidden rounded-2xl border shadow-sm"
                style="border-color: var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"
            >
                <div class="border-b px-5 py-5 sm:px-6" style="border-color: var(--admin-border);">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                            style="background-color: var(--admin-surface-soft); color: #2563EB;"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h2 class="text-sm font-semibold sm:text-base">
                                Informasi Jadwal
                            </h2>
                            <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">
                                Perbarui kelas, guru, mata pelajaran, dan waktu pembelajaran.
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}">
                    @csrf
                    @method('PUT')

                    <div class="p-5 sm:p-6">
                        <div class="grid min-w-0 grid-cols-1 gap-5 sm:grid-cols-2">

                            {{-- Kelas --}}
                            <div class="min-w-0">
                                <label for="class_room_id" class="{{ $labelClass }}">
                                    Kelas
                                </label>

                                <div class="relative">
                                    <select
                                        name="class_room_id"
                                        id="class_room_id"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
                                    >
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($classRooms as $classRoom)
                                            <option
                                                value="{{ $classRoom->id }}"
                                                @selected(old('class_room_id', $schedule->class_room_id) == $classRoom->id)
                                            >
                                                {{ $classRoom->name }} ({{ $classRoom->code }})
                                            </option>
                                        @endforeach
                                    </select>

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('class_room_id')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Guru --}}
                            <div class="min-w-0">
                                <label for="teacher_id" class="{{ $labelClass }}">
                                    Guru
                                </label>

                                <div class="relative">
                                    <select
                                        name="teacher_id"
                                        id="teacher_id"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
                                    >
                                        <option value="">Pilih Guru</option>
                                        @foreach ($teachers as $teacher)
                                            <option
                                                value="{{ $teacher->id }}"
                                                @selected(old('teacher_id', $schedule->teacher_id) == $teacher->id)
                                            >
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('teacher_id')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Mata Pelajaran --}}
                            <div class="min-w-0 sm:col-span-2">
                                <label for="subject" class="{{ $labelClass }}">
                                    Mata Pelajaran
                                </label>

                                <input
                                    type="text"
                                    name="subject"
                                    id="subject"
                                    value="{{ old('subject', $schedule->subject) }}"
                                    required
                                    maxlength="255"
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('subject')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Hari --}}
                            <div class="min-w-0">
                                <label for="day" class="{{ $labelClass }}">
                                    Hari
                                </label>

                                <div class="relative">
                                    <select
                                        name="day"
                                        id="day"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
                                    >
                                        <option value="">Pilih Hari</option>
                                        <option value="monday" @selected(old('day', $schedule->day) === 'monday')>Senin</option>
                                        <option value="tuesday" @selected(old('day', $schedule->day) === 'tuesday')>Selasa</option>
                                        <option value="wednesday" @selected(old('day', $schedule->day) === 'wednesday')>Rabu</option>
                                        <option value="thursday" @selected(old('day', $schedule->day) === 'thursday')>Kamis</option>
                                        <option value="friday" @selected(old('day', $schedule->day) === 'friday')>Jumat</option>
                                        <option value="saturday" @selected(old('day', $schedule->day) === 'saturday')>Sabtu</option>
                                    </select>

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('day')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jam Mulai --}}
                            <div class="min-w-0">
                                <label for="start_time" class="{{ $labelClass }}">
                                    Jam Mulai
                                </label>

                                <input
                                    type="time"
                                    name="start_time"
                                    id="start_time"
                                    value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                                    required
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('start_time')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jam Selesai --}}
                            <div class="min-w-0">
                                <label for="end_time" class="{{ $labelClass }}">
                                    Jam Selesai
                                </label>

                                <input
                                    type="time"
                                    name="end_time"
                                    id="end_time"
                                    value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                                    required
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('end_time')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Ruangan --}}
                            <div class="min-w-0">
                                <label for="room" class="{{ $labelClass }}">
                                    Ruangan
                                </label>

                                <input
                                    type="text"
                                    name="room"
                                    id="room"
                                    value="{{ old('room', $schedule->room) }}"
                                    maxlength="100"
                                    class="{{ $fieldClass }}"
                                    style="{{ $fieldStyle }}"
                                >

                                @error('room')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="min-w-0">
                                <label for="status" class="{{ $labelClass }}">
                                    Status
                                </label>

                                <div class="relative">
                                    <select
                                        name="status"
                                        id="status"
                                        required
                                        class="{{ $fieldClass }} appearance-none pr-10"
                                        style="{{ $fieldStyle }}"
                                    >
                                        <option value="active" @selected(old('status', $schedule->status) === 'active')>
                                            Aktif
                                        </option>
                                        <option value="inactive" @selected(old('status', $schedule->status) === 'inactive')>
                                            Tidak Aktif
                                        </option>
                                    </select>

                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--admin-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                                    </svg>
                                </div>

                                @error('status')
                                    <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tombol aksi --}}
                    <div
                        class="flex flex-col-reverse gap-3 border-t p-5 sm:flex-row sm:justify-end sm:px-6"
                        style="border-color: var(--admin-border);"
                    >
                        <a
                            href="{{ route('admin.schedules.index') }}"
                            class="inline-flex h-9 w-full items-center justify-center rounded-lg border px-4 text-xs font-medium transition-colors duration-150 sm:w-auto sm:min-w-28 sm:text-[13px]"
                            style="background-color: var(--admin-surface-soft); border-color: var(--admin-border); color: var(--admin-muted);"
                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"
                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex h-9 w-full items-center justify-center rounded-lg px-4 text-xs font-semibold text-white transition-opacity hover:brightness-110 sm:w-auto sm:min-w-36 sm:text-[13px]"
                            style="background-color: #2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
