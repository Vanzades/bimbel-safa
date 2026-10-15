<x-super-admin-layout title="Edit Cabang">
    <div class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('super-admin.branches.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="m15 18-6-6 6-6" />
                </svg>
                Kembali ke Cabang
            </a>

            <div class="mt-4">
                <p class="text-sm font-medium text-blue-600">Super Admin</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Edit Cabang
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Perbarui informasi cabang {{ $branch->name }}.
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 9v4m0 4h.01M10.3 3.8L2.9 17a2 2 0 001.7 3h14.8a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z" />
                </svg>

                <div>
                    <p class="font-semibold">Data belum dapat disimpan.</p>

                    <ul class="mt-1 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('super-admin.branches.update', $branch) }}"
            method="POST"
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @csrf
            @method('PUT')

            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-9-3h3m0 0V7m0 3l7-7 3 3-7 7" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            Informasi Cabang
                        </h2>
                        <p class="mt-0.5 text-xs text-slate-500">
                            Perbarui data dasar cabang.
                        </p>
                    </div>
                </div>
            </div>

            <div class="space-y-5 px-5 py-6 sm:px-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700">
                        Nama Cabang
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $branch->name) }}"
                        required
                        autofocus
                        placeholder="Contoh: Bimbel Safa Jakarta"
                        class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-slate-700">
                        Alamat
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        placeholder="Masukkan alamat lengkap cabang"
                        class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    >{{ old('address', $branch->address) }}</textarea>

                    @error('address')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700">
                        Nomor Telepon
                    </label>

                    <input
                        id="phone"
                        name="phone"
                        type="text"
                        value="{{ old('phone', $branch->phone) }}"
                        placeholder="Contoh: 081234567890"
                        class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('phone')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="is_active" class="block text-sm font-semibold text-slate-700">
                        Status Cabang
                    </label>

                    <select
                        id="is_active"
                        name="is_active"
                        required
                        class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                    >
                        <option value="1" @selected(old('is_active', $branch->is_active ? '1' : '0') == '1')>
                            Aktif
                        </option>
                        <option value="0" @selected(old('is_active', $branch->is_active ? '1' : '0') == '0')>
                            Tidak Aktif
                        </option>
                    </select>

                    @error('is_active')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-6">
                <a href="{{ route('super-admin.branches.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-super-admin-layout>