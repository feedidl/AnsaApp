<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('order', 'asc')->get();
        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team.form', ['member' => new TeamMember()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'bio' => 'nullable|string',
            'skills_raw' => 'nullable|string',
            'experiences_raw' => 'nullable|string',
            'educations_raw' => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable|image|max:3072',
        ]);

        $slug = Str::slug($validated['name']);
        $count = TeamMember::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $photoPath = '/storage/images/logo/logo.png';
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images/team', 'public');
            $photoPath = '/storage/' . $path;
        }

        // Skills format: "Laravel:95, Vue:90"
        $skills = [];
        if (!empty($validated['skills_raw'])) {
            $pairs = explode(',', $validated['skills_raw']);
            foreach ($pairs as $p) {
                if (str_contains($p, ':')) {
                    [$sName, $sLevel] = explode(':', $p, 2);
                    $skills[] = ['name' => trim($sName), 'level' => (int)trim($sLevel)];
                }
            }
        }

        // Experiences: JSON format or decoded
        $experiences = !empty($validated['experiences_raw']) 
            ? json_decode($validated['experiences_raw'], true) ?? [] 
            : [];

        // Educations: JSON format or decoded
        $educations = !empty($validated['educations_raw']) 
            ? json_decode($validated['educations_raw'], true) ?? [] 
            : [];

        TeamMember::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'role' => $validated['role'],
            'email' => $validated['email'] ?? null,
            'whatsapp' => $validated['whatsapp'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'github' => $validated['github'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'photo' => $photoPath,
            'skills' => $skills,
            'experiences' => $experiences,
            'educations' => $educations,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.form', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'bio' => 'nullable|string',
            'skills_raw' => 'nullable|string',
            'experiences_raw' => 'nullable|string',
            'educations_raw' => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable|image|max:3072',
        ]);

        $photoPath = $team->photo;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images/team', 'public');
            $photoPath = '/storage/' . $path;
        }

        $skills = [];
        if (!empty($validated['skills_raw'])) {
            $pairs = explode(',', $validated['skills_raw']);
            foreach ($pairs as $p) {
                if (str_contains($p, ':')) {
                    [$sName, $sLevel] = explode(':', $p, 2);
                    $skills[] = ['name' => trim($sName), 'level' => (int)trim($sLevel)];
                }
            }
        } else {
            $skills = $team->skills;
        }

        $experiences = !empty($validated['experiences_raw']) 
            ? json_decode($validated['experiences_raw'], true) ?? $team->experiences 
            : $team->experiences;

        $educations = !empty($validated['educations_raw']) 
            ? json_decode($validated['educations_raw'], true) ?? $team->educations 
            : $team->educations;

        $team->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'email' => $validated['email'] ?? null,
            'whatsapp' => $validated['whatsapp'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'github' => $validated['github'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'photo' => $photoPath,
            'skills' => $skills,
            'experiences' => $experiences,
            'educations' => $educations,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.team.index')->with('success', 'Data anggota tim dan CV berhasil diperbarui.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
