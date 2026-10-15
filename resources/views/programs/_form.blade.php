@php
    $isEdit = isset($program);
    $baseRoute = $routePrefix . '.programs';
    $field = 'mt-1.5 block w-full rounded-lg px-3 py-2.5 text-sm outline-none transition';
@endphp

@if ($errors->any())
    <div class="mb-5 rounded-xl border px-4 py-3 text-sm" style="background:#fef2f2;border-color:#fecaca;color:#b91c1c"><ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<form method="POST" action="{{ $isEdit ? route($baseRoute . '.update', $program) : route($baseRoute . '.store') }}" class="space-y-5">
    @csrf
    @if ($isEdit) @method('PUT') @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="name" class="block text-sm font-semibold">Nama Program <span class="text-red-500">*</span></label>
            <input id="name" name="name" type="text" required maxlength="255" value="{{ old('name', $program->name ?? '') }}" placeholder="Contoh: Bimbingan SD" class="{{ $field }}" style="background:var(--admin-surface-soft);border:1px solid var(--admin-border);color:var(--admin-text)">
            @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="code" class="block text-sm font-semibold">Kode Program <span class="text-red-500">*</span></label>
            <input id="code" name="code" type="text" required maxlength="50" value="{{ old('code', $program->code ?? '') }}" placeholder="Contoh: SD" class="{{ $field }}" style="background:var(--admin-surface-soft);border:1px solid var(--admin-border);color:var(--admin-text)">
            @error('code')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-2">
            <label for="description" class="block text-sm font-semibold">Deskripsi</label>
            <textarea id="description" name="description" rows="4" maxlength="5000" placeholder="Jelaskan program bimbingan belajar..." class="{{ $field }} resize-y" style="background:var(--admin-surface-soft);border:1px solid var(--admin-border);color:var(--admin-text)">{{ old('description', $program->description ?? '') }}</textarea>
            @error('description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror

        </div>
        <div>
            <label for="status" class="block text-sm font-semibold">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" required class="{{ $field }}" style="background:var(--admin-surface-soft);border:1px solid var(--admin-border);color:var(--admin-text)">
                <option value="active" @selected(old('status', $program->status ?? 'active') === 'active')>Aktif</option>
                <option value="inactive" @selected(old('status', $program->status ?? 'active') === 'inactive')>Nonaktif</option>
            </select>
            @error('status')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 pt-4" style="border-top:1px solid var(--admin-border)">
        <a href="{{ route($baseRoute . '.index') }}" class="inline-flex h-10 items-center justify-center rounded-lg border px-4 text-sm font-medium" style="border-color:var(--admin-border);color:var(--admin-text)">Batal</a>
        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white hover:brightness-110" style="background:#2563EB">{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Program' }}</button>
    </div>
</form>
