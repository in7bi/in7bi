<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;

class WebProjectController extends Controller
{
    // Tampilkan semua project (bisa difilter atau dipaginasi jika perlu)
    public function index()
    {
        $projects = Project::latest()->get();
        return response()->json($projects);
    }

    // Tampilkan detail project berdasarkan ID
    public function show($id)
    {
        $project = Project::find($id);

        if (! $project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json($project);
    }
}
