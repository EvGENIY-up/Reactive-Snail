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
        $cars = Car::all();

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
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:100',
            'type' => 'required|string|min:2|max:100',
            'img' => 'nullable|string|',
            'status_id' => 'required|integer|exists:authors,id',
            'person_id' => 'nullable|integer|exists:authors,id',
        ]);

        $car = new Car();
        $car->name = $request->name;
        $car->type = $request->type;
        $car->img = $request->img;
        $car->status_id = $request->email;
        $car->person_id = $request->person_id;
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
            'status_id' => 'required|integer|exists:authors,id',
            'person_id' => 'required|integer|exists:authors,id',
        ]);

        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found'
            ], 400);
        }

        $editCar = [
            'name' => $request->title,
            'type' => $request->year,
            'description' => $request->description,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
        ];

        $updated = $car->update($editCar);

        if ($updated)
            return response()->json([
                'success' => true
            ]);
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
