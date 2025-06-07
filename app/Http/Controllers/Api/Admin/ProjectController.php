<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;

class ProjectController extends Controller
{
    // Tampilkan semua project
    public function index()
    {
        return response()->json(Project::all());
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

    // Simpan project baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name'          => 'required|string|max:255',
            'materi'                => 'required|string',
            'category'              => 'required|string|max:255',
            'pitch_deck'            => 'nullable|file|mimes:pdf,ppt,pptx|max:10240', // max 10MB
            'upload_proposal_file'  => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('pitch_deck')) {
            $validated['pitch_deck'] = $request->file('pitch_deck')->store('uploads/projects/pitch_deck', 'public');
        }

        if ($request->hasFile('upload_proposal_file')) {
            $validated['upload_proposal_file'] = $request->file('upload_proposal_file')->store('uploads/projects/proposal', 'public');
        }

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    // Update project
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (! $project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $validated = $request->validate([
            'project_name'          => 'sometimes|required|string|max:255',
            'materi'                => 'sometimes|required|string',
            'category'              => 'sometimes|required|string|max:255',
            'pitch_deck'            => 'nullable|file|mimes:pdf,ppt,pptx|max:10240',
            'upload_proposal_file'  => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('pitch_deck')) {
            if ($project->pitch_deck && Storage::disk('public')->exists($project->pitch_deck)) {
                Storage::disk('public')->delete($project->pitch_deck);
            }
            $validated['pitch_deck'] = $request->file('pitch_deck')->store('uploads/projects/pitch_deck', 'public');
        }

        if ($request->hasFile('upload_proposal_file')) {
            if ($project->upload_proposal_file && Storage::disk('public')->exists($project->upload_proposal_file)) {
                Storage::disk('public')->delete($project->upload_proposal_file);
            }
            $validated['upload_proposal_file'] = $request->file('upload_proposal_file')->store('uploads/projects/proposal', 'public');
        }

        $project->update($validated);

        return response()->json($project);
    }

    // Hapus project
    public function destroy($id)
    {
        $project = Project::find($id);

        if (! $project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        if ($project->pitch_deck && Storage::disk('public')->exists($project->pitch_deck)) {
            Storage::disk('public')->delete($project->pitch_deck);
        }

        if ($project->upload_proposal_file && Storage::disk('public')->exists($project->upload_proposal_file)) {
            Storage::disk('public')->delete($project->upload_proposal_file);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
