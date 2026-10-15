<?php

namespace App\Http\Controllers;

use App\Models\SalarySlip;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalarySlipController extends Controller
{
    public function index(Request $request): View
    {
        $query = SalarySlip::with([
            'teacher.branch',
            'creator',
            'receiver',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('teacher', function ($teacherQuery) use ($search) {
                $teacherQuery->where('name', 'like', "%{$search}%")->orWhere('identity_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('period')) {
            $query->where('period', $request->period);
        }

        if ($request->filled('branch_id')) {
            $query->whereHas('teacher', function ($teacherQuery) use ($request) {
                $teacherQuery->where('branch_id', $request->branch_id);
            });
        }

        $salarySlips = $query->latest('issued_at')->latest()->paginate(10)->withQueryString();

        $branches = \App\Models\Branch::orderBy('name')->get();

        $totalSlips = SalarySlip::count();

        $currentPeriod = now()->format('F Y');

        $currentPeriodTotal = SalarySlip::query()
            ->where('period', $currentPeriod)
            ->get()
            ->sum(fn($slip) => $slip->net_salary);

        $totalIncome = SalarySlip::query()->get()->sum(fn($slip) => $slip->total_income);

        $totalDeduction = SalarySlip::query()->get()->sum(fn($slip) => $slip->total_deduction);

        return view('super-admin.salary-slips.index', compact(
            'salarySlips',
            'branches',
            'totalSlips',
            'currentPeriod',
            'currentPeriodTotal',
            'totalIncome',
            'totalDeduction',
        ));
    }

    public function create(): View
    {
        $teachers = Teacher::with([
            'branch',
            'user',
        ])
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('super-admin.salary-slips.create', compact('teachers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'teacher_id' => ['required', 'exists:teachers,id'],
            'period' => ['required', 'string', 'max:50'],
            'issued_at' => ['required', 'date'],
            'attendance_incentive' => ['required', 'numeric', 'min:0'],
            'regular_teaching_honor' => ['required', 'numeric', 'min:0'],
            'private_teaching_honor' => ['required', 'numeric', 'min:0'],
            'overtime' => ['required', 'numeric', 'min:0'],
            'health_allowance' => ['required', 'numeric', 'min:0'],
            'bonus' => ['required', 'numeric', 'min:0'],
            'loan_deduction' => ['required', 'numeric', 'min:0'],
            'income_tax' => ['required', 'numeric', 'min:0'],
            'play_calistung_sd_count' => ['required', 'integer', 'min:0'],
            'smp_count' => ['required', 'integer', 'min:0'],
            'sma_count' => ['required', 'integer', 'min:0'],
            'private_count' => ['required', 'numeric', 'min:0'],
            'received_by' => ['nullable', 'exists:users,id'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ], [
            'teacher_id.required' => 'Guru wajib dipilih.',
            'teacher_id.exists' => 'Guru yang dipilih tidak valid.',
            'period.required' => 'Periode wajib diisi.',
            'issued_at.required' => 'Tanggal dibuat wajib diisi.',
        ]);

        $exists = SalarySlip::where('teacher_id', $validated['teacher_id'])
            ->where('period', $validated['period'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'period' => 'Slip gaji untuk guru dan periode tersebut sudah tersedia.',
                ]);
        }

        $validated['created_by'] = $request->user()->id;

        SalarySlip::create($validated);

        return redirect()->route('super-admin.salary-slips.index')->with('success', 'Penggajian guru berhasil dibuat.');
    }

    public function show(SalarySlip $salarySlip): View
    {
        $salarySlip->load([
            'teacher.branch',
            'creator',
            'receiver',
        ]);

        return view('super-admin.salary-slips.show', compact('salarySlip'));
    }

    public function edit(SalarySlip $salarySlip): View
    {
        $salarySlip->load([
            'teacher.branch',
            'teacher.user',
            'creator',
            'receiver',
        ]);

        $teachers = Teacher::with([
            'branch',
            'user',
        ])
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('super-admin.salary-slips.edit', compact('salarySlip', 'teachers'));
    }

    public function update(Request $request, SalarySlip $salarySlip): RedirectResponse
    {
        $validated = $request->validate([
            'teacher_id' => ['required', 'exists:teachers,id'],
            'period' => ['required', 'string', 'max:50'],
            'issued_at' => ['required', 'date'],
            'attendance_incentive' => ['required', 'numeric', 'min:0'],
            'regular_teaching_honor' => ['required', 'numeric', 'min:0'],
            'private_teaching_honor' => ['required', 'numeric', 'min:0'],
            'overtime' => ['required', 'numeric', 'min:0'],
            'health_allowance' => ['required', 'numeric', 'min:0'],
            'bonus' => ['required', 'numeric', 'min:0'],
            'loan_deduction' => ['required', 'numeric', 'min:0'],
            'income_tax' => ['required', 'numeric', 'min:0'],
            'play_calistung_sd_count' => ['required', 'integer', 'min:0'],
            'smp_count' => ['required', 'integer', 'min:0'],
            'sma_count' => ['required', 'integer', 'min:0'],
            'private_count' => ['required', 'numeric', 'min:0'],
            'received_by' => ['nullable', 'exists:users,id'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $exists = SalarySlip::where('teacher_id', $validated['teacher_id'])
            ->where('period', $validated['period'])
            ->where('id', '!=', $salarySlip->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'period' => 'Slip gaji untuk guru dan periode tersebut sudah tersedia.',
                ]);
        }

        $salarySlip->update($validated);

        return redirect()
            ->route('super-admin.salary-slips.show', $salarySlip)
            ->with('success', 'Data penggajian berhasil diperbarui.');
    }

    public function destroy(SalarySlip $salarySlip): RedirectResponse
    {
        $salarySlip->delete();

        return redirect()
            ->route('super-admin.salary-slips.index')
            ->with('success', 'Data penggajian berhasil dihapus.');
    }

    public function teacherIndex(Request $request): View
    {
        $user = $request->user();

        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();

        $salarySlips = SalarySlip::where('teacher_id', $teacher->id)
            ->latest('issued_at')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalSlips = SalarySlip::where('teacher_id', $teacher->id)->count();

        $totalIncome = SalarySlip::where('teacher_id', $teacher->id)->get()->sum(fn($slip) => $slip->total_income);

        $totalDeduction = SalarySlip::where(
            'teacher_id',
            $teacher->id,
        )->get()->sum(fn($slip) => $slip->total_deduction);

        $totalNetSalary = SalarySlip::where('teacher_id', $teacher->id)->get()->sum(fn($slip) => $slip->net_salary);

        return view('teacher.salary-slips.index', compact(
            'teacher',
            'salarySlips',
            'totalSlips',
            'totalIncome',
            'totalDeduction',
            'totalNetSalary',
        ));
    }

    public function teacherShow(Request $request, SalarySlip $salarySlip): View
    {
        $teacher = Teacher::where('user_id', $request->user()->id)->firstOrFail();

        abort_unless($salarySlip->teacher_id === $teacher->id, 403);

        $salarySlip->load([
            'teacher.branch',
            'creator',
            'receiver',
        ]);

        return view('teacher.salary-slips.show', compact('salarySlip'));
    }
}
