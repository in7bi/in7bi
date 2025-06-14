<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Logic to retrieve and return a list of users
        // Example: return response()->json(User::all());
    }
    public function show($id)
    {
        // Logic to retrieve and return a specific user by ID
        // Example: return response()->json(User::findOrFail($id));
    }
}
