<?php

namespace Modules\Dashboard\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Project\App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        if (class_basename(auth()->user()->model_type) == 'Organization') {
            $projects = Project::query()->latest()->where('is_active', 1)->take(3)
                ->where('organization_id', auth()->user()->model_id)
                ->get();
        } else {
            $projects = Project::query()->latest()->where('is_active', 1)->take(3)->get();
        }
        return view('dashboard::dashboard.index', compact('projects'));
    }
}
