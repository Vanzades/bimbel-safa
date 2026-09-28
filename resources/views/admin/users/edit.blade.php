<x-admin-layout>

    <x-slot name="title">

        Detail Akun

    </x-slot>



    @php

        $roleStyles = [

            'admin' => [

                'label' => 'Admin',

                'badge' => 'bg-purple-600 text-white font-semibold dark:bg-purple-500/20 dark:text-purple-300',

            ],

            'guru' => [

                'label' => 'Guru',

                'badge' => 'bg-indigo-600 text-white font-semibold dark:bg-indigo-500/20 dark:text-indigo-300',

            ],

            'siswa' => [

                'label' => 'Siswa',

                'badge' => 'bg-emerald-600 text-white font-semibold dark:bg-emerald-500/20 dark:text-emerald-300',

            ],

        ];



        $statusStyles = [

            'active'   => 'bg-emerald-600 text-white font-semibold dark:bg-emerald-500/20 dark:text-emerald-300',

            'inactive' => 'bg-red-600 text-white font-semibold dark:bg-red-500/20 dark:text-red-300',

        ];



        $style = $roleStyles[$user->role] ?? $roleStyles['siswa'];



        $label = 'block text-[13px] sm:text-sm font-semibold uppercase tracking-wider mb-1';

        $field = 'w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-medium outline-none';

        $fieldStyle = 'background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);';

    @endphp



    {{-- Wrapper utama --}}

    <div class="py-4 lg:py-6 min-h-screen transition-colors duration-150" style="background-color: var(--admin-bg); color: var(--admin-text);">

        <div class="max-w-90rem mx-auto px-4 sm:px-6 lg:px-10">



            {{-- ====== Breadcrumb ====== --}}

            <nav class="flex items-center gap-1.5 text-[11px] sm:text-xs font-medium mb-3" style="color: var(--admin-muted);">

                <a href="{{ route('admin.dashboard') }}" class="hover:opacity-85">Dashboard</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>

                <a href="{{ route('admin.users.index') }}" class="hover:opacity-85">Akun</a>

                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>

                <span class="font-semibold" style="color: var(--admin-text);">Detail Akun</span>

            </nav>



            {{-- ====== JUDUL HALAMAN ====== --}}

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8 mb-12">

                <div>

                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight">

                        Detail Akun

                    </h1>

                    <p class="mt-1.5 text-xs sm:text-sm" style="color: var(--admin-muted);">

                        Informasi akun dan data yang terhubung.

                    </p>

                </div>

            </div>



            {{-- ====== CARD UTAMA (Full Width / Panjang) ====== --}}

            <div class="rounded-2xl p-6 sm:p-8 shadow-sm space-y-8" style="border: 1px solid var(--admin-border); background-color: var(--admin-surface); box-shadow: 0 4px 20px var(--admin-shadow);">



                {{-- Header Profile Singkat di dalam Card --}}

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b" style="border-color: var(--admin-border);">

                    <div class="flex items-center gap-4">

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl text-xl font-bold uppercase" style="background-color: var(--admin-surface-soft); border: 1px solid var(--admin-border); color: var(--admin-text);">

                            {{ substr($user->name, 0, 1) }}

                        </div>

                        <div>

                            <h2 class="text-sm sm:text-base font-bold tracking-tight" style="color: var(--admin-text);">

                                {{ $user->name }}

                            </h2>

                            <p class="text-[11px] sm:text-xs mt-0.5" style="color: var(--admin-muted);">

                                ID Pengguna: <span class="font-medium" style="color: var(--admin-text);">#{{ $user->id }}</span>

                            </p>

                        </div>

                    </div>



                    <div>

                        <span class="inline-flex items-center px-3 py-1.5 rounded-md text-xs sm:text-sm backdrop-blur-sm {{ $style['badge'] }}">

                            {{ $style['label'] }}

                        </span>

                    </div>

                </div>



                {{-- Informasi Akun --}}

                <div>

                    <h3 class="text-sm sm:text-base font-bold uppercase tracking-wider mb-4" style="color: var(--admin-muted);">

                        Informasi Login

                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Nama Pengguna</label>

                            <input type="text" value="{{ $user->name }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Email</label>

                            <input type="text" value="{{ $user->email }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Role</label>

                            <input type="text" value="{{ $style['label'] }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div class="md:col-span-2 lg:col-span-3">

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Akun Dibuat</label>

                            <input type="text" value="{{ $user->created_at->format('d F Y, H:i') }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>

                    </div>

                </div>



                {{-- ====== DATA GURU TERHUBUNG ====== --}}

                @if ($user->teacher)

                <div class="pt-6 border-t" style="border-color: var(--admin-border);">

                    <h3 class="text-sm sm:text-base font-bold uppercase tracking-wider mb-4" style="color: var(--admin-muted);">

                        Data Guru Terhubung

                    </h3>



                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Nama Guru</label>

                            <input type="text" value="{{ $user->teacher->name }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">NIP / NIK</label>

                            <input type="text" value="{{ $user->teacher->identity_number }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Jenis Kelamin</label>

                            <input type="text" value="{{ $user->teacher->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">No. Telepon</label>

                            <input type="text" value="{{ $user->teacher->phone ?: '-' }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Status Guru</label>

                            <div class="{{ $field }} flex items-center" style="{{ $fieldStyle }}">

                                <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm {{ $statusStyles[$user->teacher->status] ?? $statusStyles['inactive'] }}">

                                    {{ $user->teacher->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- ====== DATA SISWA TERHUBUNG ====== --}}

                @elseif ($user->student)

                <div class="pt-6 border-t" style="border-color: var(--admin-border);">

                    <h3 class="text-sm sm:text-base font-bold uppercase tracking-wider mb-4" style="color: var(--admin-muted);">

                        Data Siswa Terhubung

                    </h3>



                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Nama Siswa</label>

                            <input type="text" value="{{ $user->student->name }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">NIS / NISN</label>

                            <input type="text" value="{{ $user->student->identity_number }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Jenis Kelamin</label>

                            <input type="text" value="{{ $user->student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Kelas</label>

                            <input type="text" value="{{ $user->student->classRoom->name ?? '-' }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">No. Telepon</label>

                            <input type="text" value="{{ $user->student->phone ?: '-' }}" disabled class="{{ $field }}" style="{{ $fieldStyle }}">

                        </div>



                        <div>

                            <label class="{{ $label }}" style="color: var(--admin-muted);">Status Siswa</label>

                            <div class="{{ $field }} flex items-center" style="{{ $fieldStyle }}">

                                <span class="inline-flex px-2.5 py-1 rounded-md text-xs sm:text-sm backdrop-blur-sm {{ $statusStyles[$user->student->status] ?? $statusStyles['inactive'] }}">

                                    {{ $user->student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                @endif



            </div>



        </div>

    </div>

</x-admin-layout>
