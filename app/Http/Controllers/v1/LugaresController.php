<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lugares;

class LugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lugares::query();

        if ($request->has('name')) {
            $query->where('name', 'ilike', "%{$request->name}%");
        }

        return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        $lugares = Lugares::create($request->only('name','slug','city','state'));
        return response()->json($lugares, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lugares = Lugares::findOrFail($id);
        return response()->json($lugares);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lugares = Lugares::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string',
            'slug' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'state' => 'sometimes|required|string',
        ]);

        $lugares->update($request->only('name','slug','city','state'));
        return response()->json($lugares);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lugares = Lugares::findOrFail($id);
        $lugares->delete();

        return response()->json(['message' => 'Location deleted']);
    }
}
