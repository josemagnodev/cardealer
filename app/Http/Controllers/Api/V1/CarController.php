<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CarResource;
use App\Trait\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;

class CarController extends Controller
{
    use HttpResponses;
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand' => 'required',
            'year' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $car = Car::create([
            'name' => $validated['name'],
            'brand' => $validated['brand'],
            'year' => $validated['year'],
            'body' => $validated['body'],
        ]);

        if ($car) {
            return $this->response('Car Created', 201, new CarResource($car));
        }
        
        return $this->error('Car Not Created', 400, 'Failed to create car');
    }
    public function index()
    {
      return $this->response('All cars',200, CarResource::collection(Car::all()));
    }
    public function show(Car $car)
    {
      return new CarResource($car);
    }
    public function update(Request $request, Car $car)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'brand' => 'required',
            'year' => 'required',
            'body' => 'required',
          ]);
      
          if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
          }
      
          $validated = $validator->validated();
      
          $updated = $car->update([
            'name' => $validated['name'],
            'brand' => $validated['brand'],
            'year' => $validated['year'],
            'body' => $validated['body'],
          ]);
      
          if ($updated) {
            return $this->response('Car updated', 200, new CarResource($car));
          }
      
          return $this->error('Car not updated', 400, $updated);
    }
    public function delete(Car $car)
    {
        $deleted = $car->delete();
        if($deleted){
            return $this->response('car deleted', 200);
        }
        return $this->error('Not possible delete the car', 400, $deleted);
    }



}
