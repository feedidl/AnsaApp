<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'client' => 'nullable|string|max:255',
            'completion_date' => 'nullable|string|max:100',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'features' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:3072',
        ]);

        $slug = Str::slug($validated['title']);
        $count = Project::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $imagePath = '/storage/images/logo/logo.png';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/projects', 'public');
            $imagePath = '/storage/' . $path;
        }

        // Parse tech stack comma-separated
        $techStack = !empty($validated['tech_stack']) 
            ? array_map('trim', explode(',', $validated['tech_stack'])) 
            : [];

        // Parse features newline-separated
        $features = !empty($validated['features']) 
            ? array_filter(array_map('trim', explode("\n", $validated['features']))) 
            : [];

        Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'client' => $validated['client'] ?? null,
            'completion_date' => $validated['completion_date'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'featured_image' => $imagePath,
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'] ?? null,
            'tech_stack' => $techStack,
            'features' => array_values($features),
            'is_featured' => $request->boolean('is_featured'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'client' => 'nullable|string|max:255',
            'completion_date' => 'nullable|string|max:100',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'features' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:3072',
        ]);

        $imagePath = $project->featured_image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/projects', 'public');
            $imagePath = '/storage/' . $path;
        }

        $techStack = !empty($validated['tech_stack']) 
            ? array_map('trim', explode(',', $validated['tech_stack'])) 
            : [];

        $features = !empty($validated['features']) 
            ? array_filter(array_map('trim', explode("\n", $validated['features']))) 
            : [];

        $project->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'client' => $validated['client'] ?? null,
            'completion_date' => $validated['completion_date'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'featured_image' => $imagePath,
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'] ?? null,
            'tech_stack' => $techStack,
            'features' => array_values($features),
            'is_featured' => $request->boolean('is_featured'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus.');
    }
}
