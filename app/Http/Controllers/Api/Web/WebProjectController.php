<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;

class WebProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return response()->json($projects);
    }

    public function show($id)
    {
        $project = Project::find($id);

        if (! $project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json($project);
    }
}
