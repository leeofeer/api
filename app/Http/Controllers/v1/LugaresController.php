<?php

/**
 * @OA\Schema(
 *     schema="Lugares",
 *     type="object",
 *     required={"name","slug","city","state"},
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="slug", type="string"),
 *     @OA\Property(property="city", type="string"),
 *     @OA\Property(property="state", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lugares;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Lugares",
 *     description="Documentación de API Lugares"
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8080",
 *     description="Servidor local"
 * )
 *
 * @OA\Tag(
 *     name="Lugares",
 *     description="CRUD de Lugares"
 * )
 */
class LugaresController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/lugares",
     *     summary="Lista todos los lugares",
     *     tags={"Lugares"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filtrar por nombre",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de lugares",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Lugares"))
     *     )
     * )
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
     * @OA\Post(
     *     path="/api/lugares",
     *     summary="Crear un lugar",
     *     tags={"Lugares"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Lugares")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lugar creado",
     *         @OA\JsonContent(ref="#/components/schemas/Lugares")
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/lugares/{id}",
     *     summary="Mostrar un lugar específico",
     *     tags={"Lugares"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalle del lugar",
     *         @OA\JsonContent(ref="#/components/schemas/Lugares")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lugar no encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        $lugares = Lugares::findOrFail($id);
        return response()->json($lugares);
    }

    /**
     * @OA\Put(
     *     path="/api/lugares/{id}",
     *     summary="Actualizar un lugar",
     *     tags={"Lugares"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Lugares")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lugar actualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Lugares")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lugar no encontrado"
     *     )
     * )
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
     * @OA\Delete(
     *     path="/api/lugares/{id}",
     *     summary="Eliminar un lugar",
     *     tags={"Lugares"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lugar eliminado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lugar no encontrado"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $lugares = Lugares::findOrFail($id);
        $lugares->delete();

        return response()->json(['message' => 'Lugar eliminado']);
    }
}
