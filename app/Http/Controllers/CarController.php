<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Person;
use App\Models\Status;

use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('status')->get();

        return response()->json([
            'success' => true,
            'data' => $cars
        ]);
    }

    public function show($id)
    {
        $person = Car::with('person')->with('status')->find($id);
        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $person->toArray()
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:100',
            'type' => 'required|string|min:2|max:100',
            'img' => 'nullable|string|',
            'person_id' => 'nullable|integer|exists:people,id',
        ]);

        $car = new Car();
        $car->name = $request->name;
        $car->type = $request->type;
        $car->img = $request->img;
        $car->person_id = $request->person_id;
        $car->status_id = 1;
        $car->user_id = Auth::user()->id;

        if ($car->save())
            return response()->json([
                'success' => true,
                'data' => $car->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'car not added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:100',
            'type' => 'required|string|min:2|max:100',
            'status_id' => 'required|integer|exists:statuses,id',
            'person_id' => 'required|integer|exists:people,id',
        ]);

        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found'
            ], 400);
        }

        $editCar = [
            'name' => $request->name,
            'type' => $request->type,
            'status_id' => $request->status_id,
            'person_id' => $request->person_id,
        ];

        $updated = $car->update($editCar);

        if ($updated)
            return response()->json([
                'success' => true
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'car can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'car not found'
            ], 400);
        }

        if ($car->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'car can not be deleted'
            ], 500);
        }
    }
}
