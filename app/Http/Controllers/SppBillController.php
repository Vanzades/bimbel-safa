<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ClassRoom;
use App\Models\SppBill;
use App\Models\Student;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SppBillController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = SppBill::with(['student.classRoom']);

        if (!$user->isSuperAdmin()) {
            $query->whereHas('student', function ($studentQuery) use ($user) {
                $studentQuery->where('branch_id', $user->branch_id);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('student', function ($studentQuery) use ($search) {
                $studentQuery->where('name', 'like', "%{$search}%")->orWhere('identity_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class_room_id')) {
            $query->whereHas('student', function ($studentQuery) use ($request) {
                $studentQuery->where('class_room_id', $request->class_room_id);
            });
        }

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sppBills = $query->latest('year')->latest('month')->paginate(10)->withQueryString();

        $classRoomsQuery = ClassRoom::query()->orderBy('name');

        if (!$user->isSuperAdmin()) {
            $classRoomsQuery->where('branch_id', $user->branch_id);
        }

        $classRooms = $classRoomsQuery->get();

        $yearsQuery = SppBill::query();

        if (!$user->isSuperAdmin()) {
            $yearsQuery->whereHas('student', function ($studentQuery) use ($user) {
                $studentQuery->where('branch_id', $user->branch_id);
            });
        }

        $years = $yearsQuery->select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('admin.spp-bills.index', compact('sppBills', 'classRooms', 'years'));
    }

    public function create(Request $request)
    {
        $user = $request->user();

        $studentsQuery = Student::with('classRoom')->where('status', 'active')->orderBy('name');

        if (!$user->isSuperAdmin()) {
            $studentsQuery->where('branch_id', $user->branch_id);
        }

        $students = $studentsQuery->get();

        return view('admin.spp-bills.create', compact('students'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],
            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],
            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],
            'status' => [
                'required',
                Rule::in([
                    'paid',
                    'unpaid',
                    'pending',
                    'failed',
                    'expired',
                ]),
            ],
            'paid_at' => [
                'nullable',
                'date',
            ],
            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $student = Student::query()
            ->where('id', $validated['student_id'])
            ->when(!$user->isSuperAdmin(), fn($query) => $query->where('branch_id', $user->branch_id))
            ->first();

        if (!$student) {
            return back()->withErrors([
                'student_id' => 'Siswa tidak berada pada cabang Anda.',
            ])->withInput();
        }

        $exists = SppBill::where('student_id', $validated['student_id'])
            ->where('month', $validated['month'])
            ->where('year', $validated['year'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'student_id' => 'Tagihan SPP untuk siswa dan periode tersebut sudah ada.',
            ])->withInput();
        }

        if ($validated['status'] === 'paid' && empty($validated['paid_at'])) {
            $validated['paid_at'] = now();
        }

        if ($validated['status'] !== 'paid') {
            $validated['paid_at'] = null;
        }

        $sppBill = SppBill::create($validated);

        $sppBill->load('student.user');

        if ($sppBill->student?->user) {
            $sppBill
                ->student
                ->user
                ->notify(
                    new SystemNotification(
                        'Tagihan SPP Baru',
                        'Tagihan SPP untuk bulan '
                        . $this->formatMonth($sppBill->month)
                        . ' '
                        . $sppBill->year
                        . ' sebesar Rp '
                        . number_format($sppBill->amount, 0, ',', '.')
                        . ' telah dibuat.',
                        route('student.spp.show', $sppBill->id),
                        $sppBill->status === 'paid' ? 'success' : 'info',
                    ),
                );
        }

        return redirect()->route('admin.spp-bills.index')->with('success', 'Tagihan SPP berhasil ditambahkan.');
    }

    public function show(Request $request, SppBill $sppBill)
    {
        $this->ensureBranchAccess($request, $sppBill);

        $sppBill->load(['student.classRoom']);

        return view('admin.spp-bills.show', compact('sppBill'));
    }

    public function edit(Request $request, SppBill $sppBill)
    {
        $this->ensureBranchAccess($request, $sppBill);

        $user = $request->user();

        $studentsQuery = Student::with('classRoom')->orderBy('name');

        if (!$user->isSuperAdmin()) {
            $studentsQuery->where('branch_id', $user->branch_id);
        }

        $students = $studentsQuery->get();

        return view('admin.spp-bills.edit', compact('sppBill', 'students'));
    }

    public function update(Request $request, SppBill $sppBill)
    {
        $user = $request->user();

        $this->ensureBranchAccess($request, $sppBill);

        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],
            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],
            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],
            'status' => [
                'required',
                Rule::in([
                    'paid',
                    'unpaid',
                    'pending',
                    'failed',
                    'expired',
                ]),
            ],
            'paid_at' => [
                'nullable',
                'date',
            ],
            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $student = Student::query()
            ->where('id', $validated['student_id'])
            ->when(!$user->isSuperAdmin(), fn($query) => $query->where('branch_id', $user->branch_id))
            ->first();

        if (!$student) {
            return back()->withErrors([
                'student_id' => 'Siswa tidak berada pada cabang Anda.',
            ])->withInput();
        }

        $exists = SppBill::where('student_id', $validated['student_id'])
            ->where('month', $validated['month'])
            ->where('year', $validated['year'])
            ->where('id', '!=', $sppBill->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'student_id' => 'Tagihan SPP untuk siswa dan periode tersebut sudah ada.',
            ])->withInput();
        }

        if ($validated['status'] === 'paid' && empty($validated['paid_at'])) {
            $validated['paid_at'] = now();
        }

        if ($validated['status'] !== 'paid') {
            $validated['paid_at'] = null;
        }

        $oldStudentId = $sppBill->student_id;
        $oldStatus = $sppBill->status;
        $oldAmount = $sppBill->amount;
        $oldMonth = $sppBill->month;
        $oldYear = $sppBill->year;

        $sppBill->update($validated);
        $sppBill->load('student.user');

        $changes = [];

        if ($oldStudentId != $sppBill->student_id) {
            $changes[] = 'siswa';
        }

        if ((float) $oldAmount != (float) $sppBill->amount) {
            $changes[] = 'jumlah tagihan';
        }

        if ($oldMonth != $sppBill->month || $oldYear != $sppBill->year) {
            $changes[] = 'periode';
        }

        if ($oldStatus !== $sppBill->status) {
            $changes[] = 'status';
        }

        if ($oldStudentId != $sppBill->student_id) {
            $oldStudent = Student::with('user')->find($oldStudentId);

            if ($oldStudent?->user) {
                $oldStudent->user->notify(
                    new SystemNotification(
                        'Tagihan SPP Diperbarui',
                        'Tagihan SPP Anda untuk '
                        . $this->formatMonth($oldMonth)
                        . ' '
                        . $oldYear
                        . ' telah dipindahkan ke siswa lain oleh administrator.',
                        route('student.spp'),
                        'warning',
                    ),
                );
            }

            if ($sppBill->student?->user) {
                $sppBill
                    ->student
                    ->user
                    ->notify(
                        new SystemNotification(
                            'Tagihan SPP Ditambahkan',
                            'Anda memiliki tagihan SPP untuk '
                            . $this->formatMonth($sppBill->month)
                            . ' '
                            . $sppBill->year
                            . ' sebesar Rp '
                            . number_format($sppBill->amount, 0, ',', '.')
                            . '.',
                            route('student.spp.show', $sppBill->id),
                            $sppBill->status === 'paid' ? 'success' : 'info',
                        ),
                    );
            }
        } elseif ($sppBill->student?->user && !empty($changes)) {
            $message =
                'Tagihan SPP untuk '
                . $this->formatMonth($sppBill->month)
                . ' '
                . $sppBill->year
                . ' telah diperbarui. Perubahan: '
                . implode(', ', $changes)
                . '.';

            if ($oldStatus !== $sppBill->status) {
                $message .= ' Status sekarang: ' . $this->formatStatus($sppBill->status) . '.';
            }

            $type = $sppBill->status === 'paid'
                ? 'success'
                : (in_array($sppBill->status, ['failed', 'expired'], true) ? 'warning' : 'info');

            $sppBill
                ->student
                ->user
                ->notify(
                    new SystemNotification(
                        'Tagihan SPP Diperbarui',
                        $message,
                        route('student.spp.show', $sppBill->id),
                        $type,
                    ),
                );
        }

        return redirect()->route('admin.spp-bills.index')->with('success', 'Tagihan SPP berhasil diperbarui.');
    }

    public function destroy(Request $request, SppBill $sppBill)
    {
        $this->ensureBranchAccess($request, $sppBill);

        $sppBill->delete();

        return redirect()->route('admin.spp-bills.index')->with('success', 'Tagihan SPP berhasil dihapus.');
    }

    private function ensureBranchAccess(Request $request, SppBill $sppBill): void
    {
        if ($request->user()->isSuperAdmin()) {
            return;
        }

        $hasAccess = $sppBill->student()->where('branch_id', $request->user()->branch_id)->exists();

        abort_unless($hasAccess, 403);
    }

    private function formatMonth(int $month): string
    {
        return (
            [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ][$month] ?? (string) $month
        );
    }

    private function formatStatus(string $status): string
    {
        return (
            [
                'paid' => 'Lunas',
                'unpaid' => 'Belum Dibayar',
                'pending' => 'Menunggu Pembayaran',
                'failed' => 'Gagal',
                'expired' => 'Kedaluwarsa',
            ][$status] ?? $status
        );
    }

    public function report(Request $request): View
    {
        $query = SppBill::with([
            'student.classRoom',
            'student.branch',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('student', function ($studentQuery) use ($search) {
                $studentQuery->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")->orWhere('identity_number', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('branch_id')) {
            $query->whereHas('student', function ($studentQuery) use ($request) {
                $studentQuery->where('branch_id', $request->branch_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $allBills = (clone $query)->get();

        $totalBills = $allBills->count();
        $totalAmount = $allBills->sum('amount');
        $totalPaid = $allBills->where('status', 'paid')->sum('amount');
        $totalUnpaid = $allBills->where('status', 'unpaid')->sum('amount');

        $sppBills = $query->latest('year')->latest('month')->latest('id')->paginate(15)->withQueryString();

        $branches = Branch::where('is_active', true)->orderBy('name')->get();

        $years = SppBill::query()->select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('super-admin.spp-bills.report', compact(
            'sppBills',
            'branches',
            'years',
            'totalBills',
            'totalAmount',
            'totalPaid',
            'totalUnpaid',
        ));
    }
}
