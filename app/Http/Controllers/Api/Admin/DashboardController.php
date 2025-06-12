<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project; // Tambahkan ini

class DashboardController extends Controller
{
    public function index()
    {
        $projectCount = Project::count(); // Hitung jumlah project

        return response()->json([
            'message' => 'Welcome to the Admin Dashboard',
            'project_count' => $projectCount, // Tampilkan jumlah project
        ]);
    }
}
