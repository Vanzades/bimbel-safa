<x-super-admin-layout title="Tambah Siswa">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('super-admin.students.index') }}" class="transition hover:text-blue-600">Manajemen Siswa</a>
                    <span>/</span>
                    <span class="text-slate-700">Tambah Siswa</span>
                </div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Tambah Siswa</h1>
                <p class="mt-1 text-sm text-slate-500">Lengkapi informasi siswa untuk menambahkan data ke sistem.</p>
            </div>

            <a href="{{ route('super-admin.students.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="m15 18-6-6 6-6"/>
                    <path d="M20 12H9"/>
                </svg>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Data belum dapat disimpan.</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('super-admin.students.store') }}" method="POST" class="space-y-6">
            @csrf

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-semibold text-slate-900">Informasi Akademik</h2>
                    <p class="mt-1 text-sm text-slate-500">Tentukan cabang, program, dan kelas siswa.</p>
                </div>

                <div class="grid gap-5 p-6 sm:grid-cols-2">
                    <div>
                        <label for="branch_id" class="mb-2 block text-sm font-medium text-slate-700">Cabang <span class="text-red-500">*</span></label>
                        <select id="branch_id" name="branch_id" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            <option value="">Pilih cabang</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @selected(old('branch_id') == $branch->id)>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="program_id" class="mb-2 block text-sm font-medium text-slate-700">Program</label>
                        <select id="program_id" name="program_id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            <option value="">Pilih program</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" @selected(old('program_id') == $program->id)>{{ $program->name }}</option>
                            @endforeach
                        </select>
                        @error('program_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="class_room_id" class="mb-2 block text-sm font-medium text-slate-700">Kelas</label>
                        <select id="class_room_id" name="class_room_id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            <option value="">Pilih kelas</option>
                            @foreach ($classRooms as $classRoom)
                                <option value="{{ $classRoom->id }}" @selected(old('class_room_id') == $classRoom->id)>{{ $classRoom->name }}{{ $classRoom->branch ? ' — '.$classRoom->branch->name : '' }}</option>
                            @endforeach
                        </select>
                        @error('class_room_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-semibold text-slate-900">Data Pribadi</h2>
                    <p class="mt-1 text-sm text-slate-500">Masukkan identitas dan informasi kontak siswa.</p>
                </div>

                <div class="grid gap-5 p-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255" placeholder="Masukkan nama lengkap siswa" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="identity_number" class="mb-2 block text-sm font-medium text-slate-700">NIK / Nomor Identitas</label>
                        <input id="identity_number" name="identity_number" type="text" value="{{ old('identity_number') }}" maxlength="50" placeholder="Masukkan nomor identitas" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('identity_number')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="gender" class="mb-2 block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                        <select id="gender" name="gender" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="male" @selected(old('gender') === 'male')>Laki-laki</option>
                            <option value="female" @selected(old('gender') === 'female')>Perempuan</option>
                        </select>
                        @error('gender')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="birth_place" class="mb-2 block text-sm font-medium text-slate-700">Tempat Lahir</label>
                        <input id="birth_place" name="birth_place" type="text" value="{{ old('birth_place') }}" maxlength="100" placeholder="Contoh: Bogor" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('birth_place')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="birth_date" class="mb-2 block text-sm font-medium text-slate-700">Tanggal Lahir</label>
                        <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('birth_date')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-slate-700">Nomor Telepon</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" maxlength="20" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="255" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="address" class="mb-2 block text-sm font-medium text-slate-700">Alamat</label>
                        <textarea id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap siswa" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('address') }}</textarea>
                        @error('address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-semibold text-slate-900">Data Orang Tua / Wali</h2>
                    <p class="mt-1 text-sm text-slate-500">Informasi orang tua atau wali yang dapat dihubungi.</p>
                </div>

                <div class="grid gap-5 p-6 sm:grid-cols-2">
                    <div>
                        <label for="parent_name" class="mb-2 block text-sm font-medium text-slate-700">Nama Orang Tua / Wali</label>
                        <input id="parent_name" name="parent_name" type="text" value="{{ old('parent_name') }}" maxlength="255" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('parent_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="parent_phone" class="mb-2 block text-sm font-medium text-slate-700">Nomor Telepon Orang Tua</label>
                        <input id="parent_phone" name="parent_phone" type="text" value="{{ old('parent_phone') }}" maxlength="20" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('parent_phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="parent_occupation" class="mb-2 block text-sm font-medium text-slate-700">Pekerjaan Orang Tua</label>
                        <input id="parent_occupation" name="parent_occupation" type="text" value="{{ old('parent_occupation') }}" maxlength="100" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('parent_occupation')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="parent_address" class="mb-2 block text-sm font-medium text-slate-700">Alamat Orang Tua / Wali</label>
                        <textarea id="parent_address" name="parent_address" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('parent_address') }}</textarea>
                        @error('parent_address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-semibold text-slate-900">Informasi Tambahan</h2>
                    <p class="mt-1 text-sm text-slate-500">Lengkapi informasi pendukung dan status siswa.</p>
                </div>

                <div class="space-y-5 p-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:gap-8">
                        <label class="flex items-start gap-3">
                            <input type="checkbox" name="previous_tutoring" value="1" @checked(old('previous_tutoring')) class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>
                                <span class="block text-sm font-medium text-slate-800">Pernah mengikuti bimbingan belajar</span>
                                <span class="mt-1 block text-xs text-slate-500">Centang jika siswa pernah mengikuti bimbel sebelumnya.</span>
                            </span>
                        </label>

                        <label class="flex items-start gap-3">
                            <input type="checkbox" name="special_needs" value="1" @checked(old('special_needs')) class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>
                                <span class="block text-sm font-medium text-slate-800">Kebutuhan khusus</span>
                                <span class="mt-1 block text-xs text-slate-500">Centang jika terdapat kebutuhan khusus yang perlu diperhatikan.</span>
                            </span>
                        </label>
                    </div>

                    <div>
                        <label for="notes" class="mb-2 block text-sm font-medium text-slate-700">Catatan</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Catatan tambahan tentang siswa" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('notes') }}</textarea>
                        @error('notes')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="status" class="mb-2 block text-sm font-medium text-slate-700">Status Siswa <span class="text-red-500">*</span></label>
                            <select id="status" name="status" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                                <option value="active" @selected(old('status', 'active') === 'active')>Aktif</option>
                                <option value="inactive" @selected(old('status') === 'inactive')>Tidak Aktif</option>
                            </select>
                            @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="registration_status" class="mb-2 block text-sm font-medium text-slate-700">Status Pendaftaran <span class="text-red-500">*</span></label>
                            <select id="registration_status" name="registration_status" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                                <option value="approved" @selected(old('registration_status', 'approved') === 'approved')>Disetujui</option>
                                <option value="pending" @selected(old('registration_status') === 'pending')>Menunggu</option>
                                <option value="rejected" @selected(old('registration_status') === 'rejected')>Ditolak</option>
                            </select>
                            @error('registration_status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </section>

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('super-admin.students.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Simpan Siswa
                </button>
            </div>
        </form>
    </div>
</x-super-admin-layout>