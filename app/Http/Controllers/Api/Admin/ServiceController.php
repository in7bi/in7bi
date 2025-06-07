<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Tampilkan semua services
    public function index()
    {
        $services = Service::with('category')->get();

        return response()->json($services);
    }

    // Tampilkan detail berdasarkan ID
    public function show($id)
    {
        $service = Service::with('category')->find($id);

        if (! $service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json($service);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

        $service = Service::create($validated);

        return response()->json($service, 201);
    }

    // Update data berdasarkan ID
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (! $service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $validated = $request->validate([
            'service_name' => 'sometimes|required|string|max:255',
            'subtitle' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'service_category_id' => 'sometimes|required|exists:service_categories,id',
        ]);

        $service->update($validated);

        return response()->json($service);
    }

    // Hapus data berdasarkan ID
    public function destroy($id)
    {
        $service = Service::find($id);

        if (! $service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}
