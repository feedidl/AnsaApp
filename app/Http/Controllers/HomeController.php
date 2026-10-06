<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $services = Service::orderBy('order', 'asc')->get();
        $projects = Project::orderBy('order', 'asc')->get();
        $galleries = Gallery::orderBy('order', 'asc')->get();
        $team = TeamMember::orderBy('order', 'asc')->get();

        return view('portfolio', compact('settings', 'services', 'projects', 'galleries', 'team'));
    }
}
