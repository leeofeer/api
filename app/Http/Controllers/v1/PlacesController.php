<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places;

class PlacesController extends Controller
{
    public function index(Request $request)
    {
        $query = Places::query();
        if ($request->has('name')) {
            $query->where('name', 'ilike', "%{$request->name}%");
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        $places = Places::create($request->only('name','slug','city','state'));
        return response()->json([
            'message' => 'Creado exitosamente',
            'data' => $places
        ], 201);
    }

    public function show(string $id)
    {
        $lugares = Places::findOrFail($id);
        return response()->json($lugares);
    }

    public function update(Request $request, string $id)
    {
        $places = Places::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string',
            'slug' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'state' => 'sometimes|required|string',
        ]);

        $places->update($request->only('name','slug','city','state'));
        return response()->json($places);
    }

    public function destroy(string $id)
    {
        $places = Places::findOrFail($id);
        $places->delete();

        return response()->json(['message' => 'Lugar eliminado']);
    }
}
