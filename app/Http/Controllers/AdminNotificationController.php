<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminNotificationController extends Controller
{
    public function create(): View
    {
        $users = User::whereIn('role', ['guru', 'siswa'])
            ->orderBy('role')
            ->orderBy('name')
            ->get();

        return view('admin.notifications.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'type' => ['required', 'in:info,success,warning'],
            'user_ids' => ['required', 'array', 'min:1'],
            'user_ids.*' => ['integer', 'exists:users,id'],
        ], [
            'title.required' => 'Judul notifikasi wajib diisi.',
            'message.required' => 'Pesan notifikasi wajib diisi.',
            'type.required' => 'Tipe notifikasi wajib dipilih.',
            'user_ids.required' => 'Pilih minimal satu penerima.',
            'user_ids.min' => 'Pilih minimal satu penerima.',
            'user_ids.*.exists' => 'Penerima yang dipilih tidak ditemukan.',
        ]);

        $users = User::whereIn('id', $validated['user_ids'])
            ->whereIn('role', ['guru', 'siswa'])
            ->get();

        if ($users->isEmpty()) {
            return back()
                ->withErrors(['user_ids' => 'Pilih minimal satu Guru atau Siswa sebagai penerima.'])
                ->withInput();
        }

        foreach ($users as $user) {
            $user->notify(
                new SystemNotification(
                    $validated['title'],
                    $validated['message'],
                    route('notifications.index'),
                    $validated['type']
                )
            );
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Notifikasi berhasil dikirim kepada {$users->count()} penerima.");
    }
}