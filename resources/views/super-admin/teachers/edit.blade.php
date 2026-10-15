<x-super-admin-layout title="Edit Guru">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('super-admin.teachers.index') }}" class="transition hover:text-blue-600">
                        Manajemen Guru
                    </a>
                    <span>/</span>
                    <span>Edit Guru</span>
                </div>

            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                Edit Guru
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui informasi guru {{ $teacher->name }}.
            </p>
        </div>

        <a href="{{ route('super-admin.teachers.show', $teacher) }}"
           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 p-4">
            <div class="flex gap-3">
                <div class="mt-0.5 text-red-500">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m15 9-6 6"/>
                        <path d="m9 9 6 6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold text-red-800">
                        Terdapat kesalahan pada data.
                    </p>

                    <ul class="mt-2 space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('super-admin.teachers.update', $teacher) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Informasi Guru
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Perbarui informasi dasar guru.
                </p>
            </div>

            <div class="grid gap-5 p-6 sm:grid-cols-2">
                <div>
                    <label for="branch_id" class="mb-2 block text-sm font-medium text-slate-700">
                        Cabang
                    </label>

                    <select id="branch_id"
                            name="branch_id"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}"
                                @selected(old('branch_id', $teacher->branch_id) == $branch->id)>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('branch_id')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $teacher->name) }}"
                           required
                           class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="identity_number" class="mb-2 block text-sm font-medium text-slate-700">
                        NIK / Nomor Identitas
                    </label>

                    <input type="text"
                           id="identity_number"
                           name="identity_number"
                           value="{{ old('identity_number', $teacher->identity_number) }}"
                           class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                    @error('identity_number')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="mb-2 block text-sm font-medium text-slate-700">
                        Jenis Kelamin
                    </label>

                    <select id="gender"
                            name="gender"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        <option value="male" @selected(old('gender', $teacher->gender) === 'male')>
                            Laki-laki
                        </option>
                        <option value="female" @selected(old('gender', $teacher->gender) === 'female')>
                            Perempuan
                        </option>
                    </select>

                    @error('gender')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="mb-2 block text-sm font-medium text-slate-700">
                        Nomor Telepon
                    </label>

                    <input type="text"
                           id="phone"
                           name="phone"
                           value="{{ old('phone', $teacher->phone) }}"
                           class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                    @error('phone')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-slate-700">
                        Status
                    </label>

                    <select id="status"
                            name="status"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        <option value="active" @selected(old('status', $teacher->status) === 'active')>
                            Aktif
                        </option>
                        <option value="inactive" @selected(old('status', $teacher->status) === 'inactive')>
                            Nonaktif
                        </option>
                    </select>

                    @error('status')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="mb-2 block text-sm font-medium text-slate-700">
                        Alamat
                    </label>

                    <textarea id="address"
                              name="address"
                              rows="4"
                              class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('address', $teacher->address) }}</textarea>

                    @error('address')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('super-admin.teachers.show', $teacher) }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Batal
            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

</x-super-admin-layout>
