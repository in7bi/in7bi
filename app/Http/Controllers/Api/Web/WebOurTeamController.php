<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;

class WebOurTeamController extends Controller
{
    // Menampilkan semua anggota tim
    public function index()
    {
        $team = OurTeam::latest()->get();
        return response()->json($team);
    }

    // Menampilkan detail anggota tim berdasarkan ID
    public function show($id)
    {
        $member = OurTeam::find($id);

        if (! $member) {
            return response()->json(['message' => 'Team member not found'], 404);
        }

        return response()->json($member);
    }
}
