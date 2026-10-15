<x-guest-layout>

    <div class="flex min-h-screen w-full flex-col bg-blue-50">

        <div class="h-1 bg-blue-800"></div>



        <div class="flex flex-1 items-center justify-center px-5 py-10">

            <div class="w-full max-w-2xl">



                <div class="mb-6 flex justify-center">

                    <a href="{{ url('/') }}" class="inline-flex">

                        <img src="{{ asset('image/logo.png') }}" alt="{{ config('app.name', 'Bimbel') }}" class="h-10 w-auto">

                    </a>

                </div>



                <div class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm sm:p-7">

                    <div class="mb-6 text-center">

                        <h1 class="text-xl font-semibold tracking-tight text-blue-950">

                            Pendaftaran siswa

                        </h1>



                        <p class="mt-1.5 text-sm text-blue-900/70">

                            Lengkapi data untuk mendaftarkan diri sebagai siswa.

                        </p>

                    </div>



                    <form method="POST" action="{{ route('register') }}" class="space-y-7">

                        @csrf



                        <div>

                            <div class="mb-4 border-b border-blue-100 pb-3">

                                <h2 class="text-sm font-semibold text-blue-950">

                                    Data siswa

                                </h2>



                                <p class="mt-1 text-xs text-blue-900/60">

                                    Informasi pribadi calon siswa.

                                </p>

                            </div>



                            <div class="space-y-4">

                                <div>

                                    <x-input-label

                                        for="name"

                                        :value="'Nama Lengkap Siswa'"

                                        class="mb-1.5 text-sm font-medium text-blue-950"

                                    />



                                    <x-text-input

                                        id="name"

                                        class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                        type="text"

                                        name="name"

                                        :value="old('name')"

                                        required

                                        autofocus

                                        placeholder="Masukkan nama lengkap siswa"

                                    />



                                    <x-input-error

                                        :messages="$errors->get('name')"

                                        class="mt-2"

                                    />

                                </div>



                                <div class="grid gap-4 sm:grid-cols-2">

                                    <div>

                                        <x-input-label

                                            for="gender"

                                            :value="'Jenis Kelamin'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <select

                                            id="gender"

                                            name="gender"

                                            required

                                            class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none focus:border-blue-800 focus:ring-blue-800"

                                        >

                                            <option value="">Pilih jenis kelamin</option>

                                            <option value="male" @selected(old('gender') === 'male')>

                                                Laki-laki

                                            </option>

                                            <option value="female" @selected(old('gender') === 'female')>

                                                Perempuan

                                            </option>

                                        </select>



                                        <x-input-error

                                            :messages="$errors->get('gender')"

                                            class="mt-2"

                                        />

                                    </div>



                                    <div>

                                        <x-input-label

                                            for="phone"

                                            :value="'Nomor HP/WA'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <x-text-input

                                            id="phone"

                                            class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                            type="text"

                                            name="phone"

                                            :value="old('phone')"

                                            placeholder="Jika ada"

                                        />



                                        <x-input-error

                                            :messages="$errors->get('phone')"

                                            class="mt-2"

                                        />

                                    </div>

                                </div>



                                <div class="grid gap-4 sm:grid-cols-2">

                                    <div>

                                        <x-input-label

                                            for="birth_place"

                                            :value="'Tempat Lahir'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <x-text-input

                                            id="birth_place"

                                            class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                            type="text"

                                            name="birth_place"

                                            :value="old('birth_place')"

                                            required

                                            placeholder="Contoh: Bogor"

                                        />



                                        <x-input-error

                                            :messages="$errors->get('birth_place')"

                                            class="mt-2"

                                        />

                                    </div>



                                    <div>

                                        <x-input-label

                                            for="birth_date"

                                            :value="'Tanggal Lahir'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <x-text-input

                                            id="birth_date"

                                            class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none focus:border-blue-800 focus:ring-blue-800"

                                            type="date"

                                            name="birth_date"

                                            :value="old('birth_date')"

                                            required

                                        />



                                        <x-input-error

                                            :messages="$errors->get('birth_date')"

                                            class="mt-2"

                                        />

                                    </div>

                                </div>



                                <div>

                                    <x-input-label

                                        for="address"

                                        :value="'Alamat Lengkap'"

                                        class="mb-1.5 text-sm font-medium text-blue-950"

                                    />



                                    <textarea

                                        id="address"

                                        name="address"

                                        rows="3"

                                        required

                                        class="block w-full rounded-lg border-blue-200 bg-white px-3 py-2.5 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                        placeholder="Masukkan alamat lengkap siswa"

                                    >{{ old('address') }}</textarea>



                                    <x-input-error

                                        :messages="$errors->get('address')"

                                        class="mt-2"

                                    />

                                </div>



                                <div>

                                    <x-input-label

                                        for="email"

                                        :value="'Email'"

                                        class="mb-1.5 text-sm font-medium text-blue-950"

                                    />



                                    <x-text-input

                                        id="email"

                                        class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                        type="email"

                                        name="email"

                                        :value="old('email')"

                                        autocomplete="email"

                                        placeholder="nama@email.com"

                                    />



                                    <p class="mt-1.5 text-xs text-blue-900/50">

                                        Jika diisi, email akan digunakan untuk login ke akun siswa.

                                    </p>



                                    <x-input-error

                                        :messages="$errors->get('email')"

                                        class="mt-2"

                                    />

                                </div>

                            </div>

                        </div>



                        <div>

                            <div class="mb-4 border-b border-blue-100 pb-3">

                                <h2 class="text-sm font-semibold text-blue-950">

                                    Data orang tua / wali

                                </h2>



                                <p class="mt-1 text-xs text-blue-900/60">

                                    Informasi orang tua atau wali siswa.

                                </p>

                            </div>



                            <div class="space-y-4">

                                <div class="grid gap-4 sm:grid-cols-2">

                                    <div>

                                        <x-input-label

                                            for="parent_name"

                                            :value="'Nama Lengkap Orang Tua / Wali'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <x-text-input

                                            id="parent_name"

                                            class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                            type="text"

                                            name="parent_name"

                                            :value="old('parent_name')"

                                            required

                                            placeholder="Nama orang tua/wali"

                                        />



                                        <x-input-error

                                            :messages="$errors->get('parent_name')"

                                            class="mt-2"

                                        />

                                    </div>



                                    <div>

                                        <x-input-label

                                            for="parent_phone"

                                            :value="'Nomor HP/WA Orang Tua / Wali'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <x-text-input

                                            id="parent_phone"

                                            class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                            type="text"

                                            name="parent_phone"

                                            :value="old('parent_phone')"

                                            required

                                            placeholder="Contoh: 081234567890"

                                        />



                                        <x-input-error

                                            :messages="$errors->get('parent_phone')"

                                            class="mt-2"

                                        />

                                    </div>

                                </div>



                                <div class="grid gap-4 sm:grid-cols-2">

                                    <div>

                                        <x-input-label

                                            for="parent_occupation"

                                            :value="'Pekerjaan Orang Tua / Wali'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <x-text-input

                                            id="parent_occupation"

                                            class="block w-full rounded-lg border-blue-200 bg-white py-2.5 px-3 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                            type="text"

                                            name="parent_occupation"

                                            :value="old('parent_occupation')"

                                            required

                                            placeholder="Contoh: Karyawan Swasta"

                                        />



                                        <x-input-error

                                            :messages="$errors->get('parent_occupation')"

                                            class="mt-2"

                                        />

                                    </div>



                                    <div>

                                        <x-input-label

                                            for="parent_address"

                                            :value="'Alamat Orang Tua / Wali'"

                                            class="mb-1.5 text-sm font-medium text-blue-950"

                                        />



                                        <textarea

                                            id="parent_address"

                                            name="parent_address"

                                            rows="2"

                                            class="block w-full rounded-lg border-blue-200 bg-white px-3 py-2.5 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                            placeholder="Jika berbeda dengan siswa"

                                        >{{ old('parent_address') }}</textarea>



                                        <x-input-error

                                            :messages="$errors->get('parent_address')"

                                            class="mt-2"

                                        />

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div>
    <div class="mb-4 border-b border-blue-100 pb-3">
        <h2 class="text-sm font-semibold text-blue-950">
            Program dan jadwal
        </h2>

        <p class="mt-1 text-xs text-blue-900/60">
            Pilih satu atau beberapa program bimbingan belajar beserta jadwal yang diinginkan.
        </p>
    </div>

    <div class="space-y-4">
        @error('program_ids')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        @error('schedule_ids')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ($programs as $program)
                @php
                    $programSchedules = $schedules->filter(
                        fn ($schedule) =>
                            (int) $schedule->classRoom?->program_id === (int) $program->id
                    );

                    $selectedPrograms = array_map(
                        'strval',
                        old('program_ids', [])
                    );

                    $isSelected = in_array(
                        (string) $program->id,
                        $selectedPrograms,
                        true
                    );
                @endphp

                <div
                    data-program-card
                    class="rounded-xl border border-blue-200 bg-white p-4 transition"
                >
                    <label
                        for="program_ids_{{ $program->id }}"
                        class="flex cursor-pointer items-start gap-3"
                    >
                        <input
                            id="program_ids_{{ $program->id }}"
                            type="checkbox"
                            name="program_ids[]"
                            value="{{ $program->id }}"
                            data-program-checkbox
                            @checked($isSelected)
                            @disabled($programSchedules->isEmpty())
                            class="mt-0.5 size-4 rounded border-blue-300 text-blue-800 focus:ring-blue-800 disabled:cursor-not-allowed disabled:opacity-50"
                        >

                        <span class="text-sm font-semibold text-blue-950">
                            {{ $program->name }}
                            @if ($programSchedules->isEmpty())
                                <span class="mt-1 block text-xs font-normal text-amber-700">
                                    Jadwal belum tersedia
                                </span>
                            @endif
                        </span>
                    </label>

                    <div
                        data-schedule-panel
                        class="{{ $isSelected ? 'mt-4' : 'mt-4 hidden' }}"
                    >
                        <label
                            for="schedule_ids_{{ $program->id }}"
                            class="mb-1.5 block text-sm font-medium text-blue-950"
                        >
                            Jadwal program
                        </label>

                        <select
                            id="schedule_ids_{{ $program->id }}"
                            name="schedule_ids[{{ $program->id }}]"
                            data-schedule-select
                            @required($isSelected)
                            @disabled(!$isSelected)
                            class="block w-full rounded-lg border-blue-200 bg-white px-3 py-2.5 text-sm text-blue-950 shadow-none focus:border-blue-800 focus:ring-blue-800"
                        >
                            <option value="">Pilih jadwal</option>

                            @foreach ($programSchedules as $schedule)
                                <option
                                    value="{{ $schedule->id }}"
                                    @selected(
                                        (string) old('schedule_ids.' . $program->id) === (string) $schedule->id
                                    )
                                >
                                    {{ ucfirst($schedule->day) }}
                                    · {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                    · {{ $schedule->subject }}
                                    @if ($schedule->classRoom)
                                        · {{ $schedule->classRoom->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        @if ($programSchedules->isEmpty())
                            <p class="mt-2 text-xs text-amber-700">
                                Belum ada jadwal aktif untuk program ini.
                            </p>
                        @endif

                        @error('schedule_ids.' . $program->id)
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div><div>

                            <div class="mb-4 border-b border-blue-100 pb-3">

                                <h2 class="text-sm font-semibold text-blue-950">

                                    Informasi tambahan

                                </h2>



                                <p class="mt-1 text-xs text-blue-900/60">

                                    Informasi tambahan mengenai kebutuhan siswa.

                                </p>

                            </div>



                            <div class="space-y-5">

                                <div>

                                    <x-input-label

                                        :value="'Siswa pernah mengikuti bimbingan belajar sebelumnya?'"

                                        class="text-sm font-medium text-blue-950"

                                    />



                                    <div class="mt-2 flex gap-3">

                                        <label class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-blue-200 px-4 py-2.5 text-sm text-blue-900 transition hover:border-blue-400 hover:bg-blue-50">

                                            <input

                                                type="radio"

                                                name="previous_tutoring"

                                                value="1"

                                                @checked(old('previous_tutoring') === '1')

                                                required

                                                class="size-4 border-blue-300 text-blue-800 focus:ring-blue-800"

                                            >

                                            Ya

                                        </label>



                                        <label class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-blue-200 px-4 py-2.5 text-sm text-blue-900 transition hover:border-blue-400 hover:bg-blue-50">

                                            <input

                                                type="radio"

                                                name="previous_tutoring"

                                                value="0"

                                                @checked(old('previous_tutoring') === '0')

                                                required

                                                class="size-4 border-blue-300 text-blue-800 focus:ring-blue-800"

                                            >

                                            Tidak

                                        </label>

                                    </div>



                                    <x-input-error

                                        :messages="$errors->get('previous_tutoring')"

                                        class="mt-2"

                                    />

                                </div>



                                <div>

                                    <x-input-label

                                        :value="'Siswa memiliki kebutuhan khusus?'"

                                        class="text-sm font-medium text-blue-950"

                                    />



                                    <div class="mt-2 flex gap-3">

                                        <label class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-blue-200 px-4 py-2.5 text-sm text-blue-900 transition hover:border-blue-400 hover:bg-blue-50">

                                            <input

                                                type="radio"

                                                name="special_needs"

                                                value="1"

                                                @checked(old('special_needs') === '1')

                                                required

                                                class="size-4 border-blue-300 text-blue-800 focus:ring-blue-800"

                                            >

                                            Ya

                                        </label>



                                        <label class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-blue-200 px-4 py-2.5 text-sm text-blue-900 transition hover:border-blue-400 hover:bg-blue-50">

                                            <input

                                                type="radio"

                                                name="special_needs"

                                                value="0"

                                                @checked(old('special_needs') === '0')

                                                required

                                                class="size-4 border-blue-300 text-blue-800 focus:ring-blue-800"

                                            >

                                            Tidak

                                        </label>

                                    </div>



                                    <x-input-error

                                        :messages="$errors->get('special_needs')"

                                        class="mt-2"

                                    />

                                </div>



                                <div>

                                    <x-input-label

                                        for="notes"

                                        :value="'Keterangan'"

                                        class="mb-1.5 text-sm font-medium text-blue-950"

                                    />



                                    <textarea

                                        id="notes"

                                        name="notes"

                                        rows="3"

                                        class="block w-full rounded-lg border-blue-200 bg-white px-3 py-2.5 text-sm text-blue-950 shadow-none placeholder:text-blue-900/40 focus:border-blue-800 focus:ring-blue-800"

                                        placeholder="Tambahkan keterangan jika diperlukan"

                                    >{{ old('notes') }}</textarea>



                                    <x-input-error

                                        :messages="$errors->get('notes')"

                                        class="mt-2"

                                    />

                                </div>

                            </div>

                        </div>



                        <div class="pt-1">

                            <button

                                type="submit"

                                class="inline-flex w-full items-center justify-center rounded-lg bg-blue-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-900 focus:outline-hidden focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"

                            >

                                Daftar sebagai siswa

                            </button>

                        </div>

                    </form>

                </div>



                <p class="mt-5 text-center text-xs leading-5 text-blue-900/60">

                    Data pendaftaran akan digunakan untuk proses administrasi siswa Bimbel Safa.

                </p>



                <div class="mt-3 text-center">

                    <a

                        href="{{ route('login') }}"

                        class="text-sm text-blue-800 transition hover:text-blue-900 hover:underline"

                    >

                        Sudah memiliki akun? Masuk

                    </a>

                </div>



                <div class="mt-2 text-center">

                    <a

                        href="{{ url('/') }}"

                        class="text-sm text-blue-800 transition hover:text-blue-900 hover:underline"

                    >

                        Kembali ke halaman utama

                    </a>

                </div>

            </div>

        </div>

    </div>

<script>
    document.querySelectorAll('[data-program-card]').forEach((card) => {
        const checkbox = card.querySelector('[data-program-checkbox]');
        const panel = card.querySelector('[data-schedule-panel]');
        const select = card.querySelector('[data-schedule-select]');

        if (!checkbox || !panel || !select) return;

        const updateSelection = () => {
            const selected = checkbox.checked;

            panel.classList.toggle('hidden', !selected);
            select.disabled = !selected;
            select.required = selected;

            if (!selected) {
                select.value = '';
            }
        };

        checkbox.addEventListener('change', updateSelection);
        updateSelection();
    });
</script>

</x-guest-layout>
