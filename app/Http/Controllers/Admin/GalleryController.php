<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order', 'asc')->latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:4096',
        ]);

        $imagePath = '/storage/images/logo/logo.png';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/gallery', 'public');
            $imagePath = '/storage/' . $path;
        }

        Gallery::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'image_url' => $imagePath,
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil dihapus.');
    }
}
