<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'short_description' => 'required|string|max:500',
            'full_description' => 'nullable|string',
            'features' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $slug = Str::slug($validated['title']);
        $count = Service::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $features = !empty($validated['features']) 
            ? array_filter(array_map('trim', explode("\n", $validated['features']))) 
            : [];

        Service::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'icon' => $validated['icon'] ?? 'code-bracket',
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'] ?? null,
            'features' => array_values($features),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'short_description' => 'required|string|max:500',
            'full_description' => 'nullable|string',
            'features' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $features = !empty($validated['features']) 
            ? array_filter(array_map('trim', explode("\n", $validated['features']))) 
            : [];

        $service->update([
            'title' => $validated['title'],
            'icon' => $validated['icon'] ?? 'code-bracket',
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'] ?? null,
            'features' => array_values($features),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
