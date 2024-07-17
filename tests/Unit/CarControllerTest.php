<?php 
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Car;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index method.
     */
    public function testIndex(): void
    {
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
     */
    public function testCreate(): void
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
                     'data' => $data
                 ]);

        $this->assertDatabaseHas('cars', $data);
    }

    /**
     * Test show method.
     */
    public function testShow(): void
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
     */
    public function testUpdate(): void
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
                     'data' => $data
                 ]);

        $this->assertDatabaseHas('cars', $data);
    }
}
