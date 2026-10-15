<x-admin-layout>
    <x-slot name="title">Tambah Program</x-slot>
    <div class="min-h-screen pb-8" style="background:var(--admin-bg);color:var(--admin-text)"><div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-6">
        <nav class="mb-4 flex items-center gap-2 text-xs" style="color:var(--admin-muted)"><a href="{{ route($routePrefix . '.dashboard') }}">Dashboard</a><span>/</span><a href="{{ route($routePrefix . '.programs.index') }}">Program</a><span>/</span><span style="color:var(--admin-text)">Tambah</span></nav>
        <div class="mb-6"><h1 class="text-2xl font-bold">Tambah Program</h1><p class="mt-1 text-sm" style="color:var(--admin-muted)">Masukkan informasi program bimbingan belajar.</p></div>
        <div class="rounded-2xl p-5 sm:p-7" style="background:var(--admin-surface);border:1px solid var(--admin-border);box-shadow:0 4px 20px var(--admin-shadow)">@include('programs._form')</div>
    </div></div>
</x-admin-layout>
