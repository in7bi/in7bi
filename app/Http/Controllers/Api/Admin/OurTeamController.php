<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurTeamController extends Controller
{
    // Menampilkan semua anggota tim
    public function index()
    {
        return response()->json(OurTeam::all());
    }

    // Menampilkan satu anggota tim
    public function show($id)
    {
        $team = OurTeam::find($id);
        if (! $team) {
            return response()->json(['message' => 'Team member not found'], 404);
        }

        return response()->json($team);
    }

    // Menyimpan anggota tim baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'upload_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('upload_photo')) {
            $validated['upload_photo'] = $request->file('upload_photo')->store('uploads/ourteam', 'public');
        }

        $team = OurTeam::create($validated);

        return response()->json($team, 201);
    }

    // Update data anggota tim
    public function update(Request $request, $id)
    {
        $team = OurTeam::find($id);
        if (! $team) {
            return response()->json(['message' => 'Team member not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'upload_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('upload_photo')) {
            if ($team->upload_photo && Storage::disk('public')->exists($team->upload_photo)) {
                Storage::disk('public')->delete($team->upload_photo);
            }
            $validated['upload_photo'] = $request->file('upload_photo')->store('uploads/ourteam', 'public');
        }

        $team->update($validated);

        return response()->json($team);
    }

    // Menghapus anggota tim
    public function destroy($id)
    {
        $team = OurTeam::find($id);
        if (! $team) {
            return response()->json(['message' => 'Team member not found'], 404);
        }

        if ($team->upload_photo && Storage::disk('public')->exists($team->upload_photo)) {
            Storage::disk('public')->delete($team->upload_photo);
        }

        $team->delete();

        return response()->json(['message' => 'Team member deleted successfully']);
    }
}
