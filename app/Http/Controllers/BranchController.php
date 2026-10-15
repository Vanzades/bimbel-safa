<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(): View
    {
        $branches = Branch::withCount([
            'users',
            'teachers',
            'students',
        ])->latest()->paginate(10);

        return view('super-admin.branches.index', compact('branches'));
    }

    public function create(): View
    {
        return view('super-admin.branches.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.required' => 'Nama cabang wajib diisi.',
            'name.max' => 'Nama cabang maksimal 255 karakter.',
            'address.max' => 'Alamat maksimal 1000 karakter.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'is_active.required' => 'Status cabang wajib dipilih.',
        ]);

        Branch::create($validated);

        return redirect()->route('super-admin.branches.index')->with('success', 'Cabang berhasil ditambahkan.');
    }

    public function show(Branch $branch): View
    {
        $branch->loadCount([
            'users',
            'teachers',
            'students',
            'classRooms',
            'schedules',
        ]);

        return view('super-admin.branches.show', compact('branch'));
    }

    public function edit(Branch $branch): View
    {
        return view('super-admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.required' => 'Nama cabang wajib diisi.',
            'name.max' => 'Nama cabang maksimal 255 karakter.',
            'address.max' => 'Alamat maksimal 1000 karakter.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'is_active.required' => 'Status cabang wajib dipilih.',
        ]);

        $branch->update($validated);

        return redirect()->route('super-admin.branches.index')->with('success', 'Data cabang berhasil diperbarui.');
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        if (
            $branch->users()->exists()
            || $branch->teachers()->exists()
            || $branch->students()->exists()
            || $branch->classRooms()->exists()
            || $branch->schedules()->exists()
        ) {
            return back()->with('error', 'Cabang tidak dapat dihapus karena masih memiliki data terkait.');
        }
        $branch->delete();
        return redirect()->route('super-admin.branches.index')->with('success', 'Cabang berhasil dihapus.');
    }
}
