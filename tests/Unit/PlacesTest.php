<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Places;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlacesTest extends TestCase
{
    use RefreshDatabase; // Limpiar la DB entre tests

    /** @test */
    public function can_create_place()
    {
        $data = [
            'name' => 'Parque Central',
            'slug' => 'parque-central',
            'city' => 'Asuncion',
            'state' => 'Central',
        ];

        $response = $this->postJson('/api/places', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Creado exitosamente',
                     'data' => [
                         'name' => 'Parque Central',
                         'slug' => 'parque-central',
                         'city' => 'Asuncion',
                         'state' => 'Central',
                     ]
                 ]);

        $this->assertDatabaseHas('lugares', $data);
    }

    /** @test */
    public function can_show_places()
    {
        $place = Places::factory()->create();

        $response = $this->getJson('/api/places');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'name' => $place->name,
                 ]);
    }

    /** @test */
    public function can_show_a_place()
    {
        $place = Places::factory()->create();

        $response = $this->getJson("/api/places/{$place->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $place->id,
                     'name' => $place->name,
                 ]);
    }

    /** @test */
    public function can_update_place()
    {
        $place = Places::factory()->create();

        $data = ['name' => 'Parque Modificado'];

        $response = $this->putJson("/api/places/{$place->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Parque Modificado']);

        $this->assertDatabaseHas('lugares', $data);
    }

    /** @test */
    public function can_delete_place()
    {
        $place = Places::factory()->create();

        $response = $this->deleteJson("/api/places/{$place->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Lugar eliminado']);

        $this->assertDatabaseMissing('lugares', ['id' => $place->id]);
    }
}
