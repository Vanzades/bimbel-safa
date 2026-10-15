<x-super-admin-layout title="Edit Penggajian Guru">
    <div class="mx-auto max-w-6xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('super-admin.salary-slips.index') }}" class="hover:text-blue-600">
                        Penggajian Guru
                    </a>
                    <span>/</span>
                    <span>Edit</span>
                </div>

            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                Edit Penggajian Guru
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui data penggajian {{ $salarySlip->teacher->name }}.
            </p>
        </div>

        <a href="{{ route('super-admin.salary-slips.show', $salarySlip) }}"
           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
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
          action="{{ route('super-admin.salary-slips.update', $salarySlip) }}"
          class="space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Informasi Slip Gaji
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Identitas guru dan periode penggajian.
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
                                @selected(old('teacher_id', $salarySlip->teacher_id) == $teacher->id)>
                                {{ $teacher->name }} — {{ $teacher->branch?->name ?? 'Tanpa Cabang' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="period" class="mb-2 block text-sm font-medium text-slate-700">
                        Periode
                    </label>

                    <input id="period"
                           type="text"
                           name="period"
                           value="{{ old('period', $salarySlip->period) }}"
                           required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div>
                    <label for="issued_at" class="mb-2 block text-sm font-medium text-slate-700">
                        Tanggal Dibuat
                    </label>

                    <input id="issued_at"
                           type="date"
                           name="issued_at"
                           value="{{ old('issued_at', $salarySlip->issued_at?->format('Y-m-d')) }}"
                           required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
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
                                    @selected(old('received_by', $salarySlip->received_by) == $teacher->user->id)>
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
                    <h2 class="text-base font-semibold text-slate-900">
                        Penerimaan
                    </h2>
                </div>

                <div class="space-y-4 p-6">
                    @php
                        $incomeFields = [
                            'attendance_incentive' => 'Gaji Pokok (Insentif Kehadiran)',
                            'regular_teaching_honor' => 'Honor Mengajar Reguler',
                            'private_teaching_honor' => 'Honor Mengajar Privat',
                            'overtime' => 'Uang Lembur',
                            'health_allowance' => 'Tunjangan Kesehatan',
                            'bonus' => 'Bonus',
                        ];
                    @endphp

                    @foreach ($incomeFields as $field => $label)
                        <div>
                            <label for="{{ $field }}" class="mb-2 block text-sm font-medium text-slate-700">
                                {{ $label }}
                            </label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                    Rp
                                </span>

                                <input id="{{ $field }}"
                                       type="number"
                                       name="{{ $field }}"
                                       value="{{ old($field, $salarySlip->{$field}) }}"
                                       min="0"
                                       step="1000"
                                       class="money-income w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            </div>
                        </div>
                    @endforeach

                    <div class="border-t border-slate-100 pt-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-700">
                                Total Penerimaan
                            </span>

                            <span id="total-income" class="text-lg font-bold text-emerald-600">
                                Rp 0
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="text-base font-semibold text-slate-900">
                        Potongan
                    </h2>
                </div>

                <div class="space-y-4 p-6">
                    @php
                        $deductionFields = [
                            'loan_deduction' => 'Pinjaman',
                            'income_tax' => 'PPh 21',
                        ];
                    @endphp

                    @foreach ($deductionFields as $field => $label)
                        <div>
                            <label for="{{ $field }}" class="mb-2 block text-sm font-medium text-slate-700">
                                {{ $label }}
                            </label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                    Rp
                                </span>

                                <input id="{{ $field }}"
                                       type="number"
                                       name="{{ $field }}"
                                       value="{{ old($field, $salarySlip->{$field}) }}"
                                       min="0"
                                       step="1000"
                                       class="money-deduction w-full rounded-xl border border-slate-200 px-4 py-2.5 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            </div>
                        </div>
                    @endforeach

                    <div class="border-t border-slate-100 pt-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-700">
                                Total Potongan
                            </span>

                            <span id="total-deduction" class="text-lg font-bold text-red-600">
                                Rp 0
                            </span>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-slate-900 p-5">
                        <p class="text-sm text-slate-400">
                            Gaji Bersih
                        </p>

                        <p id="net-salary" class="mt-1 text-2xl font-bold text-white">
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
                    Jumlah mengajar selama periode penggajian.
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
                           value="{{ old('play_calistung_sd_count', $salarySlip->play_calistung_sd_count) }}"
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
                           value="{{ old('smp_count', $salarySlip->smp_count) }}"
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
                           value="{{ old('sma_count', $salarySlip->sma_count) }}"
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
                           value="{{ old('private_count', $salarySlip->private_count) }}"
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
                          class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('notes', $salarySlip->notes) }}</textarea>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('super-admin.salary-slips.show', $salarySlip) }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                Batal
            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                Simpan Perubahan
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
