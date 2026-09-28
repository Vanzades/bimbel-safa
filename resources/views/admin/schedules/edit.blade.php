<x-admin-layout>

    <x-slot name="title">

        Edit Jadwal Kelas

    </x-slot>

    <div

        class="py-4 lg:py-6 min-h-screen transition-colors duration-150"

        style="background-color: var(--admin-bg); color: var(--admin-text);"

    >

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">

            {{-- Breadcrumb --}}

            <nav

                class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3"

                style="color: var(--admin-muted);"

            >

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">

                    Dashboard

                </a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>

                <a href="{{ route('admin.schedules.index') }}" class="hover:opacity-85">

                    Jadwal Kelas

                </a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>

                </svg>

                <span class="font-semibold" style="color: var(--admin-text);">

                    Edit Jadwal

                </span>

            </nav>

            {{-- Judul halaman --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Edit Jadwal Kelas

                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Perbarui informasi jadwal pembelajaran.

                    </p>

                </div>

            </div>

            {{-- Pesan error --}}

            @if ($errors->any())

                <div

                    class="mb-6 rounded-xl border px-4 py-3 text-xs sm:text-sm"

                    style="background-color: var(--admin-danger-surface, #fef2f2); border-color: var(--admin-danger-border, #fecaca); color: var(--admin-danger, #dc2626);"

                >

                    <div class="font-semibold mb-1">

                        Periksa kembali data yang dimasukkan.

                    </div>

                    <ul class="list-disc list-inside space-y-0.5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- Satu card utama --}}

            <div

                class="rounded-2xl p-5 sm:p-6 shadow-sm"

                style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);"

            >

                <form

                    method="POST"

                    action="{{ route('admin.schedules.update', $schedule) }}"

                >

                    @csrf

                    @method('PUT')

                    {{-- Informasi Jadwal --}}

                    <div class="mb-6">

                        <h2 class="text-sm sm:text-base font-semibold">

                            Informasi Jadwal

                        </h2>

                        <p class="mt-1 text-xs sm:text-sm" style="color: var(--admin-muted);">

                            Perbarui kelas, guru, mata pelajaran, dan waktu pembelajaran.

                        </p>

                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">

                        {{-- Kelas --}}

                        <div>

                            <label for="class_room_id" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Kelas

                            </label>

                            <select

                                name="class_room_id"

                                id="class_room_id"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

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

                            @error('class_room_id')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        {{-- Guru --}}

                        <div>

                            <label for="teacher_id" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Guru

                            </label>

                            <select

                                name="teacher_id"

                                id="teacher_id"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

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

                            @error('teacher_id')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        {{-- Mata Pelajaran --}}

                        <div class="sm:col-span-2">

                            <label for="subject" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Mata Pelajaran

                            </label>

                            <input

                                type="text"

                                name="subject"

                                id="subject"

                                value="{{ old('subject', $schedule->subject) }}"

                                required

                                maxlength="255"

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('subject')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        {{-- Hari --}}

                        <div>

                            <label for="day" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Hari

                            </label>

                            <select

                                name="day"

                                id="day"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                                <option value="">Pilih Hari</option>

                                <option value="monday" @selected(old('day', $schedule->day) === 'monday')>Senin</option>

                                <option value="tuesday" @selected(old('day', $schedule->day) === 'tuesday')>Selasa</option>

                                <option value="wednesday" @selected(old('day', $schedule->day) === 'wednesday')>Rabu</option>

                                <option value="thursday" @selected(old('day', $schedule->day) === 'thursday')>Kamis</option>

                                <option value="friday" @selected(old('day', $schedule->day) === 'friday')>Jumat</option>

                                <option value="saturday" @selected(old('day', $schedule->day) === 'saturday')>Sabtu</option>

                            </select>

                            @error('day')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        {{-- Jam Mulai --}}

                        <div>

                            <label for="start_time" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Jam Mulai

                            </label>

                            <input

                                type="time"

                                name="start_time"

                                id="start_time"

                                value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('start_time')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        {{-- Jam Selesai --}}

                        <div>

                            <label for="end_time" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Jam Selesai

                            </label>

                            <input

                                type="time"

                                name="end_time"

                                id="end_time"

                                value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('end_time')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        {{-- Ruangan --}}

                        <div>

                            <label for="room" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Ruangan

                            </label>

                            <input

                                type="text"

                                name="room"

                                id="room"

                                value="{{ old('room', $schedule->room) }}"

                                maxlength="100"

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                            @error('room')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        {{-- Status --}}

                        <div>

                            <label for="status" class="mb-2 block text-[13px] sm:text-sm font-medium">

                                Status

                            </label>

                            <select

                                name="status"

                                id="status"

                                required

                                class="w-full rounded-xl px-4 py-2.5 text-xs sm:text-sm outline-none transition-colors duration-150"

                                style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);"

                            >

                                <option value="active" @selected(old('status', $schedule->status) === 'active')>

                                    Aktif

                                </option>

                                <option value="inactive" @selected(old('status', $schedule->status) === 'inactive')>

                                    Tidak Aktif

                                </option>

                            </select>

                            @error('status')

                                <p class="mt-1.5 text-[11px] sm:text-xs" style="color: var(--admin-danger, #dc2626);">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>

                    {{-- Tombol aksi --}}

                    <div

                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6 pt-5 border-t"

                        style="border-color: var(--admin-border);"

                    >

                        <a

                            href="{{ route('admin.schedules.index') }}"

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-medium transition-colors duration-150"

                            style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-muted);"

                            onmouseover="this.style.backgroundColor='var(--admin-hover)'"

                            onmouseout="this.style.backgroundColor='var(--admin-surface-soft)'"

                        >

                            Batal

                        </a>

                        <button

                            type="submit"

                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-[13px] sm:text-sm font-semibold text-white transition-opacity hover:brightness-110"

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
