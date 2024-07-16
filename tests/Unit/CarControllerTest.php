<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Car;
use App\Http\Resources\V1\CarResource;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndex()
    {
        // Create some test data
        Car::factory()->count(3)->create();

        $response = $this->get('/api/cars');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'message',
                     'status',
                     'data' => [
                         '*' => [
                             'name',
                             'brand',
                             'year',
                             'body',
                         ]
                     ]
                 ]);
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $data = [
            'name' => 'Test Car',
            'brand' => 'Test Brand',
            'year' => 2021,
            'body' => 'Sedan',
        ];

        $response = $this->post('/api/cars', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Car Created',
                     'status' => 201,
                     'data' => [
                         'name' => 'Test Car',
                         'brand' => 'Test Brand',
                         'year' => 2021,
                         'body' => 'Sedan',
                     ]
                 ]);

        $this->assertDatabaseHas('cars', $data);
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShow()
    {
        $car = Car::factory()->create();

        $response = $this->get('/api/cars/' . $car->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'name' => $car->name,
                         'brand' => $car->brand,
                         'year' => $car->year,
                         'body' => $car->body,
                     ]
                 ]);
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $car = Car::factory()->create();

        $data = [
            'name' => 'Updated Car',
            'brand' => 'Updated Brand',
            'year' => 2022,
            'body' => 'Coupe',
        ];

        $response = $this->put('/api/cars/' . $car->id, $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Car updated',
                     'status' => 200,
                     'data' => [
                         'name' => 'Updated Car',
                         'brand' => 'Updated Brand',
                         'year' => 2022,
                         'body' => 'Coupe',
                     ]
                 ]);

        $this->assertDatabaseHas('cars', $data);
    }
}
