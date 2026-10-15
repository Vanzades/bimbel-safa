<x-super-admin-layout title="Penggajian Guru">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <span>Super Admin</span>
                    <span>/</span>
                    <span>Keuangan</span>
                </div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                Penggajian Guru
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola penggajian dan slip honor guru Bimbel Safa.
            </p>
        </div>

        <a href="{{ route('super-admin.salary-slips.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14"/>
                <path d="M5 12h14"/>
            </svg>
            Buat Penggajian
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Slip</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">
                {{ $totalSlips }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Gaji Periode {{ $currentPeriod }}</p>
            <p class="mt-2 text-xl font-semibold text-blue-600">
                Rp {{ number_format($currentPeriodTotal, 0, ',', '.') }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Penerimaan</p>
            <p class="mt-2 text-xl font-semibold text-emerald-600">
                Rp {{ number_format($totalIncome, 0, ',', '.') }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Potongan</p>
            <p class="mt-2 text-xl font-semibold text-red-600">
                Rp {{ number_format($totalDeduction, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" class="grid gap-3 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama atau NIK guru..."
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
            </div>

            <input type="text"
                   name="period"
                   value="{{ request('period') }}"
                   placeholder="Periode, contoh: September 2026"
                   class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

            <select name="branch_id"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                <option value="">Semua Cabang</option>

                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}"
                        @selected(request('branch_id') == $branch->id)>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2 lg:col-span-4">
                <button type="submit"
                        class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Filter
                </button>

                <a href="{{ route('super-admin.salary-slips.index') }}"
                   class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="text-base font-semibold text-slate-900">
                Daftar Penggajian
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Riwayat penggajian guru berdasarkan periode.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="border-b border-slate-100 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Guru
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Cabang
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Periode
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Penerimaan
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Potongan
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Gaji Bersih
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($salarySlips as $salarySlip)
                        <tr class="transition hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-blue-600">
                                        {{ strtoupper(substr($salarySlip->teacher->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">
                                            {{ $salarySlip->teacher->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-500">
                                            {{ $salarySlip->teacher->identity_number ?: 'NIK belum diisi' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $salarySlip->teacher->branch?->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $salarySlip->period }}
                                <p class="mt-0.5 text-xs text-slate-400">
                                    {{ $salarySlip->issued_at?->format('d M Y') }}
                                </p>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-emerald-600">
                                Rp {{ number_format($salarySlip->total_income, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-red-600">
                                Rp {{ number_format($salarySlip->total_deduction, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-900">
                                    Rp {{ number_format($salarySlip->net_salary, 0, ',', '.') }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('super-admin.salary-slips.show', $salarySlip) }}"
                                       class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 transition hover:bg-slate-50">
                                        Detail
                                    </a>

                                    <a href="{{ route('super-admin.salary-slips.edit', $salarySlip) }}"
                                       class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('super-admin.salary-slips.destroy', $salarySlip) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus penggajian ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <p class="text-sm font-semibold text-slate-700">
                                    Belum ada data penggajian.
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    Buat penggajian guru untuk mulai membuat slip gaji.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($salarySlips->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $salarySlips->links() }}
            </div>
        @endif
    </div>
</div>

</x-super-admin-layout>
