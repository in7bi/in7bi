<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Welcome to the Admin Dashboard',
        ]);
    }
}
