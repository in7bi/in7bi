<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;

class WebServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->paginate(10);

        return response()->json($services);
    }

    public function show($id)
    {
        $service = Service::with('category')->find($id);

        if (! $service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json($service);
    }
}
