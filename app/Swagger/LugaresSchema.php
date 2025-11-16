<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Lugares",
 *     description="Esquema del modelo Lugares",
 *     type="object",
 *     required={"name","slug","city","state"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Plaza Central"),
 *     @OA\Property(property="slug", type="string", example="plaza-central"),
 *     @OA\Property(property="city", type="string", example="Asunción"),
 *     @OA\Property(property="state", type="string", example="Central"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class LugaresSchema
{
}
