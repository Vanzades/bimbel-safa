<x-super-admin-layout title="Buat Penggajian Guru">
    <div class="mx-auto max-w-6xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('super-admin.salary-slips.index') }}" class="hover:text-blue-600">
                        Penggajian Guru
                    </a>
                    <span>/</span>
                    <span>Buat Penggajian</span>
                </div>

            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                Buat Penggajian Guru
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Masukkan komponen penerimaan, potongan, dan jumlah mengajar guru.
            </p>
        </div>

        <a href="{{ route('super-admin.salary-slips.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 p-4">
            <p class="text-sm font-semibold text-red-700">
                Periksa kembali data berikut:
            </p>

            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('super-admin.salary-slips.store') }}"
          class="space-y-6">
        @csrf

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Informasi Slip Gaji
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tentukan guru dan periode penggajian.
                </p>
            </div>

            <div class="grid gap-5 p-6 md:grid-cols-2">
                <div>
                    <label for="teacher_id" class="mb-2 block text-sm font-medium text-slate-700">
                        Guru
                    </label>

                    <select id="teacher_id"
                            name="teacher_id"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        <option value="">Pilih guru</option>

                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                @selected(old('teacher_id') == $teacher->id)>
                                {{ $teacher->name }} — {{ $teacher->branch?->name ?? 'Tanpa Cabang' }}
                            </option>
                        @endforeach
                    </select>

                    @error('teacher_id')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="period" class="mb-2 block text-sm font-medium text-slate-700">
                        Periode
                    </label>

                    <input id="period"
                           type="text"
                           name="period"
                           value="{{ old('period') }}"
                           placeholder="Contoh: 21 Agt - 20 Sept 2026"
                           required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                    @error('period')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="issued_at" class="mb-2 block text-sm font-medium text-slate-700">
                        Tanggal Dibuat
                    </label>

                    <input id="issued_at"
                           type="date"
                           name="issued_at"
                           value="{{ old('issued_at', now()->format('Y-m-d')) }}"
                           required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                    @error('issued_at')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="received_by" class="mb-2 block text-sm font-medium text-slate-700">
                        Diterima Oleh
                    </label>

                    <select id="received_by"
                            name="received_by"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        <option value="">Guru yang bersangkutan</option>

                        @foreach ($teachers as $teacher)
                            @if ($teacher->user)
                                <option value="{{ $teacher->user->id }}"
                                    @selected(old('received_by') == $teacher->user->id)>
                                    {{ $teacher->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900">
                                Penerimaan
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Komponen pendapatan guru.
                            </p>
                        </div>

                        <span class="rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                            Penerimaan
                        </span>
                    </div>
                </div>

                <div class="space-y-4 p-6">
                    <div>
                        <label for="attendance_incentive" class="mb-2 block text-sm font-medium text-slate-700">
                            Gaji Pokok (Insentif Kehadiran)
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="attendance_incentive"
                                   type="number"
                                   name="attendance_incentive"
                                   value="{{ old('attendance_incentive', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-income w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div>
                        <label for="regular_teaching_honor" class="mb-2 block text-sm font-medium text-slate-700">
                            Honor Mengajar Reguler
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="regular_teaching_honor"
                                   type="number"
                                   name="regular_teaching_honor"
                                   value="{{ old('regular_teaching_honor', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-income w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div>
                        <label for="private_teaching_honor" class="mb-2 block text-sm font-medium text-slate-700">
                            Honor Mengajar Privat
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="private_teaching_honor"
                                   type="number"
                                   name="private_teaching_honor"
                                   value="{{ old('private_teaching_honor', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-income w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div>
                        <label for="overtime" class="mb-2 block text-sm font-medium text-slate-700">
                            Uang Lembur
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="overtime"
                                   type="number"
                                   name="overtime"
                                   value="{{ old('overtime', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-income w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div>
                        <label for="health_allowance" class="mb-2 block text-sm font-medium text-slate-700">
                            Tunjangan Kesehatan
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="health_allowance"
                                   type="number"
                                   name="health_allowance"
                                   value="{{ old('health_allowance', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-income w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div>
                        <label for="bonus" class="mb-2 block text-sm font-medium text-slate-700">
                            Bonus
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="bonus"
                                   type="number"
                                   name="bonus"
                                   value="{{ old('bonus', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-income w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-700">
                                Total Penerimaan
                            </span>

                            <span id="total-income"
                                  class="text-lg font-bold text-emerald-600">
                                Rp 0
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900">
                                Potongan
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Komponen pengurang gaji.
                            </p>
                        </div>

                        <span class="rounded-lg bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                            Potongan
                        </span>
                    </div>
                </div>

                <div class="space-y-4 p-6">
                    <div>
                        <label for="loan_deduction" class="mb-2 block text-sm font-medium text-slate-700">
                            Pinjaman
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="loan_deduction"
                                   type="number"
                                   name="loan_deduction"
                                   value="{{ old('loan_deduction', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-deduction w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div>
                        <label for="income_tax" class="mb-2 block text-sm font-medium text-slate-700">
                            PPh 21
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                Rp
                            </span>

                            <input id="income_tax"
                                   type="number"
                                   name="income_tax"
                                   value="{{ old('income_tax', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="money-deduction w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-700">
                                Total Potongan
                            </span>

                            <span id="total-deduction"
                                  class="text-lg font-bold text-red-600">
                                Rp 0
                            </span>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-slate-900 p-5">
                        <p class="text-sm text-slate-400">
                            Gaji Bersih
                        </p>

                        <p id="net-salary"
                           class="mt-1 text-2xl font-bold text-white">
                            Rp 0
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Keterangan Mengajar
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Catat jumlah mengajar sesuai periode penggajian.
                </p>
            </div>

            <div class="grid gap-5 p-6 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <label for="play_calistung_sd_count" class="mb-2 block text-sm font-medium text-slate-700">
                        Kelas Bermain, Calistung & SD
                    </label>

                    <input id="play_calistung_sd_count"
                           type="number"
                           name="play_calistung_sd_count"
                           value="{{ old('play_calistung_sd_count', 0) }}"
                           min="0"
                           step="1"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div>
                    <label for="smp_count" class="mb-2 block text-sm font-medium text-slate-700">
                        Kelas SMP
                    </label>

                    <input id="smp_count"
                           type="number"
                           name="smp_count"
                           value="{{ old('smp_count', 0) }}"
                           min="0"
                           step="1"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div>
                    <label for="sma_count" class="mb-2 block text-sm font-medium text-slate-700">
                        Kelas SMA
                    </label>

                    <input id="sma_count"
                           type="number"
                           name="sma_count"
                           value="{{ old('sma_count', 0) }}"
                           min="0"
                           step="1"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div>
                    <label for="private_count" class="mb-2 block text-sm font-medium text-slate-700">
                        Kelas Privat
                    </label>

                    <input id="private_count"
                           type="number"
                           name="private_count"
                           value="{{ old('private_count', 0) }}"
                           min="0"
                           step="0.01"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Catatan
                </h2>
            </div>

            <div class="p-6">
                <textarea name="notes"
                          rows="4"
                          placeholder="Tambahkan keterangan bila diperlukan..."
                          class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('notes') }}</textarea>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('super-admin.salary-slips.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                Batal
            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                Simpan Penggajian
            </button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        const incomeInputs = document.querySelectorAll('.money-income');
        const deductionInputs = document.querySelectorAll('.money-deduction');

        const formatCurrency = (value) => {
            return new Intl.NumberFormat('id-ID').format(value);
        };

        const calculateSalary = () => {
            const totalIncome = [...incomeInputs].reduce((total, input) => {
                return total + (Number(input.value) || 0);
            }, 0);

            const totalDeduction = [...deductionInputs].reduce((total, input) => {
                return total + (Number(input.value) || 0);
            }, 0);

            const netSalary = totalIncome - totalDeduction;

            document.getElementById('total-income').textContent =
                `Rp ${formatCurrency(totalIncome)}`;

            document.getElementById('total-deduction').textContent =
                `Rp ${formatCurrency(totalDeduction)}`;

            document.getElementById('net-salary').textContent =
                `Rp ${formatCurrency(netSalary)}`;
        };

        incomeInputs.forEach(input => {
            input.addEventListener('input', calculateSalary);
        });

        deductionInputs.forEach(input => {
            input.addEventListener('input', calculateSalary);
        });

        calculateSalary();
    </script>
@endpush

</x-super-admin-layout>
