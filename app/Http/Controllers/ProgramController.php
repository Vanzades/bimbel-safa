<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProgramController extends Controller
{
    private function routePrefix(): string
    {
        return request()->routeIs('super-admin.*') ? 'super-admin' : 'admin';
    }

    private function viewData(): array
    {
        return ['routePrefix' => $this->routePrefix()];
    }

    public function index(Request $request): View
    {
        $query = Program::withCount(['students', 'classRooms']);

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && in_array($request->status, ['active', 'inactive'], true)) {
            $query->where('status', $request->status);
        }

        $programs = $query->latest()->paginate(10)->withQueryString();
        $totalPrograms = Program::count();
        $activePrograms = Program::where('status', 'active')->count();
        $inactivePrograms = Program::where('status', 'inactive')->count();

        return view('programs.index', array_merge($this->viewData(), compact(
            'programs', 'totalPrograms', 'activePrograms', 'inactivePrograms'
        )));
    }

    public function create(): View
    {
        return view('programs.create', $this->viewData());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:programs,code'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ], [
            'name.required' => 'Nama program wajib diisi.',
            'code.required' => 'Kode program wajib diisi.',
            'code.unique' => 'Kode program sudah digunakan.',
            'status.required' => 'Status program wajib dipilih.',
        ]);

        Program::create($validated);

        return redirect()->route($this->routePrefix() . '.programs.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Program $program): View
    {
        $program->loadCount(['students', 'classRooms']);
        $program->load(['students' => fn ($query) => $query->latest()->limit(10), 'classRooms' => fn ($query) => $query->latest()->limit(10)]);

        return view('programs.show', array_merge($this->viewData(), compact('program')));
    }

    public function edit(Program $program): View
    {
        return view('programs.edit', array_merge($this->viewData(), compact('program')));
    }

    public function update(Request $request, Program $program): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('programs', 'code')->ignore($program->id)],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ], [
            'name.required' => 'Nama program wajib diisi.',
            'code.required' => 'Kode program wajib diisi.',
            'code.unique' => 'Kode program sudah digunakan.',
            'status.required' => 'Status program wajib dipilih.',
        ]);

        $program->update($validated);

        return redirect()->route($this->routePrefix() . '.programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program): RedirectResponse
    {
        if ($program->students()->exists() || $program->classRooms()->exists()) {
            return redirect()->route($this->routePrefix() . '.programs.index')
                ->with('error', 'Program tidak dapat dihapus karena masih digunakan oleh siswa atau kelas.');
        }

        $program->delete();

        return redirect()->route($this->routePrefix() . '.programs.index')->with('success', 'Program berhasil dihapus.');
    }
}
